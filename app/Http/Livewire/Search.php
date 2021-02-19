<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $keyword;

    protected $rules = [
        'keyword' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.search');
    }

    public function submit()
    {
        //
    }
}
