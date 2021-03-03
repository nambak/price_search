<?php

namespace App\Crawler;

use GuzzleHttp\Client;
use KubAT\PhpSimple\HtmlDomParser;

class MusinsaCrawler
{
    private $uri;
    private $client;
    private $response;

    public function __construct()
    {
        $this->uri = 'https://search.musinsa.com/search/musinsa/integration';
        $this->client = new Client();
    }

    /**
     * @param string $title
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $title): array
    {
        $response = $this->client->request('GET', $this->uri, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
            ],
            'query'   => [
                'type' => '',
                'q'    => $title,
            ],
        ]);

        $this->response = $response->getBody();

        return $this->parseResults();
    }

    private function parseResults()
    {
        $dom = HtmlDomParser::str_get_html($this->response);
        $searchResult = $dom->find('ul[id=searchList]');
        $results = [];

        if (isset($searchResult[0])) {
            $counts = count($searchResult[0]->children());
            for ($i = 0; $i < $counts; $i++) {
                $element = $searchResult[0]->children($i);
                $price = $element->find('p[class=price]')[0];
                $deletedPrice = $price->children(0);
                $priceText = trim(strip_tags(str_replace($deletedPrice, '', $price)));
                $priceText = str_replace('원', '', $priceText);
                $priceText = str_replace(',', '', $priceText);
                $goodsLink = $element->find('a[name=goods_link]')[0];
                $brand = $element->find('p[class=item_title]')[0]->children(0)->innertext;

                $results[] = [
                    'site'  => '무신사',
                    'title' => $brand . ' ' . $goodsLink->title,
                    'image' => $element->find('div[class=list_img]')[0]->find('img')[0]->attr['data-original'],
                    'price' => (int)$priceText,
                    'link'  => $goodsLink->href,
                ];
            }
        }

        return $results;
    }
}
