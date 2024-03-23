<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
// use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function index()
    {
        // return "hi";

        // return "hi";
        $posts = Post::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($posts);

        return view('frontend.home.index', compact('posts'));
    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        return view('frontend.post.show', compact('post'));
    }

    public function language($code)
    {
        // update session
        session()->put('language_code', $code);

        // update cookie
        setcookie('googtrans', null);
        setcookie('googtrans', '/en/' . Session::get('language_code'));

        return redirect()->back();
    }
}
