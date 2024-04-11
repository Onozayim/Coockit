<nav>
    <ul>
        <li><a href="{{ route('home') }}">INICIO</a></li>
        <li><a href="{{ route('recetas_index') }}">RECETAS</a></li>
        @auth
            <li><a href="{{ route('logout') }}">CERRAR SESION</a></li>
        @endauth
        @guest
            <li><a href="{{ route('login') }}">INICIAR SESION</a></li>
        @endguest
        @auth
            <li><a href="{{ route('user') }}">{{Auth::user()->name}}</a></li>
            @if (!Auth::user()->with('profile_picture')->first()->profile_picture)
                <img src="{{ asset('/storage/images/default.jpg') }}" alt="" width="50" height="50">
            @else
                <img src="{{ asset(Auth::user()->with('profile_picture')->first()->profile_picture->path) }}" alt="" width="50" height="50">
            @endif
        @endauth
    </ul>
</nav>