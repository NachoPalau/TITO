<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/prueba.css') }}">

</head>
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
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const usuarioAutenticado = document.body.dataset.usuario === 'true';
        const estrellas = document.querySelectorAll("#estrella");
        const popupLogin = document.getElementById("popupLogin");
        const mostrarFavoritosBtn = document.getElementById('mostrarFavoritosBtn');
        const cerrarPopup = document.getElementById("cerrarPopup");
        const botonesCarrito = document.querySelectorAll(".agregar-carrito");

        cerrarPopup.addEventListener("click", function() {
            popupLogin.style.display = "none";
        });

        popupLogin.addEventListener("click", function(event) {
            if (event.target === popupLogin) {
                popupLogin.style.display = "none";
            }
        });
        estrellas.forEach(estrella => {
            estrella.addEventListener("click", function() {
                if (!usuarioAutenticado) {
                    popupLogin.style.display = "flex";
                    return;
                }
            });
        });

        botonesCarrito.forEach(boton => {
            boton.addEventListener("click", function() {
                if (!usuarioAutenticado) {
                    popupLogin.style.display = "flex";
                    return;
                }


                console.log("Producto agregado al carrito");
            });
        });
        let soloFavoritos = false;
        mostrarFavoritosBtn.addEventListener("click", function() {
            const recetas = document.querySelectorAll(".receta");
            let recetasFavoritas = [];


            if (!soloFavoritos) {
                recetas.forEach(receta => {
                    const estrella = receta.querySelector("#estrella");
                    if (estrella && estrella.src.includes('estrella.svg')) {
                        recetasFavoritas.push(receta);
                    }
                });


                recetas.forEach(receta => {
                    if (!recetasFavoritas.includes(receta)) {
                        receta.style.display = "none";
                    }
                });


                soloFavoritos = true;
            } else {

                recetas.forEach(receta => {
                    receta.style.display = "block";
                });


                soloFavoritos = false;
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        let carritoIcon = document.getElementById("carrito");
        let slideCarrito = document.getElementById("slideCarrito");
        let cerrarCarrito = document.getElementById("cerrarCarrito");
        let body = document.body;


        carritoIcon.addEventListener("click", function() {
            slideCarrito.classList.add("slide-abierto");
            body.classList.add("no-scroll");
        });


        cerrarCarrito.addEventListener("click", function() {
            slideCarrito.classList.remove("slide-abierto");
            body.classList.remove("no-scroll");
        });
    });

    function filtrarTotal() {
        let input = document.getElementById("busquedaTotal").value.toLowerCase();
        let productos = document.querySelectorAll(".producto");
        let recetas = document.querySelectorAll(".receta");

        productos.forEach(producto => {
            let nombre = producto.querySelector("strong").textContent.toLowerCase();
            if (nombre.includes(input)) {
                producto.style.display = "block";
            } else {
                producto.style.display = "none";
            }
        });

        recetas.forEach(receta => {
            let nombre = receta.querySelector("strong").textContent.toLowerCase();
            if (nombre.includes(input)) {
                receta.style.display = "block";
            } else {
                receta.style.display = "none";
            }
        });
    }

    function filtrarProductos() {
        let input = document.getElementById('busqueda').value.toLowerCase();
        let productos = document.getElementsByClassName('producto');

        for (let i = 0; i < productos.length; i++) {
            let nombre = productos[i].getElementsByTagName("strong")[0].innerText.toLowerCase();
            if (nombre.includes(input)) {
                productos[i].style.display = "block";
            } else {
                productos[i].style.display = "none";
            }
        }
    }

    function filtrarRecetas() {
        let input = document.getElementById('busquedaRecetas').value.toLowerCase();
        let recetas = document.getElementsByClassName('receta');

        for (let i = 0; i < recetas.length; i++) {
            let nombre = recetas[i].getElementsByTagName("strong")[0].innerText.toLowerCase();
            if (nombre.includes(input)) {
                recetas[i].style.display = "block";
            } else {
                recetas[i].style.display = "none";
            }
        }
    }

    function ordenarAscendente() {
        let contenedor = document.getElementById('productos');
        let productos = Array.from(contenedor.getElementsByClassName('producto'));

        productos.sort((a, b) => {
            let nombreA = a.getElementsByTagName("strong")[0].innerText.toLowerCase();
            let nombreB = b.getElementsByTagName("strong")[0].innerText.toLowerCase();
            return nombreA.localeCompare(nombreB);
        });

        contenedor.innerHTML = "";
        productos.forEach(producto => contenedor.appendChild(producto));
    }

    function ordenarDescendente() {
        let contenedor = document.getElementById('productos');
        let productos = Array.from(contenedor.getElementsByClassName('producto'));

        productos.sort((a, b) => {
            let nombreA = a.getElementsByTagName("strong")[0].innerText.toLowerCase();
            let nombreB = b.getElementsByTagName("strong")[0].innerText.toLowerCase();
            return nombreB.localeCompare(nombreA);
        });

        contenedor.innerHTML = "";
        productos.forEach(producto => contenedor.appendChild(producto));
    }

    function ordenarPrecioAscendente() {
        let contenedor = document.getElementById('productos');
        let productos = Array.from(contenedor.getElementsByClassName('producto'));

        productos.sort((a, b) => {
            let precioA = parseFloat(a.innerText.match(/\d+(\.\d+)?/)[0]);
            let precioB = parseFloat(b.innerText.match(/\d+(\.\d+)?/)[0]);
            return precioA - precioB;
        });

        contenedor.innerHTML = "";
        productos.forEach(producto => contenedor.appendChild(producto));
    }

    function ordenarPrecioDescendente() {
        let contenedor = document.getElementById('productos');
        let productos = Array.from(contenedor.getElementsByClassName('producto'));

        productos.sort((a, b) => {
            let precioA = parseFloat(a.innerText.match(/\d+(\.\d+)?/)[0]);
            let precioB = parseFloat(b.innerText.match(/\d+(\.\d+)?/)[0]);
            return precioB - precioA;
        });

        contenedor.innerHTML = "";
        productos.forEach(producto => contenedor.appendChild(producto));
    }

    function ordenarAscendenteRecetas() {
        let recetasContainer = document.getElementById("recetas");
        let recetas = Array.from(document.querySelectorAll(".receta"));

        recetas.sort((a, b) => {
            let tituloA = a.querySelector("strong").textContent.toLowerCase();
            let tituloB = b.querySelector("strong").textContent.toLowerCase();
            return tituloA.localeCompare(tituloB);
        });

        recetas.forEach(receta => recetasContainer.appendChild(receta));
    }

    function ordenarDescendenteRecetas() {
        let recetasContainer = document.getElementById("recetas");
        let recetas = Array.from(document.querySelectorAll(".receta"));

        recetas.sort((a, b) => {
            let tituloA = a.querySelector("strong").textContent.toLowerCase();
            let tituloB = b.querySelector("strong").textContent.toLowerCase();
            return tituloB.localeCompare(tituloA);
        });

        recetas.forEach(receta => recetasContainer.appendChild(receta));
    }

    function ordenarRecetasPorGuardados() {
        let recetasContainer = document.getElementById("recetas");
        let recetas = Array.from(document.querySelectorAll(".receta"));

        if (recetas.length === 0) {
            console.warn("No se encontraron recetas para ordenar.");
            return;
        }

        recetas.forEach(receta => {
            console.log("Receta detectada:", receta.querySelector("strong").textContent, "Guardados:", receta.dataset.guardados);
        });

        recetas.sort((a, b) => {
            let guardadosA = parseInt(a.dataset.guardados) || 0;
            let guardadosB = parseInt(b.dataset.guardados) || 0;

            return guardadosB - guardadosA;
        });

        recetas.forEach(receta => recetasContainer.appendChild(receta));

        console.log("Ordenación completada.");
    }

    document.addEventListener("DOMContentLoaded", function() {
        let carritoIcon = document.getElementById("carrito");
        let slideCarrito = document.getElementById("slideCarrito");
        let cerrarCarrito = document.getElementById("cerrarCarrito");
        let body = document.body;


        carritoIcon.addEventListener("click", function() {
            slideCarrito.classList.add("slide-abierto");
            body.classList.add("no-scroll");
        });


        cerrarCarrito.addEventListener("click", function() {
            slideCarrito.classList.remove("slide-abierto");
            body.classList.remove("no-scroll");
        });
    });
</script>

<body data-usuario="{{ auth()->check() ? 'true' : 'false' }}">
    <img id="carrito" src="{{ asset('img/carrito/carritos.svg') }}">
    <div id="slideCarrito" class="slide-carrito">
        <img class="img-fluid" src="{{ asset('img/carrito/Close.png') }}" id="cerrarCarrito" alt="close" style="width: 50px; margin-top:10px; ">
        <h4 style="margin-left:15px; margin-top:10px;"><b>CARRITO</b></h4>
        @if(Auth::check())
    @php
        $carrito = json_decode(Auth::user()->carrito, true) ?? [];
        $total = 0;
    @endphp

    @if(empty($carrito))
        <p>Tu carrito está vacío.</p>
    @else
        <ul>
            @foreach($carrito as $productoId)
                @php
                    $producto = App\Models\Producto::find($productoId);
                    $total += $producto->precio;
                @endphp
                <li><img src="{{ asset('img/productos/' . $producto->imagen_url) }}" width="50">
                {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }}
                <button>-</button> 1 <button>+</button></li>
            @endforeach
        </ul>
        <p><strong>Total: ${{ number_format($total, 2) }}</strong></p>
    @endif
