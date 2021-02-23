<?php

namespace App\Crawler;

use GuzzleHttp\Client;

class StyleShareCrawler
{
    private $uri;
    private $client;
    protected $response;

    public function __construct()
    {
        $this->uri = 'https://search-api.styleshare.kr/rest/v3/goods';
        $this->client = new Client();
    }

    public function search(string $title): array
    {
        $response = $this->client->request('GET', $this->uri, [
            'query' => [
                'keyword' => $title,
                'limit'   => 12,
            ],
        ]);

        $this->response = json_decode($response->getBody());

        return $this->parseResults();
    }

    private function parseResults()
    {
        return array_map(function ($item) {
            return [
                'title' => $item->name,
                'image' => 'https://usercontents-c.styleshare.io/images/' . $item->picture->id . '/560x-',
                'price' => $item->price,
                'link' => 'https://www.styleshare.kr/goods/' . $item->id,
            ];
        }, $this->response->data);
    }
}
