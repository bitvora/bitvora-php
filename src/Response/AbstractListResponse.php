<?php

declare(strict_types=1);

namespace Bitvora\Response;

abstract class AbstractListResponse extends AbstractResponse implements \Countable
{
    public function count(): int
    {
        return count($this->getData());
    }
}