@endif
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center gap-3" style="padding-right:3%">
                <div class="usuario-container">
                    <div id="menuUsuario" class="menu-usuario">
                        @if(Auth::check())
                        <img id="iconoUsuario" class="img-fluid" src="{{ asset('img/img_Header/login.png') }}" alt="Login" style="width: 40px; height: 40px; cursor: pointer;">
                        <p>{{ Auth::user()->email }}
                        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}">
                            <img class="img-fluid" src="{{ asset('img/img_Header/login.png') }}" alt="Login" style="width: 40px; height: 40px;">
                        </a>
                        @endif
                    </div>
                </div>
            </div>
    <div id="popupLogin" class="popup">
        <div class="popup-contenido">
            <span id="cerrarPopup" class="popup-cerrar">✖</span>
            <h2>¡Debes iniciar sesión para guardar esta receta!</h2>
            <p>Para poder guardar esta receta, primero necesitas iniciar sesión en tu cuenta.</p>
            <button onclick="window.location.href='/login'">Iniciar sesión</button>
        </div>
    </div>

    <input type="text" id="busquedaTotal" placeholder="Buscar..." onkeyup="filtrarTotal()">
    <h1>Listado de productos</h1>
    <input type="text" id="busqueda" placeholder="Buscar productos..." onkeyup="filtrarProductos()">
    <button onclick="ordenarAscendente()">Ordenar A-Z</button>
    <button onclick="ordenarDescendente()">Ordenar Z-A</button>
    <button onclick="ordenarPrecioAscendente()">Ordenar Precio ↑</button>
    <button onclick="ordenarPrecioDescendente()">Ordenar Precio ↓</button>
    <div id="productos">
    @foreach($productos as $producto)
    <div class="producto">
        <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
        <strong>{{ $producto->nombre }}</strong>
        <p>Descripción: {{ $producto->descripcion }}</p>
        <p>Precio: ${{ number_format($producto->precio, 2) }}</p>

        <form action="{{ route('agregar.al.carrito') }}" method="POST">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <button type="submit">Añadir al carrito</button>
        </form>
    </div>
