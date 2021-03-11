<?php

namespace App\Crawler;

class StyleShareCrawler extends AbstractCrawler
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'https://search-api.styleshare.kr/rest/v3/goods';
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

    protected function parseResults(): array
    {
        return array_map(function ($item) {
            return [
                'site'        => '스타일쉐어',
                'title'       => $item->name,
                'image'       => 'https://usercontents-c.styleshare.io/images/' . $item->picture->id . '/560x-',
                'price'       => $item->price,
                'link'        => 'https://www.styleshare.kr/goods/' . $item->id,
                'couponPrice' => $this->calculateCouponPrice($item->id, $item->price),
            ];
        }, $this->response->data);
    }

    private function calculateCouponPrice($id, $price)
    {
        $couponPrice = 0;
        $coupons = collect($this->getCoupons($id));
        $coupon = $coupons->firstWhere('minPurchasingPrice', '<', $price);

        if ($coupon) {
            if ($coupon->saleType === 'won') {
                $couponPrice = $price - $coupon->saleValue;
            } else if ($coupon->saleType === 'percent') {
                $couponPrice = $price - $price * ($coupon->saleValue / 100);
            }
        }

        return $couponPrice;
    }

    private function getCoupons($id)
    {
        $response = $this->client->request('GET', "https://www.styleshare.kr/goods/$id/coupons", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody());

        return $result->coupons;
    }
}
