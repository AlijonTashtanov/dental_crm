<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Models\Patient;
use App\Models\User;
use App\Traits\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib3\File\ASN1\Maps\OtherPrimeInfo;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnArgument;


class PatientService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Patient::class;


    /**
     * @return array
     */
    public function index()
    {

        $allPatients = $this->model::where('polyclinic_id', auth()->user()->polyclinic_id)
            ->where('status', Status::$status_active)
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        $data = [
            'patients' => PatientResource::collection($allPatients),
            'pagination' => [
                'total' => $allPatients->total(),
                'per_page' => $allPatients->perPage(),
                'current_page' => $allPatients->currentPage(),
                'last_page' => $allPatients->lastPage(),
                'from' => $allPatients->firstItem(),
                'to' => $allPatients->lastItem(),
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
            $patient->first_name = $data['first_name'];
            $patient->last_name = $data['last_name'];
            $patient->polyclinic_id = auth()->user()->polyclinic_id;
            $patient->gender_id = $data['gender_id'];
            $patient->first_name = $data['first_name'];
            $patient->born_date = $data['born_date'];
            $patient->address = $data['address'];
            $patient->phone = $data['phone'];
            $patient->job = $data['job'];
            $patient->status = Status::$status_active;


            if ($patient->save()) {
                $data['select_diseases'] != [] ? $patient->diseases()->attach(json_decode($data['select_diseases'])) : '';
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
                'message' => "Patient not found",
                'statusCode' => 403,
                'data' => null
            ];

        }
        if ($item->status == User::$status_deleted) {

            return [
                'status' => false,
                'message' => "Patient deleted",
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
            $patient = $item;
            $patient->first_name = $data['first_name'];
            $patient->last_name = $data['last_name'];
            $patient->gender_id = $data['gender_id'];
            $patient->born_date = $data['born_date'];
            $patient->address = $data['address'];
            $patient->phone = $data['phone'];
            $patient->job = $data['job'];
            $patient->status = Status::$status_active;


            if ($patient->save()) {
                DB::commit();
                $patient->diseases()->detach();
                $patient->diseases()->attach(json_decode($data['select_diseases']));

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
                    'data' => PatientResource::make($item)
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
     * @param $data
     * @return array|void
     */
    public function search(array $data)
    {
        $key = $data['key'] ?? '';
        $column = $data['column'] ?? 'id';
        $order = $data['sort'] ?? 'asc';

        $patients = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->where('first_name', 'like', '%' . $key . '%')
                ->orWhere('last_name', 'like', '%' . $key . '%')
                ->orWhere('address', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('balance', 'like', '%' . $key . '%');
        })
            ->where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('status', Status::$status_active)
            ->orderBy($column, $order)
            ->paginate(20);


        $data = [
            'patients' => PatientResource::collection($patients),
            'pagination' => [
                'total' => $patients->total(),
                'per_page' => $patients->perPage(),
                'current_page' => $patients->currentPage(),
                'last_page' => $patients->lastPage(),
                'from' => $patients->firstItem(),
                'to' => $patients->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $data
        ];

    }

    /**
     * @return array
     */

    public function debtors()
    {

        $patients = $this->model::where('status', Status::$status_active)
            ->where('balance', '<', 0)
            ->orderBy('balance', 'desc')
            ->paginate(20);

        $data = [
            'patients' => PatientResource::collection($patients),
            'pagination' => [
                'total' => $patients->total(),
                'per_page' => $patients->perPage(),
                'current_page' => $patients->currentPage(),
                'last_page' => $patients->lastPage(),
                'from' => $patients->firstItem(),
                'to' => $patients->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $data
        ];

    }


    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('first_name')->setRules('required|min:3|max:255'),
            TextField::make('last_name')->setRules('nullable|min:3|max:255'),
            TextField::make('born_date')->setRules('nullable|min:3|max:255'),
            TextField::make('address')->setRules('nullable|min:3|max:255'),
            TextField::make('job')->setRules('nullable|min:3|max:255'),
            TextField::make('phone')->setRules('nullable|string'),
            TextField::make('gender_id')->setRules('required|integer'),
            TextField::make('select_diseases')->setRules('nullable'),

        ];
    }

}
