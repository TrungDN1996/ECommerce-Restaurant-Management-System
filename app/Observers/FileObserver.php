<?php

namespace Lava\Observers;

use Lava\Model\File;
use Lava\Model\Post;

class FileObserver
{
    /**
     * Handle the file "deleting" event.
     *
     * @param  \Lava\Model\File  $file
     * @return void
     */
    public function deleting(File $file)
    {
        foreach ($file->posts as $post) {
            $post = Post::find($post->id);
            $post->thumbnail = null;
            $post->save();
        }
    }
}
