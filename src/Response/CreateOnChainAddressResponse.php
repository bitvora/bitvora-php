<?php

declare(strict_types=1);

namespace Bitvora\Response;

class CreateOnChainAddressResponse extends AbstractResponse
{
    public function getId(): string
    {
        return $this->getData()['id'];
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
}
