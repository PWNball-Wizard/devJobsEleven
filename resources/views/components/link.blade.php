<div>
    {{-- ! {{ $attributes->merge([]) sirve para mezclar los atributos que se pasan al componente con los que se definen en el componente --}}
    {{-- ! por ejemplo si le pasamos un href al componente lin este se mezclara con los atributos que se definen en el componente de manera automatica --}}
    {{-- ! por lo que ya no es necesario declarar el atributo href en el el componente link --}}
    <a {{ $attributes->merge([]) }}
        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ $slot }}
    </a>
</div>
