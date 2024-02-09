<?php

namespace App\Http\Livewire\Polyclinic;

use App\Http\Livewire\BaseLivewire;
use App\Models\Polyclinic;
use App\Models\PolyclinicPayment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PaymentTable extends BaseLivewire
{
    public $path = 'polyclinic.payment-table'; // component view path
    public $model = PolyclinicPayment::class; // model
    public $route = 'one-polyclinic-payments'; // route for actions(CRUD)

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
