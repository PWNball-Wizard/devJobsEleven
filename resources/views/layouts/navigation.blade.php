<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('vacantes.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        {{-- ! Can es una directiva que nos permite verificar si el usuario actual tiene un permiso específico. --}}
                        {{-- ! se usa de la siguiente manera --}}
                        @can('viewAny', App\Models\Vacante::class)
                            <x-nav-link :href="route('vacantes.index')" :active="request()->routeIs('vacantes.index')">
                                {{ __('Mis vacantes') }}
                            </x-nav-link>

                            <x-nav-link :href="route('vacantes.create')" :active="request()->routeIs('vacantes.create')">
                                {{ __('Crear una vacante') }}
                            </x-nav-link>
                        @endcan
                        @can('viewAny', App\Models\Candidato::class)
                            <x-nav-link :href="route('candidatos.index')" :active="request()->routeIs('candidatos.index')">
                                {{ __('Vacantes') }}
                            </x-nav-link>

                            <x-nav-link :href="route('postulaciones.index')" :active="request()->routeIs('postulaciones.index')">
                                {{ __('Postulaciones') }}
                            </x-nav-link>
                        @endcan
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <x-nav-link :href="route('login')" :active="request()->routeIs('vacantes.index')">
                        {{ __('Iniciar sesión') }}
                    </x-nav-link>

                    <x-nav-link :href="route('register')" :active="request()->routeIs('vacantes.create')">
                        {{ __('Crear una cuenta') }}
                    </x-nav-link>
                @endguest
                @auth
                    @hasrole('Reclutador')
                        <div x-data="{ showNotification: false }" x-init="Echo.channel('notificaciones').listen('.Enviadas', (event) => {
                            showNotification = true;
                            setTimeout(() => {
                                showNotification = false;
                            }, 7000);
                        });" class="relative mr-6">
                            <!-- Icono de notificaciones -->
                            <div class="relative">
                                <a href="{{ route('notificaciones.index') }}">
                                    <button class="focus:outline-none">
                                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-5-5.917V5a3 3 0 00-6 0v.083A6.002 6.002 0 002 11v3.159c0 .538-.214 1.054-.595 1.436L0 17h15zM15 17a3 3 0 01-6 0M15 17H9m6 0H9">
                                            </path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- Indicador de notificaciones -->
                                <span
                                    class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </div>

                            <!-- Dialogo de notificación -->
                            <div x-show="showNotification"
                                class="absolute top-12 left-3 mt-0 w-64 bg-white border border-gray-300 rounded-lg shadow-lg z-50 p-4">
                                <a href="{{ route('notificaciones.index') }}">
                                    <p class="text-sm text-gray-800">Tienes una nueva notificación</p>
                                </a>
                            </div>
                        </div>

                        {{-- <div class="relative mr-6">
                            <!-- Icono de campana -->
                            <a href="{{ route('notificaciones.index') }}">
                                <button class="focus:outline-none">
                                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-5-5.917V5a3 3 0 00-6 0v.083A6.002 6.002 0 002 11v3.159c0 .538-.214 1.054-.595 1.436L0 17h15zM15 17a3 3 0 01-6 0M15 17H9m6 0H9">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                            <!-- Indicador de notificaciones -->
                            <span
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </div> --}}
                    @endhasrole

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">

                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('vacantes.index')">
                    {{ __('Iniciar sesión') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('vacantes.create')">
                    {{ __('Crear una cuenta') }}
                </x-responsive-nav-link>
            @endguest
            @auth
                @can('viewAny', App\Models\Vacante::class)
                    {{-- ! Lo que hace request() es un helper de Laravel que nos permite acceder a la información de la petición actual. --}}
                    {{-- ! routeIs() es un método que nos permite verificar si la ruta actual coincide con la ruta que le pasamos como argumento. --}}
                    {{-- ! active es una propiedad de html que nos permite saber si el enlace está activo. --}}
                    <x-responsive-nav-link :href="route('vacantes.index')" :active="request()->routeIs('vacantes.index')">
                        {{ __('Mis vacantes') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('vacantes.create')" :active="request()->routeIs('vacantes.create')">
                        {{ __('Crear vacante') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('notificaciones.index')">
                        {{ __('Notificaciones') }}
                    </x-responsive-nav-link>
                @endcan
                @can('viewAny', App\Models\Candidato::class)
                    <x-responsive-nav-link :href="route('candidatos.index')" :active="request()->routeIs('candidatos.index')">
                        {{ __('Vacantes') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('postulaciones.index')" :active="request()->routeIs('postulaciones.index')">
                        {{ __('Postulaciones') }}
                    </x-responsive-nav-link>
                @endcan
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