@endforeach
</div>

    <h1>Listado de recetas</h1>
    <input type="text" id="busquedaRecetas" placeholder="Buscar productos..." onkeyup="filtrarRecetas()">
    <button onclick="ordenarAscendenteRecetas()">Ordenar A-Z</button>
    <button onclick="ordenarDescendenteRecetas()">Ordenar Z-A</button>
    <button onclick="ordenarRecetasPorGuardados()">Mas guardados</button>
    @if(auth()->check())
    <button id="mostrarFavoritosBtn">Mostrar Recetas Favoritas</button>
    @endif
    <div id="recetas">
        @foreach($recetas as $receta)
        <div class="receta" data-guardados="{{ $receta->guardados }}">
            <strong>{{ $receta->titulo }}</strong>
            @if(auth()->check())
            @if(in_array($receta->id, json_decode(auth()->user()->favoritas, true)))
            <img id="estrella" src="{{ asset('img/carrito/estrella.svg') }}" onclick="window.location.href='/eliminar-favorito/{{ $receta->id }}'">
            @else
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}" onclick="window.location.href='/guardar-favorito/{{ $receta->id }}'">
            @endif
            @else
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            @endif
            <p style="font-weight: bold; color:black">Descripcion:</p>
            <p>{{ $receta->descripcion }}</p>
            <p style="font-weight: bold; color:black">Ingredientes: </p>
            <p>{{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
            <p style="font-weight: bold; color:black">Creador: {{ $receta->usuario->name ?? 'Desconocido' }}</p>
            <button class="agregar-carrito">Añadir al carrito<img id="carrito" src="{{ asset('img/carrito/carrito.svg') }}"></button>
        </div>
        @endforeach
    </div>

</body>

</html>