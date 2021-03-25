<?php


namespace App\Crawler;


use GuzzleHttp\Client;
use KubAT\PhpSimple\HtmlDomParser;

class MusinsaRankingKeywordCrawler
{
    protected $client;
    protected $uri;
    protected $response;

    public function __construct()
    {
        $this->client = new Client();
        $this->uri = 'https://search.musinsa.com/ranking/keyword';
    }

    public function getKeyword()
    {
        $this->getHtml();

        return $this->parseHtml();
    }

    protected function getHtml()
    {
        $response = $this->client->request('GET', $this->uri);

        $this->response = $response->getbody();
    }

    protected function parseHtml()
    {
        $dom = HtmlDomParser::str_get_html($this->response);
        $rankingList = $dom->find('div[class=tbl_box_sranking]', 0)->children(0)->first_child()->first_child();

        return $rankingList->title;
    }
}
