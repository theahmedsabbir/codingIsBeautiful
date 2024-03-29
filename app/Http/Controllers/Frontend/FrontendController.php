<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
// use Illuminate\Support\Facades\Cookie;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        // return "hi";
        $search = request()->search;

        // dd($search);

        // return "hi";
        $postsQuery = Post::where('status', 'active')
            ->orderBy('created_at', 'desc');

        // search with the given string if requested
        //title, body , category , user
        if ($search) {

            $postsQuery->where(function ($postsDB) use ($search) {
                $postsDB->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('body', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('category', function ($category) use ($search) {
                        $category->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'LIKE', '%' . $search . '%');
                    })
                ;
            });
        }

        $posts = $postsQuery->paginate(5);

        // dd($posts);

        return view('frontend.home.index', compact('posts'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        // check and save view
        $this->postService->checkAndSaveView($post);

        $sidebarPosts = $post->category->posts()->inRandomOrder()->limit(5)->get() ?? [];

        return view('frontend.post.show', compact('post', 'sidebarPosts'));
    }

    public function react($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        // check and save view
        $this->postService->react($post);

        return redirect()->back()->with('success', 'Reaction saved');
    }

    public function showTagPosts($slug)
    {
        $selectedTag = Tag::where('slug', $slug)->first();

        if (!$selectedTag) {
            return redirect()->back()->with('error', 'Tag not found');
        }

        $posts = $selectedTag->posts()
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('frontend.home.index', compact('posts', 'selectedTag'));
    }

    public function showCategoryPosts($slug)
    {
        $selectedCateogry = Category::where('slug', $slug)->first();

        if (!$selectedCateogry) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $posts = $selectedCateogry->posts()
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('frontend.home.index', compact('posts', 'selectedCateogry'));
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
