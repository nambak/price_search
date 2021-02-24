<?php


namespace App\Crawler;


use GuzzleHttp\Cookie\CookieJar;

class SeoulStoreCrawler extends AbstractCrawler
{
    private $origin;
    private $userAgent;
    private $jar;

    /**
     * SeoulStoreCrawler constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://www.seoulstore.com/api/do/searchProducts';
        $this->origin = 'https://www.seoulstore.com';
        $this->userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_2_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36';
        $this->jar = new CookieJar();
    }

    public function search(string $title): array
    {
        $this->getCookie();

        $response = $this->client->request('POST', $this->uri, [
            'cookies'     => $this->jar,
            'headers'     => [
                'User-Agent' => $this->userAgent,
                'origin'     => $this->origin,
                'accept'     => 'application/json',
            ],
            'form_params' => [
                'keyword'     => $title,
                'start'       => 0,
                'count'       => 8,
                'method'      => 'searchProducts',
                'accessToken' => '',
            ],
        ]);

        $this->response = json_decode($response->getBody());

        return $this->parseResults();
    }

    public function parseResults(): array
    {
        return array_map(function ($item) {
            return [
                'title' => $item->descriptions->name,
                'image' => $item->images->list,
                'price' => $item->discountPrice,
                'link' => "https://www.seoulstore.com/products/$item->siteProductId/detail",
            ];
        }, $this->response->items);
    }

    private function getCookie(): void
    {
        $this->client->request('GET', $this->origin, [
            'cookies' => $this->jar,
        ]);
    }
}
