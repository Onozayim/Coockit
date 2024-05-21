@extends('layout')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/usuarioStyle.css') }}">
    
    <title>coockIt</title>
</head>

<body>
    

    @if (Auth::user()->rol == 'administrador')
        <a href="{{ route('register_admin') }}" class="cta-button">CREAR ADMINISTRADOR</a>       
    @endif

    <div class="row">
        <div class="col-md-3">
            @if (!$user->profile_picture)
            <img src="{{ asset('/storage/images/default.jpg') }}" alt="" width="300" height="300">
            @else
            <img src="{{ asset($user->profile_picture->path) }}" alt="" width="300" height="300">
            @endif
            <h3>Nombre: {{$user->name}}</h3>
            <h3>Correo: {{$user->email}}</h3>
            <h3>Rol de la cuenta: {{$user->rol}}</h3>
            <form method="POST" action="{{ route('save_profile_picture') }}" enctype="multipart/form-data">
                @csrf
                <label for="image">Cambia tu foto de perfil</label>
                <input type="file" name="image" accept="image/*">
                <button type="submit" id="saveImage">Guardar imagen</button>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ \Session::get('success') }}</li>
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-8" style="overflow-y: scroll">
            <h2 style="color: #4b4b4b; text-shadow: 2px 2px 5px #464d35;">FAVORITOS</h2>
            <div class="row2">
                @foreach ($favoritos as $item)
                    <h3><a href="{{ route('recetas_detail', ['id'=> $item->receta->id]) }}">{{$item->receta->title}}</a></h3>
                    <p>{{$item->receta->user->name}}</p>                   
                @endforeach
            </div>
        </div>
    </div>
</body>
@endsection