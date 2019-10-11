<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\User;
use Emporio\Model\RazonSocial;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\FacturasDetalles;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\Facturas;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class RecibosController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');

            $query=trim($request->get('searchText'));
            $clientes = Clientes::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
            $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();

            $recibos=DB::table('facturas as fac')
                ->leftjoin('clientes as c', 'fac.id_cliente', '=', 'c.id')
                ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
                ->leftjoin('users as ad', 'fac.id_admin', '=', 'ad.id')
                ->select('fac.id', 'fac.folio_recibo', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
                ->where('fac.tipo','=','Recibo')
                //->where('fac.estatus','=','Pendiente')
                ->where(function($q) use ($query)
                {
                    $q->where('fac.id','LIKE','%'.$query.'%')
                    ->orWhere('fac.folio_recibo','LIKE','%'.$query.'%')
                    ->orWhere('c.nombre_comercial','LIKE','%'.$query.'%')
                    ->orWhere('fac.calle','LIKE','%'.$query.'%')
                    ->orWhere('fac.colonia','LIKE','%'.$query.'%')
                    ->orWhere('fac.estado','LIKE','%'.$query.'%')
                    ->orWhere('fac.municipio','LIKE','%'.$query.'%')
                    ->orWhere('fac.localidad','LIKE','%'.$query.'%')
                    ->orWhere('fac.pais','LIKE','%'.$query.'%')
                    ->orWhere('fac.subtotal','LIKE','%'.$query.'%')
                    ->orWhere('fac.total','LIKE','%'.$query.'%')
                    ->orWhere('fac.saldo','LIKE','%'.$query.'%')
                    ->orWhere('ad.nombre','LIKE','%'.$query.'%')
                    ->orWhere('ad.apellido','LIKE','%'.$query.'%')
                    ->orWhere('ad.iniciales','LIKE','%'.$query.'%')
                    ->orWhere('fac.comentarios','LIKE','%'.$query.'%');
                })
                ->orderBy('fac.folio_recibo', 'asc')
                //->groupBy('fac.id')
                ->paginate(30);


            return view('admin.facturacion.recibos.index',["searchText"=>$query, "clientes"=>$clientes, "porcentaje_iva"=>$porcentaje_iva, "recibos"=>$recibos]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'folio_recibo'=>'required|unique:facturas'
            ]);

        $recibo = new Facturas;
        $recibo->folio_recibo = $request->folio_recibo; 
        //$factura->folio_fiscal = $request->folio_fiscal; 

        if($request->fecha == null)
        {
            $mytime = Carbon::now('America/Chihuahua');
            $recibo->fecha=$mytime->toDateString();
        }
        else
        {
            $recibo->fecha = $request->fecha;
        }

        $recibo->subtotal = $request->monto;
        $recibo->iva = $request->monto;

        if($request->con_iva == 1)
        {
            $recibo->porcentaje_iva = $request->porcentaje_iva;
        }
        else if($request->con_iva == 0)
        {
            $recibo->porcentaje_iva = 0;
        }
        
        $recibo->pagado = $request->monto;
        $recibo->total = $request->monto;
        $recibo->saldo = $request->monto;
        $recibo->estatus = 'Pendiente';
        $recibo->tipo = 'Recibo';
        $recibo->id_cliente = $request->id_cliente;
        $recibo->id_admin = $request->id_admin;
        $recibo->comentarios = $request->comentarios;

        $recibo->save();

        $mensaje = array(
                'message' => 'Se creó el recibo satisfactoriamente, ya solo falta asignarle servicios y forma de pago.', 
                'alert-type' => 'success'
            );

        return redirect()->route('recibos.edit', $recibo->id)->with($mensaje);
    }

    public function edit(Request $request, $id)
    {
        Carbon::setLocale('es');
        $recibo = Facturas::find($id);

        $clientes=Clientes::orderBy('nombre_comercial','ASC')
            ->where('estatus', '=', '1')
            ->get();

        $razones_sociales=RazonSocial::
            where('id_cliente', '=', $recibo->id_cliente)
            ->where('estatus', '=', '1')
            ->orderBy('razon_social', 'asc')
            ->get();

        $detalles=FacturasDetalles::orderBy('created_at','ASC')
            ->where('id_factura','=', $recibo->id)
            ->get();

        $servicios_seleccionar = DB::table('servicios as s')
            ->leftjoin('catalogo_servicios as c', 's.id_catalogo_servicio', '=', 'c.id')
            ->leftjoin('control as mar', 's.id_control', '=', 'mar.id')
            ->select('s.id', 'c.clave', 'c.servicio', 's.tramite', 's.costo', 's.facturado', 's.estatus_cobranza', 's.clase', 's.facturado_terminado', 'mar.nombre')
            //->where('s.estatus_cobranza', '=', 'Pendiente')
            ->where('s.facturado_terminado', '=', 0)
            ->where('s.id_cliente', '=', $recibo->id_cliente)
            ->orderBy('c.clave', 'asc')
            //->groupBy('s.id', 'c.clave', 'c.servicio', 's.tramite', 's.costo', 's.facturado', 's.estatus_cobranza', 's.clase')
            ->get();

        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();

        return view('admin.facturacion.recibos.edit', compact('recibo', 'clientes','razones_sociales',  'detalles', 'servicios_seleccionar'));
    }

    public function update(Request $request, $id)
    {
        $recibo = Facturas::findOrFail($id);

        $this->validate($request,
            [
                'id_cliente'=>'required',
                'folio_recibo'=>'required|unique_with:facturas,'.$recibo->id
            ]);

        $recibo->folio_recibo = $request->folio_recibo; 
        $recibo->comentarios = $request->comentarios; 

        if($request->fecha == null)
        {
            $mytime = Carbon::now('America/Chihuahua');
            $recibo->fecha=$mytime->toDateString();
        }
        else
        {
            $recibo->fecha = $request->fecha;
        }

        $recibo->id_cliente = $request->id_cliente;
        $recibo->id_razon_social = $request->id_razon_social;

        $recibo->update();

        $mensaje = array(
                'message' => 'Se actualizaron los datos del recibo.', 
                'alert-type' => 'success'
            );

        return back()->with($mensaje);
    }
}
