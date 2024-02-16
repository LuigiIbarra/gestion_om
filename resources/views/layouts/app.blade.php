<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Control de Gestión Oficialía Mayor</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ secure_asset('js/scripts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-documento.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-foliodup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/actualiza-documento.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-persconoc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-cambiapstoads.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-cambiapstoadsdcc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-cambiaotropstoads.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-foliorel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-destconoc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-checkboxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-otronombre.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-puesto.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/captura-adscrip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/mistablas.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{{asset('css/customize-navbar.css')}}}">
    <link rel="stylesheet" type="text/css" href="{{{asset('css/datatables.min.css')}}}">

</head>
<body>
    <div id="app">
        <div>
            <header>
                <img src="{{asset('/images/Banner_SCGOM.png')}}" srcset="{{asset('/images/Banner_SCGOM.png')}}" width="100%" height="170" sizes="(min-width: 1920px)" alt="Ejemplo">
            </header>
        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <br>
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <div class="dropdown">
                            @consultaDocumento
                              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('bootstrap-icons-1.5.0/file-text.svg') }}" width="18" height="18">
                                Documentos
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('documentos/index') }}">
                                    <img src="{{ asset('bootstrap-icons-1.5.0/search.svg') }}" width="18" height="18"> Lista de Documentos
                                    </a>
                                </li>
                              </ul>
                            @endconsultaDocumento
                        </div>
                        <div class="dropdown">
                          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('bootstrap-icons-1.5.0/file-text-fill.svg') }}" width="18" height="18">
                            Catálogos
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @consultaPuesto
                                <li class="dropdown">
                                    <a href="#" class="dropdown-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('bootstrap-icons-1.5.0/person-lines-fill.svg') }}" width="18" height="18"> Puestos <span class="caret"></span></a>
                                    <ul class="dropdown-menu sub-menu">
                                        <li><a class="dropdown-item" href="{{ url('puestos/index') }}">
                                            <img src="{{ asset('bootstrap-icons-1.5.0/person-lines-fill.svg') }}" width="18" height="18"> Lista de Puestos
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('puestos/nuevo') }}">
                                            <img src="{{ asset('bootstrap-icons-1.5.0/person-vcard-fill.svg') }}" width="18" height="18"> Nuevo Puesto
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endconsultaPuesto
                            @consultaAdscripcion
                                <li class="dropdown">
                                    <a href="#" class="dropdown-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('bootstrap-icons-1.5.0/building.svg') }}" width="18" height="18"> Adscripciones <span class="caret"></span></a>
                                    <ul class="dropdown-menu sub-menu">
                                        <li><a class="dropdown-item" href="{{ url('adscripciones/index') }}">
                                            <img src="{{ asset('bootstrap-icons-1.5.0/building.svg') }}" width="18" height="18"> Lista de Adscripciones
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('adscripciones/nueva') }}">
                                            <img src="{{ asset('bootstrap-icons-1.5.0/building-add.svg') }}" width="18" height="18"> Nueva Adscripción
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endconsultaAdscripcion
                            @consultaPersonal
                                <li class="dropdown">
                                    <a href="#" class="dropdown-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('bootstrap-icons-1.5.0/people-fill.svg') }}" width="18" height="18"> Personal <span class="caret"></span></a>
                                    <ul class="dropdown-menu sub-menu">
                                        <li><a class="dropdown-item" href="{{ url('personal/index') }}">
                                            <img src="{{ asset('bootstrap-icons-1.5.0/people-fill.svg') }}" width="18" height="18"> Lista de Personal
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('personal/nuevo') }}">
                                            <img src="{{ asset('bootstrap-icons-1.5.0/person-plus-fill.svg') }}" width="18" height="18"> Nuevo Personal
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endconsultaPersonal
                            {{--
                            @if(auth()->user()->iid_rol==1)
                                <li><a class="dropdown-item" href="{{ url('documentos/completar') }}">
                                    <img src="{{ asset('bootstrap-icons-1.5.0/collection-play.svg') }}" width="18" height="18"> Completar Folios
                                    </a>
                                </li>
                            @endif
                            --}}
                          </ul>
                        </div>
                        <div class="dropdown">
                          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('bootstrap-icons-1.5.0/bar-chart-line-fill.svg') }}" width="18" height="18">
                            Reportes
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ url('reportes/param_estadistico') }}">
                                <img src="{{ asset('bootstrap-icons-1.5.0/graph-up.svg') }}" width="18" height="18"> Estadístico Mensual
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('reportes/param_sireo') }}">
                                <img src="{{ asset('bootstrap-icons-1.5.0/graph-up.svg') }}" width="18" height="18"> Estadístico Mensual SIREO
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('reportes/param_consulta') }}">
                                <img src="{{ asset('bootstrap-icons-1.5.0/graph-up.svg') }}" width="18" height="18"> Estadística por Área y Estatus
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('reportes/param_pendientes') }}">
                                <img src="{{ asset('bootstrap-icons-1.5.0/graph-up.svg') }}" width="18" height="18"> Informe de Asuntos Pendientes
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('reportes/param_exportar') }}">
                                <img src="{{ asset('bootstrap-icons-1.5.0/table.svg') }}" width="18" height="18"> Exportación a Excel
                                </a>
                            </li>
                          </ul>
                        </div>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <br>
        <div class="container col-md-10">
            <div class="container container-fluid h-100">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary-sin text-center">@yield('titulo')</h4>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @yield('panel')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <footer class="footer">
        <img src="{{URL::asset('/images/footer.png')}}"width="900" align="center" style="width: 100%; height: 60px;" />
    </footer>
</body>
</html>
