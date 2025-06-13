<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hoja de Ruta') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
        <form action="{{ route('reportes.hoja.generar') }}" method="POST" target="_blank">
            @csrf
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <input type="date" name="desde" class="border rounded px-3 py-2" required>
                <input type="date" name="hasta" class="border rounded px-3 py-2" required>

                <select name="tipo_registro" class="border rounded px-3 py-2">
                    <option value="">-- Todos los tipos --</option>
                    <option value="emitida">Emitida</option>
                    <option value="recibida">Recibida</option>
                </select>

                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                    Generar Hoja de Ruta
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
