@extends('layout')
@section('content')

    <a href="/plan/ingredientes">INGREDIENTES</a>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p>DESAYUNO</p>
        </div>
        <div class="col-md-3">
            <p>COMIDA</p>
        </div>
        <div class="col-md-3">
            <p>CENA</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            LUNES {{$caloriesArray[1]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[1]) && isset($planArray[1][1]))
                <h2>
                    {{$planArray[1][1]->title}}
                </h2>
                <p>
                    {{$planArray[1][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[1]) && isset($planArray[1][2]))
                <h2>
                    {{$planArray[1][2]->title}}
                </h2>
                <p>
                    {{$planArray[1][2]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[1]) && isset($planArray[1][3]))
                <h2>
                    {{$planArray[1][3]->title}}
                </h2>
                <p>
                    {{$planArray[1][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            MARTES {{$caloriesArray[2]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[2]) && isset($planArray[2][1]))
                <h2>
                    {{$planArray[2][1]->title}}
                </h2>
                <p>
                    {{$planArray[2][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[2]) && isset($planArray[2][2]))
                <h2>
                    {{$planArray[2][2]->title}}
                </h2>
                <p>
                    {{$planArray[2][2]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[2]) && isset($planArray[2][3]))
                <h2>
                    {{$planArray[2][3]->title}}
                </h2>
                <p>
                    {{$planArray[2][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            MIERCOLES {{$caloriesArray[3]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[3]) && isset($planArray[3][1]))
                <h2>
                    {{$planArray[3][1]->title}}
                </h2>
                <p>
                    {{$planArray[3][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[3]) && isset($planArray[3][2]))
                <h2>
                    {{$planArray[3][2]->title}}
                </h2>
                <p>
                    {{$planArray[3][2]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[3]) && isset($planArray[3][3]))
                <h2>
                    {{$planArray[3][3]->title}}
                </h2>
                <p>
                    {{$planArray[3][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            JUEVES {{$caloriesArray[4]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[4]) && isset($planArray[4][1]))
                <h2>
                    {{$planArray[4][1]->title}}
                </h2>
                <p>
                    {{$planArray[4][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[4]) && isset($planArray[4][2]))
                <h2>
                    {{$planArray[4][2]->title}}
                </h2>
                <p>
                    {{$planArray[4][4]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[4]) && isset($planArray[4][3]))
                <h2>
                    {{$planArray[4][3]->title}}
                </h2>
                <p>
                    {{$planArray[4][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            VIERNES {{$caloriesArray[5]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[5]) && isset($planArray[5][1]))
                <h2>
                    {{$planArray[5][1]->title}}
                </h2>
                <p>
                    {{$planArray[5][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[5]) && isset($planArray[5][2]))
                <h2>
                    {{$planArray[5][2]->title}}
                </h2>
                <p>
                    {{$planArray[5][2]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[5]) && isset($planArray[5][3]))
                <h2>
                    {{$planArray[5][3]->title}}
                </h2>
                <p>
                    {{$planArray[5][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            SABADO {{$caloriesArray[6]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[6]) && isset($planArray[6][1]))
                <h2>
                    {{$planArray[6][1]->title}}
                </h2>
                <p>
                    {{$planArray[6][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[6]) && isset($planArray[6][2]))
                <h2>
                    {{$planArray[6][2]->title}}
                </h2>
                <p>
                    {{$planArray[6][2]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[6]) && isset($planArray[6][3]))
                <h2>
                    {{$planArray[6][3]->title}}
                </h2>
                <p>
                    {{$planArray[6][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            DOMINGO {{$caloriesArray[7]}}
        </div>
        <div class="col-md-3">
            @if (isset($planArray[7]) && isset($planArray[7][1]))
                <h2>
                    {{$planArray[7][1]->title}}
                </h2>
                <p>
                    {{$planArray[7][1]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[7]) && isset($planArray[7][2]))
                <h2>
                    {{$planArray[7][2]->title}}
                </h2>
                <p>
                    {{$planArray[7][2]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
        <div class="col-md-3">
            @if (isset($planArray[7]) && isset($planArray[7][3]))
                <h2>
                    {{$planArray[7][3]->title}}
                </h2>
                <p>
                    {{$planArray[7][3]->user->name}}
                </p>
            @else
                <h4>NO HAY RECETA REGISTRADA</h4>
            @endif
        </div>
    </div>
@endsection