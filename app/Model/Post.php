<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'type',
        'slug',
        'title',
        'excerpt',
        'thumbnail',
        'content',
        'published',
        'product_id',
        'user_id', // role = admin
        'category_id'
    ];

    /**
     * [category description]
     *
     * @return [type] [description]
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * [product description]
     *
     * @return [type] [description]
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
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

    /**
     * [comments description]
     *
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->withTrashed();
    }

    /**
     * Get image is the thmbnail of the post
     */
    public function thumbnail()
    {
        return $this->belongsTo(File::class, 'thumbnail', 'id');
    }
}
