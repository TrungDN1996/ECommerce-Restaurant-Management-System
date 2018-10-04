<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'type',
        'people',
        'ship',
        'note',
        'status',
        'total',
        'ordered_at',
        'received_at',
        'service_id',
        'coupon_id',
        'user_id'
    ];

    /**
     * [service description]
     *
     * @return [type] [description]
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    /**
     * [coupon description]
     *
     * @return [type] [description]
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
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
     * [orderDetails description]
     *
     * @return [type] [description]
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
