@extends('layout')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/welcomestyle.css') }}">
    
    <title>coockIt</title>
</head>

<body>
    <div class="parent">
        <div class="div1"> 

        </div>
        <div class="div2"> 
            <h1 style="text-align:center;">BIENVENIDO</h1>
            <h1 style="text-align:center;">A</h1>
                <img src="{{ asset('/storage/images/CookIt.png') }}" alt="" >
            
            
            @auth
                <h1 style="text-align:center;">{{Auth::user()->name}}</h1>
            @endauth
        </div>
    </div>

    
</body>
    
@endsection