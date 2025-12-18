<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            return view('admin.dashboard');
        }

        if ($user->hasRole('Editor')) {
            return view('editor.dashboard');
        }

        return view('author.dashboard');
    }
}
