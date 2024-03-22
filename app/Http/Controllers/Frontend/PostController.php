<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
// use Illuminate\Support\Facades\Cookie;
use App\Models\PostTag;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function new ()
    {
        // return "hi";
        return view('frontend.post.edit');
    }

    public function store(Request $request)
    {
        // make and append slug to request
        $slug = Str::slug($request->title);
        $request['slug'] = $slug . '-' . time();

        // dd($request->all());

        // validate title or slug
        // image size should be controlled

        // $this->validate($request, [
        //     'name' => 'required',
        //     'sub_cat_id' => 'required|integer',
        //     'brand_id' => 'required|integer',
        //     'price' => 'required',
        //     'qty' => 'required',
        //     'short_description' => 'required',
        //     'long_description' => 'required',
        // ]);

        // move and get name for cover image
        $coverImageName = null;
        if ($request->hasfile('cover_image')) {
            $coverImage = $request->cover_image;
            $coverImageName = $slug . time() . uniqid() . '.' . $coverImage->extension();
            $coverImage->move('posts', $coverImageName);
        }

        // create new post
        $post = new Post();

        $post->slug = $request->slug;
        $post->user_id = Auth::user()->id; //change it later
        $post->category_id = $request->category_id;
        $post->cover_image = $coverImageName;
        $post->title = $request->title;
        $post->body = $request->body ?? ' ';
        if (isset($request->status)) {
            $post->status = $request->status;
        }

        $post->save();

        // add all the tags to relation
        if (count($request->tags) > 0) {
            foreach ($request->tags as $key => $tagName) {

                // search with name
                $tag = null;
                $tag = Tag::where('name', $tagName)->first();

                // if a tag doesnt exist create it and make relation
                if (!$tag) {
                    $tagRequest = (object) [
                        'name' => $tagName,
                        'status' => Tag::STATUS_ACTIVE,
                    ];

                    $tag = $this->tagService->storeTag($tagRequest);
                }

                // append this tag to post relation
                $postTag = new PostTag;
                $postTag->post_id = $post->id;
                $postTag->tag_id = $tag->id;
                $postTag->save();
            }
        }

        return redirect()->route('dashboard')->withSuccess('Post created.');
    }

    public function dashboard()
    {
        // return "hi";
        return view('frontend.home.dashboard');
    }

    public function editPost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $postTags = $post->tags->pluck('name')->toArray() ?? [];
        return view('frontend.post.edit', compact('post', 'postTags'));
    }

    public function updatePost(Request $request, $slug)
    {

        // get post
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        // make and append slug to request
        $slug = Str::slug($request->title);
        $request['slug'] = $slug . '-' . time();

        // move and get name for cover image
        $coverImageName = $post->cover_image;
        if ($request->hasfile('cover_image')) {
            $coverImage = $request->cover_image;
            $coverImageName = $slug . time() . uniqid() . '.' . $coverImage->extension();
            $coverImage->move('posts', $coverImageName);

            // remove old cover image
            unlink('posts/' . $post->cover_image);
        }

        // update post
        $post->slug = $request->slug;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;
        $post->cover_image = $coverImageName;
        $post->title = $request->title;
        $post->body = $request->body ?? ' ';
        if (isset($request->status)) {
            $post->status = $request->status;
        }

        $post->save();

        // add all the tags to relation
        if (isset($request->tags) && count($request->tags) > 0) {

            // remove all the tags that doesnt exist in this request
            $oldPostTags = $post->tags;

            $deletableTagNames = array_diff($oldPostTags->pluck('name')->toArray(), $request->tags);

            if (count($deletableTagNames) > 0) {
                foreach ($deletableTagNames as $deletableTagName) {
                    $deletableTag = $oldPostTags->where('name', $deletableTagName)->first() ?? null;

                    if ($deletableTag) {
                        $post->postTags->where('tag_id', $deletableTag->id)->first()->delete();
                    }
                }
            }

            // add the rest of request tags to relation
            foreach ($request->tags as $key => $tagName) {

                // search with name
                $tag = null;
                $tag = Tag::where('name', $tagName)->first();

                // if a tag doesnt exist create it and make relation
                if (!$tag) {
                    $tagRequest = (object) [
                        'name' => $tagName,
                        'status' => Tag::STATUS_ACTIVE,
                    ];

                    $tag = $this->tagService->storeTag($tagRequest);
                }

                // find if this tag already exists in relation
                // if doesnt exist then append it with relation
                if (!$post->postTags->where('tag_id', $tag->id)->first()) {
                    $postTag = new PostTag;
                    $postTag->post_id = $post->id;
                    $postTag->tag_id = $tag->id;
                    $postTag->save();
                }

            }
        } else {
            // remove all the tags
            $post->postTags()->delete();
        }

        return redirect()->route('dashboard')->withSuccess('Post updated.');
    }

    public function deletePost(Request $request, $slug)
    {

        // get post
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        // remove post image
        if ($post->cover_image && file_exists('posts/' . $post->cover_image)) {
            unlink('posts/' . $post->cover_image);
        }
        // dd('e');

        // remove post
        $post->delete();

        return redirect()->route('dashboard')->withSuccess('Post deleted.');
    }
}
