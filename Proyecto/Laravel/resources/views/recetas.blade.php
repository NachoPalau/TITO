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

    @include('layouts.subnavbar')

        <!-- MAIN CONTAINER -->
        <div class="container">
            <h1>Recetas destacadas</h1>
            <!-- NOVEDADES -->
            <section class="novedades my-4">
            <div id="productosDes">
        @foreach($recetasMas as $receta)
        <div class="receta" data-id="{{ $receta->id }}" data-precio="{{ $receta->precio_total ?? 0 }}">
            <strong>{{ $receta->titulo }}</strong>
            @if(auth()->check())
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            @else
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            @endif
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
            <div class="flex items-center mt-4" >
                        <x-primary-button class="button-primary agregar-carrito" id="mostrarFavoritosBtn">
                            {{ __('Mostrar Recetas Favoritas') }}
                        </x-primary-button>
                    </div>
        @endif


        <div id="recetas">
            @foreach($recetas as $receta)
            <div class="receta" data-id="{{ $receta->id }}" data-precio="{{ $receta->precio_total ?? 0 }}">
                <strong>{{ $receta->titulo }}</strong>
                @if(auth()->check())
                <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
                @else
                <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
                @endif
                <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
                <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
                <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
                <p class="precio-receta"><strong>Precio:</strong> {{ $receta->precio_total ?? 0 }}€</p>
                <div class="flex items-center justify-end mt-4" >
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
        @include( 'layouts.footer')
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    <script>
   document.addEventListener("DOMContentLoaded", function () {
    // Lógica independiente del estado de usuario logueado
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

        const recetas = document.querySelectorAll("#recetas .receta");
        recetas.forEach(receta => {
            const nombre = receta.querySelector("strong").textContent.toLowerCase();
            receta.style.display = nombre.includes(valor) ? "block" : "none";
        });
    }

    // Lógica de usuario logueado o no
    const popupLogin = document.getElementById("popupLogin");
    const cerrarPopup = document.getElementById("cerrarPopup");
    const popupTitulo = document.getElementById("popupTitulo");
    const popupMensaje = document.getElementById("popupMensaje");

    const usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};
    const favoritasBackend = JSON.parse(@json($favoritas)); // Convertir a JS

    function mostrarPopup(titulo, mensaje) {
        popupTitulo.textContent = titulo;
        popupMensaje.textContent = mensaje;
        popupLogin.style.display = "flex";
    }

    if (usuarioLogueado) {
        // Lógica para el usuario logueado
        setCookie('favoritos', favoritasBackend, 7);
        actualizarEstrellas();
    } else {
        // Lógica para el usuario no logueado
        setCookie('favoritos', [], 7);
        actualizarEstrellas();

        document.querySelectorAll("img#estrella, .agregar-carrito").forEach(elemento => {
            elemento.addEventListener("click", function(event) {
                event.preventDefault();
                mostrarPopup("¡Debes iniciar sesión!", "Para realizar esta acción, primero inicia sesión.");
            });
        });
    }

    let favoritos = getCookie('favoritos');
    if (!favoritos) {
        setCookie('favoritos', favoritasBackend, 7);
        favoritos = favoritasBackend;
    }

    function actualizarEstrellas() {
        let favoritos = getCookie('favoritos') || [];

        document.querySelectorAll("img#estrella").forEach(estrella => {
            const recetaId = estrella.closest('.receta').dataset.id;
            if (favoritos.includes(parseInt(recetaId))) {
                estrella.src = "{{ asset('img/carrito/estrella.svg') }}";
            } else {
                estrella.src = "{{ asset('img/carrito/estrellaVacia.svg') }}";
            }
        });
    }

    function toggleFavorito(id) {
        let favoritos = getCookie('favoritos') || [];

        if (favoritos.includes(id)) {
            favoritos = favoritos.filter(favorito => favorito !== id);
        } else {
            favoritos.push(id);
        }
        console.log(favoritos);
        setCookie('favoritos', favoritos, 7);
        actualizarEstrellas();
    }

    actualizarEstrellas();

    document.querySelectorAll("img#estrella").forEach(estrella => {
        estrella.addEventListener("click", function (event) {
            if (!usuarioLogueado) {
                event.preventDefault();
                mostrarPopup("¡Debes iniciar sesión!", "Para guardar esta receta como favorita, primero inicia sesión.");
            } else {
                const recetaId = parseInt(this.closest('.receta').dataset.id);
                toggleFavorito(recetaId);
            }
        });
    });

    // Código para mostrar favoritos
    const mostrarFavoritosBtn = document.getElementById("mostrarFavoritosBtn");
    let mostrandoFavoritos = false; // Variable para controlar el estado

    mostrarFavoritosBtn.addEventListener("click", function () {
        mostrandoFavoritos = !mostrandoFavoritos; // Cambiar el estado

        const recetas = document.querySelectorAll("#recetas .receta");
        recetas.forEach(receta => {
            const estrella = receta.querySelector("img#estrella");
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

    // Aquí comienza la lógica para guardar los favoritos cuando el documento pierde foco
    document.addEventListener('visibilitychange', function (e) {
        if (document.visibilityState === 'hidden' && csrfToken) {
            guardarFavoritos(csrfToken);
        }
    });

    function guardarFavoritos(token) {
        const favoritosCookie = document.cookie.split('; ').find(row => row.startsWith('favoritos='));

        if (favoritosCookie) {
            try {
                const favoritos = JSON.parse(favoritosCookie.split('=')[1]);

                fetch('/guardar-favoritos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ favoritos: favoritos })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {throw new Error(err.message)});
                    }
                    console.log('Favoritos guardados:', response);
                })
                .catch(error => {
                    console.error('Error al guardar favoritos:', error);
                });
            } catch (error) {
                console.error("Error al parsear la cookie de favoritos:", error);
            }

        } else {
            console.log("No se encontró la cookie de favoritos.");
        }
    }
});
</script>

    </html>
