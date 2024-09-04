<div>
    <div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @forelse ($candidatos as $candidato)
                    <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                        <div class="leading-10">
                            <a href="{{ route('vacantes.show', ['vacante' => $this->vacante]) }}"
                                class="text-xl font-bold">
                                {{ $candidato->user->name }}
                            </a>
                            <p class="text-sm text-gray-600 font-bold">
                                {{-- {{ $vacante->empresa }} --}}
                                {{ $candidato->user->email }}
                            </p>
                            <p class="text-sm text-gray-600 font-bold">
                                {{ $candidato->curriculum }}
                            </p>
                            <p class="text-sm text-gray-600 font-bold">
                                Postulado: {{ $candidato->created_at->diffForHumans() }}
                            </p>
                            <p class="text-sm text-gray-600 font-bold">
                                {{-- Postulado {{ $postulacion->created_at->diffForHumans() }} --}}
                            </p>
                        </div>

                        <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                            {{-- <a href="">
                                <x-primary-button class="bg-gray-500 hover:bg-gray-700 w-full text-center">
                                    Candidatos
                                </x-primary-button>
                            </a> --}}
                            {{--  --}}
                            <a href="{{-- {{ route('vacantes.edit', ['vacante' => $vacante->id]) }} --}}">
                                <x-primary-button class="bg-blue-500 hover:bg-blue-700 w-full text-center">
                                    Editar
                                </x-primary-button>
                            </a>

                            {{-- @if ($esVisible)
                                <livewire:modal-eliminar :vacante="$vacante" />
                            @endif --}}

                            <button {{-- wire:click="$dispatch('mostrarAlerta', {{ $vacante }})" --}} class="bg-red-500 hover:bg-red-700 w-full text-center">
                                Eliminar
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p class="text-gray-600">No has aplicado a ninguna vacante</p>
                    </div>
                @endforelse

                <div class="flex justify-center mt-5">
                    {{-- {{ $vacantes->links() }} --}}
                </div>
                {{-- @foreach ($vacantes as $vacante) --}}

                {{-- @endforeach --}}
            </div>
        </div>
    </div>
</div>
