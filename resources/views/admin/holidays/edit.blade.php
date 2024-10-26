@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Editar Vacaciones') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Editar Vacaciones') }}
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
                <form method="POST" action="{{ route('admin.holidays.update', $holiday) }}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="beginning" class="form-label">{{ __('Estado de la vacación') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value="en espera" {{ $holiday->status == 'en espera' ? 'selected' : '' }}>{{ __('En espera') }}</option>
                                <option value="aprobadas" {{ $holiday->status == 'aprobadas' ? 'selected' : '' }}>{{ __('Aprobadas') }}</option>
                                <option value="canceladas" {{ $holiday->status == 'canceladas' ? 'selected' : '' }}>{{ __('Canceladas') }}</option>
                            </select>
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
