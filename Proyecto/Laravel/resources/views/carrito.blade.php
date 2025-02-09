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
        <img src="{{ asset('img/carrito/Close.png') }}" id="cerrarCarrito" alt="close" class="img-fluid" style="width: 50px; margin-top:10px;">
        <h4 style="margin-left:15px; margin-top:10px;"><b>CARRITO</b></h4>

        @if(Auth::check())
        @php
        $carrito = json_decode(Auth::user()->carrito, true);
        @endphp
        @if (empty($carrito))
        <div id="sinContenidoCarrito">
            <img src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" class="img-fluid" style="width: 100px;">
            <strong>Tu carrito está vacío</strong>
        </div>
        @else
        <div id="contenidoCarrito">
            <ul>
                @foreach($carrito as $producto)
                @php
                $productoDetails = \App\Models\Producto::find($producto['idProducto']);
                @endphp
                <li class="producto-carrito">
                    <div class="producto-carrito-detalle">
                        <div class="producto-info">
                            <img src="{{ asset('img/productos/' . $productoDetails->imagen_url) }}" alt="{{ $productoDetails->nombre }}" class="producto-imagen">
                            <div class="producto-nombre">
                                <strong>{{ $productoDetails->nombre }}</strong><br>
                                <span class="producto-precio">${{ number_format($productoDetails->precio, 2) }}</span>
                            </div>
                        </div>
                        <div class="producto-cantidad">
                            <form action="{{ route('carrito.modificar') }}" method="POST" class="cantidad-form">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto['idProducto'] }}">
                                <div class="cantidad-controls">
                                    <button type="submit" name="cantidad" value="-1" class="cantidad-btn">-</button>
                                    <span class="cantidad">{{ $producto['cantidad'] }}</span>
                                    <button type="submit" name="cantidad" value="1" class="cantidad-btn">+</button>
                                </div>
                            </form>
                            <div class="producto-total">
                                <span class="total">Total: ${{ number_format($productoDetails->precio * $producto['cantidad'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <hr>
            <div style="text-align: right;">
                <strong>Total: ${{ number_format(array_sum(array_map(function($item) {
                    return $item['precio'] * $item['cantidad'];
                }, $carrito)), 2) }}</strong>
            </div>
        </div>
        @endif
        @else
        <div id="sinContenidoCarrito">
            <img src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" class="img-fluid" style="width: 100px;">
            <strong>Tu carrito está vacío</strong>
        </div>
        @endif
    </div>