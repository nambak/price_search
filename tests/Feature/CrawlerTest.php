<?php

namespace Tests\Feature;

use App\Crawler\MusinsaCrawler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrawlerTest extends TestCase
{
    /** @test */
    public function is_working_musinsa_crawler()
    {
        $results = MusinsaCrawler::search('나이키 테일윈드');

        $this->assertTrue(! ! $results);
    }

}
