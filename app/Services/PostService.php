<?php

namespace App\Services;

use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class PostService
{

    // check if this ip has viewed this post
    // if seen, increase view count
    // else add this ip for this post view
    public function checkAndSaveView($post)
    {
        $ip = request()->ip();

        $view = $post->views->where('ip', $ip)->first();

        if (!$view) {
            $post->views()->create([
                'post_id' => $post->id,
                'ip' => $ip,
            ]);
        } else {
            $view->update(['view' => $view->view + 1]);
        }

        return $view;
    }

    // check if system has auth user
    // if yes then search by user, in reactions table for this post , where love is given
    // if there is none, add one
    // if there is , delete it
    // if no auth user then do same with ip
    public function react($post)
    {
        $user = Auth::user() ?? null;
        $ip = request()->ip();

        $reactionQuery = Reaction::where('post_id', $post->id)
            ->where('love', true);

        if ($user) {
            $reactionQuery->where('user_id', $user->id);
        } else {
            $reactionQuery->where('ip', $ip);
        }

        $reaction = $reactionQuery->first();

        if ($reaction) {
            $reaction->delete();

            return null;
        } else {
            $newReaction = $post->reactions()->create([
                'user_id' => $user->id ?? null,
                'post_id' => $post->id,
                'ip' => $ip,
                'love' => true,
                'comment' => null,
            ]);

            return $newReaction;
        }
    }
}
