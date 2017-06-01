<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <title>@yield('title')</title>
    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    Bootstrap core CSS     -->
   
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!--  Material Dashboard CSS    -->
    <link href="{{ url('css/material-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ url('css/demo.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
     <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
     
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link href="{{ asset('js/jquery.js') }}">
    <style>
        .hide{
            display: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="{{ url('img/sidebar-1.jpg') }} ">
        
            @if (Auth::guard('admin'))
               <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    {{ Auth::guard('admin')->user()->nama }}

                </a>
            </div>
            @elseif(Auth::guard('user'))
                <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    {{ Auth::guard('admin')->user()->nama }}
                </a>
            </div>
            @else{
                 <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    {{ Auth::guard('admin')->user()->nama }}
                </a>
            </div>
            }
            @endif
           
            
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="{{ url('/home') }}">
                            <i class="material-icons"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ url('/e-ktp') }}" title="Page e-ktp">
                            <i class="material-icons"></i>
                            <p>e-Ktp</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/e-kk') }}" title="Page E-kartukeluarga">
                            <i class="material-icons"></i>
                            <p>e-Kartu Keluarga</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/e-aktalahir') }}" title="Page e-Aktalahir">
                            <i class="material-icons"></i>
                            <p>e-Akta kelahiran</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/e-aktanikah') }}" title="Page e-aktanikah">
                          <i class="material-icons"></i>
                          <p>e-Akta Nikah</p>
                        </a>
                    </li>
                    
                   
                </ul>
                <ul class="nav">
                    <li>                        
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="material-icons text-gray"></i>
                            logout         
                            
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            @yield('content')
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/material.min.js') }}" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="{{ url('js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('js/bootstrap-notify.js') }}"></script>

    <!--  Google Maps Plugin    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    Material Dashboard javascript methods -->
    <script src="{{ url('js/material-dashboard.js') }}"></script>

   
</body>
</html>
