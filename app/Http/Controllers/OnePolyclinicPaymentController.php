<?php

namespace App\Http\Controllers;

use App\Services\OnePolyclinicPaymentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OnePolyclinicPaymentController extends AbstractController
{
    /**
     * @var string
     */
    protected $dir = 'one-polyclinic-payment';

    /**
     * @var string
     */
    protected $serviceClass = OnePolyclinicPaymentService::class;

    /**
     * @var bool
     */
    protected $permissionCheck = false;

    /**
     * @return void
     */
    public function setConfig()
    {
        $this->config = [
            'rules' => [
                'polyclinic_id' => ["required", "integer", "max:2056", Rule::exists('polyclinics', 'id')],
                'type_id' => 'required|integer',
                'amount' => 'required|integer|min:0',
                'comment' => 'nullable|string|min:3',
            ]
        ];
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function polyclinicPaymentCreate($id)
    {
        $polyclinic = $this->service->polyclinicShow($id);

        $response = $this->service->create();

        return view('admin.' . $this->dir . '.create', compact('response', 'polyclinic')); //index
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function polyclinicPaymentStore(Request $request)
    {
        $data = $request->validate($this->config['rules']);
        $this->service->store($data);

        return redirect()->route('admin.' . $this->dir . '.index', $data['polyclinic_id'])->with('success', 'Created!');
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function polyclinicPaymentEdite($id)
    {
        $response = $this->service->edit($id);
        $polyclinic = $this->service->polyclinicShow($response->polyclinic_id);
        return view('admin.' . $this->dir . '.edit', compact('response', 'polyclinic'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function polyclinicPaymentUpdate(Request $request, $id)
    {
        $data = $request->validate($this->config['rules']);
        $this->service->update($data, $id);
        return redirect()->route('admin.' . $this->dir . '.index', $data['polyclinic_id'])->with('success', 'Updated!');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function polyclinicPaymentDestroy($id)
    {
        $response = $this->service->show($id);
        $this->service->destroy($id);
        $polyclinic = $this->service->polyclinicShow($response->polyclinic_id);
        return redirect()->route('admin.' . $this->dir . '.index', $polyclinic->id)->with('success', 'Deleted!');
    }
}
