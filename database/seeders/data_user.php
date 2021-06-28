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
            'email' => "admin@email.com",
            'no_telp' => "0081818273",
            'role' => "Admin",
            'password' => Hash::make('123123'),
        ]);
        User::create([
            'name' => "ilahana",
            'email' => "ilahana@email.com",
            'no_telp' => "00818182731",
            'role' => "Pengurus1",
            'password' => Hash::make('123123'),
        ]);
        User::create([
            'name' => "ahmad",
            'email' => "ahmad@email.com",
            'no_telp' => "00818182732",
            'role' => "Pengurus2",
            'password' => Hash::make('123123'),
        ]);
        User::create([
            'name' => "Bendahara",
            'email' => "bendahara@email.com",
            'no_telp' => "008181827321",
            'role' => "Bendahara",
            'password' => Hash::make('123123'),
        ]);
        User::create([
            'name' => "arif",
            'email' => "arif@email.com",
            'no_telp' => "00818182733",
            'role' => "Nasabah",
            'password' => Hash::make('123123'),
        ]);
        User::create([
            'name' => "arif2",
            'email' => "arif2@email.com",
            'no_telp' => "008181827334",
            'role' => "Nasabah",
            'password' => Hash::make('123123'),
        ]);
    }
}
