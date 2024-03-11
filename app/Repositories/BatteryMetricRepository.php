<?php

namespace App\Repositories;

use App\Models\BatteryMetric;

class BatteryMetricRepository
{
    protected $batteryMetric;

    public function __construct(BatteryMetric $batteryMetric)
    {
        $this->batteryMetric = $batteryMetric;
    }

    public function query()
    {
        return $this->batteryMetric->with(['phone' => function ($query) {
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

    public function create($batteryMetricData)
    {
        return $this->batteryMetric->create($batteryMetricData);
    }

    public function updateOrInsert($criteria, $data)
    {
        return $this->batteryMetric->updateOrCreate($criteria, $data);
    }

    public function update($id, $batteryMetricData)
    {
        $batteryMetric = $this->batteryMetric->find($id);
        $batteryMetric->update($batteryMetricData);
        return $batteryMetric;
    }

    public function delete($id)
    {
        $batteryMetric = $this->batteryMetric->find($id);
        $batteryMetric->delete();
        return $batteryMetric;
    }
}
