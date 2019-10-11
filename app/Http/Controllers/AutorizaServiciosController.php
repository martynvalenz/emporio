<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Servicios;
use DB;
use Carbon\Carbon;

class AutorizaServiciosController extends Controller
{
    public function index()
    {
    	$url_listar = '/admin/autoriza-servicios-listar';
    	$url_buscar = '/admin/autoriza-servicios-buscar/';
    	$url_exportar = '/admin/autoriza-servicios-exportar';

    	return view('admin.direccion.autorizar-servicios.index', compact('url_listar', 'url_buscar', 'url_exportar'));
    }

    public function listar()
    {
    	Carbon::setLocale('es');

    	$servicios=DB::table('servicios as s')
    	    ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
    	    ->leftjoin('control as con', 's.id_control', '=', 'con.id')
    	    ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
    	    ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
    	    ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
    	    ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
    	    ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
    	    ->where('s.mostrar_bitacora', '=', '0')
    	    ->where('s.estatus_registro', '=', 'Pendiente')
    	    ->orderBy('s.created_at', 'desc');

    	$servicios = $servicios->paginate(50);

    	return view('admin.direccion.autorizar-servicios.listado', compact('servicios'));
    }

    public function buscar($buscar)
    {
    	Carbon::setLocale('es');

    	$servicios=DB::table('servicios as s')
    	    ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
    	    ->leftjoin('control as con', 's.id_control', '=', 'con.id')
    	    ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
    	    ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
    	    ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
    	    ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
    	    ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
    	    ->where('s.mostrar_bitacora', '=', '0')
    	    ->where('s.estatus_registro', '=', 'Pendiente')
    	    ->where(function($q) use ($buscar)
    	    {
    	        $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
    	        ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
    	        ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
    	        ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
    	        ->orWhere('bit.clave','LIKE','%'.$buscar.'%')
    	        ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
    	        ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
    	        ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
    	        ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
    	        ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
    	        ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
    	        ->orWhere('s.costo','LIKE',$buscar)
    	        ->orWhere('s.id','LIKE',$buscar)
    	        ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
    	    })
    	    ->orderBy('s.created_at', 'desc');

    	$servicios = $servicios->paginate(50);

    	return view('admin.direccion.autorizar-servicios.listado', compact('servicios'));
    }

    public function exportar()
    {

    }

    public function notificacion()
    {
    	$servicios_count = DB::table('servicios')
    		->select(DB::raw('count(*) as servicios_count'))
    		->where('mostrar_bitacora', '=', '0')
    		->where('estatus_registro', '=', 'Pendiente')
    		->count();

    	return response()->json($servicios_count);
    }

    public function AutorizarServicio(Request $request, $id)
    {
    	$servicio = Servicios::findOrFail($id);
    	$servicio->mostrar_bitacora = 1;
    	$servicio->update();

    	return response()->json($servicio);
    }
}










