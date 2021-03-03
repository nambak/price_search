<?php

namespace App\Http\Livewire;

use App\Crawler\BrandiCrawler;
use App\Crawler\MusinsaCrawler;
use App\Crawler\SeoulStoreCrawler;
use App\Crawler\StyleShareCrawler;
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
        return view('livewire.search');
    }

    public function submit()
    {
        $this->validate();
        $result = collect([]);

        $result = $result->merge((new MusinsaCrawler())->search($this->keyword));
        $result = $result->merge((new StyleShareCrawler())->search($this->keyword));
        $result = $result->merge((new BrandiCrawler())->search($this->keyword));
        $result = $result->merge((new SeoulStoreCrawler())->search($this->keyword));

        $sorted = $result->sortBy('price');
        $this->result = $sorted->values()->all();
    }
}
