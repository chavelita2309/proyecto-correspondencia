<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>


    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center">Buscar Trámite</h2>


        @if (session('error'))
            <div class="text-red-500">{{ session('error') }}</div>
        @endif

        <form action="{{ route('tramite.buscar') }}" method="GET">
            <label class="block text-sm font-medium">Introduzca el código de Seguimiento:</label>
            <input type="text" name="codigo" class="w-full p-2 border rounded" required>

            <button type="submit" class="w-full mt-4 p-2 bg-blue-500 text-white rounded">Buscar</button>
        </form>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('login') }}"
                class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900 transition">
                Iniciar Sesión
            </a>
        </div>

    </div>



</x-app-layout>
