<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function show($id)
    {
        return view('components.show_divisi', ['id' => $id]);
    }
}
