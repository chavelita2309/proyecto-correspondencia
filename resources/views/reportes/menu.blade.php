<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes - Sistema Web de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white shadow rounded-lg">
        <h3 class="text-lg font-semibold mb-4">Opciones de Reporte</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Reporte General -->
            <a href="{{ route('reportes.general') }}" class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-4 px-6 rounded-lg shadow transition">
                📄 Reporte General
            </a>

            <!-- Libro de Correspondencias -->
            <a href="{{ route('reportes.libro') }}" class="block bg-green-600 hover:bg-green-700 text-white text-center py-4 px-6 rounded-lg shadow transition">
                📘 Libro de Correspondencias
            </a>

            
        </div>
    </div>
</x-app-layout>