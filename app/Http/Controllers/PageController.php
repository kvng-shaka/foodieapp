<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('website.index');
    }

    public function about(){
        return view('website.about');
    }

    public function blog(){
        return view('website.blog');
    }

    public function contact(){
        return view('website.contact');
    }
}
