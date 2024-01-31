<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReceptionService extends AbstractService
{
    protected $model = User::class;

    protected $user;

    //<editor-fold desc="create">

    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function store(array $data)
    {
        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }


        $data = $validator->validated();

        $checkUsername = $this->checkUserName($data);

        if ($checkUsername) {
            return $checkUsername;
        }

        DB::beginTransaction();
        try {
            $user = new $this->model;
            $user->name = $data['name'];
            $user->position = $data['position'];
            $user->username = $data['username'];
            $user->password = bcrypt($data['password']);
            $user->role = User::$role_reception;
            $user->color = $data['color'];
            $user->sort_order = $data['sort_order'];
            $user->polyclinic_id = Auth::user()->polyclinic_id;
            $user->status = User::$status_active;

            if ($user->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 500,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => null
        ];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('position')->setRules('required|min:3|max:255'),
            TextField::make('username')->setRules('required|min:5|max:1024|unique:users'),
            TextField::make('password')->setRules('required|min:5|max:1024'),
            TextField::make('sort_order')->setRules('required|integer|min:0'),
            TextField::make('color')->setRules('required|max:255'),
        ];
    }

    /**
     * @param array $data
     * @return array|void
     */
    public function checkUserName(array $data)
    {
        $user = User::where(['username' => $data['username']])
            ->first();

        if ($user) {
            return [
                'status' => false,
                'message' => "This username  has already been taken",
                'statusCode' => 403,
                'data' => null
            ];
        }
    }
    //</editor-fold>

    //<editor-fold desc="Edit">
    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {
        $item = $this->show($id);
        $this->user = $item;

        $fields = $this->getUpdateFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        DB::beginTransaction();
        try {

            $item->name = $data['name'];
            $item->position = $data['position'];
            $item->username = $data['username'];
            if ($data['password']) {
                $item->password = bcrypt($data['password']);
            } else {
                $item->password = $this->user->password;
            }
            $item->role = User::$role_reception;
//            $user->percent_treatment = $data['percent_treatment'];
            $item->color = $data['color'];
            $item->sort_order = $data['sort_order'];
//            $user->status = User::$status_active;

            if ($item->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 500,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => null
        ];
    }

    /**
     * @return array
     */
    public function getUpdateFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('position')->setRules('required|min:3|max:255'),
            TextField::make('username')->setRules('required|min:5|max:1024|unique:users,username,' . $this->user->id),
            TextField::make('password')->setRules('nullable|min:5|max:1024'),
//            TextField::make('role')->setRules('required|integer|between:3,4'),
//            TextField::make('percent_treatment')->setRules('required|integer|min:0|max:100'),
            TextField::make('sort_order')->setRules('required|integer|min:0'),
            TextField::make('color')->setRules('required|max:255'),
        ];
    }
    //</editor-fold>

}
