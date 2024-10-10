@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Perfil') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Perfil') }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="card card-primary mb-4">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" name="first_name" class="form-control" id="first_name"
                                   aria-describedby="first_name" value="{{ $user->first_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">{{ __('Apellidos') }}</label>
                            <input type="text" name="last_name" class="form-control" id="last_name"
                                   aria-describedby="last_name" value="{{ $user->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="departments" class="form-label">{{ __('Departamento') }}</label>
                            <input type="text" name="departments" class="form-control" id="departments"
                                   aria-describedby="departments" value="{{ $user->departments }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                                   value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
                    </div>
                </form>
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
