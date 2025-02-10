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
            transform: translate(-50%, -75%);
            width: 70%;
            z-index: 10;
            margin: 10%;
        }
            .carousel-container img {
            width: 250px; /* Ancho fijo para todas las imágenes */
            height: 250px; /* Altura fija */
            object-fit: cover;/* Ajusta la imagen sin distorsionarla */

        }

        .eventos {
            flex: 1;
            margin: 10%;
            margin-top: 20% ;
            width: 80%;
            
        }
        
    </style>
</head>

<body>
    @include('layouts.navigation')
    @include('layouts.subnavbar')

    <section class="contenedor-imagen">
        <img src="{{ asset('img/img_eventos/sanValentin.jpg') }}" alt="Imagen principal" style="width: 100%; height:400px">
        
        <div id="carouselExample" class="carousel slide carousel-container" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center gap-3">
                        <img src="{{ asset('img/productos/corazon_kinder.jpg') }}" class="d-block w-25" alt="Evento 1">
                        <img src="{{ asset('img/productos/ramo_rosas.jpg') }}" class="d-block w-25" alt="Evento 2">
                        <img src="{{ asset('img/productos/pack_sanvalentin.jpg') }}" class="d-block w-25" alt="Evento 3">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center gap-3">
                        <img src="{{ asset('img/productos/bombones_mym.jpg') }}" class="d-block w-25" alt="Evento 4">
                        <img src="{{ asset('img/productos/taza_sanvalentin.jpg') }}" class="d-block w-25" alt="Evento 5">
                        <img src="{{ asset('img/img_eventos/corazon.jpg') }}" class="d-block w-25" alt="Evento 6">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev button-eventos" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next button-eventos" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
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
