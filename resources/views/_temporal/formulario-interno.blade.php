<x-app-layout>
    <x-slot name="header">
       <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center text-blue-700">Buscar por código</h2>

        @if(session('error'))
            <div class="mt-4 p-3 bg-red-100 text-red-600 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('tramites.buscarInterno') }}" method="POST" class="mt-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Código de Seguimiento:</label>
                <input type="text" name="codigo" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full mt-2 p-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition duration-200">
                Buscar
            </button>
        </form>
    </div>
</x-app-layout>
