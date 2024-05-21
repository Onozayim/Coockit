@extends('layout')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/stylesPlan/ingredientesStyle.css') }}">
    
    <title>coockIt</title>
</head>

<body>
    @foreach ($data->plan as $item)
       <h2>{{$item->title}}</h2> 
       <ul>
            @foreach ($item->ingredientes as $ingredient)
                <li class="ingre">{{$ingredient->ingredient}} - {{$ingredient->quantity}} {{$ingredient->measurement}}</li>   
            @endforeach
       </ul>
       
    @endforeach
</body>
    
@endsection