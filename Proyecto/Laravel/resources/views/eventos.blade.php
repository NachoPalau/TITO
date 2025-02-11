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
            transform: translate(-50%, -70%);
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
            margin-top: 25%;
            width: 80%;
            margin-bottom: -3%;
        }

        .evento-img {
            height: 350px;
            /* Ajusta según necesites */
            object-fit: cover;
            /* Mantiene la proporción sin deformar */
            width: 100%;
            /* Asegura que ocupen el mismo ancho dentro de su contenedor */
        }
    </style>
</head>
<?php

?>

<body>
    @include('layouts.navigation')
    @include('layouts.subnavbar')

    <section class="contenedor-imagen">
        <img src="{{ asset('img/img_eventos/sanValentin.jpg') }}" 
     alt="Imagen principal" 
     class="img-fluid w-100" 
     style="max-height: 400px; object-fit: cover;">

        <div id="carouselExample" class="carousel slide carousel-container" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center gap-3">
                        @foreach($array1 as $producto)
                        <div class="producto" data-nombre="{{ $producto->nombre }}"
                            data-precio="{{ $producto->precio }}">
                            <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" class="d-block w-20"
                                alt="{{ $producto->nombre }}">
                            <strong>{{ $producto->nombre }}</strong>
                            <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="agregar-carrito">
                                    Añadir al carrito
                                    <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center gap-3">
                        @foreach($array2 as $producto)
                        <div class="producto" data-nombre="{{ $producto->nombre }}"
                            data-precio="{{ $producto->precio }}">
                            <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" class="d-block w-20"
                                alt="{{ $producto->nombre }}">
                            <strong>{{ $producto->nombre }}</strong>
                            <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                <input type="hidden" name="cantidad" value="1">
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
            <button class="carousel-control-prev button-eventos" type="button" data-bs-target="#carouselExample"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next button-eventos" type="button" data-bs-target="#carouselExample"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <div class="eventos">
        <h2 class="text-center my-2">Próximos eventos</h2>
        <section class="py-5">
            <div class="row justify-content-center text-center">
                <div class="col-md-5 col-sm-6 mb-4 d-flex flex-column align-items-center">
                    <img src="{{ asset('img/img_eventos/fallas.jpg') }}" class="img-fluid evento-img" alt="Fallas">
                    <p class="mt-3"><strong>Las Fallas:</strong> Disfruta de esta festividad llena de fuego y tradición. Cada marzo, Valencia se ilumina con impresionantes monumentos falleros que arden en una noche mágica. Además de los espectaculares castillos de fuegos artificiales, podrás disfrutar de música, gastronomía típica y una atmósfera vibrante. ¡No te lo pierdas!</p>
                </div>
                <div class="col-md-5 col-sm-6 mb-4 d-flex flex-column align-items-center">
                    <img src="{{ asset('img/img_eventos/pascua.jpg') }}" class="img-fluid evento-img" alt="Pascua">
                    <p class="mt-3"><strong>Pascua:</strong> Celebra con nosotros la llegada de la primavera y las tradiciones pascuales. Disfruta de la típica mona de Pascua, los juegos con huevos de chocolate y reuniones familiares llenas de alegría. Esta es una época perfecta para compartir, relajarse y degustar los sabores de la temporada. ¡Únete a la celebración!</p>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>