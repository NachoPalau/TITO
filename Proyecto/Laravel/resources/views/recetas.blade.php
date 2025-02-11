    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TITO - Tienda</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="styles.css">
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
        <div class="receta"  data-id="{{ $receta->id }}" data-guardados="{{ $receta->guardados }}">
            <strong>{{ $receta->titulo }}</strong>
            @if(auth()->check())
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            @else
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
            @endif
            <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
            <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
            <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
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
            <div class="receta"  data-id="{{ $receta->id }}" data-guardados="{{ $receta->guardados }}">
                <strong>{{ $receta->titulo }}</strong>
                @if(auth()->check())
                <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
                @else
                <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
                @endif
                <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
                <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
                <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
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
    });
document.addEventListener("DOMContentLoaded", function () {
    const popupLogin = document.getElementById("popupLogin");
    const cerrarPopup = document.getElementById("cerrarPopup");
    const popupTitulo = document.getElementById("popupTitulo");
    const popupMensaje = document.getElementById("popupMensaje");

    const usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};
    const favoritasBackend = JSON.parse(@json($favoritas)); // Convertir a JS

    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? JSON.parse(match[2]) : null;
    }

    function setCookie(name, value, days) {
        let d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + JSON.stringify(value) + ";" + expires + ";path=/";
    }

    // Inicializar la cookie de favoritos si no existe
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

});



    </script>

    </html>
