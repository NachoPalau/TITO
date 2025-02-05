<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
<style>
    .form-control:focus {
        box-shadow: none;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    }
    .slide-carrito {
    position: fixed;
    top: 0;
    right: -400px; 
    width: 350px;
    height: 100vh;
    background: white;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    transition: right 0.3s ease-in-out;
    padding: 20px;
    overflow-y: auto;
    z-index: 1000;
}

#carrito {
    cursor: pointer;
}

#cerrarCarrito {
    padding: 5px 10px;
    cursor: pointer;
    position: absolute;
    top: 15px;
    right: 15px;
}

.slide-abierto {
    right: 0 !important;
}

.no-scroll {
    overflow: hidden;
}
</style>
<header class="container-fluid bg-white border-bottom py-1 sticky-top">
        <div class="row align-items-center">
            <!-- Columna del logo (izquierda) -->
            <div class="col-4 d-flex justify-content-start" style="padding-left:3%">
                <a href="{{ route('index') }}"><img src="{{ asset('img/img_Header/logo.png') }}" style="width: 100px; padding: 10px;"></a>
            </div>

            <!-- Columna del buscador (centrado) -->
            <div class="col-4 d-flex justify-content-center" >
                <input type="text" class="form-control w-100 rounded-0 custom-border" style="border: none; border:1px solid #6B0200" placeholder="Buscar">
            </div>

            <!-- Columna del login y carrito (derecha) -->
            <div class="col-4 d-flex justify-content-end align-items-center gap-3" style="padding-right:3%">
                <a href="{{ route('login') }}"><img class="img-fluid" src="{{ asset('img/img_Header/login.png') }}" alt="Login" style="width: 40px; height: 40px;"></a>
                @include('carrito')
            </div>
        </div>
    </header>
