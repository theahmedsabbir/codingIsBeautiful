<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'index',
            'posts' => Post::orderBy('name', 'asc')->get()
        ];

        return view('backend.post.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'page' => 'create',
        ];

        return view('backend.post.index', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:posts,name',
        ]);

        $lastPost = Post::orderBy('priority')->first();

        $post = new Post();
        $post->name = $request->name;
        $post->slug = Str::slug($request->name);
        $post->priority = $lastPost ? $lastPost->priority + 1 : 1;
        $post->status = $request->status;
        $post->save();

        return redirect()->back()->withSuccess('Post has been successfully created.');
    }

    public function edit(Post $post)
    {
        $data = [
            'page' => 'edit',
            'post' => $post
        ];

        return view('backend.post.index', compact('data'));
    }

    public function update(Request $request, Post $post)
    {
        // create validation for unique post slug
        $this->validate($request, [
            'name' => 'required|unique:posts,name,' . $post->id,
        ]);

        $post->name = $request->name;
        $post->slug = Str::slug($request->name);
        $post->priority = $request->priority;
        $post->status = $request->status;
        $post->save();
        return redirect()->back()->withSuccess('Post has been successfully updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Post has been successfully deleted.');
    }
}
