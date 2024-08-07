<?php

namespace App\View\Composers\Menu;

use Illuminate\View\View;

class MenuComposer
{
    protected $repoMenu;

    public function __construct()
    {
        $this->repoMenu = app()->make('App\Repositories\Menu\MenuRepositoryInterface');
    }

    public function compose(View $view)
    {
        $menu = $this->repoMenu->getBy([], ['items.reference']);
        
        $view->with('menu', $menu);
    }

}