<style>
/* Contenedor principal del formulario */
.form-container {
    font-family: sans-serif;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.4);
    border: 1px solid #6B0200;
    width: 350px;
    margin: 50px auto;
    margin-top: 4%;
    padding: 20px;
    text-align: center;
}

/* Logo centrado */
.logo-container {
    margin-top:20px;
    text-align: center;
    display: flex;
    justify-content: center;
}

/* Título */
.form-title {
    font-weight: bold;
    margin-bottom: 20px;
}

/* Contenedor de inputs */
.input-group {
    position: relative;
    margin-bottom: 20px;
    text-align: left;
}

/* Etiqueta flotante */
.input-label {
    position: absolute;
    top: 50%;
    left: 0%;
    transform: translateY(-50%);
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    color:rgb(15, 1, 1);
    pointer-events: none;
}

/* Levanta la etiqueta cuando el input está enfocado o tiene texto */
.text-input:focus + .input-label,
.text-input:not(:placeholder-shown) + .input-label {
    top: 0;
    font-size: 12px;
    color:rgb(2, 0, 0);
}

/* Estiliza los inputs */
.text-input {
    width: 85%;
    padding: 10px 15px;
    border: none;
    border-bottom: 2px solid #6B0200;
    outline: none;
    font-size: 16px;
}

/* Botón de inicio de sesión */
.button-primary {
    background-color: #6B0200;
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    font-weight: bold;
    cursor: pointer;
}

/* Botón de registro */
.button-secondary {
    display: block;
    text-align: center;
    background-color: white;
    color: black;
    border: 1px solid black;
    padding: 10px;
    width: 94%;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
    text-decoration: none;
}

/* Footer */
.footer {
    background-color: #6B0200;
    color: white;
    padding: 20px;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
}

.footer a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
}
</style>

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
            <x-text-input id="email" class="text-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder=" " />
            <x-input-label for="email" class="input-label" :value="__('Correo electrónico')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <x-text-input id="password" class="text-input" type="password" name="password" required autocomplete="current-password" placeholder=" " />
            <x-input-label for="password" class="input-label" :value="__('Contraseña')" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botón de inicio de sesión -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button-primary">
                {{ __('INICIAR SESIÓN') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Botón de registro -->
    <a href="{{ route('register') }}" class="button-secondary">
        REGÍSTRATE
    </a>

    <!-- Footer -->
    <footer class="footer">
        <a href="#">Cookies</a>
        <a href="#">Términos y condiciones</a>
        <a href="#">Contáctanos</a>
    </footer>
</div>
