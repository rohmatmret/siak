<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
   protected $fillable = [
        'id', 'kecamatan', 'kode_kecamatan',
    ];
}