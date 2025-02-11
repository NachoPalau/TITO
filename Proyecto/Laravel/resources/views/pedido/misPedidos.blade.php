<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
        }

        .pedido-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .pedido-numero {
            width: 250px; /* Fijamos un ancho para que todo esté alineado */
            text-align: left;
        }

        .estado-text {
            width: 200px; /* Fijamos un ancho fijo para alinear todas las filas */
            text-align: left;
        }

        .btn-toggle {
            min-width: 130px;
            text-align: center;
        }
    </style>

    <script>
        function toggleDetails(id) {
            var details = document.getElementById("details-" + id);
            var button = document.getElementById("btn-toggle-" + id);

            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
                button.innerHTML = "Mostrar menos ▲";
            } else {
                details.style.display = "none";
                button.innerHTML = "Mostrar más ▼";
            }
        }
    </script>
</head>

<body>

    @include('layouts.navigation')

    <br><br>
    <h1>Mis pedidos</h1>

    @if($pedidos->isEmpty())
    <p>No tienes pedidos registrados</p>
    @else
    @foreach($pedidos as $pedido)
    <div class="border border-0 card mb-2">
        <div class="card-header">
            <div class="pedido-info">
                <p class="pedido-numero">Nº Pedido: {{ $pedido->codigo_seguimiento }}</p>
                <p class="estado-text">Estado: {{ $pedido->estado }}</p>
                <button id="btn-toggle-{{ $pedido->id }}" class="btn btn-outline-secondary btn-sm btn-toggle" onclick="toggleDetails({{ $pedido->id }})">
                    Mostrar más ▼
                </button>
            </div>
        </div>
        <div id="details-{{ $pedido->id }}" class="card-body" style="display: none;">
            <p><strong>Detalles:</strong></p>
            <p><strong>Dir:</strong> {{ $pedido->direccion }}</p>
            <p><strong>Productos:</strong></p>
            <div class="productos-list">
                {{ implode(', ', $pedido->productos ?? []) }}
            </div>
            <p><strong>Total:</strong> {{ $pedido->total }} €</p>
        </div>
    </div>
    @endforeach
    @endif

    <br><br><br><br><br>

    <div style="position: sticky; top:0px">
        @include('layouts.footer')
    </div>

</body>

</html>
