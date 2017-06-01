<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KABUPATEN BOGOR</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

       Styles -->
       <link href="https://fonts.googleapis.com/css?family=Open+Sans:600i|Slabo+27px" rel="stylesheet">
        <style>
            html, body {
                
               /*  color: #636b6f; */
               background-image: url('img/bg.jpg');
                background-repeat: no-repeat;
                background-size: 100%;
                color: white;
                /* font-family: 'Raleway',sans-serif; */
                font-family: 'Open Sans', sans-serif;
                font-weight: 900;  

                height: 50%;
                width: auto;
                margin: 0;
                
                
            }
            .row{
                background-color: rgba(0, 0, 0, 0.49);
                color: #fff;
                

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;

            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #fff;
                padding: 10px 25px;
                font-size: 15px;
                font-weight: 700;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links >a:hover{
                
                background-color: white;
                color: black;
                padding: 10px 25px;
                font-size: 15px;
                font-weight: 700;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            p{
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>                        
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                   KABUPATEN BOGOR
                </div>
                <p>Sistem Akademik Kependudukan</p>
                <div class="links">
                    <a href=" {{ url('/e-ktp') }}">E-KTP</a>
                    <a href="{{ url('/e-aktalahir') }}">AKTA KELAHIRAN</a>
                    <a href=" {{ url('/e-ktp') }}">Kartu Keluarga</a>
                    <a href="{{ url('/news') }}">News</a>
                </div>
            </div>
        </div>
        </div>
        
    </body>
</html>
