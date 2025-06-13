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
            <?php echo e(__('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA')); ?>

        </h2>
     <?php $__env->endSlot(); ?>


    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center">Buscar Trámite</h2>


        <?php if(session('error')): ?>
            <div class="text-red-500"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('tramite.buscar')); ?>" method="GET">
            <label class="block text-sm font-medium">Introduzca el código de Seguimiento:</label>
            <input type="text" name="codigo" class="w-full p-2 border rounded" required>

            <button type="submit" class="w-full mt-4 p-2 bg-blue-500 text-white rounded">Buscar</button>
        </form>

        <div class="mt-8 flex justify-center">
            <a href="<?php echo e(route('login')); ?>"
                class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900 transition">
                Iniciar Sesión
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Tramites\buscar.blade.php ENDPATH**/ ?>