<?php

namespace Lava\Http\ViewComposers\Admin\User;

use Illuminate\View\View;
use Lava\Model\User;

class EditComposer
{
    /**
     *
     *
     * @var array
     */
    protected $statuses;
    protected $types;
    protected $roles;

    /**
     *
     */
    public function __construct()
    {
        $this->statuses = ['old', 'new', 'loyal'];
        $this->types = ['traveller', 'local'];
        $this->roles = ['user', 'admin'];
    }

    /**
     *
     */
    public function compose(View $view)
    {
        $view->with([
            'statuses' => $this->statuses,
            'types' => $this->types,
            'roles' => $this->roles,
        ]);
    }
}
