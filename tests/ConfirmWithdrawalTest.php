<?php

declare(strict_types=1);

namespace Bitvora\Tests;

use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Currency;
use Bitvora\Enum\Network;
use Bitvora\Response\WithdrawalResponse;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class ConfirmWithdrawalTest extends TestCase
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

    public function testConfirmWithdrawal(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $withdrawal = $bitvora->confirmWithdrawal(21, Currency::SATS, "lntbs210n1pnsg5qfpp5lxpfkvxlv9tchtfq6hj9yh8yz0weqw9khysc79qlfuhkmjxuem0qdqcgf5hgan0wfsjqjtwwehkjcm9cqzzsxqrrsssp5x576m5gdmzy0dsuptztfxxzgav5d9454l9rzyrxcxp5tq5xx5r5s9qxpqysgqedw5dujfatxvchrdgpuvlv827y9zk3e4htgfl8fywmypha90q5jx99swkxkaj3v0en5q3qd59wzhjwarwclnmvfxkv0yr02c8ugyehcqss8qwf");

        $this->assertInstanceOf(WithdrawalResponse::class, $withdrawal);
        $this->assertIsString($withdrawal->getRecipient());
        $this->assertIsString($withdrawal->getRailType());
        $this->assertIsInt($withdrawal->getAmountSats());
    }
}
