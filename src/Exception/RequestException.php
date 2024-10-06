<?php

declare(strict_types=1);

namespace Bitvora\Exception;

use Bitvora\Http\ResponseInterface;

class RequestException extends BitvoraException
{
    public function __construct(string $method, string $url, ResponseInterface $response)
    {
        $message = 'Error during ' . $method . ' to ' . $url . '. Got response (' . $response->getStatus() . '): ' . $response->getBody();
        parent::__construct($message, $response->getStatus());
    }
}
