<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hoja de Ruta - <?php echo e($correspondencia->codigo); ?></title>
    <style>
        @page {
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 10mm;
            padding: 0;
            font-size: 9pt;
            /* Fuente más pequeña */
        }

        .hoja-de-ruta-container {
            width: 100%;
            border: 1px solid #000;
            padding: 5mm;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #000;
            /* Borde más delgado */
            padding-bottom: 3mm;
            margin-bottom: 5mm;
            /* Margen más pequeño */
        }

        .header .logo img {
            height: 15mm;
            /* Logo más pequeño */
        }

        .header .title-section {
            text-align: center;
            flex-grow: 1;
            margin-left: 5mm;
        }

        .header .title-section h1 {
            margin: 0;
            font-size: 14pt;
            /* Título más pequeño */
            color: #000080;
            text-transform: uppercase;
        }

        .header .title-section h2 {
            margin: 2mm 0 0;
            font-size: 10pt;
            /* Subtítulo más pequeño */
            color: #000080;
        }

        .header .info-right {
            text-align: right;
            font-size: 8pt;
            /* Información derecha más pequeña */
            font-weight: bold;
            line-height: 1.2;
            /* Interlineado más ajustado */
        }

        .main-info {
            border: 1px solid #000;
            padding: 3mm;
            /* Padding más pequeño */
            margin-bottom: 5mm;
        }

        .main-info .row {
            display: flex;
            margin-bottom: 1mm;
            /* Margen más pequeño entre filas */
        }

        .main-info .field {
            flex: 1;
            display: flex;
            align-items: baseline;
            font-size: 6pt;
            white-space: nowrap;
            margin-right: 3mm;
        }

        .main-info .field label {
            font-weight: bold;
            margin-right: 1mm;
        }

        .main-info .field.wide {
            flex: 2;
        }

        .main-info .field span {
            flex-grow: 1;
        }

        .destination-block {
            border: 1px solid #000;
            margin-bottom: 5mm;
        }

        .destination-block .destination-header {
            background-color: #f0f0f0;
            padding: 2mm 5mm;
            font-weight: bold;
            font-size: 7pt;
            border-bottom: 1px solid #000;
        }

        .destination-block .instruction-content {
            display: flex;
        }

        .destination-block .instructions-list {
            flex: 2;
            padding: 3mm 5mm;
            border-right: 1px solid #000;
        }

        .destination-block .instructions-list h3 {
            margin-top: 0;
            font-size: 7pt;
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 2mm;
            margin-bottom: 3mm;
        }

        .destination-block .instructions-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .destination-block .instructions-list li {
            margin-bottom: 2mm;
            font-size: 7pt;
        }

        .destination-block .instructions-list .checkbox {
            display: inline-block;
            width: 3mm;
            height: 3mm;
            border: 1px solid #000;
            margin-right: 2mm;
            vertical-align: middle;
            text-align: center;
            line-height: 2.5mm;
            font-size: 7pt;
        }

        .destination-block .signature-stamp {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .destination-block .signature-stamp .box {
            flex: 1;
            border-bottom: 1px solid #000;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 2mm;
            height: 25mm;
            /* Espacio más pequeño para firma/sello */
            box-sizing: border-box;
        }

        .destination-block .signature-stamp .box:last-child {
            border-bottom: none;
        }

        .destination-block .signature-stamp .box p {
            margin: 0;
            font-size: 7pt;
            font-weight: bold;
            text-align: center;
        }

        /* Flexbox fallbacks */
        .header,
        .main-info .row,
        .destination-block .instruction-content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .header>*,
        .main-info .field,
        .destination-block .instructions-list,
        .destination-block .signature-stamp {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        .main-info .field.wide {
            -webkit-box-flex: 2;
            -ms-flex: 2;
            flex: 2;
        }

        .instruction-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .instructions-column-content {
            width: 40%;
            vertical-align: top;
            border-right: 1px solid #000;
            padding: 3mm;
        }

        .signature-column-content,
        .stamp-column-content {
            width: 30%;
            vertical-align: top;
            border-right: 1px solid #000;
            padding: 3mm;
        }

        .stamp-column-content {
            border-right: none;
        }

        .signature-box,
        .stamp-box {
            height: 25mm;
            border: 1px solid #000;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 2mm;
            box-sizing: border-box;
        }

        .signature-box p,
        .stamp-box p {
            margin: 0;
            font-size: pt;
            font-weight: bold;
            text-align: center;
        }

        .instruction-header {
            background-color: gray;
            color: white;
            padding: 2px 5px;
            font-size: 0.8em;
            display: inline-block;
            margin-bottom: 5px;
        }

        .instruction-list-no-bullets {
            list-style-type: none;
            /* ¡Esta es la clave para quitar todas las viñetas! */
            padding: 0;
            /* Elimina el padding izquierdo por defecto de la lista */
            margin: 0;
            /* Elimina el margen por defecto de la lista */
        }

        .instruction-list-no-bullets li {
            font-size: 0.7em;
            /* Letras pequeñas para los elementos del listado */
            margin-bottom: 3px;
            /* Pequeño espacio entre cada elemento del listado */
        }

        .instructions-column-content {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="hoja-de-ruta-container">
        <table width="100%" style="margin-bottom: 20px; border-bottom: 2px solid #000;">
            <tr>
                <!-- Columna 1: Logo + Nombre de la universidad -->
                <td width="8%" style="text-align: left; center-align: top;">
                    <img src="<?php echo e(public_path('images/logo_upea.png')); ?>" alt="Logo UPEA" style="height: 60px;"><br>

                </td>
                <td width="22%" style="text-align: center; center-align: top;">

                    <span style="font-size: 14px; font-weight: bold;">UNIVERSIDAD PÚBLICA DE EL ALTO</span>
                </td>

                <!-- Columna 2: Título central -->
                <td width="40%" style="text-align: center; vertical-align: top;">
                    <span style="font-size: 20px; font-weight: bold; ">HOJA DE RUTA</span><br>
                    <span style="font-size: 14px; font-weight: bold;"><?php echo e($department_name); ?></span>
                </td>

                <!-- Columna 3: Número y Gestión -->
                <td width="20%" style="text-align: right; vertical-align: top;">
                    <span style="font-size: 10px;">N° HOJA DE RUTA: <?php echo e($correspondencia->rut); ?></span><br>
                    <span style="font-size: 10px;">GESTIÓN:
                        <?php echo e($correspondencia->anio ?? \Carbon\Carbon::parse($correspondencia->fecha)->year); ?></span>
                </td>
            </tr>
        </table>


        <section class="main-info">
            <table class="main-info-table">
                <tbody>
                    <tr>
                        <td class="main-info-field">
                            <label>Fecha de recepción:</label>
                            <span><?php echo e($correspondencia->fecha->format('d/m/Y')); ?></span>
                        </td>
                        <td class="main-info-field">
                            <label>Hora de recepción.:</label>
                            <span><?php echo e($correspondencia->hora->format('H:i')); ?></span>
                        </td>
                        <td class="main-info-field">
                            <label>Código de seguimiento:</label>
                            <span><?php echo e($correspondencia->codigo); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="main-info-field">
                            <label>N° de Files:</label>
                            <span><?php echo e($correspondencia->folder); ?></span>
                        </td>
                        <td class="main-info-field">
                            <label>N° de Fojas:</label>
                            <span><?php echo e($correspondencia->fojas); ?></span>
                        </td>
                        <td class="main-info-field">
                            <label>Teléfono:</label>
                            <span><?php echo e($correspondencia->fono ?? ''); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="main-info-field" colspan="2"> 
                            <label>Remitente:</label>
                            <span><?php echo e($correspondencia->remitente); ?></span>
                        </td>
                        <td class="main-info-field" colspan="2"> 
                            <label>Lugar de origen:</label>
                            <span><?php echo e($correspondencia->unidad ?? ''); ?></span>
                        </td>
                    </tr>
                   

                    <tr>
                        <td class="main-info-field" colspan="3"> 
                            <label>Referencia:</label>
                            <span><?php echo e($correspondencia->referencia); ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <?php for($i = 0; $i < 3; $i++): ?>
            <section class="destination-block">
                <div class="destination-header">DESTINO N° <?php echo e($i + 1); ?></div>
                <table class="instruction-table">
                    <tr>
                        <td class="instructions-column-content">
                            <span class="instruction-header">INSTRUCCIÓN Nº <?php echo e($i + 1); ?></span>
                            <ul class="instruction-list-no-bullets">
                                <li>PARA SU CONOCIMIENTO</li>
                                <li>ANALIZAR Y EMITIR INFORME</li>
                                <li>REVISAR Y EMITIR INFORME</li>
                                <li>PROCESAR DE ACUERDO A NORMAS</li>
                                <li>PREPARAR ANTECEDENTES</li>
                                <li>AGENDAR REUNIÓN</li>
                                <li>PREPARAR RESPUESTA</li>
                                <li>ARCHÍVESE</li>
                                <li>OTRO</li>
                            </ul>


                        </td>
                        <td class="signature-column-content">

                            <p>FIRMA</p>

                        </td>
                        <td class="stamp-column-content">

                            <p>SELLO DE RECEPCIÓN</p>

                        </td>
                    </tr>
                </table>

            </section>
        <?php endfor; ?>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views\reportes\hoja_de_ruta_individual.blade.php ENDPATH**/ ?>