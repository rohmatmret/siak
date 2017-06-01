@extends('layouts.theme')
@section('content')
<div class="row">
	<div class="col-md-9 col-md-offset-3">
		<div class="col-md-4">
			<div class="card card-stats">
				<div class="card-header" data-background-color="blue">
					<i class="material-icons">content_copy</i>
				</div>
				<div class="card-content">
					<p class="category">Aktalahir</p>
					<h4 class="title">Jumlah : {{ $countAkta }} <small> Orang</small></h4>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-danger">warning</i> <a href="#pablo">Get More info...</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			 <div class="card card-stats">
				<div class="card-header" data-background-color="green">
					<i class="material-icons">content_copy</i>
				</div>
				<div class="card-content">
					<p class="category">KTP</p>
					<h4 class="title"> Jumlah : {{ $countKtps }}<small> Orang</small></h4>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-danger">warning</i> <a href="#pablo">Get More info...</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-9 col-md-offset-3">
		<div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Data Kecamtan </h4>
                
            </div>
            <table class="table table-responsive">
                <thead >
                    <tr>
                        <th style="font-weight: bold;">No</th>
                        <th style="font-weight: bold;">Nama kecamatan </th>
                        <th style="font-weight: bold;">kode kecamatan</th>
                      
                    </tr>
                </thead>
                <tbody>
                @foreach ($kecamatan as $no=> $data)
                    {{-- expr --}}
                    <tr>
                        <td colspan="" rowspan="" headers="">{{ ++ $no }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->kecamatan }}</td>
                        <td colspan="" rowspan="" headers="">{{ $data->kode_kecamatan }}</td>
                     
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
           
        </div>
	</div>
	
</div>
<div class="row">
	<div class="col-md-9 col-md-offset-3">
	{{-- {{ Auth::user()->alamat->kecamatan_id }} --}}
		<div class="card">
			<div class="card-header" data-background-color="purple">
				<h4 class="title">Data All </h4>
			</div>
		
		<table class="table table-responsive">
			
			<thead>
				<tr>
					<th>NO</th>
					<th colspan="" rowspan="" headers="" scope="">Desa</th>
					<th colspan="" rowspan="" headers="" scope="">Kecamtan</th>
					<th colspan="" rowspan="" headers="" scope="">KOde POs</th>
					<th colspan="" rowspan="" headers="" scope="">KOde Kecamtan</th>
				</tr>
			</thead>
			<tbody>
			
				@foreach ($desa as $no=> $element)
				<tr>
				<td colspan="" rowspan="" headers="">{{ ++ $no }}</td>
				<td>{{ $element->desa }}</td>
				<td>{{ $element->kecamatan }}</td>
				<td>{{ $element->kode_pos }}</td>
				<td colspan="" rowspan="" headers="">{{ $element->kode_kecamatan }}</td>
				</tr>
			@endforeach

			</tbody>
		</table>
			
		</div>
	</div>
</div>

@endsection()