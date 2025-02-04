<script>
    document.addEventListener("DOMContentLoaded", function() {
    let carritoIcon = document.getElementById("carrito");
    let slideCarrito = document.getElementById("slideCarrito");
    let cerrarCarrito = document.getElementById("cerrarCarrito");
    let body = document.body;


    carritoIcon.addEventListener("click", function() {
        slideCarrito.classList.add("slide-abierto");
        body.classList.add("no-scroll");
    });


    cerrarCarrito.addEventListener("click", function() {
        slideCarrito.classList.remove("slide-abierto");
        body.classList.remove("no-scroll");
    });
});
</script>
<img class="img-fluid" src="{{ asset('img/img_Header/carrito.png') }}" id="carrito" alt="Carrito" style="width: 40px; height: 40px; ">
<div id="slideCarrito" class="slide-carrito">
        <img class="img-fluid" src="{{ asset('img/carrito/Close.png') }}" id="cerrarCarrito" alt="close" style="width: 50px; ">
        <h4>CARRITO</h4>
        <div id="contenidoCarrito">
            <p>Tu carrito está vacío</p>
        </div>
    </div>