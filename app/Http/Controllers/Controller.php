<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }
}
