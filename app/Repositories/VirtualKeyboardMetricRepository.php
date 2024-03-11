<?php

namespace App\Repositories;

use App\Models\VirtualKeyboardDynamic;

class VirtualKeyboardMetricRepository
{
    protected $virtualKeyboardDynamic;

    public function __construct(VirtualKeyboardDynamic $virtualKeyboardDynamic)
    {
        $this->virtualKeyboardDynamic = $virtualKeyboardDynamic;
    }

    public function query(){
        return $this->virtualKeyboardDynamic->with(['phone' => function ($query) {
            $query->select(['id', 'device_id', 'android_version']);
        }]);
    }

    public function get()
    {
        return $this->query()->select('*')->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findByPhoneId($phone_id)
    {
        return $this->query()->where('phone_id', $phone_id)->orderBy('id', 'desc')->get();
    }

    public function create($virtualKeyboardDynamicData)
    {
        return $this->virtualKeyboardDynamic->create($virtualKeyboardDynamicData);
    }

    public function updateOrInsert($criteria, $data)
    {
        return $this->virtualKeyboardDynamic->updateOrCreate($criteria, $data);
    }

    public function update($id, $virtualKeyboardDynamicData)
    {
        $virtualKeyboardDynamic = $this->virtualKeyboardDynamic->find($id);
        $virtualKeyboardDynamic->update($virtualKeyboardDynamicData);
        return $virtualKeyboardDynamic;
    }

    public function delete($id)
    {
        $virtualKeyboardDynamic = $this->virtualKeyboardDynamic->find($id);
        $virtualKeyboardDynamic->delete();
        return $virtualKeyboardDynamic;
    }
}
