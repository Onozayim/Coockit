<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/registerstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>coockIt</title>
</head>
<body>
    <div class="parent">
        <div class="div1"> 
            <div class="full_div">
                <h1>REGISTER</h1>
            </div>
        </div>

        <div class="div2"> 
            <form action="{{route('store')}}" method="post">
                @csrf
                <input required name="username" type="text" placeholder="Ingrese su nombre de usuario">
                <input required name="email" type="text" placeholder="Ingrese su correo">
                <input required name="password" type="password" placeholder="Ingrese su contraseña">
                <input required name="password_confirmation" type="password" placeholder="Confirme su contraseña">

                <button type="submit">Enviar</button>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>
        <div class="div3"> 
            <a href="{{ route('login') }}">Ya tienes cuenta? Inicia sesión</a>
            <br>
            {{-- <a href="{{ route(' ') }}">Menú</a> --}}
        </div>
    </div>
</body>
</html>