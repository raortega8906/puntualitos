@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Dashboard') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Dashboard') }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
            @if(session('status'))
                <div class="alert alert-success alert-dismissible" id="message">
                    <button type="button" class="close" id="close-btn" data-dismiss="alert" aria-hidden="true" style="position: absolute;
                            top: 0;
                            right: 0;
                            z-index: 2;
                            padding: .75rem 1.25rem;
                            background-color: transparent;
                            border: 0;
                            color: inherit;">×
                    </button>
                    <div>{{ session('status') }}</div>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible" id="message" style="color: #1f2d3d;
                        background-color: #ffc107;
                        border-color: #edb100;">
                    <button type="button" class="close" id="close-btn" data-dismiss="alert" aria-hidden="true" style="position: absolute;
                            top: 0;
                            right: 0;
                            z-index: 2;
                            padding: .75rem 1.25rem;
                            background-color: transparent;
                            border: 0;
                            color: #1f2d3d;">×
                    </button>
                    <div>{{ session('warning') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-dannger alert-dismissible mt-2" id="message" style="color: #fff;
                        background-color: #dc3545;
                        border-color: #d32535;">
                    <button type="button" class="close" id="close-btn" data-dismiss="alert" aria-hidden="true" style="position: absolute;
                            top: 0;
                            right: 0;
                            z-index: 2;
                            padding: .75rem 1.25rem;
                            background-color: transparent;
                            border: 0;
                            color: inherit;">×
                    </button>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row"> <!--begin::Col-->
                <div class="col-lg-4 col-8"> <!--begin::Small Box Widget 1-->
                    <div class="small-box text-bg-primary">
                        <div class="inner" style="display: grid;">
                            <div id="tempo"></div>
                            <h3>{{ __('Registros') }}</h3>

                            <form method="POST" action="{{ route('check-in') }}" style="display: contents;">
                                @csrf
                                @if($flag_checkin)
                                    <button type="submit" class="btn btn btn-block btn-success btn-lg mb-2">
                                        {{ __('Registrar entrada') }}
                                    </button>
                                @else
                                    <button type="submit" class="btn btn btn-block btn-success btn-lg mb-2" disabled>
                                        {{ __('Registrar entrada') }}
                                    </button>
                                @endif
                            </form>
                            <form method="POST" action="{{ route('check-out') }}" style="display: contents;">
                                @csrf
                                @if($flag_checkout)
                                    <button type="submit" class="btn btn-danger btn-lg mb-2">
                                        {{ __('Registrar salida') }}
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-danger btn-lg mb-2" id="pause_checkout" disabled>
                                        {{ __('Registrar salida') }}
                                    </button>
                                @endif
                            </form>
                            <a href="{{ route('incidents.issueCreate') }}" class="btn btn-warning btn-lg mb-2">
                                {{ __('Registrar incidencia') }}
                            </a>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                        </svg>
                        <a href="#"
                           class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 1-->
                </div> <!--end::Col-->

                <div class="col-lg-4 col-8">
                    <!--begin::Small Box Widget 2-->
                    <div class="small-box text-bg-success d-flex flex-column justify-content-center">
                        <div class="inner">
                            <h3>{{ __('Últimos registros') }}</h3>
                            <p></p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover text-center align-middle">
                                <thead>
                                <tr>
                                    <th class="text-bg-success text-white">{{ __('Día') }}</th>
                                    <th class="text-bg-success text-white">{{ __('Checkin') }}</th>
                                    <th class="text-bg-success text-white">{{ __('Checkout') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    use Carbon\Carbon;
                                    $i = 0;
                                @endphp
                                @foreach($attendances as $attendance)
                                    @if(auth()->user()->id == $attendance->user_id && $i++ < 10)
                                        <tr>
                                            <td>{{ Carbon::parse($attendance->created_at)->format('Y/m/d') }}</td>
                                            <td>{{ Carbon::parse($attendance->check_in)->format('H:i:s') }}</td>
                                            @if($attendance->check_out != null)
                                                <td>{{ Carbon::parse($attendance->check_out)->format('H:i:s') }}</td>
                                            @else
                                                <td> -</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                        </svg>
                        <a href="#"
                           class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            <i class="bi bi-link-45deg"></i>
                        </a>
                    </div> <!--end::Small Box Widget 2-->
                </div> <!--end::Col-->

                <div class="col-lg-4 col-8"> <!--begin::Small Box Widget 3-->
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ __('Mis datos') }}</h3>
                            <p>{{ __('Nombre: '). Auth::user()->first_name }}</p>
                            <p>{{ __('Apellidos: '). Auth::user()->last_name }}</p>
                            <p>{{ __('Departamento: '). Auth::user()->departments }}</p>
                            <p>{{ __('Email: '). Auth::user()->email }}</p> 
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                        </svg>
                        <a href="#"
                           class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 3-->

                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ __('Mis vacaciones') }}</h3>
                            <p>{{ __('Vacaciones al año: '). 22 }}</p>
                            <p>{{ __('Vacaciones usadas: '). 22 - Auth::user()->holidays }}</p>
                            <p>{{ __('Vacaciones restantes: '). Auth::user()->holidays }}</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                        </svg>
                        <a href="#"
                           class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 3-->
                </div> <!--end::Col-->

            </div> <!--end::Row--> <!--begin::Row-->

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
