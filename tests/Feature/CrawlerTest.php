<?php

namespace Tests\Feature;

use App\Crawler\BrandiCrawler;
use App\Crawler\MusinsaCrawler;
use App\Crawler\SeoulStoreCrawler;
use App\Crawler\StyleShareCrawler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrawlerTest extends TestCase
{
    /** @test */
    public function is_working_musinsa_crawler()
    {
        $crawler = new MusinsaCrawler();
        $results = $crawler->search('나이키 에어 테일윈드');

        $this->assertTrue(count($results) > 0);
    }

    /** @test */
    public function is_working_style_share_crawler()
    {
        $crawler = new StyleShareCrawler();
        $results = $crawler->search('나이키 에어 테일윈드');

        $this->assertTrue(count($results) > 0);
    }

    /** @test */
    public function is_working_brandi_crawler()
    {
        $crawler = new BrandiCrawler();
        $results = $crawler->search('나이키 에어 테일윈드');

        $this->assertTrue(count($results) > 0);
    }

    /** @test */
    public function is_working_seoul_store_crawler()
    {
        $crawler = new SeoulStoreCrawler();
        $results = $crawler->search('나이키 에어 테일윈드 79');

        $this->assertTrue(count($results) > 0);
    }
}
