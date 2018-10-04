<?php

namespace Lava\Http\ViewComposers;

use Illuminate\View\View;
use Lava\Model\Service;

class ServiceComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    { 
        $services = Service::select('id', 'name')
            ->pluck('name', 'id')->toArray();

        $view->with('services', $services);
    }
}