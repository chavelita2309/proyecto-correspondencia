<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Libro de Correspondencia') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">📄 Generar Libro de Correspondencia</h2>

        <form action="{{ route('reportes.libro.generar') }}" method="POST" target="_blank">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="desde" class="block text-sm font-medium text-gray-700">Desde</label>
                    <input type="date" name="desde" id="desde" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label for="hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
                    <input type="date" name="hasta" id="hasta" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- <div>
                    <label for="tipo_registro" class="block text-sm font-medium text-gray-700">Tipo de Correspondencia</label>
                    <select name="tipo_registro" id="tipo_registro" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="" disabled selected>Seleccione una opción</option>

                        <option value="emitida">Emitida</option>
                        <option value="recibida">Recibida</option>
                    </select>
                </div> --}}
            </div>

            <div class="text-right">
                <button type="submit" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded shadow">
                    📄 Generar Libro
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
