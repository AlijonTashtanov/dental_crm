<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\CategoryResource;
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
    public function index()
    {
        $categories = $this->model::where('status','!=', Category::$status_deleted )->get();
//        return CategoryResource::collection($categories);
        return $this->sendResponse(true, 'get all categories', 200, CategoryResource::collection($categories) );
    }

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
            $service->category_id = $data['category_id'];
            $service->material_price = $data['material_price'] != null ? $data['material_price'] : 0;
            $service->technic_price = $data['technic_price'] != null ? $data['technic_price'] : 0;
            $service->price = $data['price'] != null ? $data['price'] : 0;
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
     * @param $id
     * @param array $data
     * @return array
     */
    public function updateService($id, array $data)
    {
        $item = $this->serviceModel::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if (!$item) {

            return $this->sendResponse(false, 'Service not found', 403);

        }
        if ($item->status == Service::$status_deleted) {

            return $this->sendResponse(false, 'Service deleted', 403);

        }

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

        DB::beginTransaction();
        try {

            $item->name = $data['name'];
            $item->category_id = $data['category_id'];
            $item->price = $data['price'] != null ? $data['price'] : 0;
            $item->material_price = $data['material_price'] != null ? $data['material_price'] : 0;
            $item->technic_price = $data['technic_price'] != null ? $data['technic_price'] : 0;
            $item->status = $data['status'];

            if ($item->save()) {
                DB::commit();
            } else {
                DB::rollback();

                return $this->sendResponse(false, 'save service error', 500);
            }

        } catch (\Exception $ex) {

            DB::rollback();

            return $this->sendResponse(false, 'save service error', 500, $ex->getMessage());

        }

        return $this->sendResponse();
    }

    /**
     * Xizmatni o'chirish uchun method
     * @param $id
     * @return array
     */
    public function serviceDestroy($id)
    {
        $item = $this->serviceModel::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('id', $id)
            ->first();

        if ($item) {

            if ($item->status == Service::$status_deleted) {

                return $this->sendResponse(false, 'Service already deleted', 403);
            }

            $item->status = Service::$status_deleted;
            $item->deleted_at = date('Y-m-d H:i:s');
            $item->deleted_by = Auth::user()->id;

            if ($item->save()) {

                return $this->sendResponse();
            }
        }

        return $this->sendResponse(false, 'There was a problem deleting', 403);
    }

    /**
     * @return array
     */
    public function getServiceFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('category_id')->setRules('required|numeric'),
            TextField::make('material_price')->setRules('integer|nullable'),
            TextField::make('technic_price')->setRules('integer|nullable'),
            TextField::make('price')->setRules('integer|nullable'),
            TextField::make('status')->setRules('required|integer|between:0,1'),
        ];
    }
}
