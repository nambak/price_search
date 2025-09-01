<?php

namespace App\Livewire;

use App\Crawler\Crawler;
use Livewire\Component;

class Search extends Component
{
    public    $keyword;
    public    $result;
    protected $queryString = ['keyword'];

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

        $crawler = new Crawler();

        $this->result = $crawler->search($this->keyword);
    }
}