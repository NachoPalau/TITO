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
        <div id="popupLogin" class="popup" style="display: none;">
            <div class="popup-contenido">
                <span id="cerrarPopup" class="popup-cerrar">✖</span>
                <h2>¡Debes iniciar sesión para añadir al carrito!</h2>
                <p>Para poder añadir el producto al carrito, primero necesitas iniciar sesión en tu cuenta.</p>
                <button onclick="window.location.href='/login'">Iniciar sesión</button>
            </div>
        </div>
        <h1>Novedades</h1>
        <!-- NOVEDADES -->
        <section class="novedades my-4">
            <div id="productosDes">
                @foreach($productosDestacados as $producto)
                <div class="producto">
                    <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                    <strong>{{ $producto->nombre }}</strong>
                    <p>Descripción: {{ $producto->descripcion }}</p>
                    <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>

                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <input type="hidden" name="precio" value="{{ $producto->precio }}">
                    <input type="hidden" name="cantidad" value="1">
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="button-primary agregar-carrito">
                            {{ __('Añadir al carrito') }}
                            <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                        </x-primary-button>
                    </div>

                </div>
                @endforeach
            </div>

        </section>

        <!-- FILTROS -->
        @include('components.filtrar')

        <div id="productos">
            @foreach($productos as $producto)
            <div class="producto" data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}">
                <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                <strong>{{ $producto->nombre }}</strong>
                <p>Descripción: {{ $producto->descripcion }}</p>
                <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>

                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <input type="hidden" name="precio" value="{{ $producto->precio }}">
                <input type="hidden" name="cantidad" value="1">
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="button-primary agregar-carrito">
                        {{ __('Añadir al carrito') }}
                        <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                    </x-primary-button>
                </div>

            </div>
            @endforeach
        </div>

    </div>

    <!-- FOOTER -->
    @include( 'layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Elementos del DOM
        const inputBusqueda = document.getElementById("busquedaTotal");
        const productosContainer = document.getElementById("productos"); // Contenedor de productos
        const ordenarAZBtn = document.querySelector('.filtros .btn:first-child'); // Botón A-Z
        const ordenarPrecioBtn = document.querySelector('.filtros .btn:nth-child(2)'); // Botón Precio
        const popupLogin = document.getElementById("popupLogin");
        const cerrarPopup = document.getElementById("cerrarPopup");
        const botonesCarrito = document.querySelectorAll(".agregar-carrito");

        let ordenAscendente = true; // Controla orden A-Z
        let ordenPrecioAscendente = true; // Controla orden de precio

        // Función para filtrar productos por nombre
        if (inputBusqueda) {
            inputBusqueda.addEventListener("keyup", function() {
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
        } else {
            console.error("No se encontró el input de búsqueda.");
        }

        // Función para ordenar productos alfabéticamente
        ordenarAZBtn.addEventListener("click", function() {
            ordenAscendente = !ordenAscendente;

            const productos = Array.from(productosContainer.querySelectorAll(".producto"));
            productos.sort((a, b) => {
                const nombreA = a.querySelector("strong").textContent.toLowerCase();
                const nombreB = b.querySelector("strong").textContent.toLowerCase();
                return ordenAscendente ? nombreA.localeCompare(nombreB) : nombreB.localeCompare(nombreA);
            });

            actualizarProductos(productos);
            ordenarAZBtn.textContent = ordenAscendente ? "A-Z ⬆" : "Z-A ⬇"; // Actualiza el texto del botón
        });

        // Función para ordenar productos por precio
        ordenarPrecioBtn.addEventListener("click", function() {
            ordenPrecioAscendente = !ordenPrecioAscendente;

            const productos = Array.from(productosContainer.querySelectorAll(".producto"));
            productos.sort((a, b) => {
                const precioA = parseFloat(a.dataset.precio);
                const precioB = parseFloat(b.dataset.precio);

                if (isNaN(precioA) || isNaN(precioB)) {
                    return 0; // Si no hay precio, mantener el orden
                }

                return ordenPrecioAscendente ? precioA - precioB : precioB - precioA;
            });

            actualizarProductos(productos);
            ordenarPrecioBtn.textContent = ordenPrecioAscendente ? "Precio ⬆" : "Precio ⬇"; // Actualiza el texto del botón
        });

        // Función para actualizar el DOM con productos ordenados
        function actualizarProductos(productos) {
            productosContainer.innerHTML = ""; // Limpia el contenedor de productos
            productos.forEach(producto => {
                productosContainer.appendChild(producto); // Vuelve a agregar el producto ordenado
            });
        }

        // Evento de cerrar el popup de login
        if (cerrarPopup) {
            cerrarPopup.addEventListener("click", function() {
                popupLogin.style.display = "none";
            });
        }

        // Agregar producto al carrito
        botonesCarrito.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevenir el envío del formulario

                // Verificar si el usuario está logueado
                if (!{{ auth()->check() ? 'true' : 'false' }}) {
                    // Si no está logueado, mostrar el popup de login
                    popupLogin.style.display = "flex";
                } else {
                    // Si está logueado, agregar al carrito
                    const producto = this.closest('.producto');
                    const idProducto = producto.querySelector('input[name="producto_id"]').value;
                    const precio = parseFloat(producto.querySelector('input[name="precio"]').value);
                    const cantidad = parseInt(producto.querySelector('input[name="cantidad"]').value);

                    // Llamar a la función para agregar el producto al carrito
                    agregarProductoACarrito(idProducto, precio, cantidad);

                    // Actualizar el DOM del carrito
                    actualizarCarritoDOM();
                }
            });
        });

        // Función para agregar o actualizar el producto en el carrito (en cookies)
        function agregarProductoACarrito(idProducto, precio, cantidad) {
            let carrito = leerCookieCarrito() || [];
            let productoExistente = false;

            // Buscar si el producto ya existe en el carrito
            carrito.forEach(item => {
                if (item.idProducto == idProducto) {
                    item.cantidad += cantidad;
                    productoExistente = true;
                }
            });

            if (!productoExistente) {
                // Si el producto no existe, agregarlo
                carrito.push({
                    idProducto: idProducto,
                    precio: precio.toFixed(2),
                    cantidad: cantidad
                });
            }

            // Guardar el carrito actualizado en la cookie
            crearCookieCarrito(carrito);
        }

        // Función para crear la cookie con el carrito
        function crearCookieCarrito(carrito) {
            const carritoJSON = JSON.stringify(carrito);
            const fechaExpiracion = new Date();
            fechaExpiracion.setDate(fechaExpiracion.getDate() + 30);
            const expires = "expires=" + fechaExpiracion.toUTCString() + ";";

            document.cookie = "carrito=" + carritoJSON + ";" + expires + "path=/";
            console.log("Cookie actualizada:", document.cookie); // Mostrar la cookie actualizada
        }

        // Función para leer la cookie del carrito
        function leerCookieCarrito() {
            const nombreCookie = "carrito=";
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim();
                if (cookie.indexOf(nombreCookie) === 0) {
                    return JSON.parse(cookie.substring(nombreCookie.length, cookie.length));
                }
            }
            return null; // Si no existe la cookie
        }

        // Función para actualizar el DOM del carrito
        function actualizarCarritoDOM() {
            const carrito = leerCookieCarrito();
            const carritoContainer = document.getElementById("carritoContainer");

            if (carritoContainer) {
                carritoContainer.innerHTML = ""; // Limpiar el contenedor del carrito

                carrito.forEach(item => {
                    const productoElement = document.createElement("div");
                    productoElement.classList.add("carrito-item");
                    productoElement.innerHTML = `
                        <p>Producto ID: ${item.idProducto}</p>
                        <p>Precio: $${item.precio}</p>
                        <p>Cantidad: ${item.cantidad}</p>
                    `;
                    carritoContainer.appendChild(productoElement);
                });
            }
        }

        // Verificar que la cookie del carrito se creó correctamente
        const carritoLeido = leerCookieCarrito();
        console.log("Contenido de la cookie 'carrito':", carritoLeido);

        // Inicializar el DOM del carrito al cargar la página
        actualizarCarritoDOM();
    });
</script>

</html>