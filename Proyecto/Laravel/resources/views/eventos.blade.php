<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('layouts.navigation')

    @include('layouts.subnavbar')
    
    <div class="container my-4">
      
        <section class=" bg-light text-center py-5">
        <img src=" ./img_eventos/eventoHindi.jpg" alt="" style="width: 100%">
        </section>

        <h2>Recetas Ganadoras</h2>
        <section class="text-center py-5">
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="./img_eventos/eventoHindi.jpg" class="img-fluid" alt="Receta 1">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="./img_eventos/eventoHindi.jpg" class="img-fluid" alt="Receta 2">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="./img_eventos/eventoHindi.jpg" class="img-fluid" alt="Receta 3">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="./img_eventos/eventoHindi.jpg" class="img-fluid" alt="Receta 4">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="./img_eventos/eventoHindi.jpg" class="img-fluid" alt="Receta 5">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="./img_eventos/eventoHindi.jpg" class="img-fluid" alt="Receta 6">
                </div>
            </div>
        </section>
    </div>
    
    @include('layouts.footer')

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>