<h1>Vacaciones modificadas</h1>

<p>Tus vacaciones fueron: </p>
@if($status == 'aprobadas')
    <p>aprobadas</p>
@elseif($status == 'canceladas')
    <p>rechazadas</p>
@endif