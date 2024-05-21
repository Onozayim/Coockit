<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/stylesReceta/detalleRecetaStyle.css') }}">
    <title>Detalle de receta</title>
</head>
<body>
    @extends('layout')
    @section('content')
    <input type="hidden" id="receta_id" value="{{$receta->id}}">

    <div>
        @auth
        @if (!$isFavorite && Auth::user()->id != $receta->user->id)
        <button id="saveOnFavorites">GUARDAR A FAVORITOS</button>
        @endif

        @if (Auth::user()->rol == 'administrador' && $receta->status == 'Pendiente')
        <button id="verifyReceta">Aprobar Receta</button>
        <button id="dennyReceta">Rechazar Receta</button>
        @endif
        @endauth
    </div>

    <h1>{{$receta->title}}</h1>
    <p>Creado por: {{$receta->user->name}}</p>
    <p>Estado de la receta: {{$receta->status}}</p>

    <div class="container">
        <div class="ingredients">
            <h2>Ingredientes</h2>
            <p>Calorias: {{$receta->calories}}</p>
            <ul>
                @foreach ($receta->ingredientes as $ingredient)
                <li>{{$ingredient->ingredient}} - {{$ingredient->quantity}} {{$ingredient->measurement}}</li>
                @endforeach
            </ul>
            <div class="ingredient-photo">
            @foreach ($receta->images as $image)
                <img src="{{ asset($image->path) }}" width="200" height="200" alt="">
                <br>
                @endforeach
            </div>
        </div>

        <div class="instructions">
            <h2>Instrucciones</h2>
            <p>{!! $receta->body !!}</p>
        </div>
    </div>

    @auth
    @if (!$hasComment)
    <button type="button" data-bs-toggle="modal" id="openComentarioModal" data-bs-target="#comentarioModal">
        Comentar y Valorar
    </button>
    @endif
    <button type="button" data-bs-toggle="modal" id="openGuardarModal" data-bs-target="#guardarModal">
        Guardar a Plan Semanal
    </button>
    @endauth

    <h2>Comentarios:</h2>
    <div id="comentariosContainer">
    </div>

    <div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="comentarioModal" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" id="saveComentario">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="comentarioModalLabel">Write a Comment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="comment" name="comment" placeholder="Comment"> 
                        <input type="number" value="1" min="1" max="5" id="grade" id="grade" placeholder="Rating">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerra</button>
                        <button type="submit" id="saveComentarioBtn" class="btn btn-primary">Guardar Comentario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="guardarModal" tabindex="-1" aria-labelledby="guardarModal" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" id="saveReceta">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="guardarModalLabel">Guardar Receta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select name="day" id="day">
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miercoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sabado</option>
                            <option value="7">Domingo</option>
                        </select>

                        <select name="meal" id="meal">
                            <option value="1">Desayuno</option>
                            <option value="2">Almuerzo</option>
                            <option value="3">Cena</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="saveRecetaBtn" class="btn btn-primary">Guardar Receta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('js')
    <script src="{{asset("js/recetaDetail.js")}}"></script>
    @endpush
    @endsection
</body>
</html>
