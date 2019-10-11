<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Admin;
use Emporio\Model\Proveedores;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\CategoriaEgresos;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\CobranzaDetalles;
use Emporio\Model\RazonSocial;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class CobranzaController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');

            $query=trim($request->get('searchText'));
            $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
            $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
            $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
            $clientes = Clientes::where('estatus', '=', '1')->orderBy('nombre_comercial')->get();

            $ingresos=DB::table('estados_cuenta as e')
                ->join('users as a', 'e.id_admin', '=', 'a.id')
                ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
                ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
                ->leftjoin('bancos as ban', 'cu.id_banco', '=', 'ban.id')
                ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
                ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'e.id_razon_social')
                ->leftjoin('cobranza_detalles as det', 'det.id_cobranza', '=', 'e.id')
                ->select('e.id', 'e.tipo', 'e.concepto', 'e.fecha', 'e.con_iva','e.folio', 'e.cheque', 'e.movimiento', 'e.subtotal', 'e.porcentaje_iva', 'e.iva', 'e.total', 'e.deposito', 'e.estatus', 'e.created_at', 'e.updated_at', 'e.cancelado_at', 'e.pagado', 'e.pagado_boolean', 'e.id_cliente', 'a.iniciales', 'a.nombre', 'a.apellido', 'cu.alias', 'cu.tipo as tarjeta_tipo', 'ban.banco', 'f.forma_pago', 'f.codigo', 'cli.nombre_comercial', 'raz.razon_social', 'raz.rfc', DB::raw('count(det.id_cobranza) as detalles'))
                //->whereNotNull('fecha')
                ->where('e.pagado_boolean', '=', '1')
                ->where('e.tipo','=','Ingreso')
                ->where(function($q) use ($query)
                {
                    $q->where('e.id','LIKE','%'.$query.'%')
                    ->orWhere('e.tipo','LIKE','%'.$query.'%')
                    ->orWhere('e.concepto','LIKE','%'.$query.'%')
                    ->orWhere('e.folio','LIKE','%'.$query.'%')
                    ->orWhere('e.cheque','LIKE','%'.$query.'%')
                    ->orWhere('e.movimiento','LIKE','%'.$query.'%')
                    ->orWhere('e.subtotal','LIKE','%'.$query.'%')
                    ->orWhere('e.total','LIKE','%'.$query.'%')
                    ->orWhere('cli.nombre_comercial','LIKE','%'.$query.'%')
                    ->orWhere('raz.razon_social','LIKE','%'.$query.'%')
                    ->orWhere('raz.rfc','LIKE','%'.$query.'%')
                    ->orWhere('a.nombre','LIKE','%'.$query.'%')
                    ->orWhere('a.apellido','LIKE','%'.$query.'%')
                    ->orWhere('a.iniciales','LIKE','%'.$query.'%')
                    ->orWhere('cu.alias','LIKE','%'.$query.'%')
                    ->orWhere('f.forma_pago','LIKE','%'.$query.'%')
                    ->orWhere('ban.banco','LIKE','%'.$query.'%')
                    ->orWhere('cu.tipo','LIKE','%'.$query.'%')
                    ->orWhere('cu.alias','LIKE','%'.$query.'%');
                })
                ->orderBy('e.fecha', 'desc')
                ->groupBy('e.id', 'e.tipo', 'e.concepto', 'e.fecha', 'e.con_iva','e.folio', 'e.cheque', 'e.movimiento', 'e.subtotal', 'e.porcentaje_iva', 'e.iva', 'e.total', 'e.deposito', 'e.estatus', 'e.created_at', 'e.updated_at', 'e.cancelado_at', 'e.pagado', 'e.pagado_boolean', 'e.id_cliente', 'a.iniciales', 'a.nombre', 'a.apellido', 'cu.alias', 'cu.tipo', 'ban.banco', 'f.forma_pago', 'f.codigo', 'cli.nombre_comercial', 'raz.razon_social', 'raz.rfc')
                ->paginate(30);


            return view('admin.ingresos.cobranza.index',["searchText"=>$query, "cuentas" => $cuentas, "formas_pago"=>$formas_pago, "ingresos"=>$ingresos, "porcentaje_iva"=>$porcentaje_iva, "clientes"=>$clientes]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'total'=>'required|numeric',
            ]);

        $ingreso = new EstadosCuenta;
        $ingreso->tipo = 'Ingreso';
        $ingreso->concepto = $request->concepto;

        if($request->fecha == null)
        {
            $mytime = Carbon::now('America/Chihuahua');
            $ingreso->fecha=$mytime->toDateString();
        }
        else
        {
            $ingreso->fecha = $request->fecha;
        }

        $ingreso->con_iva = $request->con_iva;
        $ingreso->cheque = $request->cheque;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->subtotal = 0;
        $ingreso->porcentaje_iva = $request->porcentaje_iva;
        $ingreso->iva = 0;
        $ingreso->total = $request->total;
        $ingreso->deposito = $request->total;
        $ingreso->restante = $request->total;
        $ingreso->estatus = $request->estatus;
        $ingreso->pagado_boolean = $request->pagado_boolean;
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_cuenta = $request->id_cuenta;
        $ingreso->id_admin = $request->id_admin;
        $ingreso->id_cliente = $request->id_cliente;
        $ingreso->id_razon_social = $request->id_razon_social;

        $ingreso->save();

        $mensaje = array(
                'message' => 'Se creó el ingreso, ahora falta asignarle facturas/recibos.', 
                'alert-type' => 'success'
            );
        //return back()->with($mensaje);

        return redirect()->route('cobranza.edit', $ingreso->id)->with($mensaje);
    }

    public function edit(Request $request, $id)
    {
        Carbon::setLocale('es');
        $ingreso = EstadosCuenta::find($id);
        /*$ingreso = DB::table('estados_cuenta')
            ->select('id','id_cliente', DB::raw('DATE_FORMAT(fecha, "%d-%b-%Y") as fecha'), 'id_razon_social', 'id_cuenta', 'id_forma_pago', 'cheque', 'movimiento', 'subtotal', 'porcentaje_iva', 'iva', 'total', 'restante', 'concepto', 'estatus')
            ->where('id' ,'=', $ids)
            ->get();*/

        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();

        $clientes=Clientes::orderBy('nombre_comercial','ASC')
            ->where('estatus', '=', '1')
            ->get();

        $razones_sociales=RazonSocial::orderBy('razon_social', 'asc')
            ->where('id_cliente', '=', $ingreso->id_cliente)
            ->where('estatus', '=', '1')
            ->get();

        $detalles= DB::table('cobranza_detalles as det')
            ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
            ->leftjoin('estados_cuenta as e', 'e.id', '=', 'det.id_cobranza')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'f.id_razon_social')
            ->leftjoin('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->select('det.id', 'det.id_factura', 'det.id_cobranza', 'det.monto', 'det.pagado', 'f.folio_factura', 'f.folio_recibo', 'f.total', 'f.saldo', 'raz.razon_social', 'raz.rfc', 'c.nombre_comercial', 'f.comentarios', 'f.fecha')
            ->where('det.id_cobranza','=', $ingreso->id)
            ->orderBy('id_factura','ASC')
            ->get();

        $facturas_seleccionar = DB::table('facturas as f')
            ->leftjoin('clientes as c', 'f.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'f.id_razon_social')
            ->select('f.id', 'f.folio_recibo', 'f.folio_factura', 'f.fecha', 'f.subtotal','f.iva', 'f.pagado','f.pagado_terminado', 'f.total', 'f.saldo', 'f.comentarios', 'f.created_at', 'f.updated_at', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc', 'f.estatus', 'f.porcentaje_iva')
            ->where('f.estatus', '=', 'Pendiente')
            ->where('f.pagado_terminado', '=', 0)
            ->where('f.id_cliente', '=', $ingreso->id_cliente)
            ->orderBy('f.created_at', 'asc')
            //->groupBy('s.id', 'c.clave', 'c.servicio', 's.tramite', 's.costo', 's.facturado', 's.estatus_cobranza', 's.clase')
            ->get();

        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();

        return view('admin.ingresos.cobranza.edit', compact('ingreso', 'clientes', 'razones_sociales', 'facturas_seleccionar', 'detalles', 'porcentaje_iva', 'cuentas', 'formas_pago'));
    }

    public function update(Request $request, $id)
    {
        $ingreso = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'total'=>'required|numeric',
            ]);

        $ingreso->concepto = $request->concepto;
        $ingreso->fecha = $request->fecha;
        $ingreso->cheque = $request->cheque;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->total = $request->total;
        $ingreso->deposito = $request->total;
        $ingreso->restante = $request->total - $request->pagado;
        $ingreso->estatus = $request->estatus;
        $ingreso->pagado_boolean = $request->pagado_boolean;
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_cuenta = $request->id_cuenta;
        if($request->id_cliente_select > 0)
        {
            $ingreso->id_cliente = $request->id_cliente_select;
        }
        else if($request->id_cliente_input > 0)
        {
            $ingreso->id_cliente = $request->id_cliente_input;
        }
        $ingreso->id_razon_social = $request->id_razon_social;

        $ingreso->save();

        $mensaje = array(
                'message' => 'Se editó el egreso satisfactoriamente.', 
                'alert-type' => 'info'
            );

        //return back()->with($mensaje);
        return json_encode($ingreso);
    }

    public function actualizar(Request $request, $id)
    {
        $ingreso = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'total'=>'required|numeric',
            ]);

        $ingreso->concepto = $request->concepto;
        $ingreso->fecha = $request->fecha;
        $ingreso->cheque = $request->cheque;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->total = $request->total;
        $ingreso->deposito = $request->total;
        $ingreso->restante = $request->total - $request->pagado;
        $ingreso->estatus = $request->estatus;
        $ingreso->pagado_boolean = $request->pagado_boolean;
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_cuenta = $request->id_cuenta;
        if($request->id_cliente_select > 0)
        {
            $ingreso->id_cliente = $request->id_cliente_select;
        }
        else if($request->id_cliente_input > 0)
        {
            $ingreso->id_cliente = $request->id_cliente_input;
        }
        $ingreso->id_razon_social = $request->id_razon_social;

        $ingreso->save();

        $mensaje = array(
                'message' => 'Se editó el egreso satisfactoriamente.', 
                'alert-type' => 'info'
            );

        return json_encode($ingreso);
    }

    public function insertar_factura(Request $request)
    {
        $id = $request->id_cobranza_fact;

        if($request->saldo_fact == $request->monto)
        {
            $detalle = new CobranzaDetalles;
            $detalle->monto = $request->monto;
            $detalle->id_cobranza = $request->id_cobranza_fact;
            $detalle->id_factura = $request->id_factura;
            $detalle->pagado = 1;
            $detalle->save();

            $factura = DB::table('facturas')
                ->where('id', '=', $request->id_factura)
                ->update(
                    [
                        'pagado' => $request->pagado_fact + $request->monto,
                        'saldo' => $request->saldo_fact - $request->monto,
                        'estatus' => 'Pagado',
                        'pagado_terminado' => 1,
                        'fecha_pagada' => $request->ingreso_fecha
                    ]);
        }
        else if($request->saldo_fact > $request->monto)
        {
            $detalle = new CobranzaDetalles;
            $detalle->monto = $request->monto;
            $detalle->id_cobranza = $request->id_cobranza_fact;
            $detalle->id_factura = $request->id_factura;
            $detalle->save();

            $factura = DB::table('facturas')
                ->where('id', '=', $request->id_factura)
                ->update(
                    [
                        'pagado' => $request->pagado_fact + $request->monto,
                        'saldo' => $request->saldo_fact - $request->monto,
                        'estatus' => 'Pendiente',
                        'fecha_pagada' => $request->ingreso_fecha
                    ]);
        }
        

        $cobranza = DB::table('estados_cuenta')
            ->where('id', '=', $request->id_cobranza_fact)
            ->update(
                [
                    'subtotal' => $request->subtotal_ant + ($request->monto - ($request->monto * $request->porcentaje_iva)),
                    'iva' => $request->iva_ant + ($request->monto * $request->porcentaje_iva),
                    'pagado' => $request->pagado_fact + $request->monto,
                    'restante' => $request->restante_fact - $request->monto
                ]);

        $mensaje = array(
                'message' => 'Se la factura/recibo exitosamente.', 
                'alert-type' => 'success'
            );

        //return back()->with($mensaje);
        return redirect(route('cobranza.edit', $id))->with($mensaje);
    }
}
