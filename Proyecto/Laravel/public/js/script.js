    document.addEventListener('DOMContentLoaded', function () {
        const passwordField = document.getElementById('password');
        const passwordConfirmField = document.getElementById('password2');
        const errorElement = document.getElementById('password-error'); // El elemento de error

        // Agregar un evento 'input' a los campos de contraseña
        passwordField.addEventListener('input', validatePasswords);
        passwordConfirmField.addEventListener('input', validatePasswords);

        function validatePasswords() {
            if (passwordField.value !== passwordConfirmField.value) {
                // Mostrar mensaje de error si no coinciden
                errorElement.style.display = 'block';
            } else {
                // Ocultar mensaje de error si coinciden
                errorElement.style.display = 'none';
            }
        }
    });
    
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.src = "img/contraseña/ojo.png";
        } else {
            passwordInput.type = 'password';
            eyeIcon.src = "img/contraseña/cerrar-ojo.png";
        }
    });

    const togglePassword2 = document.getElementById('togglePassword2');
    const passwordInput2 = document.getElementById('password2');
    const eyeIcon2 = document.getElementById('eyeIcon2');

    togglePassword2.addEventListener('click', function () {
        if (passwordInput2.type === 'password') {
            passwordInput2.type = 'text';
            eyeIcon2.src = "img/contraseña/ojo.png";
        } else {
            passwordInput2.type = 'password';
            eyeIcon2.src = "img/contraseña/cerrar-ojo.png";
        }
    });