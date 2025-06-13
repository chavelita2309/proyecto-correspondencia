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
            <div class='max-w-md mx-auto space-y-2'>

                <h2 class="text-2xl font-bold">Correspondencia a derivar</h2>
                <p><strong>Hoja de ruta:</strong> <?php echo e($correspondencia->rut); ?></p>
                <p><strong>Remitente:</strong> <?php echo e($correspondencia->remitente); ?></p>
                <p><strong>Unidad remitente:</strong> <?php echo e($correspondencia->unidad); ?></p>
                <p><strong>Referencia:</strong> <?php echo e($correspondencia->referencia); ?></p>
                <p><strong>Fecha de recepción:</strong> <?php echo e($correspondencia->fecha->format('d/m/Y')); ?></p>
                <p><strong>Hora de recepción:</strong> <?php echo e($correspondencia->hora->format('H:i')); ?></p>
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
                        <?php $__currentLoopData = $correspondencia->derivaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $derivacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <?php echo e(\Carbon\Carbon::parse($derivacion->fecha)->format('d/m/Y')); ?></td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <?php echo e(ucfirst($derivacion->prioridad)); ?></td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <?php echo e($derivacion->funcionario->cargo); ?></td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <?php echo e($derivacion->estado); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <h2 class="text-2xl font-bold">Derivar Correspondencia</h2>
                <form action="<?php echo e(route('derivacion.store', $correspondencia->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

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
                        <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($funcionario->id); ?>"><?php echo e($funcionario->cargo); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    

                    <label class="uppercase text-sm font-bold opacity-70">Observaciones:</label>
                    <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" name="observaciones">

                    <!-- Derivar  -->
                    <button type="submit"
                        class="py-3 px-6 my-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded transition duration-300 ease-in-out">
                        Derivar
                    </button>

                    <!-- Volver -->
                    <a href="<?php echo e(route('correspondencia.mostrar', $correspondencia->id)); ?>"
                        class="inline-block py-3 px-6 my-2 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold rounded transition duration-300 ease-in-out">
                        Volver
                    </a>


                </form>
            </div>

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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Derivacion\index.blade.php ENDPATH**/ ?>