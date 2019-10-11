<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\Clases;
use Emporio\Model\FormasPago;
use Emporio\Model\Nomina;
use Emporio\Model\Servicios;
use Emporio\Model\Proveedores;
use Emporio\Model\ServiciosPagos;
use Emporio\Users;
use Response;
use DB;
use Carbon\Carbon;

class EgresosController extends Controller
{
    public function listado($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
    	$egresos = DB::table('estados_cuenta as est')
    		->leftjoin('formas_pago as f', 'est.id_forma_pago', '=', 'f.id')
    		->leftjoin('cuentas as cu', 'est.id_cuenta', '=', 'cu.id')
    		->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
    		->leftjoin('users as u', 'est.id_admin', '=', 'u.id')
    		->leftjoin('proveedores as p', 'est.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'est.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'est.id_cuenta_traspaso', '=', 'cu_tras.id')
    		->select('est.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')
    		->where('est.fecha', '>=', $fecha_inicio)
    		->where('est.fecha', '<=', $fecha_fin)
            ->where('est.revision', '=', 0)
    		->where('est.tipo_movimiento', '=', 'EGRESO')
    		->orderBy('est.fecha', 'desc')
            ->orderBy('est.orden', 'desc');

    		if($estatus == 'todos')
    		{
    		    //
    		}
    		else if($estatus != 'todos')
    		{
    		    $egresos->where('est.estatus', '=', $estatus);
    		}

    		if($tipo == 'todos')
    		{
    		    //
    		}
    		else if($tipo != 'todos')
    		{
    		    $egresos->where('est.tipo', '=', $tipo);
    		}

    		if($cuenta == 'todos')
    		{
    		    //
    		}
    		else if($cuenta != 'todos')
    		{
    		    $egresos->where('est.id_cuenta', '=', $cuenta);
    		}

    		if($forma_pago == 'todos')
    		{
    		    //
    		}
    		else if($forma_pago != 'todos')
    		{
    		    $egresos->where('est.id_forma_pago', '=', $forma_pago);
    		}

    	$egresos = $egresos->paginate(50);

    	return view('admin.procesos.egresos.listado', compact('egresos'));
    }

