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
                        Fecha limite: {{ $vacante->ultimo_dia->format('d/m/Y') }}
                    </p>

                    <p class="text-sm text-gray-600 font-bold">
                        Publicada por: {{ $vacante->user->name }}
                    </p>
                </div>
            </div>
        @empty
            <div class="p-6 bg-white border-b border-gray-200">
                <p class="text-gray-600">No hay vacantes disponibles</p>
            </div>
        @endforelse

        {{-- ! Para ver las postulaciones de el usuario autenticado --}}
        {{-- @foreach ($candidatos as $candidato)
            {{ $candidato }}
        @endforeach --}}
    </div>
</div>
