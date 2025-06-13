<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>
    <div class="my-5">

        <div
            class="container mx-auto max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl shadow-md py-4 px-6 sm:px-10 bg-white border-emerald-500 rounded-md">

            <h1 class="text-sm sm:text-md font-bold text-gray-700">Edite la correspondencia según sus necesidades</h1>
            <br>


            <div class="my-3">

                <h1 class="text-center text-2xl sm:text-3xl font-bold text-gray-900">Datos a editar</h1>
                <form action="{{ route('correspondencia.update', $correspondencia->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="my-2">
                        <label for="rut" class="text-sm sm:text-md font-bold text-gray-700">Hoja de ruta</label>
                        <input type="text" name="rut" value="{{ $correspondencia->rut }}" required
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="rut">
                    </div>

                    <div class="my-2">
                        <label for="tipo_registro" class="text-sm sm:text-md font-bold text-gray-700">Correspondencia
                            recibida o emitida</label>
                        <input type="text" name="tipo_registro" value="{{ $correspondencia->tipo_registro }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="tipo_registro">
                    </div>

                    <div class="my-2">
                        <label for="fecha" class="text-sm sm:text-md font-bold text-gray-700">Fecha de
                            recepción</label>
                        <input type="date" name="fecha"
                            value="{{ \Carbon\Carbon::parse($correspondencia->fecha)->format('Y-m-d') }}" class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="fecha">
                    </div>

                    <div class="my-2">
                        <label for="hora" class="text-sm sm:text-md font-bold text-gray-700">Hora de
                            recepción</label>

                        <input type="time" name="hora"
                            value="{{ \Carbon\Carbon::parse($correspondencia->hora)->format('H:i') }}" class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="hora">
                    </div>

                    <div class="my-2">
                        <label for="fojas" class="text-sm sm:text-md font-bold text-gray-700">Fojas</label>
                        <input type="text" name="fojas" value="{{ $correspondencia->fojas }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="fojas">
                    </div>

                    <div class="my-2">
                        <label for="folder" class="text-sm sm:text-md font-bold text-gray-700">Files</label>
                        <input type="text" name="folder" value="{{ $correspondencia->folder }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="folder">
                    </div>

                    <div class="my-2">
                        <label for="destinatario"
                            class="text-sm sm:text-md font-bold text-gray-700">Destinatario</label>
                        <input type="text" value="{{ $correspondencia->destinatario }}" name="destinatario"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="destinatario">
                    </div>

                    <div class="my-2">
                        <label for="remitente" class="text-sm sm:text-md font-bold text-gray-700">Remitente</label>
                        <input type="text" name="remitente" value="{{ $correspondencia->remitente }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="remitente">
                    </div>

                    <div class="my-2">
                        <label for="unidad" class="text-sm sm:text-md font-bold text-gray-700">Unidad
                            remitente</label>
                        <input type="text" name="unidad" value="{{ $correspondencia->unidad }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="unidad">
                    </div>

                    <div class="my-2">
                        <label for="referencia" class="text-sm sm:text-md font-bold text-gray-700">Referencia</label>
                        <input type="text" name="referencia" value="{{ $correspondencia->referencia }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="referencia">
                    </div>

                    <div class="my-2">
                        <label for="fono" class="text-sm sm:text-md font-bold text-gray-700">Teléfono del
                            remitente</label>
                        <input type="text" name="fono" value="{{ $correspondencia->fono }}"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="fono">
                    </div>

                    <!-- Input field for 'Tipo' -->
                    <div class="my-2">

                       <label class="text-sm sm:text-md font-bold text-gray-700">Tipo de trámite</label>
<select id="tipo" name="tipo" class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900">
    <option value="">Seleccione una opción</option>
    @foreach(App\Models\Correspondencia::tiposPredefinidos() as $tipo)
        <option value="{{ $tipo }}" {{ $correspondencia->tipo === $tipo ? 'selected' : '' }}>
            {{ ucfirst($tipo) }}
        </option>
    @endforeach
    <option value="otro" {{ !in_array($correspondencia->tipo, App\Models\Correspondencia::tiposPredefinidos()) ? 'selected' : '' }}>
        Otro...
    </option>
</select>

@if(!in_array($correspondencia->tipo, App\Models\Correspondencia::tiposPredefinidos()))
    <input type="text" name="tipo_personalizado" value="{{ $correspondencia->tipo }}" class="p-3 mt-2 mb-4 w-full bg-slate-100 rounded" placeholder="Especifique el tipo de trámite">
@endif

 <input type="text" id="tipo_otro" name="tipo_otro"
                    class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900" placeholder="Ingrese nuevo tipo">

                    </div>

                    <div class="my-2">

                        @if ($correspondencia->documento)
                            <p class="text-sm text-gray-700">Documento actual:
                                <a href="{{ asset('archivos/' . $correspondencia->documento) }}" target="_blank"
                                    class="text-blue-600 underline">
                                    Ver documento
                                </a>
                            </p>
                        @endif

                        <label class="uppercase text-sm font-bold opacity-70">Documento (PDF)</label>
                        <input type="file" name="documento" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                    </div>

                    <div class="flex flex-wrap gap-2 my-4">
                        <!-- Botón Atrás -->
                        <a href="{{ route('correspondencia.index') }}"
                            class="w-32 py-2 text-center bg-cyan-500 hover:bg-cyan-600 text-white font-semibold rounded shadow-md transition duration-200">
                            Volver
                        </a>

                        <!-- Botón Guardar -->
                        <input type="submit" value="Guardar"
                            class="w-32 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded shadow-md cursor-pointer transition duration-200" />
                    </div>



                </form>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('tipo').addEventListener('change', function() {
        let tipoOtro = document.getElementById('tipo_otro');
        tipoOtro.classList.toggle('hidden', this.value !== 'otro');
        if (this.value === 'otro') {
            tipoOtro.focus();
        }
    });
</script>

</x-app-layout>
