@extends('layouts.theme')
@section('title','Buat Akta Lahir')	
@include('layouts.header')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		           <h4 class="title">Form Penolakan Permohonan</h4>
		           <h6 class="title">Akta Kelahiran</h6>
		        </div>
		        <div class="card-content">
		            <form class="form-horizontal" method="POST" action="{{ url('e-aktalahir/'.$data->id.'/revisi') }}">
		            {{ csrf_field() }}
			            <div class="row">
			            	<div class="col-md-4">
			            		<div class="form-group label-floating">
			            			<label class="control-label">Nama </label>
			            			<input type="text" name="nama" value="{{ $data->nama }}" readonly="true" class="form-control">
			            		</div>
			            	</div>
			            </div>
		              	<div class="row">
		                	<div class="col-md-6">
		                		<div class="form-group label-floating">
		                			<label class="control-label">keterangan Penolakan / revisi</label>
		                			<textarea name="keterangan" class="form-control" id="keterangan">
		                				
		                			</textarea>
		                		</div>
		                	</div>
		                </div>
		                <button type="submit" class="btn btn-md btn-danger">POST</button>

		            </form>
		        </div>
		    </div>
		</div>
	</div>
@endsection()