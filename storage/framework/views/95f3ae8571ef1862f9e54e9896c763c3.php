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

<div class="container">
    <h2 class="mb-4">Detalle de Correspondencia</h2>

    <div class="card p-4">
        <h4 class="text-primary">Información de la Correspondencia</h4>
        <p><strong>RUT:</strong> <?php echo e($correspondencia->rut); ?></p>
        <p><strong>Fecha de recepción:</strong> <?php echo e($correspondencia->fecha); ?></p>
        <p><strong>Hora de recepción:</strong> <?php echo e($correspondencia->hora); ?></p>
        <p><strong>Fojas:</strong> <?php echo e($correspondencia->fojas); ?></p>
        <p><strong>Files:</strong> <?php echo e($correspondencia->folder); ?></p>
        <p><strong>Destinatario:</strong> <?php echo e($correspondencia->destinatario); ?></p>
        <p><strong>Unidad remitente:</strong> <?php echo e($correspondencia->unidad); ?></p>
        <p><strong>Referencia:</strong> <?php echo e($correspondencia->referencia); ?></p>
        <p><strong>Remitente:</strong> <?php echo e($correspondencia->remitente); ?></p>
        <p><strong>Teléfono:</strong> <?php echo e($correspondencia->fono); ?></p>
        <p><strong>Tipo de trámite:</strong> <?php echo e(ucfirst($correspondencia->tipo)); ?></p>
    </div>

    <hr class="my-4">

    <h3>Historial de Derivaciones</h3>
    <?php if($correspondencia->derivaciones->isEmpty()): ?>
        <p class="text-muted">No hay derivaciones registradas para esta correspondencia.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Prioridad</th>
                    <th>Funcionario</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $correspondencia->derivaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $derivacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($derivacion->fecha); ?></td>
                        <td><?php echo e(ucfirst($derivacion->proridad)); ?></td>
                        <td><?php echo e($derivacion->funcionario->nombre); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <hr class="my-4">

    <h3>Derivar Correspondencia</h3>

    <!-- FORMULARIO PARA DERIVAR -->
    <form action="<?php echo e(route('derivacion.store', $correspondencia->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label">Fecha:</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prioridad:</label>
            <select name="proridad" class="form-control" required>
                <option value="alta">Alta</option>
                <option value="regular">Regular</option>
            </select>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Funcionario:</label>
            <select name="funcionario_id" class="form-control" required>
                <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($funcionario->id); ?>"><?php echo e($funcionario->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Derivar</button>
        <a href="<?php echo e(route('correspondencia.index')); ?>" class="btn btn-secondary">Volver</a>
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
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\Correspondencia\show.blade.php ENDPATH**/ ?>