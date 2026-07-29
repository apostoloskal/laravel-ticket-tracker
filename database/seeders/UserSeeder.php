<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'),
            'role' => UserRole::E_ADMIN->value
        ]);

        User::factory()->create([
            'username' => 'employee',
            'email' => 'employee@email.com',
            'password' => Hash::make('employee'),
            'role' => UserRole::E_EMPLOYEE->value
        ]);

        User::factory()->create([
            'username' => 'customer',
            'email' => 'customer@email.com',
            'password' => Hash::make('customer'),
            'role' => UserRole::E_CUSTOMER->value
        ]);
    }
}
