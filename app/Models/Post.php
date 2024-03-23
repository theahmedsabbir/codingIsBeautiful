<?php

namespace App\Models;

use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = "active";
    public const STATUS_DRAFT = "draft";
    public const STATUS_DISABLED = "disabled";

    public function postTags()
    {
        return $this->hasMany(PostTag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

}
