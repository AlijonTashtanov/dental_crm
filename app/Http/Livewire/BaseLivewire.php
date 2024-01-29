<?php

namespace App\Http\Livewire;

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

    public function render()
    {

        $items = $this->model::search($this->search)->orderByDesc('created_at')->paginate($this->perPage);
        return view('livewire.' . $this->path, compact('items'));
    }
}
