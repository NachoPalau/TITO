<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - TITO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="container-fluid bg-white border-bottom py-2">
            <!-- Columna del logo -->
            <div class="col-md-2  text-start">
                <img src="img_Header/logo.png" style="width: 80px;">
            </div>
    
            <!-- Columna del buscador centrado -->
            <div class="col-md-6 d-flex justify-content-center">
                <input type="text" class="form-control w-75" placeholder="Buscar">
            </div>
    
            <!-- Columna del login y carrito alineados a la derecha -->
            <div class="col-md-3 d-flex justify-content-end align-items-center gap-3">
                <img class="img-fluid" src="./img_Header/login.jpg" alt="Login" style="width: 40px; height: 40px;">
                <img class="img-fluid" src="./img_Header/carrito.png" alt="Carrito" style="width: 40px; height: 40px;">
                <span> Carrito</span>
            </div>
    </header>
    
    <nav class="container-fluid bg-light py-2">
        <div class="row justify-content-center">
            <div class="col-auto"><a href="./PagProd/indexProd.html" class="nav-link active">PRODUCTOS</a></div>
            <div class="col-auto"><a href="#" class="nav-link">RECETAS</a></div>
            <div class="col-auto"><a href="#" class="nav-link">EVENTOS</a></div>
        </div>
    </nav>
    <div class="container my-4">
        <section class="bg-light text-center py-5">
            <img src="./img_eventos/eventoHindi.jpg" alt="">
        </section>
        <section class="text-center py-5">
            <img src="./img_eventos/recetasGanadoras.jpg" alt="">
        </section>
    </div>
    <footer class="container-fluid text-white text-center py-4 mt-5">
        <p>Añadir correo para recibir notificaciones</p>
        <div class="row justify-content-center">
            <div class="col-auto"><p class="m-0">TITO o LOGO</p></div>
            <div class="col-auto"><a href="#" class="text-white">Contactanos</a></div>
            <div class="col-auto"><a href="#" class="text-white">Términos y condiciones</a></div>
            <div class="col-auto"><a href="#" class="text-white">Cookies</a></div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
