<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Asignar Permisos a {{ $user->name }}</h2>
    </x-slot>

    <div class="py-6">
        <form action="{{ route('usuarios.permisos.actualizar', $user->id) }}" method="POST" class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <h3 class="text-lg font-medium mb-2">Permisos disponibles</h3>
                @foreach ($permissions as $permission)
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                   class="form-checkbox">
                            <span class="ml-2">{{ $permission->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <x-primary-button>Guardar permisos</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
