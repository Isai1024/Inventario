@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Cotizacion</h1>
        <div class="mb-4">
            <button onclick="document.getElementById('modal').classList.remove('hidden')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear cotizacion</button>
        </div>

        <style>
            .details {
                display: none;
            }
        </style>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ $message }}</span>
            </div>
        @endif

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">N°</th>
                    <th class="py-2 px-4 border-b">Cliente</th>
                    <th class="py-2 px-4 border-b">Fecha</th>
                    <th class="py-2 px-4 border-b">Vigencia</th>
                    <th class="py-2 px-4 border-b">Comentario</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotizacion as $valor)
                @php
                    $cotizacionproducto = "App\Models\CotizacionProducto"::where('id_cotizacion', $valor->id_cotizaciones)->get();
                    $total = 0;
                @endphp
                <tr>
                    <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-b">{{ $valor->cliente->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $valor->fecha_cot }}</td>
                    <td class="py-2 px-4 border-b">{{ $valor->vigencia }}</td>
                    <td class="py-2 px-4 border-b">{{ $valor->comentarios }}</td>
                    <td class="py-2 px-4 border-b">
                        <button onclick="mostrarDetalles('detalles_{{ $valor->id_cotizaciones }}')"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                            Ver
                        </button>
                        <a href="{{ route('cotizaciones.edit', $valor->id_cotizaciones) }}"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                            Editar
                        </a>
                        <form action="{{ route('cotizaciones.destroy', $valor) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <tr id="detalles_{{ $valor->id_cotizaciones}}" class="details">
                    <td colspan="6">
                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Producto</th>
                                    <th class="py-2 px-4 border-b">Cantidad</th>
                                    <th class="py-2 px-4 border-b">Precio</th>
                                    <th class="py-2 px-4 border-b">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cotizacionproducto as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b"><center>{{ $item->producto->nombre }}</center></td>
                                    <td class="py-2 px-4 border-b"><center>{{ $item->cantidad }}</center></td>
                                    <td class="py-2 px-4 border-b"><center>$ {{ $item->precio_venta }}</center></td>
                                    <td class="py-2 px-4 border-b"><center>$ {{ $item->precio_venta * $item->cantidad }}</center></td>
                                    @php
                                        $total += $item->precio_venta * $item->cantidad;
                                    @endphp
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align: right; padding-right: 135px" colspan="4">@php echo "$ " . $total; @endphp</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div id="modal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center overflow-auto hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-h-full max-w-md w-full">
                <h2 class="text-xl font-bold mb-4" id="modalTitle">Crear cotizacion</h2>
                <form id="cotizaForm" method="POST" action="{{ route('cotizaciones.store') }}">
                    @csrf
                    <div class="mb-4 flex items-center space-x-4">
                        <div>
                            <label class="block text-gray-700">Producto</label>
                            <select name="id_producto" id="id_producto" class="w-full p-2 border rounded">
                                @foreach ($producto as $item)
                                    <option value="{{ $item->id_producto }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input id="productos" name="productos" value="" type="hidden">
                        <input id="cantidades" name="cantidades" value="" type="hidden">
                        <input type="button" id="btn-add" value="Add"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6" />
                    </div>
                    <div id="dataproducto">
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label class="block text-gray-700">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="w-full p-2 border rounded">
                            @foreach ($cliente as $item)
                                <option value="{{ $item->id_cliente }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Fecha de cotización</label>
                        <input type="date" name="fecha_cot" id="fecha_cot" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Vigencia</label>
                        <input type="date" name="vigencia" id="vigencia" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Comentario</label>
                        <textarea name="comentario" id="comentario" class="w-full p-2 border rounded" required></textarea>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="document.getElementById('modal').classList.add('hidden')"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Variables para almacenar los productos y cantidades
        let salida = [];
        let cantidades = [];
        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('createNewCliente').addEventListener('click', function() {
                document.getElementById('modalTitle').innerText = 'Crear cotización';
                document.getElementById('cotizaForm').reset();
                document.getElementById('modal').classList.remove('hidden');
            });
        });

        // Agrega un producto a la lista
        document.getElementById('btn-add').addEventListener('click', function() {
            let producto = document.getElementById('id_producto').value;
            let nameproducto = document.getElementById('id_producto').options[document.getElementById('id_producto').selectedIndex].text;
            var productos = document.getElementById('productos').value;
            let div = document.getElementById('dataproducto');
            
            // Verifica si el producto ya fue agregado
            if (!salida.includes(producto)) {
                salida.push(producto);

                const cuadro = document.createElement('div');
                cuadro.className = "mb-4 flex items-center space-x-4";

                // Agrega el producto al input
                const label = document.createElement('p');
                label.id = "${producto}_label";
                label.textContent = nameproducto;
                label.className = "w-full p-2 border rounded text-gray-700";
                cuadro.appendChild(label);

                // Agrega la cantidad del producto
                const btnCantidad = document.createElement('input');
                btnCantidad.placeholder = "Cantidad";
                btnCantidad.min = 0;
                btnCantidad.id = producto;
                btnCantidad.onchange = function() {
                    // Agrega la cantidad al input
                    cantidades[salida.indexOf(producto)] = this.value; // Guarda la cantidad en el array dependiendo de donde esta el producto
                    document.getElementById('cantidades').value = cantidades;
                };
                btnCantidad.type = "number";
                btnCantidad.className = "w-auto p-2 border rounded text-gray-700 font-bold rounded";
                cuadro.appendChild(btnCantidad);
                
                // Agrega el boton para eliminar el producto
                const btn = document.createElement('input');
                btn.type = "button";
                btn.onclick = function() {
                    // Elimina el producto del input
                    document.getElementById('productos').value = document.getElementById('productos').value.replace(producto + ',', '');
                    salida.splice(salida.indexOf(producto), 1 );
                    cuadro.remove();
                };
                btn.value = "X";
                btn.className = "w-auto p-2 border rounded text-gray-700 bg-red-500 hover:bg-red-700 text-white font-bold rounded";
                cuadro.appendChild(btn);
                
                div.appendChild(cuadro);

                // Agrega el producto al input
                document.getElementById('productos').value = salida;
            }
        });

        // Muestra los detalles de la cotización
        function mostrarDetalles(id) {
            var detalles = document.getElementById(id);
            if (detalles.style.display === "none") {
                detalles.style.display = "table-row";
            } else {
                detalles.style.display = "none";
            }
        }

        document.querySelectorAll('.details').forEach(function(row) {
            row.style.display = 'none';
        });

    </script>
@endsection
