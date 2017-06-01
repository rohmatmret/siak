@extends('layouts.theme')
@section('title','e-ktp')
	{{-- expr --}}
@include('layouts.header')
@section('content')
<div class="row" style="margin-top: 60px">
	<div class="col-md-9 col-md-offset-3">
    
	<a href="{{ url('e-ktp/new') }}" class="btn btn-white">Buat Ktp</a>
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Data KTP</h4>
                <p class="category">Ini data KTP anda </p>
            </div>
            <div style="position: absolute; top: 130px; width: 90%; left: auto;right: auto;" >
              @include('flash::message')
            </div>
            <div class="card-content table-responsive">
               <table class="table table-responsive">
                  
                   <thead>
                       <tr>
                           <th>No</th>
                           <th colspan="" rowspan="" headers="" scope="">Nama</th>
                           <th colspan="" rowspan="" headers="" scope="">NIk</th>
                           <th colspan="" rowspan="" headers="" scope="">Pekerjaan</th>
                           <th colspan="" rowspan="" headers="" scope="">Tanggal lahir</th>
                           <th colspan="" rowspan="" headers="" scope="">Agama</th>
                           <th colspan="" rowspan="" headers="" scope="">Photo</th>
                           <th colspan="" rowspan="" headers="" scope=""></th>
                       </tr>
                   </thead>
                   <tbody>
                   @foreach ($ktps as$no=>$element)
                        <tr>
                           <td>{{ ++$no }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->nama }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->nik }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->pekerjaan }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->tanggal_lahir }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->agama }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->photo }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->created_at }}</td>
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