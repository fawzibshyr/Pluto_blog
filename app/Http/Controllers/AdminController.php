<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function editIndex()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.editpost', compact('posts'));
    }


    public function deleteIndex()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.deletepost', compact('posts'));
    }


    public function editPostPage($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.editpost', compact('post'));
    }


    public function updatePostSave(Request $request, $id)
    {
        $post = Post::findOrFail($id);


        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'nullable|image|max:2048',
        ]);


        $post->title = $request->title;
        $post->description = $request->description;


        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('img'), $imgName);
            $post->image = $imgName;
        }

        $post->save();

        return redirect()->route('admin.posts.edit.index')->with('status', 'Post updated!');
    }

    public function deletePostDo($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.delete.index')->with('danger', 'Post deleted!');
    }
}