<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let carritoIcon = document.getElementById("carrito");
        let slideCarrito = document.getElementById("slideCarrito");
        let cerrarCarrito = document.getElementById("cerrarCarrito");
        let overlay = document.getElementById("overlay");
        let body = document.body;

        carritoIcon.addEventListener("click", function() {
            slideCarrito.classList.add("slide-abierto");
            overlay.style.display = "block";
            body.classList.add("no-scroll");
        });

        cerrarCarrito.addEventListener("click", function() {
            slideCarrito.classList.remove("slide-abierto");
            overlay.style.display = "none";
            body.classList.remove("no-scroll");
        });

        overlay.addEventListener("click", function() {
            slideCarrito.classList.remove("slide-abierto");
            overlay.style.display = "none";
            body.classList.remove("no-scroll");
        });

        // Leer la cookie del carrito y actualizar el DOM
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

        function crearCookieCarrito(carrito) {
            const carritoJSON = JSON.stringify(carrito);
            const fechaExpiracion = new Date();
            fechaExpiracion.setDate(fechaExpiracion.getDate() + 30);
            const expires = "expires=" + fechaExpiracion.toUTCString() + ";";

            document.cookie = "carrito=" + carritoJSON + ";" + expires + "path=/";
        }

        function actualizarCarritoDOM() {
            const carrito = leerCookieCarrito();

            const contenidoCarrito = document.getElementById("contenidoCarrito");
            const sinContenidoCarrito = document.getElementById("sinContenidoCarrito");

            if (carrito && carrito.length > 0) {
                sinContenidoCarrito.style.display = "none";
                contenidoCarrito.innerHTML = ""; // Limpiar el contenedor del carrito

                let total = 0;

                carrito.forEach(item => {
                    fetch(`/api/productos/${item.idProducto}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Producto no encontrado');
                            }
                            return response.json();
                        })
                        .then(productoDetails => {
                            const productoElement = document.createElement("li");
                            productoElement.classList.add("producto-carrito", "container", "d-flex");
                            productoElement.innerHTML = `
                                <div class="producto-carrito-detalle col-3">
                                    <div class="producto-img">
                                        <img src="{{ asset('img/productos/') }}/${productoDetails.imagen_url}" alt="${productoDetails.nombre}" class="producto-imagen">
                                    </div>
                                </div>
                                <div class="producto-desc col-9">
                                    <div class="row">
                                        <div class="producto-nombre pe-3 d-flex">
                                            <div class="col-10">
                                                <strong>${productoDetails.nombre}</strong><br>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{asset('img/carrito/Empty Trash.png')}}" alt="trash" class="trash-icon" data-id="${item.idProducto}" style="width: 20px; margin-bottom: 2px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col-6">
                                            <div class="cantidad-controls producto-cantidad">
                                                <button type="button" class="cantidad-btn" data-id="${item.idProducto}" data-action="decrease"><img src="{{asset('img/carrito/Subtract.png')}}" alt="-" style="width: 20px;  margin-bottom: 2px;"></button>
                                                <span class="cantidad">${item.cantidad}</span>
                                                <button type="button" class="cantidad-btn" data-id="${item.idProducto}" data-action="increase"><img src="{{asset('img/carrito/Plus.png')}}" alt="+"  style="width: 20px; margin-bottom: 2px;"></button>
                                            </div>
                                        </div>
                                        <div class="producto-total col-6 text-end pe-3">
                                            <span class="total">${(productoDetails.precio * item.cantidad).toFixed(2)}€</span>
                                        </div>
                                    </div>
                                </div>
                            `;
                            contenidoCarrito.appendChild(productoElement);
                            total += productoDetails.precio * item.cantidad;

                            // Actualizar el total del carrito
                            document.querySelector(".footer-carrito strong").textContent = `Total: ${total.toFixed(2)}€`;

                            // Agregar eventos a los botones de cantidad y papelera
                            productoElement.querySelectorAll('.cantidad-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const idProducto = this.getAttribute('data-id');
                                    const action = this.getAttribute('data-action');
                                    actualizarCantidadProducto(idProducto, action);
                                });
                            });

                            productoElement.querySelectorAll('.trash-icon').forEach(icon => {
                                icon.addEventListener('click', function() {
                                    const idProducto = this.getAttribute('data-id');
                                    eliminarProductoCarrito(idProducto);
                                });
                            });
                        })
                        .catch(error => {
                            console.error('Error al obtener el producto:', error);
                        });
                });
            } else {
                sinContenidoCarrito.style.display = "block";
            }
        }

        function actualizarCantidadProducto(idProducto, action) {
            let carrito = leerCookieCarrito();
            carrito = carrito.map(item => {
                if (item.idProducto == idProducto) {
                    if (action === 'increase') {
                        item.cantidad += 1;
                    } else if (action === 'decrease') {
                        item.cantidad -= 1;
                    }
                }
                return item;
            }).filter(item => item.cantidad > 0); // Eliminar productos con cantidad 0 o menor

            crearCookieCarrito(carrito);
            actualizarCarritoDOM();
        }

        function eliminarProductoCarrito(idProducto) {
            let carrito = leerCookieCarrito();
            carrito = carrito.filter(item => item.idProducto != idProducto);

            crearCookieCarrito(carrito);
            actualizarCarritoDOM();
        }

        // Inicializar el DOM del carrito al cargar la página
        actualizarCarritoDOM();

        // Agregar evento al botón "Tramitar Pedido"
        document.querySelector(".footer-carrito .button-primary").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe automáticamente

    const carrito = leerCookieCarrito();
    if (carrito && carrito.length > 0) {
        // Enviar el carrito al backend
        fetch('/guardar-carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ carrito: carrito })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                eliminarCookieCarrito(); 
                window.location.href = "{{ route('pago') }}";
            } else {
                alert('Error al guardar el carrito.');
            }
        })
        .catch(error => {
            console.error('Error al guardar el carrito:', error);
            alert('Error al guardar el carrito.');
        });
    } else {
        alert('El carrito está vacío.');
    }
});
fetch('/obtener-carrito')
    .then(response => response.json())
    .then(data => {
        if (data.carrito && data.carrito.length > 0) {
            crearCookieCarrito(data.carrito); // Actualizar la cookie
            actualizarCarritoDOM(); // Actualizar el DOM
        }
    })
    .catch(error => console.error('Error al obtener el carrito:', error));
function eliminarCookieCarrito() {
    document.cookie = "carrito=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
    });
</script>

<img class="img-fluid" src="{{ asset('img/img_Header/carrito.png') }}" id="carrito" alt="Carrito" style="width: 40px; height: 40px; ">
<div id="overlay"></div>
<div id="slideCarrito" class="slide-carrito">
    <img src="{{ asset('img/carrito/Close.png') }}" id="cerrarCarrito" alt="close" class="img-fluid" style="width: 50px; margin-top:10px;">
    <h4 style="margin-left:15px; margin-top:10px;"><b>CARRITO</b></h4>

    <div id="sinContenidoCarrito">
        <img src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" class="img-fluid" style="width: 100px;">
        <strong>Tu carrito está vacío</strong>
    </div>
    @auth
    <div id="contenidoCarrito">
        <ul>
            <!-- Los productos del carrito se agregarán aquí dinámicamente -->
        </ul>
    </div>

    <hr>
    <div class="footer-carrito">
        <div style="text-align: right; font-size: 1.2rem;">
            <strong>Total: 0.00€</strong>
        </div>
        <form method="GET" action="{{ route('pago') }}">
        @csrf
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button-primary">
                {{ __('TRAMITAR PEDIDO') }}
            </x-primary-button>
        </div>
        </form>
    </div>
    @else
    <div id="sinContenidoCarrito">
        <img src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" class="img-fluid" style="width: 100px;">
        <strong>Tu carrito está vacío</strong>
    </div>
    @endauth
</div>