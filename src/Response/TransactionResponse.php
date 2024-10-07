<?php

declare(strict_types=1);

namespace Bitvora\Response;

class TransactionResponse extends AbstractResponse
{
    public const STATUS_SETTLED = 'settled';
    public const STATUS_PENDING = 'pending';
    public const STATUS_FAILED = 'failed';
    public const STATUS_PENDING_APPROVAL = 'pending_approval';
    public const STATUS_REJECTED = 'rejected';

    public const TYPE_DEPOSIT = 'deposit';
    public const TYPE_WITHDRAWAL = 'withdrawal';

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

    public function getStatus(): string
    {
        return $this->getData()['status'];
    }

    public function getRailType(): string
    {
        return $this->getData()['rail_type'];
    }

    public function getType(): string
    {
        return $this->getData()['type'];
    }

    public function getFeeMicrosats(): int
    {
        return $this->getData()['fee_microsats'];
    }

    public function getCreatedAt(): string
    {
        return $this->getData()['created_at'];
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

    public function isDeposit(): bool
    {
        return $this->getType() === self::TYPE_DEPOSIT;
    }

    public function isWithdrawal(): bool
    {
        return $this->getType() === self::TYPE_WITHDRAWAL;
    }
}
