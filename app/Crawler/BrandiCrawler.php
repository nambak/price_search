<?php

namespace App\Crawler;

use JsonException;

class BrandiCrawler extends AbstractCrawler
{
    private $authorization;
    private $sid;

    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://capi.brandi.co.kr/v1/web/search/products/';

        $this->authorization = config('services.brandi.authorization');
        $this->sid = config('services.brandi.sid');
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

        if ($response->getStatusCode() !== 200) {
            $this->response = '';
            return [];
        }

        $this->response = (string) $response->getBody();
        return $this->parseResults();
    }

    protected function parseResults(): array
    {
        try {
            $data = json_decode($this->response, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return [];
        }

        if (!isset($data['data']['products']) || !is_array($data['data']['products'])) {
            return [];
        }

        return array_map([$this, 'mapProductData'], $data['data']['products']);
    }

    protected function mapProductData(array $item): array
    {
        return [
            'site'  => '브랜디',
            'title' => $item['name'] ?? '',
            'image' => $item['image_thumbnail_url'] ?? $item['web_image_thumbnail_url'] ?? '',
            'price' => isset($item['sale_price']) ? (int)$item['sale_price'] : 0,
            'link'  => isset($item['id']) ? 'https://www.brandi.co.kr/products/' . $item['id'] : '',
        ];
    }
}
