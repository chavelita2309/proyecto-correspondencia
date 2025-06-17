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

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg" x-data="{ showHistorial: false }">
        <h2 class="text-2xl font-bold text-center mb-4">Detalles del Trámite</h2>

        <p><strong>Código de Seguimiento:</strong> <?php echo e($correspondencia->codigo); ?></p>
        <p><strong>Hoja de ruta:</strong> <?php echo e($correspondencia->rut); ?></p>
        <p><strong>Referencia:</strong> <?php echo e($correspondencia->referencia); ?></p>
        <p><strong>Fecha de recepción:</strong> <?php echo e(\Carbon\Carbon::parse($correspondencia->fecha)->format('d/m/Y')); ?></p>

        
        <?php if($seguimientos->isNotEmpty()): ?>
            <?php
                $ultimo = $seguimientos->last();
            ?>
            <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-blue-800 text-lg font-semibold mb-2">Estado actual del Trámite:</p>
                <p><strong>Fecha:</strong> <?php echo e($ultimo->fecha->format('d/m/Y ')); ?></p>
                <p><strong>Estado:</strong> <?php echo e(ucfirst($ultimo->accion)); ?></p>
                <p><strong>Funcionario:</strong> <?php echo e(optional($ultimo->funcionario)->cargo ?? 'Usuario público'); ?></p>
                <p><strong>Comentario:</strong> <?php echo e($ultimo->comentario ?? 'Sin comentario'); ?></p>
            </div>
        <?php else: ?>
            <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                <p class="text-yellow-800 text-lg font-semibold">Estado actual del Trámite:</p>
                <p>No hay seguimiento registrado para este trámite.</p>
            </div>
        <?php endif; ?>

        
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

        
        <div x-show="showHistorial" x-cloak class="mt-4">
            <h3 class="text-xl font-bold mt-4">Seguimiento del Trámite</h3>

            <?php if($seguimientos->isEmpty()): ?>
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
                        <?php $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border p-2"><?php echo e($seguimiento->fecha->format('d/m/Y ')); ?></td>
                                <td class="border p-2"><?php echo e(ucfirst($seguimiento->accion)); ?></td>
                                <td class="border p-2">
                                    <?php echo e(optional($seguimiento->funcionario)->cargo ?? 'Usuario público'); ?>

                                </td>
                                <td class="border p-2"><?php echo e($seguimiento->comentario); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-8 flex justify-center">
            <a href="<?php echo e(route('login')); ?>"
                class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900 transition">
                Iniciar Sesión
            </a>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views/tramites/resultado.blade.php ENDPATH**/ ?>