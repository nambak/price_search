<?php


namespace App\Crawler;


class Crawler
{
    private $musinsa;
    private $brandi;
    private $seoulStore;
    private $result;

    public function __construct()
    {
        $this->result = collect([]);
        $this->musinsa = new MusinsaCrawler();
        $this->brandi = new BrandiCrawler();
        $this->seoulStore = new SeoulStoreCrawler();
        $this->store29cm = new Store29cmCrawler();
    }

    public function search($keyword)
    {
        $this->result = $this->result->concat($this->musinsa->search($keyword));
        $this->result = $this->result->concat($this->brandi->search($keyword));
        $this->result = $this->result->concat($this->seoulStore->search($keyword));
        $this->result = $this->result->concat($this->store29cm->search($keyword));

        $sorted = $this->result->sortBy('price');

        return $sorted->values()->all();
    }
}
