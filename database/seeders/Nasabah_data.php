<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nasabah;

class Nasabah_data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nasabah::create([
            'name' => 'ilahana',
            'email' => 'ilahana@email.com',
            'password' => bcrypt('123123'),
        ]);
    }
}
