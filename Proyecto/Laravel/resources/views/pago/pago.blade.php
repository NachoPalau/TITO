<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 5%;
        }

        .card {
            width: 50%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .card {
                width: 90%;
            }
        }

        .button-pago {
            transition: none !important;
            background-color: #6B0200 !important;
            /* Color original de Bootstrap */
            color: white !important;
            border: none !important;
        }

        .button-pago:hover,
        .button-pago:focus {
            background-color: #6B0200 !important;
            /* Mantiene el color sin cambios */
            color: white !important;
            box-shadow: none !important;
            transform: none !important;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')
    @include('layouts.subnavbar')

    <div class="container">
        <h2 class="text-center mb-4">Realiza tu Pago</h2>
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('pago.process') }}" method="post" id="pago-form">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Cantidad:</label>
                    <input type="number" name="amount" id="amount" class="form-control" step="0.1" min="0.50" required>
                </div>
                <div class="mb-3" id="tarjeta"></div>
                <button type="submit" class="btn button-pago w-100">Pagar</button>
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        const stripe = Stripe("{{ config('services.stripe.public_key') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#tarjeta');

        document.getElementById('pago-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const {
                token,
                error
            } = await stripe.createToken(card);
            if (error) {
                alert(error.message);
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'token');
                hiddenInput.setAttribute('value', token.id);
                e.target.appendChild(hiddenInput);
                e.target.submit();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>