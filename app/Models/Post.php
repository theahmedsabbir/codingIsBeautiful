<?php

namespace App\Models;

use App\Models\PostTag;
use App\Models\Reaction;
use App\Models\Tag;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function totalViews()
    {
        return $this->views()->sum('view');
    }

    public function hasUserViewed()
    {
        return $this->views()->where('ip', request()->ip())->first() !== null;
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function loves()
    {
        return $this->hasMany(Reaction::class)->where('love', true);
    }

    public function hasUserLoved()
    {
        if (Auth::check()) {
            return $this->loves()->where('user_id', Auth::user()->id)->first() !== null;
        }

        return $this->loves()->where('ip', request()->ip())->first() !== null;
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
