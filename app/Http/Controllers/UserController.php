<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{
    public function showDataInHome()
    {
        $posts = Post::latest()->take(4)->get();

        return view('home', ['posts' => $posts]);
    }

    public function home(Request $request)
    {
        if ($request->user()->usertype == 'user') {
            return view('dashboard');
        }

        return redirect()->route('admin.dashboard');
    }

    public function index()
    {
        $posts = Post::latest()->get();

        return view('admin.dashboard', ['posts' => $posts]);
    }
}