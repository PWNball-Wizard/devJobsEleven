<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notificaciones
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" id="notifications">
                    @forelse ($notificaciones as $notificacion)
                        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                            <div class="leading-10">
                                <a href="{{ route('vacantes.show', ['vacante' => $notificacion->data['id_vacante']]) }}"
                                    class="text-xl font-bold">
                                    {{ $notificacion->data['nombre_vacante'] }}
                                </a>
                                <p class="text-sm text-gray-600 font-bold">
                                    {{ $notificacion->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                                <a href="">
                                    <x-primary-button class="bg-gray-500 hover:bg-gray-700 w-full text-center">
                                        Mostrar candidatos
                                    </x-primary-button>
                                </a>
                            </div>
                            <div x-init="Echo.channel('notificaciones').listen('NotificacionEnviada', (e) => {
                                console.log(e);
                            })">

                            </div>
                        </div>
                    @empty
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p class="text-gray-600">No hay notificaciones</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
