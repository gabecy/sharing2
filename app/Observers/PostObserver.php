<?php

namespace App\Observers;

use App\Jobs\SendPostUpdatedJob;
use App\Models\Post;
use App\Services\PostService;


class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @param PostService $postService
     * @return void
     */
    public function updated(Post $post, PostService $postService)
    {
        foreach($post->authors as $author){
            $author->words_count = $postService->calculateAuthorWords($author);
            $author->save();
        }

        dispatch(new SendPostUpdatedJob($post));
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
