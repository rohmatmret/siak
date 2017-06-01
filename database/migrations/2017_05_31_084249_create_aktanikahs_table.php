<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktanikahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktanikahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_aktanikah');
            $table->string('nik_suami');
            $table->string('nik_istri');    
            $table->string('kodearea');
            $table->date('created');    
            $table->boolean('active')->default(1);            
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
        Schema::dropIfExists('aktanikahs');
    }
}
