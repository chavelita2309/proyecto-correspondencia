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
    <p>Del: {{\Carbon\Carbon::parse ($desde)->format('d/m/Y') }} &nbsp; Al: {{ \Carbon\Carbon::parse ($hasta)->format('d/m/Y')}}</p>

    <table>
        <thead>
            <tr>
                <th>RUT</th>
                <th>Fecha</th>
                <th>Hora</th>
                {{-- <th>Emitida/
                    Recibida</th> --}}
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
            @forelse ($correspondencias as $c)
                <tr>
                    <td>{{ $c->rut }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->fecha)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->hora)->format('H:i') }}</td>

                    {{-- <td>{{ $c->tipo_registro }}</td> --}}
                    <td>{{ $c->gestion }}</td>
                    <td>{{ $c->destinatario }}</td>
                    <td>{{ $c->unidad }}</td>
                    <td>{{ $c->referencia }}</td>
                    <td>{{ $c->remitente }}</td>
                    <td>{{ $c->tipo }}</td>
                    <td>{{ $c->codigo }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align: center;">No hay registros en este periodo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>
</body>
</html>
