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
                        <th class="text-bg-success text-white">{{ __('Horas') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        use Carbon\Carbon;
                        $i = 0;
                        $count = 0;
                    @endphp
                    @if( Auth::user()->email == 'raortega8906@gmail.com')
                        @foreach($attendances as $attendance)
                            @if(auth()->user()->id == $attendance->user_id && $i++ < 10)
                                @php
                                    $attendanceDate = Carbon::parse($attendance->created_at);
                                @endphp
                                @if($attendanceDate->isCurrentMonth())
                                    <tr>
                                        <td>{{ $attendanceDate->format('Y/m/d') }}</td>
                                        <td>{{ Carbon::parse($attendance->check_in)->format('H:i') }}</td>
                                        @if($attendance->check_out != null)
                                            <td>{{ Carbon::parse($attendance->check_out)->format('H:i') }}</td>
                                        @else
                                            <td> - </td>
                                        @endif
                                        @if($attendance->check_out != null)
                                            @php
                                                $checkIn = new DateTime($attendance->check_in);
                                                $checkOut = new DateTime($attendance->check_out);
                                                $interval = $checkIn->diff($checkOut);
                                                $count += (int) $interval->format('%H');
                                            @endphp
                                            <td>{{ (int) $interval->format('%H') }}</td>
                                        @else
                                            <td> - </td>
                                        @endif
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @else
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
                                    @if($attendance->check_out != null)
                                        @php
                                            $checkIn = new DateTime($attendance->check_in);
                                            $checkOut = new DateTime($attendance->check_out);
                                            $interval = $checkIn->diff($checkOut);
                                            $count += (int) $interval->format('%H');
                                        @endphp
                                        <td>{{ (int) $interval->format('%H') }}</td>
                                    @else
                                        <td> - </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            @php
                setlocale(LC_TIME, 'es_ES.UTF-8');
                $mesActual = strftime('%B');
            @endphp

            <div class="mt-4">
                {{ 'Total de horas en ' . $mesActual . ': ' . $count . ' horas'}}
            </div>

            <div class="mt-4">
                {{ $attendances->links() }}
            </div>

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
