<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aktanikah extends Model
{
    protected $fillable=['id','nik_suami','nik_istri','created','kodearea'];

    public function namasuami()
    {
    	return $this->hasOne('App\aktalahir','nik','nik_suami');
    }
    public function namaistri()
    {
    	return $this->hasOne('App\aktalahir','nik','nik_istri');
    }
}
