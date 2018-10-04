<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'slug',
        'name',
        'description',
        'type',
        'parent_id'
    ];

    /**
     * [products description]
     *
     * @return [type] [description]
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->withTrashed();
    }

    /**
     * [posts description]
     *
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id')->withTrashed();
    }
}
