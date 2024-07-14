@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Formas de pago</h1>
    <div class="mb-4">
        <button onclick="document.getElementById('modal').classList.remove('hidden')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar forma de pago</button>
    </div>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nombre</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formasdepago as $valor)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $valor->tipo }}</td>
                    <td class="py-2 px-4 border-b">
                        <button onclick="editTipo({{ $valor }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Editar</button>
                        <form action="{{ route('formasdepago.destroy', $valor) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center overflow-auto hidden">
        <div class="bg-white p-2 rounded-lg shadow-lg max-h-full max-w-md w-full">
            <h2 id="modal-title" class="text-xl font-bold mb-4">Agregar forma de pago</h2>
            <form id="pago-form" method="POST" action="{{ route('formasdepago.store') }}">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <div class="mb-4">
                    <label class="block text-gray-700">Tipo</label>
                    <input type="text" id="nombre_tipo" name="nombre_tipo" class="w-full p-2 border rounded" required>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editTipo(tipoPago) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal-title').innerText = 'Editar tipo de pago';
        document.getElementById('nombre_tipo').value = tipoPago.tipo;
        document.getElementById('pago-form').action = '/formasdepago/' + tipoPago.id;
        document.getElementById('method').value = 'PUT';
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal-title').innerText = 'Agregar forma de pago';
        document.getElementById('nombre_tipo').value = '';
        document.getElementById('pago-form').action = '{{ route('formasdepago.store') }}';
        document.getElementById('method').value = 'POST';
    }
</script>
@endsection
