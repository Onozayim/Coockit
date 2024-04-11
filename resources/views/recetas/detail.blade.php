@extends('layout')
@section('content')
<input type="hidden" id="receta_id" value="{{$receta->id}}">

<div>
    @auth
    @if (!$isFavorite)
    <button id="saveOnFavorites">GUARDAR A FAVORITOS</button>
    @endif

    @if (Auth::user()->rol == 'administrador' && $receta->status == 'Pendiente')
    <button id="verifyReceta">Aprobar Receta</button>
    <button id="dennyReceta">Rechazar Receta</button>
    @endif
    @endauth
</div>

<h1>{{$receta->title}}</h1>

<p>{{$receta->status}}</p>

<p>Creador: {{$receta->user->name}}</p>
<p>Calorias: {{$receta->calories}}</p>

<h2>RECETA:</h2>

{!! $receta->body !!}

<h2>INGREDIENTES</h2>

<table>
    <thead>
        <tr>
            <th>INGREDIENTE</th>
            <th>CANTIDAD</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receta->ingredientes as $ingredient)
        <tr>
            <td>{{$ingredient->ingredient}}</td>
            <td>{{$ingredient->quantity}}</td>
            <td>{{$ingredient->measurement}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@auth
@if (!$hasComment)
<button type="button" data-bs-toggle="modal" id="openComentarioModal" data-bs-target="#comentarioModal">
    Crear Comentario
</button>
@endif
<button type="button" data-bs-toggle="modal" id="openGuardarModal" data-bs-target="#guardarModal">
    Guardar Receta
</button>
@endauth

<br>
<br>
@foreach ($receta->images as $image)
    <img src="{{ asset($image->path) }}" width="200" height="200" alt="">
    <br>
@endforeach
<br>

<h2>COMENTARIOS: </h2>

<div id="comentariosContainer">

</div>

@include('loadingIcon')

<div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="comentarioModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="saveComentario">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="comentarioModalLabel">Crear comentario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="comment" name="comment" placeholder="comentario"> <br>
                    <input type="number" value="1" min="1" max="5" id="grade" id="grade" placeholder="calificacion">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="saveComentarioBtn" class="btn btn-primary">Guardar comentario</button>
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
                        <option value="2">Comida</option>
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