<?php

namespace App\Http\Controllers;

use App\Crawler\Crawler;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $crawler = new Crawler();

        return $crawler->search($request->keyword);
    }
}
