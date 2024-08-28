<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RoleSeeder::class
          ]);

        $user=User::factory()->create([
            'name' => 'Admin',
           'email' => 'meghna@gmail.com',
           'password'=> Hash::make('password'),
           'phoneno'=>'9888777666'
        ]);
        $user->assignRole('admin');
          

    }
}
