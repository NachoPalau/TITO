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

    @include('layouts.subnavbar')
    
    <div class="container my-4">
      
        <section class=" bg-light text-center py-5">
        <img src=" ./img_eventos/eventoHindi.jpg" alt="" style="width: 100%">
        </section>

        <h2>Recetas Mas Guardadas</h2>
        <section class="novedades my-4">
        <div id="productosDes">
    @foreach($recetas as $receta)
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
</button>

    </div>
    @endforeach
</div>
        </section>
    </div>
    
    @include('layouts.footer')

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>