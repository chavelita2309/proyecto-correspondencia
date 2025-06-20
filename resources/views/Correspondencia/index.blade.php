@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="container size-11/12 m-auto">
        <br>

        <!-- Tabla -->
        <table class="min-w-full border-collapse block md:table">
            <thead class="block md:table-header-group">
                <tr
                    class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Hoja de ruta</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Referencia</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Remitente</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Fecha de recepción</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Documento</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Código de seguimiento</th>
                    {{-- <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Retención</th> --}}
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Operaciones</th>
                </tr>
            </thead>

            <tbody class="block md:table-row-group">
                @foreach ($correspondencia as $cor)
                    {{-- @php
                        $fechaUltimaDerivacion = $cor->derivaciones->last()?->fecha ?? $cor->created_at;
                        $horasRetenidas = now()->diffInHours($fechaUltimaDerivacion);

                        $estado = strtolower($cor->estado ?? '');
                        $color = '';

                        if ($estado !== 'concluido') {
                            if ($horasRetenidas > 168) {
                                $color = 'bg-red-100';
                            } elseif ($horasRetenidas > 48) {
                                $color = 'bg-yellow-100';
                            }
                        }
                    @endphp --}}


                    <tr class=" border border-gray-500 md:border-none block md:table-row">
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hoja de ruta</span>
                            <a href="{{ route('correspondencia.mostrar', $cor->id) }}">{{ $cor->rut }}</a>
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Referencia</span>{{ $cor->referencia }}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Remitente</span>{{ $cor->remitente }}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Fecha de
                                remisión</span>{{ \Carbon\Carbon::parse($cor->fecha)->format('d/m/Y') }}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell w-32 truncate">
                            <span class="inline-block w-1/3 md:hidden font-bold">Documento</span>

                            @if (!empty($cor->documento))
                                <a href="{{ asset('storage/archivos/' . $cor->documento) }}" target="_blank"
                                    class="text-blue-500 hover:underline">
                                    Ver documento
                                </a>
                            @endif

                            {{-- <a href="{{ asset('archivos/' . $cor->documento) }}" class="text-blue-600 underline"
                                target="_blank" rel="noopener noreferrer">
                                {{ $cor->documento }}
                            </a> --}}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell relative">
                            <span class="inline-block w-1/3 md:hidden font-bold">Código</span>
                            {{ $cor->codigo }}

                            {{-- @if ($estado !== 'concluido')
    @if ($horasRetenidas > 168)
        <span class="absolute top-0 right-1 animate-ping bg-red-500 rounded-full h-3 w-3"></span>
        <span class="absolute top-0 right-1 bg-red-500 rounded-full h-3 w-3"></span>
    @elseif($horasRetenidas > 48)
        <span class="absolute top-0 right-1 animate-ping bg-yellow-400 rounded-full h-3 w-3"></span>
        <span class="absolute top-0 right-1 bg-yellow-400 rounded-full h-3 w-3"></span>
    @endif
@endif --}}

                        </td>

                        {{-- <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                           <span class="inline-block w-1/3 md:hidden font-bold">Retención</span> --}}
                        {{-- @if ($estado === 'concluido')
    Trámite archivado
@else
    {{ $horasRetenidas }} h
@endif --}}

                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Operaciones</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('correspondencia.mostrar', $cor->id) }}"
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-1 w-24 text-center rounded inline-block">Ver</a>

                                <a href="{{ route('derivacion.store', $cor->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 w-24 text-center rounded inline-block">Derivar</a>

                                <a href="{{ route('correspondencia.editar', $cor) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 w-24 text-center rounded inline-block">Editar</a>

                                <form action="{{ route('correspondencia.borrar', $cor->id) }}" method="POST"
                                    onsubmit="return confirmarEliminacion('{{ $cor->rut }}')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 w-24 text-center rounded">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $correspondencia->links() }}

    <script>
        function confirmarEliminacion(rut) {
            return confirm('¿Desea eliminar el registro: ' + rut + '?');
        }
    </script>
</x-app-layout>
