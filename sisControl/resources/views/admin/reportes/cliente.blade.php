<h2>MegaSystem S.A. de C.V.</h2>
<br>
<h3>Listado de clientes</h3>

<table>
    <thead>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Documento</th>
    </thead>
    @foreach ($clientes as $cli)
    <tr>
        <td>{{ $cli->id }}</td>
        <td>{{ $cli->nombre }}</td>
        <td>{{ $cli->apellido }}</td>
        <td>{{ $cli->correo }}</td>
        <td>{{ $cli->documento }}</td>
    </tr>
    @endforeach
</table>