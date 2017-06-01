@extends('layouts.theme')
@section('title','Buat e-ktp Baru')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		@include('flash::message')
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Form Permohonan Ktp</h4>
		            <h6 class="title">Baru</h6>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form >
		            {{ csrf_field() }}
		                <div class="row">
		                   
		                 
		                <div class="row">
		                	<div class="col-md-6">
		                		<div class="form-group label-floating">
		                			<label class="control-label">No Kartu Keluarga</label>
		                			<input type="number" name="no_kk" id="no_kk" class="form-control">
		                		</div>
		                	</div>
		                </div>
		               		                
		              	<a class="btn btn-info " id="clear" style="display: none">clear</a>
		                <a class="btn btn-primary pull-right" id="post">cek</a>
		                <div class="clearfix"></div>
		            </form>
		        </div>

		        
		    </div>
		</div>	
		
	</div>
	<div class="row">
		<div class="col-md-7 col-md-offset-3">
			<div class="card">
				<div class="card-header" data-background-color="purple">
		                <h4 class="title">Data </h4>                
            </div>
			<table  class="table table-responsive">
				<thead>
					<tr>
						<th>No</th>
						<th colspan="" rowspan="" headers="" scope="">NIk</th>
						<th colspan="" rowspan="" headers="" scope="">Active</th>
						<th colspan="" rowspan="" headers="" scope="">Proses KTP</th>
					</tr>
				</thead>
				<tbody id="table">
					
				</tbody>
			</table>
    		</div>
		</div>		
	</div>
	<script>

			$('#post').click(function(){
				var data =$('#no_kk').val();				
					//example url http://localhost:8000/e-kk/32011501231231	
				$.get("http://localhost:8000/e-kk/"+data,function(isi){					
					$('#table').empty();

					$.each(isi,function(index,list){
						$('#table').append("<tr><td>"
							+index+"</td><td><input type=text name=nik value="+list.nik+" class=form-control></td>"						
							+"<td></td><td>"
							+"<td><form method=post  action={{ url('e-ktp') }}>"
									+"<input type=hidden name=_token value={{ csrf_token() }}>"
									+"<input type=hidden name=nik value="+list.nik+">"
									+"<input type=hidden name=no_kk value="+data+">"
									+"<button onclick=Myconfirm() class=btn-sm btn-default>View</button></form></td></tr>");
						
						
					});
				});

				$('#post').hide();
				$('#clear').show();
					
			});
			function Myconfirm() {
			  if(confirm('are you sure?')==true){
			  	$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				});
			 	
			  }

			    
			}

			$('#clear').click(function(){
				$('#post').show();
				$('#table').empty();
				document.getElementById("no_kk").value=" ";
			});
			
	</script>	
</div>

@endsection()