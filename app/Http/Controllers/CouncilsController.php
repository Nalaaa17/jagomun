<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouncilsController extends Controller
{
    /**
     * Display the Councils page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('councils');
    }
}
