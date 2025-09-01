<?php

namespace Tests\Feature;

use App\Crawler\BrandiCrawler;
use App\Crawler\MusinsaCrawler;
use App\Crawler\Store29cmCrawler;
use Tests\TestCase;

class CrawlerTest extends TestCase
{
    private $keyword;

    protected function setUp(): void
    {
        $this->keyword = '나이키';

        parent::setUp();
    }

    public function is_working_musinsa_crawler()
    {
        $crawler = new MusinsaCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    public function is_working_brandi_crawler()
    {
        $crawler = new BrandiCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    public function is_working_store_29cm_crawler()
    {
        $crawler = new Store29cmCrawler();
        $results = $crawler->search($this->keyword);
        $this->assertNotEmpty($results);
    }
}
