<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * @var string
     */
    protected $serviceModel = Service::class;

    //<editor-fold desc="create category">

    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function createCategory(array $data)
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

            return $this->sendResponse(false, 'Validation error', 403, $errors);
        }

        $data = $validator->validated();

        DB::beginTransaction();

        try {
            $category = new $this->model;
            $category->polyclinic_id = Auth::user()->polyclinic_id;
            $category->name = $data['name'];
            $category->status = $data['status'];

            if ($category->save()) {
                DB::commit();
            } else {
                DB::rollback();

                return $this->sendResponse(false, 'save category error', 500, null);
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return $this->sendResponse(false, 'Server error', 500, $ex->getMessage());
        }

        return $this->sendResponse();

    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('color')->setRules('required|min:3|max:255'),
            TextField::make('status')->setRules('required|integer|between:0,1'),
        ];
    }

    //</editor-fold>

    //<editor-fold desc="update category">

    /**
     * @param $id
     * @param array $data
     * @return array
     */
    public function updateCategory($id, array $data)
    {
        $item = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if (!$item) {

            return $this->sendResponse(false, 'Category not found', 403);

        }
        if ($item->status == Category::$status_deleted) {

            return $this->sendResponse(false, 'Category deleted', 403);

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

            return $this->sendResponse(false, 'Validation error', 403, $errors);
        }

        DB::beginTransaction();
        try {

            $item->polyclinic_id = Auth::user()->polyclinic_id;
            $item->name = $data['name'];
            $item->status = $data['status'];
            $item->color = $data['color'];

            if ($item->save()) {
                DB::commit();
            } else {
                DB::rollback();

                return $this->sendResponse(false, 'save category error', 500);
            }

        } catch (\Exception $ex) {

            DB::rollback();

            return $this->sendResponse(false, 'save category error', 500, $ex->getMessage());

        }

        return $this->sendResponse(true, 'success', 200);
    }

    //</editor-fold>

    //<editor-fold desc="delete category">

    /**
     * @param $id
     * @return array
     */
    public function categoryDestroy($id)
    {
        $item = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if ($item) {

            if ($item->status == Category::$status_deleted) {

                return $this->sendResponse(false, 'Category already deleted', 403);
            }

            $item->status = Category::$status_deleted;
            $item->deleted_at = date('Y-m-d H:i:s');
            $item->deleted_by = Auth::user()->id;

            if ($item->save()) {

                return $this->sendResponse();
            }
        }

        return $this->sendResponse(false, 'There was a problem deleting', 403);
    }

    //</editor-fold>

    /**
     * @param array $data
     * @return array
     */
    public function createService(array $data)
    {
        $fields = $this->getServiceFields();

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

            return $this->sendResponse(false, 'Validation error', 403, $errors);
        }

        $data = $validator->validated();

        DB::beginTransaction();

        try {
            $service = new $this->serviceModel;
            $service->polyclinic_id = Auth::user()->polyclinic_id;
            $service->name = $data['name'];
            $service->status = $data['status'];

            if ($service->save()) {
                DB::commit();
            } else {
                DB::rollback();

                return $this->sendResponse(false, 'save category error', 500, null);
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return $this->sendResponse(false, 'Server error', 500, $ex->getMessage());
        }

        return $this->sendResponse();
    }

    /**
     * @return array
     */
    public function getServiceFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('color')->setRules('required|min:3|max:255'),
            TextField::make('status')->setRules('required|integer|between:0,1'),
        ];
    }
}
