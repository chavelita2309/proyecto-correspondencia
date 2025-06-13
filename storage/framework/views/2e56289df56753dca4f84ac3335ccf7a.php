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
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Correspondencia registrada correctamente</h1>

        <p><strong>RUT:</strong> <?php echo e($correspondencia->rut); ?></p>
        <p><strong>Referencia:</strong> <?php echo e($correspondencia->referencia); ?></p>
        <p><strong>Remitente:</strong> <?php echo e($correspondencia->remitente); ?></p>
        <p><strong>Lugar de origen:</strong> <?php echo e($correspondencia->unidad); ?></p>
        <p><strong>Fecha de recepción:</strong> <?php echo e($correspondencia->fecha->format('d/m/Y')); ?></p>

        <div class="flex flex-wrap gap-2 mb-4">
            <a href="<?php echo e(route('correspondencia.imprimir_hoja_ruta', $correspondencia->id)); ?>" target="_blank"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Imprimir Hoja de Ruta
            </a>


            <a href="<?php echo e(route('correspondencia.index')); ?>"
                class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Volver a la lista
            </a>

            <!-- Derivar -->
            <a href="<?php echo e(route('derivacion.store', $correspondencia->id)); ?>"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 w-32 text-center rounded inline-block">
                Derivar
            </a>
        </div>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Correspondencia\confirmacion.blade.php ENDPATH**/ ?>