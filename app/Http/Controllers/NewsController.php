<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Trả về view của trang tin tức
        return view('news.index');
    }
}
