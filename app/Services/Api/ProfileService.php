<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileService extends AbstractService
{
    protected $model = User::class;

    /**
     * @return array
     */
    public function logout()
    {
        if (Auth::user()) {

            Auth::user()->token()->revoke();

            return [
                'status' => true,
                'Logged out successfully',
                'statusCode' => 200,
                'data' => null
            ];
        }

        return [
            'status' => false,
            'message' => 'There was a problem logging out',
            'statusCode' => 403,
            'data' => null
        ];
    }
}
