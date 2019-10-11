<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\CategoriaServicios;
use Carbon\Carbon;

class CategoriaServiciosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $categorias = CategoriaServicios::orderBy('categoria','asc')->get();
        return view('admin.servicios.categorias.index',compact('categorias'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'categoria'=>'required|max:50|unique:categoria_servicios',
            ]);

        $categoria = new CategoriaServicios;
        $categoria->categoria=$request->categoria;
        $categoria->descripcion=$request->descripcion;
        $categoria->estatus = $request->has('estatus') ? 1 : 0;
        $categoria->save();

        $mensaje = array(
                    'message' => 'La categoría fue creada exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function show($id)
    {
        /*$items = OrderItem::with('product')->where('order_id', $request->get('order_id'))->get();
        return json_encode($items);*/
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $categoria = CategoriaServicios::findOrFail($id);

        $this->validate($request,
        [
            'categoria'=>'required|max:50|unique_with:categoria_servicios,'.$categoria->id,
        ]);

        
        $categoria->categoria=$request->categoria;
        $categoria->descripcion=$request->descripcion;
        $categoria->update();

        $mensaje = array(
                    'message' => 'La categoría fue editada exitosamente.', 
                    'alert-type' => 'info'
                );

        return redirect(route('categoria-servicios.index'))->with($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $categoria = CategoriaServicios::findOrFail($id);
        $categoria->estatus=$request->estatus;
        $categoria->update();
        
        $mensaje = array(
                    'message' => 'El estatus de la categoria fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return redirect(route('categoria-servicios.index'))->with($mensaje);
    }
}
