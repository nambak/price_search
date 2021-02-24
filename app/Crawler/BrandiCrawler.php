<?php


namespace App\Crawler;


class BrandiCrawler extends AbstractCrawler
{
    private $authorization;
    private $sid;

    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://cf-api-c.brandi.me/v1/web/search/products/';
        $this->authorization = '3b17176f2eb5fdffb9bafdcc3e4bc192b013813caddccd0aad20c23ed272f076_1423639497';
        $this->sid = '16127527525881777F8E0FCC58884860';
    }

    public function search(string $title): array
    {
        $title =  str_replace('/', ' ', $title);

        $response = $this->client->request('GET', $this->uri . $title, [
            'headers' => [
                'authorization' => $this->authorization,
                'sid'           => $this->sid,
            ],
            'query'   => [
                'offset'      => 0,
                'limit'       => 50,
                'order'       => 'relevance',
                'total-count' => true,
            ],
        ]);

        $this->response = json_decode($response->getBody());

        return $this->parseResults();
    }

    public function parseResults(): array
    {
        return array_map(function ($item) {
            return [
                'title' => $item->name,
                'image' => $item->image_thumbnail_url,
                'price' => $item->sale_price,
                'link' => 'https://www.brandi.co.kr/products/' . $item->id,
            ];
        }, $this->response->data);
    }
}
