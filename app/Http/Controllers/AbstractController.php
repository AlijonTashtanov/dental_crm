<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AbstractController extends Controller
{
    //view directory and route name
    protected $dir;
    //service class
    protected $config;
    protected $serviceClass = null;

    protected $service = null;
    protected $permissionCheck = true;

    public function __construct()
    {
        $this->setConfig();
        if ($this->serviceClass) {
            $this->service = app()->make($this->serviceClass);

            $middleware = 'permission:' . $this->service->getModelName();
            if ($this->permissionCheck) {
                $this->middleware($middleware . '-index')->only('index');
                $this->middleware($middleware . '-show')->only('show');
                $this->middleware($middleware . '-create')->only('create');
                $this->middleware($middleware . '-store')->only('store');
                $this->middleware($middleware . '-edit')->only('edit');
                $this->middleware($middleware . '-update')->only('update');
                $this->middleware($middleware . '-delete')->only('destroy');
            }
        }
    }

    //use livewire for table
    //use 'admin' for route name prefix
    //follow the resource route names
    public function index()
    {
        return view('admin.' . $this->dir . '.index'); //index
    }

    /**
     * show method uses service's show method
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $response = $this->service->show($id);
        return view('admin.' . $this->dir . '.show', compact('response'));
    }

    /**
     * $response - for easelly use extended form views
     * @return Application|Factory|View
     */
    public function create()
    {
        $response = $this->service->create();
        return view('admin.' . $this->dir . '.create', compact('response'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->config['rules']);
        $this->service->store($data);
        return redirect()->route('admin.' . $this->dir . '.index')->with('success', 'Created!');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $response = $this->service->edit($id);
        return view('admin.' . $this->dir . '.edit', compact('response'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate($this->config['rules']);
        $this->service->update($data, $id);
        return redirect()->route('admin.' . $this->dir . '.index')->with('success', 'Updated!');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('admin.' . $this->dir . '.index')->with('success', 'Deleted!');
    }

    public function setConfig()
    {
        $this->config = [];
    }
}
