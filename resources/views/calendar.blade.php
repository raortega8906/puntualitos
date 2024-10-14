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

    @php
        $global = \App\Http\Controllers\HolidayController::showHolidays();

    @endphp


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
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Draggable Events</h4>
                    </div>
                    <div class="card-body">

                        <div id="external-events">
                            <div class="external-event bg-success ui-draggable ui-draggable-handle"
                                 style="position: relative;">Lunch
                            </div>
                            <div class="external-event bg-warning ui-draggable ui-draggable-handle"
                                 style="position: relative;">Go home
                            </div>
                            <div class="external-event bg-info ui-draggable ui-draggable-handle"
                                 style="position: relative;">Do homework
                            </div>
                            <div class="external-event bg-primary ui-draggable ui-draggable-handle"
                                 style="position: relative;">Work on UI design
                            </div>
                            <div class="external-event bg-danger ui-draggable ui-draggable-handle"
                                 style="position: relative;">Sleep tight
                            </div>
                            <div class="checkbox">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">

                    <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">

                    </div>

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

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

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
                        <?php foreach ($global['holidays'] as $holiday) {
                            $end = date('Y-m-d', strtotime($holiday->finished . " + 1 days"));
                            ?>
                            {
                                title: 'Vacaciones',
                                start: '<?php echo $holiday->beginning; ?>',
                                end: '<?php echo $end; ?>',
                                allDay: true
                            },
                        <?php } ?>
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

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function (e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>

@endsection
