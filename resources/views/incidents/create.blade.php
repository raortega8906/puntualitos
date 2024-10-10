<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ config('app.name', 'Puntualitos') }}</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Puntualitos | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
          content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
          content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/images/logo_bg_removed.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/images/logo_bg_removed.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
          integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
          integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
          integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
          integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
          integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
<div class="app-wrapper"> <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                            class="bi bi-list"></i> </a></li>
                <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                <li class="nav-item"><a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i
                            class="bi bi-search"></i> </a></li> <!--end::Navbar Search-->
                <!--begin::Messages Dropdown Menu-->
                <li class="nav-item"><a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                            data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize"
                                                                                             class="bi bi-fullscreen-exit"
                                                                                             style="display: none;"></i>
                    </a></li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                <li class="nav-item dropdown user-menu"><a href="#" class="nav-link dropdown-toggle"
                                                           data-bs-toggle="dropdown"> <img
                            src="../../dist/assets/img/avatar4.png" class="user-image rounded-circle shadow"
                            alt="Avatar Image"> <span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                        <li class="user-header text-bg-primary"><img src="../../dist/assets/img/avatar4.png"
                                                                     class="rounded-circle shadow" alt="Avatar Image">
                            <p>
                                {{ Auth::user()->first_name }}
                                <small>{{ __('Desde ' . Auth::user()->created_at) }}</small>
                            </p>
                        </li> <!--end::User Image--> <!--begin::Menu Body-->

                        <li class="user-footer" style="display: grid; justify-content: space-around;">
                            <a href="{{ route('users.edit', Auth::user()) }}" class="btn btn-default btn-flat">{{ __('Perfil') }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();" class="btn btn-default btn-flat float-end">
                                    {{ __('Salir') }}
                                </a>
                            </form>
                        </li> <!--end::Menu Footer-->
                    </ul>
                </li> <!--end::User Menu Dropdown-->
            </ul> <!--end::End Navbar Links-->
        </div> <!--end::Container-->
    </nav> <!--end::Header--> <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
        <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ route('dashboard')}}" class="brand-link">
                <!--begin::Brand Image--> <img src="../../images/logo_bg_removed.png" alt="Puntualitos Logo"
                                               class="brand-image opacity-75 shadow"> <!--end::Brand Image-->
                <!--begin::Brand Text--> <span class="brand-text fw-light">{{ __('Puntualitos') }}</span> <!--end::Brand Text-->
            </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2"> <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                    <li class="nav-item"><a href="#" class="nav-link"> <i class="nav-icon bi bi-house"></i>
                            <p>
                                {{ __('Inicio') }}
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link"> <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>{{ __('Dashboard') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.edit', Auth::user()) }}" class="nav-link"> <i class="nav-icon bi bi-person-check"></i>
                                    <p>{{ __('Perfil') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();" class="nav-link"> <i class="nav-icon bi bi-box-arrow-right"></i>
                                        <p>{{ __('Salir del sistema') }}</p>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header mt-3">{{ __('MI EMPRESA') }}</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> <i class="nav-icon bi bi-clock-history"></i>
                            <p>{{ __('Históricos') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> <i class="nav-icon bi bi-calendar-check"></i>
                            <p>{{ __('Calendario laboral') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> <i class="nav-icon bi bi-airplane"></i>
                            <p>{{ __('Vacaciones') }}</p>
                        </a>
                    </li>
                    <li class="nav-header mt-3">{{ __('PUNTUALITOS') }}</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> <i class="nav-icon bi bi-question-circle-fill"></i>
                            <p>{{ __('Soporte') }}</p>
                        </a>
                    </li>

                    @if( Auth::user()->email == 'raortega8906@gmail.com' && Auth::user()->is_admin)
                        <li class="nav-header mt-5">{{ __('ADMINISTRACION') }}</li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link"> <i class="nav-icon bi bi-person"></i>
                                <p>{{ __('Usuarios') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('incidents.issueIndex') }}" class="nav-link"> <i class="nav-icon bi bi-clipboard-check"></i>
                                <p>{{ __('Incidencias') }}</p>
                            </a>
                        </li>
                    @endif
                </ul> <!--end::Sidebar Menu-->
            </nav>
        </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar--> <!--begin::App Main-->
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">{{ __('Crear Incidencia') }}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('Crear Incidencia') }}
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="card card-primary mb-4">
                    <form method="POST" action="{{ route('incidents.issueStore') }}">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="check_in_check_out_issue" class="form-label">{{ __('Tipo de incidencia') }}</label>
                                <select name="check_in_check_out_issue" class="form-control" id="check_in_check_out_issue" required>
                                    <option value="Personalizada">{{ __('Personalizada') }}</option>
                                    <option value="checkin">{{ __('Check in') }}</option>
                                    <option value="checkout">{{ __('Check out') }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" class="form-control" id="description"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">{{ __('Crear') }}</button>
                        </div>
                    </form>
                </div>

            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main> <!--end::App Main--> <!--begin::Footer-->
    <footer class="app-footer" style="text-align: center;"> <!--begin::To the end-->
        <p>&copy; {{ date('Y') }} {{ __('Desarrollado por') }} <a href="https://rafaelortegaweb.wpcache.es">{{ __('Rafael A. Ortega') }}</a>.
        </p>
    </footer> <!--end::Footer-->
</div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="../../dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)-->
<!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure-->
</body><!--end::Body-->

</html>
