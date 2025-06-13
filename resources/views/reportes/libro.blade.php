<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de Correspondencia</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed; /* Fijar anchos de columnas */
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #92d2f0;
            font-size: 12px;
        }
        tr {
            height: 120px; /* hacer las filas más altas */
        }
        /* Anchos específicos de columnas */
        th:nth-child(1), td:nth-child(1) { width: 7%; }   /* Nro */
        th:nth-child(2), td:nth-child(2) { width: 7%; }  /* Fecha */
        th:nth-child(3), td:nth-child(3) { width: 11%; }  /* Destinatario */
        th:nth-child(4), td:nth-child(4) { width: 11%; }  /* Remitente */
        th:nth-child(5), td:nth-child(5) { width: 15%; }  /* Referencia  */
        th:nth-child(6), td:nth-child(6) { width: 4%; }  /* Fojas */
        th:nth-child(7), td:nth-child(7) { width: 18%; }  /* Sello 1 */
        th:nth-child(8), td:nth-child(8) { width: 18%; }  /* Sello 2  */

        .firma-sello {
            height: 120px;
            position: relative;
        }
        .firma-sello::after {
            /* content: "Firma y Sello"; */
            position: absolute;

            bottom: 4px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 9px;
            color: #1d1ad4;
        }
        h2, p {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Carrera de Ingeniería Textil</h1>
    <h2>LIBRO DE CORRESPONDENCIA {{ ucfirst($tipo) }}</h2>

    <table>
        <thead>
            <tr>
                <th>Nro.</th>
                <th>Fecha</th>
                <th>Destinatario</th>
                <th>Remitente</th>
                <th>Referencia</th>
                <th>Fojas</th>
                <th>Sello 1</th>
                <th>Sello 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach($correspondencias as $index => $item)
                <tr>
                    <td>{{ $item->rut }}</td>

                    <td>{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $item->destinatario }}</td>
                    <td>{{ $item->remitente }}<br> {{ $item->unidad }}</td>
                    <td>{{ $item->referencia }}</td>
                    <td>{{ $item->fojas }}</td>
                    <td class="firma-sello"></td> <!-- espacio para firma o sello -->
                    <td class="firma-sello"></td> <!-- espacio para firma o sello -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
