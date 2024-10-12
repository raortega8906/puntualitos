<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Puntualitos</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/images/logo_bg_removed.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/images/logo_bg_removed.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --color-blue-light: #B3E5FC;
            --color-blue-dark: #1565C0;
            --color-white: #FFFFFF;
            --color-gray-soft: #F5F5F5;
        }

        body {
            background-color: var(--color-gray-soft);
            color: var(--color-blue-dark);
        }

        .btn-primary {
            background-color: var(--color-blue-dark);
            color: var(--color-white);
        }

        .btn-primary:hover {
            background-color: var(--color-blue-light);
            color: var(--color-blue-dark);
        }

        .card {
            background-color: var(--color-white);
        }

        .gradient-text {
            background: linear-gradient(45deg, var(--color-blue-dark), var(--color-blue-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="font-sans">
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="flex lg:justify-center lg:col-start-2 items-center">
            <a href="{{ route('welcome') }}"> <img class="logo w-20 h-20" src="{{ asset('images/logo_bg_removed.png') }}"
                              alt="Puntualito Logo"></a>
        </div>

        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary px-4 py-2 rounded-md mr-2">{{ __('Dashboard') }}</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-blue-900 hover:text-blue-700">{{ __('Cerrar sesión') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-900 hover:text-blue-700 mr-4">{{ __('Iniciar sesión') }}</a>
                <a href="{{ route('register') }}" class="btn-primary px-4 py-2 rounded-md">{{ __('Registrarse') }}</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container mx-auto mt-10 px-6">
    <div class="text-center">
        <h1 class="text-6xl font-bold mb-8 gradient-text">{{ __('Bienvenido a Puntualitos') }}</h1>
        <p class="text-xl mb-12">{{ __('La forma más sencilla de gestionar entradas y salidas en tu empresa') }}</p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 mt-20">
        <div class="card rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-4">{{ __('Registro Fácil') }}</h2>
            <p class="mb-4">{{ __('Registra entradas y salidas con solo un clic. Nuestra interfaz intuitiva hace que el proceso
                sea rápido y sin complicaciones.') }}</p>
            <a href="#" class="btn-primary px-6 py-2 rounded-md inline-block">{{ __('Aprende más') }}</a>
        </div>
        <div class="card rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-4">{{ __('Reportes Detallados') }}</h2>
            <p class="mb-4">{{ __('Obtén informes completos sobre la asistencia y los horarios de tu equipo. Toma decisiones
                informadas con datos precisos.') }}</p>
            <a href="#" class="btn-primary px-6 py-2 rounded-md inline-block">{{ __('Ver demo') }}</a>
        </div>
    </div>

    <div class="mt-20">
        <h2 class="text-3xl font-bold mb-8 text-center">{{ __('Características principales') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Registro en tiempo real') }}</h3>
                <p>{{ __('Registra entradas y salidas al instante, manteniendo tus registros siempre actualizados.') }}</p>
            </div>
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Informes personalizados') }}</h3>
                <p>{{ __('Genera informes detallados adaptados a las necesidades específicas de tu empresa.') }}</p>
            </div>
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Seguridad avanzada') }}</h3>
                <p>{{ __('Protege los datos de tu empresa con nuestro sistema de seguridad de última generación.') }}</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-20">
        <h2 class="text-4xl font-bold mb-8">{{ __('¿Listo para empezar?') }}</h2>
        <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-md text-lg">{{ __('Crear cuenta gratis') }}</a>
    </div>
</main>

<footer class="mt-20 py-6 text-center text-sm text-blue-900">
    <p>&copy; {{ date('Y') }} {{ __('Desarrollado por') }}<a class="hover:underline" href="https://rafaelortegaweb.wpcache.es">{{ __('Rafael A. Ortega') }}</a>.</p>
</footer>
</body>
</html>