    public function listado_total($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        $egresos = DB::table('estados_cuenta as est')
            ->select(DB::raw('sum(est.retiro) as retiro'))
            ->where('est.fecha', '>=', $fecha_inicio)
            ->where('est.fecha', '<=', $fecha_fin)
            ->where('est.revision', '=', 0)
            ->where('est.tipo_movimiento', '=', 'EGRESO')
            ->where('est.tipo', '!=', 'Traspaso');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $egresos->where('est.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $egresos->where('est.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $egresos->where('est.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $egresos->where('est.id_forma_pago', '=', $forma_pago);
            }

        $egresos = $egresos->sum('est.retiro');

        return response()->json($egresos);
    }

    public function buscar($estatus, $tipo, $cuenta, $forma_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
    	$egresos = DB::table('estados_cuenta as est')
    		->leftjoin('formas_pago as f', 'est.id_forma_pago', '=', 'f.id')
    		->leftjoin('cuentas as cu', 'est.id_cuenta', '=', 'cu.id')
    		->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
    		->leftjoin('users as u', 'est.id_admin', '=', 'u.id')
    		->leftjoin('proveedores as p', 'est.id_proveedor', '=', 'p.id')
    		->leftjoin('users as com', 'est.id_comisionado', '=', 'com.id')
    		->leftjoin('cuentas as cu_tras', 'est.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->select('est.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')
    		->where('est.fecha', '>=', $fecha_inicio)
    		->where('est.fecha', '<=', $fecha_fin)
            ->where('est.revision', '=', 0)
    		->where('est.tipo_movimiento', '=', 'EGRESO')
    		->where(function($q) use ($buscar)
    		{
    		    $q->where('com.nombre','LIKE','%'.$buscar.'%')
    		    ->orWhere('com.apellido','LIKE','%'.$buscar.'%')
    		    ->orWhere('com.iniciales','LIKE','%'.$buscar.'%')
    		    ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
    		    ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
    		    ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
    		    ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
    		    ->orWhere('est.total','LIKE','%'.$buscar.'%')
    		    ->orWhere('est.deposito','LIKE','%'.$buscar.'%')
    		    ->orWhere('est.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('est.concepto','LIKE','%'.$buscar.'%')
    		    ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
    		    ->orWhere('f.codigo','LIKE','%'.$buscar.'%')
    		    ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
    		    ->orWhere('b.banco','LIKE','%'.$buscar.'%')
    		    ->orWhere('est.iva','LIKE','%'.$buscar.'%');
    		})
            ->orderBy('est.fecha', 'desc')
    		->orderBy('est.orden', 'desc');

    		if($estatus == 'todos')
    		{
    		    //
    		}
    		else if($estatus != 'todos')
    		{
    		    $egresos->where('est.estatus', '=', $estatus);
    		}

    		if($tipo == 'todos')
    		{
    		    //
    		}
    		else if($tipo != 'todos')
    		{
    		    $egresos->where('est.tipo', '=', $tipo);
    		}

    		if($cuenta == 'todos')
    		{
    		    //
    		}
    		else if($cuenta != 'todos')
    		{
    		    $egresos->where('est.id_cuenta', '=', $cuenta);
    		}

    		if($forma_pago == 'todos')
    		{
    		    //
    		}
    		else if($forma_pago != 'todos')
    		{
    		    $egresos->where('est.id_forma_pago', '=', $forma_pago);
    		}

    	$egresos = $egresos->paginate(50);

    	return view('admin.procesos.egresos.listado', compact('egresos'));
    }

    public function buscar_total($estatus, $tipo, $cuenta, $forma_pago, $buscar, $fecha_inicio, $fecha_fin)
    {
        $egresos = DB::table('estados_cuenta as est')
            ->leftjoin('formas_pago as f', 'est.id_forma_pago', '=', 'f.id')
            ->leftjoin('cuentas as cu', 'est.id_cuenta', '=', 'cu.id')
            ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
            ->leftjoin('users as u', 'est.id_admin', '=', 'u.id')
            ->leftjoin('proveedores as p', 'est.id_proveedor', '=', 'p.id')
            ->leftjoin('users as com', 'est.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'est.id_cuenta_traspaso', '=', 'cu_tras.id')
            ->select(DB::raw('sum(est.retiro) as retiro'))
            ->where('est.fecha', '>=', $fecha_inicio)
            ->where('est.fecha', '<=', $fecha_fin)
            ->where('est.revision', '=', 0)
            ->where('est.tipo_movimiento', '=', 'EGRESO')
            ->where('est.tipo', '!=', 'Traspaso')
            ->where(function($q) use ($buscar)
            {
                $q->where('com.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('com.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('com.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('est.total','LIKE','%'.$buscar.'%')
                ->orWhere('est.deposito','LIKE','%'.$buscar.'%')
                ->orWhere('est.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('est.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('f.forma_pago','LIKE','%'.$buscar.'%')
                ->orWhere('f.codigo','LIKE','%'.$buscar.'%')
                ->orWhere('cu.alias','LIKE','%'.$buscar.'%')
                ->orWhere('b.banco','LIKE','%'.$buscar.'%')
                ->orWhere('est.iva','LIKE','%'.$buscar.'%');
            });

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $egresos->where('est.estatus', '=', $estatus);
            }

            if($tipo == 'todos')
            {
                //
            }
            else if($tipo != 'todos')
            {
                $egresos->where('est.tipo', '=', $tipo);
            }

            if($cuenta == 'todos')
            {
                //
            }
            else if($cuenta != 'todos')
            {
                $egresos->where('est.id_cuenta', '=', $cuenta);
            }

            if($forma_pago == 'todos')
            {
                //
            }
            else if($forma_pago != 'todos')
            {
                $egresos->where('est.id_forma_pago', '=', $forma_pago);
            }

        $egresos = $egresos->sum('est.retiro');

        return response()->json($egresos);
    }


    public function actualizar($id)
    {
    	$egreso = DB::table('estados_cuenta as est')
    		->leftjoin('formas_pago as f', 'est.id_forma_pago', '=', 'f.id')
    		->leftjoin('cuentas as cu', 'est.id_cuenta', '=', 'cu.id')
    		->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
    		->leftjoin('users as u', 'est.id_admin', '=', 'u.id')
    		->leftjoin('proveedores as p', 'est.id_proveedor', '=', 'p.id')
    		->leftjoin('users as com', 'est.id_comisionado', '=', 'com.id')
            ->leftjoin('cuentas as cu_tras', 'est.id_cuenta_traspaso', '=', 'cu_tras.id')
    		->select('est.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')
    		->where('est.id', '=', $id)
    		->first();

    	return view('admin.procesos.egresos.listado-actualizar', compact('egreso'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'tipo'=>'required',
                'orden'=>'required',
                'fecha'=>'required',
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'monto'=>'required|min:0|numeric',
                'porcentaje_iva'=>'required|min:0|numeric',
            ]);

        if($request->con_iva == 1)
        {
            $total = $request->monto;
            $subtotal = $request->monto / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->con_iva == 0)
        {
            $total = $request->monto;
            $subtotal = $request->monto;
            $iva = 0;
        }

        $egreso = new EstadosCuenta;
        $egreso->tipo = $request->tipo;
        $egreso->tipo_movimiento = 'EGRESO';
        $egreso->orden = $request->orden;
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->con_iva = $request->con_iva;
        $egreso->subtotal = $subtotal;
        $egreso->porcentaje_iva = $request->porcentaje_iva;
        $egreso->iva = $iva;
        $egreso->total = $total;
        $egreso->retiro = $total;
        $egreso->pagado = $total;
        $egreso->restante = 0;
        $egreso->estatus = 'Pagado';
        $egreso->pagado_boolean = 1;
        $egreso->pago_servicios = $request->realiza_pagos;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->save();

        return response()->json($egreso);
    }

    public function insertar_pago_servicios(Request $request)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'orden'=>'required',
                'fecha'=>'required',
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'monto'=>'required|min:0|numeric',
                'porcentaje_iva'=>'required|min:0|numeric',
            ]);

        if($request->con_iva == 1)
        {
            $total = $request->monto;
            $subtotal = $request->monto / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->con_iva == 0)
        {
            $total = $request->monto;
            $subtotal = $request->monto;
            $iva = 0;
        }

        $egreso = new EstadosCuenta;
        $egreso->tipo = 'Despacho';
        $egreso->tipo_movimiento = 'EGRESO';
        $egreso->pago_servicios = '1';
        $egreso->orden = $request->orden;
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->con_iva = $request->con_iva;
        $egreso->subtotal = $subtotal;
        $egreso->porcentaje_iva = $request->porcentaje_iva;
        $egreso->iva = $iva;
        $egreso->total = $total;
        $egreso->retiro = $total;
        $egreso->pagado = $total;
        $egreso->restante = 0;
        $egreso->estatus = 'Pagado';
        $egreso->pagado_boolean = 1;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->save();

        $servicio_pagos = new ServiciosPagos;
        $servicio_pagos->monto = $request->monto;
        $servicio_pagos->id_servicio = $request->id_servicio;
        $servicio_pagos->id_egreso = $egreso->id;
        $servicio_pagos->id_admin = $request->id_admin;
        $servicio_pagos->id_control = $request->id_control;
        $servicio_pagos->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'costo_pagado' => '1'
                ]);

        return response()->json($servicio_pagos);
    }

    public function pago_servicio(Request $request, $id)
    {
        $this->validate($request,
            [
                'fecha'=>'required',
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'monto'=>'required|min:0|numeric',
                'porcentaje_iva'=>'required|min:0|numeric',
            ]);

        $monto_total = $request->monto_total + $request->monto;

        if($request->con_iva == 1)
        {
            $total = $monto_total;
            $subtotal = $monto_total / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->con_iva == 0)
        {
            $total = $monto_total;
            $subtotal = $monto_total;
            $iva = 0;
        }

        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->con_iva = $request->con_iva;
        $egreso->subtotal = $subtotal;
        $egreso->porcentaje_iva = $request->porcentaje_iva;
        $egreso->iva = $iva;
        $egreso->total = $total;
        $egreso->retiro = $total;
        $egreso->pagado = $total;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->update();

        $servicio_pagos = new ServiciosPagos;
        $servicio_pagos->monto = $request->monto;
        $servicio_pagos->id_servicio = $request->id_servicio;
        $servicio_pagos->id_egreso = $id;
        $servicio_pagos->id_admin = $request->id_admin;
        $servicio_pagos->id_control = $request->id_control;
        $servicio_pagos->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'costo_pagado' => '1'
                ]);

