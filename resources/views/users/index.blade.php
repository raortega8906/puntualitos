@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Usuarios') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Usuarios') }}
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">
                        {{ __('Crear nuevo usuario') }}
                    </a>
                </div>
            </div> <!--end::Row-->
            @if(session('status'))
                <div class="alert alert-success alert-dismissible mt-2" id="message">
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
            @if(session('delete'))
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
                    <div>{{ session('delete') }}</div>
                </div>
            @endif
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Nombre y Apellidos') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Departamento') }}</th>
                    <th>{{ __('Estado') }}</th>
                    <th>{{ __('Acciones') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="align-middle">
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->departments }}</td>
                        @if($user->approved)
                            <td class="grid items-center text-center"><span class="badge bg-success items-center text-center">{{ __('Aprobado') }}</span></td>
                        @else
                            <td class="grid items-center text-center"><span class="badge bg-warning items-center text-center">{{ __('Pendiente') }}</span></td>
                        @endif
                        <td style="display: grid; justify-content: space-evenly;">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary position-relative mb-2">
                                {{ __('Editar') }}
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}"
                                  onsubmit="return confirm('¿Estás seguro que quieres eliminar el usuario?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Eliminar') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
