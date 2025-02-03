<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/prueba.css') }}">
</head>
<style>
        #productos {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .producto {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
    </style>
<script>
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
</script>

<body>
    <h1>Listado de productos</h1>
    <input type="text" id="busqueda" placeholder="Buscar productos..." onkeyup="filtrarProductos()">
    <button onclick="ordenarProductos()">Ordenar A-Z/Z-A</button>
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
</body>

</html>