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



    <!-- MAIN CONTAINER -->
    <div class="container">

        <!-- NOVEDADES -->
        <section class="novedades my-4">
        <div id="productosDes">
    @foreach($recetasMas as $receta)
    <div class="receta" data-guardados="{{ $receta->guardados }}">
        <strong>{{ $receta->titulo }}</strong>
        @if(auth()->check())
        <img id="estrella" src="{{ asset(in_array($receta->id, json_decode(auth()->user()->favoritas, true)) ? 'img/carrito/estrella.svg' : 'img/carrito/estrellaVacia.svg') }}" 
             onclick="window.location.href='{{ in_array($receta->id, json_decode(auth()->user()->favoritas, true)) ? '/eliminar-favorito/' . $receta->id : '/guardar-favorito/' . $receta->id }}'">
        @else
        <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
        @endif
        <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
        <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
        <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>
                <div class="flex items-center justify-end mt-4" onclick="agregarAlCarrito({{ json_encode(json_decode($receta->ingredientes, true)) }})">
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
            <div class="flex items-center justify-end mt-4" onclick="agregarAlCarrito({{ json_encode(json_decode($receta->ingredientes, true)) }})">
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

    function mostrarPopup(titulo, mensaje) {
        console.log("Mostrando popup:", titulo, mensaje); 
        popupTitulo.textContent = titulo;
        popupMensaje.textContent = mensaje;
        popupLogin.style.display = "flex";
    }

    cerrarPopup.addEventListener("click", function () {
        popupLogin.style.display = "none";
    });

    // Verificar si el usuario está logueado (desde Blade)
    const usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};

    // Bloquear "Añadir al carrito" si no está logueado
    document.querySelectorAll(".agregar-carrito").forEach(button => {
        button.addEventListener("click", function (event) {
            if (!usuarioLogueado) {
                event.preventDefault();
                mostrarPopup("¡Debes iniciar sesión!", "Para añadir este producto al carrito, primero inicia sesión.");
            }
        });
    });

    // Bloquear "Guardar como favorito" si no está logueado
    document.querySelectorAll("img#estrella").forEach(estrella => {
        estrella.addEventListener("click", function (event) {
            if (!usuarioLogueado) {
                event.preventDefault();
                mostrarPopup("¡Debes iniciar sesión!", "Para guardar esta receta como favorita, primero inicia sesión.");
            }
        });
    });
});

</script>

</html>
