<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class='flex items-center justify-center min-h-screen from-teal-100 via-teal-300 to-teal-500 bg-gradient-to-br'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-2'>

                <h2 class="text-2xl font-bold">Correspondencia a derivar</h2>
                <p><strong>Hoja de ruta:</strong> {{ $correspondencia->rut }}</p>
                <p><strong>Remitente:</strong> {{ $correspondencia->remitente }}</p>
                <p><strong>Unidad remitente:</strong> {{ $correspondencia->unidad }}</p>
                <p><strong>Referencia:</strong> {{ $correspondencia->referencia }}</p>
                <p><strong>Fecha de recepción:</strong> {{ $correspondencia->fecha->format('d/m/Y') }}</p>
                <p><strong>Hora de recepción:</strong> {{ $correspondencia->hora->format('H:i') }}</p>
                <hr class="my-2">

                <h2 class="text-2xl font-bold">Historial de Derivaciones</h2>
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Fecha</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Prioridad</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Funcionario</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Estado del trámite</th>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                        @foreach ($correspondencia->derivaciones as $derivacion)
                            <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    {{ \Carbon\Carbon::parse($derivacion->fecha)->format('d/m/Y') }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    {{ ucfirst($derivacion->prioridad) }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    {{ $derivacion->funcionario->cargo }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    {{ $derivacion->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2 class="text-2xl font-bold">Derivar Correspondencia</h2>
                <form action="{{ route('derivacion.store', $correspondencia->id) }}" method="POST">
                    @csrf

                    <label class="uppercase text-sm font-bold opacity-70">Fecha:</label>
                    <input type="date" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="fecha" required>


                    <label class="uppercase text-sm font-bold opacity-70">Prioridad:</label>
                    <select name="prioridad" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                        <option value="alta">Alta</option>
                        <option value="regular">Regular</option>
                        <option value="baja">Baja</option>
                    </select>

                    <label class="uppercase text-sm font-bold opacity-70">Funcionario:</label>


                    <select name="funcionario_id" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                        <option value="">Seleccione un funcionario</option>
                        @foreach ($funcionarios as $funcionario)
                            <option value="{{ $funcionario->id }}">{{ $funcionario->cargo }}</option>
                        @endforeach
                    </select>

                    {{-- <label class="uppercase text-sm font-bold opacity-70">Estado del trámite:</label>
                    <select name="estado" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                        <option value="recibido">Recibido</option>
                        <option value="rechazado">Rechazado</option>
                        <option value="en revision">En revisión</option>
                        <option value="concluido">Concluido</option>
                    </select> --}}

                    <label class="uppercase text-sm font-bold opacity-70">Observaciones:</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="observaciones">

                    <!-- Derivar  -->
                    <button type="submit"
                        class="py-3 px-6 my-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded transition duration-300 ease-in-out">
                        Derivar
                    </button>

                    <!-- Volver -->
                    <a href="{{ route('correspondencia.mostrar', $correspondencia->id) }}"
                        class="inline-block py-3 px-6 my-2 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold rounded transition duration-300 ease-in-out">
                        Volver
                    </a>


                </form>
            </div>

</x-app-layout>
