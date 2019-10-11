<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\SubcategoriaServicios;
use Emporio\Model\CategoriaEstatus;
use DB;

class SubcategoriaController extends Controller
{
    public function index()
    {
    	$url_listar = '/admin/subcategorias-listar';
    	$url_buscar = '';
    	$url_actualizar = '/admin/subcategorias-actualizar/';
    	$url_exportar = '';
    	$categorias = CategoriaEstatus::where('estatus', '=', '1')->orderBy('bitacora', 'asc')->get();

    	return view('admin.subcategorias.index', compact('url_listar', 'url_buscar', 'url_actualizar', 'url_exportar', 'categorias'));
    }

    public function listar()
    {
    	$subcategorias = DB::table('subcategoria_servicios as sub')
    		->leftjoin('bitacoras_estatus as bit', 'bit.id_subcategoria', '=', 'sub.id')
    		->join('categoria_estatus as est', 'est.id', '=', 'sub.id_categoria')
    		->select('sub.*', 'est.bitacora', DB::raw('count(bit.id_subcategoria) as conteo'))
    		->groupBy('sub.id', 'sub.subcategoria', 'sub.estatus', 'sub.renovacion', 'sub.vencimiento', 'sub.recordatorio', 'sub.comprobacion_uso', 'sub.id_categoria', 'sub.created_at', 'sub.updated_at', 'est.bitacora')
    		->orderBy('est.bitacora', 'asc')
    		->orderBy('sub.subcategoria', 'asc')
    		->get();

    		return view('admin.subcategorias.listado', compact('subcategorias'));
    }

    public function actualizar($id)
    {
    	$sub = DB::table('subcategoria_servicios as sub')
    		->leftjoin('bitacoras_estatus as bit', 'bit.id_subcategoria', '=', 'sub.id')
    		->join('categoria_estatus as est', 'est.id', '=', 'sub.id_categoria')
    		->select('sub.*', 'est.bitacora', DB::raw('count(bit.id_subcategoria) as conteo'))
    		->groupBy('sub.id', 'sub.subcategoria', 'sub.estatus', 'sub.renovacion', 'sub.vencimiento', 'sub.recordatorio', 'sub.comprobacion_uso', 'sub.id_categoria', 'sub.created_at', 'sub.updated_at', 'est.bitacora')
    		->where('sub.id', '=', $id)
    		->first();

    		return view('admin.subcategorias.listado-actualizar', compact('sub'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    	    [
    	        'subcategoria' => 'required|unique:subcategoria_servicios',
    	        'id_categoria' => 'required'
    	    ]);

    	$subcategoria = new SubcategoriaServicios;
    	$subcategoria->subcategoria = $request->subcategoria;
    	$subcategoria->id_categoria = $request->id_categoria;
    	$subcategoria->renovacion = $request->renovacion;
    	$subcategoria->comprobacion_uso = $request->comprobacion_uso;
    	$subcategoria->vencimiento = $request->vencimiento;
    	$subcategoria->recordatorio = $request->recordatorio;
    	$subcategoria->save();

    	return response()->json($subcategoria);
    }

    public function edit($id)
    {
    	$subcategoria = SubcategoriaServicios::findOrFail($id);

    	return response()->json($subcategoria);
    }

    public function update(Request $request, $id)
    {
    	$subcategoria = SubcategoriaServicios::findOrFail($id);

    	$this->validate($request,
    	    [
    	        'subcategoria' => 'required|unique_with:subcategoria_servicios,'.$id,
    	        'id_categoria' => 'required'
    	    ]);

    	$subcategoria->subcategoria = $request->subcategoria;
    	$subcategoria->id_categoria = $request->id_categoria;
    	$subcategoria->renovacion = $request->renovacion;
    	$subcategoria->comprobacion_uso = $request->comprobacion_uso;
    	$subcategoria->vencimiento = $request->vencimiento;
    	$subcategoria->recordatorio = $request->recordatorio;
    	$subcategoria->update();

    	return response()->json($subcategoria);
    }

    public function estatus(Request $request, $id)
    {
    	$subcategoria = SubcategoriaServicios::findOrFail($id);
    	$subcategoria->estatus = $request->estatus;
    	$subcategoria->update();
    	return response()->json($subcategoria);
    }
}





















