<?php

declare(strict_types=1);

namespace Bitvora\Exception;

class ConnectException extends BitvoraException
{
    public function __construct(string $curlErrorMessage, int $curlErrorCode)
    {
        parent::__construct($curlErrorMessage, $curlErrorCode);
    }
}
