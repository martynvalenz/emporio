<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Emporio\Model\Servicios;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\Proveedores;

class HonorariosController extends Controller
{
    public function index()
    {
      $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->where('id', '!=', '4')->get();
        $proveedores = Proveedores::where('estatus', '=', '1')->where('realiza_pagos', '=', '1')->get();

      return view('admin.honorarios.index', compact('porcentaje_iva', 'cuentas', 'formas_pago', 'proveedores'));
    }

    public function listar()
    {
      $servicios = DB::table('servicios as s')
        ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
        ->leftjoin('control as con', 's.id_control', '=', 'con.id')
        ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
        ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
        ->leftjoin('users as res', 's.id_admin', '=', 'res.id')
        ->select('s.id', 's.tramite', 's.costo_servicio', 's.asignar_costo_servicio', 's.gestionar_pago', 's.costo_pagado', 's.fecha', 'c.nombre_comercial', 'con.nombre as marca', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 'res.iniciales', 'res.nombre', 'res.apellido', 's.estatus_registro', 's.estatus_cobranza')
        ->where('s.gestionar_pago', '=', '1')
        ->where('s.estatus_registro', '!=', 'Cancelado')
        ->get();

      return view('admin.honorarios.listado', compact('servicios'));
    }

    public function listar_pendientes()
    {
      $servicios = DB::table('servicios as s')
        ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
        ->leftjoin('control as con', 's.id_control', '=', 'con.id')
        ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
        ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
        ->leftjoin('users as res', 's.id_admin', '=', 'res.id')
        ->leftjoin('servicio_progreso as req', 'req.id_servicio', '=', 's.id')
        ->select('s.id', 's.tramite', 's.costo_servicio', 's.asignar_costo_servicio', 's.gestionar_pago', 's.costo_pagado', 's.fecha', 'c.nombre_comercial', 'con.nombre as marca', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 'res.iniciales', 'res.nombre', 'res.apellido', 's.estatus_registro', 's.estatus_cobranza', 's.saldo', 's.cobrado')
        ->where('s.gestionar_pago', '=', '0')
        ->where('s.asignar_costo_servicio', '=', '1')
        ->where('s.costo_pagado', '=', '0')
        ->where('s.costo_servicio', '>', '0')
        ->where('req.id_requisitos', '=', 14)
        // ->where('s.costo_servicio', '<=', 's.cobrado')
        ->where('s.estatus_registro', '!=', 'Cancelado')
        ->orderBy('s.fecha', 'asc')
        ->paginate(50);

      $monto_total = DB::table('servicios as s')
        ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
        ->leftjoin('control as con', 's.id_control', '=', 'con.id')
        ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
        ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
        ->leftjoin('users as res', 's.id_admin', '=', 'res.id')
        ->leftjoin('servicio_progreso as req', 'req.id_servicio', '=', 's.id')
        ->select(DB::raw('SUM(s.costo_servicio) as costo_total'))
        ->where('s.gestionar_pago', '=', '0')
        ->where('s.asignar_costo_servicio', '=', '1')
        ->where('s.costo_pagado', '=', '0')
        ->where('s.costo_servicio', '>', '0')
        ->where('req.id_requisitos', '=', 14)
        // ->where('s.costo_servicio', '<=', 's.cobrado')
        ->where('s.estatus_registro', '!=', 'Cancelado')
        ->sum('s.costo_servicio');

      return view('admin.honorarios.listado-pendientes', compact('servicios', 'monto_total'));
    }