        return response()->json($servicio_pagos);
    }

    public function quitar_pago_servicio(Request $request, $id_pago, $id)
    {
        $monto_total = $request->monto_total - $request->monto;

        if($request->con_iva == 1)
        {
            $total = $monto_total;
            $subtotal = $monto_total / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->con_iva == 0)
        {
            $total = $monto_total;
            $subtotal = $monto_total;
            $iva = 0;
        }

        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->con_iva = $request->con_iva;
        $egreso->subtotal = $subtotal;
        $egreso->porcentaje_iva = $request->porcentaje_iva;
        $egreso->iva = $iva;
        $egreso->total = $total;
        $egreso->retiro = $total;
        $egreso->pagado = $total;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->update();

        $servicio_pagos = DB::table('servicios_pagos')
            ->where('id', '=', $id_pago)
            ->delete();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'costo_pagado' => '0'
                ]);

        return response()->json($egreso);
    }

    public function edit($id)
    {
    	$egreso = DB::table('estados_cuenta as est')
    		->leftjoin('formas_pago as f', 'est.id_forma_pago', '=', 'f.id')
    		->leftjoin('cuentas as cu', 'est.id_cuenta', '=', 'cu.id')
    		->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
    		->leftjoin('users as u', 'est.id_admin', '=', 'u.id')
    		->leftjoin('proveedores as p', 'est.id_proveedor', '=', 'p.id')
    		->leftjoin('users as com', 'est.id_comisionado', '=', 'com.id')
    		->select('est.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado')
    		->where('est.id', '=', $id)
    		->first();

    	return response()->json($egreso);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'tipo'=>'required',
                'fecha'=>'required',
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'monto'=>'required|min:0|numeric',
                'porcentaje_iva'=>'required|min:0|numeric',
            ]);

        if($request->con_iva == 1)
        {
            $total = $request->monto;
            $subtotal = $request->monto / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->con_iva == 0)
        {
            $total = $request->monto;
            $subtotal = $request->monto;
            $iva = 0;
        }

        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->tipo = $request->tipo;
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->con_iva = $request->con_iva;
        $egreso->subtotal = $subtotal;
        $egreso->porcentaje_iva = $request->porcentaje_iva;
        $egreso->iva = $iva;
        $egreso->total = $total;
        $egreso->retiro = $total;
        $egreso->pagado = $total;
        $egreso->pago_servicios = $request->realiza_pagos;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->save();

        return response()->json($egreso);
    }

    public function estatus(Request $request, $id)
    {
        $cancelado_at = Carbon::now('America/Chihuahua')->toDateTimeString();

        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->estatus = $request->estatus;
        $egreso->id_admin = $request->id_admin;
        
        if($request->estatus == 'Cancelado')
        {
            $egreso->cancelado_at = $cancelado_at;
            $egreso->pagado_boolean = 0;

            if($request->pago_servicios == 1)
            {
                $egreso->subtotal = 0;
                $egreso->porcentaje_iva = 0;
                $egreso->iva = 0;
                $egreso->total = 0;
                $egreso->retiro = 0;
                $egreso->pagado = 0;
            }
        }
        else if($request->estatus == 'Pendiente')
        {
            $egreso->cancelado_at = null;
            $egreso->pagado_boolean = 0;
        }
        else
        {
            $egreso->cancelado_at = null;
            $egreso->pagado_boolean = 1;
        }

        $egreso->update();

        if($request->estatus == 'Cancelado')
        {
            $servicios = DB::table('servicios_pagos')
                ->where('id_egreso', '=', $id)
                ->delete();

            $ingreso = DB::table('estados_cuenta')
                ->where('id_cuenta_egreso', '=', $id)
                ->update(
                    [   
                        'cancelado_at' => $cancelado_at,
                        'pagado_boolean' => 0,
                        'estatus' => $request->estatus
                    ]);
        }
        else if($request->estatus == 'Pendiente')
        {
            $ingreso = DB::table('estados_cuenta')
               ->where('id_cuenta_egreso', '=', $id)
               ->update(
                   [   
                       'cancelado_at' => null,
                       'pagado_boolean' => 0,
                        'estatus' => $request->estatus
                   ]);
        }
        else if($request->estatus == 'Pagado')
        {
            $ingreso = DB::table('estados_cuenta')
               ->where('id_cuenta_egreso', '=', $id)
               ->update(
                   [   
                       'cancelado_at' => null,
                       'pagado_boolean' => 1,
                        'estatus' => $request->estatus
                   ]);
        }

        return response()->json($egreso);
    }

    public function ultimoOrden()
    {
    	$ultimo_orden = EstadosCuenta::select('orden')->orderBy('orden', 'desc')->first();

    	return response()->json($ultimo_orden);
    }

    public function cargarProveedores($variable)
    {
        if($variable == 0)
        {
            $proveedores = Proveedores::select('id', 'nombre_comercial', 'realiza_pagos')->where('estatus', '=', '1')->orderBy('nombre_comercial', 'asc')->get();
        }
        else if($variable == 1)
        {
            $proveedores = Proveedores::select('id', 'nombre_comercial', 'realiza_pagos')->where('estatus', '=', '1')->where('realiza_pagos', '=', $variable)->orderBy('nombre_comercial', 'asc')->get();
        }
        
        return response()->json($proveedores);
    }

    public function agregarProveedor(Request $request)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'nombre_comercial'=>'required|max:100|unique:proveedores'
            ]);

        $proveedor = new Proveedores;
        $proveedor->nombre_comercial = $request->nombre_comercial;
        $proveedor->id_admin = $request->id_admin;
        $proveedor->realiza_pagos = $request->realiza_pagos;
        $proveedor->estatus = 1;
        $proveedor->save();

        return response()->json($proveedor);
    }

    //Pago de Servicios
    public function cargarPagosPendientes($id_egreso)
    {
        $servicios = DB::table('servicios as s')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->leftjoin('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('users as u', 'u.id', '=', 's.id_admin')
            ->leftjoin('control as mar', 'mar.id', '=', 's.id_control')
            ->leftjoin('servicios_pagos as p', 's.id', '=', 'p.id_servicio')
            ->select('s.id', 's.tramite', 's.estatus_cobranza', 's.estatus_registro', 's.fecha_cobranza', 's.fecha_registro', 's.created_at', 'cla.clave as clase', 'c.nombre_comercial', 'cat.clave', 'cat.servicio', 's.id_admin', 'u.iniciales', 'u.nombre', 'u.apellido', 'mar.nombre as marca', 's.asignar_costo_servicio', 's.costo_servicio', 's.costo_pagado', 's.id_control', 's.descuento', 's.porcentaje_descuento', 's.costo', 's.facturado', 's.cobrado', 's.saldo', 's.mostrar_bitacora', 'p.id as id_pago', 's.id_cliente')
            ->where('s.asignar_costo_servicio', '=', '1')
            ->where('s.estatus_registro', '!=', 'Cancelado')
            ->where('s.costo_pagado', '=', '0')
            ->orWhere(function($q) use ($id_egreso)
            {
                $q->where('p.id_egreso', '=', $id_egreso);
            })
            ->where('s.costo_servicio', '>', '0')
            ->get();

        $monto_pendiente = DB::table('servicios as s')
                ->select(DB::raw('sum(s.costo_servicio) as suma_total'))
                ->where('s.asignar_costo_servicio', '=', '1')
                ->where('s.costo_pagado', '=', '0')
                ->where('s.estatus_registro', '!=', 'Cancelado')
                ->sum('s.costo_servicio');

        //return $monto_pendiente;

        return view('admin.procesos.egresos.costos-listado', compact('servicios', 'monto_pendiente'));
    }

    //Comisiones
    public function cargarServiciosPendientes($id_admin, $id_egreso)
    {
        if($id_egreso == 0)
        {
            Carbon::setLocale('es');
            $comisiones = DB::table('nomina as n')
                ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as con', 'con.id', '=', 's.id_control')
                ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
                ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo', 'n.comision_aplicada')
                ->where('n.id_admin','=', $id_admin)
                ->where('n.preseleccionar_comision','=', '1')
                ->orderBy('n.created_at', 'desc')
                ->get();

            $comisiones_nuevas = '';
            $comisiones_egreso = '';
        }
        else if($id_egreso > 0)
        {
            $comisiones = '';

            Carbon::setLocale('es');
            $comisiones_nuevas = DB::table('nomina as n')
                ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as con', 'con.id', '=', 's.id_control')
                ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
                ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo', 'n.comision_aplicada')
                ->where('n.id_admin','=', $id_admin)
                ->where('n.preseleccionar_comision','=', '1')
                ->orderBy('n.created_at', 'desc')
                ->get();

            $comisiones_egreso = DB::table('nomina as n')
                ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as con', 'con.id', '=', 's.id_control')
                ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
                ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo', 'n.comision_aplicada')
                ->where('n.id_egresos', '=', $id_egreso)
                ->orderBy('n.created_at', 'desc')
                ->get();
        }

    	return view('admin.procesos.egresos.comision-listado-edit', compact('comisiones', 'comisiones_nuevas', 'comisiones_egreso'));
    }

    public function cargarUsuariosComision()
    {
        $usuarios = DB::table('users as u')
            ->join('nomina as n', 'n.id_admin', '=', 'u.id')
            ->select('u.id', 'u.iniciales', 'u.nombre', 'u.apellido')
            ->where('n.preseleccionar_comision', '=', '1')
            ->groupBy('u.id', 'u.iniciales', 'u.nombre', 'u.apellido')
            ->get();

        return response()->json($usuarios);
    }

    public function QuitarComision($id)
    {
        $comision = Nomina::findOrFail($id);
        $comision->preseleccionar_comision = 0;
        $comision->update();

        return response()->json($comision);
    }

    public function insertarComision(Request $request)
    {
        // return $request;
    	$this->validate($request,
    	    [
    	        'id_admin'=>'required',
    	        'id_comisionado'=>'required',
    	        'fecha' => 'required',
    	        'id_cuenta' => 'required',
    	        'id_forma_pago' => 'required',
                'monto' => 'required|min:1'
    	    ]);

    	$egreso = new EstadosCuenta;
    	$egreso->tipo = 'COMISION';
    	$egreso->tipo_movimiento = 'EGRESO';
    	//$egreso->orden = 'EGRESO';
    	$egreso->concepto = $request->concepto;
    	$egreso->fecha = $request->fecha;
    	$egreso->cheque = $request->cheque;
    	$egreso->movimiento = $request->movimiento;
    	$egreso->orden = $request->orden;
    	$egreso->subtotal = $request->monto;
    	$egreso->iva = 0;
    	$egreso->porcentaje_iva = 0;
    	$egreso->total = $request->monto;
    	$egreso->retiro = $request->monto;
    	$egreso->estatus = 'Pagado';
    	$egreso->pagado_boolean = 1;
    	$egreso->id_forma_pago = $request->id_forma_pago;
    	$egreso->id_cuenta = $request->id_cuenta;
    	$egreso->id_admin = $request->id_admin;
    	$egreso->id_comisionado = $request->id_comisionado;
    	$egreso->save();

    	$comision = DB::table('nomina')
            ->where('id_admin', '=', $request->id_comisionado)
    		->where('preseleccionar_comision', '=', '1')
    		->update(
    		[
    			'fecha_pagado' => $request->fecha,
    			'comision_aplicada' => 1,
    			'estatus' => 'Pagada',
    			'id_egresos' => $egreso->id

    		]);

        $deseleccionar = DB::table('nomina')
            ->where('preseleccionar_comision', '=', '1')
            ->where('id_admin', '=', $request->id_comisionado)
            ->update(
                [
                    'preseleccionar_comision' => 0
                ]);

    	return response()->json($egreso);
    }

    public function insertarComision2(Request $request)
    {
        $this->validate($request,
            [
                // 'id_admin'=>'required',
                'comision_usuario'=>'required',
                'comision_fecha' => 'required',
                'comision_id_cuenta' => 'required',
                'comision_id_forma_pago' => 'required',
                'comision_total_val' => 'required|min:1'
            ]);



        $egreso = new EstadosCuenta;
        $egreso->tipo = 'COMISION';
        $egreso->tipo_movimiento = 'EGRESO';
        //$egreso->orden = 'EGRESO';
        $egreso->concepto = $request->comision_concepto;
        $egreso->fecha = $request->comision_fecha;
        $egreso->cheque = $request->comision_cheque;
        $egreso->movimiento = $request->comision_movimiento;
        $egreso->orden = $request->orden_egresos_comision;
        $egreso->subtotal = $request->comision_total_val;
        $egreso->iva = 0;
        $egreso->porcentaje_iva = 0;
        $egreso->total = $request->comision_total_val;
        $egreso->retiro = $request->comision_total_val;
        $egreso->estatus = 'Pagado';
        $egreso->pagado_boolean = 1;
        $egreso->id_forma_pago = $request->comision_id_forma_pago;
        $egreso->id_cuenta = $request->comision_id_cuenta;
        // $egreso->id_admin = $request->id_admin;
        $egreso->id_admin = Auth()->user()->id;
        $egreso->id_comisionado = $request->comision_usuario;
        $egreso->save();

        $comision = DB::table('nomina')
            ->where('id_admin', '=', $request->comision_usuario)
            ->where('preseleccionar_comision', '=', '1')
            ->update(
            [
                'fecha_pagado' => $request->comision_fecha,
                'comision_aplicada' => 1,
                'estatus' => 'Pagada',
                'id_egresos' => $egreso->id

            ]);

        $deseleccionar = DB::table('nomina')
            ->where('preseleccionar_comision', '=', '1')
            ->where('id_admin', '=', $request->comision_usuario)
            ->where('id_egresos', '=', $egreso->id)
            ->update(
                [
                    'preseleccionar_comision' => 0
                ]);

        $mensaje = array(
                    'message' => 'Se creó el egreso. #'.$egreso->id, 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function actualizarComision(Request $request, $id, $id_comision)
    {
    	$this->validate($request,
    	    [
    	        'id_admin'=>'required',
    	        //'id_comisionado'=>'required',
    	        'fecha' => 'required',
    	        'id_cuenta' => 'required',
    	        'id_forma_pago' => 'required',
                'monto' => 'required|min:0'
    	    ]);

    	if($request->value == 0)
    	{
    		$total = $request->total - $request->monto;

    		$egreso = EstadosCuenta::findOrFail($id);
    		$egreso->concepto = $request->concepto;
    		$egreso->fecha = $request->fecha;
    		$egreso->cheque = $request->cheque;
    		$egreso->movimiento = $request->movimiento;
    		$egreso->subtotal = $total;
    		$egreso->iva = 0;
    		$egreso->total = $total;
    		$egreso->retiro = $total;
    		$egreso->id_forma_pago = $request->id_forma_pago;
    		$egreso->id_cuenta = $request->id_cuenta;
    		$egreso->id_admin = $request->id_admin;
    		$egreso->update();

    		$comision = DB::table('nomina')
    			->where('id', '=', $id_comision)
    			->update(
    			[
    				'fecha_pagado' => null,
    				'comision_aplicada' => 0,
    				'estatus' => 'Liberada',
                    'id_egresos' => null
    			]);

    		return response()->json($egreso);
    	}
    	else if($request->value == 1)
    	{
    		$total = $request->total + $request->monto;

    		$egreso = EstadosCuenta::findOrFail($id);
    		$egreso->concepto = $request->concepto;
    		$egreso->fecha = $request->fecha;
    		$egreso->cheque = $request->cheque;
    		$egreso->movimiento = $request->movimiento;
    		$egreso->subtotal = $total;
    		$egreso->iva = 0;
    		$egreso->total = $total;
    		$egreso->retiro = $total;
    		$egreso->id_forma_pago = $request->id_forma_pago;
    		$egreso->id_cuenta = $request->id_cuenta;
    		$egreso->id_admin = $request->id_admin;
    		$egreso->update();

    		$comision = DB::table('nomina')
    			->where('id', '=', $id_comision)
    			->update(
    			[
    				'fecha_pagado' => $request->fecha,
    				'comision_aplicada' => 1,
    				'estatus' => 'Pagada',
                    'id_egresos' => $id

    			]);

    		return response()->json($egreso);
    	}
    }

    //Nomina
    public function mostrar_empleados()
    {
        $empleados = DB::table('users as u')
            ->leftjoin('role_user as ru', 'ru.user_id', '=', 'u.id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto', DB::raw('CONCAT(u.nombre," ",u.apellido) as nombre_completo'))
            ->where('u.nomina', '=', '1')
            ->where('u.estatus', '=', '1')
            ->orderBy('u.nombre', 'asc')->get();

        return view('admin.procesos.egresos.listado-empleados', compact('empleados'));
    }

    public function mostrar_empleados_nomina($id)
    {
        $empleados = DB::table('users as u')
            ->leftjoin('role_user as ru', 'ru.user_id', '=', 'u.id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->leftjoin('nomina as n', 'n.id_admin', '=', 'u.id')
            ->select('u.imagen', 'u.iniciales', 'r.name as puesto', 'u.nombre', 'u.apellido', 'u.sueldo_diario', 'n.id', 'n.monto', 'n.id_admin', 'n.id_egresos', 'n.created_at')
            ->where('n.id_egresos', '=', $id)
            ->orderBy('n.id', 'asc')->get();

        return view('admin.procesos.egresos.listado-empleados-nomina', compact('empleados'));
    }

    public function mostrar_empleados_aguinaldo()
    {
        $empleados = DB::table('users as u')
            ->leftjoin('role_user as ru', 'ru.user_id', '=', 'u.id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto', DB::raw('CONCAT(u.nombre," ",u.apellido) as nombre_completo'), DB::raw('(u.sueldo_diario * 30) as aguinaldo'))
            ->where('u.nomina', '=', '1')
            ->where('u.estatus', '=', '1')
            ->orderBy('u.nombre', 'asc')->get();

        return view('admin.procesos.egresos.listado-aguinaldo', compact('empleados'));
    }

    public function ConceptoComision(Request $request, $id)
    {
        if($request->accion == 1)
        {
            $comision = Nomina::findOrFail($id);
            $comision->fecha_pagado = $request->fecha;
            $comision->comision_aplicada = 1;
            $comision->estatus = 'Pagada';
            $comision->preseleccionar_comision = 0;
            $comision->id_egresos = $request->id_egreso;
            $comision->update();

            $total = $request->total + $request->monto;
        }   
        else if($request->accion == 0)
        {
            $comision = Nomina::findOrFail($id);
            $comision->fecha_pagado = null;
            $comision->comision_aplicada = 0;
            $comision->estatus = 'Liberada';
            $comision->preseleccionar_comision = 1;
            $comision->id_egresos = null;
            $comision->update();

            $total = $request->total - $request->monto;
        }

        $egreso = DB::table('estados_cuenta')   
            ->where('id', '=', $request->id_egreso)
            ->update(
                [
                    'subtotal' => $total,
                    'total' => $total,
                    'retiro' => $total
                ]);

        return response()->json($comision);
    }

    public function insertarNomina(Request $request)
    {
        $egreso = new EstadosCuenta;
        $egreso->tipo = $request->tipo;
        $egreso->tipo_movimiento = 'EGRESO';
        $egreso->orden = $request->orden;
        $egreso->concepto = $request->concepto;
        $egreso->fecha_ini = $request->fecha_inicio;
        $egreso->fecha = $request->fecha_fin;
        $egreso->cheque = $request->cheque;
        $egreso->subtotal = $request->retiro;
        $egreso->porcentaje_iva = 0;
        $egreso->iva = 0;
        $egreso->total = $request->retiro;
        $egreso->retiro = $request->retiro;
        $egreso->estatus = 'Pagado';
        $egreso->pagado_boolean = 1;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->save();

        return response()->json($egreso);
    }

    public function insertarNominas(Request $request)
    {
        $nomina = json_decode($request->string, true);

        Nomina::insert($nomina);

        return response()->json($nomina);
    }

    public function updateNomina(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'fecha' => 'required',
                'fecha_ini' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'monto' => 'required|min:0'
            ]);

        $nomina = EstadosCuenta::findOrFail($id);
        $nomina->fecha_ini = $request->fecha_ini;
        $nomina->fecha = $request->fecha;
        $nomina->tipo = $request->tipo;
        $nomina->subtotal = $request->monto;
        $nomina->total = $request->monto;
        $nomina->retiro = $request->monto;
        $nomina->pagado = $request->monto;
        $nomina->id_cuenta = $request->id_cuenta;
        $nomina->id_forma_pago = $request->id_forma_pago;
        $nomina->concepto = $request->concepto;
        $nomina->id_admin = $request->id_admin;
        $nomina->update();

        return response()->json($nomina);
    }

    //Traspasos
    public function insertarTraspaso(Request $request)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_cuenta_traspaso' => 'required',
                'id_forma_pago' => 'required',
                'monto' => 'required|min:0', 
                'orden' => 'required'
            ]);

        $egreso = new EstadosCuenta;
        $egreso->tipo = 'Traspaso';
        $egreso->tipo_movimiento = 'EGRESO';
        $egreso->orden = $request->orden;
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->con_iva = 0;
        $egreso->subtotal = $request->monto;
        $egreso->porcentaje_iva = 0;
        $egreso->iva = 0;
        $egreso->total = $request->monto;
        $egreso->retiro = $request->monto;
        $egreso->pagado = $request->monto;
        $egreso->restante = 0;
        $egreso->estatus = 'Pagado';
        $egreso->pagado_boolean = 1;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_cuenta_traspaso = $request->id_cuenta_traspaso;
        $egreso->save();

        $ingreso = new EstadosCuenta;
        $ingreso->tipo = 'Traspaso';
        $ingreso->tipo_movimiento = 'INGRESO';
        $ingreso->orden = $request->orden;
        $ingreso->concepto = $request->concepto;
        $ingreso->fecha = $request->fecha;
        $ingreso->cheque = $request->cheque;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->con_iva = 0;
        $ingreso->subtotal = $request->monto;
        $ingreso->porcentaje_iva = 0;
        $ingreso->iva = 0;
        $ingreso->total = $request->monto;
        $ingreso->deposito = $request->monto;
        $ingreso->pagado = $request->monto;
        $ingreso->restante = 0;
        $ingreso->estatus = 'Pagado';
        $ingreso->pagado_boolean = 1;
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_cuenta = $request->id_cuenta_traspaso;
        $ingreso->id_admin = $request->id_admin;
        $ingreso->id_cuenta_traspaso = $request->id_cuenta;
        $ingreso->id_cuenta_egreso = $egreso->id;
        $ingreso->save();

        return response()->json($egreso);
    }

    public function editarTraspaso(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_admin'=>'required',
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_cuenta_traspaso' => 'required',
                'id_forma_pago' => 'required',
                'monto' => 'required|min:0'
            ]);

        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->subtotal = $request->monto;
        $egreso->total = $request->monto;
        $egreso->retiro = $request->monto;
        $egreso->pagado = $request->monto;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_cuenta_traspaso = $request->id_cuenta_traspaso;
        $egreso->save();

        $ingreso = DB::table('estados_cuenta')
            ->where('id_cuenta_egreso', '=', $id)
            ->update(
                [
                    'concepto' => $request->concepto,
                    'fecha' => $request->fecha,
                    'cheque' => $request->cheque,
                    'movimiento' => $request->movimiento,
                    'subtotal' => $request->monto,
                    'total' => $request->monto,
                    'deposito' => $request->monto,
                    'pagado' => $request->monto,
                    'id_forma_pago' => $request->id_forma_pago,
                    'id_cuenta' => $request->id_cuenta_traspaso,
                    'id_cuenta_traspaso' => $request->id_cuenta,
                    'id_admin' => $request->id_admin
                ]);

        return response()->json($egreso);
    }
}













