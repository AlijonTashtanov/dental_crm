<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\PatientService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class PatientController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = PatientService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $patients = $this->service->index();
        return $this->sendResponse($patients);
    }

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $patient = $this->service->store(request()->all());
        return $this->sendResponse($patient);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function update($id)
    {
        $patient = $this->service->update($id,request()->all());
        return $this->sendResponse($patient);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */

    public function delete($id)
    {
        $patient = $this->service->delete($id);
        return $this->sendResponse($patient);
    }

    /**
     * @return array|JsonResponse
     */
    public function search()
    {
        $patients = $this->service->search(request()->all());
        return $this->sendResponse($patients);
    }




    /**
     * @return array|JsonResponse
     */
    public function deptors()
    {
        $patients = $this->service->deptors();
        return $this->sendResponse($patients);
    }



}
