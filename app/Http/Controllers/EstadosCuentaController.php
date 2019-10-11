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
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Emporio\Exports\EstadosCuentaExport;

class EstadosCuentaController extends Controller
{
    public function listar($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $estados_cuenta=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'e.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select('e.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial as proveedor', 'cli.nombre_comercial', 'cli.saldo as saldo_cliente', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')

            //->whereNotNull('fecha')
            //->where('e.estatus', '!=', 'Pendiente')
            //->where('e.tipo', '!=', 'Ingreso')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.orden', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $estados_cuenta->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $estados_cuenta->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $estados_cuenta->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $estados_cuenta->where('e.id_forma_pago', '=', $forma_pago);
            }

            $estados_cuenta = $estados_cuenta->paginate(50);


        return view('admin.procesos.bancos.listado', compact('estados_cuenta'));
    }

    public function listar_total($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $ingresos=DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as deposito'))
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
            ->where('e.tipo', '!=', 'Traspaso');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $ingresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $ingresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $ingresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $ingresos->where('e.id_forma_pago', '=', $forma_pago);
            }

            $ingresos = $ingresos->sum('e.deposito');

       $egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as retiro'))
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
            ->where('e.tipo', '!=', 'Traspaso');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
               $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
               $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
               $egresos->where('e.id_cuenta', '=', $cuenta);
            }  

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
               $egresos->where('e.id_forma_pago', '=', $forma_pago);
            }

       $egresos =$egresos->sum('e.retiro');

        // $saldo_final = $saldos + $ingresos - $egresos;

        $totales = compact('ingresos', 'egresos');

        // return $egresos;

        return response()->json($totales);
    }

    public function buscar($estatus, $tipo, $cuenta, $formas_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $estados_cuenta=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'e.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select('e.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial as proveedor', 'cli.nombre_comercial', 'cli.saldo as saldo_cliente', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')
            //->whereNotNull('fecha')
            //->where('e.estatus', '!=', 'Pendiente')
            //->where('e.tipo', '!=', 'Ingreso')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
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
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('com.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('com.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('com.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('cu_tras.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('b.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%');
            })
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.orden', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $estados_cuenta->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $estados_cuenta->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $estados_cuenta->where('e.id_cuenta', '=', $cuenta);
            }

            if($formas_pago == 'todos')
            {
                //
            }
            else if($formas_pago != 'todos')
            {
                $estados_cuenta->where('e.id_forma_pago', '=', $formas_pago);
            }

            $estados_cuenta = $estados_cuenta->paginate(50);

        return view('admin.procesos.bancos.listado', compact('estados_cuenta'));
    }

    public function buscar_total($estatus, $tipo, $cuenta, $formas_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $ingresos=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'e.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select(DB::raw('sum(e.deposito) as deposito'))
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
            ->where('e.tipo', '!=', 'Traspaso')
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
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('com.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('com.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('com.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('cu_tras.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('b.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%');
            });

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $ingresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $ingresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $ingresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($formas_pago == 'todos')
            {
                //
            }
            else if($formas_pago != 'todos')
            {
                $ingresos->where('e.id_forma_pago', '=', $formas_pago);
            }

            $ingresos = $ingresos->sum('e.deposito');

        $egresos = DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'e.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select(DB::raw('sum(e.retiro) as retiro'))
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
            ->where('e.tipo', '!=', 'Traspaso')
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
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('com.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('com.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('com.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('cu_tras.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('b.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%');
            });

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
               $egresos->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
               $egresos->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
               $egresos->where('e.id_cuenta', '=', $cuenta);
            }  

            if($formas_pago == 'todos')
            {
                //
            }
            else if($formas_pago != 'todos')
            {
               $egresos->where('e.id_forma_pago', '=', $formas_pago);
            }

       $egresos =$egresos->sum('e.retiro');

        // $saldo_final = $saldos + $ingresos - $egresos;

        $totales = compact('ingresos', 'egresos');

        return response()->json($totales);
    }

    public function exportar($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $estados_cuenta=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'e.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select('e.id', 'e.tipo', DB::raw('DATE_FORMAT(e.fecha, "%d-%m-%Y") as fecha'), 'e.cheque', 'e.subtotal', 'e.iva', 'e.total', 'e.deposito', 'e.retiro', 'e.estatus', 'e.cancelado_at', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial as proveedor', 'cli.nombre_comercial as cliente', 'cli.saldo as saldo_cliente', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.orden', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $estados_cuenta->where('e.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $estados_cuenta->where('e.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $estados_cuenta->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $estados_cuenta->where('e.id_forma_pago', '=', $forma_pago);
            }

            $estados_cuenta = $estados_cuenta->get();

        return view('admin.procesos.bancos.export', compact('estados_cuenta'));
    }


    public function ingresos_listar($estatus, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $ingresos=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select('e.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'cli.nombre_comercial', 'cu_tras.alias as cuenta_traspaso', 'cli.saldo', 'cli.id as id_cliente')
            ->where('e.tipo_movimiento', '=', 'INGRESO')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.orden', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $ingresos->where('e.estatus', '=', $estatus);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $ingresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $ingresos->where('e.id_forma_pago', '=', $forma_pago);
            }

        $ingresos = $ingresos->paginate(50);

        return view('admin.procesos.ingresos.listado', compact('ingresos'));
    }

    public function ingresos_listar_total($estatus, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        $ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as deposito'))
            ->where('e.tipo_movimiento', '=', 'INGRESO')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0);

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $ingresos->where('e.estatus', '=', $estatus);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $ingresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $ingresos->where('e.id_forma_pago', '=', $forma_pago);
            }

            $ingresos = $ingresos->sum('e.deposito');

        return response()->json($ingresos);
    }

    public function ingresos_buscar($estatus, $cuenta, $forma_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $ingresos=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select('e.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'cli.nombre_comercial', 'cu_tras.alias as cuenta_traspaso', 'cli.saldo', 'cli.id as id_cliente')
            ->where('e.tipo_movimiento', '=', 'INGRESO')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
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
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('cu_tras.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('b.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%');
            })
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.orden', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $ingresos->where('e.estatus', '=', $estatus);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $ingresos->where('e.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $ingresos->where('e.id_forma_pago', '=', $forma_pago);
            }

        $ingresos = $ingresos->paginate(50);

        return view('admin.procesos.ingresos.listado', compact('ingresos'));
    }

    public function ingresos_buscar_total($estatus, $cuenta, $forma_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
        $ingresos = DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select(DB::raw('sum(e.deposito) as deposito'))
            ->where('e.tipo_movimiento', '=', 'INGRESO')
            ->where('e.fecha', '>=', $fecha_inicio)
            ->where('e.fecha', '<=', $fecha_fin)
            ->where('e.revision', '=', 0)
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
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('cu_tras.alias','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('b.banco','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%');
            });
                if($estatus == 'todos')
                {
                    //
                }
                else if($estatus != 'todos')
                {
                    $ingresos->where('e.estatus', '=', $estatus);
                }

                if($cuenta == 'todos')
                {
                    //
                }
                else if($cuenta != 'todos')
                {
                    $ingresos->where('e.id_cuenta', '=', $cuenta);
                }

                if($forma_pago == 'todos')
                {
                    //
                }
                else if($forma_pago != 'todos')
                {
                    $ingresos->where('e.id_forma_pago', '=', $forma_pago);
                }

            $ingresos = $ingresos->sum('e.deposito');

        return response()->json($ingresos);
    }

    public function ingresos_actualizar($id)
    {
        Carbon::setLocale('es');
        $estado=DB::table('estados_cuenta as e')
            ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
            ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
            ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
            ->select('e.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'cli.nombre_comercial', 'cu_tras.alias as cuenta_traspaso', 'cli.saldo', 'cli.id as id_cliente')
            ->where('e.id', '=', $id)
            ->first();

        return view('admin.procesos.ingresos.listado-actualizar', compact('estado'));
    }

    public function facturas_recibos($id_cliente, $id_ingreso)
    {
        Carbon::setLocale('es');
        $facturas = DB::table('facturas as f')
            ->leftjoin('cobranza_detalles as det', 'f.id', '=', 'det.id_factura')
            ->leftjoin('clientes as c', 'f.id_cliente', '=', 'c.id')
            ->leftjoin('users as u', 'f.id_admin', '=', 'u.id')
            ->leftjoin('razones_sociales as raz', 'f.id_razon_social', '=', 'raz.id')
            ->select('f.*', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc', 'u.iniciales', 'u.nombre', 'u.apellido', 'det.id as id_det')
            ->where('det.id_cobranza', '=', $id_ingreso)
            ->orWhere(function($q) use ($id_cliente)
            {
                $q->where('f.id_cliente', '=', $id_cliente)
                ->where('f.saldo', '>', '0');
            })
            ->orderBy('f.id', 'asc')
            ->get();

        $monto_pendiente = DB::table('facturas as f')
            ->select(DB::raw('sum(f.saldo) as saldo'))
            ->where('f.id_cliente', '=', $id_cliente)
            ->sum('f.saldo');

        //return $monto_pendiente;

        return view('admin.procesos.ingresos.facturas', compact('facturas', 'monto_pendiente'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'id_admin' => 'required',
                'deposito' => 'required|min:0',
                'orden' => 'required', 
            ]);
        
        $ingreso = new EstadosCuenta;
        $ingreso->tipo_movimiento = 'INGRESO';
        $ingreso->estatus = 'Pagado';
        $ingreso->tipo = $request->tipo;
        $ingreso->id_cliente = $request->id_cliente;
        $ingreso->fecha = $request->fecha;
        $ingreso->id_cuenta = $request->id_cuenta;
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_admin = $request->id_admin;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->cheque = $request->cheque;
        $ingreso->orden = $request->orden;
        $ingreso->concepto = $request->concepto;
        $ingreso->subtotal = $request->deposito;
        $ingreso->iva = 0;
        $ingreso->total = $request->deposito;
        $ingreso->porcentaje_iva = $request->porcentaje_iva;
        $ingreso->deposito = $request->deposito;
        $ingreso->pagado = $request->deposito;
        $ingreso->pagado_boolean = 1;
        $ingreso->cerrado_boolean = 1;

        $ingreso->save();

        if($request->id_cliente == '')
        {

        }
        else
        {
            $saldo = $request->deposito + $request->saldo;

            $cliente = DB::table('clientes')
                ->where('id', '=', $request->id_cliente)
                ->update(['saldo' => $saldo]);
        }

        return response()->json($ingreso);
    }

    public function edit($id/*, $id_cliente*/)
    {
        $ingreso = DB::table('estados_cuenta as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->select('est.*', 'c.saldo', 'c.nombre_comercial')
            ->where('est.id', '=', $id)
            ->first();

        return response()->json($ingreso);
    }

    public function update(Request $request, $id)
    {
        $ingreso = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'id_admin' => 'required',
                'deposito' => 'required|min:0'
            ]);

        $ingreso->estatus = 'Pagado';
        $ingreso->tipo = $request->tipo;
        $ingreso->id_cliente = $request->id_cliente;
        $ingreso->fecha = $request->fecha;
        $ingreso->id_cuenta = $request->id_cuenta;
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_admin = $request->id_admin;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->cheque = $request->cheque;
        $ingreso->concepto = $request->concepto;
        $ingreso->subtotal = $request->deposito;
        $ingreso->iva = 0;
        $ingreso->total = $request->deposito;
        $ingreso->porcentaje_iva = $request->porcentaje_iva;
        $ingreso->deposito = $request->deposito;
        $ingreso->pagado = $request->deposito;
        $ingreso->pagado_boolean = 1;
        $ingreso->cerrado_boolean = 1;
        $ingreso->update();

        if($request->id_cliente == '' && $request->id_cliente_ant == '')
        {
            
        }
        else if($request->id_cliente != '' && $request->id_cliente_ant == '')
        {
            $saldo = $request->saldo + $request->deposito;

            $cliente = DB::table('clientes')
                ->where('id', '=', $request->id_cliente)
                ->update(['saldo' => $saldo]);
        }
        else if($request->id_cliente == '' && $request->id_cliente_ant != '')
        {
            $saldo = $request->saldo_ant - $request->monto_ant;

            $cliente = DB::table('clientes')
                ->where('id', '=', $request->id_cliente)
                ->update(['saldo' => $saldo]);
        }
        else if($request->id_cliente != '' && $request->id_cliente_ant != '')
        {
            if($request->id_cliente == $request->id_cliente_ant)
            {
                $saldo = $request->saldo_ant - $request->monto_ant + $request->deposito;

                $cliente = DB::table('clientes')
                    ->where('id', '=', $request->id_cliente)
                    ->update(['saldo' => $saldo]);
            }
            else if($request->id_cliente != $request->id_cliente_ant)
            {
                $saldo_ant = $request->saldo_ant - $request->monto_ant;

                $cliente = DB::table('clientes')
                    ->where('id', '=', $request->id_cliente_ant)
                    ->update(['saldo' => $saldo_ant]);

                $saldo = $request->saldo + $request->deposito;

                $cliente = DB::table('clientes')
                    ->where('id', '=', $request->id_cliente)
                    ->update(['saldo' => $saldo]);
            }
        }

        return response()->json($ingreso);
    }

    public function cancelar(Request $request, $id)
    {
        $cancelado_at = Carbon::now('America/Chihuahua')->toDateTimeString();

        $ingreso = EstadosCuenta::findOrFail($id);
        $ingreso->estatus = 'Cancelado';
        $ingreso->id_admin = $request->id_admin;
        $ingreso->cancelado_at = $cancelado_at;
        $ingreso->deposito = 0;
        $ingreso->pagado_boolean = 0;
        $ingreso->update();

        $saldo_cliente = $request->saldo - $request->deposito;

        $saldo = DB::table('clientes')
           ->where('id', '=', $request->id_cliente)
           ->update(
               [   
                   'saldo' => $saldo_cliente
               ]);

        return response()->json($ingreso);
    }
}


















