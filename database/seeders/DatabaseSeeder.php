<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use DCN\RBAC\Models\Permission;
use DCN\RBAC\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() == 0) $this->call(UserDatabaseSeeder::class);
        if (Role::count() == 0) $this->call(RoleTableSeeder::class);
        if (Permission::count() == 0) $this->call(PermissionTableSeeder::class);
    }
}
