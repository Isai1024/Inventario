<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();
        return view('productos.index', compact('productos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_venta' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'fecha_compra' => 'nullable|date',
            'color' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index');
    }
    public function edit($id)
{
    $producto = Producto::findOrFail($id);
    $categorias = Categoria::all();

    return view('productos.edit', compact('producto', 'categorias'));
}

public function update(Request $request, $id)

{
    $request->validate([
        'nombre' => 'required',
        'categoria_id' => 'required',
        'precio_venta' => 'required|numeric',
        'precio_compra' => 'required|numeric',
        'fecha_compra' => 'nullable|date',
        'color' => 'required',
        'descripcion_corta' => 'required',
        'descripcion_larga' => 'required',
    ]);
    $producto = Producto::findOrFail($id);

    $producto->update($request->all());
    return redirect()->route('productos.index');
}
public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }
}
