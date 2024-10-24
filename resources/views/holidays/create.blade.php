@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Crear Vacaciones') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Crear Vacaciones') }}
                        </li>
                    </ol>
                </div>
                @if($errors->any())
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
                        <div>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="card card-primary mb-4">
                <form method="POST" action="{{ route('holidays.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="beginning" class="form-label">{{ __('Fecha de inicio') }}</label>
                            <input type="date" name="beginning" class="form-control" id="beginning" required>
                        </div>
                        <div class="mb-3">
                            <label for="finished" class="form-label">{{ __('Fecha de finalización') }}</label>
                            <input type="date" name="finished" class="form-control" id="finished" required>
                        </div>
                        <p>{{ __('Vacaciones restantes: '). Auth::user()->holidays }}</p>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('Crear') }}</button>
                    </div>
                </form>
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
