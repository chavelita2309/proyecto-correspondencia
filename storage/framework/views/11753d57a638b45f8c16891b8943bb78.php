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
            <?php echo e(__('Gestión de Usuarios')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <?php if(session('success')): ?>
                <div class="mb-4 text-green-600 bg-green-100 p-3 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="mb-4 text-red-600 bg-red-100 p-3 rounded">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            
            <div class="mb-4">
                <a href="<?php echo e(route('usuarios.create')); ?>"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                    + Registrar Usuario
                </a>
            </div>

            
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 py-2"><?php echo e($usuario->name); ?></td>
                                <td class="px-4 py-2"><?php echo e($usuario->email); ?></td>

                                
<td class="px-4 py-2">
    <form action="<?php echo e(route('usuarios.cambiarRol', $usuario->id)); ?>" method="POST"
        class="flex items-center space-x-2">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <select name="role_id"
            class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($rol->id); ?>"
                    <?php echo e($usuario->roles->first()?->id == $rol->id ? 'selected' : ''); ?>>
                    <?php echo e($rol->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit"
            class="inline-flex items-center justify-center w-20 h-9 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition duration-200">
            Guardar
        </button>
    </form>
</td>


<td class="px-4 py-2 text-right">
    <div class="flex justify-end space-x-2">
        
        <a href="<?php echo e(route('usuarios.edit', $usuario->id)); ?>"
            class="inline-flex items-center justify-center w-20 h-9 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition duration-200">
            Editar
        </a>

        
        <?php if(!$usuario->roles->contains('name', 'superadmin')): ?>
            <form action="<?php echo e(route('usuarios.destroy', $usuario->id)); ?>" method="POST"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit"
                    class="inline-flex items-center justify-center w-20 h-9 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition duration-200">
                    Eliminar
                </button>
            </form>
        <?php endif; ?>
    </div>
</td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No hay usuarios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\usuarios\index.blade.php ENDPATH**/ ?>