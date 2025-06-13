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
        <h2 class="text-xl font-semibold">Asignar Permisos a <?php echo e($user->name); ?></h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <form action="<?php echo e(route('usuarios.permisos.actualizar', $user->id)); ?>" method="POST" class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <h3 class="text-lg font-medium mb-2">Permisos disponibles</h3>
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="permissions[]" value="<?php echo e($permission->name); ?>"
                                   <?php echo e($user->hasPermissionTo($permission->name) ? 'checked' : ''); ?>

                                   class="form-checkbox">
                            <span class="ml-2"><?php echo e($permission->name); ?></span>
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginal738438d805b9baf2d1402d7b79c4fcbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal738438d805b9baf2d1402d7b79c4fcbf = $attributes; } ?>
<?php $component = App\View\Components\PrimaryButton::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PrimaryButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Guardar permisos <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal738438d805b9baf2d1402d7b79c4fcbf)): ?>
<?php $attributes = $__attributesOriginal738438d805b9baf2d1402d7b79c4fcbf; ?>
<?php unset($__attributesOriginal738438d805b9baf2d1402d7b79c4fcbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal738438d805b9baf2d1402d7b79c4fcbf)): ?>
<?php $component = $__componentOriginal738438d805b9baf2d1402d7b79c4fcbf; ?>
<?php unset($__componentOriginal738438d805b9baf2d1402d7b79c4fcbf); ?>
<?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\usuarios\permisos.blade.php ENDPATH**/ ?>