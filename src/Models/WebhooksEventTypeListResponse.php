<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Models;

class WebhooksEventTypeListResponse implements \JsonSerializable
{
    private array $eventTypes;

    public function __construct(array $eventTypes)
    {
        $this->eventTypes = $eventTypes;
    }

    public function getEventTypes(): array
    {
        return $this->eventTypes;
    }

    public function setEventTypes(array $eventTypes): self
    {
        $this->eventTypes = $eventTypes;
        return $this;
    }


    public function jsonSerialize(): mixed
    {
        return ['event_types' => $this->eventTypes ?: [],];
    }
}
