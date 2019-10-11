<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\Control;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\Clases;
use Emporio\User;
use Emporio\Model\Monedas;
use Emporio\Model\Facturas;
use Emporio\Model\FacturasDetalles;
use Emporio\Model\Estatus;
use Emporio\Model\RazonSocial;
use Emporio\Model\Nomina;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Estrategias;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\CobranzaDetalles;
use Emporio\Model\ServiciosComentarios;
use Emporio\Model\Requisitos;
use Emporio\Model\ServiciosProceso;
use Emporio\Model\ListadoEstatus;
use Emporio\Model\ServiciosRequisitos;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use DB;
use Image;

class BitacorasController extends Controller
{
    public function index()
    {
    	Carbon::setLocale('es');
    	$mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-1);
    	$mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
    	$fecha_inicio = $mytime_inicio->toDateString();
    	$fecha_fin = $mytime_fin->toDateString();
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

    	$porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
    	$cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
    	$formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
    	$estrategias = Estrategias::orderBy('id','asc')->where('estatus','=','1')->get();
    	$monedas = Monedas::orderBy('id', 'asc')->get();
    	$admins = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->where('responsabilidad','=','1')->get();
    	$clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
    	$catalogo_servicios = DB::table('catalogo_servicios as cat')
    	    ->join('monedas as m', 'm.clave', '=', 'cat.moneda')
    	    ->select('cat.*', 'm.conversion')
    	    ->orderBy('cat.clave', 'asc')
    	    ->where('cat.estatus','=','1')
    	    ->get();
    	$bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();
    	$bitacoras_estatus = CategoriaEstatus::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();
    	$listado_estatus = ListadoEstatus::orderBy('estatus')->where('activo', '=', '1')->get();

    	$url_listar = '/admin/bitacora/tramites-nuevos-listar/';
        $url_buscar = '/admin/bitacora/tramites-nuevos-buscar/';
        $url_actualizar = '/admin/bitacora/tramites-nuevos-actualizar/';

