<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\PorcentajeIVA;
use Carbon\Carbon;

class PorcentajeIVAController extends Controller
{
    public function index()
    {
        $porcentaje = PorcentajeIVA::get()->first();
        return view('admin.porcentajeiva.index',compact('porcentaje'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'porcentaje_iva'=>'required'
        ]);

        $porcentaje = PorcentajeIVA::findOrFail($id);
        $porcentaje->porcentaje_iva=$request->get('porcentaje_iva');
        $porcentaje->update();

        $mensaje = array(
                    'message' => 'Se cambió el porcentaje de IVA exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('porcentaje-iva.index'))->with($mensaje);
    }
}
