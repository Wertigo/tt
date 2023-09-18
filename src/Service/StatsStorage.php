<?php

declare(strict_types=1);

namespace App\Service;

use Predis\Client;

class StatsStorage
{
    private const COLLECTION_NAME = 'countries';

    private Client $client;

    public function __construct($host, $port)
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host' => $host,
            'port' => $port,
        ]);
    }

    public function hit(string $key): void
    {
        $this->client->hincrby(self::COLLECTION_NAME, $key, 1);
    }

    public function getHits(): array
    {
        return array_map(function ($value) {
            return (int) $value;
        }, $this->client->hgetall(self::COLLECTION_NAME));
    }
}