<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BukuTabunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_tabungan', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal');
            $table->enum('keterangan', ['Setoran', 'Penarikan'])->nullable();
            $table->unsignedBigInteger('jenis_id')->nullable();
            $table->float('berat')->nullable();
            $table->float('debit')->nullable();
            $table->float('kredit')->nullable();
            $table->float('saldo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('jenis_id')->references('id')->on('jenis_sampah');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
