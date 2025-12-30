<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function publicIndex(Request $request)
    {
        $q = $request->q;

        $posts = Post::latest();



        $posts = $posts->paginate(9);

        $topics = ['laravel', 'python', 'backend', 'frontend', 'ui/ux'];

        return view('blog', compact('posts', 'topics', 'q'));
    }

    public function create()
    {
        return view('admin.add_post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $name);
            $post->image = $name;
        }

        $post->user_id = auth()->id();
        $post->user_name = auth()->user()->name;

        $post->save();

        return redirect()->route('blog');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }


}