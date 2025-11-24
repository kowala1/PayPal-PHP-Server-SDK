<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Models;

class WebhooksListResponse implements \JsonSerializable
{
    /** @var Webhook[] */
    private array $webhooks;

    public function __construct(array $webhooks)
    {
        $this->webhooks = $webhooks;
    }

    public function getWebhooks(): array
    {
        return $this->webhooks;
    }

    public function setWebhooks(array $webhooks): self
    {
        $this->webhooks = $webhooks;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return ['webhooks' => $this->webhooks ?: [],];
    }
}
