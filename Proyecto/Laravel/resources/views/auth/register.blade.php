<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Logo -->
<div class="logo-container">
    <a href="{{ route('index') }}">
        <img src="{{ asset('img/img_Header/logo.png') }}" style="width: 150px;">
    </a>
</div>

<div class="form-container">
    <h2 class="form-title">REGÍSTRATE</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="input-group">
        <x-text-input id="nombre" class="text-input" type="text" name="name" required autofocus autocomplete="username" placeholder=" " />
        <x-input-label for="name" class="input-label" :value="__('Nombre')" />
        </div>

        <!-- Teléfono -->
        <div class="input-group">
        <x-text-input id="telefono" class="text-input" type="text" name="telefono" required autofocus autocomplete="telefono" placeholder=" " />
        <x-input-label for="telefono" class="input-label" :value="__('Teléfono')" />
        </div>

        <!-- Correo Electrónico -->
        <div class="input-group">
        <x-text-input id="email" class="text-input" type="email" name="email" required autofocus autocomplete="username" placeholder=" " />
        <x-input-label for="email" class="input-label" :value="__('Correo electrónico')" />
        </div>

        <!-- Contraseña -->
        <div class="input-group">
        <button type="button" id="togglePassword">
            <img src="{{asset('img/contraseña/cerrar-ojo.png')}}" alt="Ver contraseña" id="eyeIcon" style="width:20px;">
        </button> 
        <x-text-input id="password" class="text-input" type="password" name="password" required autofocus autocomplete="password" placeholder=" " />
        <x-input-label for="password" class="input-label" :value="__('Contraseña')" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="input-group">
        <button type="button" id="togglePassword2">
            <img src="{{asset('img/contraseña/cerrar-ojo.png')}}" alt="Ver contraseña" id="eyeIcon2" style="width:20px;">
        </button>
        <x-text-input id="password2" class="text-input" type="password" name="password_confirmation" required autofocus autocomplete="new-password" placeholder=" " />
        <x-input-label for="password_confirmation" class="input-label" :value="__('Repetir Contraseña')" />
        </div>

        <div id="password-error" style="color: red; display: none; font-weight: bold; margin-bottom: 10px;">
            Las contraseñas no coinciden.
        </div>

        @error('email')
            <div style="color: red; font-weight: bold; margin-bottom: 10px;">{{ $message }}</div>
        @enderror

        <!-- Botón de Registro -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button-primary">
                {{ __('CREAR CUENTA') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Footer -->
    <footer class="footer">
        <a href="#">Cookies</a>
        <a href="#">Términos y condiciones</a>
        <a href="#">Contáctanos</a>
    </footer>
</div>  

<script src="{{asset('js/script.js')}}"></script>