<div>
    {{-- ! wire:submit.prevent='funcionControlador' es una funcion de livewire que evita que un formulario se comporte tradicionalmente --}}
    {{-- ! Lo igualamos a una funcion, lo que esto hace es que al dar submit, se va a ejecutar la funcion a la que lo estamos igualando. --}}
    <form action="" class="md:w-1/2 space-y-5" wire:submit.prevent="editarVacante">
        <div>
            <x-input-label for="titulo" :value="__('Titulo vacante')" />
            {{-- ! para que se comuniquen los inputs con el componente de livewire, se debe agregar el atributo wire:model="titulo" --}}
            {{-- ! debemos cambiar el atributo name por wire:model --}}
            <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model='titulo' {{-- name="titulo" --}}
                :value="old('titulo')" placeholder="Titulo vacante" />
            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="salario" :value="__('Salario mensual')" />
            <select wire:model='salario' id="salario" class="block mt-1 w-full">
                <option value="">Selecciona un salario</option>
                @foreach ($salarios as $salario)
                    <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('salario')" class="mt-2" />
            {{-- ! Para crear un componente de livewire que maneje los errores, aunque el de breeze funciona mejor --}}
            {{-- @error('salario')
                <livewire:mostrar-alerta :message="$message" />
            @enderror --}}
        </div>

        <div>
            <x-input-label for="categoria" :value="__('Categoria')" />
            <select wire:model="categoria" id="categoria" class="block mt-1 w-full">
                <option value="">Selecciona una categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
            {{-- ! Manejo de errores de Laravel --}}
            {{-- @error('categoria')
                <span class="text-sm text-red-600 space-y-1">{{ $message }}</span>
            @enderror --}}
        </div>

        <div>
            <x-input-label for="empresa" :value="__('Empresa')" />
            <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')"
                placeholder="Ej. Netflix, Uber, Spotify" />
            <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="ultimo_dia" :value="__('Fecha limite para postular')" />
            <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia"
                :value="old('ultimo_dia')" />
            <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="descripcion" :value="__('Descripcion del puesto')" />
            <textarea id="descripcion" class="block mt-1 w-full" type="text" wire:model="descripcion"
                placeholder="Descripcion general del puesto, experiencia, actividades, etc."></textarea>
            <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="imagen" :value="__('Imagen')" />
            <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" />
            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
        </div>

        <div class="my-5 w-80">
            <img src="{{ asset('storage/vacantes/') . '/' .$imagen }}" alt="">
        </div>

        {{-- ! Colocar el preview de la imagen --}}
        @if ($imagen && $imagenValida)
            <p class="mt-2">Imagen:</p>
            <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen de la vacante" class="w-40 h-40 object-cover">
        @endif

        {{-- <button type="button" wire:click="eliminarImagen" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-2">
            Eliminar imagen
        </button> --}}

        <x-primary-button class="ms-4">
            {{ __('Guardar cambios') }}
        </x-primary-button>
    </form>
</div>
