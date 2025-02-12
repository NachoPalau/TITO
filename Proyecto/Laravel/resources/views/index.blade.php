<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TITO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('layouts.navigation')
    
    <section class="contenedor-imagen">
        <img src="{{ asset('img/img_eventos/sanValentin.jpg') }}" alt="Imagen principal" style="width: 100%; height:400px">
    <div class="container my-4">
        </section>

        <h2>Recetas Mas Guardadas</h2>
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
            <div id="popupLogin" class="popup" style="display: none;">
            <div class="popup-contenido">
                <span id="cerrarPopup" class="popup-cerrar">✖</span>
                <h2 id="popupTitulo">¡Debes iniciar sesión!</h2>
                <p id="popupMensaje">Para continuar, primero inicia sesión en tu cuenta.</p>
                <button onclick="window.location.href='/login'">Iniciar sesión</button>
            </div>
        </div>
    </div>
    @include('layouts.footer')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const popupLogin = document.getElementById("popupLogin");
            const cerrarPopup = document.getElementById("cerrarPopup");
            const popupTitulo = document.getElementById("popupTitulo");
            const popupMensaje = document.getElementById("popupMensaje");

            const usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};

            function mostrarPopup(titulo, mensaje) {
                popupTitulo.textContent = titulo;
                popupMensaje.textContent = mensaje;
                popupLogin.style.display = "flex";
            }

            document.getElementById("cerrarPopup").addEventListener("click", function() {
                popupLogin.style.display = "none";
            });

            document.querySelectorAll("img#estrella, .agregar-carrito").forEach(elemento => {
                elemento.addEventListener("click", function(event) {
                    if (!usuarioLogueado) {
                        event.preventDefault();
                        mostrarPopup("¡Debes iniciar sesión!", "Para realizar esta acción, primero inicia sesión.");
                    } else {
                        // Usuario logueado, continuar con la acción (estrella o carrito)
                        if (this.id === "estrella") {
                            // Lógica para la estrella (favoritos)
                            console.log("Estrella clicada (favoritos)"); // Reemplaza con tu lógica
                        } else if (this.classList.contains("agregar-carrito")) {
                            // Lógica para el carrito
                            console.log("Añadir al carrito"); // Reemplaza con tu lógica
                        }
                    }
                });
            });
        });
    </script>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>