<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TITO - Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include('layouts.navigation')


<!-- MAIN CONTAINER -->
<div class="container">
    <h1>Recetas destacadas</h1>
    <!-- NOVEDADES -->
    <section class="novedades my-4">
        <div id="productosDes">
            @foreach($recetasMas as $receta)
            <div class="receta" data-id="{{ $receta->id }}" data-precio="{{ $receta->precio_total ?? 0 }}">
                <strong>{{ $receta->titulo }}</strong>
                <img id="estrella" data-id="{{ $receta->id }}" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
                <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
                <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
                <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
                <p class="precio-receta"><strong>Precio:</strong> {{ $receta->precio_total ?? 0 }}€</p>
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

    <!-- PRODUCTOS -->
    @if(auth()->check())
    <div class="flex items-center mt-4">
        <x-primary-button class="button-primary agregar-carrito" id="mostrarFavoritosBtn">
            {{ __('Mostrar Recetas Favoritas') }}
        </x-primary-button>
    </div>
    @endif

    <div id="recetas">
        @foreach($recetas as $receta)
        <div class="receta" data-id="{{ $receta->id }}" data-precio="{{ $receta->precio_total ?? 0 }}">
            <strong>{{ $receta->titulo }}</strong>
            <img id="estrella" data-id="{{ $receta->id }}" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
            <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
            <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
            <p class="precio-receta"><strong>Precio:</strong> {{ $receta->precio_total ?? 0 }}€</p>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="button-primary agregar-carrito">
                    {{ __('Añadir al carrito') }}
                    <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                </x-primary-button>
            </div>
        </div>
        @endforeach
    </div>
    <div id="popupLogin" class="popup" style="display: none;">
        <div class="popup-contenido">
            <span id="cerrarPopup" class="popup-cerrar">✖</span>
            <h2 id="popupTitulo">¡Debes iniciar sesión!</h2>
            <p id="popupMensaje">Para continuar, primero inicia sesión en tu cuenta.</p>
            <button onclick="window.location.href='/login'">Iniciar sesión</button>
        </div>
    </div>
</div>
<!-- FOOTER -->
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
      const ordenarAZBtn = document.querySelector('.filtros .btn:first-child'); // Botón A-Z
    let ordenAscendente = true; // Variable para controlar el orden

    ordenarAZBtn.addEventListener("click", function () {
        ordenAscendente = !ordenAscendente; // Cambiar el orden

        const recetas = Array.from(document.querySelectorAll("#recetas .receta")); // Convertir a array

        recetas.sort((a, b) => {
            const tituloA = a.querySelector("strong").textContent.toLowerCase();
            const tituloB = b.querySelector("strong").textContent.toLowerCase();
            return ordenAscendente ? tituloA.localeCompare(tituloB) : tituloB.localeCompare(tituloA);
        });

        const contenedorRecetas = document.getElementById("recetas");
        contenedorRecetas.innerHTML = ""; // Limpiar el contenedor

        recetas.forEach(receta => {
            contenedorRecetas.appendChild(receta); // Agregar las recetas ordenadas
        });

        // Cambiar el texto del botón
        ordenarAZBtn.textContent = ordenAscendente ? "A-Z ⬆" : "Z-A ⬇";
    });

    const ordenarPrecioBtn = document.querySelector('.filtros .btn:nth-child(2)'); // Botón de precio
    let ordenPrecioAscendente = true;

    ordenarPrecioBtn.addEventListener("click", function() {
        ordenPrecioAscendente = !ordenPrecioAscendente;

        const recetas = Array.from(document.querySelectorAll("#recetas .receta"));

        recetas.sort((a, b) => {
            const precioA = parseFloat(a.dataset.precio);
            const precioB = parseFloat(b.dataset.precio);

            if (isNaN(precioA) || isNaN(precioB)) {
                // Manejar casos donde el precio no es un número válido
                return 0; // O alguna otra lógica que consideres apropiada
            }

            return ordenPrecioAscendente ? precioA - precioB : precioB - precioA;
        });

        const contenedorRecetas = document.getElementById("recetas");
        contenedorRecetas.innerHTML = "";

        recetas.forEach(receta => {
            contenedorRecetas.appendChild(receta);
        });

        ordenarPrecioBtn.textContent = ordenPrecioAscendente ? "Precio ⬆" : "Precio ⬇";
    });
