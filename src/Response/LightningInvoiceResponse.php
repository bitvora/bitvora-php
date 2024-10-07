<?php

declare(strict_types=1);

namespace Bitvora\Response;

class LightningInvoiceResponse extends AbstractResponse
{
    public function getId(): string
    {
        return $this->getData()['id'];
    }

    public function getNodeId(): string
    {
        return $this->getData()['node_id'];
    }

    public function getMemo(): string
    {
        return $this->getData()['memo'];
    }

    public function getRPreimage(): string
    {
        return $this->getData()['r_preimage'];
    }

    public function getRHash(): string
    {
        return $this->getData()['r_hash'];
    }

    public function getAmountSats(): int
    {
        return $this->getData()['amount_sats'];
    }

    public function getPaymentRequest(): string
    {
        return $this->getData()['payment_request'];
    }

    public function isSettled(): bool
    {
        return $this->getData()['settled'];
    }

    public function getLightningAddressId(): ?string
    {
        return $this->getData()['lightning_address_id'];
    }

    public function getMetadata(): ?array
    {
        return $this->getData()['metadata'];
    }
}
