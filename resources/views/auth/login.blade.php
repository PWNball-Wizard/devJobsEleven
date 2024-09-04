<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Mantener sesión iniciada') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                {{-- ! Para pasar varios parametros a un componente se pueden pasar como un array asociativo --}}
                {{-- ! ademas si queremos pasar una variable que no se encuentre en el array asociativo podemos pasarla como un segundo parametro --}}
                {{-- ! ejemplo <x-link :href="route('password.request')" class="flex space-x-2 justify-center" :post="$post"> --}}
                <x-link :href="route('password.request')" class="flex space-x-2 justify-center">
                    ¿Olvidaste tu contraseña?
                </x-link>

                <x-link :href="route('register')" class="flex space-x-2 justify-center">
                    ¿No tienes una cuenta?
                </x-link>
            @endif
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
