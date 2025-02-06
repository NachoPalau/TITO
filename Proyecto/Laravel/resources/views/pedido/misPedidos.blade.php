<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>

@include('layouts.navigation')
<br><br>    
<h1>Mis pedidos</h1>
    @if($pedidos->isEmpty())
        <p>No tienes pedidos registrados</p>
    @else 
        <table>
            <thead>
                <th>Código de seguimiento</th>
                <th>Estado</th>
                <th>Direcciónn</th>
                <th>última actualización</th>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->codigo_seguimiento }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>{{ $pedido->direccion }}</td>
                        <td>{{ $pedido->updated_at ? $pedido->updated_at->format('d-m-Y H:i:s') : 'No hay actualizaciones' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <br><br><br><br><br><br><br><br><br>
    <div style="position: sticky; top:0px">
    @include('layouts.footer')
    </div>
</body>
</html>