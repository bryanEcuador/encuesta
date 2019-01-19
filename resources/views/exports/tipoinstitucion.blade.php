<table>
    <thead>
    <tr>
        <th>descripcion</th>
        <th>fecha_creacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datos as $dato)
        <tr>
            <td>{{ $dato->descpcion }}</td>
            <td>{{ $dato->fecha_creacion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>