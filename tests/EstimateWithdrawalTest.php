<?php

declare(strict_types=1);

namespace Bitvora\Tests;

use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Currency;
use Bitvora\Enum\Network;
use Bitvora\Response\EstimateWithdrawalResponse;
use Bitvora\Response\TransactionListResponse;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class EstimateWithdrawalTest extends TestCase
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

    public function testEstimateWithdrawal(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $estimate = $bitvora->estimateWithdrawal(100, Currency::USD, "tb1q9uzmsvcn44c48x7hzwl5q7q29l7mjeqjn47hcgzw9r6nnu44nneq4narpc");

        $this->assertInstanceOf(EstimateWithdrawalResponse::class, $estimate);
        $this->assertIsString($estimate->getRecipient());
        $this->assertIsString($estimate->getRecipientType());
        $this->assertIsInt($estimate->getAmountSats());
        $this->assertIsFloat($estimate->getFeeSats());
        $this->assertIsFloat($estimate->getSuccessProbability());
    }
}
