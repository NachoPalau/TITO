<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="container-fluid bg-white border-bottom py-4 sticky-top">
        <div class="row align-items-center">
            <!-- Columna del logo (izquierda) -->
            <div class="col-4 d-flex justify-content-start" style="padding-left:3%">
                <img src="img_Header/logo.png" style="width: 80px;">
            </div>

            <!-- Columna del buscador (centrado) -->
            <div class="col-4 d-flex justify-content-center">
                <input type="text" class="form-control w-100" placeholder="Buscar">
            </div>

            <!-- Columna del login y carrito (derecha) -->
            <div class="col-4 d-flex justify-content-end align-items-center gap-3" style="padding-right:3%">
                <img class="img-fluid" src="./img_Header/login.jpg" alt="Login" style="width: 40px; height: 40px;">
                <img class="img-fluid" src="./img_Header/carrito.png" alt="Carrito" style="width: 40px; height: 40px;">
            </div>
        </div>
    </header>

    <nav class="container-fluid bg-light py-4">
        <div class="row justify-content-center">
            <div class="col-auto"><a href="{{ route('productos') }}" class="nav-link active">PRODUCTOS</a></div>
            <div class="col-auto"><a href="#" class="nav-link">RECETAS</a></div>
            <div class="col-auto"><a href="#" class="nav-link">EVENTOS</a></div>
        </div>
    </nav>
    
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
    
    <footer class="container-fluid  text-white text-center py-4 mt-5" style="background-color: rgb(131, 20, 20);">
        <p>Añadir correo para recibir notificaciones</p>
        <div class="row justify-content-center">
            <div class="col-auto">
                <p class="m-0">TITO o LOGO</p>
            </div>
            <div class="col-auto"><a href="#" class="text-white">Contactanos</a></div>
            <div class="col-auto"><a href="#" class="text-white">Términos y condiciones</a></div>
            <div class="col-auto"><a href="#" class="text-white">Cookies</a></div>
        </div>
    </footer>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>