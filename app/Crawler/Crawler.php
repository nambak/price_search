<?php


namespace App\Crawler;


class Crawler
{
    private $musinsa;
    private $brandi;
    private $seoulStore;
    private $styleShare;
    private $result;

    public function __construct()
    {
        $this->result = collect([]);
        $this->musinsa = new MusinsaCrawler();
        $this->brandi = new BrandiCrawler();
        $this->seoulStore = new SeoulStoreCrawler();
        $this->styleShare = new StyleShareCrawler();
        $this->store29cm = new Store29cmCrawler();
        $this->brich = new BrichCrawler();
    }

    public function search($keyword)
    {
        $this->result = $this->result->merge($this->musinsa->search($keyword));
        $this->result = $this->result->merge($this->brandi->search($keyword));
        $this->result = $this->result->merge($this->seoulStore->search($keyword));
        $this->result = $this->result->merge($this->styleShare->search($keyword));
        $this->result = $this->result->merge($this->store29cm->search($keyword));
        $this->result = $this->result->merge($this->brich->search($keyword));

        $sorted = $this->result->sortBy('price');

        return $sorted->values()->all();
    }
}
