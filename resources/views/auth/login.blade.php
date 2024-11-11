<x-guest-layout>
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

<style>
    .input-background {
        background-color: #4a5568; /* Darker background */
        color: white; /* White text */
    }

    .input-background::placeholder {
        color: #cbd5e0; /* Light gray placeholder text */
    }

    .input-background:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5); /* Blue outline on focus */
    }

    .input-field {
        margin-bottom: 1rem;
    }

    .input-error {
        color: #e53e3e; /* Red color for errors */
    }

    .forgot-password {
        margin-right: auto;
        color: #3182ce; /* Blue color */
        text-decoration: underline;
    }

    .forgot-password:hover {
        color: #2b6cb0; /* Darker blue on hover */
    }

    .primary-button {
        background-color: #3182ce; /* Blue background */
        color: white; /* White text */
        padding: 0.75rem 1.5rem; /* Larger padding */
        border-radius: 0.375rem; /* Rounded corners */
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions */
    }

    .primary-button:hover {
        background-color: #2b6cb0; /* Darker blue on hover */
        transform: translateY(-2px); /* Slight lift on hover */
    }

    .primary-button:active {
        background-color: #2c5282; /* Even darker blue on click */
        transform: translateY(0); /* Reset lift on click */
    }
</style>
