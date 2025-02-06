<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
    let carritoIcon = document.getElementById("carrito");
    let slideCarrito = document.getElementById("slideCarrito");
    let cerrarCarrito = document.getElementById("cerrarCarrito");
    let overlay = document.getElementById("overlay");
    let body = document.body;

    carritoIcon.addEventListener("click", function() {
        slideCarrito.classList.add("slide-abierto");
        overlay.style.display = "block";
        body.classList.add("no-scroll");
    });

    cerrarCarrito.addEventListener("click", function() {
        slideCarrito.classList.remove("slide-abierto");
        overlay.style.display = "none";
        body.classList.remove("no-scroll");
    });

    overlay.addEventListener("click", function() {
        slideCarrito.classList.remove("slide-abierto");
        overlay.style.display = "none";
        body.classList.remove("no-scroll");
    });
});
</script>

<img class="img-fluid" src="{{ asset('img/img_Header/carrito.png') }}" id="carrito" alt="Carrito" style="width: 40px; height: 40px; ">
<div id="overlay"></div>
<div id="slideCarrito" class="slide-carrito">
        <img class="img-fluid" src="{{ asset('img/carrito/Close.png') }}" id="cerrarCarrito" alt="close" style="width: 50px; margin-top:10px; ">
        <h4 style="margin-left:15px; margin-top:10px;"><b>CARRITO</b></h4>
        @if(Auth::check())
    @php
        $carrito = json_decode(Auth::user()->carrito, true) ?? [];
    @endphp

    @if(empty($carrito))
        <p>Tu carrito está vacío.</p>
    @else
        <ul>
            @foreach($carrito as $productoId)
                @php
                    $producto = App\Models\Producto::find($productoId);
                @endphp
                <li>{{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }}</li>
            @endforeach
        </ul>
    @endif
@endif
    </div>