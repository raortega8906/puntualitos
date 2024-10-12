@extends('layouts.puntualitos')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Históricos') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Históricos') }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

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

            <div class="mt-4">
                {{ $attendances->links() }}
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
