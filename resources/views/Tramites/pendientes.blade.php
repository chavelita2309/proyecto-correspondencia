@php
    use App\Helpers\FechaHelper;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <section class="antialiased bg-gray-100 text-gray-600 min-h-screen px-4 py-6">
        <div class="flex flex-col justify-superior">
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-yellow-800 text-lg">⏳ Trámites pendientes</h2>
                </header>
                <div class="p-3 overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 text-left">Hoja de ruta</th>
                                <th class="p-2 text-left">Referencia</th>
                                <th class="p-2 text-left">Fecha</th>
                                <th class="p-2 text-left">Retención</th>
                                <th class="p-2 text-left">Funcionario</th>
                                <th class="p-2 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($tramites as $tramite)
                                @php
                                    $dias = FechaHelper::diasHabilesTranscurridos($tramite->fecha);
                                    $color = $dias > 7 ? 'bg-red-100' : ($dias > 2 ? 'bg-yellow-100' : '');
                                    $fecha = \Carbon\Carbon::parse($tramite->fecha)->format('d/m/Y');
                                @endphp
                                <tr class="{{ $color }}">
                                    <td class="p-2">{{ $tramite->correspondencia->rut }}</td>
                                    <td class="p-2">{{ $tramite->correspondencia->referencia ?? '-' }}</td>
                                    <td class="p-2">{{ $fecha }}</td>
                                    <td class="p-2 flex items-center gap-2">
                                        {{ $dias }} días hábiles
                                        @if ($dias > 7)
                                            <span class="relative">
                                                <span class="absolute animate-ping bg-red-500 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                                <span class="absolute bg-red-500 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                            </span>
                                        @elseif($dias > 2)
                                            <span class="relative">
                                                <span class="absolute animate-ping bg-yellow-400 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                                <span class="absolute bg-yellow-400 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-2">{{ $tramite->funcionario->cargo ?? 'Sin cargo' }}</td>
                                    <td class="p-2 text-center">
                                        <a href="{{ route('correspondencia.mostrar', $tramite->correspondencia->id) }}"
                                           class="text-blue-600 hover:underline">Ver</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">No hay trámites pendientes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
         {{ $tramites->links() }};
</x-app-layout>
