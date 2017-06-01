@extends('layouts.theme')
@section('title','Update e-ktp Baru')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Form Permohonan Ktp</h4>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form>
		                <div class="row">
		                   
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nama Lengkap</label>
									<input type="text" name="name" class="form-control" >
								</div>
		                    </div>
		                    <div class="col-md-4">
		                    <label class="control-label">Tanggal Lahir</label>
								<div class="form-group label-floating">
									
									<input type="date" name="tgl_lahir" class="form-control">
								</div>
		                    </div>
		                    
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Photo</label>
									<input type="file" name="photo" placeholder="Upload">
								</div>
		                    </div>
		                   
		                </div>
		                
		                <button type="submit" class="btn btn-primary pull-right">Upload data</button>
		                <div class="clearfix"></div>
		            </form>
		        </div>
		    </div>
		</div>		
	</div>
</div>

@endsection()