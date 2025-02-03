<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/prueba.css') }}">


</head>
<body>
    <h1>Listado de productos</h1>
    <div id="productos">
        @foreach($productos as $producto)
            <div class="producto">
                <img src="{{ asset('images/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                <strong>{{ $producto->nombre }}</strong> {{ $producto->precio }} €
                <p>{{ $producto->descripcion }}</p>
                <button>Añadir al carrito<img  id="carrito"src="{{ asset('images/carrito.svg') }}"></button>
            </div>
        @endforeach
    </div>
</body>
</html>
