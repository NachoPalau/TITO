<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Logo -->
<div class="logo-container">
    <a href="{{ route('index') }}">
        <img src="{{ asset('img/img_Header/logo.png') }}" style="width: 150px;">
    </a>
</div>

<!-- Formulario -->
<div class="form-container">
    <h2 class="form-title">INICIA SESIÓN</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <x-text-input id="email" class="text-input" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder=" " />
            <x-input-label for="email" class="input-label" :value="__('Correo electrónico')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <x-text-input id="password" class="text-input" type="password" name="password" required
                autocomplete="current-password" placeholder=" " />
            <x-input-label for="password" class="input-label" :value="__('Contraseña')" />
            <img id="ojo" src="{{asset('img/contraseña/cerrar-ojo.png')}}" alt="" 
            style="cursor: pointer; width:20px; height: 20px;">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <script>
            // Obtenemos el input de la contraseña y el ícono del ojo
            const laContraseña = document.getElementById('password');
            const elOjo = document.getElementById('ojo');

            // Añadimos el evento para cambiar el tipo de input al hacer clic en el ojo
            elOjo.addEventListener('click', () => {
                if (laContraseña.type === 'password') {
                    laContraseña.type = 'text';  // Muestra la contraseña
                    elOjo.src = '{{asset("img/contraseña/ojo.png")}}';  // Cambia el ícono a ojo abierto
                } else {
                    laContraseña.type = 'password';  // Oculta la contraseña
                    elOjo.src = '{{asset('img/contraseña/cerrar-ojo.png')}}';  // Cambia el ícono a ojo cerrado
                }
            });
        </script>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button-primary">
                {{ __('INICIAR SESIÓN') }}
            </x-primary-button>
        </div>
    </form>

    <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="button-secondary">
                <a href="{{route('register')}}">REGÍSTRATE</a>
            </x-secondary-button>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <a href="#">Cookies</a>
        <a href="#">Términos y condiciones</a>
        <a href="#">Contáctanos</a>
    </footer>
</div>