    public function buscar($buscar)
    {
      $servicios = DB::table('servicios as s')
        ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
        ->leftjoin('control as con', 's.id_control', '=', 'con.id')
        ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
        ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
        ->leftjoin('users as res', 's.id_admin', '=', 'res.id')
        ->leftjoin('servicio_progreso as req', 'req.id_servicio', '=', 's.id')
        ->select('s.id', 's.tramite', 's.costo_servicio', 's.asignar_costo_servicio', 's.gestionar_pago', 's.costo_pagado', 's.fecha', 'c.nombre_comercial', 'con.nombre as marca', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 'res.iniciales', 'res.nombre', 'res.apellido', 's.estatus_registro', 's.estatus_cobranza', 's.saldo', 's.cobrado')
        ->where('s.gestionar_pago', '=', '0')
        ->where('s.asignar_costo_servicio', '=', '1')
        ->where('s.costo_servicio', '>', '0')
        ->where('s.costo_pagado', '=', '0')
        ->where('req.id_requisitos', '=', 14)
        ->where('s.estatus_registro', '!=', 'Cancelado')
        ->where(function($q) use ($buscar)
        {
            $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
            ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
            ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
            ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
            ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
            ->orWhere('res.iniciales','LIKE','%'.$buscar.'%')
            ->orWhere('res.nombre','LIKE','%'.$buscar.'%')
            ->orWhere('res.apellido','LIKE','%'.$buscar.'%')
            ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
            ->orWhere('s.costo','LIKE',$buscar.'%')
            ->orWhere('s.costo_servicio','LIKE',$buscar.'%')
            ->orWhere('s.id','LIKE',$buscar)
            ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
        })
        ->orderBy('s.fecha', 'asc')
        ->paginate(50);

        $monto_total = DB::table('servicios as s')
          ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
          ->leftjoin('control as con', 's.id_control', '=', 'con.id')
          ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
          ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
          ->leftjoin('users as res', 's.id_admin', '=', 'res.id')
          ->leftjoin('servicio_progreso as req', 'req.id_servicio', '=', 's.id')
          ->select(DB::raw('SUM(s.costo_servicio) as costo_total'))
          ->where('s.gestionar_pago', '=', '0')
          ->where('s.asignar_costo_servicio', '=', '1')
          ->where('s.costo_pagado', '=', '0')
          ->where('s.costo_servicio', '>', '0')
          ->where('req.id_requisitos', '=', 14)
          // ->where('s.costo_servicio', '<=', 's.cobrado')
          ->where('s.estatus_registro', '!=', 'Cancelado')
          ->where(function($q) use ($buscar)
          {
              $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
              ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
              ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
              ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
              ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
              ->orWhere('res.iniciales','LIKE','%'.$buscar.'%')
              ->orWhere('res.nombre','LIKE','%'.$buscar.'%')
              ->orWhere('res.apellido','LIKE','%'.$buscar.'%')
              ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
              ->orWhere('s.costo','LIKE',$buscar.'%')
              ->orWhere('s.costo_servicio','LIKE',$buscar.'%')
              ->orWhere('s.id','LIKE',$buscar)
              ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
          })
          ->sum('s.costo_servicio');

      return view('admin.honorarios.listado-pendientes', compact('servicios', 'monto_total'));
    }

    public function honorarios_select(Request $request, $id)
    {
      $servicio = Servicios::findOrFail($id);
      $servicio->gestionar_pago = $request->gestionar_pago;
      $servicio->update();

      return response()->json($servicio);
    }

    public function proveedores()
    {
        $proveedores = Proveedores::select('id', 'nombre_comercial')->where('estatus', '1')->where('realiza_pagos', '1')->get();

        return response()->json($proveedores);
    }

    public function pagar_honorarios(Request $request)
    {
        $this->validate($request,
            [
                'id_proveedor' => 'required',
                'fecha' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'porcentaje_iva' => 'required',
                'monto' => 'required|min:1',
                'orden' => 'required'
            ]);

        if($request->con_iva == 1)
        {
            $total = $request->monto;
            $subtotal = $total / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->con_iva == 0)
        {
            $subtotal = $request->monto;
            $total = $request->monto;
            $iva = 0;
        }

        $mytime = Carbon::now('America/Chihuahua');
        $fecha = $mytime->toDateTimeString();

        $proceso = DB::table('servicio_progreso as req')
          ->join('servicios as s', 's.id', '=', 'req.id_servicio')
          ->where('s.asignar_costo_servicio', '=', 1)
          ->where('s.gestionar_pago', '=', 1)
          ->where('s.costo_pagado', '=', 0)
          ->where('req.id_requisitos', '=', 14)
          ->update(
            [
                'req.estatus' => 1,
                'req.id_admin' => $request->id_admin,
                'req.created_at' => $fecha,
                'req.updated_at' => $fecha,
            ]);

        $egreso = new EstadosCuenta;
        $egreso->tipo = $request->tipo;
        $egreso->tipo_movimiento = 'EGRESO';
        $egreso->orden = $request->orden;
        $egreso->concepto = $request->concepto;
        $egreso->fecha = $request->fecha;
        $egreso->con_iva = $request->con_iva;
        $egreso->porcentaje_iva = $request->porcentaje_iva;
        $egreso->cheque = $request->cheque;
        $egreso->movimiento = $request->movimiento;
        $egreso->subtotal = $subtotal;
        $egreso->iva = $iva;
        $egreso->total = $total;
        $egreso->retiro = $total;
        $egreso->estatus = 'Pagado';
        $egreso->pagado_boolean = 1;
        $egreso->pago_servicios = 1;
        $egreso->id_forma_pago = $request->id_forma_pago;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->save();

        $honorarios = DB::table('servicios')
            ->where('asignar_costo_servicio', '=', 1)
            ->where('gestionar_pago', '=', 1)
            ->where('costo_pagado', '=', 0)
            ->where('estatus_registro', '!=', 'Cancelado')
            ->update(
                [
                    'costo_pagado' => 1,
                    'gestionar_pago' => 0,
                    'id_egreso' => $egreso->id,
                    'avance' => DB::raw('avance + 1')
                ]);

        

        return response()->json($egreso);
    }
}














