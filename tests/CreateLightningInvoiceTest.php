<?php

declare(strict_types=1);

namespace Bitvora\Tests;

use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Currency;
use Bitvora\Enum\Network;
use Bitvora\Response\LightningInvoiceResponse;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class CreateLightningInvoiceTest extends TestCase
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

    public function testCreateLightningInvoice(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $estimate = $bitvora->createLightningInvoice(100, Currency::USD, "this is a test", 3600);

        $this->assertInstanceOf(LightningInvoiceResponse::class, $estimate);
        $this->assertIsString($estimate->getId());
        $this->assertIsString($estimate->getNodeId());
        $this->assertIsString($estimate->getMemo());
        $this->assertIsString($estimate->getRPreimage());
        $this->assertIsString($estimate->getRHash());
        $this->assertIsInt($estimate->getAmountSats());
        $this->assertIsString($estimate->getPaymentRequest());
    }
}
