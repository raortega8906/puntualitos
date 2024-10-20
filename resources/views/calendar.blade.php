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

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>

    <script>
        $(function () {
            let Calendar = FullCalendar.Calendar;
            let Draggable = FullCalendar.Draggable;

            let containerEl = document.getElementById('external-events');
            let calendarEl = document.getElementById('calendar');

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

            // Obtener vacaciones desde Laravel
            let holidays = @json($holidays); // Vacaciones

            // Función para detectar fines de semana
            function isWeekend(date) {
                const day = date.getDay();
                return day === 0 || day === 6; // Domingo (0) o Sábado (6)
            }

            // Array para guardar los eventos
            let events = [];

            // Agregar las vacaciones (en azul) al array de eventos
            holidays.forEach(function(holiday) {
                events.push({
                    title: 'Vacaciones',
                    start: holiday.beginning,
                    end: moment(holiday.finished).add(1, 'days').format('YYYY-MM-DD'),
                    allDay: true,
                    backgroundColor: 'blue',
                    borderColor: 'blue'
                });

                // Generar eventos para fines de semana (en rojo)
                let startDate = moment(holiday.beginning);
                let endDate = moment(holiday.finished);
                for (let date = startDate.clone(); date.isSameOrBefore(endDate); date.add(1, 'days')) {
                    if (isWeekend(date.toDate())) {
                        events.push({
                            title: 'Fin de semana',
                            start: date.format('YYYY-MM-DD'),
                            allDay: true,
                            backgroundColor: 'red',
                            borderColor: 'red'
                        });
                    }
                }
            });

            // Obtener festivos de la API
            const apiKey = 'olBQbC1o2ynOA0CtzVo5wanhELBwaQSm'; // Reemplaza con tu clave de API
            const year = new Date().getFullYear(); // Obtiene el año actual
            const country = 'ES'; // Código de país para España
            const location = 'Madrid'

            const translations = {
                "New Year's Day": "Año Nuevo",
                "Epiphany": "Día de Reyes",
                "Good Friday": "Viernes Santo",
                "Easter Sunday": "Domingo de Resurrección",
                "Labour Day": "Día del Trabajador",
                "Assumption of Mary": "Asunción de la Virgen",
                "National Day": "Día Nacional de España",
                "All Saints' Day": "Día de Todos los Santos",
                "Immaculate Conception": "Inmaculada Concepción",
                "Christmas Day": "Navidad",
                "Boxing Day": "Día de San Esteban",
                "New Year's Eve": "Nochevieja",
                "Candlemas": "Candelaria",
                "Saint Joseph's Day": "Día de San José",
                "Saint James' Day": "Día de Santiago",
                "Saint Andrew's Day": "Día de San Andrés",
                "San Isidro": "San Isidro",
                "San Juan": "San Juan",
                "Day of the Region": "Día de la Región",
                "Hispanic Day": "Día de la Hispanidad",
                "Daylight Saving Time ends": "Finaliza el horario de verano",
                "Constitution Day": "Día de la constitución",
                "December Solstice": "Solsticio de diciembre",
                "Christmas Eve": "Nochebuena",
                "Feast of the Holy Family": "Fiesta de la Sagrada Familia",
                "Reconquest Day": "Día de la Reconquista",
                // Agrega más traducciones según sea necesario
            };

            fetch(`https://calendarific.com/api/v2/holidays?api_key=${apiKey}&country=${country}&year=${year}&location=${location}`)
                .then(response => response.json())
                .then(data => {
                    const festivos = data.response.holidays;

                    // Agregar festivos (en verde) al array de eventos
                    festivos.forEach(function(festivo) {
                        const title = translations[festivo.name] || festivo.name; // Usa la traducción o el nombre original
                        events.push({
                            title: title,
                            start: festivo.date.iso,
                            allDay: true,
                            backgroundColor: 'green',
                            borderColor: 'green'
                        });
                    });

                    // Inicializar el calendario después de cargar los festivos
                    let calendar = new Calendar(calendarEl, {
                        locale: 'es',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        themeSystem: 'bootstrap',
                        events: events,  // Cargar todos los eventos generados
                        editable: false
                    });

                    calendar.render();
                })
                .catch(error => {
                    console.error('Error fetching holidays:', error);
                });

        });
    </script>



@endsection
