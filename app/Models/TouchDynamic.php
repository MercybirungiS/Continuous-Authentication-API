<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouchDynamic extends Model
{
    use HasFactory;
    protected $table = 'touch_dynamics';

    protected $fillable = [
        'phone_id',
        'finger_pressure',
        'finger_blocked_area',
        'hold_time',
        'finger_orientation'
    ];

    public $timestamps = true;

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }
}
