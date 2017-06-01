@extends('layouts.theme')
@section('title','Buat Akta Lahir')	
@include('layouts.header')
@section('content')
<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-3">
		    <div class="card">
		        <div class="card-header" data-background-color="purple">
		            <h4 class="title">Form Permohonan Akta Lahir</h4>
		            <h6 class="title">update</h6>
					<p class="category">Isi data Dengan benar</p>
		        </div>
		        <div class="card-content">
		            <form class="form-horizontal">
		              	<div class="row">
		                	<div class="col-md-6">
		                		<div class="form-group label-floating">
		                			<label class="control-label">Nik</label>
		                			<input type="number" name="nik" id="nik" class="form-control">
		                		</div>
		                	</div>
		                </div>
		                <a id="cari" class=" btn btn-primary btn-md">cari</a>

		            </form>
		        </div>
		    </div>
		    <div class="card">
		    	<div class="card-content">
		    		<table class="table table-responsive">
		    			<thead>
		    				<tr>
		    					<th>nik</th>
		    				</tr>
		    			</thead>
		    			<tbody id="isi-table">
		    				
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
		</div>	
		<script>
			$('#cari').click(function(){
				var nik =$('#nik').val();
				$.get('/e-aktalahir/cari/'+nik,function(data){
					$('#isi-table').empty();
					if (data.nama==null) {
						document.getElementById("isi-table").innerHTML =data.info;
						//document.getElementById("isi-table").innerHTML =data.keterangan;
					}else{
						//document.getElementById("isi-table").innerHTML =data.nama + " "+ data.tanggal_lahir;
						$('#isi-table').append('<tr><td>'+data.nama+'</td><td>'
						+'<input type=hidden name=id id=id value='+data.id+'></td>'
						+'<td><button class=btn btn-sm btn-primary onclick=redirect()>Edit</button></td></tr>');
					}
					/*$('#isi-table').append('<tr><td>'+data.nama+'</td><td>'
						+'<input type=hidden name=id id=id value='+data.id+'></td>'
						+'<td><button class=btn btn-sm btn-primary onclick=redirect()>Edit</button></td></tr>');*/
						
				});
				
				
			});
			
			function redirect(){
				var id =$('#id').val();

				if(id==" "){
					window.location.href='http://localhost:8000/e-aktalahir';
				}else{
					window.location.href='http://localhost:8000/e-aktalahir/'+id+'/edit';
				}
					
			}

				
		</script>	
	</div>

</div>

@endsection()