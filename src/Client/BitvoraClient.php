<?php

declare(strict_types=1);

namespace Bitvora\Client;

use Bitvora\Enum\Currency;
use Bitvora\Response\BalanceResponse;
use Bitvora\Response\CreateLightningAddressResponse;
use Bitvora\Response\CreateOnChainAddressResponse;
use Bitvora\Response\DepositResponse;
use Bitvora\Response\EstimateWithdrawalResponse;
use Bitvora\Response\LightningInvoiceResponse;
use Bitvora\Response\TransactionListResponse;
use Bitvora\Response\WithdrawalResponse;
use Bitvora\Tests\CreateOnChainAddressTest;

class BitvoraClient extends AbstractClient
{
    public function getTransactions(): TransactionListResponse
    {
        $url = $this->getApiUrl() . 'transactions';
        $headers = $this->getRequestHeaders();
        $method = 'GET';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new TransactionListResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function getWithdrawal(string $id): WithdrawalResponse
    {
        $url = $this->getApiUrl() . 'transactions/withdrawals/' . $id;
        $headers = $this->getRequestHeaders();
        $method = 'GET';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new WithdrawalResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function getDeposit(string $id): DepositResponse
    {
        $url = $this->getApiUrl() . 'transactions/deposits/' . $id;
        $headers = $this->getRequestHeaders();
        $method = 'GET';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new DepositResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function getBalance(): BalanceResponse
    {
        $url = $this->getApiUrl() . 'transactions/balance';
        $headers = $this->getRequestHeaders();
        $method = 'GET';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new BalanceResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function getLightningInvoice(string $id): LightningInvoiceResponse
    {
        $url = $this->getApiUrl() . 'bitcoin/deposit/lightning-invoice/' . $id;
        $headers = $this->getRequestHeaders();
        $method = 'GET';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new LightningInvoiceResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function estimateWithdrawal(float $amount, Currency $currency, string $destination): EstimateWithdrawalResponse
    {
        $url = $this->getApiUrl() . 'bitcoin/withdraw/estimate';
        $headers = $this->getRequestHeaders();
        $method = 'POST';
        $body = json_encode([
            'amount' => $amount,
            'currency' => $currency->value,
            'destination' => $destination,
        ], JSON_THROW_ON_ERROR);
        $response = $this->getHttpClient()->request($method, $url, $headers, $body);

        if ($response->getStatus() === 200) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new EstimateWithdrawalResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function createLightningInvoice(float $amount, Currency $currency, string $description, int $expiry_seconds): LightningInvoiceResponse
    {
        $url = $this->getApiUrl() . 'bitcoin/deposit/lightning-invoice';
        $headers = $this->getRequestHeaders();
        $method = 'POST';
        $body = json_encode([
            'amount' => $amount,
            'currency' => $currency->value,
            'description' => $description,
            'expiry_seconds' => $expiry_seconds,
        ], JSON_THROW_ON_ERROR);
        $response = $this->getHttpClient()->request($method, $url, $headers, $body);

        if ($response->getStatus() === 201) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new LightningInvoiceResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function createLightningAddress(): CreateLightningAddressResponse
    {
        $url = $this->getApiUrl() . 'bitcoin/deposit/lightning-address';
        $headers = $this->getRequestHeaders();
        $method = 'POST';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 201) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new CreateLightningAddressResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function createOnChainAddress(): CreateOnChainAddressResponse
    {
        $url = $this->getApiUrl() . 'bitcoin/deposit/on-chain';
        $headers = $this->getRequestHeaders();
        $method = 'POST';
        $body = json_encode([
            'address_type' => 'segwit',
        ], JSON_THROW_ON_ERROR);

        $response = $this->getHttpClient()->request($method, $url, $headers, $body);

        if ($response->getStatus() === 201) {
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new CreateOnChainAddressResponse($decodedResponse['data']);
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function confirmWithdrawal(float $amount, Currency $currency, string $destination): WithdrawalResponse
    {
        $url = $this->getApiUrl() . 'bitcoin/withdraw/confirm';
        $headers = $this->getRequestHeaders();
        $method = 'POST';
        $body = json_encode([
            'amount' => $amount,
            'currency' => $currency->value,
            'destination' => $destination,
        ], JSON_THROW_ON_ERROR);
        $response = $this->getHttpClient()->request($method, $url, $headers, $body);

        if ($response->getStatus() === 201) {
            echo $response->getBody();
            $decodedResponse = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            return new WithdrawalResponse($decodedResponse['data']);
        } else {
            echo $response->getBody();
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }
}
