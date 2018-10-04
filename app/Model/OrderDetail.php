<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity'
    ];

    /**
     * [order description]
     *
     * @return [type] [description]
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id')->withTrashed();
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
}
