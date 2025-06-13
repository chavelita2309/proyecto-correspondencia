<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-red-600">
            {{ __('Acceso Denegado') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-lg">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">403 - No tienes permiso para acceder</h1>
                <p class="text-gray-600 mb-6">
                    Lo sentimos, no cuentas con los permisos necesarios para acceder a esta sección.
                </p>
                <a href="{{ route('dashboard') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
