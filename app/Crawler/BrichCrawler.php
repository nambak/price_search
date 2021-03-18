<?php


namespace App\Crawler;


class BrichCrawler extends AbstractCrawler
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://brich.co.kr/api/search/product';
    }

    public function search(string $title): array
    {
        $response = $this->client->request('POST', $this->uri, [
            'json' => [
                'input' => $title,
                'sort'  => 'accuracy',
                'size'  => 20,
            ],
        ]);

        $this->response = json_decode($response->getBody());

        return $this->parseResults();
    }

    protected function parseResults(): array
    {
        return array_map(function ($item) {
            return [
                'site'  => '브리치',
                'title' => $item->name,
                'image' => $item->image_url->thumb,
                'price' => $item->event_discounted_price,
                'link'  => 'https://brich.co.kr/product/' . $item->optimus_id,
            ];
        }, $this->response->hits->hits);
    }
}
