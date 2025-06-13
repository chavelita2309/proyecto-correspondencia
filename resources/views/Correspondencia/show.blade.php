<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web de Gestión de Correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>

<div class="container">
    <h2 class="mb-4">Detalle de Correspondencia</h2>

    <div class="card p-4">
        <h4 class="text-primary">Información de la Correspondencia</h4>
        <p><strong>RUT:</strong> {{ $correspondencia->rut }}</p>
        <p><strong>Fecha de recepción:</strong> {{ $correspondencia->fecha }}</p>
        <p><strong>Hora de recepción:</strong> {{ $correspondencia->hora }}</p>
        <p><strong>Fojas:</strong> {{ $correspondencia->fojas }}</p>
        <p><strong>Files:</strong> {{ $correspondencia->folder }}</p>
        <p><strong>Destinatario:</strong> {{ $correspondencia->destinatario }}</p>
        <p><strong>Unidad remitente:</strong> {{ $correspondencia->unidad }}</p>
        <p><strong>Referencia:</strong> {{ $correspondencia->referencia }}</p>
        <p><strong>Remitente:</strong> {{ $correspondencia->remitente }}</p>
        <p><strong>Teléfono:</strong> {{ $correspondencia->fono }}</p>
        <p><strong>Tipo de trámite:</strong> {{ ucfirst($correspondencia->tipo) }}</p>
    </div>

    <hr class="my-4">

    <h3>Historial de Derivaciones</h3>
    @if ($correspondencia->derivaciones->isEmpty())
        <p class="text-muted">No hay derivaciones registradas para esta correspondencia.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Prioridad</th>
                    <th>Funcionario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($correspondencia->derivaciones as $derivacion)
                    <tr>
                        <td>{{ $derivacion->fecha }}</td>
                        <td>{{ ucfirst($derivacion->proridad) }}</td>
                        <td>{{ $derivacion->funcionario->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <hr class="my-4">

    <h3>Derivar Correspondencia</h3>

    <!-- FORMULARIO PARA DERIVAR -->
    <form action="{{ route('derivacion.store', $correspondencia->id) }}" method="POST">
        @csrf
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
                @foreach ($funcionarios as $funcionario)
                    <option value="{{ $funcionario->id }}">{{ $funcionario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Derivar</button>
        <a href="{{ route('correspondencia.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
</x-app-layout>
