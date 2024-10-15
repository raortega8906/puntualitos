@extends('layouts.puntualitos')

@section('content')
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
    <style>
        ol.breadcrumb.float-sm-end {
            background: transparent;
        }
        .external-event {
            cursor: auto;
        }
    </style>
    
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Calendario') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Calendario') }}
                        </li>
                    </ol>
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible" id="message">
                    <button type="button" class="close" id="close-btn" data-dismiss="alert" aria-hidden="true">×
                    </button>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible" id="message">
                    <button type="button" class="close" id="close-btn" data-dismiss="alert" aria-hidden="true">×
                    </button>
                    <div>{{ session('warning') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible mt-2" id="message">
                    <button type="button" class="close" id="close-btn" data-dismiss="alert" aria-hidden="true">×
                    </button>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Calendario Laboral -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Leyenda</h4>
                            </div>
                            <div class="card-body">
                                <div id="external-events"   >
                                    <div class="external-event bg-success ui-draggable ui-draggable-handle"
                                         style="position: relative;">Feriados
                                    </div>
                                    <div class="external-event bg-primary ui-draggable ui-draggable-handle"
                                         style="position: relative;">Vacaciones
                                    </div>
                                    <div class="external-event bg-danger ui-draggable ui-draggable-handle"
                                         style="position: relative;">No laborables
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>

    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>

    <script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/fullcalendar/main.js"></script>

    <script>
        $(function () {

            // Initialize the calendar
            let date = new Date()
            let d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            let Calendar = FullCalendar.Calendar;
            let Draggable = FullCalendar.Draggable;

            let containerEl = document.getElementById('external-events');
            let calendarEl = document.getElementById('calendar');

            // initialize the external events
            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            let calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [
                        @foreach($holidays as $holiday)
                    {
                        title: 'Vacaciones',
                        start: '{{ $holiday->beginning }}',
                        end: '{{ date('Y-m-d', strtotime($holiday->finished . ' + 1 days')) }}',
                        allDay: true
                    },
                    @endforeach
                ],
                editable: false
            });

            calendar.render();
        })
    </script>

@endsection
