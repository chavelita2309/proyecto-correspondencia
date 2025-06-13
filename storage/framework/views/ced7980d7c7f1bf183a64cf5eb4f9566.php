<?php
    use Carbon\Carbon;
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

    <div class="container size-11/12 m-auto">
        <br>

        <!-- Tabla -->
        <table class="min-w-full border-collapse block md:table">
            <thead class="block md:table-header-group">
                <tr
                    class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Hoja de ruta</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Referencia</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Remitente</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Fecha de remisión</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Documento</th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Código de seguimiento</th>
                    
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Operaciones</th>
                </tr>
            </thead>

            <tbody class="block md:table-row-group">
                <?php $__currentLoopData = $correspondencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    


                    <tr class=" border border-gray-500 md:border-none block md:table-row">
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hoja de ruta</span>
                            <a href="<?php echo e(route('correspondencia.mostrar', $cor->id)); ?>"><?php echo e($cor->rut); ?></a>
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Referencia</span><?php echo e($cor->referencia); ?>

                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Remitente</span><?php echo e($cor->remitente); ?>

                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Fecha de
                                remisión</span><?php echo e(\Carbon\Carbon::parse($cor->fecha)->format('d/m/Y')); ?>

                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell w-32 truncate">
                            <span class="inline-block w-1/3 md:hidden font-bold">Documento</span>
                            <a href="<?php echo e(asset('archivos/' . $cor->documento)); ?>" class="text-blue-600 underline"
                                target="_blank" rel="noopener noreferrer">
                                <?php echo e($cor->documento); ?>

                            </a>
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell relative">
                            <span class="inline-block w-1/3 md:hidden font-bold">Código</span>
                            <?php echo e($cor->codigo); ?>


                          

                        </td>

                        


                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Operaciones</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="<?php echo e(route('correspondencia.mostrar', $cor->id)); ?>"
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-1 w-24 text-center rounded inline-block">Ver</a>

                                <a href="<?php echo e(route('derivacion.store', $cor->id)); ?>"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 w-24 text-center rounded inline-block">Derivar</a>

                                <a href="<?php echo e(route('correspondencia.editar', $cor)); ?>"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 w-24 text-center rounded inline-block">Editar</a>

                                <form action="<?php echo e(route('correspondencia.borrar', $cor->id)); ?>" method="POST"
                                    onsubmit="return confirmarEliminacion('<?php echo e($cor->rut); ?>')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 w-24 text-center rounded">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <?php echo e($correspondencia->links()); ?>


    <script>
        function confirmarEliminacion(rut) {
            return confirm('¿Desea eliminar el registro: ' + rut + '?');
        }
    </script>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Correspondencia\index.blade.php ENDPATH**/ ?>