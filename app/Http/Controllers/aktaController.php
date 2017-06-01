<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aktalahir;
use App\kecamatan;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\detail_users;
use App\info_akta;
use DB;

class aktaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
       
    }
    /**
    |--------------------------------------------------
    | Menpilkan Page Awal { e-aktalahir }
    |--------------------------------------------------
    | Berdasarkan Auth logiin
    |
    */
    public function index()
    {
        if(Auth::guard('admin')){            
            /*
            |$akta=DB::table('aktalahirs')
            ->select('id','nama','tanggal_lahir','nik','nama_ibu','nama_ayah','jenis_kelamin','lahir','active')
            ->paginate(10); 
            */
            $akta=aktalahir::paginate(10);

        }else{

            $nik=Auth::guard('users')->user()->nik;
            $akta=aktalahir::where()->paginate(20);
            /*
            $akta=DB::table('aktalahirs')
            ->select('id','nama','tanggal_lahir','nik','nama_ibu','nama_ayah','jenis_kelamin','lahir','active')
            ->where('nik',$nik)
            ->paginate(10);
            */
             
        }
       //$row=DB::table('aktalahirs')->count();
        $row=aktalahir::count();  
        return view('akta.index',compact('akta','row'));
    }

    /*
    |---------------------------------------------------------------
    | Mengabil data dari inputan Form 
    |---------------------------------------------------------------
    |
    */
    public function getdata(Request $request)
    {
        $data = new aktalahir();
        $data->nama=$request->get('nama');
        $data->tanggal_lahir=$request->get('tanggal_lahir');
        $data->lahir=$request->get('lahir');
        $data->nama_ibu=$request->get('nama_ibu');
        $data->nama_ayah= $request->get('nama_ayah');
        $data->email=$request->get('email');
        $data->jenis_kelamin=$request->get('jenis_kelamin');
        return $data;
    }
    /*
    |---------------------------------------------------------------
    |
    |--------------------------------------------------------------
    |
    */
    public function checkData($tanggal_lahir,$jenis_kelamin)
    {

        $user=aktalahir::where('tanggal_lahir',$tanggal_lahir)
                    ->where('jenis_kelamin',$jenis_kelamin)
                    ->get();
        return $user;
    }

    /*
    |---------------------------------------------------------------
    | Mencari data yang sama 
    |--------------------------------------------------------------
    |
    */
    public function jumlahDataSama($tanggal_lahir,$jenis_kelamin)
    {
        $row=aktalahir::where('tanggal_lahir',$tanggal_lahir)
                        ->where('jenis_kelamin',$jenis_kelamin)
                        ->count();
        return $row;
    }

    /*
    |---------------------------------------------------------------
    | Memberikan kode berdasarkan operator input
    |--------------------------------------------------------------
    | Proses Pembuatan aktakelahiran ini di lakukan di desa setempat
    | jadi untuk kode wilayah di ambil dari desa yg di mohon
    | pemohon hanya dapat mengajukan aktakelahiran di daerah masing2
    |
    */
    public function kodearea()
    {
        $id=Auth::guard('admin')->user()->kecamatan_id;       
        $kecamatan=kecamatan::where('id',$id)->first();
        $kodearea=$kecamatan->kode_kecamatan;
        return $kodearea;
    }
    
    /*
    |-------------------------------------------------------------------
    | Note=> Proses pembutan nik {nomor induk kependudukan }
    |-------------------------------------------------------------------
    | Nik di buat pada saat permohonan akta , berdasarkan 
    | kodearea + tgl_lahir + kodeotomatis 4 digit
    |
    |--------------------------------------------------------------------
    | Function menyimpan data
    |--------------------------------------------------------------------
    | Peromohonan aktakelahiran
    |
    |
    */
    public function store(Request $request)
    {       
        $this->validate($request,[
            'nama'=>'required|min:2',
            'tanggal_lahir'=>'required',
            'lahir'=>'required',
            'nama_ibu'=>'required',
            'nama_ayah'=>'required']);

        $data =$this->getdata($request);
        $kelamin =$data->jenis_kelamin;
        $kodearea=$this->kodearea(); 
        $tanggal_lahir=$request->get('tanggal_lahir'); // Format yg di dapat 2017-04-30 { thn-bln-hari}
        $date=explode("-",$tanggal_lahir);
        
        $tgl=$date[2]; //mengambil kode /data tgl 

        if($kelamin=="wanita"){
            $tgl=$date[2]+40; //jika jenis kelamin wanita tambahkan 40
        }      
        
        $bln=$date[1]; // mengambil kode bln 
        $thn=substr($date[0],2); // mengambil 2 angka terakhir dari tahun // misal 1990 yg di ambil 90
        
        $kodelahir=$tgl.$bln.$thn;//pengabungan tgk+bln+thn code valide      
        
        $kodeakhir=2;//initial kode untuk generate kode akhir dri nik
        /*
        |-----------------------------------------------------------------------
        | check data yang ada di database 
        | dengan kodearea ,jeniskelamin dan tgl lahir yang sama
        |-------------------------------------------------------------------------
        */
        $coba_cek=$this->jumlahDataSama($tanggal_lahir,$data->jenis_kelamin);
        /*
        | JIka sudah ada terdaftar dengan kodearea + jeniskelamin + birthday sama
        | Kode akhir  + row 
        |
        */
        if ($coba_cek>0) {
           $kode =$kodeakhir +$coba_cek;
           $kodeakhir=str_pad($kode,4,"0",STR_PAD_LEFT); //hasil code misal 0000 + row
           
        }else{
           $kodeakhir=str_pad($kodeakhir,4,"0",STR_PAD_LEFT); //hasil code misal 00002
        }
        
        $nik=$kodearea.$kodelahir.$kodeakhir;
        $data->nik=$nik;        
        $data->save();
        flash('Permohonan akta berhasil di upload')->success();
        
        return redirect()->to('/e-aktalahir');
    }



    /*
    |---------------------------------------------------------------
    | Menmpilkan aktalahir yg dimohon
    |--------------------------------------------------------------
    |
    */
    public function view($id)
    {
        $akta=aktalahir::where('id',$id)->first();
        return view('akta.view',compact('akta'));
    }

    /*
    |---------------------------------------------------------------
    | Proses menampilkan Form pembuatan / permohonan aktalahir
    |--------------------------------------------------------------
    |
    */
    public function create(){
        return view('akta.create');
    }

    /*
    |---------------------------------------------------------------
    | Proses validati / persetujuan permohonan akta
    |---------------------------------------------------------------
    | dilakukan oleh dinas / pusat 
    | apabila di acc maka dibuat data acount untuk proses auth 
    | Agar pemohon dapat login ke web dinas
    |
    */
    public function validate_akta($id)
    {
        $user=Auth::guard('admin')->user();
        $kecamatan_id =$user->kecamatan_id;
        $desa_id=$user->desa_id;
        DB::beginTransaction();
        try{
            $data = aktalahir::where('id',$id)->first();       
            $data->active=true;
            $data->save();
            $nama=$data->nama;
            $nik=$data->nik;
            $tanggal_lahir=$data->tanggal_lahir;
            $fd=explode("-",$tanggal_lahir);
            $tgl=$fd[2];
            $bln=$fd[1];
            $thn=$fd[0];
            $password=$tgl.$bln.$thn;
          
            $user= new user();           
            $user->nama=$nama;
            $user->nik=$nik;
            $user->email=$data->email;
            $user->password=bcrypt($password);  
            $user->status="users";         
            $user->save();

            $detail=new detail_users();
            $detail->user_id=$user->id;
            $detail->kecamatan_id=$kecamatan_id;
            $detail->desa_id=$desa_id;
            $detail->active=1;             
            $detail->save();

        }catch(ValidationException $e){
            DB::rollback();
            return redirect::to('/e-aktalahir')
            ->withErrors($e->getErrors())
            ->withInput();
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }  
        DB::commit();
        flash("Akta " .$nama. " berhasil di active kan")->success();
        return redirect()
        ->to('e-aktalahir');       

    }

    /*
    |---------------------------------------------------------------
    |
    |--------------------------------------------------------------
    |
    */
    public function update()
    {        
        return view('akta.update');
    }

    /*
    |---------------------------------------------------------------
    |
    |--------------------------------------------------------------
    |
    */
    public function edit($id)
    {
        $akta=aktalahir::where('id',$id)->first();
        return view('akta.edit',compact('akta'));
        //return view('akta.edit');
    }

    

    /*
    |---------------------------------------------------------------
    | meng-update data aktalahir apabila ada kesalahan
    |--------------------------------------------------------------
    |
    */
    public function postupdate(Request $request,$id)
    {
        $data= aktalahir::where('id',$id)->first();
        if($data==null){
            flash('data tidak ada')->success();
            return redirect()->to('e-aktalahir');
        }
        $data->tanggal_lahir=$request->get('tanggal_lahir');
        $data->nama=$request->get('nama');
        $data->lahir=$request->get('lahir');
        $data->jenis_kelamin=$request->get('jenis_kelamin');
        $data->nama_ibu=$request->get('nama_ibu');
        $data->nama_ayah=$request->get('nama_ayah');
        $data->save();
        flash('Data'.'berhasil di update')->success();
        return redirect()->to('/e-aktalahir');
    }

    /*
    |---------------------------------------------------------------
    | Filter data berdasrkan kondisi tertentu
    |--------------------------------------------------------------
    | Aktakelahiran
    |
    */
    public function filter($data)
    {
               
         $akta=aktalahir::where('active',$data)
            ->paginate(10);

        if ($data=='1') {
            $data="active";
        }else{
             $data="Blm active";
        }
        return view('akta.filter',compact('akta','data'));
    }

    /*
    |---------------------------------------------------------------
    | Proses penyimpanan data penundaan Persetujuan permohonan akta
    |--------------------------------------------------------------
    | Alsan penundaan  / revisi 
    |
    */
    public function Revisi(Request $request,$id)
    {

        $data = new info_akta();
        $data->aktalahir_id=$id;
        $data->keterangan=$request->get('keterangan');
        $data->save();
        flash('data untuk di revisi berhasil')->error();
        return redirect('/e-aktalahir');
    }
    /*
    |---------------------------------------------------------------
    | Menampikan Form Revisi / penundaan persetujuan aktalahir
    |--------------------------------------------------------------
    |
    */
    public function getRevisi($id)
    {
        $data=aktalahir::where('id',$id)->first();
        return view('akta.revisi',compact('data'));
    }

    /*
    |---------------------------------------------------------------
    | Mennampilkan data nik untuk proses update data
    |--------------------------------------------------------------
    | bind json ke form update { cari } dengan key nik
    |
    */
    public function cari($nik)
    {
        $data = aktalahir::where('nik',$nik)->first();
        if ($data==null) {
           return response()->json(collect(['info' => 'Data Tidak di Temukan ']));             
        }
        
        return response()->json($data);
    }
}
