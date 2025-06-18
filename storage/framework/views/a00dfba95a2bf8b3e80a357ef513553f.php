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

    <div class="container mx-auto p-4" x-data="{ tab: 'recibidos' }">
        <h1 class="text-xl font-bold mb-4">📂 Mis Trámites</h1>

        <?php if(session('message')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>

        <!-- Botones de pestaña -->
        <div class="flex gap-4 mb-6">
            <button @click="tab = 'pendientes'" :class="tab === 'pendientes' ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-4 py-2 rounded relative flex items-center gap-2">
                🔄 Pendientes

                
                <?php if($pendientesCriticos > 0): ?>
                    <span class="absolute -top-1 -right-1 animate-ping bg-red-500 rounded-full h-4 w-4"></span>
                    <span class="absolute -top-1 -right-1 bg-red-500 rounded-full h-4 w-4"></span>
                <?php elseif($pendientesAdvertencia > 0): ?>
                    <span class="absolute -top-1 -right-1 animate-ping bg-yellow-400 rounded-full h-4 w-4"></span>
                    <span class="absolute -top-1 -right-1 bg-yellow-400 rounded-full h-4 w-4"></span>
                <?php endif; ?>
            </button>
            <button @click="tab = 'recibidos'" :class="tab === 'recibidos' ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-4 py-2 rounded relative flex items-center gap-2">
                📥 Recibidos
                
                <?php if($recibidosCriticos > 0): ?>
                    <span class="absolute -top-1 -right-1 animate-ping bg-red-500 rounded-full h-4 w-4"></span>
                    <span class="absolute -top-1 -right-1 bg-red-500 rounded-full h-4 w-4"></span>
                <?php elseif($recibidosAdvertencia > 0): ?>
                    <span class="absolute -top-1 -right-1 animate-ping bg-yellow-400 rounded-full h-4 w-4"></span>
                    <span class="absolute -top-1 -right-1 bg-yellow-400 rounded-full h-4 w-4"></span>
                <?php endif; ?>
            </button>

            <button @click="tab = 'concluidos'" :class="tab === 'concluidos' ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-4 py-2 rounded">
                ✅ Archivados
            </button>
        </div>
        <!-- Pendientes -->
        <div x-show="tab === 'pendientes'" x-transition>
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Nº. Hoja de ruta</th>
                        <th class="p-2 border">Referencia</th>
                        <th class="p-2 border">Fecha</th>
                        <th class="p-2 border">Retención</th>
                        <th class="p-2 border">Código de seguimiento</th>
                        <th class="p-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pendientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $dias = FechaHelper::diasHabilesTranscurridos($item->fecha);
                            $color = $dias > 7 ? 'bg-red-200' : ($dias > 2 ? 'bg-yellow-200' : '');
                            $fecha = \Carbon\Carbon::parse($item->fecha);
                        ?>

                        <tr class="<?php echo e($color); ?>">
                            <td class="p-2 border"><?php echo e($item->correspondencia->rut); ?></td>
                            <td class="p-2 border"><?php echo e($item->correspondencia->referencia); ?></td>
                            <td class="p-2 border"><?php echo e($fecha->format('d/m/Y')); ?></td>
                            <td class="p-2  flex items-center gap-3">
                                <?php echo e($dias); ?> días hábiles
                                <?php if($dias > 7): ?>
                                    <span class="relative">
                                        <span
                                            class="absolute animate-ping bg-red-500 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                        <span class="absolute bg-red-500 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                    </span>
                                <?php elseif($dias > 2): ?>
                                    <span class="relative">
                                        <span
                                            class="absolute animate-ping bg-yellow-400 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                        <span
                                            class="absolute bg-yellow-400 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                    </span>
                                <?php endif; ?>
                            </td>

                            
                            <td class="p-2 border"><?php echo e($item->correspondencia->codigo); ?></td>
                            <td class="p-2 border flex gap-2">
                                <div class="flex space-x-2">
                                    <form method="POST" action="<?php echo e(route('tramites.accion')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="derivacion_id" value="<?php echo e($item->id); ?>">
                                        <button name="accion" value="recibido"
                                            class="inline-flex items-center justify-center w-20 h-10 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded transition duration-300">
                                            Recibir
                                        </button>
                                    </form>

                                    <form method="POST" action="<?php echo e(route('tramites.accion')); ?>"
                                        onsubmit="return confirmarComentario(this)">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="derivacion_id" value="<?php echo e($item->id); ?>">
                                        <input type="hidden" name="accion" value="concluido">
                                        <input type="hidden" name="comentario">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-20 h-10 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded transition duration-300">
                                            Archivar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="p-2 text-center">No hay trámites pendientes.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Recibidos -->
        <div x-show="tab === 'recibidos'" x-transition>
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Nº. Hoja de ruta</th>
                        <th class="p-2 border">Referencia</th>
                        <th class="p-2 border">Fecha</th>
                        <th class="p-2 border">Retención</th>
                        <th class="p-2 border">Código de seguimiento</th>
                        <th class="p-2 border">Acciones</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recibidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $dias = FechaHelper::diasHabilesTranscurridos($item->fecha);
                            $color = $dias > 7 ? 'bg-red-200' : ($dias > 2 ? 'bg-yellow-200' : '');
                            $fecha = \Carbon\Carbon::parse($item->fecha);
                        ?>
                        <tr class="<?php echo e($color); ?>">
                            <td class="p-2 border"><?php echo e($item->correspondencia->rut); ?>


                            </td>
                            <td class="p-2 border"><?php echo e($item->correspondencia->referencia); ?></td>
                            <td class="p-2 border"><?php echo e($item->fecha->format('d/m/Y')); ?></td>
                            <td class="p-2  flex items-center gap-3">
                                <?php echo e($dias); ?> días hábiles
                                <?php if($dias > 7): ?>
                                    <span class="relative">
                                        <span
                                            class="absolute animate-ping bg-red-500 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                        <span class="absolute bg-red-500 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                    </span>
                                <?php elseif($dias > 2): ?>
                                    <span class="relative">
                                        <span
                                            class="absolute animate-ping bg-yellow-400 rounded-full h-2 w-2 -top-1 -right-1"></span>
                                        <span
                                            class="absolute bg-yellow-400 rounded-full h-3 w-3 -top-1 -right-1"></span>
                                    </span>
                                <?php endif; ?>
                            </td>

                            
                            <td class="p-2 border"><?php echo e($item->correspondencia->codigo); ?></td>
                            <td class="p-2 border flex gap-2">
                                <div class="flex space-x-2">
                                    <a href="<?php echo e(route('derivacion.store', $item->correspondencia->id)); ?>">
                                        <button
                                            class="inline-flex items-center justify-center w-20 h-10 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded transition duration-300">
                                            Derivar
                                        </button>
                                    </a>

                                    <form method="POST" action="<?php echo e(route('tramites.accion')); ?>"
                                        onsubmit="return confirmarComentario(this)">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="derivacion_id" value="<?php echo e($item->id); ?>">
                                        <input type="hidden" name="accion" value="concluido">
                                        <input type="hidden" name="comentario">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-20 h-10 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded transition duration-300">
                                            Archivar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="p-2 text-center">No hay trámites recibidos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>


        <!-- Concluidos -->
        <div x-show="tab === 'concluidos'" x-transition>
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Nº. Hoja de ruta</th>
                        <th class="p-2 border">Referencia</th>
                        <th class="p-2 border">Fecha</th>
                        <th class="p-2 border">Código de seguimiento</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $concluidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="p-2 border"><?php echo e($item->correspondencia->rut); ?></td>
                            <td class="p-2 border"><?php echo e($item->correspondencia->referencia); ?></td>
                            <td class="p-2 border"><?php echo e($item->fecha->format('d/m/Y')); ?></td>
                            <td class="p-2 border"><?php echo e($item->correspondencia->codigo); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="p-2 text-center">No hay trámites concluidos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Script para solicitar comentario -->
    <script>
        function confirmarComentario(form) {
            let comentario = prompt("Por favor ingrese un comentario para concluir el trámite:");
            if (!comentario || comentario.trim() === "") {
                alert("El comentario es obligatorio.");
                return false;
            }
            form.comentario.value = comentario.trim();
            return true;
        }
    </script>

    <pre>

</pre>


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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views/tramites/bandeja.blade.php ENDPATH**/ ?>