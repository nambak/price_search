<?php

namespace App\Http\Controllers;

use App\Crawler\BrandiCrawler;
use App\Crawler\MusinsaCrawler;
use App\Crawler\SeoulStoreCrawler;
use App\Crawler\StyleShareCrawler;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string'
        ]);

        $result = [];

        $result['무신사'] = (new MusinsaCrawler())->search($request->keyword);
        $result['스타일쉐어'] = (new StyleShareCrawler())->search($request->keyword);
        $result['브랜디'] = (new BrandiCrawler())->search($request->keyword);
        $result['서울스토어'] = (new SeoulStoreCrawler())->search($request->keyword);

        return $result;
    }
}
