<?php

declare(strict_types=1);

namespace Bitvora\Response;

class DepositResponse extends AbstractResponse
{
    public const STATUS_SETTLED = 'settled';
    public const STATUS_PENDING = 'pending';
    public const STATUS_FAILED = 'failed';
    public const STATUS_PENDING_APPROVAL = 'pending_approval';
    public const STATUS_REJECTED = 'rejected';

    public function getId(): string
    {
        return $this->getData()['id'];
    }

    public function getAmountSats(): int
    {
        return $this->getData()['amount_sats'];
    }

    public function getRecipient(): string
    {
        return $this->getData()['recipient'];
    }

    public function getNetworkType(): string
    {
        return $this->getData()['network_type'];
    }

    public function getRailType(): string
    {
        return $this->getData()['rail_type'];
    }

    public function getStatus(): string
    {
        return $this->getData()['status'];
    }

    public function getChainTxId(): ?string
    {
        return $this->getData()['chain_tx_id'];
    }

    public function getLightningInvoiceId(): ?string
    {
        return $this->getData()['lightning_invoice_id'];
    }

    public function getCreatedAt(): string
    {
        return $this->getData()['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->getData()['updated_at'];
    }

    public function isSettled(): bool
    {
        return $this->getStatus() === self::STATUS_SETTLED;
    }

    public function isPending(): bool
    {
        return $this->getStatus() === self::STATUS_PENDING;
    }

    public function isFailed(): bool
    {
        return $this->getStatus() === self::STATUS_FAILED;
    }

    public function isPendingApproval(): bool
    {
        return $this->getStatus() === self::STATUS_PENDING_APPROVAL;
    }

    public function isRejected(): bool
    {
        return $this->getStatus() === self::STATUS_REJECTED;
    }

    public function isLightning(): bool
    {
        return $this->getRailType() === 'lightning';
    }

    public function isOnChain(): bool
    {
        return $this->getRailType() === 'onchain';
    }
}
