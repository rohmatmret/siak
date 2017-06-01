<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\aktalahir;
class kartukeluarga extends Model
{
	
	// SoftDeletes;
    protected $fillable = [
       'kepala_keluarga_id','id','no_kk','alamat','rt','rw','nik',
    ];

    //protected $dates=['deleted_at'];
    public $timestamps = false;



    public function aktalahir()
    {
    	return $this->hasOne('App\aktalahir','id','kepala_keluarga_id');
    }
   
    public function detail()
    {
    	return $this->hasMany('App\detail_kartukeluarga','kartukeluarga_id','id');
    }

    public function getnik()
    {
        return $this->hasMany('App\detail_kartukeluarga','kartukeluarga_id','id');
    }
    

}
