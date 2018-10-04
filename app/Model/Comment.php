<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comments';
    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id'
    ];

    /**
     * [post description]
     *
     * @return [type] [description]
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id')->withTrashed();
    }

    /**
     * [user description]
     *
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
