<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a test user
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@mail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
