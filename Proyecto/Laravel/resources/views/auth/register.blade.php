<style>
/* Estilo general del contenedor */
.form-container {
    font-family: sans-serif;
    border: 1px solid #6B0200;
    width: 350px;
    margin: 50px auto;
    margin-top: 0px;
    padding: 20px;
    text-align: center;
    border-radius: 0px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.4); /* Aplica sombra */
}
.footer {
    background-color: #6B0200;
    color: white;
    padding: 20px;
    bottom: 0;
    left: 0;
    text-align: center;
    
}
.logo-container {
    text-align: center;
    display: flex;
    justify-content: center;
}
/* Contenedor de cada input */
.input-container {
    position: relative;
    width: 85%;
    margin-bottom: 20px;
}

/* Estilo del input */
.input-container input {
    width: 100%;
    border: none;
    border-bottom: 2px solid #6B0200;
    border-radius: 0;
    outline: none;
    padding: 8px 5px;
    font-size: 16px;
    background: transparent;
}

/* Estilo de la etiqueta */
.input-container label {
    position: absolute;
    top: 10px;
    left: 5px;
    font-size: 14px;
    color:rgb(0, 0, 0);
    transition: 0.3s ease-in-out;
    font-weight: bold;
}

/* Mueve la etiqueta hacia arriba cuando el input está enfocado o tiene texto */
.input-container input:focus + label,
.input-container input:not(:placeholder-shown) + label {
    top: -10px;
    font-size: 12px;
    color:rgb(0, 0, 0);
}
</style>

<div class="logo-container">
    <a href="{{ route('index') }}"><img src="{{ asset('img/img_Header/logo.png') }}" style="width: 150px;"></a>
</div>

<div class="form-container">
    <h2 style="font-weight: bold; margin-bottom: 20px;">REGÍSTRATE</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="input-container">
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder=" ">
            <label for="name">Nombre</label>
        </div>

        <!-- Correo Electrónico -->
        <div class="input-container">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder=" ">
            <label for="email">Correo electrónico</label>
        </div>

        <!-- Contraseña -->
        <div class="input-container">
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder=" ">
            <label for="password">Contraseña</label>
        </div>

        <!-- Confirmar Contraseña -->
        <div class="input-container">
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder=" ">
            <label for="password_confirmation">Repetir Contraseña</label>
        </div>

        <!-- Teléfono -->
        <div class="input-container">
            <input id="phone" type="text" name="phone" required autocomplete="tel" placeholder=" ">
            <label for="phone">Teléfono</label>
        </div>

        <!-- Botón de Registro -->
        <button type="submit" style="background-color: #6B0200; color: white; border: none; padding: 12px; width: 100%; font-weight: bold; cursor: pointer;">
            CREAR CUENTA
        </button>
    </form>

  </div>  

    <!-- Footer -->
    <footer class="footer" style=" background-color: #6B0200;
            color: white;
            padding: 20px;
            width:100%
            text-align: center;">
        <a href="#" style="color: white; text-decoration: none; margin: 0 15px;">Cookies</a>
        <a href="#" style="color: white; text-decoration: none; margin: 0 15px;">Términos y condiciones</a>
        <a href="#" style="color: white; text-decoration: none; margin: 0 15px;">Contáctanos</a>
    </footer>


