<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Reposa+') - Tu descanso, nuestra prioridad</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-moon-stars-fill me-2"></i>Reposa+
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/catalog">Catálogo</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-secondary text-white ms-lg-2 px-4" href="/register">Registrarse</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile">Mi Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link position-relative ms-lg-3" href="/cart">
                            <i class="bi bi-cart3 fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-primary text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Reposa+</h5>
                    <p class="text-light opacity-75">No vendemos almohadas, vendemos noches de sueño profundo y reparador. Tu salud cervical es nuestra prioridad.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Tienda</h6>
                    <ul class="list-unstyled">
                        <li><a href="/catalog" class="text-white text-decoration-none opacity-75">Catálogo</a></li>
                        <li><a href="#" class="text-white text-decoration-none opacity-75">Ofertas</a></li>
                        <li><a href="#" class="text-white text-decoration-none opacity-75">Favoritos</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3">Soporte</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none opacity-75">Contacto</a></li>
                        <li><a href="#" class="text-white text-decoration-none opacity-75">Envíos y Devoluciones</a></li>
                        <li><a href="#" class="text-white text-decoration-none opacity-75">Preguntas Frecuentes</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Suscríbete</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email">
                        <button class="btn btn-secondary" type="button">OK</button>
                    </div>
                </div>
            </div>
            <hr class="my-4 opacity-25">
            <div class="text-center opacity-75">
                <small>&copy; 2026 Reposa+. Todos los derechos reservados.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>
</html>
