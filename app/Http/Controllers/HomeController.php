<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\desa;
use App\kecamatan;
use App\aktalahir;
use App\ktp;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countAkta=aktalahir::count();
        $countKtps=ktp::count(); 
        $kecamatan=DB::table('kecamatans')->get();       
        $desa = DB::table('kecamatans')
        ->join('desas','kecamatan_id','kecamatans.id')
        ->orderBy('kode_kecamatan','ASC')->get();
        return view('home',compact('desa','kecamatan','countAkta','countKtps'));
        
    }


    public function getCountDesa(){
        $desa = desa::count();
        return $desa;
    }
}
