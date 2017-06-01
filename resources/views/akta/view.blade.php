@extends('layouts.theme')
@section('title','Buat Akta Lahir')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Validasi Akta Lahir</h4>
		        </div>
		        <div class="card-content">
		            <form role="form" action="{{ url('/e-aktalahir/validate/'.$akta->id) }}" method="POST">
		            <input type="hidden" name="id" id="id" value="{{ $akta->id }}">
		             {{ csrf_field() }}
		                <div class="row">
		                   
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nama Lengkap</label>
									<input type="text" id="nama" name="nama" class="form-control" value="{{ $akta->nama }}">
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
									<label class="control-label">email</label>
									<input type="email" name="email" class="form-control" value="{{ $akta->email}}" >
								</div>
		                    </div>
		                </div>
		              
		                <button type="submit" class="btn btn-success btn-md">Acc</button>
		                <a onclick="redirect()" class="btn btn-md btn-danger">Revisi</a>
		            </form>
		        </div>
		    </div>
		</div>		
	</div>
	<script>
		$('#tunda').click(function(){
           
		});

		function redirect()
		{
		   var id=$('#id').val();
           window.location.href="http://localhost:8000/e-aktalahir/"+id+"/revisi";
		}
	</script>
</div>

@endsection()