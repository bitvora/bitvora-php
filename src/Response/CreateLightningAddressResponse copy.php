<?php

declare(strict_types=1);

namespace Bitvora\Response;

class CreateLightningAddressResponse extends AbstractResponse
{
    public function getId(): string
    {
        return $this->getData()['id'];
    }

    public function getHandle(): string
    {
        return $this->getData()['handle'];
    }

    public function getDomain(): string
    {
        return $this->getData()['domain'];
    }

    public function getAddress(): string
    {
        return $this->getData()['address'];
    }

    public function getMetadata(): ?array
    {
        return $this->getData()['metadata'];
    }

    public function getCreatedAt(): string
    {
        return $this->getData()['created_at'];
    }

    public function getLastUsedAt(): ?string
    {
        return $this->getData()['last_used_at'];
    }

    public function getDeletedAt(): ?string
    {
        return $this->getData()['deleted_at'];
    }
}
