<?php

namespace Lava\Observers;

use Lava\Model\Post;

class PostObserver
{
    public function restored()
    {
        foreach ($post->comments as $comment) {
            $comment->restore();
        }
    }
    /**
     * [deleting description]
     *
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function deleting(Post $post)
    {

        if ($post->isForceDeleting()) {
            foreach ($post->comments as $comment)
                $comment->forceDelete();
        } else {
            foreach ($post->comments as $comment)
                $comment->delete();
        }
    }
}
