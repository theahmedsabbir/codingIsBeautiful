<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagService
{
    // add another service here 

    // private $productTypeResourceTransformer;

    // public function __construct(
    //     ProductTypeResourceTransformer $productTypeResourceTransformer
    // ) {
    //     $this->productTypeResourceTransformer = $productTypeResourceTransformer;
    // }

    // store tag from given request
    public function storeTag($tagRequest)
    {
        $lastTag = Tag::orderBy('priority')->first();

        $tag = new Tag();
        $tag->name = $tagRequest->name;
        $tag->slug = Str::slug($tagRequest->name);
        $tag->priority = $lastTag ? $lastTag->priority + 1 : 1;
        $tag->status = $tagRequest->status;
        $tag->save();

        return $tag;
    }
}
