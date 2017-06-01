<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_kartukeluarga extends Model
{
    protected $fillable=['kartukeluarga_id','nik','desa','kecamatan','kodepos'];

    public function akta()
    {
    	return $this->hasOne('App\aktalahir','nik','nik');
    }
    public function kk()
    {
    	return $this->hasOne('App\kartukeluarga','id','kartukeluarga_id');
    }
    public function alamat()
    {
    	return $this->hasOne('App\desa','id','desa');
    }
}
