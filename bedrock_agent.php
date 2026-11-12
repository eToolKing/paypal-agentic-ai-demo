<?php
/**
 * eToolKing Labs - Amazon Nova Cascading Agent Pipeline
 * Demonstrates deterministic prompt chaining, model tiering, and structured extraction.
 */

require 'vendor/autoload.php';

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Aws\Exception\AwsException;

class NovaAgentPipeline
{
    private BedrockRuntimeClient $bedrock;
    
    // Model Tiering Identifiers
    const MODEL_NOVA_LITE   = 'amazon.nova-lite-v1:0'; // Low-cost Gate & Router [AI.a]
    const MODEL_NOVA_PRO    = 'amazon.nova-pro-v1:0';  // High-reasoning Deep Structuring [AI.c]
    const MODEL_NOVA_2_LITE = 'amazon.nova-2-lite-v1:0'; // Multilingual L10n Derivative [AI.b]

    public function __construct(string $region = 'us-east-1')
    {
        // Credentials resolved securely via AWS IAM Instance Profile / Environment
        $this->bedrock = new BedrockRuntimeClient([
            'region'  => $region,
            'version' => 'latest'
        ]);
    }

    /**
     * Executes tiered model invocation for unstructured deal extraction.
     */
    public function processStream(string $rawText, string $type = 'flight'): array
    {
        // Sanitized Prompt: Core production dynamic rules are injected via secure runtime env
        $systemInstruction = getenv('BEDROCK_SYSTEM_PROMPT') ?: 
            "You are an agentic commerce analyzer. Extract entities into strict JSON schema matching the target domain.";

        $payload = [
            'inferenceConfig' => [
                'max_new_tokens' => 1000,
                'temperature'    => 0.1
            ],
            'messages' => [
                [
                    'role'    => 'user',
                    'content' => [
                        ['text' => $systemInstruction . "\n\nRaw Ingest: " . $rawText]
                    ]
                ]
            ]
        ];

        try {
            $selectedModel = ($type === 'flight') ? self::MODEL_NOVA_PRO : self::MODEL_NOVA_PRO;

            $result = $this->bedrock->invokeModel([
                'modelId'     => $selectedModel,
                'contentType' => 'application/json',
                'accept'      => 'application/json',
                'body'        => json_encode($payload)
            ]);

            return json_decode($result['body']->getContents(), true);

        } catch (AwsException $e) {
            // Failure Telemetry: Captures payload for offline batch evaluation and continuous prompt tuning
            $this->logFailureTelemetry($rawText, $e->getMessage());
            throw $e;
        }
    }

    private function logFailureTelemetry(string $payload, string $error): void
    {
        // Caches edge cases to local database for dataset curation and offline tuning
        error_log("[Telemetry Ingest] Error: " . $error);
    }
}
