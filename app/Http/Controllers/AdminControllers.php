<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllers extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }
}
