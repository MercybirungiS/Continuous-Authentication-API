<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table = 'phones';

    protected $fillable = [
        'device_id',
        'android_version'
    ];

    public $timestamps = true;

    public function batteryMetrics()
    {
        return $this->hasMany(BatteryMetric::class, 'phone_id');
    }

    public function virtualKeyboardMetrics()
    {
        return $this->hasMany(VirtualKeyboardDynamic::class, 'phone_id');
    }

    public function touchDynamics()
    {
        return $this->hasMany(TouchDynamic::class, 'phone_id');
    }
}
