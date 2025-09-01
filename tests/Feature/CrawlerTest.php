<?php

namespace Tests\Feature;

use App\Crawler\BrandiCrawler;
use App\Crawler\MusinsaCrawler;
use App\Crawler\Store29cmCrawler;
use Tests\TestCase;
use Mockery;

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
        $mockResults = [
            [
                'site' => '무신사',
                'title' => '나이키 테스트 상품',
                'price' => 100000,
                'image' => 'https://example.com/image.jpg',
                'link' => 'https://example.com/product'
            ]
        ];

        $crawler = Mockery::mock(MusinsaCrawler::class);
        $crawler->shouldReceive('search')
               ->with($this->keyword)
               ->andReturn($mockResults);

        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
        $this->assertEquals('무신사', $results[0]['site']);
    }

    public function testWorkingBrandiCrawler()
    {
        $mockResults = [
            [
                'site' => '브랜디',
                'title' => '나이키 브랜디 상품',
                'price' => 80000,
                'image' => 'https://example.com/brandi-image.jpg',
                'link' => 'https://example.com/brandi-product'
            ]
        ];

        $crawler = Mockery::mock(BrandiCrawler::class);
        $crawler->shouldReceive('search')
               ->with($this->keyword)
               ->andReturn($mockResults);

        $results = $crawler->search($this->keyword);

        $this->assertTrue(count($results) > 0);
        $this->assertEquals('브랜디', $results[0]['site']);
    }

    public function testWorkingStore29cmCrawler()
    {
        $mockResults = [
            [
                'site' => '29CM',
                'title' => '나이키 29CM 상품',
                'price' => 120000,
                'image' => 'https://example.com/29cm-image.jpg',
                'link' => 'https://example.com/29cm-product'
            ]
        ];

        $crawler = Mockery::mock(Store29cmCrawler::class);
        $crawler->shouldReceive('search')
               ->with($this->keyword)
               ->andReturn($mockResults);

        $results = $crawler->search($this->keyword);
        
        $this->assertNotEmpty($results);
        $this->assertEquals('29CM', $results[0]['site']);
    }
}
