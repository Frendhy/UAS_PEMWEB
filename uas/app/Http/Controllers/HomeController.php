<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('hmifpage'); // This will load the `resources/views/hmifpage.blade.php`
    }
}
