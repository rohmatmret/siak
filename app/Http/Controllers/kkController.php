<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kartukeluarga;
use App\detail_kartukeluarga;
use Illuminate\Support\Facades\Auth;
use App\aktalahir;
use App\kecamatan;
use App\desa;

use DB;

class kkController extends Controller
{
    /*
    |------------------------------------------------
    | Middelware onlyhanya auth :: admin yg akses
    |-------------------------------------------------
    |
    |
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
       
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    | Mengunakan Eloquent karena menggunakan Relationship dengan Table Detail dan Akakelahiran
    |  check model dari kartukeluarga untuk melihat Relationship
    */
    public function index()
    {        
        $kk=kartukeluarga::paginate(20); //menggunakan Eloquent karena memamkai Relationship
        $row=DB::table('kartukeluargas')->count();   //mengambil Jumlah data yg ada (tersimpan di database => kartueluarga)     
        return view('kk.index',compact('kk','row'));
    }

    /*
    |------------------------------------------------------------------
    |Menampilkan View untuk mengisi Form Pembuatan Baru kartu keluarga
    |------------------------------------------------------------------
    |
    |
    */
    public function create()
    {
        $id=Auth::guard('admin')->user()->kecamatan_id;
        $desa =desa::where('kecamatan_id',$id)->get();        
        return view('kk.create',compact('desa'));
    }

    /**
    |---------------------------------------------------------------------------
    | Menampilkan Tanggal sekarang
    |---------------------------------------------------------------------------
    | @return 
    */
    public function date(){
        $date=date("Y-m-d");   //Format tanggal 2017-06-28     
        return $date;
    }

    /*
    |-----------------------------------------------------------------------------------
    | Check jumlah data kartu keluarga Jika ada
    |-----------------------------------------------------------------------------------                                             
    |  kode daerah (kecamatan ) dana tanggal yang sama                                       
    |  maka kode akhir di kartukeluarga + Row yang ada                                       
    |
    */
    public function jumlahDatakk($kodearea,$date)
    {
       $check=kartukeluarga::where('kodearea',$kodearea)
                           ->where('created',$date)
                           ->count();
                            return $check;
    }
     
     /*
    |--------------------------------------------------------------------------
    | Get Kode area
    |--------------------------------------------------------------------------
    | kode area diambil dari 6 digit pertama dari kode nik 
    | misal 3201151506140002
    | yang di ambil 320115 => karena ini merupakan kode dari wilayah + kecamatan ( bogor )
    |
    */

    public function kodearea($nik)
    {        
        //$kodearea=substr($nik,0,6); //mengambil 6 digit awal dari kode nik Pemohon
        $kodearea=Auth::guard('admin')->user()->kode_kecamatan;
        return $kodearea;
    }

    /*
    |-----------------------------------------------------------------------
    | Mengambil Id dari desa dari Penginput data (area ) 
    |----------------------------------------------------------------------
    |
    */

    public function desa_id()
    {
        $desa_id=Auth::guard('admin')->user()->desa_id;
        return $desa_id;
    }

    /*
    |-----------------------------------------------------------------------
    | Mengambil Id dari kecamatan dari Penginput data (area ) 
    |----------------------------------------------------------------------
    |
    */
    public function kecamatan_id()
    {
        $kecamatan_id=Auth::guard('admin')->user()->kecamatan_id;
        return $kecamatan_id;
    }

    /*
    |-----------------------------------------------------------------------
    | Mengambil kodepos desa dari Penginput data (area ) 
    |----------------------------------------------------------------------
    |
    */
    public function kodepos()
    {
        $id=Auth::guard('admin')->user()->desa_id;
        $kode=desa::where('id',$id)->first();   
        $kodepos=$kode->kode_pos;
        return $kodepos;
    }
    /*
    |----------------------------------------------------------------------------
    | Check Nik Apakah Sudah dibuat / tercantuk di kartukeluarga
    |----------------------------------------------------------------------------
    | Apabila sudah terdaftar tidak bisa di proses
    |
    */
    public  function terdaftar($nik)
    {
        $terdaftar=DB::table('detail_kartukeluargas')
                    ->where('nik','=',$nik)->count();
                    return $terdaftar;
    }

    /*
    |---------------------------------------------------
    | Check ativesi dari nik 
    |---------------------------------------------------
    | Apabila Nik dari aktalahir blm Aktif maka tidak bisa
    | di proses pembuatan kartukeluarga
    |
    */
    public function CekActivasi($nik)
    {
        $cek=aktalahir::where('nik',$nik)->first();        
        return $cek;

    }


