<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes de sesión --}}
            @if (session('success'))
                <div class="mb-4 text-green-600 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 text-red-600 bg-red-100 p-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Botón de registrar --}}
            <div class="mb-4">
                <a href="{{ route('usuarios.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                    + Registrar Usuario
                </a>
            </div>

            {{-- Tabla --}}
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td class="px-4 py-2">{{ $usuario->name }}</td>
                                <td class="px-4 py-2">{{ $usuario->email }}</td>

                                {{-- Rol con opción de asignar nuevo --}}
<td class="px-4 py-2">
    <form action="{{ route('usuarios.cambiarRol', $usuario->id) }}" method="POST"
        class="flex items-center space-x-2">
        @csrf
        @method('PUT')
        <select name="role_id"
            class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            @foreach ($roles as $rol)
                <option value="{{ $rol->id }}"
                    {{ $usuario->roles->first()?->id == $rol->id ? 'selected' : '' }}>
                    {{ $rol->name }}
                </option>
            @endforeach
        </select>
        <button type="submit"
            class="inline-flex items-center justify-center w-20 h-9 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition duration-200">
            Guardar
        </button>
    </form>
</td>

{{-- Acciones --}}
<td class="px-4 py-2 text-right">
    <div class="flex justify-end space-x-2">
        {{-- Editar --}}
        <a href="{{ route('usuarios.edit', $usuario->id) }}"
            class="inline-flex items-center justify-center w-20 h-9 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition duration-200">
            Editar
        </a>

        {{-- Eliminar si no es superadmin --}}
        @if (!$usuario->roles->contains('name', 'superadmin'))
            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center justify-center w-20 h-9 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition duration-200">
                    Eliminar
                </button>
            </form>
        @endif
    </div>
</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
