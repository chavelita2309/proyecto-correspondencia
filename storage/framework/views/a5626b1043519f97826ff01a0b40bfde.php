<?php
    use App\Helpers\FechaHelper;
?>

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

    <section class="antialiased bg-gray-100 text-gray-600 min-h-screen px-4 py-6">
        <div class="flex flex-col justify-superior">
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-green-800 text-lg">📥 Trámites recibidos</h2>
                </header>
                <div class="p-3 overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 text-left">Hoja de ruta</th>
                                <th class="p-2 text-left">Referencia</th>
                                <th class="p-2 text-left">Fecha</th>
                                <th class="p-2 text-left">Retención</th>
                                <th class="p-2 text-left">Funcionario</th>
                                <th class="p-2 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $tramites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tramite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $dias = FechaHelper::diasHabilesTranscurridos($tramite->fecha);
                                    $color = $dias > 7 ? 'bg-red-100' : ($dias > 2 ? 'bg-yellow-100' : '');
                                    $fecha = \Carbon\Carbon::parse($tramite->fecha)->format('d/m/Y');
                                ?>
                                <tr class="<?php echo e($color); ?>">
                                    <td class="p-2"><?php echo e($tramite->correspondencia->rut); ?></td>
                                    <td class="p-2"><?php echo e($tramite->correspondencia->referencia ?? '-'); ?></td>
                                    <td class="p-2"><?php echo e($fecha); ?></td>
                                    <td class="p-2 flex items-center gap-2">
                                        <?php echo e($dias); ?> días hábiles
                                        <?php if($dias > 7): ?>
                                            <span class="relative">
                                                <span class="absolute animate-ping bg-red-500 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                                <span class="absolute bg-red-500 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                            </span>
                                        <?php elseif($dias > 2): ?>
                                            <span class="relative">
                                                <span class="absolute animate-ping bg-yellow-400 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                                <span class="absolute bg-yellow-400 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-2"><?php echo e($tramite->funcionario->cargo ?? 'Sin cargo'); ?></td>
                                    <td class="p-2 text-center">
                                        <a href="<?php echo e(route('correspondencia.mostrar', $tramite->correspondencia->id)); ?>"
                                           class="text-blue-600 hover:underline">Ver</a>
                                    </td> 
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">No hay trámites recibidos.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
         <?php echo e($tramites->links()); ?>;
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Tramites\recibidos.blade.php ENDPATH**/ ?>