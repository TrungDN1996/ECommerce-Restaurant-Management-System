<?php

namespace Lava\Observers;

use Lava\Model\Coupon;
use Lava\Model\Order;

class CouponObserver
{
    /**
     * $this->belongsTo(Order::class);
     *
     * @param  Coupon $coupon [description]
     * @return [type]         [description]
     */
    public function deleting(Coupon $coupon)
    {
        foreach ($coupon->orders as $order) {
            $order = Order::find($order->id);
            $order->coupon_id = null;
            $order->save();
        }

    }
}
