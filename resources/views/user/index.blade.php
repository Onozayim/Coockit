@extends('layout')
@section('content')
    @if (Auth::user()->rol == 'administrador')
        <a href="{{ route('register_admin') }}">CREAR ADMINISTRADOR</a>       
    @endif

    <div class="row">
        <div class="col-md-3">
            @if (!$user->profile_picture)
            <img src="{{ asset('/storage/images/default.jpg') }}" alt="" width="50" height="50">
            @else
            <img src="{{ asset($user->profile_picture->path) }}" alt="" width="50" height="50">
            @endif
            <h3>{{$user->name}}</h3>
            <p>{{$user->email}}</p>
            <p>{{$user->rol}}</p>
            <form method="POST" action="{{ route('save_profile_picture') }}" enctype="multipart/form-data">
                @csrf
                <label for="image">Cambia tu foto de perfil</label>
                <input type="file" name="image" accept="image/*">
                <button type="submit">guardar</button>
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
            <h2>FAVORITOS</h2>
            <div class="row">
                @foreach ($favoritos as $item)
                    <h3><a href="{{ route('recetas_detail', ['id'=> $item->receta->id]) }}">{{$item->receta->title}}</a></h3>
                    <p>{{$item->receta->user->name}}</p>                   
                @endforeach
            </div>
        </div>
    </div>
@endsection