<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\CommunesTableSeeder;
use Database\Seeders\RoleUserTableSeeder;
use Database\Seeders\VillagesTableSeeder;
use Database\Seeders\DistrictsTableSeeder;
use Database\Seeders\ProvincesTableSeeder;
use Database\Seeders\PermissionRoleTableSeeder;

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
        $this->call([
          // PermissionTableSeeder::class,
          RoleTableSeeder::class,
          PermissionRoleTableSeeder::class,
          UserTableSeeder::class,
          RoleUserTableSeeder::class,
          ProvincesTableSeeder::class,
          DistrictsTableSeeder::class,
          CommunesTableSeeder::class,
          VillagesTableSeeder::class,
        ]);
          // $this->call(ProvincesTableSeeder::class);
          // $this->call(DistrictsTableSeeder::class);
          // $this->call(CommunesTableSeeder::class);
          // $this->call(VillagesTableSeeder::class);
    }
}
