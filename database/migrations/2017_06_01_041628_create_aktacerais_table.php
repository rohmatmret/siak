<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktaceraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktacerais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_aktanikah');
            $table->string('nomor_aktacerai');
            $table->text('keterangan');
            $table->date('tgl_putusan_pengadilan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aktacerais');
    }
}
