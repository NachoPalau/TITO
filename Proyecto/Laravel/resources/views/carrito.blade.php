<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
    let carritoIcon = document.getElementById("carrito");
    let slideCarrito = document.getElementById("slideCarrito");
    let cerrarCarrito = document.getElementById("cerrarCarrito");
    let overlay = document.getElementById("overlay");
    let body = document.body;

    let productos = []; // Modificar porque se cogera del usuario

    function actualizarCarrito() {
        let sinContenidoCarrito = document.getElementById("sinContenidoCarrito");
        let contenidoCarrito = document.getElementById("contenidoCarrito");

        if (productos.length === 0) {
            sinContenidoCarrito.style.display = "flex";
            contenidoCarrito.style.display = "none";
        } else {
            sinContenidoCarrito.style.display = "none";
            contenidoCarrito.style.display = "flex";
        }
    }

    actualizarCarrito();

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
        <div id="sinContenidoCarrito">
            <img class="img-fluid" src="{{ asset('img/carrito/Shopping Cart.png') }}" alt="carritoRojo" style="width: 100px; ">
            <strong>Tu carrito está vacío</strong>
        </div>
        <div id="contenidoCarrito">
            <p>Tu carrito tiene articulos</p>
        </div>

    </div>