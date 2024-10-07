<?php

declare(strict_types=1);

namespace Bitvora\Tests;

use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;
use Bitvora\Response\CreateOnChainAddressResponse;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class CreateOnChainAddressTest extends TestCase
{
    protected string $apiKey;

    public static function setUpBeforeClass(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->safeLoad();

        if (!isset($_ENV['BITVORA_API_KEY'])) {
            throw new \Exception('Missing .env variables');
        }
    }

    protected function setUp(): void
    {
        $this->apiKey = $_ENV['BITVORA_API_KEY'];
    }

    public function testCreateOnChainAddress(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $address = $bitvora->createOnChainAddress();

        $this->assertInstanceOf(CreateOnChainAddressResponse::class, $address);
        $this->assertIsString($address->getId());
        $this->assertIsString($address->getAddress());
    }
}
