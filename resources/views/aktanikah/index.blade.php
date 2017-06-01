@extends('layouts.theme')
@section('title','Akta Nikah')
@section('content')
<div class="row" style="margin-top: 60px">
	<div class="col-md-10 col-md-offset-2">
	  <a href="{{ url('e-aktanikah/new') }}" class="btn btn-success">Buat baru</a>    
    <a href="{{ url('e-aktanikah/edit') }}" class="btn btn-success">Edit</a>   
    <a href="{{ url('e-aktanikah/cerai') }}" class="btn btn-md btn-warning">cerai</a>
        <div class="card">
            <div style="position: absolute; top: 130px; width: 90%; left: auto;right: auto;" >
              @include('flash::message')
            </div>
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Akta Nikah</h4>
                <p class="category"> Jumlah data : {{ $row }} </p>
            </div>
            
            <div class="card-content table-responsive">
               <table class="table table-responsive">                   
                   <thead>
                       <tr>
                           <th>NO</th>
                           <th colspan="" rowspan="" headers="" scope="">Nama Suami</th>
                            <th colspan="" rowspan="" headers="" scope="">Nama Istri</th>  
                           <th colspan="" rowspan="" headers="" scope="">Alamat</th>  
                           <th colspan="" rowspan="" headers="" scope="">Nomor akta nikah</th>                         
                           <th colspan="" rowspan="" headers="" scope="">Dimohon</th>                                                  
                           <th colspan="" rowspan="" headers="" scope="">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                  @php            
                    $begin = memory_get_usage();
                  @endphp
                    @foreach ($aktanikah as$no=>$data)
                        <tr>
                          <td colspan="" rowspan="" headers="">{{ ++$no }}</td>
                          <td colspan="" rowspan="" headers="">{{ $data->namasuami->nama }} | {{ $data->nik_suami }}</td>
                          <td colspan="" rowspan="" headers="">{{ $data->namaistri->nama }} | {{ $data->nik_istri }}</td>
                          <td colspan="" rowspan="" headers=""></td>
                          <td colspan="" rowspan="" headers="">{{ $data->nomor_aktanikah }}</td>
                          <td colspan="" rowspan="" headers="">{{ $data->created_at }}</td>
                          <td colspan="" rowspan="" headers=""></td>
                        </tr>
                    @endforeach
                                         
                   </tbody>
                  
                    <p>Total memori : {{ memory_get_usage()- $begin }}</p>
               </table>


            </div>
            {{ $aktanikah->render() }}
        </div>
    </div>
    <script>
       $('div.alert').fadeOut(6000);
    </script>

    
</div>	
@stop