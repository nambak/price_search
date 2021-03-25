<?php

namespace App\Http\Livewire;

use App\Crawler\Crawler;
use App\Crawler\MusinsaRankingKeywordCrawler;
use Livewire\Component;

class Search extends Component
{
    public $keyword;
    public $result;

    protected $rules = [
        'keyword' => 'required|string',
    ];

    public function render()
    {
        if (! $this->keyword) {
            $keywordCrawler = new MusinsaRankingKeywordCrawler();
            $this->keyword = $keywordCrawler->getKeyword();

            $crawler = new Crawler();
            $this->result = $crawler->search($this->keyword);
        }

        return view('livewire.search');
    }

    public function submit()
    {
        $this->validate();

        $crawler = new Crawler();
        $this->result = $crawler->search($this->keyword);
    }
}
