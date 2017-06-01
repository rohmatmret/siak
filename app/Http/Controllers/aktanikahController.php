<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aktanikah;
use App\aktalahir;
use App\kecamatan;
use Auth;
class aktanikahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aktanikah=aktanikah::paginate(20);
        $row=aktanikah::count();
        return view('aktanikah.index',compact('aktanikah','row'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aktanikah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nik_pengantin_wanita'=>'required',
            'nik_pengantin_wanita'=>'required',
            ]);

        $nik_pria=$request->get('nik_pengantin_pria');
        $nik_wanita=$request->get('nik_pengantin_wanita');

        /*
        |---------------------------------------------------
        | Check status pernikahan
        |---------------------------------------------------
        |
        */

        $pria_status=$this->StatusPernikahan_pria($nik_pria);
        if ($pria_status==true) {
            //dd("sudah pernah menikah & dalam pernikahan");
            flash("data ".$nik_pria. " sudah pernah menikah & dalam pernikahan")->error();
            return redirect()->back()
                        ->withInput();
                            
        }
        $wanita_status=$this->StatusPernikahan_wanita($nik_wanita);
        if ($wanita_status==true) {
            //dd("sudah pernah menikah & dalam pernikahan");
            flash("data " .$nik_wanita." sudah pernah menikah & dalam pernikahan")->error();
            return redirect()->back()
                    ->withInput();
                            
        }

       
        /*
        |--------------------------------------------------------
        | Check Jenis kelamin Pasangan pengantin
        |--------------------------------------------------------
        |
        */
        if ($nik_pria==$nik_wanita) {
            //dd('nik Pengantin pria tidak boleh sama dengan wanita ');
            flash('nik Pengantin pria tidak boleh sama dengan pengantin wanita ')->error();
            return redirect()->back()
                    ->withInput();
        }

        $check_nik_pria=$this->checknik($nik_pria);
        $check_nik_wanita=$this->checknik($nik_wanita);
        /*
        |---------------------------------------------------
        | Check valid nik
        |---------------------------------------------------
        |
        */
        if ($check_nik_pria < 1 && $check_nik_wanita < 1) {
           return redirect()->back();
                    //->withErrors();
        }
        /*
        |---------------------------------------------------
        | Check valid jenis kelamin by nik
        |---------------------------------------------------
        |
        */
        $Jeniskelamin_pria=$this->check_jeniskelamin($nik_pria);
        $Jeniskelamin_wanita=$this->check_jeniskelamin($nik_wanita);
        if ($Jeniskelamin_pria !="pria") {           
            flash("Input data ".$nik_pria. " jenis kelamin wanita")->error();
             return redirect()->back();
        }
        if ($Jeniskelamin_wanita !="wanita") {           
            flash("Input data ".$nik_wanita ." jenis kelamin pria")->error();
             return redirect()->back();
        }
        
        $kodearea=$this->getkodearea();
        $getdate=$this->date();
        $format_date=explode('-',$getdate);
        $day=$format_date[2];
        $month=$format_date[1];
        $year=substr($format_date[0],2);
        $kode_urut_akhir=5;

        $check_row_aktanikah=$this->checkData_aktanikah($kodearea,$getdate);
        if ($check_row_aktanikah > 0) {
            $kode_urut_akhir +=str_pad($check_row_aktanikah,4,"0",STR_PAD_LEFT);
        }else{
            $kode_urut_akhir =str_pad($kode_urut_akhir,4,"0",STR_PAD_LEFT);
        }   
        //dd($kode_urut_akhir);
        $nomor_aktanikah=$kodearea.$day.$month.$year.$kode_urut_akhir;
        //dd($nomor_aktanikah);
        /*
        |--------------------------------------------------
        | Save => to update aktanikah
        |--------------------------------------------------
        */
        $aktanikah= new aktanikah();
        $aktanikah->nik_suami=$nik_pria;
        $aktanikah->nik_istri=$nik_wanita;
        $aktanikah->nomor_aktanikah=$nomor_aktanikah;
        $aktanikah->created=$getdate;
        $aktanikah->kodearea=$kodearea;
        //dd($aktanikah);
        $aktanikah->save();

        flash('Akta NIkah Berhasil dibuat')->success();
        return redirect()->to('/e-aktanikah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aktanikah=aktanikah::find($id);
        return view('aktanikah.view',compact('aktanikah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aktanikah=aktanikah::where('id',$id)->first();
        return view('aktanikah.edit',compact('aktanikah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aktanikah=aktanikah::Find($id);

        if ($aktanikah=null) {
            flash('id aktanikah tidak ada')->error();
            return redirect()->back();
        }

        $aktanikah->nik_suami=$request->get('nik_pengantin_pria');
        $aktanikah->nik_istri=$request->get('nik_pengantin_wanita');
        $aktanikah->save();

        flash('Aktakelahiran'.$id.' berhasil di Update')->success();
        return redirect()->to('e-aktanikah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /*
    |--------------------------------------------------------------------
    | Dispaly date to day local Jakarta
    |----------------------------------------------------------------------
    */
    public function date()
    {
        $date=date('Y-m-d');
        return $date;
    }

    /*
    |-------------------------------------------------------------------
    |
    |-------------------------------------------------------------------
    */
    public function checknik($nik)
    {
        $data=aktalahir::where('nik',$nik)
                        ->where('active',1)->count();
        return $data;
    }
    /*
    |----------------------------------------------------------------------
    | Check kebenaran jenis kelamin input nik
    |----------------------------------------------------------------------
    |
    */
    public function check_jeniskelamin($nik)
    {
        $data=aktalahir::where('nik',$nik)
                        ->where('active',1)->first();
        $jenis_kelamin=$data->jenis_kelamin;                
        return $jenis_kelamin;
    }
    /*
    |-------------------------------------------------------------------
    |  get kode area  By ( kecamatan )
    |-------------------------------------------------------------------
    */

    public function getkodearea()
    {
        $id=Auth::guard('admin')->user()->kecamatan_id;
        $area=kecamatan::where('id',$id)->first();
        $kodearea=$area->kode_kecamatan;
        return $kodearea;

    }

    public function checkData_aktanikah($kodearea,$getdate)
    {
        $checkData=aktanikah::where('kodearea',$kodearea)
                            ->where('created',$getdate)
                            ->count();
        return $checkData;
    }

    public function StatusPernikahan_pria($nik)
    {
        $data= aktanikah::where('nik_suami',$nik)->first();
        if ($data==null) {
           return false;
        }else{
            $check_satusnikah=$data->active;
            return $check_satusnikah;
        }
        
        //$statuspernikahan=pe
    }
    public function StatusPernikahan_wanita($nik)
    {
        $data= aktanikah::where('nik_istri',$nik)->first();
         if ($data==null) {
           return false;
        }else{
            $check_satusnikah=$data->active;
            return $check_satusnikah;
        }
        
    }

}
