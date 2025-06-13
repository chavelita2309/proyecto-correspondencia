<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div class="my-5">

        <div
            class="container mx-auto max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl shadow-md py-4 px-6 sm:px-10 bg-white border-emerald-500 rounded-md">

            <h1 class="text-sm sm:text-md font-bold text-gray-700">Edite la correspondencia según sus necesidades</h1>
            <br>


            <div class="my-3">

                <h1 class="text-center text-2xl sm:text-3xl font-bold text-gray-900">Datos a editar</h1>
                <form action="<?php echo e(route('correspondencia.update', $correspondencia->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>


                    <div class="my-2">
                        <label for="rut" class="text-sm sm:text-md font-bold text-gray-700">Hoja de ruta</label>
                        <input type="text" name="rut" value="<?php echo e($correspondencia->rut); ?>" required
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="rut">
                    </div>

                    <div class="my-2">
                        <label for="tipo_registro" class="text-sm sm:text-md font-bold text-gray-700">Correspondencia
                            recibida o emitida</label>
                        <input type="text" name="tipo_registro" value="<?php echo e($correspondencia->tipo_registro); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="tipo_registro">
                    </div>

                    <div class="my-2">
                        <label for="fecha" class="text-sm sm:text-md font-bold text-gray-700">Fecha de
                            recepción</label>
                        <input type="date" name="fecha"
                            value="<?php echo e(\Carbon\Carbon::parse($correspondencia->fecha)->format('Y-m-d')); ?>" class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="fecha">
                    </div>

                    <div class="my-2">
                        <label for="hora" class="text-sm sm:text-md font-bold text-gray-700">Hora de
                            recepción</label>

                        <input type="time" name="hora"
                            value="<?php echo e(\Carbon\Carbon::parse($correspondencia->hora)->format('H:i')); ?>" class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="hora">
                    </div>

                    <div class="my-2">
                        <label for="fojas" class="text-sm sm:text-md font-bold text-gray-700">Fojas</label>
                        <input type="text" name="fojas" value="<?php echo e($correspondencia->fojas); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="fojas">
                    </div>

                    <div class="my-2">
                        <label for="folder" class="text-sm sm:text-md font-bold text-gray-700">Files</label>
                        <input type="text" name="folder" value="<?php echo e($correspondencia->folder); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="folder">
                    </div>

                    <div class="my-2">
                        <label for="destinatario"
                            class="text-sm sm:text-md font-bold text-gray-700">Destinatario</label>
                        <input type="text" value="<?php echo e($correspondencia->destinatario); ?>" name="destinatario"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="destinatario">
                    </div>

                    <div class="my-2">
                        <label for="remitente" class="text-sm sm:text-md font-bold text-gray-700">Remitente</label>
                        <input type="text" name="remitente" value="<?php echo e($correspondencia->remitente); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="remitente">
                    </div>

                    <div class="my-2">
                        <label for="unidad" class="text-sm sm:text-md font-bold text-gray-700">Unidad
                            remitente</label>
                        <input type="text" name="unidad" value="<?php echo e($correspondencia->unidad); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="unidad">
                    </div>

                    <div class="my-2">
                        <label for="referencia" class="text-sm sm:text-md font-bold text-gray-700">Referencia</label>
                        <input type="text" name="referencia" value="<?php echo e($correspondencia->referencia); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="referencia">
                    </div>

                    <div class="my-2">
                        <label for="fono" class="text-sm sm:text-md font-bold text-gray-700">Teléfono del
                            remitente</label>
                        <input type="text" name="fono" value="<?php echo e($correspondencia->fono); ?>"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900"
                            id="fono">
                    </div>

                    <!-- Input field for 'Tipo' -->
                    <div class="my-2">

                       <label class="text-sm sm:text-md font-bold text-gray-700">Tipo de trámite</label>
<select id="tipo" name="tipo" class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900">
    <option value="">Seleccione una opción</option>
    <?php $__currentLoopData = App\Models\Correspondencia::tiposPredefinidos(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($tipo); ?>" <?php echo e($correspondencia->tipo === $tipo ? 'selected' : ''); ?>>
            <?php echo e(ucfirst($tipo)); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <option value="otro" <?php echo e(!in_array($correspondencia->tipo, App\Models\Correspondencia::tiposPredefinidos()) ? 'selected' : ''); ?>>
        Otro...
    </option>
</select>

<?php if(!in_array($correspondencia->tipo, App\Models\Correspondencia::tiposPredefinidos())): ?>
    <input type="text" name="tipo_personalizado" value="<?php echo e($correspondencia->tipo); ?>" class="p-3 mt-2 mb-4 w-full bg-slate-100 rounded" placeholder="Especifique el tipo de trámite">
<?php endif; ?>

 <input type="text" id="tipo_otro" name="tipo_otro"
                    class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-sm sm:text-md rounded-md my-2 bg-white text-gray-900" placeholder="Ingrese nuevo tipo">

                    </div>

                    <div class="my-2">

                        <?php if($correspondencia->documento): ?>
                            <p class="text-sm text-gray-700">Documento actual:
                                <a href="<?php echo e(asset('archivos/' . $correspondencia->documento)); ?>" target="_blank"
                                    class="text-blue-600 underline">
                                    Ver documento
                                </a>
                            </p>
                        <?php endif; ?>

                        <label class="uppercase text-sm font-bold opacity-70">Documento (PDF)</label>
                        <input type="file" name="documento" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                    </div>

                    <div class="flex flex-wrap gap-2 my-4">
                        <!-- Botón Atrás -->
                        <a href="<?php echo e(route('correspondencia.index')); ?>"
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Correspondencia\editar.blade.php ENDPATH**/ ?>