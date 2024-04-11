@extends('layout')
@section('content')
    @foreach ($data->plan as $item)
       <h2>{{$item->title}}</h2> 
       <ul>
        @foreach ($item->ingredientes as $ingredient)
            <li>{{$ingredient->ingredient}} - {{$ingredient->quantity}} {{$ingredient->measurement}}</li>   
        @endforeach
       </ul>
       
    @endforeach
@endsection