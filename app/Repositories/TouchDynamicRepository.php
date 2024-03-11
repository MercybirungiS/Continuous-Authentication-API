<?php

namespace App\Repositories;

use App\Models\TouchDynamic;

class TouchDynamicRepository
{
    protected $touchDynamic;

    public function __construct(TouchDynamic $touchDynamic)
    {
        $this->touchDynamic = $touchDynamic;
    }

    public function query()
    {
        return $this->touchDynamic->with(['phone' => function ($query) {
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

    public function create($touchDynamicData)
    {
        return $this->touchDynamic->create($touchDynamicData);
    }

    public function updateOrInsert($criteria, $data)
    {
        return $this->touchDynamic->updateOrCreate($criteria, $data);
    }

    public function update($id, $touchDynamicData)
    {
        $touchDynamic = $this->touchDynamic->find($id);
        $touchDynamic->update($touchDynamicData);
        return $touchDynamic;
    }

    public function delete($id)
    {
        $touchDynamic = $this->touchDynamic->find($id);
        $touchDynamic->delete();
        return $touchDynamic;
    }
}
