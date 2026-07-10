<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function profile()
    {
        return view('profile');
    }
    public function program()
    {
        return view('program');
    }
    public function gallery()
    {
        return view('gallery');
    }
    public function ppdb()
    {
        return view('ppdb');
    }
}