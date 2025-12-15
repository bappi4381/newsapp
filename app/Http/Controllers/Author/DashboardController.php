<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the author dashboard.
     */
    public function index()
    {
        return view('author.dashboard');
    }
}
