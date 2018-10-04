<?php

namespace Lava\Observers;

use Lava\Model\Order;

class OrderObserver
{
    /**
     * Handle the order "restored" event.
     *
     * @param  \Lava\Model\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        foreach ($order->orderDetails as $orderDetail)
            $orderDetail->restore();
    }

    /**
     * Handle the order "deleting" event
     *
     * @param \Lava\Model\ORder $order
     * @return void
     */
    public function deleting(Order $order)
    {
        if ($order->isForceDeleting()) {
            foreach ($order->orderDetails as $orderDetail)
                $orderDetail->forceDelete();
        } else {
            foreach ($order->orderDetails as $orderDetail)
                $orderDetail->delete();
        }
    }
}
