<?php

namespace App\Http\Controllers;

use App\Services\OnePolyclinicTariffService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OnePolyclincTariffController extends AbstractController
{
    /**
     * @var string
     */
    protected $dir = 'one-polyclinic-tariff';

    /**
     * @var string
     */
    protected $serviceClass = OnePolyclinicTariffService::class;

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
                'tariff_id' => 'required|integer',
            ]
        ];
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function polyclinicTariffCreate($id)
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
    public function polyclinicTariffStore(Request $request)
    {
        $data = $request->validate($this->config['rules']);
        $messageData = $this->service->store($data);

        return redirect()->route('admin.' . $this->dir . '.index', $data['polyclinic_id'])->with('success', $messageData['text']);
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function polyclinicTariffEdite($id)
    {
        $response = $this->service->edit($id);
        $polyclinic = $this->service->polyclinicShow($response->polyclinic_id);
        return view('admin.' . $this->dir . '.edit', compact('response', 'polyclinic'));
    }

//    /**
//     * @param Request $request
//     * @param $id
//     * @return RedirectResponse
//     */
//    public function polyclinicTariffUpdate(Request $request, $id)
//    {
//        $data = $request->validate($this->config['rules']);
//        $messageData = $this->service->update($data, $id);
//
//        return redirect()->route('admin.' . $this->dir . '.index', $data['polyclinic_id'])->with('success', $messageData['text']);
//    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function polyclinicTariffDestroy($id)
    {
        $response = $this->service->show($id);
        $this->service->destroy($id);
        $polyclinic = $this->service->polyclinicShow($response->polyclinic_id);
        return redirect()->route('admin.' . $this->dir . '.index', $polyclinic->id)->with('success', 'Deleted!');
    }
}
