<link rel="stylesheet" href="{{asset('css/styles.css')}}">

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Logo -->
<div class="logo-container">
    <a href="{{ route('index') }}">
        <img src="{{ asset('img/img_Header/logo.png') }}" style="width: 150px;">
    </a>
</div>
<div class="form-container">
    <h2 class="form-title">¿CONTRASEÑA OLVIDADA?</h2>
    <p>No es problema, pon aquí tu correo y te enviaremos para que puedas cambiar la contraseña</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <x-text-input id="email" class="text-input" type="email" name="email" :value="old('email')" required autofocus/>
            <x-input-label for="email" class="input-label" :value="__('Correo electrónico')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button-primary">
                {{ __('RECUPERAR CONTRASEÑA') }}
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