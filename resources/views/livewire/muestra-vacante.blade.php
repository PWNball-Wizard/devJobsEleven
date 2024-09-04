<div>
    <div class="w-full h-full flex justify-center items-center bg-gray-100">
        <div class="w-full h-full p-6 bg-white shadow-md rounded-lg flex">
            <!-- Left Section: Content -->
            <div class="w-2/3 flex flex-col pr-6">
                <!-- Header Section -->
                <div class="flex items-center space-x-4 mb-4">
                    <!-- Logo -->
                    {{-- <div>
                        <img src="https://via.placeholder.com/40" alt="Company Logo" class="w-10 h-10 rounded-full">
                    </div> --}}
                    <!-- Job Title and Info -->
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800">{{ $vacante->titulo }}</h1>
                        {{-- ! diffForHumans() --}}
                        {{-- ! toFormattedDate() va a mostrar la fecha en formato 30 Jun 2021 --}}
                        <p class="text-sm text-gray-500">{{ $vacante->created_at->diffForhumans() }} • Fecha limite:
                            {{ $vacante->ultimo_dia->format('d/m/Y') }} • Solicitudes:
                            {{ $vacante->candidatos->count() }}</p>
                        {{-- ! Para las solicitudes podria crearse otra tabla en donde se guarde el user_id y el id de la vacante, y contar cuantas solicitudes tiene una vacante --}}
                    </div>
                </div>

                <!-- Tags -->
                <div class="flex items-center space-x-2 mb-4">
                    <span
                        class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $vacante->categoria->categoria }}</span>
                </div>

                <!-- Additional Info -->
                {{-- <div class="text-sm text-gray-700 mb-4">
                    <p>Información adicional 1</p>
                    <p>Información adicional 2</p>
                </div> --}}

                <!-- Link or Offer -->
                <div class="text-sm text-blue-500 underline mb-4">
                    <p>Publicado por: {{ $vacante->user->name }}</p>
                    <p>{{ $vacante->empresa }}</p>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-2 mb-6">
                    @guest
                        {{-- ! href="{{ auth()->user() ? "wire:click='muestraModal'" : route('login') }}" --}}
                        <a href="{{ route('login') }}">
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold">Postularse</button>
                        </a>
                    @endguest
                    @auth
                        @can('viewAny', App\Models\Candidato::class)
                            <button wire:click="mostrarModal"
                                class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold">Postularse</button>
                        @endcan

                        {{--! EJEMPLO DE USO DE SPATIE  --}}
                        {{-- @if (auth()->user()->hasRole('Reclutador'))
                            <p>Soy un reclutador, y tengo un rol en spatie</p>
                        @endif
                        @if (auth()->user()->hasRole('Candidato'))
                            <p>Soy un candidato, y tengo un rol en spatie</p>
                        @endif --}}
                    @endauth
                </div>

                @if ($esVisible)
                    <livewire:modal-postularse :vacante="$vacante" />
                @endif

                <!-- Job Description Placeholder -->
                <div class="text-sm text-gray-800 mb-4">
                    <p>Descripcion: </p>
                    <p>{{ $vacante->descripcion }}</p>
                </div>
            </div>

            <!-- Right Section: Image -->
            <div class="w-1/3 flex justify-center items-center bg-gray-100 rounded-lg">
                {{-- <span class="text-gray-500 text-sm">[Fotografía]</span> --}}
                <img src="{{ $vacante->imagen ? asset('storage/vacantes') . '/' . $vacante->imagen : 'https://static.vecteezy.com/system/resources/previews/005/723/771/non_2x/photo-album-icon-image-symbol-or-no-image-flat-design-on-a-white-background-vector.jpg' }}"
                    alt="Vacante" class="w-full h-full object-cover rounded-lg">
            </div>
        </div>
    </div>

</div>
