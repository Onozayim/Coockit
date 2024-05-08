@extends('layout')
@section('content')

@auth
    <a href="{{ route('recetas_create') }}">CREAR RECETA</a>
    <a href="{{ route('recetas_search') }}">BUSCAR RECETA</a>
@endauth

<h1>RECETAS</h1>

@foreach ($recetas as $item)
    <h2><a href="{{ route('recetas_detail', ['id'=> $item->id]) }}">{{$item->title}}</a></h2>
    <h2>{{$item->user->name}}</h2>
    @if (!$item->user->profile_picture)
        <img src="{{ asset('/storage/images/default.jpg') }}" alt="" width="50" height="50">
    @else
        <img src="{{ asset($item->user->profile_picture->path) }}" alt="" width="50" height="50">
    @endif
    <p>calificacion: {{$item->rating->rate ?? 0}}</p>
    <p>{{$item->status}}</p>
@endforeach
{{$recetas->links()}}
@endsection