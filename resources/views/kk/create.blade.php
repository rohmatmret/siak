@extends('layouts.theme')
@section('title','Buat Kartu Keluarga Baru')	
@include('layouts.header')
@section('content')

<div class="container" style="margin-top: 70px;">
	
	<div class="row">
		<div class="col-md-8 col-md-offset-3">		
		
		    <div class="card">
		    @include('flash::message')
		        <div class="card-header" data-background-color="purple">
		     
		            <h4 class="title">Form Permohonan Kartu Keluarga</h4>
		            <h6 class="title">Baru</h6>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form method="POST" action="{{ url('/e-kk') }}" role="form">
		            {{ csrf_field() }}
		                <div class="row">		                  
		                    <div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Nik</label>
									<input type="number" name="nik" class="form-control" >
									<label>Kepala Keluarga</label>
								</div>
								@if ($errors->has('nik'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                @endif
		                    </div>
		                </div>
		                <div class="row">
			               <div class="col-md-3">
			               		<label class="form-control">Status Pernikahan </label>
			                      @if ($errors->has('status'))
	                                    <span class="help-block" style="color:red">
	                                        <strong>{{ $errors->first('status') }}</strong>
	                                    </span>
	                              @endif		   
			               </div>
			            </div>			
			            <div class="row">
		                    <div class="col-md-3">	
		                    	<div class="radio">
		                    		<label>	                    		                    	
			                    	<input type="radio" id="nikah" name="status" value="nikah">
			                    	Nikah</label>
		                    	</div>		                         	
		                    </div>

		                    <div class="col-md-3">
		                    	<div class="radio">
		                    		<label>
		                    		<input type="radio" name="status" value="blmnikah" id="blmnikah">
		                    		Blm Nikah</label>
		                    	</div>
		                      	
		                    </div>
			               	                      
		                </div>    
		                <div class="row">
		                   
		                    <div class="col-md-9" >
								<div class="form-group label-floating" id="snikah">
									
									
								</div>
		                    </div>
		                 
		                </div>
		                <div class="row">
		                	<div class="col-md-9">
		                		<div class="form-group label-floating">
		                			<label class="control-label">ALamat</label>
		                			<input type="text" name="alamat" value="" class="form-control" rows="5">
		                		</div>
		                		@if ($errors->has('alamat'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
		                	</div>
		                	<div class="col-md-1">
		                		<div class="form-group label-floating">
		                			<label class="control-label">Rt</label>
		                			<input type="text" name="rt" value="" class="form-control">
		                		</div>		                		
		                	</div>
		                	<div class="col-md-1">
		                		<div class="form-group label-floating">
		                			<label class="control-label">Rw</label>
		                			<input type="text" name="rw" value="" class="form-control">
		                		</div>		                		
		                	</div>
		                </div>
		                <div class="row">
		                	<div class="col-md-5">
		                		<div class="form-group label-floating">
		                			<label class="control-label">Desa</label>
		                			<select name="desa_id" class="form-control">
		                				<option value=""></option>		     
		                				@foreach ($desa as $d)
				           					<option value="{{ $d->id }}">{{ $d->desa }} | {{ $d->kode_pos }}</option>		
				           				@endforeach           				
		                			</select>
		                		</div>
		                		@if ($errors->has('desa_id'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('desa_id') }}</strong>
                                    </span>
                                @endif
		                	</div>
		                	<div class="col-md-3">
		                		<div class="form-group label-floating">
		                			<label class="control-label">KodePos</label>
		                			<input type="number" name="kode_pos" value="" class="form-control">
		                		</div>
		                		@if ($errors->has('kode_pos'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('kode_pos') }}</strong>
                                    </span>
                                @endif
		                	</div>
		                </div>
		                <div class="checkbox">
		                	<label>
								<input type="checkbox" name="keterangan" id="ketentuan">
								Dengan Ini anda menyatakan bahwa data yang di berikan benar 
								dan sesuai dengan data asli yang dimohon
							</label>
		                </div>

		                <button type="submit" id="kk" class="btn btn-primary pull-right" disabled>Upload data</button>
		                <div class="clearfix"></div>
		            </form>
		        </div>
		    </div>
		</div>		
	</div>
	<script>
		$("#nikah").click(function(){
			$('#snikah').empty();
			$('#snikah').append('<label class="control-label">Lampiran Copy / scan Suratnikah</label>');
			$("#snikah").append('<input type="file" name="snikah" >');
			$('#snikah').append('<label class="control-label">Tambahan Anggota</label>');
			$('#snikah').append('<input type="number" name="" value="" class="form-control">');
				//alert("hello");
		});
		$("#blmnikah").click(function(){
			$('#snikah').empty();
			var jomblo ="Usia pemohon harus lebih dari 21 thn ";
			$("#snikah").append('<input type="text" name="" value="'+jomblo+'" class="form-control" readonly style=color:red>');
		});

		$('#ketentuan').click(function(){
			if(this.checked) {	            
	            document.getElementById("kk").disabled = false;	
	        }else{
	        	var returnVal = confirm("warning Anda Harus Menyetujui untuk membuat data ");
	        	document.getElementById("kk").disabled = true;	
	        }
			
		});

	</script>
	<script>
	$('div.alert').fadeOut(6000);
	</script>
</div>

@endsection()