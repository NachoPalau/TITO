<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/prueba.css') }}">
    <style>
        #productos,
        #recetas {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .producto,
        .receta {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }

        .cantidad-controls {
            display: inline-flex;
            align-items: center;
        }

        .cantidad-btn {
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            padding: 5px 10px;
            cursor: pointer;
        }

        .producto-carrito {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
            list-style: none;
        }

        .producto-carrito-detalle {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .producto-info {
            display: flex;
            align-items: center;
        }

        .producto-imagen {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            object-fit: cover;
        }

        .producto-nombre {
            font-weight: bold;
        }

        .producto-precio {
            color: #333;
        }

        .producto-cantidad {
            text-align: right;
        }

        .total {
            font-weight: bold;
        }

        #popupLogin {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-contenido {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
        }

        .popup-cerrar {
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .popup-contenido button {
            margin-top: 10px;
        }

        #slideCarrito {
            position: fixed;
            top: 0;
            right: -400px;
            width: 300px;
            height: 100%;
            background: white;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease;
        }

        #slideCarrito.slide-abierto {
            right: 0;
        }

        .no-scroll {
            overflow: hidden;
        }
    </style>
</head>

<body data-usuario="{{ auth()->check() ? 'true' : 'false' }}">
    <!-- Carrito -->
    <img src="{{ asset('img/img_Header/carrito.png') }}" id="carrito" alt="Carrito" class="img-fluid" style="width: 40px; height: 40px;">
    <div id="overlay"></div>
    <div id="slideCarrito" class="slide-carrito">
        <img src="{{ asset('img/carrito/Close.png') }}" id="cerrarCarrito" alt="close" class="img-fluid" style="width: 50px; margin-top:10px;">
        <h4 style="margin-left:15px; margin-top:10px;"><b>CARRITO</b></h4>

        @if(Auth::check())
        @php
        $carrito = json_decode(Auth::user()->carrito, true);
        @endphp
        @if (empty($carrito))
        <div id="sinContenidoCarrito">
            <img src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" class="img-fluid" style="width: 100px;">
            <strong>Tu carrito está vacío</strong>
        </div>
        @else
        <div id="contenidoCarrito">
            <ul>
                @foreach($carrito as $producto)
                @php
                $productoDetails = \App\Models\Producto::find($producto['idProducto']);
                @endphp
                <li class="producto-carrito">
                    <div class="producto-carrito-detalle">
                        <div class="producto-info">
                            <img src="{{ asset('img/productos/' . $productoDetails->imagen_url) }}" alt="{{ $productoDetails->nombre }}" class="producto-imagen">
                            <div class="producto-nombre">
                                <strong>{{ $productoDetails->nombre }}</strong><br>
                                <span class="producto-precio">${{ number_format($productoDetails->precio, 2) }}</span>
                            </div>
                        </div>
                        <div class="producto-cantidad">
                            <form action="{{ route('carrito.modificar') }}" method="POST" class="cantidad-form">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto['idProducto'] }}">
                                <div class="cantidad-controls">
                                    <button type="submit" name="cantidad" value="-1" class="cantidad-btn">-</button>
                                    <span class="cantidad">{{ $producto['cantidad'] }}</span>
                                    <button type="submit" name="cantidad" value="1" class="cantidad-btn">+</button>
                                </div>
                            </form>
                            <div class="producto-total">
                                <span class="total">Total: ${{ number_format($productoDetails->precio * $producto['cantidad'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <hr>
            <div style="text-align: right;">
                <strong>Total: ${{ number_format(array_sum(array_map(function($item) {
                    return $item['precio'] * $item['cantidad'];
                }, $carrito)), 2) }}</strong>
            </div>
        </div>
        @endif
        @else
        <div id="sinContenidoCarrito">
            <img src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" class="img-fluid" style="width: 100px;">
            <strong>Tu carrito está vacío</strong>
        </div>
        @endif
    </div>

    <!-- Popup de Login -->
    <div id="popupLogin" class="popup">
        <div class="popup-contenido">
            <span id="cerrarPopup" class="popup-cerrar">✖</span>
            <h2>¡Debes iniciar sesión para guardar esta receta!</h2>
            <p>Para poder guardar esta receta, primero necesitas iniciar sesión en tu cuenta.</p>
            <button onclick="window.location.href='/login'">Iniciar sesión</button>
        </div>
    </div>

    <!-- Buscadores y botones de ordenar -->
    <input type="text" id="busquedaTotal" placeholder="Buscar..." onkeyup="filtrarTotal()">
    <h1>Listado de productos</h1>
    <input type="text" id="busqueda" placeholder="Buscar productos..." onkeyup="filtrarProductos()">
    <button id="ordenarAscendente">Ordenar A-Z</button>
    <button id="ordenarDescendente">Ordenar Z-A</button>
    <button id="ordenarPrecioAscendente">Ordenar Precio ↑</button>
    <button id="ordenarPrecioDescendente">Ordenar Precio ↓</button>

    <div id="productos">
        @foreach($productos as $producto)
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
                <button type="submit" class="agregar-carrito">Añadir al carrito</button>
            </form>
        </div>
        @endforeach
    </div>

    <h1>Listado de recetas</h1>
    <input type="text" id="busquedaRecetas" placeholder="Buscar productos..." onkeyup="filtrarRecetas()">
    <button id="ordenarAscendenteRecetas">Ordenar A-Z</button>
    <button id="ordenarDescendenteRecetas">Ordenar Z-A</button>
    <button id="ordenarRecetasPorGuardados">Mas guardados</button>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Funciones de carrito, login y filtrado de productos y recetas
            const usuarioAutenticado = document.body.dataset.usuario === 'true';
            const popupLogin = document.getElementById("popupLogin");
            const cerrarPopup = document.getElementById("cerrarPopup");
            const mostrarFavoritosBtn = document.getElementById('mostrarFavoritosBtn');
            const botonesCarrito = document.querySelectorAll(".agregar-carrito");
            const estrellas = document.querySelectorAll("#estrella");
            const carritoIcon = document.getElementById("carrito");
            const slideCarrito = document.getElementById("slideCarrito");
            const cerrarCarrito = document.getElementById("cerrarCarrito");
            const body = document.body;

            // Mostrar y cerrar popup login
            cerrarPopup.addEventListener("click", function() {
                popupLogin.style.display = "none";
            });

            popupLogin.addEventListener("click", function(event) {
                if (event.target === popupLogin) {
                    popupLogin.style.display = "none";
                }
            });

            // Estrellas para favoritos
            estrellas.forEach(estrella => {
                estrella.addEventListener("click", function() {
                    if (!usuarioAutenticado) {
                        popupLogin.style.display = "flex";
                        return;
                    }
                });
            });

            // Botones del carrito
            botonesCarrito.forEach(boton => {
                boton.addEventListener("click", function() {
                    if (!usuarioAutenticado) {
                        popupLogin.style.display = "flex";
                        return;
                    }
                });
            });

            // Mostrar favoritos
            mostrarFavoritosBtn.addEventListener("click", function() {
                const recetas = document.querySelectorAll(".receta");
                let recetasFavoritas = [];

                recetas.forEach(receta => {
                    const estrella = receta.querySelector("#estrella");
                    if (estrella && estrella.src.includes('estrella.svg')) {
                        recetasFavoritas.push(receta);
                    }
                });

                recetas.forEach(receta => {
                    receta.style.display = recetasFavoritas.includes(receta) ? 'block' : 'none';
                });
            });

            // Mostrar y ocultar carrito
            carritoIcon.addEventListener("click", function() {
                slideCarrito.classList.toggle("slide-abierto");
                body.classList.toggle("no-scroll");
            });

            cerrarCarrito.addEventListener("click", function() {
                slideCarrito.classList.remove("slide-abierto");
                body.classList.remove("no-scroll");
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const productosContenedor = document.getElementById("productos");
            const recetasContenedor = document.getElementById("recetas");

            // Funciones de ordenación para productos
            function ordenarAscendente() {
                const productos = Array.from(productosContenedor.children);
                productos.sort((a, b) => {
                    const nombreA = a.querySelector("strong").textContent.toLowerCase();
                    const nombreB = b.querySelector("strong").textContent.toLowerCase();
                    return nombreA.localeCompare(nombreB);
                });
                productosContenedor.innerHTML = '';
                productos.forEach(producto => productosContenedor.appendChild(producto));
            }

            function ordenarDescendente() {
                const productos = Array.from(productosContenedor.children);
                productos.sort((a, b) => {
                    const nombreA = a.querySelector("strong").textContent.toLowerCase();
                    const nombreB = b.querySelector("strong").textContent.toLowerCase();
                    return nombreB.localeCompare(nombreA);
                });
                productosContenedor.innerHTML = '';
                productos.forEach(producto => productosContenedor.appendChild(producto));
            }

            function ordenarPrecioAscendente() {
                const productos = Array.from(productosContenedor.children);
                productos.sort((a, b) => {
                    const precioA = parseFloat(a.querySelector(".producto-precio").textContent.replace('$', '').trim());
                    const precioB = parseFloat(b.querySelector(".producto-precio").textContent.replace('$', '').trim());
                    return precioA - precioB;
                });
                productosContenedor.innerHTML = '';
                productos.forEach(producto => productosContenedor.appendChild(producto));
            }

            function ordenarPrecioDescendente() {
                const productos = Array.from(productosContenedor.children);
                productos.sort((a, b) => {
                    const precioA = parseFloat(a.querySelector(".producto-precio").textContent.replace('$', '').trim());
                    const precioB = parseFloat(b.querySelector(".producto-precio").textContent.replace('$', '').trim());
                    return precioB - precioA;
                });
                productosContenedor.innerHTML = '';
                productos.forEach(producto => productosContenedor.appendChild(producto));
            }

            // Funciones de ordenación para recetas
            function ordenarAscendenteRecetas() {
                const recetas = Array.from(recetasContenedor.children);
                recetas.sort((a, b) => {
                    const tituloA = a.querySelector("strong").textContent.toLowerCase();
                    const tituloB = b.querySelector("strong").textContent.toLowerCase();
                    return tituloA.localeCompare(tituloB);
                });
                recetasContenedor.innerHTML = '';
                recetas.forEach(receta => recetasContenedor.appendChild(receta));
            }

            function ordenarDescendenteRecetas() {
                const recetas = Array.from(recetasContenedor.children);
                recetas.sort((a, b) => {
                    const tituloA = a.querySelector("strong").textContent.toLowerCase();
                    const tituloB = b.querySelector("strong").textContent.toLowerCase();
                    return tituloB.localeCompare(tituloA);
                });
                recetasContenedor.innerHTML = '';
                recetas.forEach(receta => recetasContenedor.appendChild(receta));
            }

            function ordenarRecetasPorGuardados() {
                const recetas = Array.from(recetasContenedor.children);
                recetas.sort((a, b) => {
                    const guardadosA = parseInt(a.dataset.guardados);
                    const guardadosB = parseInt(b.dataset.guardados);
                    return guardadosB - guardadosA;
                });
                recetasContenedor.innerHTML = '';
                recetas.forEach(receta => recetasContenedor.appendChild(receta));
            }

            // Asignar eventos a los botones
            document.getElementById('ordenarAscendente').addEventListener('click', ordenarAscendente);
            document.getElementById('ordenarDescendente').addEventListener('click', ordenarDescendente);
            document.getElementById('ordenarPrecioAscendente').addEventListener('click', ordenarPrecioAscendente);
            document.getElementById('ordenarPrecioDescendente').addEventListener('click', ordenarPrecioDescendente);

            document.getElementById('ordenarAscendenteRecetas').addEventListener('click', ordenarAscendenteRecetas);
            document.getElementById('ordenarDescendenteRecetas').addEventListener('click', ordenarDescendenteRecetas);
            document.getElementById('ordenarRecetasPorGuardados').addEventListener('click', ordenarRecetasPorGuardados);
        });
        document.addEventListener("DOMContentLoaded", function() {
        const productosContenedor = document.getElementById("productos");

        // Funciones de ordenación para productos
        function ordenarPrecioAscendente() {
            const productos = Array.from(productosContenedor.children);
            productos.sort((a, b) => {
                // Extraemos y convertimos el precio de los elementos
                const precioA = parseFloat(a.querySelector(".producto-precio").textContent.replace('Precio: $', '').trim());
                const precioB = parseFloat(b.querySelector(".producto-precio").textContent.replace('Precio: $', '').trim());
                return precioA - precioB;
            });
            productosContenedor.innerHTML = ''; // Vaciar el contenedor
            productos.forEach(producto => productosContenedor.appendChild(producto)); // Volver a agregar los productos ordenados
        }

        function ordenarPrecioDescendente() {
            const productos = Array.from(productosContenedor.children);
            productos.sort((a, b) => {
                // Extraemos y convertimos el precio de los elementos
                const precioA = parseFloat(a.querySelector(".producto-precio").textContent.replace('Precio: $', '').trim());
                const precioB = parseFloat(b.querySelector(".producto-precio").textContent.replace('Precio: $', '').trim());
                return precioB - precioA;
            });
            productosContenedor.innerHTML = ''; // Vaciar el contenedor
            productos.forEach(producto => productosContenedor.appendChild(producto)); // Volver a agregar los productos ordenados
        }

        // Asignar eventos a los botones
        document.getElementById('ordenarPrecioAscendente').addEventListener('click', ordenarPrecioAscendente);
        document.getElementById('ordenarPrecioDescendente').addEventListener('click', ordenarPrecioDescendente);
    });
    </script>
</body>

</html>