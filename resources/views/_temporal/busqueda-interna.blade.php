<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center">Buscar Trámite por Código</h2>

        @if(session('error'))
            <div class="mt-4 text-red-500 text-center">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="mt-4 text-green-500 text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tramites.buscarInterno') }}" method="POST">
            @csrf

            <label class="block text-sm font-medium mt-4">Código de Seguimiento:</label>
            <input type="text" name="codigo" class="w-full p-2 border rounded mt-1" required>

            <button type="submit" class="w-full mt-6 p-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
                Buscar Trámite
            </button>
        </form>
    </div>
</x-app-layout>
