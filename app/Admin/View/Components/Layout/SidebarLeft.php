<?php

namespace App\Admin\View\Components\Layout;

use Illuminate\View\Component;
use App\Admin\Traits\GetConfig;

class SidebarLeft extends Component
{
    use GetConfig;
    /**
     * The alert type.
     *
     * @var array
     */
    public $menu;
    public $countShowBubble = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->menu = $this->traitGetConfigSidebar();
        $this->countShowBubble['countPending'] = app()->make('App\Admin\Repositories\Contact\ContactRepositoryInterface')->countPending();
    }

    public function routeName($routeName, $param)
    {
        return $routeName ? route($routeName, $param) : '#';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.layouts.sidebar-left');
    }
}