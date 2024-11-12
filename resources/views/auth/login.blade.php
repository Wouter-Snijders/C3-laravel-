<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<x-guest-layout>
    <title>Login</title>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- E-mailadres -->
        <div class="input-field">
            <x-input-label for="email" :value="__('E-mailadres')" />
            <x-text-input id="email" class="input-background" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <!-- Wachtwoord -->
        <div class="mt-4 input-field">
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <x-text-input id="password" class="input-background" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <!-- Onthoud mij -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Onthoud mij') }}</span>
            </label>
        </div>



        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Wachtwoord vergeten?') }}
                </a>
            @endif

            <x-primary-button class="primary-button ms-3">
                {{ __('Inloggen') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
