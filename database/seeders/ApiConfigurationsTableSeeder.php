<?php

namespace Database\Seeders;

use App\Models\ApiConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApiConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiConfiguration::create([
            'api_key' => Str::random(32), 
            'name' => 'API AUTH TOKEN',
        ]);
    }
}
