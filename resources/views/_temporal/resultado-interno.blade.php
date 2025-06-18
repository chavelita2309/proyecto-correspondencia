<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center">Detalles del Trámite </h2>

        <p><strong>Código de Seguimiento:</strong> {{ $correspondencia->codigo }}</p>
        <p><strong>Hoja de ruta:</strong> {{ $correspondencia->rut }}</p>
        <p><strong>Referencia:</strong> {{ $correspondencia->referencia }}</p>
        <p><strong>Fecha de recepción:</strong> {{ \Carbon\Carbon::parse($correspondencia->fecha)->format('d/m/Y') }}</p>

        <p><strong>Estado del Trámite:</strong>
            {{ optional($correspondencia->derivaciones->last())->estado ?? 'No derivado a ningún funcionario' }}</p>

        <h3 class="text-xl font-bold mt-4">Seguimiento del trámite</h3>
        @php
            $seguimientosFiltrados = $correspondencia->seguimientos->filter(fn($s) => $s->accion !== 'busqueda');
        @endphp

        @if ($seguimientosFiltrados->isEmpty())
            <p class="text-gray-600">No hay historial registrado para este trámite.</p>
        @else
            <table class="w-full border-collapse border mt-2">
                <thead>
                    <tr>
                        <th class="border p-2">Fecha</th>
                        <th class="border p-2">Acción</th>
                        <th class="border p-2">Funcionario</th>
                        <th class="border p-2">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seguimientosFiltrados as $seguimiento)
                        <tr>
                            <td class="border p-2">{{ \Carbon\Carbon::parse($seguimiento->fecha)->format('d/m/Y ') }}</td>
                            <td class="border p-2">{{ ucfirst($seguimiento->accion) }}</td>
                            <td class="border p-2">{{ optional($seguimiento->funcionario)->cargo ?? 'Desconocido' }}</td>
                            <td class="border p-2">{{ $seguimiento->comentario }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>

