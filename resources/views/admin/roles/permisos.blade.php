<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Permisos para el rol: {{ $role->name }}</h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('roles.permisos.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($permissions as $permission)
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   @if(in_array($permission->name, $rolePermissions)) checked @endif
                                   class="form-checkbox rounded text-blue-500">
                            <span class="ml-2">{{ $permission->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar cambios</button>
                <a href="{{ route('roles.index') }}"
                   class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
