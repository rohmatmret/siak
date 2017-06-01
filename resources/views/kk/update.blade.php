@extends('layouts.theme')
@section('title','Update Kartu Keluarga')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		@include('flash::message')
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Update Kartu Keluarga</h4>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form action="{{ url('e-kk/detail') }}" method="POST" role="form">
		            {{ csrf_field() }}
		                <div class="row">
		                 	<div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nik</label>
									<input type="number" name="nik" class="form-control" >
								</div>
		                    </div>
		                </div>
		               
		                <div class="row">		                    
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">No KK yg di update</label>
									<input type="text" name="no_kk" class="form-control" >
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