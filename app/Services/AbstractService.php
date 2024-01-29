<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AbstractService
{
    //model
    public function __construct(protected $model = null)
    {

    }

    //since we are using livewire, index is not necessary, you can overwrite if you want

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    public function create()
    {
        return new $this->model;
    }

    public function store(array $data)
    {
        $this->model->create($data);
    }

    /**
     * it works with spatie media library,
     * register your collection in your model as a singleFile()
     * @param array $data
     * @return void
     */

    public function storeWithFile(array $data)
    {
        $item = $this->model->create($data);
        if (isset($data['image'])) {
            $item->addMediaFromRequest('image')->toMediaCollection('image');
        } elseif (isset($data['file'])) {
            $item->addMediaFromRequest('file')->toMediaCollection('file');
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function storeWithFiles(array $data)
    {
        $item = $this->model->create($data);
        if (isset($data['images'])) {
            foreach ($data['images'] as $file) {
                $item->addMedia($file)
                    ->toMediaCollection('images');
            }
        } elseif (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $item->addMedia($file)
                    ->toMediaCollection('files');
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    /**
     * @param array $data
     * @param $id
     * @return void
     */
    public function update(array $data, $id)
    {
        $item = $this->show($id);
        $item->update($data);
    }

    /**
     * it works with spatie media library,
     * register your collection in your model as a singleFile()
     * @param array $data
     * @param $id
     * @return void
     */
    public function updateWithFile(array $data, $id)
    {
        $item = $this->show($id);
        $item->update($data);
        if (isset($data['image'])) {
            $item->clearMediaCollection('image');
            $item->addMediaFromRequest('image')->toMediaCollection('image');
        } elseif (isset($data['file'])) {
            $item->clearMediaCollection('file');
            $item->addMediaFromRequest('file')->toMediaCollection('file');
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return void
     */
    public function updateWithFiles(array $data, $id)
    {
        $item = $this->show($id);
        $item->update($data);
        if (isset($data['images'])) {
            $item->clearMediaCollection('images');
            foreach ($data['images'] as $file) {
                $item->addMedia($file)
                    ->toMediaCollection('images');
            }
        } elseif (isset($data['files'])) {
            $item->clearMediaCollection('files');
            foreach ($data['files'] as $file) {
                $item->addMedia($file)
                    ->toMediaCollection('files');
            }
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $item = $this->show($id);
        $item->delete();
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return Str::kebab(class_basename($this->model?->getModel() ?? Model::class));
    }
}
