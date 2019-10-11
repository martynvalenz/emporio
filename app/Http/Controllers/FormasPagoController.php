<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\FormasPago;
use Carbon\Carbon;

class FormasPagoController extends Controller
{
    public function index()
    {
        $formas_pago = FormasPago::orderBy('codigo','asc')->get();
        return view('admin.formaspago.index',compact('formas_pago'));
    }
    
    public function create()
    {
        return view ('admin.formaspago.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'codigo'=>'required|max:3|unique:formas_pago',
                'forma_pago' => 'required|max:50|unique:formas_pago',
            ]);

        $forma_pago = new FormasPago;
        $forma_pago->codigo=$request->codigo;
        $forma_pago->forma_pago=$request->forma_pago;
        $forma_pago->descripcion=$request->descripcion;
        $forma_pago->estatus = $request->has('estatus') ? 1 : 0;
        $forma_pago->save();
        
        $mensaje = array(
                    'message' => 'Se creó la Forma de Pago exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('formaspago.index'))->with($mensaje);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $forma_pago = FormasPago::find($id);
        return view('admin.formaspago.edit', compact('forma_pago'));
    }

    public function update(Request $request, $id)
    {
        $forma_pago = FormasPago::findOrFail($id);
        
        $this->validate($request,
        [
            'codigo'=>'max:3|required',
            'forma_pago'=>'required|max:50|unique_with:formas_pago,'.$forma_pago->id
        ]);

        
        $forma_pago->codigo=$request->get('codigo');
        $forma_pago->forma_pago=$request->get('forma_pago');
        $forma_pago->descripcion=$request->get('descripcion');
        $forma_pago->estatus = $request->has('estatus') ? 1 : 0;
        $forma_pago->update();

        $mensaje = array(
                    'message' => 'La Forma de pago fue editada exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('formaspago.index'))->with($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $forma_pago = FormasPago::findOrFail($id);
        $forma_pago->estatus=$request->estatus;
        $forma_pago->update();
        
        $mensaje = array(
                    'message' => 'Se cambió el estatus de la Forma de Pago.', 
                    'alert-type' => 'info'
                );

        return redirect(route('formaspago.index'))->with($mensaje);
    }
}
