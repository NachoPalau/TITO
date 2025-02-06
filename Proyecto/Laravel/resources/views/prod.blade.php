<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TITO - Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    @include('layouts.navigation')

    @include('layouts.subnavbar')

    <!-- MAIN CONTAINER -->
    <div class="container">

        <!-- NOVEDADES -->
        <section class="novedades my-4">
            <h2 class="text-center">NOVEDADES</h2>
            <div class="row row-cols-2 row-cols-md-5 g-3">
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FILTROS -->
       



        <!-- PRODUCTOS -->
        <section class="productos">
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="producto card text-center p-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <p class="card-text">Nombre</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- FOOTER -->
    @include( 'layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>