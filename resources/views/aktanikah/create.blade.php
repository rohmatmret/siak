@extends('layouts.theme')
@section('title','Buat Akta Nikah')	
@include('layouts.header')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-3" style="top: 100px">	
		    <div class="card">	
		    	<div style="position: absolute; top: 10px; width: 90%; left: auto;right: auto;" >
		              @include('flash::message')
		            </div>	    
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
									<input type="number" name="nik_pengantin_pria" value="{{ old('nik_pengantin_pria') }}" class="form-control" autofocus="">
								</div>
		                    </div>
		                </div>
		                <div class="row">		                   
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">NIk Pengantin Wanita</label>
									<input type="number" name="nik_pengantin_wanita" value="{{ old('nik_pengantin_wanita') }}" class="form-control" >
								</div>
		                    </div>
		                </div>

		                <button type="submit" class="btn btn-primary pull-right">Buat</button>
		                
		            </form>
		        </div>
		    </div>
		</div>
		<script>
       $('div.alert').delay(3000).fadeOut(9000);
    </script>		
	</div>
@endsection()