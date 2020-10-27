<!-- Navigation -->
<div id="app">
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      {{-- <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a> --}}
      <img src="/img/logoesti.png" alt="..." class="img-thumbnail" width="200" height="200" style="border-style: none; background:transparent">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Inicio</a>
          </li>
      @auth
          {{-- <li class="nav-item">
            <a class="nav-link" href="/solicitudesRegistro">Registro Traductores</a>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link" href="/traductores">Traductores</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="/solicitudes">Solicitudes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/reclamaciones">Reclamaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/solicitudesSuspensas">Solicitudes Desaprobadas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/reporteTrad">Reporte Traductores</a>
          </li>
      @endauth
          <!-- Authentication Links -->
          @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                  <a class="dropdown-item" href="/admin"> Administración</a> 
                                  
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
        </ul>
      </div>
    </div>
  </nav>
</div>