    /*
    |--------------------------------------------------
    | Otoriasasi untuk memastikan operator 
    |--------------------------------------------------
    | hanya dapat mem-proses warga yang kecamtan yg sama
    */
    public function otorisasi($kodearea,$nik_area)
    {
           if ($kodearea=$nik_area){

                return $data=false;

            }else{

                return $data=true;

            }

    }
    /*
    |--------------------------------------------------------------------------------|
    | Function store untuk menyimpan / membuat data kartukeluarga Baru               |
    |--------------------------------------------------------------------------------|
    | data berdasarkan inputan dari admin ( operator desa ) yang valid
    | data akan di simpan ke table kartukeluarga & detail_kartukeluarga
    | Apabila transaksi penyimpanan di salah satu table maka transaksi di kembalikan
    | Mysql => DB::transaction  
    | 
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nik'=>'required',
            'status'=>'required',
            'alamat'=>'required',
            ]);

        $nik=$request->get('nik');
        $nik_area=substr($nik,0,6);

        $kodearea =$this->kodearea(); 
        if ($kodearea==null) {

            flash('anda tidak di perbolehkan untuk input data')->error();
            return redirect()->back();

        }
        /*
        |------------------------------------------------
        | Otorisasi pembuatan Kartukeluarga
        |------------------------------------------------
        */
        $cekotorisasi=$this->otorisasi($kodearea,$nik_area);
        if ($cekotorisasi=false) {

           flash("Maaf Anda Hanya dapat mem-proses Dengan Kode area yang sama ")->error(); 
           return redirect()->to('/e-kk/new');

        }

        $active=$this->CekActivasi($nik);
        if ($active->active==false) {

           flash('nik di aktalahir belum active /  masih dalam proses')->error();
            return redirect()->back();

        }

        $cekdaftar=$this->terdaftar($nik);
        if ($cekdaftar > 0) {

            flash('nik Sudah terdaftar ')->error();
            return redirect()->back();

        }
       
        $dateformat=explode("-",$this->date()); //2017-05-30  {format year-month-day}

        $tgl=$dateformat[2];
        $bln=$dateformat[1];
        $thn=substr($dateformat[0],2);
        
        $kodeurut=3; //initial code akhir di kartukeluarga
        /*
        |----------------------------------------------------------
        | check data kartu keluarga denga kode area & tgl 
        | permohonan yg sama
        |----------------------------------------------------------
        |
        */
        $cekData=$this->jumlahDatakk($kodearea,$this->date());
       
        if ($cekData>=1) {

           $get=$kodeurut+$cekData; 
           $kodeurut=str_pad($get,4,"0",STR_PAD_LEFT);

        }else{

           $kodeurut=str_pad($kodeurut,4,"0",STR_PAD_LEFT);

        }
      
