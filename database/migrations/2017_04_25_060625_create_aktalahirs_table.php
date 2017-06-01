<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktaLahirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktalahirs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('lahir');
            $table->string('jenis_kelamin');
            $table->string('nik');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->boolean('active')->default(0);
            $table->string('email');
            $table->softdeletes();
            $table->timestamps();
        });
        

        Schema::create('detail_aktas',function(Blueprint $table){
                $table->integer('aktalahirs_id')->unsigned();
                $table->foreign('aktalahirs_id')->references('id')->on('aktalahirs')->onDelete('cascade');            
                $table->integer('desa_id');
                $table->integer('kecamatan_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_aktas');
        Schema::dropIfExists('aktalahirs');
    }
}
