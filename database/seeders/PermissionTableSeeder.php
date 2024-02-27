<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DCN\RBAC\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => "مشاهده", 'slug' => "users.view", 'description' => "کاربران"
        ]);
        Permission::create([
            'name' => "ایجاد", 'slug' => "users.create", 'description' => "کاربران"
        ]);
        Permission::create([
            'name' => "آپدیت", 'slug' => "users.update", 'description' => "کاربران"
        ]);
        Permission::create([
            'name' => "حذف", 'slug' => "users.destroy", 'description' => "کاربران"
        ]);

        Permission::create([
            'name' => "ورود به حساب کاربری دیگران", 'slug' => "users.impersonate", 'description' => "کاربران"
        ]);

        Permission::create([
            'name' => "چاب کارت", 'slug' => "users.cards.id", 'description' => "کاربران"
        ]);
        
    }
}
