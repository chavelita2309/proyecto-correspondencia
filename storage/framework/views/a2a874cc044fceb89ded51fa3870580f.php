<!DOCTYPE html>
<html>
<head>
    <title>Alerta de Trámite Retenido</title>
</head>
<body>
    <h1>Alerta: Trámite retenido</h1>
    <p>Estimado director,</p>
    <p>Se ha detectado un trámite retenido por más de 48 horas.</p>

    <ul>
        <li><strong>Trámite:</strong> <?php echo e($correspondencia->codigo ?? 'N/A'); ?></li>
        <li><strong>Asunto:</strong> <?php echo e($correspondencia->referencia ?? 'N/A'); ?></li>
        <li><strong>Funcionario responsable:</strong> <?php echo e($funcionario->cargo ?? 'N/A'); ?></li>
        <li><strong>Tiempo de retención:</strong> <?php echo e($horasRetenidas ?? 'N/A'); ?> horas</li>
    </ul>

    <p>Por favor, tome las medidas correspondientes.</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\emails\alerta_retencion.blade.php ENDPATH**/ ?>