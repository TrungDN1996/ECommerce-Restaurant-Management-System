<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $table = 'coupons';
    protected $fillable = [
        'name',
        'type',
        'value',
        'number',
        'start_date',
        'end_date'
    ];

    /**
     * [order description]
     *
     * @return [type] [description]
     */
    public function order()
    {
        return $this->hasMany(Order::class, 'coupon_id', 'id')->withTrashed();
    }
}
