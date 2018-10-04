<?php

namespace Lava\Observers;

use Lava\Model\User;
use Lava\Model\Post;

class UserObserver
{
    /**
     * Handle the user "restored" event.
     *
     * @param  \Lava\Model\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        foreach ($user->comments as $comment)
            $comment->restore();
    }

    /**
     * Hanlde the user "deleting" event
     *
     * @param \Lava\Model\User
     * @return void
     */
    public function deleting(User $user)
    {
        if ($user->isForceDeleting()){
            // delete associated comment
            foreach ($user->comments as $comment)
                $comment->forceDelete();

            // delete associated order
            foreach ($user->orders as $order)
                $order->forceDelete();


            if ($user->role == 'admin') {
                foreach ($user->posts as $post)
                    $post->forcedelete();

                foreach ($user->files as $file)
                    $file->delete();

            }
        } else {
            // solf delete associated comment
            foreach ($user->comments as $comment) :
                $comment->delete();
            endforeach;
        }
    }
}
