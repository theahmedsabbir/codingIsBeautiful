<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
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
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:tags,name',
        ]);

        $lastTag = Tag::orderBy('priority')->first();

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->priority = $lastTag ? $lastTag->priority + 1 : 1;
        $tag->status = $request->status;
        $tag->save();

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
