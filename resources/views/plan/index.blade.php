@extends('layout')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/stylesPlan/planStyle.css') }}">
    
    <title>coockIt</title>
</head>

<body>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <h1 style="text-align: center; color: #4b4b4b; text-shadow: 2px 2px 5px #464d35;">DESAYUNO</h1>
        </div>
        <div class="col-md-3">
            <h1 style="text-align: center; color: #4b4b4b; text-shadow: 2px 2px 5px #464d35;">COMIDA</h1>
        </div>
        <div class="col-md-3">
            <h1 style="text-align: center; color: #4b4b4b; text-shadow: 2px 2px 5px #464d35;">CENA</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">LUNES {{$caloriesArray[1]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[1]) && isset($planArray[1][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[1][1]->id]) }}">
                        {{$planArray[1][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[1][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[1]) && isset($planArray[1][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[1][2]->id]) }}">
                        {{$planArray[1][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[1][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[1]) && isset($planArray[1][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[1][3]->id]) }}">
                        {{$planArray[1][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[1][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">MARTES {{$caloriesArray[2]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[2]) && isset($planArray[2][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[2][1]->id]) }}">
                        {{$planArray[2][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[2][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[2]) && isset($planArray[2][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[2][2]->id]) }}">
                        {{$planArray[2][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[2][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[2]) && isset($planArray[2][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[2][3]->id]) }}">
                        {{$planArray[2][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[2][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">MIERCOLES {{$caloriesArray[3]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[3]) && isset($planArray[3][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[3][1]->id]) }}">
                        {{$planArray[3][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[3][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[3]) && isset($planArray[3][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[3][2]->id]) }}">
                        {{$planArray[3][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[3][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[3]) && isset($planArray[3][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[3][3]->id]) }}">
                        {{$planArray[3][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[3][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">JUEVES {{$caloriesArray[4]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[4]) && isset($planArray[4][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[4][1]->id]) }}">
                        {{$planArray[4][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[4][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[4]) && isset($planArray[4][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[4][2]->id]) }}">
                        {{$planArray[4][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[4][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[4]) && isset($planArray[4][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[4][3]->id]) }}">
                        {{$planArray[4][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[4][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">VIERNES {{$caloriesArray[5]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[5]) && isset($planArray[5][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[5][1]->id]) }}">
                        {{$planArray[5][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[5][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[5]) && isset($planArray[5][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[5][2]->id]) }}">
                        {{$planArray[5][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[5][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[5]) && isset($planArray[5][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[5][3]->id]) }}">
                        {{$planArray[5][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[5][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">SABADO {{$caloriesArray[6]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[6]) && isset($planArray[6][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[6][1]->id]) }}">
                        {{$planArray[6][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[6][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[6]) && isset($planArray[6][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[6][2]->id]) }}">
                        {{$planArray[6][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[6][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[6]) && isset($planArray[6][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[6][3]->id]) }}">
                        {{$planArray[6][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[6][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2 style="color: #4b4b4b; text-shadow: 2px 1px 10px #464d35;">DOMINGO {{$caloriesArray[7]}} calorias</h2>
        </div>
        <div class="col-md-3">
            @if (isset($planArray[7]) && isset($planArray[7][1]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[7][1]->id]) }}">
                        {{$planArray[7][1]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[7][1]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[7]) && isset($planArray[7][2]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[7][2]->id]) }}">
                        {{$planArray[7][2]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[7][2]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[7]) && isset($planArray[7][3]))
                <h2>
                    <a href="{{ route('recetas_detail', ['id' => $planArray[7][3]->id]) }}">
                        {{$planArray[7][3]->title}}
                    </a>
                </h2>
                <p>
                    {{$planArray[7][3]->user->name}}
                </p>
            @else
                <h4>Sin registro...</h4>
            @endif
        </div>
    </div>
</body>
@endsection