# Bitvora PHP SDK

The Bitvora PHP SDK provides a simple way to interact with the Bitvora API for Bitcoin and Lightning transactions. This SDK supports functionality for handling transactions, deposits, withdrawals, and managing Lightning invoices and addresses.

## Installation

You can install the SDK using Composer:

```bash
composer require bitvora/bitvora-php
```

## Usage

To use the SDK, initialize the `BitvoraClient` with the appropriate API key and `Network` enum (`Network::MAINNET` or `Network::SIGNET`), and then call the methods available for each endpoint.

## Available Methods and Getters

### 1. Get Transactions

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$transactionsResponse = $client->getTransactions();
$transactions = $transactionsResponse->all(); // Returns an array of TransactionResponse objects

foreach ($transactions as $transaction) {
    echo $transaction->getId();
    echo $transaction->getAmountSats();
    echo $transaction->getStatus();
    echo $transaction->getRailType();
}
```

### Available Getters for `TransactionResponse`:

```php
$transaction->getId();
$transaction->getAmountSats();
$transaction->getRecipient();
$transaction->getStatus();
$transaction->getRailType();
$transaction->isSettled();
$transaction->isPending();
$transaction->isFailed();
$transaction->isPendingApproval();
$transaction->isRejected();
$transaction->isDeposit();
$transaction->isWithdrawal();
```

---

### 2. Get Withdrawal by ID

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$withdrawalResponse = $client->getWithdrawal('withdrawal_id');
echo $withdrawalResponse->getId();
echo $withdrawalResponse->getAmountSats();
```

### Available Getters for `WithdrawalResponse`:

```php
$withdrawal->getId();
$withdrawal->getAmountSats();
$withdrawal->getRecipient();
$withdrawal->getStatus();
$withdrawal->getRailType();
$withdrawal->isSettled();
$withdrawal->isPending();
$withdrawal->isFailed();
```

---

### 3. Get Deposit by ID

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$depositResponse = $client->getDeposit('deposit_id');
echo $depositResponse->getId();
echo $depositResponse->getAmountSats();
```

### Available Getters for `DepositResponse`:

```php
$deposit->getId();
$deposit->getAmountSats();
$deposit->getRecipient();
$deposit->getStatus();
$deposit->getRailType();
$deposit->isSettled();
$deposit->isPending();
$deposit->isFailed();
```

---

### 4. Get Balance

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$balanceResponse = $client->getBalance();
echo $balanceResponse->getBalance();
```

### Available Getter for `BalanceResponse`:

```php
$balanceResponse->getBalance(); // Returns the balance in satoshis.
```

---

### 5. Get Lightning Invoice by ID

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$lightningInvoiceResponse = $client->getLightningInvoice('invoice_id');
echo $lightningInvoiceResponse->getPaymentRequest();
```

### Available Getters for `LightningInvoiceResponse`:

```php
$invoice->getId();
$invoice->getMemo();
$invoice->getAmountSats();
$invoice->getPaymentRequest();
$invoice->isSettled();
```

---

### 6. Estimate Withdrawal

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Currency;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$estimateResponse = $client->estimateWithdrawal(1000, Currency::BTC(), 'destination_address');
echo $estimateResponse->getAmountSats();
echo $estimateResponse->getFeeSats();
```

### Available Getters for `EstimateWithdrawalResponse`:

```php
$estimateResponse->getRecipient();
$estimateResponse->getAmountSats();
$estimateResponse->getFeeSats();
$estimateResponse->getSuccessProbability();
```

---

### 7. Create Lightning Invoice

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Currency;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$invoiceResponse = $client->createLightningInvoice(1000, Currency::BTC(), 'Invoice for services', 3600);
echo $invoiceResponse->getPaymentRequest();
```

### Available Getters for `LightningInvoiceResponse`:

```php
$invoice->getId();
$invoice->getMemo();
$invoice->getAmountSats();
$invoice->getPaymentRequest();
$invoice->isSettled();
```

---

### 8. Create Lightning Address

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$lightningAddressResponse = $client->createLightningAddress();
echo $lightningAddressResponse->getAddress();
```

### Available Getters for `CreateLightningAddressResponse`:

```php
$lightningAddress->getId();
$lightningAddress->getHandle();
$lightningAddress->getDomain();
$lightningAddress->getAddress();
```

---

### 9. Create On-Chain Address

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$onChainAddressResponse = $client->createOnChainAddress();
echo $onChainAddressResponse->getAddress();
```

### Available Getters for `CreateOnChainAddressResponse`:

```php
$onChainAddress->getId();
$onChainAddress->getAddress();
```

---

### 10. Confirm Withdrawal

```php
use Bitvora\Client\BitvoraClient;
use Bitvora\Enum\Currency;
use Bitvora\Enum\Network;

$client = new BitvoraClient(Network::MAINNET, 'API_KEY');
$withdrawalResponse = $client->confirmWithdrawal(2100, Currency::SATS(), 'destination_address');
echo $withdrawalResponse->getId();
echo $withdrawalResponse->getStatus();
```

### Available Getters for `WithdrawalResponse`:

```php
$withdrawal->getId();
$withdrawal->getAmountSats();
$withdrawal->getRecipient();
$withdrawal->getStatus();
$withdrawal->getRailType();
$withdrawal->isSettled();
$withdrawal->isPending();
$withdrawal->isFailed();
```

---

## License

This SDK is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
