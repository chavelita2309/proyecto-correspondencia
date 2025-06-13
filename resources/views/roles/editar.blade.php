<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Rol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nombre del rol -->
                    <div class="mb-4">
                        <x-label value="Nombre del Rol" />
                        <x-input name="name" value="{{ old('name', $role->name) }}" class="w-full" />
                    </div>

                    <!-- Permisos -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Permisos</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach ($permisos as $permiso)
                                <label class="flex items-center">
                                    <input type="checkbox" name="permisos[]" value="{{ $permiso->name }}"
                                           {{ in_array($permiso->name, $permisosAsignados) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $permiso->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-button class="ml-3">Guardar Cambios</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

