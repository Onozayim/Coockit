@extends('layout')

@section('content')

<h1>Buscar Receta</h1>

<form action="{{ route('recetas_search') }}" method="get">
    <input type="text" name="search">
    <button type="submit">Buscar</button>
</form>

@if($recetas->isEmpty())
    <p>No se encontraron recetas.</p>
@else
    <ul>
        @foreach($recetas as $receta)
            <li>
                <a href="{{ route('recetas_detail', ['id' => $receta->id]) }}">{{ $receta->title }}</a>
            </li>
        @endforeach
    </ul>

    {{ $recetas->links() }}
@endif

@endsection
