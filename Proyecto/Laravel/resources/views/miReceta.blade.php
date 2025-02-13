<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis recetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .container-center {
            height: 100vh; /* Ocupar toda la altura de la pantalla */
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container">
        @if($recetas->isEmpty())  
            <!-- Si el usuario no tiene recetas -->
            <div class="d-flex flex-column justify-content-center align-items-center text-center container-center">
                <div id="lottie-container" style="width: 300px; height: 300px;"></div>
                <p class="mt-3 fs-4 text-muted">No tienes recetas aún</p>

                <form action="{{ route('newReceta') }}" method="GET">
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="button-primary">
                            {{ __('Crear receta') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        @else  
        <h1 class="text-center mt-4">Mis Recetas</h1>
        <form action="{{ route('newReceta') }}" method="GET">
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="button-primary">
                            {{ __('Crear receta') }}
                        </x-primary-button>
                    </div>
                </form>
<div id="recetas">
    @foreach($recetas as $receta)
    <div class="receta" data-guardados="{{ $receta->guardados }}">
        <strong>{{ $receta->titulo }}</strong>

        <!-- Icono de Favoritos -->
        @if(auth()->check())
            <img id="estrella" src="{{ asset(in_array($receta->id, json_decode(auth()->user()->favoritas, true)) ? 'img/carrito/estrella.svg' : 'img/carrito/estrellaVacia.svg') }}" 
                 onclick="window.location.href='{{ in_array($receta->id, json_decode(auth()->user()->favoritas, true)) ? '/eliminar-favorito/' . $receta->id : '/guardar-favorito/' . $receta->id }}'">
        @else
            <img id="estrella" src="{{ asset('img/carrito/estrellaVacia.svg') }}">
        @endif

        <p><strong>Descripción:</strong> {{ $receta->descripcion }}</p>
        <p><strong>Ingredientes:</strong> {{ implode(', ', json_decode($receta->ingredientes, true)) }}</p>
        <p><strong>Creador:</strong> {{ $receta->usuario->name ?? 'Desconocido' }}</p>

        <!-- Botones de Editar y Eliminar -->
        <div class="actions">
            <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
            <button class="btn btn-danger btn-sm delete-button" data-id="{{ $receta->id }}">❌ Eliminar</button>

        </div>
    </div>
    @endforeach
</div>
      
    </div>
    
        @endif  
    </div>

    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('animations/recipe.json') }}"
        });
 
        document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            console.log("Botón de eliminación presionado para la receta con ID: " + id); // Añade un log aquí para verificar
            if (confirm("¿Estás seguro de que quieres eliminar esta receta?")) {
                fetch(`/recetas/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    }
                })
                .then(response => {
                    if (response.ok) {
                        console.log("Receta eliminada con éxito");
                        location.reload();  // Recargar la página si la eliminación fue exitosa
                    } else {
                        console.error("Error al eliminar la receta");
                        alert("Hubo un error al eliminar la receta.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error); // Esto nos ayudará a ver si hay un error en el fetch
                });
            }
        });
    });
});


    </script>
</body>
</html>
