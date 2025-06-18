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

    <div class="py-6">
       
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('error')): ?>
                <div class="mb-4 text-sm text-red-600"><?php echo e(session('error')); ?></div>
            <?php endif; ?>
             <h2 class="text-xl font-semibold leading-tight text-gray-800">Buscar Correspondencia por Referencia</h2><br>
             
            <form method="GET" action="<?php echo e(route('tramites.buscarPorReferencia')); ?>">
                <div class="mb-4">
                    <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia:</label>
                    <input type="text" name="referencia" id="referencia" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="gestion" class="block text-sm font-medium text-gray-700">Gestión:</label>
                    <select name="gestion" id="gestion" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Todas --</option>
                        <?php for($anio = now()->year; $anio >= 2020; $anio--): ?>
                            <option value="<?php echo e($anio); ?>"><?php echo e($anio); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo predefinido:</label>
                    <select name="tipo" id="tipo" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Todos --</option>
                        <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tipo); ?>"><?php echo e(ucfirst($tipo)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Buscar
                </button>
            </form>

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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views/Tramites/buscar-referencia.blade.php ENDPATH**/ ?>