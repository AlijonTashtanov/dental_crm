<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class TabMenuComponent extends Component
{

    /**
     * @var
     */
    public $items;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * @param $route
     * @return bool
     */
    public function isActive($route)
    {
        return Route::is($route);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.tab-menu');
    }
}
