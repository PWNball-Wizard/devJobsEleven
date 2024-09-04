<div>
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Confirmar eliminación</h2>
            <p>¿Estás seguro de que deseas eliminar este elemento?</p>
            <div class="mt-4 flex justify-end">
                {{-- ! podemos usar: $set('showModal', false) --}}
                {{-- ! o podemos llamar a una funcion que se llame cancelar y que oculte el modal  --}}
                <button wire:click="$dispatch('ocultaModal')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded mr-2">Cancelar</button>
                {{-- ! eliminarVacante({{ $vacante->id }})  --}}
                {{-- ! llamamos al evento eliminarVacante en el componente de esta vista  --}}
                <button wire:click="eliminaVacante"
                    class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Eliminar</button>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 bg-gray-800 opacity-50"></div>
</div>
