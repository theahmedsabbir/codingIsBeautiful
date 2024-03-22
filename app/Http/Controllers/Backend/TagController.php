<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    // add tagservice
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $data = [
            'page' => 'index',
            'tags' => Tag::orderBy('name', 'asc')->get()
        ];

        return view('backend.tag.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'page' => 'create',
        ];

        return view('backend.tag.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name',
        ]);

        // store tag via service
        $tagRequest = (object)$request->all();
        $tag = $this->tagService->storeTag($tagRequest);

        return redirect()->back()->withSuccess('Tag has been successfully created.');
    }

    public function edit(Tag $tag)
    {
        $data = [
            'page' => 'edit',
            'tag' => $tag
        ];

        return view('backend.tag.index', compact('data'));
    }

    public function update(Request $request, Tag $tag)
    {
        // create validation for unique tag slug
        $this->validate($request, [
            'name' => 'required|unique:tags,name,' . $tag->id,
        ]);

        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->priority = $request->priority;
        $tag->status = $request->status;
        $tag->save();
        return redirect()->back()->withSuccess('Tag has been successfully updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back()->withSuccess('Tag has been successfully deleted.');
    }
}
