<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function testPriceSearchApi()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', '/api/search', ['keyword' => '나이키']);

        $response->assertStatus(200);

        $searchResults = json_decode($response->getContent());

        $this->assertTrue(count($searchResults) > 0);
    }
}
