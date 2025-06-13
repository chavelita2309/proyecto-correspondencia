<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema de gestión de correspondencia Ingeniería Textil UPEA') }}
        </h2>
    </x-slot>
<div class="max-w-2xl mx-auto p-6 mt-10 bg-white shadow-md rounded-2xl">
    @if(session('mensaje'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">
            {{ session('mensaje') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Verificar retención de trámites</h2>

    <p class="text-gray-600 mb-6">
        Este botón permite revisar si algún funcionario ha retenido un trámite por más de 48 horas. Si es así, se enviará una alerta automática al director de carrera.
    </p>

    {{-- <form action="{{ route('alertas.verificar.ejecucion') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-xl shadow">
            Verificar Retenciones
        </button> --}}
    </form>
</div>
</x-app-layout>
