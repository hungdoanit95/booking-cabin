<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ứng dụng đặt lịch học Cabin') }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        html, body{
            height: 100vh;
            width: 100%;
        }
        #app{
            position: relative;
            width: 100%;
            display: flex;
            height: 100%;
        }
        main{
            width: 100%;
        }
        .btn-item{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .btn-item button{    
            margin-bottom: 10px;
            width: calc(20% - 7.5px);
            padding: 8px 5px;
        }
        .form-group{
            position: relative;
        }
        .form-group #alert-name{
            text-align: right;
            position: absolute;
            top: 0;
            right: 0;
        }
        .container{
            display: flex;
            width: 100%;
            height: 100vh;
            justify-content: center;
        }
        .container > .row{
            display: flex;
            width: 100%;
            align-items: center;
        }
        .form-group label{
            text-transform: none;
        }
        .list-cabin{
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        @media (max-width: 768px){
            .btn-item button{
                margin-bottom: 10px;
                width: calc(50% - 6px);
            }
            .list-cabin li{
                width: calc(50% - 10px);
                margin-bottom: 10px;
            }
            .list-cabin li a{
                width: 100%
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
