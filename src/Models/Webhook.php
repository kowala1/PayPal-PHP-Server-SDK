<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Models;

use phpDocumentor\Reflection\DocBlock\Tags\Link;

class Webhook implements \JsonSerializable
{
    private ?string $id = null;

    private string $url;

    /** @var WebhookEventType[] */
    private array $eventTypes;

    /** @var Link[] */
    private array $links = [];

    public function __construct(string $url, array $eventTypes)
    {
        $this->url = $url;
        $this->eventTypes = $eventTypes;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
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

    public function getLinks(): array
    {
        return $this->links;
    }

    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }

    public function jsonSerialize()
    {
        $json = [
            'url' => $this->url,
            'event_types' => $this->eventTypes,
        ];

        if (!empty($this->links)) {
            $json['links'] = $this->links;
        }

        return $json;
    }
}
