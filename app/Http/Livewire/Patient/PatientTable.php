<?php

namespace App\Http\Livewire\Patient;

use App\Http\Livewire\BaseLivewire;

class PatientTable extends BaseLivewire
{
    public $path = ''; // component view path
    public $model = null; // model
    public $route = ''; // route for actions(CRUD)
}
