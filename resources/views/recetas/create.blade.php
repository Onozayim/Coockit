@extends('layout')
@section('content')

<h1>CREA UNA RECETA</h1>
<form id="createForm">
    <p>TITULO</p>
    <input type="text" name="title" id="title">

    <p>CALORIAS</p>
    <input type="number" name="calories" id="calories">

    <p>RECETA</p>
    <textarea name="body" cols="30" rows="10" id="body"></textarea>

    <input type="file" name="images[]" id="images" multiple>

    <h1>INGREDIENTES</h1>
    <p>Ingrediente | Piezas | Medida</p>
    <div id="ingredientsContainer">
    </div>
    
    <button type="button" id="addIngredient">Agregar</button>
    <br>
    <br>
    <button type="submit" id="saveReceta">GUARDAR</button>
</form>

@push('js')
    <script src="{{asset('js/createRecetas.js')}}"></script>
@endpush
@endsection