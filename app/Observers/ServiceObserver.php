<?php

namespace Lava\Observers;

use Lava\Model\Service;
use Lava\Model\Order;

class ServiceObserver
{
    public function deleting(Service $service)
    {
        foreach ($service->orders as $order)
        {
            $order = Order::find($order->id);
            $order->service_id = null;
            $order->save();
        }
    }
}
