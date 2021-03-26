<?php

namespace App\Http\Livewire;

use App\Crawler\Crawler;
use App\Crawler\MusinsaRankingKeywordCrawler;
use Livewire\Component;

class Search extends Component
{
    public $keyword;
    public $result;
    protected $queryString = ['keyword'];

    protected $rules = [
        'keyword' => 'required|string',
    ];

    public function render()
    {
        if (is_null($this->keyword)) {
            $crawler = new MusinsaRankingKeywordCrawler();
            $this->keyword = $crawler->getKeyword();

            $this->submit();
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
