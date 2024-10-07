<?php

declare(strict_types=1);

namespace Bitvora\Response;

class TransactionListResponse extends AbstractListResponse
{
    public function all(): array
    {
        $transactions = [];
        foreach ($this->getData() as $transaction) {
            $transactions[] = new TransactionResponse($transaction);
        }
        return $transactions;
    }
}
