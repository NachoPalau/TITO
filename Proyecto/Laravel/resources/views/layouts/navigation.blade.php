<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
<style>
    .form-control:focus {
        box-shadow: none;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    }
</style>
<header class="container-fluid bg-white border-bottom py-1 sticky-top">
        <div class="row align-items-center">
            <!-- Columna del logo (izquierda) -->
            <div class="col-4 d-flex justify-content-start" style="padding-left:3%">
                <a href="{{ route('index') }}"><img src="{{ asset('img/img_Header/logo.png') }}" style="width: 100px;"></a>
            </div>

            <!-- Columna del buscador (centrado) -->
            <div class="col-4 d-flex justify-content-center" >
                <input type="text" class="form-control w-100 rounded-0 custom-border" style="border: none; border:1px solid #6B0200" placeholder="Buscar">
            </div>

            <!-- Columna del login y carrito (derecha) -->
            <div class="col-4 d-flex justify-content-end align-items-center gap-3" style="padding-right:3%">
                <a href="{{ route('login') }}"><img class="img-fluid" src="{{ asset('img/img_Header/login.png') }}" alt="Login" style="width: 40px; height: 40px;"></a>
                <img class="img-fluid" src="{{ asset('img/img_Header/carrito.png') }}" alt="Carrito" style="width: 40px; height: 40px;">
            </div>
        </div>
    </header>
</nav>
