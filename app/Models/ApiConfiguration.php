<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiConfiguration extends Model
{
    use HasFactory;
    protected $table = 'api_configurations';

    protected $fillable = [
        'api_key',
        'name'
    ];

    public $timestamps = true;
}
