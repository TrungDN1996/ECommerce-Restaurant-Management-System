<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'size', 'type', 'client_name', 'user_id'
    ];

    /**
     * Get the post that own the thumbnail
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'thumbnail', 'id')->withTrashed();
    }

    /**
     * Get the user that own the file
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
