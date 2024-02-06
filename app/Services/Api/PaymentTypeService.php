<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use App\Models\User;
use App\Traits\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentTypeService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = PaymentType::class;


    /**
     * @return array
     */
    public function index()
    {

        $items = $this->model::where('status', Status::$status_active)
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        $data = [
            'payment-types' => PaymentTypeResource::collection($items),
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

    /**
     * @param array $data
     * @return array
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

        DB::beginTransaction();

        try {
            $patient = new $this->model;
            $patient->name = $data['name'];
            $patient->icon = $data['icon'];
            $patient->color = $data['color'];
            $patient->polyclinic_id = auth()->user()->polyclinic_id;
            $patient->status = Status::$status_active;


            if ($patient->save()) {
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
     * @param $id
     * @param $data
     * @return array
     */
    public function update($id, $data)
    {

        $item = $this->model::where('polyclinic_id', auth()->user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if (!$item) {
            return [
                'status' => false,
                'message' => "Staff not found",
                'statusCode' => 403,
                'data' => null
            ];

        }
        if ($item->status == User::$status_deleted) {

            return [
                'status' => false,
                'message' => "User deleted",
                'statusCode' => 403,
                'data' => null
            ];
        }

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
        DB::beginTransaction();
        try {
            $item->name = $data['name'];
            $item->icon = $data['icon'];
            $item->color = $data['color'];
            $item->polyclinic_id = auth()->user()->polyclinic_id;
            $item->status = Status::$status_active;


            if ($item->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'update user error',
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
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $item = $this->model::where('polyclinic_id', auth()->user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if ($item) {

            if ($item->status == User::$status_deleted) {

                return [
                    'status' => false,
                    'message' => 'Staff deleted',
                    'statusCode' => 403,
                    'data' => null
                ];
            }

            $item->status = User::$status_deleted;
            $item->deleted_at = date('Y-m-d H:i:s');
            $item->deleted_by = auth()->user()->id;

            if ($item->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => PaymentTypeResource::make($item)
                ];
            }
        }

        return [
            'status' => false,
            'message' => 'There was a problem deleting',
            'statusCode' => 403,
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
            TextField::make('icon')->setRules('required|min:3'),
            TextField::make('color')->setRules('nullable|min:3|max:255'),
        ];
    }

}
