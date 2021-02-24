<?php


namespace App\Crawler;

use GuzzleHttp\Client;

abstract class AbstractCrawler
{
    protected $uri;
    protected $client;
    protected $response;

    public function __construct()
    {
        $this->client = new Client();
    }

    public abstract function search(string $title): array;
    public abstract function parseResults(): array;
}
