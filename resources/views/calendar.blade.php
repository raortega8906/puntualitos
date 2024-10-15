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
    </style>

    {{--    dd($global['holidays']);--}}

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('Dashboard') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Dashboard') }}
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
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div id="external-events"></div>
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

    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>

    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>

    <script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/fullcalendar/main.js"></script>

    <script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script>

    <script>
        $(function () {

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

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

            var calendar = new Calendar(calendarEl, {
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
                        start: '{{ $holiday->beginning }}', // Asegúrate de usar comillas para las fechas
                        end: '{{ date('Y-m-d', strtotime($holiday->finished . ' + 1 days')) }}', // Asegúrate de usar comillas aquí también
                        allDay: true
                    },
                    @endforeach
                ],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

        })
    </script>

@endsection
