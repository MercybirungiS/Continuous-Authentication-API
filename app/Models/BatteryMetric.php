<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryMetric extends Model
{
    use HasFactory;
    protected $table = 'battery_metrics';

    protected $fillable = [
        'phone_id',
        'voltage',
        'current'
    ];

    public $timestamps = true;

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }
}
