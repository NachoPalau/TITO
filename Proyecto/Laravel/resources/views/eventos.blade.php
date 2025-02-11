<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .contenedor-imagen {
            position: relative;
        }

        .carousel-container {
            position: absolute;
            left: 40%;
            transform: translate(-50%, -90%);
            width: 70%;
            z-index: 10;
            margin: 10%;
        }

        .carousel-container img {
            width: 250px;
            /* Ancho fijo para todas las imágenes */
            height: 250px;
            /* Altura fija */
            object-fit: cover;
            /* Ajusta la imagen sin distorsionarla */

        }

        .eventos {
            flex: 1;
            margin: 10%;
            margin-top: 20%;
            width: 80%;

        }
    </style>
</head>
<?php

?>

<body>
    @include('layouts.navigation')
    @include('layouts.subnavbar')

    <section class="contenedor-imagen">
    <img src="{{ asset('img/img_eventos/sanValentin.jpg') }}" alt="Imagen principal"
        style="width: 100%; height: 400px">

    <div id="carouselExample" class="carousel slide carousel-container" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Primer grupo de imágenes -->
            <div class="carousel-item active">
                <div class="d-flex justify-content-center gap-3">
                    @foreach($array1 as $producto)
                        <div class="producto text-center">
                            <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" class="d-block w-25 img-fluid"
                                style="object-fit: cover; max-height: 200px;" alt="{{ $producto->nombre }}">
                            <strong>{{ $producto->nombre }}</strong>
                            <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <button type="submit" class="agregar-carrito">
                                    Añadir al carrito
                                    <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Segundo grupo de imágenes (Usando array2) -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center gap-3">
                    @foreach($array2 as $producto)
                        <div class="producto text-center">
                            <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" class="d-block w-25 img-fluid"
                                style="object-fit: cover; max-height: 200px;" alt="{{ $producto->nombre }}">
                            <strong>{{ $producto->nombre }}</strong>
                            <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <button type="submit" class="agregar-carrito">
                                    Añadir al carrito
                                    <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Controles del carrusel -->
        <button class="carousel-control-prev button-eventos" type="button" data-bs-target="#carouselExample"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next button-eventos" type="button" data-bs-target="#carouselExample"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>


    <div class="eventos">
        <h2 class="text-center my-2">Próximos eventos</h2>
        <section class="py-5">
            <div class="row justify-content-center text-center">
                <div class="col-md-5 col-sm-6 mb-4 d-flex justify-content-center">
                    <img src="{{ asset('img/img_eventos/fallas.jpg') }}" class="img-fluid evento-img" alt="Receta 1">
                </div>
                <div class="col-md-5 col-sm-6 mb-4 d-flex justify-content-center">
                    <img src="{{ asset('img/img_eventos/pascua.jpg') }}" class="img-fluid evento-img" alt="Receta 2">
                </div>
            </div>
        </section>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>