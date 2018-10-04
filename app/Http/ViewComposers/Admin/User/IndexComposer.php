<?php

namespace Lava\Http\ViewComposers\Admin\User;

use Illuminate\View\View;
use Lava\Model\User;

class IndexComposer
{
    /**
     * properties
     */
    protected $archives;
    protected $years;

    /**
     * Constructor
     */
    public function __construct()
    {
        $archives = User::selectRaw('year(created_at) year, monthname(created_at) month')
                    ->groupBy('year', 'month')
                    ->orderByRaw('min(created_at) desc')
                    ->get()
                    ->toArray();
        $this->archives = $archives;

        $years = User::selectRaw('year(created_at) year')
                    ->groupBy('year')
                    ->orderByRaw('min(created_at) desc')
                    ->get()
                    ->toArray();
        $this->years = $years;
    }

    /**
     * composer
     */
    public function compose(View $view)
    {
        $view->with([
            'archives' => $this->archives,
            'years' => $this->years,
        ]);
    }
}
