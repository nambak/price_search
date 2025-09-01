<?php

namespace App\Crawler;

class MusinsaCrawler extends AbstractCrawler
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://api.musinsa.com/api2/dp/v1/plp/goods';
    }

    /**
     * @param string $title
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $title): array
    {
        $response = $this->client->request('GET', $this->uri, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            ],
            'query'   => [
                'gf' => 'A',
                'keyword' => $title,
                'sortCode' => 'POPULAR',
                'isUsed' => 'false',
                'page' => '1',
                'size' => '60',
                'testGroup' => '',
                'seen' => '0',
                'seenAds' => '',
                'caller' => 'SEARCH',
            ],
        ]);

        $this->response = $response->getBody();

        return $this->parseResults();
    }

    protected function parseResults(): array
    {
        $data = json_decode($this->response, true);
        $results = [];

        if (isset($data['data']['list'])) {
            foreach ($data['data']['list'] as $item) {
                $results[] = [
                    'site'  => '무신사',
                    'title' => $item['brandName'] . ' ' . $item['goodsName'],
                    'image' => $item['thumbnail'] ?? '',
                    'price' => (int)$item['price'],
                    'link'  => $item['goodsLinkUrl'],
                ];
            }
        }

        return $results;
    }
}
