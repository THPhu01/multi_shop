<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
    // foreach (range(1, 2) as $item) {
    //     DB::table('users')->insert([
    //         'name' => Str::random(10),
    //         'email' => Str::random(10) . '@gmail.com',
    //         'password' => Hash::make('123456'),
    //     ]);
    // }
    $this->call(RoleSeeder::class);
    $this->call(UserSeeder::class);
  }
}
