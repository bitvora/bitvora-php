<?php

declare(strict_types=1);

namespace Bitvora\Tests;

use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;
use Bitvora\Response\TransactionListResponse;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
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

    public function testGetTransactions(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $transactions = $bitvora->getTransactions();

        $this->assertInstanceOf(TransactionListResponse::class, $transactions);
        $this->assertIsArray($transactions->all());
        foreach ($transactions->all() as $transaction) {
            $this->assertIsString($transaction->getId());
            $this->assertIsString($transaction->getRailType());
        }
    }

    public function testGetWithdrawal(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $withdrawal = $bitvora->getWithdrawal("c95f2ec4-f027-49ca-9b73-1850edb86730");

        $this->assertIsString($withdrawal->getId());
        $this->assertIsInt($withdrawal->getAmountSats());
        $this->assertIsString($withdrawal->getRecipient());
        $this->assertIsString($withdrawal->getNetworkType());
        $this->assertIsString($withdrawal->getRailType());
        $this->assertIsString($withdrawal->getStatus());
        $this->assertIsArray($withdrawal->getLightningPayment());
        if ($withdrawal->getChainTxId() !== null) {
            $this->assertIsString($withdrawal->getChainTxId());
        }
        $this->assertIsString($withdrawal->getCreatedAt());
    }

    public function testGetDeposit(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $deposit = $bitvora->getDeposit("f040986a-6031-4c71-90c0-3d164a1b2554");

        $this->assertIsString($deposit->getId());
        $this->assertIsInt($deposit->getAmountSats());
        $this->assertIsString($deposit->getRecipient());
        $this->assertIsString($deposit->getNetworkType());
        $this->assertIsString($deposit->getRailType());
        $this->assertIsString($deposit->getStatus());
        if ($deposit->getChainTxId() !== null) {
            $this->assertIsString($deposit->getChainTxId());
        }
        if ($deposit->getLightningInvoiceId() !== null) {
            $this->assertIsString($deposit->getLightningInvoiceId());
        }
        $this->assertIsString($deposit->getCreatedAt());
    }

    public function testGetBalance(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $balance = $bitvora->getBalance();

        $this->assertIsInt($balance->getBalance());
    }

    public function testGetLightningInvoice(): void
    {
        $bitvora = new BitvoraClient(Network::SIGNET, $this->apiKey);
        $invoice = $bitvora->getLightningInvoice("ff567171-7795-4fab-8fab-e8cf2a59b117");

        $this->assertIsString($invoice->getId());
    }
}
