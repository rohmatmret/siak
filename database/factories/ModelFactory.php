<?php 

use Illuminate\Database\Query\Builder\pluck;
use Illuminate\Database\Eloquent\Builder;
use App\kecamatan;
use App\aktalahir;
use App\desa;




//faker data aktalahirs
$factory->define(App\aktalahir::class, function (Faker\Generator $faker) {
    $kode_kecamatan = Kecamatan::pluck('kode_kecamatan')->all();
    $random_kecamatan = $faker->randomElement($kode_kecamatan);
    $tanggal_lahir = $faker->date($format='Y-m-d', $max='NOW');
    $getdate=explode("-",$tanggal_lahir);
    $date=$getdate[2];
    $mothn=$getdate[1];
    $year=substr($getdate[0],2);
    $birthday=$date.$mothn.$year;
    $random_number = $faker->randomNumber(4);
 
    $nik = $random_kecamatan . $birthday . $random_number;
    $nik=str_replace('-','',$nik);
    
 
    return [
        'nama'=>$faker->name,
        'lahir'=>'bogor',
        'tanggal_lahir'=> $tanggal_lahir,
        'nik'=> $nik,
        'nama_ayah'=>$faker->name,
        'nama_ibu'=>$faker->name,
        'email'=>$faker->unique()->safeEmail,
        'jenis_kelamin'=>$faker->randomElement($arr=array('pria','wanita')),
    ];
    
});

//faker data kartukeluarga
$factory->define(App\kartukeluarga::class,function(Faker\Generator $faker){
    $id=Aktalahir::pluck('id')->all();
    $kk_id=$faker->randomElement($id);
    $desa=desa::pluck('desa')->all();
    $RandomDesa=$faker->randomElement($desa);
    $kode_kecamatan = Kecamatan::pluck('kode_kecamatan')->all();
    $random_kodekecamatan=$faker->randomElement($kode_kecamatan);
    $dimohon=$faker->date($format='Y-m-d', $max='NOW');
    $getdate=explode("-",$dimohon);
    $date=$getdate[2];
    $mothn=$getdate[1];
    $year=substr($getdate[0],2);
    $create=$date.$mothn.$year;
    $rt=$faker->randomNumber(1);
    $rw=$faker->randomNumber(1);
    $randomNumber=$faker->randomNumber(4);
    $no_kk=$random_kodekecamatan.$create.$randomNumber;
    //$kk=str_replace('-','',$no_kk);
        return[
        'kepala_keluarga_id'=>$kk_id,
        'rt'=>$rt,
        'rw'=>$rw,
        'alamat'=>$RandomDesa,
        'kodearea'=>$random_kodekecamatan,
        'active'=>'0',
        'no_kk'=>$no_kk,
        'created'=>$dimohon,
        ];


   
});

$factory->define(App\detail_kartukeluarga::class,function(Faker\Generator $faker){
        $desa=desa::pluck('id')->all();
        $RandomDesa=$faker->randomElement($desa);
        $kodepos=desa::pluck('kode_pos')->all();
        $RandomKodepos=$faker->randomElement($kodepos);
        return[
            'kartukeluarga_id' => function () {
            return factory(App\kartukeluarga::class)->create()->id;
            },
            'desa'=>$RandomDesa,
            'kabupaten'=>'bogor',
            'provinsi'=>'Jawabarat',
            'kode_pos'=>$RandomKodepos,
            'nik'=>function(){
                return factory(App\kartukeluarga::class)->create()->kepala_keluarga_id;
            }
        ];
        
        
        
});