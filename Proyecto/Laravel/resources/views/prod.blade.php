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
    const productosContainer = document.getElementById("productos"); // Contenedor de productos
    const productos = Array.from(productosContainer.querySelectorAll(".producto")); // Obtener array de productos
    const ordenarAZBtn = document.querySelector('.filtros .btn:first-child'); // Botón A-Z
    const ordenarPrecioBtn = document.querySelector('.filtros .btn:nth-child(2)'); // Botón Precio

    let ordenAscendente = true; // Variable para controlar el orden A-Z
    let ordenPrecioAscendente = true; // Variable para controlar el orden de precio

    function actualizarProductos(productos) {
        productos.forEach(producto => {
            productosContainer.appendChild(producto); // Reordenar los productos en el DOM
        });
    }

    ordenarAZBtn.addEventListener("click", function () {
        ordenAscendente = !ordenAscendente;

        productos.sort((a, b) => {
            const nombreA = a.querySelector("strong").textContent.toLowerCase();
            const nombreB = b.querySelector("strong").textContent.toLowerCase();
            return ordenAscendente ? nombreA.localeCompare(nombreB) : nombreB.localeCompare(nombreA);
        });

        actualizarProductos(productos);
        ordenarAZBtn.textContent = ordenAscendente ? "A-Z ⬆" : "Z-A ⬇"; // Actualizar texto del botón
    });

    ordenarPrecioBtn.addEventListener("click", function () {
        ordenPrecioAscendente = !ordenPrecioAscendente;

        productos.sort((a, b) => {
            const precioA = parseFloat(a.dataset.precio); // Obtener precio del dataset
            const precioB = parseFloat(b.dataset.precio);

            if (isNaN(precioA) || isNaN(precioB)) {
                return 0; // Manejar precios no válidos
            }

            return ordenPrecioAscendente ? precioA - precioB : precioB - precioA;
        });

        actualizarProductos(productos);
        ordenarPrecioBtn.textContent = ordenPrecioAscendente ? "Precio ⬆" : "Precio ⬇"; // Actualizar texto del botón
    });
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
    const carrito = @json($carrito); // Blade convierte el array PHP a JSON en JavaScript

// Función para crear la cookie
function crearCookieCarrito() {
  const carritoJSON = JSON.stringify(carrito);

  // Establecer fecha de expiración (30 días)
  const fechaExpiracion = new Date();
  fechaExpiracion.setDate(fechaExpiracion.getDate() + 30);
  const expires = "expires=" + fechaExpiracion.toUTCString() + ";";

  // Crear la cookie
  document.cookie = "carrito=" + carritoJSON + ";" + expires + "path=/";
  console.log("Cookie 'carrito' creada.");
}

// Llamar a la función para crear la cookie
crearCookieCarrito();

// Para verificar que la cookie se creó correctamente
console.log(document.cookie);

// Para leer la cookie posteriormente:
function leerCookieCarrito() {
  const nombreCookie = "carrito=";
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    let cookie = cookies[i];
    while (cookie.charAt(0) === ' ') {
      cookie = cookie.substring(1);
    }
    if (cookie.indexOf(nombreCookie) === 0) {
      return JSON.parse(cookie.substring(nombreCookie.length, cookie.length));
    }
  }
  return null; // Si la cookie no existe
}

const carritoLeido = leerCookieCarrito();
console.log("Contenido de la cookie 'carrito':", carritoLeido);

</script>
</html>