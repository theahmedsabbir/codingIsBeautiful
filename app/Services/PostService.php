<?php

namespace App\Services;

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
}
