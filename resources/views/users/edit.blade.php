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
                                   aria-describedby="first_name" value="{{ $user->first_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">{{ __('Apellidos') }}</label>
                            <input type="text" name="last_name" class="form-control" id="last_name"
                                   aria-describedby="last_name" value="{{ $user->last_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="departments" class="form-label">{{ __('Departamento') }}</label>
                            <select name="departments" id="departments" aria-describedby="departments" class="form-control" required autofocus>
                                <option value="{{ $user->departments }}" selected>{{ $user->departments ? $user->departments : 'Seleccione un departamento' }}</option>
                                <option value="Desarrollo">{{ __('Desarrollo') }}</option>
                                <option value="Cuentas">{{ __('Cuentas') }}</option>
                                <option value="Diseño">{{ __('Diseño') }}</option>
                                <option value="Vídeo">{{ __('Vídeo') }}</option>
                                <option value="RRHH">{{ __('RRHH') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                                   value="{{ $user->email }}" required>
                        </div>
                        @if(auth()->user()->is_admin)
                        <div class="mb-3">
                            <label for="approved" class="form-label">{{ __('Estado') }}</label>
                            <select name="approved" id="approved" aria-describedby="approved" class="form-control" required autofocus>
                                <option value="1" {{ $user->approved == 1 ? 'selected' : '' }}>{{ __('Aprobado') }}</option>
                                <option value="0" {{ $user->approved == 0 ? 'selected' : '' }}>{{ __('Pendiente') }}</option>
                            </select>
                        </div>
                        @else
                        <div class="mb-3">
                            <input type="hidden" name="approved" value="1">
                        </div>
                        @endif
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
                    </div>
                </form>
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departmentsSelect = document.getElementById('departments');
            const selectedOptionValue = departmentsSelect.options[0].value;

            for (let i = 1; i < departmentsSelect.options.length; i++) {
                if (departmentsSelect.options[i].value === selectedOptionValue) {
                    departmentsSelect.options[i].style.display = 'none';
                }
            }
        });
    </script>
@endsection
