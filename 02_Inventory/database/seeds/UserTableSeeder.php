<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
                'email_verified_at' => now()->timestamp,
                'APIToken' => Str::random(16),
            ]
        );
        $admin->save();
    }
}
