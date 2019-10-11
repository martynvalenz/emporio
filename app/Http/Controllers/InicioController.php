<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Franquicias;
use Emporio\Model\CategoryServices;
use Emporio\Http\Resources\CategoryResource;
use DB;

class InicioController extends Controller
{
    public function index()
    {
        
    	return view('emporio.index');
    }

    public function categoria_servicios()
    {
        return CategoryResource::collection(CategoryServices::where('estatus', '=', '1')->orderBy('id', 'asc')->get());
    }

    public function categoria_servicios_show($slug)
    {
        return new CategoryResource(CategoryServices::where('slug', '=', $slug)->first());
    }

    public function franquicias()
    {
    	$franquicias = Franquicias::where('estatus', '=', '1')->orderBy('franquicia', 'asc')->get();

    	return view('web.tienda-franquicias', compact('franquicias'));
    }

    public function franquicia($id)
    {
    	$franquicia = DB::table('franquicias as f')
    		->join('franquicia_categorias as cat', 'cat.id', '=', 'f.id_categoria')
    		->select('f.*', 'cat.categoria')
    		->where('f.id', '=', $id)
    		->first();

    	//return response()->json($franquicia);
    	return view('admin.franquicia', compact('franquicia'));
    }
}