    	return view('admin.bitacoras.index', compact('monedas', 'admins', 'porcentaje_iva', 'cuentas', 'formas_pago', 'variable_estatus', 'clases', 'bitacoras', 'estrategias', 'fecha_inicio', 'fecha_fin', 'catalogo_servicios', 'url_listar', 'url_buscar', 'url_actualizar', 'bitacoras_estatus', 'today', 'listado_estatus'));
    }

    public function tramites_nuevos_listar($estatus, $tramite, $fecha_inicio, $fecha_fin, $folio)
    {
    	Carbon::setLocale('es');

    	$servicios=DB::table('servicios as s')
    	    ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
    	    ->leftjoin('control as con', 's.id_control', '=', 'con.id')
    	    ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
    	    ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
    	    ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
    	    ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
    	    ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
    	    // ->where('s.fecha', '>=', $fecha_inicio)
    	    // ->where('s.fecha', '<=', $fecha_fin)
    	    ->where('s.id_bitacoras', '=', '1')
    	    // ->where('s.mostrar_bitacora', '=', '1')
    	    ->orderBy('s.fecha', 'desc');

    	    if($estatus == 'todos')
    	    {
    	        //
    	    }
    	    else if($estatus != 'todos')
    	    {
    	        $servicios->where('s.estatus_cobranza', '=', $estatus);
    	    }

    	    if($tramite == 'todos')
    	    {
    	        //
    	    }
    	    else
    	    {
    	        $servicios->where('s.estatus_registro', '=', $tramite);
    	    }

    	    $servicios = $servicios->paginate(50);

    	    //return $servicios;

    	return view('admin.bitacoras.listado-tramites-nuevos', compact('servicios'));
    }

    public function tramites_nuevos_buscar($estatus, $tramite, $buscar, $fecha_inicio, $fecha_fin, $folio)
    {
    	Carbon::setLocale('es');

    	$servicios=DB::table('servicios as s')
    	    ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
    	    ->leftjoin('control as con', 's.id_control', '=', 'con.id')
    	    ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
    	    ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
    	    ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
    	    ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
    	    ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
    	    // ->where('s.fecha', '>=', $fecha_inicio)
    	    // ->where('s.fecha', '<=', $fecha_fin)
    	    ->where('s.id_bitacoras', '=', '1')
            // ->where('s.mostrar_bitacora', '=', '1')
    	    ->where(function($q) use ($buscar)
    	    {
    	        $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
    	        ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
    	        ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
    	        ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
    	        ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
    	        ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
    	        ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
    	        ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
    	        ->orWhere('s.costo','LIKE',$buscar)
    	        ->orWhere('s.id','LIKE',$buscar)
    	        ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
    	    })
    	    ->orderBy('s.fecha', 'desc');

    	    if($estatus == 'todos')
    	    {
    	        //
    	    }
    	    else if($estatus != 'todos')
    	    {
    	        $servicios->where('s.estatus_cobranza', '=', $estatus);
    	    }

    	    if($tramite == 'todos')
    	    {
    	        //
    	    }
    	    else
    	    {
    	        $servicios->where('s.estatus_registro', '=', $tramite);
    	    }

    	    $servicios = $servicios->paginate(50);

    	return view('admin.bitacoras.listado-tramites-nuevos', compact('servicios'));
    }

    public function tramites_nuevos_actualizar($id)
    {
    	Carbon::setLocale('es');
    	$servicio=DB::table('servicios as s')
    	    ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
    	    ->leftjoin('control as con', 's.id_control', '=', 'con.id')
    	    ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
    	    ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
    	    ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
    	    ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
    	    ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
    	    ->where('s.id', '=', $id)
    	    ->first();

    	return view('admin.bitacoras.listado-tramites-actualizar', compact('servicio'));
    }

    public function estudios_factibilidad_listar($estatus, $tramite, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '2')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->orderBy('s.fecha', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

            //return $servicios;

        return view('admin.bitacoras.listado-estudios-factibilidad', compact('servicios'));
    }

    public function estudios_factibilidad_buscar($estatus, $tramite, $buscar, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '2')
            ->where('s.mostrar_bitacora', '=', '1')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
                ->orWhere('s.costo','LIKE',$buscar)
                ->orWhere('s.id','LIKE',$buscar)
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('s.fecha', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.bitacoras.listado-estudios-factibilidad', compact('servicios'));
    }

    public function estudios_factibilidad_actualizar($id)
    {
        Carbon::setLocale('es');
        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            ->where('s.id', '=', $id)
            ->first();

        return view('admin.bitacoras.listado-estudios-actualizar', compact('servicio'));
    }

    public function negativas_listar($estatus, $tramite, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '3')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->orderBy('s.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

            //return $servicios;

        return view('admin.bitacoras.listado-negativas', compact('servicios', 'today'));
    }

    public function negativas_buscar($estatus, $tramite, $buscar, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '3')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
                ->orWhere('s.costo','LIKE',$buscar)
                ->orWhere('s.id','LIKE',$buscar)
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('s.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.bitacoras.listado-negativas', compact('servicios', 'today'));
    }

    public function negativas_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();
        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            ->where('s.id', '=', $id)
            ->first();

        return view('admin.bitacoras.listado-negativas-actualizar', compact('servicio', 'today'));
    }

    public function requisitos_listar($estatus, $tramite, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '5')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->orderBy('s.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

            //return $servicios;

        return view('admin.bitacoras.listado-requisitos', compact('servicios', 'today'));
    }

    public function requisitos_buscar($estatus, $tramite, $buscar, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '5')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
                ->orWhere('s.costo','LIKE',$buscar)
                ->orWhere('s.id','LIKE',$buscar)
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('s.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.bitacoras.listado-requisitos', compact('servicios', 'today'));
    }

    public function requisitos_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();
        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            ->where('s.id', '=', $id)
            ->first();

        return view('admin.bitacoras.listado-requisitos-actualizar', compact('servicio', 'today'));
    }

    public function titulos_listar($estatus, $tramite, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '4')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->orderBy('s.fecha', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

            //return $servicios;

        return view('admin.bitacoras.listado-titulos', compact('servicios'));
    }

    public function titulos_buscar($estatus, $tramite, $buscar, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            // ->where('s.fecha', '>=', $fecha_inicio)
            // ->where('s.fecha', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '4')
            // ->where('s.mostrar_bitacora', '=', '1')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
                ->orWhere('s.costo','LIKE',$buscar)
                ->orWhere('s.id','LIKE',$buscar)
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('s.fecha', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($tramite == 'todos')
            {
                //
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.bitacoras.listado-titulos', compact('servicios'));
    }

    public function titulos_actualizar($id)
    {
        Carbon::setLocale('es');
        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'))
            ->where('s.id', '=', $id)
            ->first();

        return view('admin.bitacoras.listado-titulos-actualizar', compact('servicio'));
    }

    public function negativasVencimiento($id)
    {
        $servicio = Servicios::findOrFail($id);

        $vencimiento = $servicio->created_at;
        $vencimiento->addDays(30);

        return response()->json($vencimiento);
    }

    public function GuardarVencimiento(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

        $this->validate($request,
            [
                'fecha_vencimiento' => 'required'
            ]);

        $servicio->fecha_vencimiento = $request->fecha_vencimiento;
        $servicio->update();

        return response()->json($servicio);
    }

    public function procesos_listado($id, $id_catalogo_servicio)
    {
    	$procesos = DB::table('servicio_progreso as p')
    		->join('requisitos as r', 'r.id', '=', 'p.id_requisitos')
            ->join('servicios as s', 's.id', '=', 'p.id_servicio')
    		->select('p.*', 'r.categoria', 'r.requisito', 's.id_control')
    		->where('p.id_servicio', '=', $id)
    		->orderBy('orden', 'asc')
    		->get();

        $requisitos = DB::table('servicio_requisitos as ser')
            ->leftjoin('requisitos as req', 'req.id', '=', 'ser.id_requisitos')
            ->select('ser.*', 'req.categoria', 'req.requisito')
            ->where('ser.id_catalogo_servicio', '=', $id_catalogo_servicio)
            ->get();

    	$servicium = DB::table('servicios as s')
            ->leftjoin('control as c', 'c.id', '=', 's.id_control')
    		->select('s.id','s.avance_total', 's.avance', 's.estatus_registro', 's.logo_url', 'c.nombre as marca', 's.id_cliente', 's.id_catalogo_servicio', 's.id_clase', 's.fecha_registro', 's.id_estatus', 's.id_control', 's.asignar_costo_servicio', 's.costo_pagado', 's.costo_servicio', 's.gestionar_pago', 's.cobrado')
    		->where('s.id', '=', $id)
    		->first();

    	//return $listado;

    	return view('admin.bitacoras.proceso-listado', compact('procesos', 'servicium', 'requisitos'));
    }

    public function gestionar_pago(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        $servicio->gestionar_pago = $request->value;
        $servicio->update();

        return response()->json($servicio);
    }

    public function check_process(Request $request, $id)
    {
    	$mytime = Carbon::now('America/Chihuahua');
    	$time = $mytime->toDateTimeString();
    	$date = $mytime->toDateString();

    	$process = ServiciosProceso::findOrFail($id);
    	//$process->resultado = $request->resultado;
    	$process->estatus = $request->estatus;
    	$process->id_admin = $request->id_admin;
    	$process->updated_at = $time;
    	$process->update();

    	if($request->registro == 1)
    	{
    		$servicio = DB::table('servicios')
    			->where('id', '=', $request->id_servicio)
    			->update(
    				[
    					'avance' => $request->avance,
    					'updated_at' => $time,
    					'estatus_registro' => 'Pendiente',
    		            'fecha_registro' => null
    				]);

    		$control = DB::table('control')
    			->where('id', '=', $request->id_control)
    			->update(
    				[
    					'registrada' => '0',
    					'fecha_registrada' => null
    				]);
    	}
    	else
    	{
    		$servicio = DB::table('servicios')
    			->where('id', '=', $request->id_servicio)
    			->update(
    				[
    					'avance' => $request->avance,
    					'updated_at' => $time
    				]);
    	}

    	if($request->libera_venta == 1)
    	{
    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $request->id_servicio)
    		    ->where('estatus', '=', 'Liberada')
    		    ->where('tipo_comision', '=', 'Venta')
    		    ->update(['listo_comision' => '0',
    		                'estatus' => 'Pendiente',
    		                'fecha_aplicada' => null
    		            ]);

            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'listo_comision_venta' => '0'
                    ]);
    	}
    	else
    	{
    		//
    	}

    	if($request->libera_operativa == 1)
    	{
    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $request->id_servicio)
    		    ->where('tipo_comision', '=', 'Operativa')
    		    ->where('estatus', '=', 'Liberada')
    		    ->update(['listo_comision' => '0',
    		                'estatus' => 'Pendiente',
    		                'fecha_aplicada' => null
    		            ]);

            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'listo_comision_operativa' => '0'
                    ]);
    	}
    	else
    	{
    		//
    	}

    	if($request->libera_gestion == 1)
    	{
    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $request->id_servicio)
    		    ->where('tipo_comision', '=', 'Gestión')
    		    ->where('estatus', '=', 'Liberada')
    		    ->update(['listo_comision' => '0',
    		                'estatus' => 'Pendiente',
    		                'fecha_aplicada' => null
    		            ]);

            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'listo_comision_gestion' => '0'
                    ]);
    	}
    	else
    	{
    		//
    	}

		return response()->json($process);
    }

    public function uncheck_process(Request $request, $id)
    {
    	$mytime = Carbon::now('America/Chihuahua');
    	$time = $mytime->toDateTimeString();
    	$date = $mytime->toDateString();

    	$process = ServiciosProceso::findOrFail($id);
    	//$process->resultado = $request->resultado;
    	$process->estatus = $request->estatus;
    	$process->id_admin = $request->id_admin;
    	$process->updated_at = $time;
    	$process->update();

    	if($request->libera_venta == 1)
    	{
    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $request->id_servicio)
    		    ->where('estatus', '=', 'Pendiente')
    		    ->where('tipo_comision', '=', 'Venta')
    		    ->update(['listo_comision' => '1',
    		                'estatus' => 'Liberada',
    		                'fecha_aplicada' => $date
    		            ]);

            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'listo_comision_venta' => '1'
                    ]);
    	}
    	else
    	{
    		//
    	}

    	if($request->libera_operativa == 1)
    	{
    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $request->id_servicio)
    		    ->where('estatus', '=', 'Pendiente')
    		    ->where('tipo_comision', '=', 'Operativa')
    		    ->update(['listo_comision' => '1',
    		                'estatus' => 'Liberada',
    		                'fecha_aplicada' => $date
    		            ]);

            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'listo_comision_operativa' => '1'
                    ]);
    	}
    	else
    	{
    		//
    	}

    	if($request->libera_gestion == 1)
    	{
    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $request->id_servicio)
    		    ->where('estatus', '=', 'Pendiente')
    		    ->where('tipo_comision', '=', 'Gestión')
    		    ->update(['listo_comision' => '1',
    		                'estatus' => 'Liberada',
    		                'fecha_aplicada' => $time
    		            ]);

            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'listo_comision_gestion' => '1'
                    ]);
    	}
    	else
    	{
    		//
    	}

    	if($request->registro == 1)
    	{
    		$servicio = DB::table('servicios')
    			->where('id', '=', $request->id_servicio)
    			->update(
    				[
    					'avance' => $request->avance,
    					'updated_at' => $time,
    					'estatus_registro' => 'Terminado',
    		            'fecha_registro' => $date
    				]);

    		$control = DB::table('control')
    			->where('id', '=', $request->id_control)
    			->update(
    				[
    					'registrada' => '1',
    					'fecha_registrada' => $date
    				]);
    	}
    	else
    	{
    		$servicio = DB::table('servicios')
    			->where('id', '=', $request->id_servicio)
    			->update(
    				[
    					'avance' => $request->avance,
    					'updated_at' => $time
    				]);
    	}

		return response()->json($process);
    }

    public function guardar_estatus(Request $request, $id)
    {
    	$mytime = Carbon::now('America/Chihuahua');
    	$date = $mytime->toDateString();

    	$servicio = Servicios::findOrFail($id);
    	$servicio->estatus_registro = $request->estatus_registro;


    	if($request->estatus_registro == 'Terminado')
    	{
            $servicio->fecha_registro = $date;
            $servicio->listo_comision_venta = 1;
            $servicio->listo_comision_operativa = 1;
    		$servicio->listo_comision_gestion = 1;
    		$servicio->update();

    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $id)
    		    ->where('estatus', '=', 'Pendiente')
    		    ->update(['listo_comision' => '1',
    		                'estatus' => 'Liberada',
    		                'fecha_aplicada' => $date
    		            ]);

    		$control = DB::table('control')
    			->where('id', '=', $request->id_control)
    			->update(
    				[
    					'registrada' => '1',
    					'fecha_registrada' => $date
    				]);

    	}
    	else
    	{
    		$servicio->fecha_registro = null;
            $servicio->listo_comision_venta = 0;
            $servicio->listo_comision_operativa = 0;
            $servicio->listo_comision_gestion = 0;
    		$servicio->update();

    		$comision = DB::table('nomina')
    		    ->where('id_servicio', '=', $id)
    		    ->where('estatus', '=', 'Liberada')
    		    ->update(['listo_comision' => '0',
    		                'estatus' => 'Pendiente',
    		                'fecha_aplicada' => null
    		            ]);

    		$control = DB::table('control')
    			->where('id', '=', $request->id_control)
    			->update(
    				[
    					'registrada' => '0',
    					'fecha_registrada' => null
    				]);
    	}

    	return response()->json($servicio);
    }

    //Estatus
    public function enviar_estatus(Request $request)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'unique_with:bitacoras_estatus, id_servicio'
            ]);


        $estatus = new Estatus;
        $estatus->id_cliente=$request->id_cliente;
        $estatus->id_control=$request->id_control;
        $estatus->id_servicio=$request->id_servicio;
        $estatus->id_admin=$request->id_admin;
        $estatus->id_bitacoras_estatus=$request->id_bitacoras_estatus;
        $estatus->fecha_inicio=$request->fecha;
        //$estatus->fecha_vencimiento=$request->addYears('firma_fiel_fecha', 10);
        $estatus->carpeta_url=$request->carpeta;
        $estatus->estatus='Trámite';

        $estatus->save();

        $mensaje = array(
                    'message' => 'El servicio se envió a la bitácora de Estatus.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function postLogo(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

        $this->validate($request,
            [
                'logo_url' => 'image|mimes:jpeg,jpg,png,gif,svg'
            ]);

        if($request->hasFile('logo_url'))
        {
            $logo_url = $request->file('logo_url');
            $filename = time() . '.' . $logo_url->getClientOriginalExtension();
            $path = 'images/logos/' . $filename;
            Image::make($logo_url->getRealPath())->save($path);
            $servicio->logo_url = $filename;

            $servicio->update();
        }
        else
        {
            //
        }

        return response()->json($servicio);
    }

    public function crear_estatus(Request $request)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'required',
                //'numero_expediente' => 'unique:bitacoras_estatus',
                //'numero_registro' => 'unique:bitacoras_estatus',
                'id_estatus' => 'required'
            ]);

        $estatus = new Estatus;
        $estatus->id_marca = $request->id_marca;
        $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
        $estatus->id_estatus = $request->id_estatus;
        $estatus->id_cliente = $request->id_cliente;
        $estatus->id_admin = $request->id_admin;
        $estatus->id_clase = $request->id_clase;

        $estatus->id_subcategoria = $request->id_subcategoria;
        $estatus->comprobacion = $request->comprobacion;
        $estatus->comprobacion_uso = $request->comprobacion_uso;
        $estatus->fecha_comprobacion_uso = $request->fecha_comprobacion_uso;
        $estatus->vencimiento = $request->vencimiento;
        $estatus->fecha_vencimiento = $request->fecha_vencimiento;
        $estatus->recordatorio = $request->recordatorio;
        $estatus->fecha_recordatorio = $request->fecha_recordatorio;
        $estatus->renovacion = $request->renovacion;
        $estatus->numero_expediente = $request->numero_expediente;
        $estatus->numero_registro = $request->numero_registro;
        $estatus->fecha_inicio = $request->fecha_inicio;

        $estatus->save();

        $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'id_estatus' => $estatus->id
                    ]);

        return response()->json($estatus);

    }

    public function editar_estatus(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'required',
                //'numero_expediente' => 'unique:bitacoras_estatus',
                //'numero_registro' => 'unique:bitacoras_estatus',
                'id_estatus' => 'required'
            ]);

        $estatus = Estatus::findOrFail($id);
        $estatus->id_marca = $request->id_marca;
        $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
        $estatus->id_estatus = $request->id_estatus;
        $estatus->id_cliente = $request->id_cliente;
        $estatus->id_admin = $request->id_admin;
        $estatus->id_clase = $request->id_clase;

        $estatus->id_subcategoria = $request->id_subcategoria;
        $estatus->comprobacion = $request->comprobacion;
        $estatus->comprobacion_uso = $request->comprobacion_uso;
        $estatus->fecha_comprobacion_uso = $request->fecha_comprobacion_uso;
        $estatus->vencimiento = $request->vencimiento;
        $estatus->fecha_vencimiento = $request->fecha_vencimiento;
        $estatus->recordatorio = $request->recordatorio;
        $estatus->fecha_recordatorio = $request->fecha_recordatorio;
        $estatus->renovacion = $request->renovacion;
        $estatus->numero_expediente = $request->numero_expediente;
        $estatus->numero_registro = $request->numero_registro;
        $estatus->fecha_inicio = $request->fecha_inicio;

        $estatus->update();

        $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'id_estatus' => $id
                    ]);

        return response()->json($estatus);
    }

    //Check list

    public function check_list($variable)
    {
        $url_listar = '/admin/check-list/listado/';
        $url_buscar = '/admin/check-list/buscar/';
        $variable = $variable;

        return view('admin.servicios.check-list.index', compact('url_listar', 'url_buscar', 'variable'));
    }

    public function check_list_listado($estatus, $tramite, $pendiente)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->leftjoin('servicio_progreso as pro', 'pro.id_servicio', '=', 's.id')
            ->leftjoin('requisitos as req', 'pro.id_requisitos', '=', 'req.id')
            ->select('s.id', 's.id_control', 's.tramite', 's.descuento', 's.porcentaje_descuento', 's.costo', 's.estatus_registro', 's.cobrado', 's.saldo', 's.facturado', 's.fecha_cobranza', 's.fecha_registro', 's.mostrar_bitacora', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('count(pro.id_servicio) as conteo'), 's.created_at', 's.fecha')
            ->where('s.mostrar_bitacora', '=', '1')
            ->where('s.estatus_registro', '!=', 'Cancelado')
            ->groupBy('s.id', 's.id_control', 's.tramite', 's.descuento', 's.porcentaje_descuento', 's.costo', 's.estatus_registro', 's.cobrado', 's.saldo', 's.facturado', 's.fecha_cobranza', 's.fecha_registro', 's.mostrar_bitacora', 'cla.clave', 'cat.clave', 'cat.servicio', 'con.nombre', 'c.nombre_comercial', 'bit.clave', 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', 's.created_at', 's.updated_at', 's.fecha')
            ->orderBy('s.fecha', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($pendiente == 'todos')
            {

            }
            else if($pendiente != 'todos')
            {
                $servicios->where('req.categoria', '=', $pendiente)->where('pro.estatus', '=', '0');
            }

            if($tramite == 'todos')
            {
                //
            }
            else if($tramite == 'sin Bitacora')
            {
                $servicios->where('s.mostrar_bitacora', '=', '0');
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.servicios.check-list.listado', compact('servicios'));
    }

    public function check_list_buscar($estatus, $tramite, $pendiente, $buscar)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->leftjoin('servicio_progreso as pro', 'pro.id_servicio', '=', 's.id')
            ->leftjoin('requisitos as req', 'pro.id_requisitos', '=', 'req.id')
            ->select('s.id', 's.id_control', 's.tramite', 's.descuento', 's.porcentaje_descuento', 's.costo', 's.estatus_registro', 's.cobrado', 's.saldo', 's.facturado', 's.fecha_cobranza', 's.fecha_registro', 's.mostrar_bitacora', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', DB::raw('count(pro.id_servicio) as conteo'), 's.created_at', 's.fecha')
            ->where('s.mostrar_bitacora', '=', '1')
            ->where('s.estatus_registro', '!=', 'Cancelado')
            ->groupBy('s.id', 's.id_control', 's.tramite', 's.descuento', 's.porcentaje_descuento', 's.costo', 's.estatus_registro', 's.cobrado', 's.saldo', 's.facturado', 's.fecha_cobranza', 's.fecha_registro', 's.mostrar_bitacora', 'cla.clave', 'cat.clave', 'cat.servicio', 'con.nombre', 'c.nombre_comercial', 'bit.clave', 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio', 's.created_at', 's.updated_at', 's.fecha')
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
            ->orderBy('s.fecha', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_cobranza', '=', $estatus);
            }

            if($pendiente == 'todos')
            {

            }
            else if($pendiente != 'todos')
            {
                $servicios->where('req.categoria', '=', $pendiente)->where('pro.estatus', '=', '0');
            }

            if($tramite == 'todos')
            {
                //
            }
            else if($tramite == 'sin Bitacora')
            {
                $servicios->where('s.mostrar_bitacora', '=', '0');
            }
            else
            {
                $servicios->where('s.estatus_registro', '=', $tramite);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.servicios.check-list.listado', compact('servicios'));
    }

    public function check_list_detalles($id)
    {
        Carbon::setLocale('es');
        $detalles = DB::table('servicio_progreso as pro')
            ->leftjoin('users as u', 'u.id', '=', 'pro.id_admin')
            ->leftjoin('requisitos as r', 'r.id', '=', 'pro.id_requisitos')
            ->leftjoin('servicios as s', 's.id', '=', 'pro.id_servicio')
            ->select('pro.id', 'pro.estatus', 'pro.orden', 'pro.updated_at', 'u.iniciales', 'u.nombre', 'u.apellido', 'r.categoria', 'r.requisito', 'pro.libera_venta', 'pro.libera_operativa', 'pro.libera_gestion', 'pro.id_servicio', 'pro.registro', 's.id_control', 'pro.id_admin', 'pro.id_requisitos')
            ->where('pro.id_servicio', '=', $id)
            ->orderBy('pro.orden')
            ->get();

        $servicium = DB::table('servicios as s')
            ->select('s.avance', 's.avance_total')
            ->where('s.id', '=', $id)
            ->first();

        return view('admin.servicios.check-list.detalles-listado', compact('detalles', 'servicium'));
    }

    //Requisitos
    public function edit_requisito($id)
    {
        $servicio = Servicios::findOrFail($id);

        $tipo = 'Catalogo';
        $url_options = '/admin/check-list/requisitos-options/';
        $url_cargar_requisitos = '/admin/check-list/cargar-requisitos/';
        $url_requisitos = '/admin/check-list/requisitos';
        $url_store = '/admin/servicios/requisitos/store';
        $url_update = '/admin/servicios/requisitos/update/';
        $url_insertar = '/admin/check-list/requisitos/insertar';
        $url_eliminar = '/admin/check-list/requisitos/eliminar/';
        $url_subir = '/admin/check-list/requisitos/subir-orden/';
        $url_bajar = '/admin/check-list/requisitos/bajar-orden/';
        $url_liberar_comisiones = '/admin/check-list/requisitos/liberar-comisiones/';

        return view('admin.servicios.check-list.proceso', compact('servicio', 'tipo', 'url_options', 'url_cargar_requisitos', 'url_requisitos', 'url_store', 'url_update', 'url_insertar', 'url_eliminar', 'url_subir', 'url_bajar', 'url_liberar_comisiones'));
    }

    public function edit_requisito_vacio($id)
    {
        $servicio = Servicios::findOrFail($id);

        return view('admin.servicios.check-list.aplicar-catalogo', compact('servicio'));
    }

    public function getCatalogoServicio($id)
    {
        $requisitos = DB::table('servicio_requisitos as ser')
            ->leftjoin('requisitos as req', 'req.id', '=', 'ser.id_requisitos')
            ->select('ser.*', 'req.categoria', 'req.requisito')
            ->where('ser.id_catalogo_servicio', '=', $id)
            ->get();

        return view('admin.servicios.check-list.catalogo-listado', compact('requisitos'));
    }

    public function requisitos_options($id)
    {
        $array = DB::table('servicio_progreso as s')
            ->where('s.id_servicio', '=', $id) 
            ->pluck('s.id_requisitos');

        $requisitos = Requisitos::whereNotIn('id', $array)->select('id', 'categoria', 'requisito', 'estatus')->get();

        $requisitos_servicio = DB::table('requisitos as r')
            ->join('servicio_progreso as s', 's.id_requisitos', '=', 'r.id')
            ->select('r.*', 's.id as id_prog')
            ->where('s.id_servicio', '=', $id)
            ->get();

        //return $requisitos;

        return view('admin.servicios.check-list.requisitos_options', compact('requisitos', 'requisitos_servicio'));
    }

    public function cargar_requisitos($id)
    {
        Carbon::setLocale('es');
        $requisitos_listado = DB::table('servicio_progreso as s')
            ->join('requisitos as r', 's.id_requisitos', '=', 'r.id')
            ->select('s.*', 'r.categoria', 'r.requisito', 'r.estatus')
            ->where('s.id_servicio', '=', $id)
            ->orderBy('s.orden', 'asc')
            ->get();

        $ultimo_orden = ServiciosProceso::where('id_servicio', '=', $id)->orderBy('orden', 'desc')->first();
        //$penultimo_orden = ServiciosRequisitos::where('id_catalogo_servicio', '=', $id)->orderBy('orden', 'desc')->skip(1)->first();

        return view('admin.servicios.check-list.requisitos_listado', compact('requisitos_listado', 'ultimo_orden'/*, 'penultimo_orden'*/));
    }

    public function insertar_requisito(Request $request)
    {
        $requisito = new ServiciosProceso;
        $requisito->orden = $request->orden;
        $requisito->id_requisitos = $request->id_requisitos;
        $requisito->id_servicio = $request->id_servicio;
        $requisito->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'avance_total' => $request->avance_total
                ]);

        return response()->json($requisito);
    }

    public function eliminar_requisito(Request $request, $id)
    {
        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'avance_total' => $request->avance_total
                ]);

        $requisito = ServiciosProceso::findOrFail($id);
        $requisito->delete();

        return response()->json($requisito);
    }

    public function requisito_subir(Request $request, $id, $orden)
    {
        if($orden == 1)
        {
            $mensaje = 'No se puede disminuir el orden en el primer registro';
            return response()->json($mensaje);
        }
        else if($orden > 1)
        {
            $sustituido = $orden - 1;

            $requisito_reemplazar = DB::table('servicio_progreso')
                ->where('orden', '=', $sustituido)
                ->where('id_servicio', '=', $request->id_servicio)
                ->update(
                    [
                        'orden' => $orden
                    ]);

            $requisito = DB::table('servicio_progreso')
                ->where('id', '=', $id)
                ->update(
                    [
                        'orden' => $sustituido
                    ]);

            return response()->json($requisito);
        }
    }

    public function requisito_bajar(Request $request, $id, $orden)
    {
        if($orden >= $request->ultimo_orden)
        {
            $mensaje = 'No se puede aumentar el orden en el último registro';
            return response()->json($mensaje);
        }
        else if($orden < $request->ultimo_orden)
        {
            $sustituido = $orden + 1;

            $requisito_reemplazar = DB::table('servicio_progreso')
                ->where('orden', '=', $sustituido)
                ->where('id_servicio', '=', $request->id_servicio)
                ->update(
                    [
                        'orden' => $orden
                    ]);

            $requisito = DB::table('servicio_progreso')
                ->where('id', '=', $id)
                ->update(
                    [
                        'orden' => $sustituido
                    ]);

            return response()->json($requisito);
        }
    }

    public function liberar_comisiones($num, $id, $id_servicio)
    {
        if($num == 1)
        {
            $quitar_comision = DB::table('servicio_progreso')
                ->where('id_servicio', '=', $id_servicio)
                ->update(
                    [
                        'libera_venta' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_progreso')
                ->where('id', '=', $id)
                ->update(
                    [
                        'libera_venta' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
        else if($num == 2)
        {
            $quitar_comision = DB::table('servicio_progreso')
                ->where('id_servicio', '=', $id_servicio)
                ->update(
                    [
                        'libera_operativa' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_progreso')
                ->where('id', '=', $id)
                ->update(
                    [
                        'libera_operativa' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
        else if($num == 3)
        {
            $quitar_comision = DB::table('servicio_progreso')
                ->where('id_catalogo_servicio', '=', $id_catalogo_servicio)
                ->update(
                    [
                        'libera_gestion' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_progreso')
                ->where('id', '=', $id)
                ->update(
                    [
                        'libera_gestion' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
        else if($num == 4)
        {
            $quitar_comision = DB::table('servicio_progreso')
                ->where('id_catalogo_servicio', '=', $id_catalogo_servicio)
                ->update(
                    [
                        'registro' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_progreso')
                ->where('id', '=', $id)
                ->update(
                    [
                        'registro' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
    }
}















