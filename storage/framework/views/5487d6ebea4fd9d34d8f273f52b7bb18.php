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

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center">Detalles del Trámite </h2>

        <p><strong>Código de Seguimiento:</strong> <?php echo e($correspondencia->codigo); ?></p>
        <p><strong>Hoja de ruta:</strong> <?php echo e($correspondencia->rut); ?></p>
        <p><strong>Referencia:</strong> <?php echo e($correspondencia->referencia); ?></p>
        <p><strong>Fecha de recepción:</strong> <?php echo e(\Carbon\Carbon::parse($correspondencia->fecha)->format('d/m/Y')); ?></p>

        <p><strong>Estado del Trámite:</strong>
            <?php echo e(optional($correspondencia->derivaciones->last())->estado ?? 'No derivado a ningún funcionario'); ?></p>

        <h3 class="text-xl font-bold mt-4">Seguimiento del trámite</h3>
        <?php
            $seguimientosFiltrados = $correspondencia->seguimientos->filter(fn($s) => $s->accion !== 'busqueda');
        ?>

        <?php if($seguimientosFiltrados->isEmpty()): ?>
            <p class="text-gray-600">No hay historial registrado para este trámite.</p>
        <?php else: ?>
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
                    <?php $__currentLoopData = $seguimientosFiltrados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="border p-2"><?php echo e(\Carbon\Carbon::parse($seguimiento->fecha)->format('d/m/Y ')); ?></td>
                            <td class="border p-2"><?php echo e(ucfirst($seguimiento->accion)); ?></td>
                            <td class="border p-2"><?php echo e(optional($seguimiento->funcionario)->cargo ?? 'Desconocido'); ?></td>
                            <td class="border p-2"><?php echo e($seguimiento->comentario); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
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

<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Tramites\resultado-interno.blade.php ENDPATH**/ ?>