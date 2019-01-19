<table>
    <thead>
    <tr>
        <th>Talento</th>
        <th>Infraestrucutura</th>
        <th>Servicio</th>
        <th>Ambiente</th>
        <th>fecha_creacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datos as $dato)
        <tr>
            <td>{{ $dato->talento }}</td>
            <td>{{ $dato->infraestructura }}</td>
            <td>{{ $dato->servicio }}</td>
            <td>{{ $dato->ambiente }}</td>
            <td>{{ $dato->fecha_creacion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>