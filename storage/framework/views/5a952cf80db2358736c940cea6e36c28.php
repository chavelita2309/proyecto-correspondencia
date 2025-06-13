<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de correspondencia general</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333;
            padding: 5px;
            text-align: left;
            font-size: 11px;
            word-wrap: break-word;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>REPORTE GENERAL DE CORRESPONDENCIA RECIBIDA</h2>
    <p>Del: <?php echo e(\Carbon\Carbon::parse ($desde)->format('d/m/Y')); ?> &nbsp; Al: <?php echo e(\Carbon\Carbon::parse ($hasta)->format('d/m/Y')); ?></p>

    <table>
        <thead>
            <tr>
                <th>RUT</th>
                <th>Fecha</th>
                <th>Hora</th>
                
                <th>Gestión</th>
                <th>Destinatario</th>
                <th>Unidad</th>
                <th>Referencia</th>
                <th>Remitente</th>
                <th>Tipo</th>
                <th>Código</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $correspondencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($c->rut); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($c->fecha)->format('d/m/Y')); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($c->hora)->format('H:i')); ?></td>

                    
                    <td><?php echo e($c->gestion); ?></td>
                    <td><?php echo e($c->destinatario); ?></td>
                    <td><?php echo e($c->unidad); ?></td>
                    <td><?php echo e($c->referencia); ?></td>
                    <td><?php echo e($c->remitente); ?></td>
                    <td><?php echo e($c->tipo); ?></td>
                    <td><?php echo e($c->codigo); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="11" style="text-align: center;">No hay registros en este periodo.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Generado el <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>

    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\reportes\generar.blade.php ENDPATH**/ ?>