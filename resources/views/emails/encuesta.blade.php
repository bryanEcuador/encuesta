@component('mail::message')
# Saludos estudiante

Este correo le llega con el fin de que realice la encuesta de seguimiento de graduados del presente año

@component('mail::button', ['url' => 'http://encuesta.test:8090/encuesta'])
Realizar encuesta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
