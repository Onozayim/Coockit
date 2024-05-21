@extends('layout')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/indexRecetaStyle.css') }}">
    
    <title>coockIt</title>
</head>

<body>
    <h1 style="text-align:center;">RECETAS</h1>
    @auth
        <form action="">
            <a href="{{ route('recetas_create') }}" class="cta-button">CREAR RECETA</a>
            <a href="{{ route('recetas_search') }}" class="cta-button">BUSCAR RECETA</a>
        </form>
    @endauth
    <div class="recetas-container">
        @foreach ($recetas as $item)
            <div class="receta-item">
                <h2><a href="{{ route('recetas_detail', ['id'=> $item->id]) }}">{{$item->title}}</a></h2>
                <h2>{{$item->user->name}}</h2>
                @if (!$item->user->profile_picture)
                    <img src="{{ asset('/storage/images/default.jpg') }}" alt="" width="50" height="50">
                @else
                    <img src="{{ asset($item->user->profile_picture->path) }}" alt="" width="50" height="50">
                @endif
                <p>calificación: {{$item->rating->rate ?? 0}}</p>
                <p>{{$item->status}}</p>
            </div>
        @endforeach
    </div>
</body>

{{$recetas->links()}}
@endsection
