<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AgentControllers extends Controller
{
    //
    public function index()
    {
        return View('agent.dashboard');
    }
}
