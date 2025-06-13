<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 mt-6 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">📄 Generar Reporte de Correspondencia</h2>

        <form action="{{ route('reportes.generar') }}" method="POST" target="_blank">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="desde" class="block text-sm font-medium text-gray-700">Desde</label>
                    <input type="date" name="desde" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
                    <input type="date" name="hasta" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="gestion" class="block text-sm font-medium text-gray-700">Gestión</label>
                    <input type="text" name="gestion" placeholder="Ej: 2025" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                {{-- <div>
                    <label for="tipo_registro" class="block text-sm font-medium text-gray-700">Tipo de Registro</label>
                    <select name="tipo_registro" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Todos --</option>
                        <option value="emitida">Emitida</option>
                        <option value="recibida">Recibida</option>
                    </select>
                </div> --}}

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                    <select name="tipo" id="tipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Todos --</option>
                        @foreach(App\Models\Correspondencia::tiposPredefinidos() as $tipo)
                            <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Generar Reporte
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

