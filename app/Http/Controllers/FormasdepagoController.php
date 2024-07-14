<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pago;

class FormasdepagoController extends Controller
{
    public function index()
    {   
        $formasdepago = Pago::all();
        return view('formasdepago.index', compact('formasdepago'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_tipo' => 'required',
        ]);

        Pago::create([
            'tipo' => $request['nombre_tipo'],
        ]);
        return redirect()->route('formasdepago.index')->with('success', 'Tipo de pago creada exitosamente');
    }

    public function edit(Pago $tipo_pago)
    {
        return view('formasdepago.edit', compact('tipo_pago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_tipo' => 'required',
        ]);

        $pago = Pago::find($id);
        
        $pago->update([
            'tipo' => $request['nombre_tipo'],
        ]);

        return redirect()->route('formasdepago.index')->with('success', 'Tipo de pago actualizado exitosamente');
    }

    public function destroy($id)
    {
        
        $pagos = Pago::find($id);
        $pagos->delete();
        
        return redirect()->route('formasdepago.index')->with('success', 'Tipo de pago eliminado exitosamente');
    }
}
