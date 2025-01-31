<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Puntualitos') }}</title>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/images/logo_bg_removed.webp') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/images/logo_bg_removed.webp') }}" type="image/x-icon">
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
            <a href="{{ route('welcome') }}"> <img class="logo w-20 h-20"
                                                   src="{{ asset('images/logo_bg_removed.webp') }}"
                                                   alt="Puntualito Logo" width="100%"></a>
        </div>

        <div>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="btn-primary px-4 py-2 rounded-md mr-2">{{ __('Dashboard') }}</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-blue-900 hover:text-blue-700">{{ __('Cerrar sesión') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="text-blue-900 hover:text-blue-700 mr-4">{{ __('Iniciar sesión') }}</a>
                <a href="{{ route('register') }}" class="btn-primary px-4 py-2 rounded-md">{{ __('Registrarse') }}</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container mx-auto mt-10 px-6">
    <div class="text-center">
        <h1 class="text-5xl sm:text-6xl font-bold mb-8 gradient-text">{{ __('Bienvenido a Puntualitos') }}</h1>
        <p class="text-xl mb-8">{{ __('La forma más sencilla de gestionar entradas y salidas en tu empresa') }}</p>
    </div>

    <div class="flex items-center mt-10">
        <div class="rounded-lg p-6">
            <img class="rounded rounded-[10px]" src="{{ asset('images/register.webp') }}" alt="Register" width="100%">
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-12 mt-20">
        <div class="card rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-4">{{ __('Registro Fácil') }}</h2>
            <p class="mb-4">{{ __('Registra entradas y salidas con solo un clic. Nuestra interfaz intuitiva hace que el proceso
                sea rápido y sin complicaciones.') }}</p>
            <a href="{{ asset('videos/demo.webm') }}" target="_blank" class="btn-primary px-6 py-2 rounded-md inline-block">{{ __('Ver demo') }}</a>
        </div>
        <div class="card rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-4">{{ __('Reportes Detallados') }}</h2>
            <p class="mb-4">{{ __('Obtén informes completos sobre la asistencia y los horarios de tu equipo. Toma decisiones
                informadas con datos precisos.') }}</p>
            <a href="https://github.com/raortega8906/puntualitos/blob/main/README.md" target="_blank" class="btn-primary px-6 py-2 rounded-md inline-block">{{ __('Revisa nuestra documentación') }}</a>
        </div>
    </div>

    <div class="mt-20">
        <h2 class="text-3xl font-bold mb-8 text-center">{{ __('Características principales') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Registro en tiempo real') }}</h3>
                <p>{{ __('Registra entradas y salidas al instante. Solicita y actualiza tus vacaciones.') }}</p>
            </div>
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Informes personalizados') }}</h3>
                <p>{{ __('Genera informes detallados de tu historial de registros.') }}</p>
            </div>
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Seguridad avanzada') }}</h3>
                <p>{{ __('Protege tu información personal y registros con nuestro sistema.') }}</p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 items-center mt-20">
        <div class="rounded-lg p-8 w-full">
            <img class="rounded-[10px] w-full" src="{{ asset('images/dashboard.webp') }}" alt="Dashboard" width="100%">
        </div>
        <div class="rounded-lg p-8 w-full">
            <img class="rounded-[10px] w-full" src="{{ asset('images/calendar.webp') }}" alt="Calendar" width="100%">
        </div>
    </div>

    <div class="mt-20">
        <h2 class="text-3xl font-bold mb-8 text-center">{{ __('Información Adicional') }}</h2>

        <div class="grid md:grid-cols-3 gap-8 mt-8">
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Horario de Soporte') }}</h3>
                <p>Lunes a Viernes: 09:00 - 18:00</p>
                <p>Sábados, Domingos y Festivos: No operativo</p>
            </div>
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Contacto') }}</h3>
                <p>Para problemas técnicos o consultas, utiliza el formulario de reporte de incidencias en el
                    dashboard.</p>
            </div>
            <div class="card rounded-lg shadow-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">{{ __('Datos') }}</h3>
                <p>Consulta nuestra documentación y guías de usuario obtener más información.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-20">
        <h2 class="text-3xl sm:text-4xl font-bold mb-8">{{ __('¿Listo para empezar?') }}</h2>
        <a href="{{ route('register') }}"
           class="btn-primary px-8 py-3 rounded-md text-lg">{{ __('Crear cuenta gratis') }}</a>
    </div>
</main>

<footer class="mt-20 py-6 bg-white shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <p class="text-sm text-blue-900">&copy; {{ date('Y') }} {{ __('Desarrollado por') }}
            <a class="hover:underline" href="https://rafaelortegaweb.wpcache.es">{{ __('Rafael A. Ortega') }}</a>.
        </p>
        <a href="https://github.com/raortega8906/puntualitos" target="_blank" rel="noopener noreferrer"
           class="text-blue-900 hover:text-blue-700">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
            </svg>
        </a>
    </div>
</footer>
</body>
</html>
