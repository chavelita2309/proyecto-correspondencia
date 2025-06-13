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
            <?php echo e(__('Libro de Correspondencia')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">📄 Generar Libro de Correspondencia</h2>

        <form action="<?php echo e(route('reportes.libro.generar')); ?>" method="POST" target="_blank">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="desde" class="block text-sm font-medium text-gray-700">Desde</label>
                    <input type="date" name="desde" id="desde" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label for="hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
                    <input type="date" name="hasta" id="hasta" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                
            </div>

            <div class="text-right">
                <button type="submit" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded shadow">
                    📄 Generar Libro
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\reportes\libro_form.blade.php ENDPATH**/ ?>