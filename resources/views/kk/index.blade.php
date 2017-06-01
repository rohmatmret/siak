@extends('layouts.theme')
@section('title','kartu keluarga')
@section('content')
<div class="row" style="margin-top: 60px">
	<div class="col-md-10 col-md-offset-2">
	  <a href="{{ url('e-kk/new') }}" class="btn btn-success">Buat baru</a>    
    <a href="{{ url('e-kk/update') }}" class="btn btn-success">Update</a>
    <a href="{{ url('/') }}" title="mutasi Anggota" class="btn btn-md btn-warning">Mutasi Anggota</a>
    <a href="{{ url('e-kk/mutasi/alamat') }}" class="btn btn-md btn-warning">Mutasi Alamat</a>
        <div class="card">
            <div style="position: absolute; top: 130px; width: 90%; left: auto;right: auto;" >
              @include('flash::message')
            </div>
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Data Kartu keluarga</h4>
                <p class="category"> Jumlah data : {{ $row }} </p>
            </div>
            
            <div class="card-content table-responsive">
               <table class="table table-responsive">                   
                   <thead>
                       <tr>
                           <th>NO</th>
                           <th colspan="" rowspan="" headers="" scope="">Nama</th>
                            <th colspan="" rowspan="" headers="" scope="">No Kartu keluarga</th>  
                           <th colspan="" rowspan="" headers="" scope="">Alamat</th>                           
                           <th colspan="" rowspan="" headers="" scope="">Dimohon</th>
                                                  
                           <th colspan="" rowspan="" headers="" scope="">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   @php            
                    $begin = memory_get_usage();
                    @endphp
                   @foreach ($kk as $no=>$element)
                       <tr>
                           <td>{{ ++$no }}</td>
                           <td colspan="" rowspan="" headers="">{{ $element->aktalahir->nama }}</td> 
                           <td colspan="" rowspan="" headers="">{{ $element->no_kk }}</td>                         
                           <td colspan="" rowspan="" headers="">{{ $element->alamat }} rt {{ $element->rt }} rw {{ $element->rw }}</td>                        
                          <td colspan="" rowspan="" headers="">{{ $element->created }}</td>
                          <td colspan="" rowspan="" headers=""><a href="{{ url('/e-kk/'.$element->id.'/detail') }}" title="" class="btn btn-sm btn-primary">view</a></td>

                       </tr>
                   @endforeach                       
                   </tbody>
                  
                    <p>Total memori : {{ memory_get_usage()- $begin }}</p>
               </table>


            </div>
            {{ $kk->render() }}
        </div>
    </div>
    <script>
       $('div.alert').fadeOut(9000);
    </script>

    
</div>	
@stop