<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\TelegramUserResource;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TelegramUserService extends AbstractService
{

    /**
     * @var string
     */
    protected $model = TelegramUser::class;

    /**
     * @return array
     */
    public function index()
    {

        $items = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        $data = [
            'telegram_users' => TelegramUserResource::collection($items),
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
            $item = new $this->model;
            $item->name = $data['name'];
            $item->telegram_id = $data['telegram_id'];
            $item->polyclinic_id = Auth::user()->polyclinic_id;

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
     * @param $id
     * @param $data
     * @return array
     */
    public function update($id, $data)
    {

        $item = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if (!$item) {
            return [
                'status' => false,
                'message' => "Telegram user not found",
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
            $item->telegram_id = $data['telegram_id'];

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
        $item = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if (!$item) {

            return [
                'status' => false,
                'message' => 'Telegram user not found',
                'statusCode' => 403,
                'data' => null
            ];
        }

        if ($item) {

            $item->delete();

            if ($item->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => TelegramUserResource::make($item)
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

    public function search($data)
    {
        $key = $data['key'] ?? '';
        $column = $data['column'] ?? 'id';
        $order = $data['sort'] ?? 'asc';

        $items = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where(function ($query) use ($key) {
                empty($key) ? $query : $query->where('name', 'like', '%' . $key . '%')
                    ->orWhere('telegram_id', 'like', '%' . $key . '%');
            })
            ->orderBy($column, $order)
            ->paginate(20);

        $data = [
            'telegram_users' => TelegramUserResource::collection($items),
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
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('telegram_id')->setRules('required|min:3|max:255'),

        ];
    }


}
