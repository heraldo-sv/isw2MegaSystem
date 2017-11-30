<h2>MegaSystem S.A. de C.V.</h2>
<br>
<h3>Listado de proveedores</h3>

<table>
    <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
    </thead>
    @foreach ($proveedores as $prov)
    <tr>
        <td>{{ $prov->id }}</td>
        <td>{{ $prov->nombre }}</td>
        <td>{{ $prov->direccion }}</td>
        <td>{{ $prov->telefono }}</td>
    </tr>
    @endforeach
</table>