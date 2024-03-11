<?php

namespace App\Repositories;

use App\Models\Phone;

class PhoneRepository
{
    protected $phone;

    public function __construct(Phone $phone)
    {
        $this->phone = $phone;
    }

    public function query()
    {
        return $this->phone->with(['batteryMetrics', 'virtualKeyboardMetrics', 'touchDynamics']);
    }

    public function get()
    {
        return $this->query()->select('*')->orderBy('id', 'asc')->get();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findbyDeviceId($device_id)
    {
        return $this->query()->where('device_id', $device_id)->first();
    }

    public function create($phoneData)
    {
        return $this->phone->create($phoneData);
    }

    public function updateOrInsert($criteria, $data)
    {
        return $this->phone->updateOrCreate($criteria, $data);
    }

    public function getOrCreatePhone($device_id, $android_version)
    {

        $phoneDetails = $this->phone->where('device_id', $device_id)->first();
        if (!$phoneDetails) {
            $phoneDetails = $this->phone->create([
                'device_id' => $device_id,
                'android_version' => $android_version,
            ]);
        }

        return $phoneDetails;
    }

    public function update($id, $phoneData)
    {
        $phone = $this->phone->find($id);
        $phone->update($phoneData);
        return $phone;
    }

    public function delete($id)
    {
        $phone = $this->phone->find($id);
        $phone->delete();
        return $phone;
    }
}
