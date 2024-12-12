@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Crear Usuario') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Crear Usuario') }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="card card-primary mb-4">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">{{ __('Apellidos') }}</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="departments" class="form-label">{{ __('Departamento') }}</label>
                            <input type="text" name="departments" class="form-control" id="departments" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="approved" value="1">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="avatar" value="/images/avatars/default-150x150.png">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('Crear') }}</button>
                    </div>
                </form>
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
