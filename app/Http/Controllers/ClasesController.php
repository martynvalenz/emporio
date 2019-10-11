<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clases;
use Carbon\Carbon;

class ClasesController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $clases = Clases::orderBy('clave','asc')->get();
        return view('admin.clases.index',compact('clases'));
    }
    
    public function create()
    {
        return view ('admin.clases.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'clave'=>'required|max:15|unique:clases',
                'clase'=>'required|max:512'
            ]);

        $clase = new Clases;
        $clase->clave=$request->clave;
        $clase->clase=$request->clase;
        $clase->descripcion=$request->descripcion;
        $clase->estatus = $request->has('estatus') ? 1 : 0;
        $clase->save();

        $mensaje = array(
                    'message' => 'La clase fue creada exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('clases.index'))->with($mensaje);
    }

    public function show($id)
    {
        /*$items = OrderItem::with('product')->where('order_id', $request->get('order_id'))->get();
        return json_encode($items);*/
    }

    public function edit($id)
    {
        $clase = Clases::findOrFail($id);
        return view('admin.clases.edit', compact('clase'));
    }

    public function update(Request $request, $id)
    {
        $clase = Clases::findOrFail($id);
        
        $this->validate($request,
        [
            'clave'=>'required|max:15|unique_with:clases,'.$clase->id,
            'clase'=>'required|max:512'
        ]);

        
        $clase->clave=$request->clave;
        $clase->clase=$request->clase;
        $clase->descripcion=$request->descripcion;
        $clase->estatus = $request->has('estatus') ? 1 : 0;
        $clase->update();

        $mensaje = array(
                    'message' => 'La clase fue editada exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('clases.index'))->with($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $clase = Clases::findOrFail($id);
        $clase->estatus=$request->estatus;
        $clase->update();
        
        $mensaje = array(
                    'message' => 'El estatus de la clase fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return redirect(route('clases.index'))->with($mensaje);
    }
}
