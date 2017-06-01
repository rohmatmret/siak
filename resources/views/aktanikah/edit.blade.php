@extends('layouts.theme')
@section('title','Buat Akta Nikah')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Form Permohonan Akta Lahir Nikah</h4>
		            <h6 class="title">Baru</h6>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form role="form" action="{{ url('/e-aktanikah') }}" method="POST">
		             {{ csrf_field() }}
		                <div class="row">		                   
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">NIk Pengantin pria</label>
									<input type="number" name="nik_pengantin_pria" value="{{ $aktanikah->nik_suami }}" class="form-control" autofocus="">
								</div>
		                    </div>
		                </div>
		                <div class="row">		                   
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">NIk Pengantin Wanita</label>
									<input type="number" name="nik_pengantin_wanita" value="{{ $aktanikah->nik_istri }}" class="form-control" >
								</div>
		                    </div>
		                </div>

		                <button type="submit" class="btn btn-primary pull-right">Buat</button>
		                
		            </form>
		        </div>
		    </div>
		</div>		
	</div>

</div>

@endsection()