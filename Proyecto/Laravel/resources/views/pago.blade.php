<link rel="stylesheet" href="{{asset('css/styles.css')}}">

<x-auth-session-status class="mb-4" :status="session('status')" />

    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
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
    </style>
    
@include('layouts.navigation')

<div style="height: 66vh; padding-top: 10vh;">
<div class="form-container">
<h2 class="form-title">REALIZAR PEDIDO</h2>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<br>

<form method="POST" action="{{ route('pago.process') }}" id="pago-form">
    @csrf

    <div class="input-group mb-3">
        <x-input-label for="amount" class="input-label" :value="__('Total a pagar:')" />
        <input type="hidden" name="amount" id="amount" class="form-control" step="0.1" min="0.50" required value="{{ $total }}">
        <span id="total-a-pagar" class="ms-auto text-end">{{ number_format($total, 2) }} €</span>
    </div>
    <div id="tarjeta"> </div>
    <br>

    <div class="flex items-center justify-end mt-4 mb-3" >
        <x-primary-button class="button-primary">
            {{ __('Pagar') }}
        </x-primary-button>
    </div>
</form>
</div>
</div>
<div style="position: relative;">
    @include('layouts.footer')
</div>



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