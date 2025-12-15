<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the editor dashboard.
     */
    public function index()
    {
        return view('editor.dashboard');
    }
}
