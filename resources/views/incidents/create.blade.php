@extends('layouts.puntualitos')

@section('content')
<!--begin::App Content Header-->
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
@endsection
