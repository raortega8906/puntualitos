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
                                    <th class="text-bg-success text-white">{{ __('Entrada') }}</th>
                                    <th class="text-bg-success text-white">{{ __('Salida') }}</th>
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
                                            <td>{{ Carbon::parse($attendance->check_in)->format('H:i') }}</td>
                                            @if($attendance->check_out != null)
                                                <td>{{ Carbon::parse($attendance->check_out)->format('H:i') }}</td>
                                            @else
                                                <td> - </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

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

                    </div> <!--end::Small Box Widget 3-->

                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ __('Mis vacaciones') }}</h3>
                            <p>{{ __('Vacaciones al año: '). 22 }}</p>
                            <p>{{ __('Vacaciones usadas: '). 22 - Auth::user()->holidays }}</p>
                            <p>{{ __('Vacaciones restantes: '). Auth::user()->holidays }}</p>
                        </div>
                    </div> <!--end::Small Box Widget 3-->
                </div> <!--end::Col-->

            </div> <!--end::Row--> <!--begin::Row-->

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
