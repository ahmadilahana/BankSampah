<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class data_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'email' => "Admin@email.com",
            'no_telp' => "0081818273",
            'role' => "Admin",
            'password' => Hash::make('123123'),
        ]);
    }
}
