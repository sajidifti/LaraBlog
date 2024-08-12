<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // toastr()->error('Hello, world!');

        return view('home.home');
    }
}
