<?php

declare(strict_types=1);

namespace Bitvora\Response;

class EstimateWithdrawalResponse extends AbstractResponse
{
    public const RECIPIENT_TYPE_LIGHTNING_ADDRESS = 'lightning_address';
    public const RECIPIENT_TYPE_CHAIN_ADDRESS = 'chain_address';
    public const RECIPIENT_TYPE_LIGHTNING_INVOICE = 'lightning_invoice';

    public function getRecipient(): string
    {
        return $this->getData()['recipient'];
    }

    public function getRecipientType(): string
    {
        return $this->getData()['recipient_type'];
    }

    public function getAmountSats(): int
    {
        return $this->getData()['amount_sats'];
    }

    public function getFeeSats(): float
    {
        return $this->getData()['bitvora_fee_sats'];
    }

    public function getSuccessProbability(): float
    {
        return $this->getData()['success_probability'];
    }
}
