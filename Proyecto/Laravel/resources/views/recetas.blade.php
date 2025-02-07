<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TITO - Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

@include('layouts.navigation')

@include('layouts.subnavbar')

    <!-- MAIN CONTAINER -->
    <div class="container">
        
        <!-- NOVEDADES -->
        <section class="novedades my-4">
            <h2 class="text-center">DESTACADAS</h2>
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
        <section class="filtros d-flex justify-content-between my-4">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filtrar
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Precio más bajo</a></li>
                    <li><a class="dropdown-item" href="#">Precio más alto</a></li>
                    <li><a class="dropdown-item" href="#">Más vendidos</a></li>
                </ul>
            </div>
            <button class="btn btn-outline-secondary">A-Z ⬆⬇</button>
            <button class="btn btn-outline-secondary">Precio ⬆⬇</button>
        </section>

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
