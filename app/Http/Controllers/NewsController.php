<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class NewsController extends Controller
{
    public function index()
    {
         $trendingNews = Article::latest()->take(5)->pluck('title');

        return view('news.index', compact('trendingNews'));
    }
}