document.addEventListener("DOMContentLoaded", function () {
    const popupLogin = document.getElementById("popupLogin");
    const cerrarPopup = document.getElementById("cerrarPopup");
    const popupTitulo = document.getElementById("popupTitulo");
    const popupMensaje = document.getElementById("popupMensaje");

    const usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};
    const favoritasBackend = @json(json_decode($favoritas)); // Convertir a array de JS

    console.log("Favoritas desde la base de datos:", favoritasBackend);

    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? JSON.parse(decodeURIComponent(match[2])) : [];
    }

    function setCookie(name, value, days) {
        let d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + encodeURIComponent(JSON.stringify(value)) + ";" + expires + ";path=/";
    }

    if (usuarioLogueado) {
        setCookie('favoritos', favoritasBackend, 7);
        actualizarEstrellas();
    } else {
        // Si el usuario no está logueado, vaciar la cookie
        setCookie('favoritos', [], 7);
        actualizarEstrellas();
    }

    let favoritos = getCookie('favoritos');
    if (!Array.isArray(favoritos)) {
        favoritos = [];
    }

    if (!favoritos.length) {
        setCookie('favoritos', favoritasBackend, 7);
        favoritos = favoritasBackend;
    }

    console.log("Favoritos desde la cookie:", favoritos);

    function actualizarEstrellas() {
        let favoritos = getCookie('favoritos') || [];

        document.querySelectorAll("img[id='estrella']").forEach(estrella => {
            const recetaId = parseInt(estrella.dataset.id);
            if (favoritos.includes(recetaId)) {
                estrella.src = "{{ asset('img/carrito/estrella.svg') }}";
            } else {
                estrella.src = "{{ asset('img/carrito/estrellaVacia.svg') }}";
            }
        });
    }

    function toggleFavorito(id) {
        let favoritos = getCookie('favoritos') || [];

        if (!Array.isArray(favoritos)) {
            favoritos = [];
        }

        if (favoritos.includes(id)) {
            favoritos = favoritos.filter(favorito => favorito !== id);
        } else {
            favoritos.push(id);
        }
        console.log("Favoritos actualizados:", favoritos);
        setCookie('favoritos', favoritos, 7);
        actualizarEstrellas();
    }

    actualizarEstrellas();

    document.querySelectorAll("img[id='estrella'], .button-primary.agregar-carrito").forEach(elemento => {
    elemento.addEventListener("click", function (event) {
        if (!usuarioLogueado) {
            event.preventDefault();
            mostrarPopup("¡Debes iniciar sesión!", "Para realizar esta acción, primero inicia sesión.");
        } else {
            if (this.id === 'estrella') {
                const recetaId = parseInt(this.dataset.id);
                toggleFavorito(recetaId);
            } else if (this.classList.contains('agregar-carrito')) {
                // Lógica para añadir al carrito
                console.log('Añadir al carrito');
            }
        }
    });
});

    function mostrarPopup(titulo, mensaje) {
        popupTitulo.textContent = titulo;
        popupMensaje.textContent = mensaje;
        popupLogin.style.display = "flex";
    }

    cerrarPopup.addEventListener("click", function () {
        popupLogin.style.display = "none";
    });

    // Código para mostrar favoritos
    const mostrarFavoritosBtn = document.getElementById("mostrarFavoritosBtn");
    let mostrandoFavoritos = false; // Variable para controlar el estado

    mostrarFavoritosBtn.addEventListener("click", function () {
        mostrandoFavoritos = !mostrandoFavoritos; // Cambiar el estado

        const recetas = document.querySelectorAll("#recetas .receta");
        recetas.forEach(receta => {
            const estrella = receta.querySelector("img[id='estrella']");
            if (estrella) { // Verifica si la estrella existe
                const recetaFavorita = estrella.src.includes("estrella.svg"); // Verifica si la estrella está marcada

                if (mostrandoFavoritos) {
                    receta.style.display = recetaFavorita ? "block" : "none";
                } else {
                    receta.style.display = "block"; // Mostrar todas las recetas
                }
            }
        });

        // Cambiar el texto del botón
        mostrarFavoritosBtn.textContent = mostrandoFavoritos ? "Mostrar Todas las Recetas" : "Mostrar Recetas Favoritas";
    });

    const ordenarAZBtn = document.querySelector('.filtros .btn:first-child'); // Botón A-Z
    let ordenAscendente = true; // Variable para controlar el orden

    ordenarAZBtn.addEventListener("click", function () {
        ordenAscendente = !ordenAscendente; // Cambiar el orden

        const recetas = Array.from(document.querySelectorAll("#recetas .receta")); // Convertir a array

        recetas.sort((a, b) => {
            const tituloA = a.querySelector("strong").textContent.toLowerCase();
            const tituloB = b.querySelector("strong").textContent.toLowerCase();
            return ordenAscendente ? tituloA.localeCompare(tituloB) : tituloB.localeCompare(tituloA);
        });

        const contenedorRecetas = document.getElementById("recetas");
        contenedorRecetas.innerHTML = ""; // Limpiar el contenedor

        recetas.forEach(receta => {
            contenedorRecetas.appendChild(receta); // Agregar las recetas ordenadas
        });

        // Cambiar el texto del botón
        ordenarAZBtn.textContent = ordenAscendente ? "A-Z ⬆" : "Z-A ⬇";
    });

    const ordenarPrecioBtn = document.querySelector('.filtros .btn:nth-child(2)'); // Botón de precio
    let ordenPrecioAscendente = true;

    ordenarPrecioBtn.addEventListener("click", function() {
        ordenPrecioAscendente = !ordenPrecioAscendente;

        const recetas = Array.from(document.querySelectorAll("#recetas .receta"));

        recetas.sort((a, b) => {
            const precioA = parseFloat(a.dataset.precio);
            const precioB = parseFloat(b.dataset.precio);

            if (isNaN(precioA) || isNaN(precioB)) {
                // Manejar casos donde el precio no es un número válido
                return 0; // O alguna otra lógica que consideres apropiada
            }

            return ordenPrecioAscendente ? precioA - precioB : precioB - precioA;
        });

        const contenedorRecetas = document.getElementById("recetas");
        contenedorRecetas.innerHTML = "";

        recetas.forEach(receta => {
            contenedorRecetas.appendChild(receta);
        });

        ordenarPrecioBtn.textContent = ordenPrecioAscendente ? "Precio ⬆" : "Precio ⬇";
    });

    document.addEventListener('visibilitychange', function (e) {
        if (document.visibilityState === 'hidden') {
            guardarFavoritos();
        }
    });

    function guardarFavoritos() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Obtener la cookie llamada 'favoritos'
        const favoritosCookie = document.cookie.split('; ').find(row => row.startsWith('favoritos='));

        // Verificar si la cookie existe
        if (favoritosCookie) {
            // Extraer el valor de la cookie y parsearlo como JSON
            try {
                const favoritos = JSON.parse(decodeURIComponent(favoritosCookie.split('=')[1]));

                if (!Array.isArray(favoritos)) {
                    throw new Error("La cookie de favoritos no es un array");
                }

                fetch('/guardar-favoritos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ favoritos: favoritos }) // Enviar los favoritos como JSON
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {throw new Error(err.message)}); // Lanza error si la respuesta no es ok
                    }
                    console.log('Favoritos guardados:', response);
                })
                .catch(error => {
                    console.error('Error al guardar favoritos:', error);
                    // Aquí puedes agregar código para manejar el error, por ejemplo, mostrar un mensaje al usuario.
                });

            } catch (error) {
                console.error("Error al parsear la cookie de favoritos:", error);
                // Manejar el error de parseo de la cookie
            }

        } else {
            console.log("No se encontró la cookie de favoritos.");
        }
    }
});
</script>

</html>