<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\Post;
// use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\PostTag;
use Illuminate\Support\Str;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function new()
    {
        // return "hi";
        return view('frontend.home.new');
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
        $post->user_id = 1; //change it later
        $post->category_id = $request->category_id;
        $post->cover_image = $coverImageName;
        $post->title = $request->title;
        $post->body = $request->body;
        if (isset($request->status)) $post->status = $request->status;
        $post->save();

        // add all the tags to relation
        if (count($request->tags) > 0) {
            foreach ($request->tags as $key => $tagName) {

                // search with name
                $tag = null;
                $tag = Tag::where('name', $tagName)->first();

                // if a tag doesnt exist create it and make relation 
                if (!$tag) {
                    $tagRequest = (object)[
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

        return redirect()->back()->withSuccess('Post created.');
    }
}
