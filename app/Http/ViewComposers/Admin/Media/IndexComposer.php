<?php

namespace Lava\Http\ViewComposers\Admin\Media;

use Illuminate\View\View;
use Lava\Model\File;

class IndexComposer
{
    /**
     *
     * @var array
     */
    protected $archives;
    protected $years;

    /**
     *
     */
    public function __construct()
    {
        $archives = File::selectRaw('year(created_at) year, monthname(created_at) month')
                    ->groupBy('year', 'month')
                    ->orderByRaw('min(created_at) desc')
                    ->get()
                    ->toArray();
        $this->archives = $archives;

        $years = File::selectRaw('year(created_at) year')
                    ->groupBy('year')
                    ->orderByRaw('min(created_at) desc')
                    ->get()
                    ->toArray();
        $this->years = $years;
    }

    /**
     *
     */
    public function compose(View $view)
    {
        $view->with('archives', $this->archives)
             ->with('years', $this->years);
    }
}
