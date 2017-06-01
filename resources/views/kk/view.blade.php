@extends('layouts.theme')
@section('title','kartu keluarga')
@section('content')
<div class="row" style="margin-top: 60px">
	<div class="col-md-8 col-md-offset-3">
	<a href="{{ url('e-kk/new') }}" class="btn btn-white">Buat baru</a>
    <a href="{{ url('e-kk/mutasi') }}" class="btn btn-white">Mutasi</a>
    <a href="{{ url('e-kk/update') }}" class="btn btn-white">Update</a>
        <div class="card">
        @include("flash::message")
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Data Kartu keluarga</h4>
                <p class="category">Ini data Kartu Keluarga  </p>
            </div>
            <div class="card-content table-responsive">
               <table class="table table-responsive">                   
                   <thead>
                       <tr>
                        <th colspan="" rowspan="" headers="" scope="">Id</th>
                           <th colspan="" rowspan="" headers="" scope="">Nama</th>
                           <th colspan="" rowspan="" headers="" scope="">Nik</th>
                           <th colspan="" rowspan="" headers="" scope="">ALamat</th>
                           <th colspan="" rowspan="" headers="" scope="">Desa</th> 
                           <th colspan="" rowspan="" headers="" scope="">No Kartu keluarga</th>
                           <th colspan="" rowspan="" headers="" scope="">Kepala keluarga</th>
                       </tr>
                   </thead>
                   <tbody>
                 
                     @foreach ($kk as $no=>$data)
                      <tr>
                      <td colspan="" rowspan="" headers="">{{ ++$no }}</td>
                      <td colspan="" rowspan="" headers="">{{ $data->akta->nama }}</td>
                      <td colspan="" rowspan="" headers="">{{ $data->nik }}</td>   
                      <td colspan="" rowspan="" headers="">{{ $data->kk->alamat }}</td> 
                      <td colspan="" rowspan="" headers="">{{ $data->desa }}</td>
                      <td colspan="" rowspan="" headers="">{{ $data->kk->no_kk }}</td>
                      <td  style="color: blue">
                       @if ($data->kk->kepala_keluarga_id==$data->akta->id)
                          {{ 'Kepala keluarga' }}
                       @else 
                       {{ '-' }}  
                       @endif
                       </td>
                      </tr>
                     @endforeach

                   </tbody>
               </table>

            </div>

           
        </div>
    </div>
    <script>
       $('div.alert').fadeOut(3000);
    </script>
</div>	
@stop