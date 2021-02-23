<?php

namespace App\Http\Livewire;

use App\Crawler\MusinsaCrawler;
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

        $this->result['무신사'] = (new MusinsaCrawler())->search($this->keyword);
        $this->result['스타일쉐어'] = (new StyleShareCrawler())->search($this->keyword);
    }
}
