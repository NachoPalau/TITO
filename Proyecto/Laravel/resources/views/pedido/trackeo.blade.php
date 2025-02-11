<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- esta linea es super importante para enlazar el codigo de seguimiento con la base de datos -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <title>Trackeo de pedido</title>
</head>
<body>
@include('layouts.navigation')

<br>

<div>
<h1>Seguimiento del pedido</h1>
    <form id="track-form" method="POST" action="{{ route('track.pedido') }}">
        @csrf
        <label for="codigo">Código de seguimiento:</label>
        <input type="text" id="codigo" name="codigo_seguimiento" required>
        <button type="submit">Rastrear</button>
    </form>

    <div id="resultado"></div>
</div>

<div style="position: sticky; bottom:0px">
@include('layouts.footer')
</div>
    

    <script>
        document.getElementById('track-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            let codigo = document.getElementById('codigo').value;
            let resultado = document.getElementById('resultado');

            try {
                let response = await fetch('{{ route("track.pedido") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        codigo_seguimiento: codigo
                    })
                });

                if (response.ok) {
                    let data = await response.json();
                    resultado.innerHTML = `<p>Estado: ${data.estado}</p>
                                           <p>Dirección: ${data.direccion}</p>
                                           <p>Última actualización: ${data.actualizado_en}</p>`;
                } else {
                    resultado.innerHTML = `<p style="color:red;">Código de seguimiento no encontrado</p>`;
                }
            } catch (error) {
                console.error("Error:", error);
                resultado.innerHTML = `<p style="color:red;">Error al procesar la solicitud</p>`;
            }
        });
    </script>
</body>
</html>
