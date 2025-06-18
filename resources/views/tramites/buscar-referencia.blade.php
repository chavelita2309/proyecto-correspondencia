<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="py-6">
       
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 text-sm text-red-600">{{ session('error') }}</div>
            @endif
             <h2 class="text-xl font-semibold leading-tight text-gray-800">Buscar Correspondencia por Referencia</h2><br>
             
            <form method="GET" action="{{ route('tramites.buscarPorReferencia') }}">
                <div class="mb-4">
                    <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia:</label>
                    <input type="text" name="referencia" id="referencia" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="gestion" class="block text-sm font-medium text-gray-700">Gestión:</label>
                    <select name="gestion" id="gestion" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Todas --</option>
                        @for ($anio = now()->year; $anio >= 2020; $anio--)
                            <option value="{{ $anio }}">{{ $anio }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo predefinido:</label>
                    <select name="tipo" id="tipo" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Todos --</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Buscar
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
