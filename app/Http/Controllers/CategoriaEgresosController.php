<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Emporio\Model\CategoriaEgresos;
use Carbon\Carbon;
use DB;

class CategoriaEgresosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        //$categorias = CategoriaEgresos::orderBy('categoria','asc')->get();
        $categorias = DB::table('categoria_egresos as c')
            ->leftjoin('estados_cuenta as e', 'e.id_categoria', '=', 'c.id')
            ->select('c.id', 'c.clasificacion', 'c.cuenta', 'c.subcuenta', 'c.categoria', 'c.descripcion', 'c.estatus', 'c.created_at', 'c.updated_at', DB::raw('sum(e.retiro) as retiros'))
            ->orderBy('c.categoria', 'asc')
            ->groupBy('c.id', 'c.clasificacion', 'c.cuenta', 'c.subcuenta', 'c.categoria', 'c.descripcion', 'c.estatus', 'c.created_at', 'c.updated_at')
            ->get();
        return view('admin.egresos.categorias.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'clasificacion' => 'required',
                'categoria'=>'required|max:50|unique_with:categoria_egresos,clasificacion'
            ]);

        $categoria = new CategoriaEgresos;
        $categoria->clasificacion=$request->clasificacion;
        $categoria->cuenta=$request->cuenta;
        $categoria->subcuenta=$request->subcuenta;
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

    public function update(Request $request, $id)
    {
        $categoria = CategoriaEgresos::findOrFail($id);

        $this->validate($request,
        [
            'categoria'=>'required|max:50|unique_with:categoria_egresos,clasificacion,'.$categoria->id,
        ]);

        
        $categoria->clasificacion=$request->clasificacion;
        $categoria->cuenta=$request->cuenta;
        $categoria->subcuenta=$request->subcuenta;
        $categoria->categoria=$request->categoria;
        $categoria->descripcion=$request->descripcion;
        $categoria->update();

        $mensaje = array(
                    'message' => 'La categoría fue editada exitosamente.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $categoria = CategoriaEgresos::findOrFail($id);
        $categoria->estatus=$request->estatus;
        $categoria->update();
        
        $mensaje = array(
                    'message' => 'El estatus de la categoria fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }
}
