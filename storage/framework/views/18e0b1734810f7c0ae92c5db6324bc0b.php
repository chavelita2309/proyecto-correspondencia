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
    <div class='flex items-center justify-center min-h-screen from-teal-100 via-teal-300 to-teal-500 bg-gradient-to-br'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>

                <form action="<?php echo e(route('correspondencia.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <h2 class="text-2xl font-bold">Nuevo trámite</h2>
                    <p class="my-4 opacity-70">Registre los datos de la correspondencia</p>
                    <hr class="my-6">

                    <label class="uppercase text-sm font-bold opacity-70">Hoja de ruta</label>
                    <input type="text" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="rut">

                    


                    <label class="uppercase text-sm font-bold opacity-70">Fecha de recepción</label>
                    <input type="date" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="fecha">

                    <label class="uppercase text-sm font-bold opacity-70">Hora de recepción</label>
                    <input type="time" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="hora">

                    <label class="uppercase text-sm font-bold opacity-70">Fojas</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="fojas">

                    <label class="uppercase text-sm font-bold opacity-70">Files</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="folder">

                    <label class="uppercase text-sm font-bold opacity-70">Destinatario</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="destinatario">

                    <label class="uppercase text-sm font-bold opacity-70">Unidad remitente</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="unidad">

                    <label class="uppercase text-sm font-bold opacity-70">Referencia</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="referencia">

                    <label class="uppercase text-sm font-bold opacity-70">Remitente</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="remitente">

                    <label class="uppercase text-sm font-bold opacity-70">Teléfono</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="fono">

                    <!-- ✅ Selección del tipo de trámite -->
                    <label class="uppercase text-sm font-bold opacity-70">Tipo de trámite</label>
                    <select id="tipo" name="tipo" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                        <option value="">Seleccione una opción</option>
                        <?php $__currentLoopData = App\Models\Correspondencia::tiposPredefinidos(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tipo); ?>"><?php echo e(ucfirst($tipo)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="otro">Otro...</option>
                    </select>

                    <!-- ✅ Input para nuevo tipo (oculto por defecto) -->
                    <input type="text" id="tipo_otro" name="tipo_otro"
                        class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded hidden" placeholder="Ingrese nuevo tipo">

                    <!-- ✅ Carga de archivo -->
                    <label class="uppercase text-sm font-bold opacity-70">Documento (PDF/DOC)</label>
                    <input type="file" name="documento" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded">
                    <div class="flex flex-wrap gap-2">
                        <!-- Botón Guardar (verde) -->
                        <input type="submit" value="Guardar "
                            class="inline-block py-3 px-6 my-2 bg-green-600 text-white font-medium rounded hover:bg-green-700 transition duration-300" />

                        <!-- Botón Cancelar (gris claro) -->
                        <a href="<?php echo e(route('correspondencia.index')); ?>"
                            class="inline-block py-3 px-6 my-2 bg-red-600 text-white font-medium rounded hover:bg-red-700 transition duration-300">
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ✅ Script para mostrar/ocultar el campo de "Otro tipo de trámite" -->
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Correspondencia\registrar.blade.php ENDPATH**/ ?>