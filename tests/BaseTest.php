<?php

declare(strict_types=1);

namespace Bitvora\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
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

    public function testThatAllTheVariablesAreSet(): void
    {
        $this->assertIsString($this->apiKey);
        $this->assertNotEmpty($this->apiKey);
    }
}
