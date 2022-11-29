<?php

namespace Tests\Feature;

use App\Crawler\BrandiCrawler;
use App\Crawler\BrichCrawler;
use App\Crawler\MusinsaCrawler;
use App\Crawler\MusinsaRankingKeywordCrawler;
use App\Crawler\SeoulStoreCrawler;
use App\Crawler\Store29cmCrawler;
use Tests\TestCase;

class CrawlerTest extends TestCase
{
    private $keyword;

    protected function setUp(): void
    {
        $this->keyword = '나이키 에어 테일윈드 79';
    }

    /** @test */
    public function is_working_musinsa_crawler()
    {
        $crawler = new MusinsaCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    /** @test */
    public function is_working_brandi_crawler()
    {
        $crawler = new BrandiCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    /** @test */
    public function is_working_seoul_store_crawler()
    {
        $crawler = new SeoulStoreCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
    }

    /** @test */
    public function is_working_store_29cm_crawler()
    {
        $crawler = new Store29cmCrawler();
        $results = $crawler->search($this->keyword);
        $this->assertNotEmpty($results);
    }

    /** @test */
    public function is_working_brich_crawler()
    {
        $crawler = new BrichCrawler();
        $results = $crawler->search($this->keyword);

        $this->assertNotEmpty($results);
    }

    /** @test */
    public function is_working_musinsa_keyword_ranking_crawler()
    {
        $crawler = new MusinsaRankingKeywordCrawler();

        $results = $crawler->getKeyword();

        $this->assertIsString($results);
    }


}
