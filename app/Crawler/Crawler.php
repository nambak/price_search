<?php


namespace App\Crawler;


class Crawler
{
    private $musinsa;
    private $brandi;
    private $result;
    private $store29cm;

    public function __construct()
    {
        $this->result = collect([]);
        $this->musinsa = new MusinsaCrawler();
        $this->brandi = new BrandiCrawler();
        $this->store29cm = new Store29cmCrawler();
    }

    public function search($keyword)
    {
        try {
            $this->result = $this->result->concat($this->musinsa->search($keyword));
        } catch (\Exception $e) {
            // 무신사 크롤러 실패 시 로그만 남기고 계속 진행
            \Log::warning('Musinsa crawler failed: ' . $e->getMessage());
        }

        try {
            $this->result = $this->result->concat($this->brandi->search($keyword));
        } catch (\Exception $e) {
            // 브랜디 크롤러 실패 시 로그만 남기고 계속 진행
            \Log::warning('Brandi crawler failed: ' . $e->getMessage());
        }

        try {
            $this->result = $this->result->concat($this->store29cm->search($keyword));
        } catch (\Exception $e) {
            // Store29cm 크롤러 실패 시 로그만 남기고 계속 진행
            \Log::warning('Store29cm crawler failed: ' . $e->getMessage());
        }

        $sorted = $this->result->sortBy('price');

        return $sorted->values()->all();
    }
}
