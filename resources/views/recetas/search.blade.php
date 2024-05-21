@extends('layout')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/stylesReceta/searchRecetaStyle.css') }}">
    
    <title>coockIt</title>
</head>

<body>
    <h1>Buscar Receta</h1>

    <form action="{{ route('recetas_search') }}" method="get">
        <input type="text" name="search" placeholder="Titulo de receta">
        <button type="submit" class="botonBuscar">Buscar</button>
    </form>

    @if($recetas->isEmpty())
        <p>No se encontraron recetas.</p>
    @else
        <ul class="recetas-container">
            @foreach($recetas as $receta)
                <div class="receta-item">
                    <h2><a href="{{ route('recetas_detail', ['id' => $receta->id]) }}">{{ $receta->title }}</a></h2>
                    @if (!$receta->user->profile_picture)
                        <img src="{{ asset('/storage/images/default.jpg') }}" alt="" width="50" height="50">
                    @else
                        <img src="{{ asset($receta->user->profile_picture->path) }}" alt="" width="50" height="50">
                    @endif
                    <p>calificación: {{$receta->rating->rate ?? 0}}</p>
                    <p>{{$receta->status}}</p>
                </div>
            @endforeach
        </ul>

        {{ $recetas->links() }}
    @endif

</body>

@endsection
