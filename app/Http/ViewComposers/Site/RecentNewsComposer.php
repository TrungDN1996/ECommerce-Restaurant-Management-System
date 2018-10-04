<?php

namespace Lava\Http\ViewComposers\Site;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Lava\Model\Post;

class RecentNewsComposer
{
    public function compose(View $view)
    {
       $recentNews = Post::where('type', 'post')->orderBy('created_at', 'desc')
                                                ->take(6)
                                                ->get();

        $view->with('recentNews',$recentNews);
    }
}
