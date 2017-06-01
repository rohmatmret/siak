<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ktps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('status_nikah')->default('belum menikah');
            $table->string('pekerjaan')->default("Pelajar");
            $table->integer('kartukeluarga_id');
            $table->string('agama')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('ktps');
    }
}
