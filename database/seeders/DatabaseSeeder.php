<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate(); //clear table

        // MDRRMO - super admin
         User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'mdrrmo@bakwit.com',
             'password' => Hash::make('password'),
             'type' => 1,
         ]);

         // Brgy - admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'barangay@bakwit.com',
            'password' => Hash::make('password'),
        ]);
    }
}
