<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampah;


class data_jenis_sampah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisSampah::create([
            'jenis' => 'Botol Plastik',
            'harga' => '1000'
        ]);
        JenisSampah::create([
            'jenis' => 'Botol Kaca',
            'harga' => '2000'
        ]);
        JenisSampah::create([
            'jenis' => 'Kaleng',
            'harga' => '1500'
        ]);
        JenisSampah::create([
            'jenis' => 'Gelas Plastik',
            'harga' => '500'
        ]);
    }
}
