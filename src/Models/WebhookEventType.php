<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Models;

class WebhookEventType implements \JsonSerializable
{
    private string $name;

    private ?string $description = null;

    private ?string $status = null;

    private ?string $resourceVersion = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getResourceVersion(): ?string
    {
        return $this->resourceVersion;
    }

    public function setResourceVersion(?string $resourceVersion): self
    {
        $this->resourceVersion = $resourceVersion;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        $json = ['name' => $this->name];

        if (isset($this->description)) {
            $json['description'] = $this->description;
        }
        if (isset($this->status)) {
            $json['status'] = $this->status;
        }
        if (isset($this->resourceVersion)) {
            $json['resource_version'] = $this->resourceVersion;
        }

        return $json;
    }
}
