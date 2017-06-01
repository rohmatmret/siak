<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ktp;
use App\aktalahir;
use App\kartukeluarga;
use App\detail_kartukeluarga;

class ktpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ktps=ktp::paginate(10);
        return view('ktp.index',compact('ktps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ktp.create');
    }
    /*
    |------------------------------------------------------------
    | Check tanggal lahir 
    |------------------------------------------------------------
    | Ambil data dari data aktalahir
    |
    */
    public function getTanggallahir($nik)
    {
        $date=aktalahir::where('nik',$nik)->first();
        
            if ($date==null) {
                flash('nik tidak terdaftar ')->success();
               return redirect()->back();
            }

        $lahir=$date->tanggal_lahir;
        return $lahir;

    }
    /*
    |-----------------------------------------------------------------
    | check kk
    |-----------------------------------------------------------------
    |
    */
    public function getIdkk($no_kk)
    {
        $id=kartukeluarga::where('no_kk',$no_kk)->first();   
        if($id==null){
             flash('nik tidak terdaftar ')->success();
               return redirect()->back();
        }   
        $get=$id->id;
       

        
        return $get;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                
        $nik=$request->get('nik');

        $info=ktp::where('nik',$nik)->count();

        if($info >0 ){
            flash('data sudah di buat')->error();
            return redirect()->to('e-ktp/new');
        }


        $getNama=aktalahir::where('nik',$nik)->first();
        if(count($getNama)<1){
            flash('data tidak ada')->error();
            return redirect()->to('e-ktp/new');
        }
        $nama=$getNama->nama;

        $tanggal_lahir=$this->getTanggallahir($nik);  

        $no_kk=$request->get('no_kk');
        $kk=$this->getIdkk($no_kk);    
        $status_nikah=$request->get('status_nikah');
        if ($status_nikah==null) {
            # code...
            $status_nikah="belum menikah";
        }

        $data = new ktp();
        $data->nama=$nama;
        $data->nik=$nik;
        $data->tanggal_lahir=$tanggal_lahir;
        $data->status_nikah=$status_nikah;
        $data->kartukeluarga_id=$kk;
        $data->save();
        
        flash('Ktp berhasil di upload')->success();
        return redirect()->to('e-ktp');
    }

   
    public function update()
    {
        return view('ktp.update');
    }

}
