@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Incidencias') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Incidencias') }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Incidencia - Usuario') }}</th>
                    <th>{{ __('Tipo Incidencia') }}</th>
                    <th>{{ __('Descripción') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($issues as $issue)
                    <tr class="align-middle">
                        <td>{{ $issue->user->first_name }} {{ $issue->user->last_name }}</td>
                        <td>{{ $issue->check_in_check_out_issue }}</td>
                        <td>{{ $issue->description }}</td>
                        <td style="display: grid; justify-content: space-evenly;">

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $issues->links() }}
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
