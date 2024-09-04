<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu contraseña?. Recupera tu cuenta ingresando el correo electrónico que ocupaste para registrarte. Te enviaremos un enlace para crear una nueva contraseña.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4 justify-between">
            <x-link :href="route('login')" class="flex space-x-2 justify-center">
                Quiero iniciar sesión
            </x-link>
            <x-primary-button>
                {{ __('Recuperar tu cuenta') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
