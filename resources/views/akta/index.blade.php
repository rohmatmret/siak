@extends('layouts.theme')
@section('title','Akta Lahir')
@section('content')
<div class="row">
<div class="col-md-10 col-md-offset-2">
	<a href="{{ url('e-aktalahir/new') }}" class="btn btn-white">Buat baru</a>
    <a href="{{ url('e-aktalahir/update') }}" class="btn btn-white">Update</a>

    <div class="row">
    	<div class="col-md-3">
	    	<div class="form-group label-floating">
	    			<label class="control-label">Filter</label>
		    	<select name="filter" class="form-control">	
		    		<option value=""></option>	    		
		    		<option value="0">Belum validasi</option>    
		    		<option value="1">Sudah validasi</option>	
		    		<option value="all">Semua Data</option>
		    	</select>
	    	</div>
	    	<a href="{{ url('/') }}" title="Cari" class="btn btn-sm btn-success">Filter</a>
    	</div>
    </div>
    
    
	<div class="card">
		<div class="card-header" data-background-color="purple">
			<h4 class="title">AKTA KELAHIRAN</h4>
                <p class="category">Jumlah Akta <b>{{  $row }}</b></p>
		</div>
		<div class="card-content table-responsive table-full-width">
		<div style="position: absolute; top: 130px; width: 90%; left: auto;right: auto;" >
			@include('flash::message')
		</div>
		
			<table class="table table-responsive">		
				
					<thead>
						<tr>
							<th>No</th>
							<th colspan="" rowspan="" headers="" scope="">Nama</th>
							<th colspan="" rowspan="" headers="" scope="">Nik</th>
							<th colspan="" rowspan="" headers="" scope="">Jenis kelamin</th>
							<th colspan="" rowspan="" headers="" scope="">lahir</th>
							<th colspan="" rowspan="" headers="" scope="">Tangal Lahir</th>
							<th colspan="" rowspan="" headers="" scope="">Nama Ibu</th>
							<th colspan="" rowspan="" headers="" scope="">Nama ayah</th>
							<th colspan="" rowspan="" headers="" scope="">active</th>
							<th colspan="" rowspan="" headers="" scope="">View</th>
							<th colspan="" rowspan="" headers="" scope="">Edit</th>
						</tr>
					</thead>
					<tbody>
					@php						
					$begin = memory_get_usage();
					@endphp

					@foreach ($akta as$no=>$data)
						<tr>
			                 <td colspan="" rowspan="" headers="">{{ ++$no }}</td> 
							<td>{{ $data->nama }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->nik }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->jenis_kelamin }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->lahir }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->tanggal_lahir }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->nama_ibu }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->nama_ayah }}</td>
							<td colspan="" rowspan="" headers="">{{ $data->active }}</td>
							<td colspan="" rowspan="" headers="">
							@if ($data->active==true)
								<a href="{{ url('/e-aktalahir/'. $data->id.'/view') }}"
							 	title="Tidak bisa di click " class="btn btn-sm btn-info" disabled="true">View</a></td>
							 @else
							 	<a href="{{ url('/e-aktalahir/'. $data->id.'/view') }}"
							 title="validate" class="btn btn-sm btn-info">View</a></td>
							@endif
							
							<td colspan="" rowspan="" headers="">
								<a href="{{ url('/e-aktalahir/'. $data->id.'/edit') }}"
							 	title="Edit" class="btn btn-sm btn-warning">Edit</a>
							</td>
						</tr>
					@endforeach							
					</tbody>
				<p>Total memori : {{ memory_get_usage()-$begin }}</p>
			</table>
		</div>
	{{ $akta->render() }}
	</div>
</div>
	<script>
       $('div.alert').delay(3000).fadeOut(6000);
        {{ session()->forget('flash_notification') }}
    </script>
</div>

@endsection