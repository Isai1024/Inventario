<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Muestra una lista de todas las ventas con detalles de productos, categorías y clientes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todas las ventas con relaciones pre-cargadas de producto, categoría y cliente
        $ventas = Venta::with(['producto', 'categoria', 'cliente'])->get();
        
        // Obtiene todos los productos, categorías y clientes disponibles para mostrar en la vista
        $productos = Producto::all();
        $categorias = Categoria::all();
        $clientes = Cliente::all();
        $pagos = Pago::all();
        
        // Retorna la vista 'ventas.index' con datos de ventas, productos, categorías y clientes
        return view('ventas.index', compact('ventas', 'productos', 'categorias', 'clientes', 'pagos'));
    }

    /**
     * Almacena una nueva venta en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos del formulario de creación de venta
        $request->validate([
            'producto_id' => 'required',
            'categoria_id' => 'required',
            'cliente_id' => 'required',
            'pago_id' => 'required',
            'fecha_venta' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Crea una nueva venta utilizando los datos validados y los guarda en la base de datos
        Venta::create($request->all());

        // Redirige de vuelta a la página de listado de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')
            ->with('success', 'Venta creada exitosamente.');
    }

    /**
     * Muestra los datos de una venta específica para su edición.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        // Busca la venta por su ID y carga los datos de productos, categorías y clientes
        $venta = Venta::find($id);
        $productos = Producto::all();
        $categorias = Categoria::all();
        $clientes = Cliente::all();
        $pagos = Pago::all();

        // Retorna una respuesta JSON con los datos de la venta y las listas de productos, categorías y clientes
        return response()->json(compact('venta', 'productos', 'categorias', 'clientes', 'pagos'));
    }

    /**
     * Actualiza una venta existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Valida los datos recibidos del formulario de actualización de venta
        $request->validate([
            'producto_id' => 'required',
            'categoria_id' => 'required',
            'cliente_id' => 'required',
            'pago_id' => 'required',
            'fecha_venta' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Busca la venta por su ID y actualiza los datos utilizando los datos validados
        $venta = Venta::find($id);
        $venta->update($request->all());

        // Redirige de vuelta a la página de listado de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')
            ->with('success', 'Venta actualizada exitosamente.');
    }

    /**
     * Elimina una venta específica de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Busca la venta por su ID y la elimina de la base de datos
        Venta::find($id)->delete();

        // Redirige de vuelta a la página de listado de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada exitosamente.');
    }
}

