<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/stylesReceta/createRecetaStyle.css') }}">
    <title>Create Recipe</title>
</head>
<body>
    @extends('layout')
    @section('content')

    <h1 style="justify-content: center;">CREATE RECIPE</h1>
        
    <div class="form-container">
        <form id="createForm">
            <p>Titulo</p>
            <input type="text" name="title" id="title">

            <p>Calorias</p>
            <input type="number" name="calories" id="calories">

            <p>Receta</p>
            <textarea name="body" cols="30" rows="10" id="body"></textarea>

            <input type="file" name="images[]" id="images" multiple>

            <h1>Ingredientes</h1>
            <p>Ingrediente | Pieza | Medida</p>
            <div id="ingredientsContainer">
            </div>
                
            <button type="button" id="addIngredient">Añadir</button>
            <br>
            <br>
            <button type="submit" id="saveReceta">CREAR RECETA</button>
        </form>
    </div>

    @push('js')
        <script src="{{asset('js/createRecetas.js')}}"></script>
    @endpush
    @endsection
</body>
</html>
