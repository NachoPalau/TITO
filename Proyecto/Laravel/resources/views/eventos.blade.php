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
            transform: translate(-50%, -50%);
            width: 80%;
            z-index: 10;
            margin: 10%;
        }

        .eventos {
            flex: 1;
            margin: 20% auto;
            width: 80%;
            padding: 50px 0;
        }

        
        .footer {
            background-color: #800000;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .formulario {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')
    @include('layouts.subnavbar')

    <section class="contenedor-imagen">
        <img src="{{ asset('img/img_eventos/eventoHindi.jpg') }}" alt="Imagen principal" style="width: 100%; height:400px">
        
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
                        <img src="{{ asset('img/productos/pack_sanvalentin.jpg') }}" class="d-block w-25" alt="Evento 6">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <div class="eventos">
        <h2 class="text-center my-4">Próximos eventos</h2>
        <section class="text-center py-5">
            <div class="row">
                <div style="width: 500px;" class="col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('img/img_eventos/pascua.jpg') }}" class="img-fluid" alt="Receta 1">
                </div>
                <div style="width: 500px;" class="col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('img/img_eventos/pepito.jpg') }}" class="img-fluid" alt="Receta 2">
                </div>
            </div>
        </section>
    </div>

    <div class="formulario">
        <form>
            <label for="email">Añadir correo para recibir notificaciones:</label>
            <input type="email" id="email" name="email" class="form-control d-inline-block w-auto mx-2">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <footer class="footer">
        <div>TITO o LOGO</div>
        <div>
            <a href="#">Contactanos</a> | <a href="#">Términos y condiciones</a> | <a href="#">Cookies</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
