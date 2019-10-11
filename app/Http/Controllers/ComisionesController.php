<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Emporio\Model\Nomina;
use Emporio\User;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\EstadosCuenta;
use DB;

class ComisionesController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $admins = DB::table('users as a')
            ->select('a.id', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('a.estatus','=','1')
            ->where('a.acepta_comision','=','1')
            ->get();

        $tipo = 'Comision';

        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()/*->addMonth(-4)*/;
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();

        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();

        $variable_estatus = 'Liberada';
        $url_listar = '/admin/comisiones-listar/';
        $url_buscar = '/admin/comisiones-buscar/';
        //$url_actualizar = '/admin/procesos/actualizar/';

        return view('admin.comisiones.egresos.index', compact('admins', 'cuentas', 'formas_pago', 'variable_estatus', 'url_listar', 'url_buscar'/*', url_actualizar'*/, 'fecha_inicio', 'fecha_fin', 'tipo'));
    }

    public function listar($id_admin, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('estados_cuenta as e')
            ->join('users as a', 'a.id', '=', 'e.id_admin')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
            ->select('e.*', 'cu.alias', 'f.forma_pago', 'f.codigo', 'cat.categoria', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where(function($q)
            {
                $q->where('e.tipo','=', 'Comision')
                ->orWhere('e.tipo','=', 'Nomina');
            })
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.created_at', 'desc');

            if($id_admin == 'todo')
            {
                //
            }
            else if($id_admin != 'todo')
            {
                $comisiones->where('e.id_admin', '=', $id_admin);
            }

            $comisiones = $comisiones->paginate(30);

        return view('admin.comisiones.egresos.listado', compact('comisiones'));
    }

    public function index_usuario()
    {
        Carbon::setLocale('es');
        $admins = DB::table('users as a')
            ->select('a.id', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('a.estatus','=','1')
            ->where('a.acepta_comision','=','1')
            ->get();

        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()/*->addMonth(-4)*/;
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();
        $tipo = 'Usuario';

        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();

        $variable_estatus = 'Liberada';
        $url_listar = '/admin/comisiones-listar-usuario/';
        $url_buscar = '/admin/comisiones-buscar-usuario/';
        $url_actualizar = '/admin/comisiones-actualizar/';

        return view('admin.comisiones.index', compact('admins', 'cuentas', 'formas_pago', 'variable_estatus', 'url_listar', 'url_buscar', 'url_actualizar', 'fecha_inicio', 'fecha_fin', 'tipo'));
    }

    public function listar_usuario($estatus, $id_admin)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->orderBy('n.created_at', 'desc');
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $comisiones->where('n.estatus', '=', $estatus);
            }

            /*if($estatus_cobranza == 'todos')
            {
                //
            }
            else if($estatus_cobranza != 'todos')
            {
                $comisiones->where('s.estatus_cobranza', '=', $estatus_cobranza);
            }*/

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $comisiones->where('n.id_admin', '=', $id_admin);
            }


            $comisiones = $comisiones->paginate(100);

        $total_filtrado = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->select(DB::raw('sum(n.monto)'));
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $total_filtrado->where('n.estatus', '=', $estatus);
            }

            /*if($estatus_cobranza == 'todos')
            {
                //
            }
            else if($estatus_cobranza != 'todos')
            {
                $total_filtrado->where('s.estatus_cobranza', '=', $estatus_cobranza);
            }*/

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $total_filtrado->where('n.id_admin', '=', $id_admin);
            }

            $total_filtrado = $total_filtrado->sum('n.monto');
            //return $total_filtrado;

        return view('admin.comisiones.listado', compact('comisiones', 'total_filtrado'));
        
    }

    public function buscar_usuario($estatus, $id_admin, $buscar)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where(function($q) use ($buscar)
            {
                $q->where('n.id_servicio','LIKE',$buscar)
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('s.id','LIKE','%'.$buscar.'%')
                ->orWhere('n.tipo_comision','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('n.created_at', 'desc');
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $comisiones->where('n.estatus', '=', $estatus);
            }

            /*if($estatus_cobranza == 'todos')
            {
                //
            }
            else if($estatus_cobranza != 'todos')
            {
                $comisiones->where('s.estatus_cobranza', '=', $estatus_cobranza);
            }*/

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $comisiones->where('n.id_admin', '=', $id_admin);
            }


            $comisiones = $comisiones->paginate(100);

            $total_filtrado = DB::table('nomina as n')
                ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as con', 'con.id', '=', 's.id_control')
                ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
                ->select(DB::raw('sum(n.monto)'))
                ->where(function($q) use ($buscar)
                {
                    $q->where('n.id_servicio','LIKE',$buscar)
                    ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                    ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('s.id','LIKE','%'.$buscar.'%')
                    ->orWhere('n.tipo_comision','LIKE','%'.$buscar.'%')
                    ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%')
                    ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
                });

                if($estatus == 'todos')
                {
                    //
                }
                else if($estatus != 'todos')
                {
                    $total_filtrado->where('n.estatus', '=', $estatus);
                }

                /*if($estatus_cobranza == 'todos')
                {
                    //
                }
                else if($estatus_cobranza != 'todos')
                {
                    $total_filtrado->where('s.estatus_cobranza', '=', $estatus_cobranza);
                }*/

                if($id_admin == '0')
                {
                    //
                }
                else if($id_admin > 0)
                {
                    $total_filtrado->where('n.id_admin', '=', $id_admin);
                }

                $total_filtrado = $total_filtrado->sum('n.monto');

        return view('admin.comisiones.listado', compact('comisiones', 'total_filtrado'));
    }

    public function actualizarComision($id)
    {
        Carbon::setLocale('es');
        $comision = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where('n.id', '=', $id)
            ->first();

        return view('admin.comisiones.listado-actualizar', compact('comision'));
    }

    public function listadoAsignacion()
    {
        Carbon::setLocale('es');
        $servicios = DB::table('servicios as s')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('s.id', 's.tramite', 's.fecha', 's.costo', 's.estatus_cobranza', 's.estatus_registro', 'comision_venta_restante', 'comision_operativa_restante', 'comision_gestion_restante', 'aplica_comision_venta', 'listo_comision_venta', 'aplica_comision_operativa', 'listo_comision_operativa', 'aplica_comision_gestion', 'listo_comision_gestion', 'cat.clave', 'cat.servicio', 'c.nombre_comercial', 'con.nombre as marca', 'cla.clave as clase')
            ->where('s.estatus_registro', '!=', 'Cancelado')
            ->where(function($x)
            {
                $x->where('comision_venta_restante', '>', 0)
                ->orWhere('comision_operativa_restante', '>', 0)
                ->orWhere('comision_gestion_restante', '>', 0);
            })
            ->where(function($y)
            {
                $y->where('aplica_comision_venta', '=', '1')
                ->orWhere('aplica_comision_gestion', '=', '1')
                ->orWhere('aplica_comision_operativa', '=', '1');
            })
            ->orderBy('s.fecha', 'desc')
            ->paginate(50);

        return view('admin.comisiones.listado-asignacion', compact('servicios'));
    }

    public function listadoAsignacionBuscar($buscar)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('servicios as s')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('s.id', 's.tramite', 's.fecha', 's.costo', 's.estatus_cobranza', 's.estatus_registro', 'comision_venta_restante', 'comision_operativa_restante', 'comision_gestion_restante', 'aplica_comision_venta', 'listo_comision_venta', 'aplica_comision_operativa', 'listo_comision_operativa', 'aplica_comision_gestion', 'listo_comision_gestion', 'cat.clave', 'cat.servicio', 'c.nombre_comercial', 'con.nombre as marca', 'cla.clave as clase')
            ->where('s.estatus_registro', '!=', 'Cancelado')
            ->where(function($x)
            {
                $x->where('comision_venta_restante', '>', 0)
                ->orWhere('comision_operativa_restante', '>', 0)
                ->orWhere('comision_gestion_restante', '>', 0);
            })
            ->where(function($y)
            {
                $y->where('aplica_comision_venta', '=', '1')
                ->orWhere('aplica_comision_gestion', '=', '1')
                ->orWhere('aplica_comision_operativa', '=', '1');
            })
            ->where(function($q) use ($buscar)
            {
                $q->where('s.id','LIKE',$buscar)
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('s.fecha', 'desc')
            ->paginate(50);

        return view('admin.comisiones.listado-asignacion', compact('servicios'));
    }

    public function listadoAsignacionActualizar($id)
    {
        Carbon::setLocale('es');
        $servicio = DB::table('servicios as s')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('s.id', 's.tramite', 's.fecha', 's.costo', 's.estatus_cobranza', 's.estatus_registro', 'comision_venta_restante', 'comision_operativa_restante', 'comision_gestion_restante', 'aplica_comision_venta', 'listo_comision_venta', 'aplica_comision_operativa', 'listo_comision_operativa', 'aplica_comision_gestion', 'listo_comision_gestion', 'cat.clave', 'cat.servicio', 'c.nombre_comercial', 'con.nombre as marca', 'cla.clave as clase')
            ->where('s.id', '=', $id)
            ->first();

        return view('admin.comisiones.listado-asignacion-actualizar', compact('servicio'));
    }

    public function cargarComisionesPreseleccionar($id_admin)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'con.nombre as marca', 'cli.nombre_comercial', 's.fecha', 's.tramite', 'cla.clave as clase')
            ->where('n.id_admin','=', $id_admin)
            ->where('n.estatus','=', 'Liberada')
            ->where('s.estatus_cobranza','=', 'Pagado')
            ->where('s.cobrado_terminado','=', '1')
            //->where('n.preseleccionar_comision','=', '0')
            ->orderBy('n.created_at', 'desc')
            ->get();

        $monto_total_seleccionado = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->select(DB::raw('sum(n.monto) as suma_total'))
            ->where('n.id_admin','=', $id_admin)
            ->where('n.estatus','=', 'Liberada')
            ->where('s.estatus_cobranza','=', 'Pagado')
            ->where('s.cobrado_terminado','=', '1')
            ->where('n.preseleccionar_comision','=', '1')
            //->groupBy('f.id')
            ->sum('n.monto');

        //return $monto_pendiente;

        return view('admin.comisiones.preseleccionar-listado', compact('comisiones', 'monto_total_seleccionado'));
    }

    public function preseleccionarComision(Request $request, $id)
    {
        $comision = Nomina::findOrFail($id);
        $comision->preseleccionar_comision = $request->valor;
        $comision->update();

        return response()->json($comision);
    }

    public function SeleccionarComisiones(Request $request, $id_admin)
    {
        $comisiones = DB::table('nomina as n')
            ->join('servicios as s', 's.id', '=', 'n.id_servicio')
            ->where('n.id_admin','=', $id_admin)
            ->where('n.estatus','=', 'Liberada')
            ->where('n.concepto','=', 'Comisión')
            ->where('s.estatus_cobranza','=', 'Pagado')
            ->where('s.cobrado_terminado','=', '1')
            ->where('n.preseleccionar_comision', '=', '0')
            ->update(
                [
                    'n.preseleccionar_comision' => 1
                ]);

        return response()->json($comisiones);
    }

    public function TotalSeleccionado($id_admin)
    {
        $total_comisiones = DB::table('nomina')
            ->select(DB::raw('sum(monto) as monto_total'))
            ->where('id_admin','=', $id_admin)
            ->where('preseleccionar_comision', '=', '1')
            ->sum('monto');

        return response()->json($total_comisiones);
    }

    public function cargarServiciosPendientes($id_admin)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->select('n.id', 'n.fecha_comision', 'n.fecha_aplicada', 'n.fecha_pagado', 'n.tipo_comision', 'n.id_admin', 'n.comentarios', 'n.monto', 'n.estatus', 'n.listo_comision', 'n.comision_aplicada', 'n.pagado', 'n.id_servicio', 'cat.clave', 'cat.servicio', 's.clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'n.created_at', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where('n.id_admin','=', $id_admin)
            ->where('n.estatus','=', 'Liberada')
            ->where('s.estatus_cobranza','=', 'Pagado')
            ->orderBy('n.created_at', 'desc')
            ->get();

        $monto_pendiente = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->select(DB::raw('sum(n.monto) as suma_total'))
            ->where('n.id_admin','=', $id_admin)
            ->where('n.estatus','=', 'Liberada')
            ->where('s.estatus_cobranza','=', 'Pagado')
            //->groupBy('f.id')
            ->sum('n.monto');

        //return $monto_pendiente;

        return view('admin.comisiones.servicios-pendientes', compact('comisiones', 'monto_pendiente'));
    }

    public function cargarServiciosPagados($id_admin, $id_egreso)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->select('n.id', 'n.fecha_comision', 'n.fecha_aplicada', 'n.fecha_pagado', 'n.tipo_comision', 'n.id_admin', 'n.comentarios', 'n.monto', 'n.estatus', 'n.listo_comision', 'n.comision_aplicada', 'n.pagado', 'n.id_servicio', 'cat.clave', 'cat.servicio', 's.clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'n.created_at', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where('n.id_admin','=', $id_admin)
            ->where('n.id_egresos','=', $id_egreso)
            ->orderBy('n.created_at', 'desc')
            ->get();

        $monto_pagado = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->select(DB::raw('sum(n.monto) as suma_total'))
            ->where('n.id_egresos','=', $id_egreso)
            //->groupBy('f.id')
            ->sum('n.monto');

        return view('admin.comisiones.servicios-pagados', compact('comisiones', 'monto_pagado'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'total' => 'required|min:0'
            ]);

        $egreso = new EstadosCuenta;
        $egreso->tipo= 'Comision';
        $egreso->concepto=$request->concepto;
        $egreso->fecha=$request->fecha;
        $egreso->con_iva = 0;

        $egreso->total=$request->total;
        $egreso->retiro = $request->total;
        $egreso->subtotal=$request->total;
        $egreso->iva=0;
        $egreso->porcentaje_iva=0;

        $egreso->restante = $request->total;
        $egreso->cheque=$request->cheque;
        $egreso->movimiento=$request->movimiento;
        $egreso->pagado_boolean=1;
        $egreso->cerrado_boolean=1;

        $egreso->id_admin=$request->id_admin;
        $egreso->id_cuenta=$request->id_cuenta;
        $egreso->id_forma_pago=$request->id_forma_pago;
        $egreso->id_categoria= '23';
        $egreso->estatus = 'Pagado';
        
        $egreso->save();

        $comision = DB::table('nomina')
            ->where('id', '=', $request->id_comision)
            ->update([
                        'fecha_pagado' => $request->fecha,
                        'comision_aplicada' => 1,
                        'pagado' => 1,
                        'estatus' => 'Pagada',
                        'id_egresos' => $egreso->id
                    ]);

        return response()->json($egreso);
    }

    public function guardar(Request $request)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required'
            ]);

        $egreso = new EstadosCuenta;
        $egreso->tipo= 'Comision';
        $egreso->concepto=$request->concepto;
        $egreso->fecha=$request->fecha;
        $egreso->con_iva = 0;

        $egreso->total=0;
        $egreso->retiro = 0;
        $egreso->subtotal=0;
        $egreso->iva=0;
        $egreso->porcentaje_iva=0;

        $egreso->restante = 0;
        $egreso->cheque=$request->cheque;
        $egreso->movimiento=$request->movimiento;
        $egreso->pagado_boolean=1;
        $egreso->cerrado_boolean=1;

        $egreso->id_admin=$request->id_admin;
        $egreso->id_cuenta=$request->id_cuenta;
        $egreso->id_forma_pago=$request->id_forma_pago;
        $egreso->id_categoria= '23';
        $egreso->estatus = 'Pagado';
        
        $egreso->save();

        return response()->json($egreso);
    }

    public function comisionReciente($tipo)
    {
        $egreso = EstadosCuenta::select('id as id_egreso', 'retiro')
            ->where('tipo', '=', $tipo)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json($egreso);
    }

    public function pagarComision(Request $request, $id_comision)
    {
        $comision = Nomina::findOrFail($id_comision);

        $mytime = Carbon::now('America/Chihuahua');
        $fecha = $mytime->toDateString();

        $comision->fecha_pagado = $fecha;
        $comision->comision_aplicada = 1;
        $comision->pagado = 1;
        $comision->estatus = 'Pagada';
        $comision->id_egresos = $request->id_egreso;

        $comision->update();

        return response()->json($comision);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comision = EstadosCuenta::findOrFail($id);

        return response()->json($comision);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estados_cuenta = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required'
            ]);

        $total = $request->total + $request->total_val;

        
        $estados_cuenta->total = $total;
        $estados_cuenta->retiro = $total;
        $estados_cuenta->subtotal = $total;
        $estados_cuenta->restante = $total;
        $estados_cuenta->id_cuenta = $request->id_cuenta;
        $estados_cuenta->id_forma_pago = $request->id_forma_pago;
        $estados_cuenta->movimiento = $request->movimiento;
        $estados_cuenta->cheque = $request->cheque;
        $estados_cuenta->concepto = $request->concepto;
        $estados_cuenta->fecha = $request->fecha;
        $estados_cuenta->estatus = 'Pagado';
        $estados_cuenta->update();

        $comision = DB::table('nomina')
            ->where('id', '=', $request->id_comision)
            ->update([
                        'fecha_pagado' => $request->fecha,
                        'comision_aplicada' => 1,
                        'pagado' => 1,
                        'estatus' => 'Pagada',
                        'id_egresos' => $estados_cuenta->id
                    ]);

        return response()->json($estados_cuenta);
    }

    public function actualizar(Request $request, $id)
    {
        $estados_cuenta = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required'
            ]);

        $estados_cuenta->id_cuenta = $request->id_cuenta;
        $estados_cuenta->id_forma_pago = $request->id_forma_pago;
        $estados_cuenta->movimiento = $request->movimiento;
        $estados_cuenta->cheque = $request->cheque;
        $estados_cuenta->concepto = $request->concepto;
        $estados_cuenta->fecha = $request->fecha;
        $estados_cuenta->update();

        return response()->json($estados_cuenta);
    }

    public function quitar_comision(Request $request, $id_egreso, $id_comision)
    {
        $estados_cuenta = EstadosCuenta::findOrFail($id_egreso);

        $total = $request->total_val - $request->total;

        $estados_cuenta->total = $total;
        $estados_cuenta->retiro = $total;
        $estados_cuenta->subtotal = $total;
        $estados_cuenta->restante = $total;
        $estados_cuenta->update();

        $comision = DB::table('nomina')
            ->where('id', '=', $request->id_comision)
            ->update([
                        'fecha_pagado' => null,
                        'comision_aplicada' => 0,
                        'pagado' => 0,
                        'estatus' => 'Liberada',
                        'id_egresos' => null
                    ]);

        return response()->json($estados_cuenta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar_comision($id)
    {
        $estados_cuenta = EstadosCuenta::findOrFail($id);
        $estados_cuenta->estatus = 'Cancelado';
        $estados_cuenta->update();

        $comision = DB::table('nomina')
            ->where('id_egresos', '=', $id)
            ->update([
                        'fecha_pagado' => null,
                        'comision_aplicada' => 0,
                        'pagado' => 0,
                        'estatus' => 'Liberada',
                        'id_egresos' => null
                    ]);

        return response()->json($estados_cuenta);
    }

}
