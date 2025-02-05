<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <script src="https://js.stripe.com/v3/"></script>

</head>

<body>
    <h1>Pago</h1>
    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('pago.process') }}" method="post" id="pago-form">
        @csrf
        <label for="amount">Cantidad:</label>
        <input type="number" name="amount" id="amount" step="0.1" min="0.50" required>
        <div id="tarjeta">
            <!-- Aquí se montarán los elementos de la tarjeta -->
        </div>
        <button type="submit">Pagar</button>
    </form>

    <script>
        const stripe = Stripe("{{ config('services.stripe.public_key') }}");

        const elements = stripe.elements();

        // Crea un elemento de tipo tarjeta
        const card = elements.create('card');
        card.mount('#tarjeta'); // Monta el elemento dentro del div con id "tarjeta"

        // Maneja el evento de envío del formulario
        const form = document.getElementById('pago-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Crea un token de la tarjeta
            const {
                token,
                error
            } = await stripe.createToken(card);

            if (error) {
                // Muestra el error si ocurre
                alert(error.message);
            } else {
                // Añade el token como un input oculto al formulario
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'token');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Envía el formulario
                form.submit();
            }
        });
    </script>


</body>

</html>