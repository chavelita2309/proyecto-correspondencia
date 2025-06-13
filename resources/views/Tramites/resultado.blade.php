<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg" x-data="{ showHistorial: false }">
        <h2 class="text-2xl font-bold text-center mb-4">Detalles del Trámite</h2>

        <p><strong>Código de Seguimiento:</strong> {{ $correspondencia->codigo }}</p>
        <p><strong>Hoja de ruta:</strong> {{ $correspondencia->rut }}</p>
        <p><strong>Referencia:</strong> {{ $correspondencia->referencia }}</p>
        <p><strong>Fecha de recepción:</strong> {{ \Carbon\Carbon::parse($correspondencia->fecha)->format('d/m/Y') }}</p>

        {{-- Estado actual basado en el último seguimiento --}}
        @if($seguimientos->isNotEmpty())
            @php
                $ultimo = $seguimientos->last();
            @endphp
            <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-blue-800 text-lg font-semibold mb-2">Estado actual del Trámite:</p>
                <p><strong>Fecha:</strong> {{ $ultimo->fecha->format('d/m/Y ') }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($ultimo->accion) }}</p>
                <p><strong>Funcionario:</strong> {{ optional($ultimo->funcionario)->cargo ?? 'Usuario público' }}</p>
                <p><strong>Comentario:</strong> {{ $ultimo->comentario ?? 'Sin comentario' }}</p>
            </div>
        @else
            <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                <p class="text-yellow-800 text-lg font-semibold">Estado actual del Trámite:</p>
                <p>No hay seguimiento registrado para este trámite.</p>
            </div>
        @endif

        {{-- Botón para mostrar historial completo --}}
        <div class="mt-6 text-center">
            <button @click="showHistorial = !showHistorial"
                    class="text-blue-600 hover:underline focus:outline-none">
                <template x-if="!showHistorial">
                    <span>Mostrar historial completo</span>
                </template>
                <template x-if="showHistorial">
                    <span>Ocultar historial</span>
                </template>
            </button>
        </div>

        {{-- Historial de seguimiento --}}
        <div x-show="showHistorial" x-cloak class="mt-4">
            <h3 class="text-xl font-bold mt-4">Seguimiento del Trámite</h3>

            @if ($seguimientos->isEmpty())
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
                        @foreach ($seguimientos as $seguimiento)
                            <tr>
                                <td class="border p-2">{{ $seguimiento->fecha->format('d/m/Y ') }}</td>
                                <td class="border p-2">{{ ucfirst($seguimiento->accion) }}</td>
                                <td class="border p-2">
                                    {{ optional($seguimiento->funcionario)->cargo ?? 'Usuario público' }}
                                </td>
                                <td class="border p-2">{{ $seguimiento->comentario }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="mt-8 flex justify-center">
            <a href="{{ route('login') }}"
                class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900 transition">
                Iniciar Sesión
            </a>
        </div>

</x-app-layout>
