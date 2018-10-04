<?php

namespace Lava\Observers;

use Lava\Model\Product;

class ProductObserver
{
    /**
     * Handle the product "restored" event.
     *
     * @param  \Lava\Model\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        if ($product->post()->exists())
            $product->post->restore();

        foreach ($product->orderDetails as $orderdetail)
            $orderDetail->restore();
    }

    public function deleting(Product $product)
    {
        if ($product->isForceDeleting()) {
            if ($product->post()->exists())
                $product->post->forceDelete();

            foreach ($product->orderDetails as $orderDetail)
                $orderDetail->forceDelete();
        } else {
            // post
            if ($product->post()->exists())
                $product->post->delete();

            // soft delete
            foreach ($product->orderDetails as $orderDetail)
                $orderDetail->delete();
        }
    }
}
