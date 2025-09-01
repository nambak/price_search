<?php

namespace App\Crawler;


class BrandiCrawler extends AbstractCrawler
{
    private $authorization;
    private $sid;

    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://capi.brandi.co.kr/v1/web/search/products/';
        $this->authorization = config('crawler.brandi.authorization') ?: '3b17176f2eb5fdffb9bafdcc3e4bc192b013813caddccd0aad20c23ed272f076_1423639497';
        $this->sid = config('crawler.brandi.sid') ?: '16127527525881777F8E0FCC58884860';
    }

    public function search(string $title): array
    {
        $title = str_replace('/', ' ', $title);
        $encodedTitle = urlencode($title);

        $response = $this->client->request('GET', $this->uri . $encodedTitle, [
            'headers' => [
                'authorization' => $this->authorization,
                'sid'           => $this->sid,
            ],
            'query'   => [
                'offset'      => 0,
                'limit'       => 50,
                'order'       => 'popular',
                'total-count' => 'true',
                'is-first'    => 'true',
                'version'     => '2210',
            ],
        ]);

        $this->response = json_decode($response->getBody(), true);

        return $this->parseResults();
    }

    protected function parseResults(): array
    {
        $results = [];

        if (isset($this->response['data']['products'])) {
            foreach ($this->response['data']['products'] as $item) {
                $results[] = [
                    'site'  => '브랜디',
                    'title' => $item['name'],
                    'image' => $item['image_thumbnail_url'] ?? $item['web_image_thumbnail_url'] ?? '',
                    'price' => $item['sale_price'],
                    'link'  => 'https://www.brandi.co.kr/products/' . $item['id'],
                ];
            }
        }

        return $results;
    }
}
