@extends('layouts.theme')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<h2>{{ Auth::user()->nama }}</h2>
		<h4><label for="">Kecamatan id</label>
		{{ Auth::user()->alamat->kecamatan_id }}</h4>
	</div>
</div>
@endsection()