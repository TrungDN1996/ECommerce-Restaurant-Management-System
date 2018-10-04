<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lava\Model\OrderDetail;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
        'price',
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
     * [post description]
     *
     * @return [type] [description]
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'product_id', 'id')->withTrashed();
    }

    /**
     * [orderDetails description]
     *
     * @return [type] [description]
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id')->withTrashed();
    }
}
