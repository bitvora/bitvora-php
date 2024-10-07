<?php

declare(strict_types=1);

namespace Bitvora\Response;

class BalanceResponse extends AbstractResponse
{
    public function getBalance(): int
    {
        return $this->getData()['balance'];
    }
}
