<h1>{{ __('Vacaciones modificadas') }}</h1>

<p>{{ __('Tus vacaciones fueron: ') }}</p>
@if($status == 'aprobadas')
    <p>{{ __('aprobadas') }}</p>
@elseif($status == 'canceladas')
    <p>{{ __('rechazadas') }}</p>
@endif