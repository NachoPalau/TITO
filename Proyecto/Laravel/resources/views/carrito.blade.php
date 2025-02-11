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
                <li class="producto-carrito container d-flex">
                    <div class="producto-carrito-detalle col-3">
                        <div class="producto-img">
                            <img src="{{ asset('img/productos/' . $productoDetails->imagen_url) }}" alt="{{ $productoDetails->nombre }}" class="producto-imagen">
                        </div>
                    </div>
                        <div class="producto-desc col-9">
                            <div class="row">
                                <div class="producto-nombre pe-3 d-flex">
                                    <div class="col-10">
                                        <strong>{{ $productoDetails->nombre }}</strong><br>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{asset('img/carrito/Empty Trash.png')}}" alt="trash" style="width: 20px; margin-bottom: 2px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col-6">
                                <form action="{{ route('carrito.modificar') }}" method="POST" class="cantidad-form">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto['idProducto'] }}">
                                <div class="cantidad-controls producto-cantidad">
                                    <button type="submit" name="cantidad" value="-1" class="cantidad-btn"><img src="{{asset('img/carrito/Subtract.png')}}" alt="-" style="width: 20px;  margin-bottom: 2px;"></button>
                                    <span class="cantidad">{{ $producto['cantidad'] }}</span>
                                    <button type="submit" name="cantidad" value="1" class="cantidad-btn"><img src="{{asset('img/carrito/Plus.png')}}" alt="+"  style="width: 20px; margin-bottom: 2px;"></button>
                                </div>
                                </form>
                                </div>
                            
                            <div class="producto-total col-6 text-end pe-3">
                                <span class="total">{{ number_format($productoDetails->precio * $producto['cantidad'], 2) }}€</span>
                            </div>
                            </div>
                            
                        </div>
                    
                </li>
                @endforeach
            </ul>
        </div>
        <hr>
            <div class="footer-carrito">
                <div style="text-align: right; font-size: 1.2rem;">
                    <strong>Total: {{ number_format(array_sum(array_map(function($item) {
                        return $item['precio'] * $item['cantidad'];
                    }, $carrito)), 2) }}€</strong>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="button-primary">
                        {{ __('TRAMITAR PEDIDO') }}
                    </x-primary-button>
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