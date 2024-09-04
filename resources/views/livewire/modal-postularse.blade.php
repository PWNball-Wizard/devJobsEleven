<div>
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-gray-800">Postulando a: {{ $vacante->titulo }}</h1>
            <form wire:submit.prevent="postularDispatch">
                <div class="mt-4">
                    <x-input-label for="curriculum" :value="__('Adjunta tu CV')" />
                    <x-text-input id="curriculum" class="block mt-1 w-full" type="file" wire:model="curriculum" />
                    <!-- Espacio adicional para errores -->
                    <div class="mt-4">
                        <x-input-error :messages="$errors->get('curriculum')" class="mt-2" />
                    </div>
                </div>
            </form>
            <div class="mt-6 flex justify-end"> <!-- Aumentar margen superior -->
                <button wire:click="$dispatch('ocultarModal')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded mr-2">Cancelar</button>
                <button wire:click="postularDispatch"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Postularse</button>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 bg-gray-800 opacity-50"></div>
</div>
