<?php

namespace App\Http\Livewire\Polyclinic;

use App\Http\Livewire\BaseLivewire;
use App\Models\PolyclinicTariff;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TariffTable extends BaseLivewire
{
    public $path = 'polyclinic.tariff-table'; // component view path
    public $model = PolyclinicTariff::class; // model
    public $route = 'one-polyclinic-tariff'; // route for actions(CRUD)

    /**
     * @var
     */
    public $polyclinicId;

    /**
     * @param $polyclinicId
     * @return void
     */
    public function mount($polyclinicId)
    {

        $this->polyclinicId = $polyclinicId;
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {

        $items = $this->model::search($this->search)
            ->where('polyclinic_id', $this->polyclinicId)
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.' . $this->path, compact('items'));
    }
}
