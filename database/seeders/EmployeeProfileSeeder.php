<?php

namespace Database\Seeders;

use App\Models\EmployeeProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeProfile::factory()->create([
            'user_id' => 1
        ]);

        EmployeeProfile::factory()->create([
            'user_id' => 2
        ]);

        EmployeeProfile::factory()->create([
            'user_id' => 3
        ]);
    }
}
