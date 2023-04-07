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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        html, body{
            height: 100%;
            width: 100%;
            font-family: 'Roboto';
        }
        #app{
            position: relative;
            background: radial-gradient(circle, #1f365f 300px, #0b1a29);
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
            height: 100%;
            min-height: 100vh;
            justify-content: center;
        }
        .container > .row{
            display: flex;
            width: 100%;
            align-items: center;
        }
        .btn-search{
            border-radius: 10px;
        }
        .card{
            border: 20px solid #1f3c5f;
            margin-top: 50px;
            background: #1f3c5f;
            border-radius: 10px;
        }
        .card .card-header{
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card .card-body{
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background: #fff;
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
        .btn.btn-success.btn-success{
            background: #1ea955;
            text-transform: uppercase;
            font-weight: bold;
            text-shadow: unset;
            font-family: Roboto;
        }
        .btn-default{
            background: #ccc;
            border: #ccc;
            text-decoration: line-through;
            color: #000;
            position: relative;
        }
        #time-register.is-invalid, #cabin-register.is-invalid, .confirm-box.error-alert{
            border-color: #dc3545;
            border-width: 1px;
            border-style: solid;
            padding: 10px calc(1.5em + 0.934rem);
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545'%3E%3Ccircle cx='6' cy='6' r='4.5'/%3E%3Cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3E%3Ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.2335rem) center;
            background-size: calc(0.75em + 0.467rem) calc(0.75em + 0.467rem);
            border-radius: 5px;
        }
        #time-register.is-valid,#cabin-register.is-valid{
            border-style: solid;
            border-width: 1px;
            border-color: #28a745;
            padding: 10px calc(1.5em + 0.934rem);
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.2335rem) center;
            background-size: calc(0.75em + 0.467rem) calc(0.75em + 0.467rem);
            border-radius: 5px;
        }
        #alert-group .text-success{
            text-align: center;
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
