<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableSetoran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setoran', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tgl_setor');
            $table->enum('keterangan', ['dijemput', 'diantar']);
            $table->unsignedBigInteger('jenis_id');
            $table->float('berat');
            $table->float('debit');
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
