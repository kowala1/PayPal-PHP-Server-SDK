<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Models;

class WebhookSimulateRequest implements \JsonSerializable
{
    private string $webhookId;

    private string $eventType;

    private ?string $resourceVersion = null;

    public function __construct(string $webhookId, string $eventType)
    {
        $this->webhookId = $webhookId;
        $this->eventType = $eventType;
    }

    public function jsonSerialize(): mixed
    {
        $json = [
            'webhook_id' => $this->webhookId,
            'event_type' => $this->eventType,
        ];

        if (isset($this->resourceVersion)) {
            $json['resource_version'] = $this->resourceVersion;
        }

        return $json;
    }
}
