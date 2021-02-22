<?php

namespace App\Http\Livewire;

use App\Crawler\MusinsaCrawler;
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

        $this->result = MusinsaCrawler::search($this->keyword);
    }
}
