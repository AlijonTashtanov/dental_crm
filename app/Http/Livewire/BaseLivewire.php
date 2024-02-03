<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BaseLivewire extends Component
{
    use WithPagination;

    public $model = null;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $path = '';
    public $route = '';
    public $search = '';

    /**
     * @return Application|Factory|View
     */
    public function render()
    {

        $items = $this->model::search($this->search)->orderByDesc('created_at')->paginate($this->perPage);
        return view('livewire.' . $this->path, compact('items'));
    }
}
