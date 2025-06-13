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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Hoja de Ruta')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
        <form action="<?php echo e(route('reportes.hoja.generar')); ?>" method="POST" target="_blank">
            <?php echo csrf_field(); ?>
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <input type="date" name="desde" class="border rounded px-3 py-2" required>
                <input type="date" name="hasta" class="border rounded px-3 py-2" required>

                <select name="tipo_registro" class="border rounded px-3 py-2">
                    <option value="">-- Todos los tipos --</option>
                    <option value="emitida">Emitida</option>
                    <option value="recibida">Recibida</option>
                </select>

                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                    Generar Hoja de Ruta
                </button>
            </div>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\reportes\hoja_form.blade.php ENDPATH**/ ?>