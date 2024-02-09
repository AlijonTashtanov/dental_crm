<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\ProfileService;

class ProfileController extends AbstractController
{
    protected $service = ProfileService::class;

    /**
     * @return array|void
     */
    public function logout()
    {
        $patients = $this->service->logout();

        return $this->sendResponse($patients);
    }
}
