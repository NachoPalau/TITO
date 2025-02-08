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
    <div class="container">
    <div id="popupLogin" class="popup" style="display: none;">
    <div class="popup-contenido">
        <span id="cerrarPopup" class="popup-cerrar">✖</span>
        <h2>¡Debes iniciar sesión para añadir al carrito!</h2> 
        <p>Para poder añadir el producto al carrito, primero necesitas iniciar sesión en tu cuenta.</p> 
        <button onclick="window.location.href='/login'">Iniciar sesión</button>
    </div>
</div>

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
        @if(auth()->check())
    <button id="mostrarFavoritosBtn">Mostrar Recetas Favoritas</button>
    @endif

    <div id="recetas">
        @foreach($recetas as $receta)
        <div class="receta" data-guardados="{{ $receta->guardados }}">
            <strong>{{ $receta->titulo }}</strong>
            @if(auth()->check())
            <img id="estrella" src="{{ asset(in_array($receta->id, json_decode(auth()->user()->favoritas, true)) ? 'img/carrito/estrella.svg' : 'img/carrito/estrellaVacia.svg') }}" onclick="window.location.href='{{ in_array($receta->id, json_decode(auth()->user()->favoritas, true)) ? '/eliminar-favorito/' . $receta->id : '/guardar-favorito/' . $receta->id }}'">
            @else
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            @endif
            <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
            <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
            <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
            <button class="agregar-carrito">Añadir al carrito <img id="carrito" src="{{ asset('img/carrito/carrito.svg') }}"></button>
        </div>
        @endforeach
    </div>
        </section>

    </div>

    <!-- FOOTER -->
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputBusqueda = document.getElementById("busquedaTotal");

        if (!inputBusqueda) {
            console.error("No se encontró el input de búsqueda.");
            return;
        }

        inputBusqueda.addEventListener("keyup", function () {
            filtrarTotal(this.value);
        });

        function filtrarTotal(valor) {
            valor = valor.toLowerCase();
            const productos = document.querySelectorAll("#productos .producto");

            productos.forEach(producto => {
                const nombre = producto.querySelector("strong").textContent.toLowerCase();
                producto.style.display = nombre.includes(valor) ? "block" : "none";
            });
        }

        // Popup Login
        const popupLogin = document.getElementById("popupLogin");
        const cerrarPopup = document.getElementById("cerrarPopup");

        // Agregar evento de cerrar popup
        cerrarPopup.addEventListener("click", function () {
            popupLogin.style.display = "none";
        });

        // Obtén todos los botones de añadir al carrito
        const botonesCarrito = document.querySelectorAll(".agregar-carrito");

        botonesCarrito.forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault(); // Prevenir el envío del formulario

                // Verificar si el usuario está logueado
                if (!{{ auth()->check() ? 'true' : 'false' }}) { // Usamos Blade para pasar la variable de autenticación
                    // Mostrar popup de login si no está logueado
                    popupLogin.style.display = "flex";
                } else {
                    // Si está logueado, proceder con la acción de agregar al carrito
                    this.closest('form').submit(); // Enviar el formulario
                }
            });
        });
    });
</script>

</html>
