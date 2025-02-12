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
        <!-- NOVEDADES -->
        <section class="novedades my-4">
        <div id="productosDes">
    @foreach($productosDestacados as $producto)
    <div class="producto">
        <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
        <strong>{{ $producto->nombre }}</strong>
        <p>Descripción: {{ $producto->descripcion }}</p>
        <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
        <form action="{{ route('carrito.agregar') }}" method="POST">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <input type="hidden" name="precio" value="{{ $producto->precio }}">
            <input type="hidden" name="cantidad" value="1">
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button-primary agregar-carrito">
                {{ __('Añadir al carrito') }}
                <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
            </x-primary-button>
        </div>
        </form>
    </div>
    @endforeach
</div>

        </section>

        <!-- FILTROS -->
        @include('components.filtrar')

        <!-- <button id="ordenarAscendente">Ordenar A-Z</button>
<button id="ordenarDescendente">Ordenar Z-A</button>
<button id="ordenarPrecioAscendente">Ordenar Precio ↑</button>
<button id="ordenarPrecioDescendente">Ordenar Precio ↓</button> -->

<div id="productos">
    @foreach($productos as $producto)
    <div class="producto" data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}">
        <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
        <strong>{{ $producto->nombre }}</strong>
        <p>Descripción: {{ $producto->descripcion }}</p>
        <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
        <form action="{{ route('carrito.agregar') }}" method="POST" onsubmit="mostrarPopup(event, '{{ $producto->nombre }}')">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <input type="hidden" name="precio" value="{{ $producto->precio }}">
            <input type="hidden" name="cantidad" value="1">
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="button-primary agregar-carrito">
                    {{ __('Añadir al carrito') }}
                    <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                </x-primary-button>
            </div>
        </form>
    </div>
    @endforeach
</div>

    </div>

    <!-- FOOTER -->
    @include( 'layouts.footer')

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
});
document.addEventListener("DOMContentLoaded", function () {
    // Obtén todos los botones de ordenación
    const ordenarAscendente = document.getElementById("ordenarAscendente");
    const ordenarDescendente = document.getElementById("ordenarDescendente");
    const ordenarPrecioAscendente = document.getElementById("ordenarPrecioAscendente");
    const ordenarPrecioDescendente = document.getElementById("ordenarPrecioDescendente");

    // Obtén los productos normales (no destacados)
    const productosContainer = document.getElementById("productos");
    const productos = Array.from(productosContainer.querySelectorAll(".producto"));

    // Ordenar A-Z
    ordenarAscendente.addEventListener("click", function () {
        productos.sort(function(a, b) {
            const nombreA = a.querySelector("strong").textContent.toLowerCase();
            const nombreB = b.querySelector("strong").textContent.toLowerCase();
            return nombreA.localeCompare(nombreB);
        });
        actualizarProductos();
    });

    // Ordenar Z-A
    ordenarDescendente.addEventListener("click", function () {
        productos.sort(function(a, b) {
            const nombreA = a.querySelector("strong").textContent.toLowerCase();
            const nombreB = b.querySelector("strong").textContent.toLowerCase();
            return nombreB.localeCompare(nombreA);
        });
        actualizarProductos();
    });

    // Ordenar por Precio Ascendente
    ordenarPrecioAscendente.addEventListener("click", function () {
        productos.sort(function(a, b) {
            const precioA = parseFloat(a.getAttribute("data-precio"));
            const precioB = parseFloat(b.getAttribute("data-precio"));
            return precioA - precioB;
        });
        actualizarProductos();
    });

    // Ordenar por Precio Descendente
    ordenarPrecioDescendente.addEventListener("click", function () {
        productos.sort(function(a, b) {
            const precioA = parseFloat(a.getAttribute("data-precio"));
            const precioB = parseFloat(b.getAttribute("data-precio"));
            return precioB - precioA;
        });
        actualizarProductos();
    });

    // Función para actualizar el orden de los productos
    function actualizarProductos() {
        productos.forEach(function(producto) {
            productosContainer.appendChild(producto);  // Reordenar los productos en el DOM
        });
    }
});
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