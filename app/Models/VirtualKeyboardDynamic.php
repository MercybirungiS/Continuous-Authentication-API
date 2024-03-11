<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualKeyboardDynamic extends Model
{
    use HasFactory;

    protected $table = 'virtual_keyboard_dynamics';

    protected $fillable = [
        'phone_id',
        'flight_time',
        'key_hold_time',
        'finger_pressure',
        'finger_area'
    ];

    public $timestamps = true;

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }
}
