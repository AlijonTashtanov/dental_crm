<?php

namespace App\Http\Livewire\Polyclinic;

use App\Http\Livewire\BaseLivewire;
use App\Models\Polyclinic;

class PolyclinicTable extends BaseLivewire
{
    public $path = 'polyclinic.polyclinic-table'; // component view path
    public $model = Polyclinic::class; // model
    public $route = 'polyclinics'; // route for actions(CRUD)
}
