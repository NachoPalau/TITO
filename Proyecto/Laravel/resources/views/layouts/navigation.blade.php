<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    @media (max-width: 768px) {
        .subnavbar { display: none !important; }
        .buscador-responsive { display: none !important; }
        .logo-mobile { justify-content: center !important; }
        .hamburguesa { display: flex !important; }
        .nav-original { padding-right: 0 !important; }
    }
    
    .hamburguesa { display: none; }
    .popup-menu { display: none; }
    .popup-menu.show { display: block; }
    .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.55)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important; }
</style>

<nav class="bg-white border-b border-gray-100 sticky-top">
    <header class="container-fluid bg-white border-bottom py-1 sticky-top">
        <div class="row align-items-center">
            <!-- Hamburguesa mobile -->
            <div class="col-4 hamburguesa d-md-none d-flex align-items-center">
                <button class="navbar-toggler border-0 p-0" type="button" 
                        data-bs-toggle="collapse" data-bs-target="#menuMobile">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Logo -->
            <div class="col-4 col-md-4 d-flex justify-content-md-start logo-mobile">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('img/img_Header/logo.png') }}" 
                         style="width: 100px; padding: 10px;">
                </a>
            </div>

            <!-- Buscador desktop -->
            <div class="col-md-4 d-none d-md-flex justify-content-center buscador-responsive">
                <input type="text" id="busquedaTotal" 
                     class="form-control w-100 rounded-0 custom-border" 
                     style="border: 1px solid #6B0200" 
                     placeholder="Buscar">
            </div>

            <!-- Login y carrito -->
            <div class="col-4 col-md-4 d-flex justify-content-end align-items-center gap-3 nav-original" style="padding-right:3%">
                <div class="usuario-container">
                    @if(Auth::check())
                        <div id="menuUsuario" class="menu-usuario">
                            <img id="iconoUsuario" class="img-fluid" 
                                 src="{{ asset('img/img_Header/login.png') }}" 
                                 alt="Login" 
                                 style="width: 40px; height: 40px; cursor: pointer;">

                            <div id="popupMenu" class="popup-menu">
                                <ul class="popup-menu__list">
                                    <li>
                                        <form id="recetasForm" method="GET" action="{{ route('recetas') }}">
                                            @csrf
                                            <button type="submit">Recetas favoritas</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form id="pedidosForm" method="GET" action="{{ route('pedidos') }}">
                                            @csrf
                                            <button type="submit">Mis pedidos</button>
                                        </form>
                                    </li>
                                    @if(auth()->user()->rol === 'admin')
                                    <li>
                                        <form id="EditarProductos" method="POST" action="{{ route('editProducto') }}">
                                            @csrf
                                            <button type="submit">Editar Productos</button>
                                        </form>
                                    </li>
                                    @endif
                                    <li>
                                        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit">Cerrar sesión</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}">
                            <img class="img-fluid" 
                                 src="{{ asset('img/img_Header/login.png') }}" 
                                 alt="Login" 
                                 style="width: 40px; height: 40px;">
                        </a>
                    @endif
                </div>
                @include('carrito')
            </div>
        </div>
    </header>

    <!-- Menú móvil -->
    <div class="collapse" id="menuMobile">
        <div class="container-fluid bg-white py-2 border-top">
            <a href="{{ route('productos') }}" class="d-block py-2 ps-3 text-dark 
               {{ Route::currentRouteName() == 'productos' ? 'active' : '' }}" 
               style="{{ Route::currentRouteName() == 'productos' ? 'border-left: 3px solid #6B0200' : '' }}">
                PRODUCTOS
            </a>
            <a href="{{ route('recetas') }}" class="d-block py-2 ps-3 text-dark 
               {{ Route::currentRouteName() == 'recetas' ? 'active' : '' }}" 
               style="{{ Route::currentRouteName() == 'recetas' ? 'border-left: 3px solid #6B0200' : '' }}">
                RECETAS
            </a>
            <a href="{{ route('eventos') }}" class="d-block py-2 ps-3 text-dark 
               {{ Route::currentRouteName() == 'eventos' ? 'active' : '' }}" 
               style="{{ Route::currentRouteName() == 'eventos' ? 'border-left: 3px solid #6B0200' : '' }}">
                EVENTOS
            </a>
        </div>
    </div>
</nav>

<!-- Subnavbar original SOLO PARA DESKTOP -->
<nav class="container-fluid bg-light py-4 subnavbar d-none d-md-block">
    <div class="row justify-content-center">
        <div class="col-auto"><a href="{{ route('productos') }}" class="nav-link active" style="{{Route::currentRouteName() == 'productos' ? 'text-decoration: underline; text-decoration-color:#6B0200' : ''}}">PRODUCTOS</a></div>
        <div class="col-auto"><a href="{{route('recetas')}}" class="nav-link active " style="{{Route::currentRouteName() == 'recetas' ? 'text-decoration: underline; text-decoration-color:#6B0200' : ''}}">RECETAS</a></div>
        <div class="col-auto"><a href="{{route('eventos')}}" class="nav-link active" style="{{Route::currentRouteName() == 'eventos' ? 'text-decoration: underline; text-decoration-color:#6B0200' : ''}}">EVENTOS</a></div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    
document.addEventListener('DOMContentLoaded', function() {
    const menu = new bootstrap.Collapse('#menuMobile', {toggle: false});
    
    // Cerrar menú al cambiar tamaño
    window.addEventListener('resize', () => {
        if(window.innerWidth > 768) menu.hide();
    });
    
    // Cerrar menú al hacer click fuera
    document.addEventListener('click', (e) => {
        if(!e.target.closest('.hamburguesa') && !e.target.closest('#menuMobile')) {
            menu.hide();
        }
    });

    // Control menú usuario
    const iconoUsuario = document.getElementById('iconoUsuario');
    const popupMenu = document.getElementById('popupMenu');
    if(iconoUsuario && popupMenu) {
        iconoUsuario.addEventListener('click', (e) => {
            e.stopPropagation();
            popupMenu.classList.toggle('show');
        });
        
        document.addEventListener('click', (e) => {
            if(!popupMenu.contains(e.target) && !iconoUsuario.contains(e.target)) {
                popupMenu.classList.remove('show');
            }
        });
    }
});
</script>