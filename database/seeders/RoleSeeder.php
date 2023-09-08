<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        Role::create(['name' => 'Admin', 'desc' => 'Quản trị hệ thống']);
        Role::create(['name' => 'Author', 'desc' => 'Biên tập']);
        Role::create(['name' => 'Guest', 'desc' => 'Khách hàng']);
    }
}