        DB::beginTransaction();
        try{
            $data =new kartukeluarga();  
            $data->rt=$request->get('rt');
            $data->rw=$request->get('rw');
            $data->alamat=$request->get('alamat');
            $kepala_keluarga_id=aktalahir::where('nik',$nik)->first();

                if ($kepala_keluarga_id==null) {
                   flash('data nik tidak ada ')->error();
                    return redirect()->back();                    
                }

            $tanggal=date("Y-m-d");// untuk data filed crated at di database
           
            $kodenomor_kartukeluarga=$kodearea.$tgl.$bln.$thn.$kodeurut;  //nomor kartukeluarga
            
            $id=$kepala_keluarga_id->id;
            $data->kepala_keluarga_id=$id;
            $no_kk=$kodenomor_kartukeluarga;
            $data->no_kk=$no_kk;
            $data->kodearea=$kodearea;
            $data->created=$tanggal;             
            $data->save();

            $detail = new detail_kartukeluarga();
            $detail->kartukeluarga_id=$data->id;
            $detail->nik=$nik;
            $detail->desa=$request->get('desa_id');
            $detail->kecamatan=$request->get('kecamatan_id');
            $detail->kode_pos=$request->get('kode_pos');
            $detail->kabupaten="bogor";
            $detail->provinsi="jawa barat";
            $detail->save();

        }catch(ValidationException $e){
            DB::rollback();
            return redirect::to('/e-kk/new')
            ->withErrors($e->getErrors())
            ->withInput();
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }  
        DB::commit();
         flash('Kartu keluarga berhasil di buat')->success();      
        return redirect()->to('/e-kk');
    }

    /*
    |----------------------------------------------------------------
    | Menpilkan Form Untuk Mutasi 
    |----------------------------------------------------------------
    */
    public function mutasi()
    {
        return view('kk.mutasi');
    }

    /*
    |-----------------------------------------------------------------
    |Menapilkan Form Update data
    ------------------------------------------------------------------
    |
    */

    public function update()
    {
        return view('kk.update');
    }

    public function ceknik($nik)
    {
        $get=aktalahir::where('nik',$nik)->first();
        return $get;
    }

    /*
    |--------------------------------------------------------
    | Function untuk menbahkan Angota keluarga
    |-------------------------------------------------------
    |
    */
    public function postupdate(Request $request)
    {
       
        $no_kk=$request->get('no_kk'); //get nomor kk
        $nik=$request->get('nik'); // get Nik pemohon
        /*
        |------------------------------------------------
        | check no kartukeluarga
        */
        $get=kartukeluarga::where('no_kk',$no_kk)->first();
        
        if (!$get) {

           flash("no kk tidak ada")->error();
           return redirect()->back();

        }
        $id=$get->id;

        /*
        |----------------------------------------------
        |cek nik apabila nik ada di kartu keluarga 
        |
        */
        $get=detail_kartukeluarga::where('nik',$nik)->count();
         //apabila ada return redirect back
        if ($get >0) {

            flash('data nik terdaftar di kartukeluarga , silah kan mutasi data untuk memindahkan nik')->error();
            return redirect()->back();

        }      
        
        /*
        |------------------------------------------------------------
        | check ke aslian nik
        |------------------------------------------------------------
        | Jangan sampai nik tidak terdaftar di aktakelahiran bisa di
        | inputkan ke dalam kartu kelurga
        |
        */
        $ceknik=$this->ceknik($nik);
        if (!$ceknik) {

            flash("nik tidak ada")->error();
            return redirect()->back();

        }
        /*
        |---------------------------------------------------------------------
        | Save data to details kartu keluarga
        |---------------------------------------------------------------------
        */
        $data= new detail_kartukeluarga();
        $data->kartukeluarga_id=$id;
        $data->nik=$nik;
        $data->desa=$this->desa();
        $data->kecamatan=$this->kecamatan();
        $data->kode_pos=$this->kodepos();
        $data->kabupaten="bogor";
        $data->provinsi="jawa barat";        
        $data->save();

        flash(' Berhasil menambah Anggota keluarga in ',$no_kk)->success();
        return redirect()->to('/e-kk');

    }
  
    /*
    |----------------------------------------------------------------------
    |    menpilkan semua angota keluarga untuk pembuatan e-ktp
    |----------------------------------------------------------------------
    |  
     */
    public function getanggota($no_kk)
    {
        $data = kartukeluarga::where('no_kk',$no_kk)->first();
        if ($data==null) {

            $data="data tidak ada";
            return response()->json($data);

        }

        $id=$data->getnik;              
        return response()->json($id);
    }

    /*
    |----------------------------------------------------------------------------
    | Menampikan detail kartu keluarga & Family
    |---------------------------------------------------------------------------
    */
    public function view($id)
    {
        /**
        / Note Untuk penggunaan Querey builder akan sulit untuk menggunakan relationship 
        // $kk=DB::table('kartukeluargas')
            ->join('aktalahirs','kartukeluargas.kepala_keluarga_id','aktalahirs.id')
            ->where('id','=',$id)->get();
        /==================================================================================
        */

        $kk=detail_kartukeluarga::where('kartukeluarga_id',$id)->get();
        return view('kk.view',compact('kk'));
    }


    /*
    |------------------------------------------------------------------------
    | mutasi Alamat di kartu keluarga 
    |------------------------------------------------------------------------
    */

    public function mutasi_alamat($nik,$kepala_keluarga_id)
    {
        DB::begintTransaction();
        try {

            $data = detail_kartukeluarga::where('nik',$nik)->delete();

        } catch (Exception $e) {

            return redirect()->to('/e-kk/mutasi')
                    ->withErrors();

        }

        DB::commit();
    }

    /*
    |-----------------------------------------------------------------------
    | mutasi Anggota kartu keluarga 
    |------------------------------------------------------------------------
    |
    */

    public function mutasi_anggota($id)
    {
        DB::begintTransaction();
        try {

            $data = detail_kartukeluarga::where('nik',$nik)->delete();

        } catch (Exception $e) {

            return redirect()->to('/e-kk/mutasi')
                    ->withErrors();

        }
        DB::commit();

        flash("berhasil")->success();
        return redirect()->to('/e-kk');
    }
}