<?php

namespace Lava\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'address',
        'phone',
        'type',
        'level',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [posts description]
     *
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id')->withTrashed();
    }

    /**
     * [comments description]
     *
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id')->withTrashed();
    }

    /**
     * [orders description]
     *
     * @return [type] [description]
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->withTrashed();
    }

    /**
     * Get all files of specific user
     */
    public function files()
    {
        return $this->hasMany(File::class, 'user_id', 'id');
    }

}
