<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Gestión de Roles</h2>
    </x-slot>

    <div class="p-4">
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Rol</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $role->name }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('roles.permisos.edit', $role) }}"
                               class="text-blue-600 hover:underline">Gestionar Permisos</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
