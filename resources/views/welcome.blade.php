@extends('layout')
@section('content')
    <h1>HOLA A TODOS, ESTA ES LA PÁGINA PRINCIPAL QUE ESTA PENDIETE</h1>
    @auth
        <h1>{{Auth::user()->name}}</h1>
    @endauth
@endsection