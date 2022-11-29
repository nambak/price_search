<?php


namespace App\Crawler;


use function PHPUnit\Framework\isNull;

class Store29cmCrawler extends AbstractCrawler
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://search-api.29cm.co.kr/api/v4/products?keyword=';
    }

    public function search(string $title): array
    {
        $response = $this->client->request('GET', $this->uri, [
            'query' => [
                'keyword' => $title,
                'limit' => 50,
                'sort' => 'latest'
            ]
        ]);

        $this->response = json_decode($response->getBody());

        return $this->parseResults();
    }

    protected function parseResults(): array
    {
        if (is_null($this->response->data)) {
            return [];
        }

        return array_map(function ($item) {
            return [
                'site' => '29CM',
                'title' => $item->itemName,
                'image' => 'https://img.29cm.co.kr' . $item->imageUrl . '?width=400',
                'price' => $item->lastSalePrice,
                'link' => 'https://www.29cm.co.kr/product/' . $item->itemNo,
            ];
        }, $this->response->data);
    }
}
