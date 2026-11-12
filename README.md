# eToolKing Labs: Bedrock-Powered Agentic Commerce Pipeline

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Powered by Amazon Bedrock](https://img.shields.io/badge/AWS-Amazon%20Nova-orange.svg)](https://aws.amazon.com/bedrock/)
[![PayPal Agentic Commerce](https://img.shields.io/badge/PayPal-Agentic%20Commerce-gold.svg)](https://developer.paypal.com/)

An autonomous promotional intelligence pipeline that bridges noisy multilingual shopping feeds with real-time VIP alert activation. Built by the eToolKing engineering team for the PayPal AI Hackathon 2026.

---

## Architecture: Cascading Agentic Workflow

Unlike brittle single-prompt implementations, this engine employs an Agentic Workflow featuring Model Tiering and Early-Exit Gating to optimize unit economics and eliminate hallucinations:

```
====================================================================================================
[MODEL TIERING SPECIFICATION (AWS BEDROCK - AMAZON NOVA)]
• amazon.nova-lite-v1:0   [AI.a] Low Token Cost & Compute   | High-Throughput Early-Exit & Routing
• amazon.nova-2-lite-v1:0 [AI.b] Mid Token Cost & Compute   | Multilingual L10n Task-Specific Synthesis
• amazon.nova-pro-v1:0    [AI.c] High Reasoning & Compute   | Zero-Hallucination Deep Schema Extraction
====================================================================================================

                        [Unstructured Ingestion Stream (Official API Feeds)]
                                                 │
                                                 ▼
┌──────────────────────────────────────────────────────────────────────────────────────────────────┐
│ Tier-1: Low-Cost Gating & Semantic Intent Routing [AI.a: Amazon Nova Lite]                       │
│ • Filters 90% non-deal social noise at near-zero token cost (Early-Exit Guardrail)               │
│ • Dispatches validated promotional streams into either Retail Event or Flight Deals track        │
└────────────────────────────────┬─────────────────────────────────┬───────────────────────────────┘
                                 │ (Retail Event Stream)           │ (Flight Promo Stream)
                                 ▼                                 ▼
┌──────────────────────────────────────────────┐ ┌────────────────────────────────────────────────┐
│ Tier-2: Retail Disambiguation [AI.c: Nova Pro│ │ Tier-2: Deep Flight Extraction [AI.c: Nova Pro]│
│ • Zero-hallucination Schema mapping          │ │ • Multi-city route matrix & IATA code resolve  │
│ • Store category, promo deadline & discounts │ │ • Dual validity windows (booking & travel)     │
│ • Regional chain footprint (map_type: place) │ │ • Promo code verification & restrictions       │
└──────────────────────┬───────────────────────┘ └────────────────────────┬───────────────────────┘
                       ▼                                                  ▼
               [SaleEvents Node]                               [Structured Deal Brief]
                       │                                                  │
                       │                                                  ▼
                       │                         ┌────────────────────────────────────────────────┐
                       │                         │ Tier-3: Localization Engine [AI.b: Nova 2 Lite]│
                       │                         │ • Context-aware multilingual enrichment        │
                       │                         │ • 10-language localized deal derivation        │
                       │                         └────────────────────────┬───────────────────────┘
                       │                                                  │
                       │                         ┌────────────────────────┴───────────────────────┐
                       │                         ▼ (Enrichment Success)                           ▼ (Failed)
                       │               [flightsSALE Production Engine]              ┌─────────────────────┐
                       │                         │                                  │ Active Learning DB  │
                       │                         │                                  │ • Edge-case capture │
                       │                         │                                  │ • Offline eval loop │
                       │                         │                                  └─────────────────────┘
                       ▼                         ▼
┌──────────────────────────────────────────────────────────────────────────────────────────────────┐
│ Action Layer: PayPal Agentic Commerce Engine                                                     │
│ • 1-Click VIP Pro Feature Activation ($0.99 Authorization via PayPal JS SDK Sandbox)             │
│ • Autonomous push alert provisioning dispatched directly to user-configured device endpoints     │
└──────────────────────────────────────────────────────────────────────────────────────────────────┘
```
---

## Live Evaluation and Deterministic Sandbox

To allow hackathon evaluators to test the pipeline with zero latency and 100% deterministic reproducibility, we host an isolated testing console:

* Live Interactive Evaluation Console:  
  `https://etoolking.com/lab/agentic?token=devpost-2026`  
  *(Access token is pre-configured to bypass internal security gates)*

### Evaluation Walkthrough:
1. Select an Ingestion Stream (Flight Promo Stream or Retail Event Stream).
2. Click Run Nova Agent Pipeline to inspect deterministic schema extraction and initial monogram generation.
3. Click View Canonical Record to verify real-time data reconciliation with our live production nodes.
4. Test the PayPal Sandbox Button ($0.99 1-Click VIP Authorization) to inspect the complete agentic checkout lifecycle.

---

## Production Ecosystem and Verified Footprint

This submission reflects an operational software ecosystem maintained by eToolKing:

* Web Infrastructure:
  * eToolKing Mother Portal: https://etoolking.com/
  * flightsSALE Global Flight Deal Engine: https://flights-sale.com/
  * SaleEvents Multi-Region Portal: https://sale-events.com/ (12 regional subdomains including HK, TW, JP, US, etc.)
* App Store Distribution:
  * Microsoft Store Apps: [9P75PF0BQTBM](https://apps.microsoft.com/detail/9P75PF0BQTBM), [9PHKD6N9V8QK](https://apps.microsoft.com/detail/9PHKD6N9V8QK), [9NMRBJHLQSNJ](https://apps.microsoft.com/detail/9NMRBJHLQSNJ)
  * Canonical Snap Store Linux Clients: Published across desktop repositories.
* Institutional Recognition:
  * Supported by the AWS Activate Portfolio Program for Startups (Featured on [AWS Startup Showcase](https://startups.aws.com/showcase/startup-details/f7ca3a20-9b67-4fdf-8a13-5f6d8a0772ad)).
  * eToolKing is a member of NVIDIA Inception.

---

## License
This project is open-source under the [MIT License](LICENSE).
