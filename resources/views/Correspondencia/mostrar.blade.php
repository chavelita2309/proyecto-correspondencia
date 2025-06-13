<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

    <div class="container size-1/2 m-auto">

        <div>
            <div class="px-4 sm:px-0">
                <h3 class="text-base/7 font-semibold text-gray-900">Detalles de trámite</h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Información de la correspondencia.</p>
            </div>
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Hoja de ruta</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->rut }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Fecha de recepción</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ \Carbon\Carbon::parse($correspondencia->fecha)->format('d/m/Y') }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Hora de recepción</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $correspondencia->hora->format('H:i') }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Gestión</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->gestion }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Fojas</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->fojas }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Files</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->folder }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Referencia</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $correspondencia->referencia }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Remitente</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->remitente }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Unidad remitente</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->unidad }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Destinatario</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $correspondencia->destinatario }}</dd>
                    </div>

                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Tipo de trámite</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->tipo }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Código de seguimiento</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $correspondencia->codigo }}
                        </dd>
                    </div>

                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Documento adjunto</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $correspondencia->documento }} <a
                                href="{{ asset('archivos/' . $correspondencia->documento) }}" target="_blank"
                                class="text-blue-600 hover:underline">
                                Ver documento
                            </a></dd>

                    </div>

                </dl>
            </div>
        </div>



        <br>
        <br>

        <div class="flex flex-wrap gap-2 mb-4">
            <!-- Volver -->
            <a href="{{ route('correspondencia.index') }}"
                class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Volver
            </a>

            <!-- Editar -->
            <a href="{{ route('correspondencia.editar', $correspondencia) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Editar
            </a>

            <!-- Derivar -->
            <a href="{{ route('derivacion.store', $correspondencia->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Derivar
            </a>

            <!-- Imprimir Hoja de Ruta -->
            <a href="{{ route('correspondencia.imprimir_hoja_ruta', $correspondencia->id) }}" target="_blank"
                class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Imprimir Hoja
            </a>

        </div>
    </div>

</x-app-layout>
