<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="leading-10">
                    <a href="{{ route('vacantes.show', ['vacante' => $vacante]) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">
                        {{ $vacante->empresa }}
                    </p>
                    <p class="text-sm text-gray-600 font-bold">
                        {{ $vacante->ultimo_dia->format('d/m/Y') }}
                    </p>
                </div>

                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a href="{{ route('vacantes.candidatos.index', ['vacante' => $vacante]) }}">
                        <x-primary-button class="bg-gray-500 hover:bg-gray-700 w-full text-center">
                            Candidatos
                        </x-primary-button>
                    </a>
                    {{--  --}}
                    <a href="{{ route('vacantes.edit', ['vacante' => $vacante->id]) }}">
                        <x-primary-button class="bg-blue-500 hover:bg-blue-700 w-full text-center">
                            Editar
                        </x-primary-button>
                    </a>

                    {{-- @if ($esVisible)
                        <div class="fixed inset-0 z-50 flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h2 class="text-lg font-semibold mb-4">Confirmar eliminación</h2>
                                <p>¿Estás seguro de que deseas eliminar este elemento?</p>
                                <div class="mt-4 flex justify-end"> --}}
                    {{-- ! podemos usar: $set('showModal', false) --}}
                    {{-- ! o podemos llamar a una funcion que se llame cancelar y que oculte el modal  --}}
                    {{-- <button wire:click="ocultaModal"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded mr-2">Cancelar</button>
                                    <button wire:click="eliminarVacante({{ $vacante->id }})"
                                        class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Eliminar</button>
                                </div>
                            </div>
                        </div>
                        <div class="fixed inset-0 bg-gray-800 opacity-50"></div>
                    @endif --}}

                    @if ($esVisible)
                        <livewire:modal-eliminar :vacante="$vacante" />
                    @endif

                    <button wire:click="$dispatch('mostrarAlerta', {{ $vacante }})"
                        class="bg-red-500 hover:bg-red-700 w-full text-center">
                        Eliminar
                    </button>

                    {{-- <button wire:click="$dispatch('eliminarVacante', {{ $vacante }})"
                        class="bg-red-500 hover:bg-red-700 w-full text-center">
                        Eliminar
                    </button> --}}

                    {{-- ! $dispatch('eliminarVacante',{{ $vacante->id }}) --}}
                    {{-- <button wire:click="eliminarVacante({{ $vacante->id }})"
                        class="bg-red-500 hover:bg-red-700 w-full text-center">
                        Eliminar
                    </button> --}}
                    {{-- ! Emit es un método de Livewire que permite emitir eventos --}}
                    {{-- <a wire:click="$emit('prueba', {{ $vacante->id }})">
                        <x-primary-button class="bg-red-500 hover:bg-red-700 w-full text-center">
                            Eliminar
                        </x-primary-button>
                    </a> --}}
                </div>
            </div>
        @empty
            <div class="p-6 bg-white border-b border-gray-200">
                <p class="text-gray-600">No hay vacantes disponibles</p>
            </div>
        @endforelse

        <div class="flex justify-center mt-5">
            {{ $vacantes->links() }}
        </div>
        {{-- @foreach ($vacantes as $vacante) --}}

        {{-- @endforeach --}}

        {{-- <div x-init="Echo.channel('notificaciones').listen('Enviadas', (e) => {
            console.log(e);
            Livewire.dispatch('notificacionEnviada', {
                nombre_vacante: e.nombre_vacante
            })
        });">
        </div> --}}

        {{-- @forelse ($notificaciones as $notificacion)
            {{ $notificacion->data['nombre_vacante'] }}
        @empty
            <p>No hay notificaciones</p>
        @endforelse --}}
    </div>
    <div id="notification-container"></div>
</div>

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //! Livewire.on escucha eventos de Livewire y ejecuta una función
        Livewire.on('mostrarAlerta', (vacante) => {
            Swal.fire({
                title: '¿Quieres eliminar este registro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarVacante', {
                        vacante: vacante
                    })
                    Swal.fire(
                        'Eliminado',
                        'El registro ha sido eliminado',
                        'success'
                    )
                }
            })
        });
    </script>
@endpush
