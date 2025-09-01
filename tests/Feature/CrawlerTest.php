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
        parent::setUp();

        $this->keyword = '나이키';
    }

    public function testWorkingMusinsaCrawler()
    {
        $crawler = new MusinsaCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    public function testWorkingBrandiCrawler()
    {
        $crawler = new BrandiCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    public function testWorkingStore29cmCrawler()
    {
        $crawler = new Store29cmCrawler();
        $results = $crawler->search($this->keyword);
        $this->assertNotEmpty($results);
    }
}
