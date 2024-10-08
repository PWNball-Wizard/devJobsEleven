<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar vacante
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-2xl font-bold text-gray-900 p-6">Editar vacante: {{ $vacante->titulo }}</h1>
                <div class="p-6 text-gray-900">
                    <livewire:editar-vacante :vacante="$vacante" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
