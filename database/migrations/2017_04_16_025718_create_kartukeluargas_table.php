<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKartukeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartukeluargas', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('kepala_keluarga_id');
            $table->string('rt');
            $table->string('rw');
            $table->string('alamat');
            $table->string('no_kk');
            $table->string('kodearea'); 
            $table->boolean('active')->default(0);           
            $table->date('created');
            $table->string('created_by');
        });

        Schema::create('detail_kartukeluargas', function (Blueprint $table) {
            $table->integer('kartukeluarga_id')->unsigned();
            $table->foreign('kartukeluarga_id')->references('id')->on('kartukeluargas')->onDelete('cascade');           
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->string('nik');            
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
        Schema::dropIfExists('detail_kartukeluargas');
        Schema::dropIfExists('kartukeluargas');
    }
}
