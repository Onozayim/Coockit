<style>
    .profile-pic{
        display: inline-block;
        vertical-align: middle;
        width: 50px;
        height: 50px;
        overflow: hidden;
        border-radius: 50%;
    }

    .profile-pic img{
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .profile-menu .dropdown-menu {
        right: 0;
        left: unset;
    }
    .profile-menu .fa-fw {
        margin-right: 10px;
    }

    .toggle-change::after {
        border-top: 0;
        border-bottom: 0.3em solid;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">CoockIt</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            RECETAS
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('recetas_index') }}">INICIO</a></li>
            <li><a class="dropdown-item" href="{{ route('recetas_search') }}">BUSCAR</a></li>
            @auth
                <li><a class="dropdown-item" href="{{ route('recetas_create') }}">CREAR</a></li>
            @endauth
          </ul>
        </li>
        @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getPlan') }}">PLAN</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('getIngredientes') }}">INGREDIENTES</a>
            </li>
        @endauth
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">IINICIAR SESIÓN</a>
            </li>
        @endguest
      </ul>
      @auth
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu"> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-pic">
                        @if (!Session::has('profile_picture') || !Session::get('profile_picture'))
                            <img src="{{ asset('/storage/images/default.jpg') }}" alt="Profile Picture">
                        @else
                            <img src="{{ Session::get('profile_picture') }}" alt="Profile Picture">
                        @endif
                        {{-- <img src="https://source.unsplash.com/250x250?girl" alt="Profile Picture"> --}}
                    </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('user') }}"><i class="fas fa-sliders-h fa-fw"></i>{{Auth::user()->name}}</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt fa-fw"></i>CERRAR SESION</a></li>
                </ul>
            </li>
            </ul>
      @endauth
    </div>
  </div>
</nav>