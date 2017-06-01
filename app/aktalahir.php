<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class aktalahir extends Model
{
	//use SoftDeletes;
    
    protected $fillable = [
        'nama', 'nama_ibu', 'nama_ayah','tanggal_lahir','no_kk','lahir','jenis_kelamin','no_kk','id',
    ];
    //protected $dates = ['deleted_at'];


    public function info()
    {
    	return $this->hasOne('App\info_akta','aktalahir_id','id');
    	
    }
}
