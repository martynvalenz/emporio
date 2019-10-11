<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\User;
use Emporio\Model\Proveedores;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\CategoriaEgresos;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\ServiciosPagos;
use Emporio\Model\TarjetasCredito;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class EgresosGeneralesController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('es');
        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()/*->addMonth(-4)*/;
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();

        //$proveedores = Proveedores::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $cuentas_credito = Cuentas::orderBy('id','asc')->where('estatus','=','1')->where('id', '!=', '1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->where('id', '!=', 4)->get();
        //$categoria_egresos = CategoriaEgresos::orderBy('categoria','asc')->where('estatus','=','1')->get();
        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $clientes = Clientes::where('estatus', '=', '1')->orderBy('nombre_comercial')->get();
        $servicios = Servicios::orderBy('tramite', 'asc')->get();

        $seccion = 'Egresos';
        $tipo_egreso = 'Despacho';
        $variable_estatus = 'todo';
        $url_listar = '/admin/egresos-listar/';
        $url_buscar = '/admin/egresos-buscar/';
        $url_actualizar = '/admin/egresos/actualizar-egreso/';

        return view('admin.egresos.generales.index',compact('cuentas', 'formas_pago', 'porcentaje_iva', 'clientes', 'servicios', 'fecha_inicio', 'fecha_fin', 'tipo_egreso', 'variable_estatus', 'url_listar', 'url_buscar', 'url_actualizar', 'seccion', 'cuentas_credito'));
    }

    public function listar($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $egresos=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->leftjoin('servicios as ser', 'e.id_servicio', '=', 'ser.id')
            ->leftjoin('catalogo_servicios as cat_ser', 'ser.id_catalogo_servicio', '=', 'cat_ser.id')
            ->select('e.id', 'e.tipo', 'e.concepto', 'e.fecha', 'e.con_iva', 'e.folio', 'e.cheque', 'e.movimiento', 'e.subtotal', 'e.porcentaje_iva', 'e.iva', 'e.total', 'e.estatus','e.id_categoria', 'e.id_forma_pago', 'e.id_cuenta', 'e.id_admin', 'e.id_proveedor', 'e.id_cliente', 'e.id_servicio', 'p.nombre_comercial', 'p.razon_social', 'p.rfc', 'f.forma_pago', 'f.codigo', 'cu.alias', 'cu.tipo as tarjeta_tipo', 'a.iniciales', 'a.nombre', 'a.apellido', 'cat.clasificacion', 'cat.categoria', 'cat.cuenta', 'cat.subcuenta', 'ban.banco', 'e.created_at', 'e.updated_at', 'e.cancelado_at', 'e.pagado', 'e.pagado_boolean', 'cli.nombre_comercial as cliente', 'cat_ser.clave', 'cat_ser.servicio', 'ser.tramite', 'ser.clase', 'ser.id as servicio_id', 'e.deposito', 'e.retiro')
            //->whereNotNull('fecha')
            //->where('e.estatus', '!=', 'Pendiente')
            ->where('e.tipo', '!=', 'Ingreso')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->orderBy('e.fecha', 'asc')
            ->orderBy('e.created_at', 'asc');

            
            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todo')
            {
                //
            }
            else if($forma_pago != 'todo')
            {
                $egresos->where('e.id_forma_pago', '=', $forma_pago);
            }

            $egresos = $egresos->paginate(50);

        $estados = DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->leftjoin('servicios as ser', 'e.id_servicio', '=', 'ser.id')
            ->leftjoin('catalogo_servicios as cat_ser', 'ser.id_catalogo_servicio', '=', 'cat_ser.id')
            ->select(DB::raw('sum(e.deposito) as ingreso'))
            ->addSelect(DB::raw('sum(e.retiro) as egreso'))
            ->where('e.pagado_boolean', '=', '1')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin);

            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('e.id_cuenta', '=', $cuenta);
            }  

            if($forma_pago == 'todo')
            {
                //
            }
            else if($forma_pago != 'todo')
            {
                $egresos->where('e.id_forma_pago', '=', $forma_pago);
            }

        $estados =  $estados->get();

        return view('admin.egresos.generales.listado', compact('egresos', 'estados'));
    }

    public function buscar($estatus, $tipo, $cuenta, $forma_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
        $egresos=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->leftjoin('servicios as ser', 'e.id_servicio', '=', 'ser.id')
            ->leftjoin('catalogo_servicios as cat_ser', 'ser.id_catalogo_servicio', '=', 'cat_ser.id')
            ->select('e.id', 'e.tipo', 'e.concepto', 'e.fecha', 'e.con_iva', 'e.folio', 'e.cheque', 'e.movimiento', 'e.subtotal', 'e.porcentaje_iva', 'e.iva', 'e.total', 'e.estatus','e.id_categoria', 'e.id_forma_pago', 'e.id_cuenta', 'e.id_admin', 'e.id_proveedor', 'e.id_cliente', 'e.id_servicio', 'p.nombre_comercial', 'p.razon_social', 'p.rfc', 'f.forma_pago', 'f.codigo', 'cu.alias', 'cu.tipo as tarjeta_tipo', 'a.iniciales', 'a.nombre', 'a.apellido', 'cat.clasificacion', 'cat.categoria', 'cat.cuenta', 'cat.subcuenta', 'ban.banco', 'e.created_at', 'e.updated_at', 'e.cancelado_at', 'e.pagado', 'e.pagado_boolean', 'cli.nombre_comercial as cliente', 'cat_ser.clave', 'cat_ser.servicio', 'ser.tramite', 'ser.clase', 'ser.id as servicio_id', 'e.deposito', 'e.retiro')
            //->whereNotNull('fecha')
            //->where('e.estatus', '!=', 'Pendiente')
            ->where('e.tipo', '!=', 'Ingreso')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where(function($q) use ($buscar)
            {
                $q->where('e.id','LIKE',$buscar)
                ->orWhere('e.tipo','LIKE','%'.$buscar.'%')
                ->orWhere('e.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('e.folio','LIKE','%'.$buscar.'%')
                ->orWhere('e.cheque','LIKE','%'.$buscar.'%')
                ->orWhere('e.movimiento','LIKE','%'.$buscar.'%')
                ->orWhere('e.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('e.total','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('ban.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cat.cuenta','LIKE','%'.$buscar.'%')
                ->orWhere('cat.subcuenta','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('ser.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('e.fecha', 'asc')
            ->orderBy('e.created_at', 'asc');
            
            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todo')
            {
                //
            }
            else if($forma_pago != 'todo')
            {
                $egresos->where('e.id_forma_pago', '=', $forma_pago);
            }

            $egresos = $egresos->paginate(50);

        $estados = DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->leftjoin('servicios as ser', 'e.id_servicio', '=', 'ser.id')
            ->leftjoin('catalogo_servicios as cat_ser', 'ser.id_catalogo_servicio', '=', 'cat_ser.id')
            ->select(DB::raw('sum(e.deposito) as ingreso'))
            ->addSelect(DB::raw('sum(e.retiro) as egreso'))
            ->where('e.pagado_boolean', '=', '1')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where(function($q) use ($buscar)
            {
                $q->where('e.id','LIKE',$buscar)
                ->orWhere('e.tipo','LIKE','%'.$buscar.'%')
                ->orWhere('e.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('e.folio','LIKE','%'.$buscar.'%')
                ->orWhere('e.cheque','LIKE','%'.$buscar.'%')
                ->orWhere('e.movimiento','LIKE','%'.$buscar.'%')
                ->orWhere('e.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('e.total','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('ban.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cat.cuenta','LIKE','%'.$buscar.'%')
                ->orWhere('cat.subcuenta','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('ser.tramite','LIKE','%'.$buscar.'%');
            });

            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('e.id_cuenta', '=', $cuenta);
            }  

            if($forma_pago == 'todo')
            {
                //
            }
            else if($forma_pago != 'todo')
            {
                $egresos->where('e.id_forma_pago', '=', $forma_pago);
            }

        $estados =  $estados->get();

        return view('admin.egresos.generales.listado', compact('egresos', 'estados'));
    }

    public function exportar($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $egresos=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->leftjoin('servicios as ser', 'e.id_servicio', '=', 'ser.id')
            ->leftjoin('catalogo_servicios as cat_ser', 'ser.id_catalogo_servicio', '=', 'cat_ser.id')
            ->select('e.id', 'e.tipo', 'e.concepto', 'e.fecha', 'e.con_iva', 'e.folio', 'e.cheque', 'e.movimiento', 'e.subtotal', 'e.porcentaje_iva', 'e.iva', 'e.total', 'e.estatus','e.id_categoria', 'e.id_forma_pago', 'e.id_cuenta', 'e.id_admin', 'e.id_proveedor', 'e.id_cliente', 'e.id_servicio', 'p.nombre_comercial', 'p.razon_social', 'p.rfc', 'f.forma_pago', 'f.codigo', 'cu.alias', 'cu.tipo as tarjeta_tipo', 'a.iniciales', 'a.nombre', 'a.apellido', 'cat.clasificacion', 'cat.categoria', 'cat.cuenta', 'cat.subcuenta', 'ban.banco', 'e.created_at', 'e.updated_at', 'e.cancelado_at', 'e.pagado', 'cli.nombre_comercial as cliente', 'cat_ser.clave', 'cat_ser.servicio', 'ser.tramite', 'ser.clase', 'ser.id as servicio_id', 'e.deposito', 'e.retiro', 'e.pagado_boolean')
            //->whereNotNull('fecha')
            //->where('e.estatus', '!=', 'Pendiente')
            ->where('e.tipo', '!=', 'Ingreso')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->orderBy('e.fecha', 'asc')
            ->orderBy('e.created_at', 'asc');

            
            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todo')
            {
                //
            }
            else if($forma_pago != 'todo')
            {
                $egresos->where('e.id_forma_pago', '=', $forma_pago);
            }

            $egresos = $egresos->get();

        return view('admin.egresos.generales.exportar', compact('egresos'));
    }

    public function actualizarEgreso($id_egreso)
    {
        $egreso=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->leftjoin('servicios as ser', 'e.id_servicio', '=', 'ser.id')
            ->leftjoin('catalogo_servicios as cat_ser', 'ser.id_catalogo_servicio', '=', 'cat_ser.id')
            ->select('e.id', 'e.tipo', 'e.concepto', 'e.fecha', 'e.con_iva', 'e.folio', 'e.cheque', 'e.movimiento', 'e.subtotal', 'e.porcentaje_iva', 'e.iva', 'e.total', 'e.estatus','e.id_categoria', 'e.id_forma_pago', 'e.id_cuenta', 'e.id_admin', 'e.id_proveedor', 'e.id_cliente', 'e.id_servicio', 'p.nombre_comercial', 'p.razon_social', 'p.rfc', 'f.forma_pago', 'f.codigo', 'cu.alias', 'cu.tipo as tarjeta_tipo', 'a.iniciales', 'a.nombre', 'a.apellido', 'cat.clasificacion', 'cat.categoria', 'cat.cuenta', 'cat.subcuenta', 'ban.banco', 'e.created_at', 'e.updated_at', 'e.cancelado_at', 'e.pagado', 'cli.nombre_comercial as cliente', 'cat_ser.clave', 'cat_ser.servicio', 'ser.tramite', 'ser.clase', 'ser.id as servicio_id', 'e.pagado_boolean')
            ->where('e.id', '=', $id_egreso)
            ->first();

        return view('admin.egresos.generales.listado-egreso', compact('egreso'));
    }

    public function getTipoEgreso($tipo)
    {
    	$categoria = CategoriaEgresos::orderBy('categoria', 'asc')
    		->where('estatus', '=', '1')
            ->where('clasificacion', '=', $tipo)
            ->get();
        return Response::json($categoria);
    }

    public function getTipoEgreso_edit($tipo)
    {
    	$categoria = CategoriaEgresos::orderBy('categoria', 'asc')
    		->where('estatus', '=', '1')
            ->where('clasificacion', '=', $tipo)
            ->get();
        return Response::json($categoria);
    }

    public function cargarProveedores($estatus)
    {
        $proveedores = DB::table('proveedores')
            ->select('id', 'nombre_comercial as proveedor', 'realiza_pagos')
            ->where('estatus', '=', $estatus)
            ->orderBy('nombre_comercial', 'asc')
            ->get();

        return response()->json($proveedores);
    }

    public function cargarCategorias($estatus)
    {
        $categoria = DB::table('categoria_egresos')
            ->select('id', 'categoria')
            ->where('estatus', '=', $estatus)
            ->orderBy('categoria', 'asc')
            ->get();

        return response()->json($categoria);
    }

    public function mostrarServiciosPendientes($aplicar_servicios)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->select('s.id','s.tramite', 's.clase', 's.moneda', 's.costo', 's.responsable_venta', 's.responsable_operativo', 'responsable_gestion', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 's.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.descuento', 's.porcentaje_descuento', 's.id_control', 's.mostrar_bitacora')
            ->where('s.asignar_costo_servicio', '=', $aplicar_servicios)
            ->where('s.costo_pagado', '=', '0')
            ->where('s.costo_servicio', '>', 0)
            ->orderBy('s.created_at', 'desc')
            ->get();

        $total=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->select(DB::raw('sum(f.total) as suma_total'))
            ->where('s.asignar_costo_servicio', '=', $aplicar_servicios)
            ->where('s.costo_pagado', '=', '0')
            ->where('s.costo_servicio', '>', 0)
            ->sum('s.costo_servicio');

        return view('admin.egresos.generales.servicios', compact('servicios', 'total'));
    }

    public function mostrarServiciosPagados($id_egreso)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('servicios_pagos as pag', 'pag.id_servicio', '=', 's.id')
            ->leftjoin('estados_cuenta as e', 'e.id', '=', 'pag.id_egreso')
            ->select('s.id','s.tramite', 's.clase', 's.moneda', 's.costo', 's.responsable_venta', 's.responsable_operativo', 'responsable_gestion', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 's.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.descuento', 's.porcentaje_descuento', 's.id_control', 's.mostrar_bitacora')
            ->where('e.id', '=', $id_egreso)
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('admin.egresos.generales.servicios-pagados', compact('servicios'));
    }

    public function egreso_creado($get)
    {
        $egreso = DB::table('estados_cuenta')
            ->select('id', 'total', 'restante')
            ->where('cerrado_boolean', '=', $get)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json($egreso);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'tipo' => 'required',
                'id_categoria' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'porcentaje_iva' => 'required|numeric|min:0',
                'total' => 'required|numeric',
                'retiro' => 'required|numeric|min:0',
                'fecha' => 'required'
            ]);

        $egreso = new EstadosCuenta;
        $egreso->tipo=$request->tipo;
        $egreso->concepto=$request->concepto;
        $egreso->fecha=$request->fecha;
        $egreso->con_iva = $request->con_iva;

        if($request->con_iva == '1')
        {
        	$val_total = $request->total;
            $egreso->retiro = $request->retiro;
        	$porcentaje = $request->porcentaje_iva;
            $egreso->porcentaje_iva=$request->porcentaje_iva;
            $subtotal_calc = $val_total / (1 + ($porcentaje/100));
            $iva_calc = $val_total - $subtotal_calc;

        	$egreso->total = $request->total;
        	$egreso->subtotal = $subtotal_calc;
        	$egreso->iva = $iva_calc;
        }
        else
        {
        	$egreso->total=$request->total;
            $egreso->retiro = $request->retiro;
        	$egreso->subtotal=$request->total;
        	$egreso->iva=0;
            $egreso->porcentaje_iva=0;
        }

        $egreso->restante = $request->retiro;
        $egreso->cheque=$request->cheque;
        $egreso->movimiento=$request->movimiento;
        $egreso->pagado_boolean=1;
        $egreso->cerrado_boolean=1;
        $egreso->pagado=0;

        $egreso->id_proveedor=$request->id_proveedor;
        $egreso->id_admin=$request->id_admin;
        $egreso->id_cuenta=$request->id_cuenta;
        $egreso->id_forma_pago=$request->id_forma_pago;
        $egreso->id_categoria=$request->id_categoria;
        $egreso->estatus = 'Pagado';
        
        $egreso->save();

        return response()->json($egreso);
    }

    public function InsertarServicio(Request $request)
    {
        $this->validate($request,
            [
                'id_servicio' => 'required',
                'id_egreso' => 'required',
                'id_admin' => 'required',
                'total' => 'required|numeric|min:0',
                'fecha' => 'required'
            ]);

        $restante = $request->restante - $request->total;
        $pagado = $request->pagado + $request->total;

        $servicio = DB::table('servicios')
        ->where('id', '=', $request->id_servicio)
        ->update(
            [
                'costo_pagado' => 1,
                'revision_boolean' => 1,
                'revision_fecha' => $request->fecha,
                'pago_marca_fecha' => $request->fecha,
                'revision' => 'Realizado',
                'pago_marca' => 'Realizado'

            ]);

        $estado_cuenta = DB::table('estados_cuenta')
        ->where('id', '=', $request->id_egreso)
        ->update(
            [
                'restante' => $restante,
                'pagado' => $pagado
            ]);

        $pago = new ServiciosPagos;
        $pago->monto = $request->total;
        $pago->id_servicio = $request->id_servicio;
        $pago->id_admin = $request->id_admin;
        $pago->id_control = $request->id_control;
        $pago->id_egreso = $request->id_egreso;
        $pago->save();

        return response()->json($pago);
    }

    public function edit($id)
    {
        Carbon::setLocale('es');

        $egreso = DB::table('estados_cuenta as e')
            ->leftjoin('proveedores as p', 'p.id', '=', 'e.id_proveedor')
            ->leftjoin('categoria_egresos as c', 'c.id', '=', 'e.id_categoria')
            /*->join('formas_pago as f', 'f.id', '=', 'e.id_forma_pago')
            ->join('cuentas as c', 'c.id', '=', 'e.id_cuenta')*/
            ->select('e.*', 'p.id as id_proveedor', 'p.realiza_pagos', 'p.nombre_comercial as proveedor', 'c.categoria')
            ->where('e.id', '=', $id)
            ->first();

        return response()->json($egreso);
    }

    public function update(Request $request, $id)
    {
        $egreso = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'concepto' => 'max:256',
                'tipo' => 'required',
                'id_categoria' => 'required',
                'id_cuenta' => 'required',
                'porcentaje_iva' => 'required|numeric|min:0',
                'total' => 'required|numeric',
                'retiro' => 'required|numeric|min:0',
                'fecha' => 'required',
                'id_forma_pago' => 'required',
            ]);

        $egreso->tipo=$request->tipo;
        $egreso->concepto=$request->concepto;
        $egreso->fecha=$request->fecha;
        $egreso->con_iva = $request->con_iva;

        if($request->con_iva == '1')
        {
            $val_total = $request->total;
            $egreso->retiro = $request->retiro;
            $porcentaje = $request->porcentaje_iva;
            $egreso->porcentaje_iva=$request->porcentaje_iva;
            $subtotal_calc = $val_total / (1 + ($porcentaje/100));
            $iva_calc = $val_total - $subtotal_calc;

            $egreso->total = $request->total;
            $egreso->subtotal = $subtotal_calc;
            $egreso->iva = $iva_calc;
        }
        else
        {
            $egreso->total=$request->total;
            $egreso->retiro = $request->retiro;
            $egreso->subtotal=$request->total;
            $egreso->iva=0;
            $egreso->porcentaje_iva=0;
        }

        $egreso->restante = $request->retiro - $request->pagado;
        $egreso->cheque=$request->cheque;
        $egreso->movimiento=$request->movimiento;
        //$egreso->pagado_boolean=1;
        $egreso->cerrado_boolean=1;

        $egreso->id_proveedor=$request->id_proveedor;
        $egreso->id_admin=$request->id_admin;
        $egreso->id_cuenta=$request->id_cuenta;
        $egreso->id_forma_pago=$request->id_forma_pago;
        $egreso->id_categoria=$request->id_categoria;
        $egreso->estatus = 'Pagado';
        
        $egreso->update();

        return response()->json($egreso);
    }

    public function agregarCategoria(Request $request)
    {
        $this->validate($request,
            [
                'clasificacion' => 'required',
                'categoria' => 'required|unique_with:categoria_egresos, clasificacion',
            ]);

        $categoria = new CategoriaEgresos;
        $categoria->clasificacion = $request->clasificacion;
        $categoria->categoria = $request->categoria;
        $categoria->descripcion = $request->descripcion;
        $categoria->estatus = 1;

        $categoria->save();

        return response()->json($categoria);
    }

    public function agregarProveedor(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial' => 'required|unique:proveedores'
            ]);

        $proveedor = new Proveedores;
        $proveedor->nombre_comercial = $request->nombre_comercial;
        $proveedor->id_admin = $request->id_admin;
        $proveedor->estatus = 1;
        $proveedor->save();

        return response()->json($proveedor);
    }

    // Tarjetas de crédito
    public function tarjeta_pendientes($id_cuenta, $restante)
    {
        Carbon::setLocale('es');
        $egresos = DB::table('tarjetas_credito as t')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select('t.*', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria', 'cu.alias', 'a.iniciales', 'a.nombre', 'a.apellido', 'b.banco')
            ->where('t.id_cuenta', '=', $id_cuenta)
            ->where('t.pagado_boolean', '=', '0')
            ->where('t.estatus', '=', 'Pendiente')
            ->orderBy('t.fecha', 'asc')
            ->get();

        $monto_pendiente = DB::table('tarjetas_credito as t')
            ->select(DB::raw('sum(t.saldo) as saldo'))
            ->where('t.id_cuenta', '=', $id_cuenta)
            ->sum('t.saldo');

        $restante = $restante;

        return view('admin.egresos.generales.tarjeta-credito-pendientes', compact('egresos', 'monto_pendiente', 'restante'));
    }

    public function tarjeta_pagados($id_egreso)
    {
        Carbon::setLocale('es');
        $egresos = DB::table('tarjetas_credito_detalle as det')
            ->join('tarjetas_credito as t', 't.id', '=', 'det.id_tarjeta')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select('det.*',  'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria', 'cu.alias', 'a.iniciales', 'a.nombre', 'a.apellido', 'b.banco', 't.saldo', 't.concepto', 't.tipo', 't.con_iva')
            ->where('det.id_egreso', '=', $id_egreso)
            ->orderBy('det.fecha', 'asc')
            ->get();

        $monto_pagado = DB::table('tarjetas_credito_detalle as det')
            ->join('tarjetas_credito as t', 't.id', '=', 'det.id_tarjeta')
            ->select(DB::raw('sum(det.total) as pagado'))
            ->where('det.id_egreso', '=', $id_egreso)
            ->sum('det.total');

        $id_egreso = $id_egreso;

        return view('admin.egresos.generales.tarjeta-credito-pagados', compact('egresos', 'monto_pagado', 'id_egreso'));
    }

    public function pagarEgresoTarjeta(Request $request, $id, $id_tarjeta)
    {
        $mytime = Carbon::now('America/Chihuahua');
        $fecha_actual = $mytime->toDateString();

        //tarjeta
        $saldo = $request->saldo - $request->pagado;
        $pagado = $request->pagado + $request->pagado_ant;

        if($saldo == 0)
        {
            $pagado_boolean = 1;
            $estatus = 'Pagado';
            $fecha_pagado = $request->fecha;
        }
        else if($saldo > 0)
        {
            $pagado_boolean = 0;
            $estatus = 'Pendiente';
            $fecha_pagado = NULL;
        }

        //Egreso
        $restante = $request->restante - $request->pagado;
        $pagado_egreso = $request->total_ant + $pagado;
        $total = $request->total_ant + $request->pagado;

        $fraccion_total = $request->pagado / $request->total_tarjeta;
        $iva_fraccion = $request->iva * $fraccion_total;
        $subtotal_fraccion = $request->subtotal * $fraccion_total;

        $subtotal = $request->subtotal_ant + $subtotal_fraccion;
        $iva = $request->iva_ant + $iva_fraccion;

        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->restante = $restante;
        $egreso->pagado = $pagado_egreso;
        $egreso->total = $total;
        $egreso->iva = $iva;
        $egreso->subtotal = $subtotal;
        $egreso->update();

        $tarjeta = DB::table('tarjetas_credito')
            ->where('id', '=', $id_tarjeta)
            ->update(
                [
                    'fecha_pagado' => $fecha_pagado,
                    'saldo' => $saldo,
                    'pagado' => $pagado,
                    'pagado_boolean' => $pagado_boolean,
                    'estatus' => $estatus,
                    'updated_at' => $fecha_actual
                ]);

        $detalle_tarjeta = DB::table('tarjetas_credito_detalle')
            ->insert(
                [
                    'subtotal' => $subtotal_fraccion,
                    'iva' => $iva_fraccion,
                    'total' => $request->pagado,
                    'fecha' => $fecha_pagado,
                    'pagado' => $pagado_boolean,
                    'id_egreso' => $id,
                    'id_admin' => $request->id_admin,
                    'id_tarjeta' => $request->id_tarjeta,
                    'created_at' => $fecha_actual,
                    'updated_at' => $fecha_actual

                ]);

        return response()->json($egreso);
    }

    public function quitarEgresoTarjeta(Request $request, $id, $id_tarjeta)
    {
        $mytime = Carbon::now('America/Chihuahua');
        $fecha_actual = $mytime->toDateString();
    }
}
