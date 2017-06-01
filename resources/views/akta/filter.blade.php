@extends('layouts.theme')
@section('title','kartu keluarga')
	{{-- expr --}}

@section('content')
<div class="row" style="margin-top: 60px">
	
<div class="col-md-2 col-md-offset-2">
        <select name="filter" id="filter" class="form-control">
        <option>PIlih</option> 
        <option value="0">blm active</option>      
        <option value="1">Active</option>         
    </select>
    </div>
    <div class="col-md-9 col-md-offset-2">
     @include('flash::message')
    <a href="{{ url('e-aktalahir/new') }}" class="btn btn-white">Buat baru</a>
    <a href="{{ url('e-aktalahir/update') }}" class="btn btn-white">Update</a>
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Data </h4>
              <h3 class="title">Pencarian dengan  status : {{ $data }} </h3> 
            </div>
            <table class="table table-responsive">
                <thead >
                    <tr>
                        <th style="font-weight: bold;">No</th>
                        <th style="font-weight: bold;">Nama </th>
                        <th style="font-weight: bold;">Jenis Kelamin </th>
                        <th style="font-weight: bold;">Tanggal lahir</th>
                        <th style="font-weight: bold;">Lahir</th>
                        <th style="font-weight: bold;">Ibu</th>
                        <th style="font-weight: bold;">Ayah</th>
                        <th style="font-weight: bold;">Dimohon Tanggal</th>
                        <th colspan="" rowspan="" headers="" scope="">Status</th>
                        <th colspan="" rowspan="" headers="" scope="">View</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($akta as $no=> $data)
                    {{-- expr --}}
                    <tr>
                        <td colspan="" rowspan="" headers="">{{ ++ $no }}</td>
                        <td>{{ $data->nama  }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->jenis_kelamin }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->tanggal_lahir }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->lahir }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->nama_ibu }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->nama_ayah }}</td>
                       
                        <td colspan="" rowspan="" headers="">{{ $date=date('d-m-Y',strtotime($data->created_at)) }}</td>
                        
                        @if($data->active==1)
                        <td style="color:green">{{ $data->active }}</td>
                        @else
                        <td style="color:red">{{ $data->active }}</td>
                        @endif()
                        
                       
                        <td colspan="" rowspan="" headers="">
                        <a href="{{ url('/e-aktalahir/'.$data->id.'/view') }}" class="btn btn-sm btn-default">view</a></td>
                        
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
           
        </div>
        {{ $akta->render() }}
    </div>
    
   
   <script>
    $('div.alert').fadeOut(3000);

    $('#filter').change(function(){
        var data =$('#filter').val();
            window.location.href='http://localhost:8000/e-aktalahir/status='+data;
    });
    </script>
</div>	

@stop