@extends('layouts.theme')
@section('title','Edit Akta Lahir')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		@include('flash::message')
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Form Permohonan Akta Lahir</h4>
		            <h6 class="title">Baru</h6>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form role="form" action="{{ url('/e-aktalahir/'.$akta->id.'/update') }}" method="POST">
		             {{ csrf_field() }}
		                <div class="row">
		                   
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nama Lengkap</label>
									<input type="text" name="nama" class="form-control" value="{{ $akta->nama }}">
								</div>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-md-4">
		                    <label class="control-label">Tanggal Lahir</label>
								<div class="form-group label-floating">
									
									<input type="date" name="tanggal_lahir" class="form-control" value="{{ $akta->tanggal_lahir}}">
								</div>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-md-4">
		                    <label class="control-label">Jenis kelamin</label>
		                    	<div class="form-group label-floating">	
		                    			<select name="jenis_kelamin" class="form-control" id="kelamin">
		                    				
		                    				<option value="{{ $akta->jenis_kelamin }}" selected="">{{ $akta->jenis_kelamin }}</option>		
		                    				<option value="pria">Pria</option>
		                    				<option value="wanita">Wanita</option>             				
		                    			</select>

								</div>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">di Lahirkan dikota : </label>
									<input type="text" name="lahir" class="form-control" value="{{ $akta->lahir }}">
								</div>
		                    </div>
		                </div>
		                <div class="row">
		                     <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nama Ibu kandung : </label>
									<input type="text" name="nama_ibu" class="form-control" value="{{ $akta->nama_ibu}}">
								</div>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nama Ayah</label>
									<input type="text" name="nama_ayah" class="form-control" value="{{ $akta->nama_ayah }}" >
								</div>
		                    </div>
		                   
		                </div>
		                <div class="row">
		                	<div class="col-md-9">
		                		<div class="form-group label-floating">
									<label class="control-label">E-mail</label>
									<input type="email" name="email" class="form-control" value="{{ $akta->email}}" >
								</div>
		                    </div>
		                </div>
		              
		                <button type="submit" class="btn-primary btn-sm">Update</button>

		            </form>
		        </div>
		    </div>
		</div>		
	</div>

</div>

@endsection()