@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Ventas</h1>
    <div class="mb-4">
        <button onclick="document.getElementById('modal').classList.remove('hidden')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Venta</button>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Producto</th>
                <th class="py-2 px-4 border-b">Categoría</th>
                <th class="py-2 px-4 border-b">Cliente</th>
                <th class="py-2 px-4 border-b">Tipo de pago</th>
                <th class="py-2 px-4 border-b">Fecha de Venta</th>
                <th class="py-2 px-4 border-b">Subtotal</th>
                <th class="py-2 px-4 border-b">IVA</th>
                <th class="py-2 px-4 border-b">Total</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $venta->producto->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->categoria->nombre_categoria }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->cliente->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->pago->tipo }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->fecha_venta }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->subtotal }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->iva }}</td>
                    <td class="py-2 px-4 border-b">{{ $venta->total }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="#" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded editVenta" data-id="{{ $venta->id_venta }}">Editar</a>
                        <form method="POST" action="{{ route('ventas.destroy', $venta->id_venta) }}" class="inline-block">
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
        <div class="bg-white p-4 rounded-lg shadow-lg max-h-full max-w-md w-full">
            <h2 class="text-xl font-bold mb-4" id="modalTitle">Agregar Venta</h2>
            <form id="ventaForm" method="POST" action="{{ route('ventas.store') }}">
                @csrf
                <input type="hidden" name="id_venta" id="id_venta">
                <div class="mb-4">
                    <label class="block text-gray-700">Producto</label>
                    <select name="producto_id" id="producto_id" class="w-full p-2 border rounded" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="w-full p-2 border rounded" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="w-full p-2 border rounded" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tipo de pago</label>
                    <select name="cliente_id" id="cliente_id" class="w-full p-2 border rounded" required>
                        <option value="">Seleccione un tipo de pago</option>
                        @foreach($pagos as $pago)
                            <option value="{{ $pago->id }}">{{ $pago->tipo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Fecha de Venta</label>
                    <input type="date" name="fecha_venta" id="fecha_venta" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Subtotal</label>
                    <input type="number" name="subtotal" id="subtotal" step="0.01" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">IVA</label>
                    <input type="number" name="iva" id="iva" step="0.01" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Total</label>
                    <input type="number" name="total" id="total" step="0.01" class="w-full p-2 border rounded" required>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="document.getElementById('modal').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editVenta').forEach(function (button) {
            button.addEventListener('click', function () {
                var id_venta = this.getAttribute('data-id');
                fetch(`{{ url('ventas') }}/${id_venta}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalTitle').innerText = 'Editar Venta';
                        document.getElementById('id_venta').value = data.venta.id_venta;
                        document.getElementById('producto_id').value = data.venta.producto_id;
                        document.getElementById('categoria_id').value = data.venta.categoria_id;
                        document.getElementById('cliente_id').value = data.venta.cliente_id;
                        document.getElementById('fecha_venta').value = data.venta.fecha_venta;
                        document.getElementById('subtotal').value = data.venta.subtotal;
                        document.getElementById('iva').value = data.venta.iva;
                        document.getElementById('total').value = data.venta.total;
                        document.getElementById('modal').classList.remove('hidden');
                    });
            });
        });
    });
</script>
@endsection
