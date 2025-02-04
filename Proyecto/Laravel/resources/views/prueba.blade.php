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

        recetas.sort((a, b) => {
            let guardadosA = parseInt(a.querySelector("p:nth-of-type(6)").textContent.replace("Guardados: ", "")) || 0;
            let guardadosB = parseInt(b.querySelector("p:nth-of-type(6)").textContent.replace("Guardados: ", "")) || 0;

            if (guardadosA === guardadosB) {
                let tituloA = a.querySelector("strong").textContent.toLowerCase();
                let tituloB = b.querySelector("strong").textContent.toLowerCase();
                return tituloA.localeCompare(tituloB);
            }
            return guardadosB - guardadosA;
        });

        recetas.forEach(receta => recetasContainer.appendChild(receta));
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

<body>
    <img id="carrito" src="{{ asset('img/carritos.svg') }}">
    <div id="slideCarrito" class="slide-carrito">
        <button id="cerrarCarrito">✖</button>
        <h2>Carrito de Compras</h2>
        <div id="contenidoCarrito">
            <p>Tu carrito está vacío</p>
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
            <strong>{{ $producto->nombre }}</strong> {{ $producto->precio }} €
            <p>{{ $producto->descripcion }}</p>
            <button>Añadir al carrito<img id="carrito" src="{{ asset('img/carrito.svg') }}"></button>
        </div>
        @endforeach
    </div>

    <h1>Listado de recetas</h1>
    <input type="text" id="busquedaRecetas" placeholder="Buscar productos..." onkeyup="filtrarRecetas()">
    <button onclick="ordenarAscendenteRecetas()">Ordenar A-Z</button>
    <button onclick="ordenarDescendenteRecetas()">Ordenar Z-A</button>
    <button onclick="ordenarRecetasPorGuardados()">Mas guardados</button>
    <div id="recetas">
        @foreach($recetas as $receta)
        <div class="receta">
            <strong>{{ $receta->titulo }}</strong>
            <p style="font-weight: bold; color:black">Descripcion:</p>
            <p>{{ $receta->descripcion }}</p>
            <p style="font-weight: bold; color:black">Ingredientes: </p>
            <p>{{ $receta->ingredientes }}</p>
            <p style="font-weight: bold; color:black">Creador: {{ $receta->usuario->name ?? 'Desconocido' }}</p>
            <button>Añadir al carrito<img id="carrito" src="{{ asset('img/carrito.svg') }}"></button>
        </div>
        @endforeach
    </div>
</body>

</html>