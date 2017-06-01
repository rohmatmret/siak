<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('email');
            $table->string('password');
            $table->string('status')->default('users');   
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('detail_users', function (Blueprint $table) { 
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');           
            $table->integer('kecamatan_id');
            $table->integer('desa_id');      
            $table->boolean('active')->default(0);     
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
        Schema::dropIfExists('detail_users');
        Schema::dropIfExists('users');
        
       
    }
}
