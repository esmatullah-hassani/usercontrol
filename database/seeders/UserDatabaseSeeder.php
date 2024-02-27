<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'  => 'admin',
            'last_name'  => 'admin',
            'email'  => 'admin@admin.com',
            'phone'  => '0748232002',
            'gender'  => 'm',
            'password'  => bcrypt('admin@123'),
            'active'  => 1
        ]);
    }
}
