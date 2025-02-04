
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="col-4 d-flex justify-content-start" style=" text-align: center; width: 100%; justify-content: center;">
    <a href="{{ route('index') }}"><img src="{{ asset('img/img_Header/logo.png') }}" style="width: 150px;"></a>
    </div>

    <div style="border:1px solid #6B0200; width: 350px; margin: 50px auto; padding: 20px; text-align: center; border-radius: 0px;">
    <h2 style="font-weight: bold; margin-bottom: 20px;">INICIA SESIÓN</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="text-align: left;">
            <x-input-label for="email" :value="__('Email')" style="display: block; margin-bottom: 5px; font-weight: bold;"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                          style="border:none; border-bottom: 2px solid #6B0200; border-radius: 0; outline: none; width: 70%; padding: 10px; margin-bottom: 15px;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="text-align: left;">
            <x-input-label for="password" :value="__('Password')" style="display: block; margin-bottom: 5px; font-weight: bold;"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            style="border:none; border-bottom: 2px solid #6B0200; border-radius: 0; outline: none; width: 70%; padding: 10px; margin-bottom: 15px;" />
                            

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    </div>