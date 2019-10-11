<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Puestos;
use Carbon\Carbon;

class PuestosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $puestos = Puestos::orderBy('puesto','asc')->get();
        return view('admin.puestos.index',compact('puestos'));
    }
    
    public function create()
    {
        return view ('admin.puestos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'puesto'=>'required|max:50|unique:puestos',
            ]);

        $puesto = new Puestos;
        $puesto->puesto=$request->puesto;
        $puesto->descripcion=$request->descripcion;
        $puesto->estatus = $request->has('estatus') ? 1 : 0;
        $puesto->save();

        $mensaje = array(
                    'message' => 'El puesto fue creado exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('puestos.index'))->with($mensaje);
    }

    public function show($id)
    {
        /*$items = OrderItem::with('product')->where('order_id', $request->get('order_id'))->get();
        return json_encode($items);*/
    }

    public function edit($id)
    {
        $puesto = Puestos::findOrFail($id);
        return view('admin.puestos.edit', compact('puesto'));
    }

    public function update(Request $request, $id)
    {
        $puesto = Puestos::findOrFail($id);
        
        $this->validate($request,
        [
            'puesto'=>'required|max:50|unique_with:puestos,'.$puesto->id
        ]);

        
        $puesto->puesto=$request->puesto;
        $puesto->descripcion=$request->descripcion;
        $puesto->estatus = $request->has('estatus') ? 1 : 0;
        $puesto->update();

        $mensaje = array(
                    'message' => 'El puesto fue editado exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('puestos.index'))->with($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $puesto = Puestos::findOrFail($id);
        $puesto->estatus=$request->estatus;
        $puesto->update();
        
        $mensaje = array(
                    'message' => 'El estatus del puesto fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return redirect(route('puestos.index'))->with($mensaje);
    }
}
