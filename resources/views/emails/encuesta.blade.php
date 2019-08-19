@component('mail::message')
# Saludos estudiante de la promoción {{$promocion}}

Este correo le llega con el fin de que realice la encuesta de seguimiento de graduados del presente año.

@component('mail::button', ['url' => $url])
Realizar encuesta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
