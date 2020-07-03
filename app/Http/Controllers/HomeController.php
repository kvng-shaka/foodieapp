<?php

namespace App\Http\Controllers;
use Illuminate\Http\Facade\Auth;
use \App\Post;
use \App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth()->User()->id;//Gettin logged-in user id
        $user = User::find($user_id);// Getting user details with user id
        $all_user_posts = $user->posts;// Getting all posts related to user with blogs retionship model
        return view('home')->with("myposts",$all_user_posts);
    }
}
