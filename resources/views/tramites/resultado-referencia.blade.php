<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Resultados de búsqueda por referencia</h2>
                <br>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Referencia</th>
                            <th class="p-2">Documento</th>
                            <th class="p-2">Código de seguimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($correspondencias as $item)
                            <tr class="border-t">
                                <td class="p-2">{{ $item->fecha->format('d/m/Y') }}</td>
                                <td class="p-2">{{ $item->referencia }}</td>
                                <td class="p-2">
                                    @if (!empty($item->documento))
                                        <a href="{{ asset('archivos/' . $item->documento) }}" target="_blank"
                                            class="text-blue-500 hover:underline">
                                            Ver documento
                                        </a>
                                    @endif
                                </td>
                                <td class="p-2">{{ $item->codigo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
