<?php

namespace Emporio\Http\Controllers\Estatus;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Emporio\Model\Estatus;
use Emporio\Model\ListadoEstatus;

class RegistroMarcasController extends Controller
{
    public function index()
    {
    	Carbon::setLocale('es');
    	$mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-2);
    	$mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
    	$fecha_inicio = $mytime_inicio->toDateString();
    	$fecha_fin = $mytime_fin->toDateString();

    	//$tipo_estatus = 'Registro Marcas';
    	$estatus = ListadoEstatus::orderBy('estatus', 'asc')->get();
    	$url_listar = '/admin/estatus/registro-marcas-listar/';
    	$url_buscar = '/admin/estatus/registro-marcas-buscar/';
    	$url_actualizar = '/admin/estatus/registro-marcas-actualizar/';

    	return view('admin.estatus.registro-marca.index', compact('estatus', 'url_listar', 'url_buscar', 'url_actualizar'));
    }

    public function listar($estatus)
    {
    	Carbon::setLocale('es');
    	$mytime = Carbon::now('America/Chihuahua');
    	$today = $mytime->toDateString();

    	$bitacoras = DB::table('bitacoras_estatus as est')
    		->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
    		->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
    		->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
    		->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
    		->leftjoin('categoria_estatus as cat', 'cat.id', '=', 'est.id_bitacoras_estatus')
    		->leftjoin('users as ad', 'ad.id', '=', 'est.id_admin')
    		->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
    		->select('est.*', 'list.estatus', 'list.color', 'list.texto', 'c.nombre_comercial', 'mar.nombre as marca', 'cla.clave', 'cat.bitacora', 'cat.clave as clave_bit', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'raz.rfc', 'raz.razon_social')
    		->where('est.id_bitacoras_estatus', '=', '1')
    		->orderBy('est.fecha_vencimiento', 'asc');

    		if($estatus == 'todos')
    		{
    		    //
    		}
    		else if($estatus != 'todos')
    		{
    		    $bitacoras->where('est.id_estatus', '=', $estatus);
    		}

    		$bitacoras = $bitacoras->paginate(50);

    	return view('admin.estatus.registro-marca.listar', compact('bitacoras', 'today'));
    }

    public function buscar($estatus, $buscar)
    {
    	Carbon::setLocale('es');
    	$mytime = Carbon::now('America/Chihuahua');
    	$today = $mytime->toDateString();

    	$bitacoras = DB::table('bitacoras_estatus as est')
    		->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
    		->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
    		->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
    		->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
    		->leftjoin('categoria_estatus as cat', 'cat.id', '=', 'est.id_bitacoras_estatus')
    		->leftjoin('users as ad', 'ad.id', '=', 'est.id_admin')
    		->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
    		->select('est.*', 'list.estatus', 'list.color', 'list.texto', 'c.nombre_comercial', 'mar.nombre as marca', 'cla.clave', 'cat.bitacora', 'cat.clave as clave_bit', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'raz.rfc', 'raz.razon_social')
    		->where('est.id_bitacoras_estatus', '=', '1')
    		->where(function($q) use ($buscar)
    		{
    		    $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
    		    ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
    		    ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
    		    ->orWhere('est.id_admin','LIKE','%'.$buscar.'%')
    		    ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
    		    ->orWhere('est.numero_expediente','LIKE',$buscar)
    		    ->orWhere('ad.iniciales','LIKE',$buscar)
    		    ->orWhere('ad.nombre','LIKE',$buscar)
    		    ->orWhere('ad.apellido','LIKE',$buscar)
    		    ->orWhere('raz.rfc','LIKE',$buscar)
    		    ->orWhere('raz.razon_social','LIKE',$buscar)
    		    ->orWhere('est.numero_registro','LIKE',$buscar);
    		})
    		->orderBy('est.fecha_vencimiento', 'asc');

    		if($estatus == 'todos')
    		{
    		    //
    		}
    		else if($estatus != 'todos')
    		{
    		    $bitacoras->where('est.id_estatus', '=', $estatus);
    		}

    		$bitacoras = $bitacoras->paginate(50);

    	return view('admin.estatus.registro-marca.listar', compact('bitacoras', 'today'));
    }

    public function actualizar($id)
    {

    }
}














