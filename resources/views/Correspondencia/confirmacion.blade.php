<x-app-layout>
    <x-slot name="header">
         <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Correspondencia registrada correctamente</h1>

        <p><strong>RUT:</strong> {{ $correspondencia->rut }}</p>
        <p><strong>Referencia:</strong> {{ $correspondencia->referencia }}</p>
        <p><strong>Remitente:</strong> {{ $correspondencia->remitente }}</p>
        <p><strong>Lugar de origen:</strong> {{ $correspondencia->unidad }}</p>
        <p><strong>Fecha de recepción:</strong> {{ $correspondencia->fecha->format('d/m/Y') }}</p>

        <div class="flex flex-wrap gap-2 mb-4">
            <a href="{{ route('correspondencia.imprimir_hoja_ruta', $correspondencia->id) }}" target="_blank"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Imprimir Hoja de Ruta
            </a>


            <a href="{{ route('correspondencia.index') }}"
                class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Volver a la lista
            </a>

            <!-- Derivar -->
            <a href="{{ route('derivacion.store', $correspondencia->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Derivar
            </a>
        </div>
    </div>
</x-app-layout>
