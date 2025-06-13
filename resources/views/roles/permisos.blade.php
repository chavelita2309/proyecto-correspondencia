<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignar Permisos al Rol: ') . $role->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form method="POST" action="{{ route('roles.permisos.update', $role) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($permisos as $permiso)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="permisos[]" value="{{ $permiso->name }}"
                                    {{ $role->hasPermissionTo($permiso->name) ? 'checked' : '' }}
                                    class="form-checkbox h-5 w-5 text-indigo-600">
                                <span>{{ $permiso->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 flex space-x-4">
    <button type="submit"
        class="inline-flex items-center justify-center w-44 h-12 bg-green-600 hover:bg-green-700 text-white font-bold rounded transition duration-300">
        Guardar Permisos
    </button>

    <a href="{{ route('roles.index') }}"
        class="inline-flex items-center justify-center w-44 h-12 bg-red-600 hover:bg-red-700 text-white font-bold rounded transition duration-300">
        {{ __('Cancelar') }}
    </a>
</div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
