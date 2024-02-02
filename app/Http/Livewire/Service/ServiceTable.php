<?php

namespace App\Http\Livewire\Service;

use App\Http\Livewire\BaseLivewire;

class ServiceTable extends BaseLivewire
{
    public $path = ''; // component view path
    public $model = null; // model
    public $route = ''; // route for actions(CRUD)
}
