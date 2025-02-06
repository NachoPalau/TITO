<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <header class="container-fluid bg-white border-bottom py-1 sticky-top">
        <div class="row align-items-center">
            <!-- Columna del logo (izquierda) -->
            <div class="col-4 d-flex justify-content-start" style="padding-left:3%">
                <a href="{{ route('index') }}"><img src="{{ asset('img/img_Header/logo.png') }}" style="width: 100px; padding: 10px;"></a>
            </div>

            <!-- Columna del buscador (centrado) -->
            <div class="col-4 d-flex justify-content-center">
                <input type="text" class="form-control w-100 rounded-0 custom-border" style="border: none; border:1px solid #6B0200" placeholder="Buscar">
            </div>

            <!-- Columna del login y carrito (derecha) -->
            <div class="col-4 d-flex justify-content-end align-items-center gap-3" style="padding-right:3%">
                <div class="usuario-container">
                    <!-- Si el usuario está autenticado, muestra el menú -->
                    @if(Auth::check())
                    <div id="menuUsuario" class="menu-usuario">
                        <!-- Ícono de usuario, al hacer clic despliega el menú -->
                        <img id="iconoUsuario" class="img-fluid" src="{{ asset('img/img_Header/login.png') }}" alt="Login" style="width: 40px; height: 40px; cursor: pointer;">

                        <!-- Menú desplegable -->
                        <div id="popupMenu" class="popup-menu">
                            <ul class="popup-menu__list">
                                <li>
                                    <form id="recetasForm" method="POST" action="{{ route('recetas') }}">
                                        @csrf
                                        <button type="submit">Recetas favoritas</button>
                                    </form>
                                </li>
                                <li>
                                    <form id="pedidosForm" method="POST" action="{{ route('pedidos') }}">
                                        @csrf
                                        <button type="submit">Mis pedidos</button>
                                    </form>
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
                    <!-- Si el usuario no está autenticado, muestra el ícono de login -->
                    <a href="{{ route('login') }}">
                        <img class="img-fluid" src="{{ asset('img/img_Header/login.png') }}" alt="Login" style="width: 40px; height: 40px;">
                    </a>
                    @endif
                </div>

                <!-- Aquí puedes incluir el componente del carrito -->
                @include('carrito')
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const iconoUsuario = document.getElementById('iconoUsuario');
            const popupMenu = document.getElementById('popupMenu');

            if (iconoUsuario && popupMenu) {
                // Mostrar u ocultar el menú al hacer clic en el ícono de usuario
                iconoUsuario.addEventListener('click', function (event) {
                    event.stopPropagation(); // Evita que el clic se propague
                    popupMenu.classList.toggle('show'); // Añadir/quitar la clase 'show' para mostrar/ocultar
                });

                // Ocultar el menú al hacer clic fuera de él
                document.addEventListener('click', function (event) {
                    if (!popupMenu.contains(event.target) && !iconoUsuario.contains(event.target)) {
                        popupMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</nav>
