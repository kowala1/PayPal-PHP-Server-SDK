<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Models;

class WebhookRequest implements \JsonSerializable
{
    private string $url;

    private array $eventTypes;

    public function __construct(string $url, array $eventTypes)
    {
        $this->url = $url;
        $this->eventTypes = $eventTypes;
    }

    public function jsonSerialize()
    {
        return [
            'url' => $this->url,
            'event_types' => $this->eventTypes
        ];
    }
}
