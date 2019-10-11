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

class FacturasController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('es');
        $clientes = Clientes::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $tipo_vista = 'Facturas';
        $variable_estatus = 'todas';
        $url_listar = '/admin/facturas-listado/';
        $url_buscar = '/admin/facturas-buscar/';
        $url_actualizar = '/admin/facturas-actualizar/';

        return view('admin.facturacion.facturas.index', compact('clientes', 'porcentaje_iva', 'tipo_vista', 'variable_estatus', 'url_listar', 'url_buscar', 'url_actualizar'));
    }

    public function listado($estatus, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $facturas=DB::table('facturas as fac')
            ->join('clientes as c', 'fac.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
            ->leftjoin('users as ad', 'fac.id_admin', '=', 'ad.id')
            ->leftjoin('facturas_detalles as det', 'fac.id', '=', 'det.id_factura')
            ->select('fac.id', 'fac.folio_factura', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->addSelect(DB::raw('count(det.id) as detalles'))
            ->where('fac.tipo','=','Factura')
            // ->where('fac.fecha', '>=', $fecha_inicio)
            // ->where('fac.fecha', '<=', $fecha_fin)
            ->where('fac.historico', '=', '0')
            ->groupBy('fac.id', 'fac.folio_factura', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->orderBy('fac.folio_factura', 'desc');

            if($estatus == 'todas')
            {
                //
            }
            else if($estatus != 'todas')
            {
                $facturas->where('fac.estatus', '=', $estatus);
            }

            $facturas = $facturas->paginate(50);

        return view('admin.procesos.facturas.listado', compact('facturas'));
    }

    public function buscar($estatus, $buscar, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $facturas=DB::table('facturas as fac')
            ->join('clientes as c', 'fac.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
            ->join('users as ad', 'fac.id_admin', '=', 'ad.id')
            ->leftjoin('facturas_detalles as det', 'fac.id', '=', 'det.id_factura')
            ->select('fac.id', 'fac.folio_factura', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->addSelect(DB::raw('count(det.id_factura) as detalles'))
            ->where('fac.tipo','=','Factura')
            // ->where('fac.fecha', '>=', $fecha_inicio)
            // ->where('fac.fecha', '<=', $fecha_fin)
            ->where('fac.historico', '=', '0')
            ->where(function($q) use ($buscar)
            {
                $q->where('fac.id','LIKE','%'.$buscar.'%')
                ->orWhere('fac.folio_factura','LIKE','%'.$buscar.'%')
                ->orWhere('fac.folio_fiscal','LIKE','%'.$buscar.'%')
                ->orWhere('fac.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('fac.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('fac.calle','LIKE','%'.$buscar.'%')
                ->orWhere('fac.colonia','LIKE','%'.$buscar.'%')
                ->orWhere('fac.estado','LIKE','%'.$buscar.'%')
                ->orWhere('fac.municipio','LIKE','%'.$buscar.'%')
                ->orWhere('fac.localidad','LIKE','%'.$buscar.'%')
                ->orWhere('fac.pais','LIKE','%'.$buscar.'%')
                ->orWhere('fac.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('fac.total','LIKE','%'.$buscar.'%')
                ->orWhere('fac.saldo','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('fac.comentarios','LIKE','%'.$buscar.'%');
            })
            ->groupBy('fac.id', 'fac.folio_factura', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->orderBy('fac.folio_factura', 'desc');

            if($estatus == 'todas')
            {
                //
            }
            else if($estatus != 'todas')
            {
                $facturas->where('fac.estatus', '=', $estatus);
            }

            $facturas = $facturas->paginate(50);

        return view('admin.procesos.facturas.listado', compact('facturas'));
    }

    public function actualizar($id)
    {
        Carbon::setLocale('es');
        $factura=DB::table('facturas as fac')
            ->join('clientes as c', 'fac.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
            ->leftjoin('users as ad', 'fac.id_admin', '=', 'ad.id')
            ->leftjoin('facturas_detalles as det', 'fac.id', '=', 'det.id_factura')
            ->select('fac.id', 'fac.folio_factura', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->addSelect(DB::raw('count(det.id) as detalles'))
            ->where('fac.id', '=', $id)
            ->groupBy('fac.id', 'fac.folio_factura', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->first();

        return view('admin.procesos.facturas.listado-actualizar', compact('factura'));
    }

    public function recibos_listado($estatus, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $facturas=DB::table('facturas as fac')
            ->join('clientes as c', 'fac.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
            ->leftjoin('users as ad', 'fac.id_admin', '=', 'ad.id')
            ->leftjoin('facturas_detalles as det', 'fac.id', '=', 'det.id_factura')
            ->select('fac.id', 'fac.folio_recibo', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->addSelect(DB::raw('count(det.id) as detalles'))
            ->where('fac.tipo','=','Recibo')
            // ->where('fac.fecha', '>=', $fecha_inicio)
            // ->where('fac.fecha', '<=', $fecha_fin)
            ->where('fac.historico', '=', '0')
            ->groupBy('fac.id', 'fac.folio_recibo', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->orderBy('fac.folio_recibo', 'desc');

            if($estatus == 'todas')
            {
                //
            }
            else if($estatus != 'todas')
            {
                $facturas->where('fac.estatus', '=', $estatus);
            }

            $facturas = $facturas->paginate(50);

        return view('admin.procesos.recibos.listado', compact('facturas'));
    }

    public function recibos_buscar($estatus, $buscar, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $facturas=DB::table('facturas as fac')
            ->join('clientes as c', 'fac.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
            ->join('users as ad', 'fac.id_admin', '=', 'ad.id')
            ->leftjoin('facturas_detalles as det', 'fac.id', '=', 'det.id_factura')
            ->select('fac.id', 'fac.folio_recibo', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->addSelect(DB::raw('count(det.id_factura) as detalles'))
            ->where('fac.tipo','=','Recibo')
            // ->where('fac.fecha', '>=', $fecha_inicio)
            // ->where('fac.fecha', '<=', $fecha_fin)
            ->where('fac.historico', '=', '0')
            ->where(function($q) use ($buscar)
            {
                $q->where('fac.id','LIKE','%'.$buscar.'%')
                ->orWhere('fac.folio_recibo','LIKE','%'.$buscar.'%')
                ->orWhere('fac.folio_fiscal','LIKE','%'.$buscar.'%')
                ->orWhere('fac.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('fac.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('fac.calle','LIKE','%'.$buscar.'%')
                ->orWhere('fac.colonia','LIKE','%'.$buscar.'%')
                ->orWhere('fac.estado','LIKE','%'.$buscar.'%')
                ->orWhere('fac.municipio','LIKE','%'.$buscar.'%')
                ->orWhere('fac.localidad','LIKE','%'.$buscar.'%')
                ->orWhere('fac.pais','LIKE','%'.$buscar.'%')
                ->orWhere('fac.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('fac.total','LIKE','%'.$buscar.'%')
                ->orWhere('fac.saldo','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('fac.comentarios','LIKE','%'.$buscar.'%');
            })
            ->groupBy('fac.id', 'fac.folio_recibo', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->orderBy('fac.folio_recibo', 'desc');

            if($estatus == 'todas')
            {
                //
            }
            else if($estatus != 'todas')
            {
                $facturas->where('fac.estatus', '=', $estatus);
            }

            $facturas = $facturas->paginate(50);

        return view('admin.procesos.recibos.listado', compact('facturas'));
    }

    public function recibos_actualizar($id)
    {
        Carbon::setLocale('es');
        $factura=DB::table('facturas as fac')
            ->join('clientes as c', 'fac.id_cliente', '=', 'c.id')
            ->leftjoin('razones_sociales as raz', 'fac.id_razon_social', '=', 'raz.id')
            ->leftjoin('users as ad', 'fac.id_admin', '=', 'ad.id')
            ->leftjoin('facturas_detalles as det', 'fac.id', '=', 'det.id_factura')
            ->select('fac.id', 'fac.folio_recibo', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social as razon', 'raz.rfc as rfc_cliente','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->addSelect(DB::raw('count(det.id) as detalles'))
            ->where('fac.id', '=', $id)
            ->groupBy('fac.id', 'fac.folio_recibo', 'fac.folio_fiscal', 'fac.rfc', 'fac.razon_social', 'fac.calle', 'fac.numero', 'fac.numero_int','fac.colonia', 'fac.cp', 'fac.localidad', 'fac.municipio', 'fac.estado', 'fac.pais','fac.fecha','fac.fecha_pagada', 'fac.subtotal', 'fac.porcentaje_iva', 'fac.iva','fac.total','fac.saldo','fac.comentarios','fac.estatus','fac.id_cliente','fac.id_razon_social','fac.id_admin','ad.iniciales', 'ad.nombre', 'ad.apellido', 'c.nombre_comercial', 'raz.razon_social', 'raz.rfc','fac.created_at', 'fac.updated_at', 'fac.pagado')
            ->first();

        return view('admin.procesos.recibos.listado-actualizar', compact('factura'));
    }

    public function actualizar_totales($id)
    {
        $factura = Facturas::select('subtotal', 'iva', 'total', 'pagado', 'saldo')->where('id', '=', $id)->first();

        return response()->json($factura);
    }

    public function store(Request $request)
    {
        if($request->tipo == 'Factura')
        {
            $this->validate($request,
                [
                    'id_cliente'=>'required',
                    'fecha'=>'required|date',
                    'folio_factura'=>'required|unique:facturas'
                ]);
        }
        else if($request->tipo == 'Recibo')
        {
            $this->validate($request,
                [
                    'id_cliente'=>'required',
                    'fecha'=>'required|date',
                    'porcentaje_iva' => 'required|min:0',
                    'folio_recibo'=>'required|unique:facturas'
                ]);
        }
        
        $factura = new Facturas;

        if($request->tipo == 'Factura')
        {
            $factura->folio_factura = $request->folio_factura;
        }
        else if($request->tipo == 'Recibo')
        {
            $factura->folio_recibo = $request->folio_recibo;
        }

        $factura->id_cliente = $request->id_cliente;
        $factura->id_razon_social = $request->id_razon_social;
        $factura->id_admin = $request->id_admin;
        $factura->tipo = $request->tipo;
        $factura->fecha = $request->fecha;
        $factura->comentarios = $request->comentarios;
        $factura->subtotal = $request->subtotal;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->iva = $request->iva;
        $factura->con_iva = $request->con_iva;
        $factura->total = $request->total;
        $factura->pagado = $request->pagado;
        $factura->saldo = $request->saldo;
        $factura->estatus = 'Pendiente';

        $factura->save();

        return response()->json($factura);
    }

    public function update(Request $request, $id)
    {
        $factura = Facturas::find($id);

        if($request->tipo == 'Factura')
        {
            $this->validate($request,
                [
                    'id_cliente'=>'required',
                    'fecha'=>'required|date',
                    'porcentaje_iva' => 'required|min:0',
                    'folio_factura'=>'required|unique_with:facturas,'.$id
                ]);
        }
        else if($request->tipo == 'Recibo')
        {
            $this->validate($request,
                [
                    'id_cliente'=>'required',
                    'fecha'=>'required|date',
                    'porcentaje_iva' => 'required|min:0',
                    'folio_recibo'=>'required|unique_with:facturas,'.$id
                ]);
        }

        if($request->tipo == 'Factura')
        {
            $factura->folio_factura = $request->folio_factura;
        }
        else if($request->tipo == 'Recibo')
        {
            $factura->folio_recibo = $request->folio_recibo;
        }

        if($request->con_iva == 1)
        {
            $iva = $request->subtotal * ($request->porcentaje_iva / 100);
            $total = $request->subtotal + $iva;
            $saldo = $total - $request->pagado;
        }
        else if($request->con_iva == 0)
        {
            $total = $request->subtotal;
            $iva = 0;
            $saldo = $total - $request->pagado;
        }

        $factura->id_cliente = $request->id_cliente;
        $factura->id_razon_social = $request->id_razon_social;
        $factura->id_admin = $request->id_admin;
        $factura->fecha = $request->fecha;
        $factura->comentarios = $request->comentarios;
        $factura->subtotal = $request->subtotal;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->iva = $iva;
        $factura->con_iva = $request->con_iva;
        $factura->total = $total;
        $factura->pagado = $request->pagado;
        $factura->saldo = $saldo;
        //$factura->estatus = 'Pendiente';

        $factura->update();

        return response()->json($factura);
    }

    public function servicios_pendientes($id_cliente)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
            ->where('s.id_cliente', '=', $id_cliente)
            ->where('s.facturado_terminado', '=', '0')
            ->get();

        $monto_pendiente = DB::table('servicios as s')
            ->select(DB::raw('sum(s.costo) as suma_total'))
            ->where('s.facturado_terminado', '=', '0')
            ->where('s.estatus_cobranza', '=', 'Pendiente')
            ->where('s.id_cliente', '=', $id_cliente)
            ->sum('s.costo');

        return view('admin.procesos.facturas.servicios-pendientes', compact('servicios', 'monto_pendiente'));
    }

    public function servicios_facturados($id_factura)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('facturas_detalles as det')
            ->join('servicios as s', 's.id', '=', 'det.id_servicio')
            ->leftjoin('control as c', 'c.id', '=', 's.id_control')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->leftjoin('users as u', 'u.id', '=', 's.id_admin')
            ->select('det.id', 'det.id_servicio', 'cat.clave', 'cat.servicio', 's.tramite', 's.id_clase', 'cla.clave as clase', 'c.nombre as marca', 'det.created_at', 'det.monto', 'u.iniciales', 'u.nombre', 'u.apellido')
            ->where('det.id_factura', '=', $id_factura)
            ->orderBy('det.created_at', 'desc')
            ->get();

        return view('admin.procesos.facturas.servicios-facturados', compact('servicios'));  
    }

    public function servicios_facturados_detalle($id_factura)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('facturas_detalles as det')
            ->join('servicios as s', 's.id', '=', 'det.id_servicio')
            ->leftjoin('control as c', 'c.id', '=', 's.id_control')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->leftjoin('users as u', 'u.id', '=', 's.id_admin')
            ->select('det.id', 'det.id_servicio', 'cat.clave', 'cat.servicio', 's.tramite', 's.id_clase', 'cla.clave as clase', 'c.nombre as marca', 'det.created_at', 'det.monto', 'u.iniciales', 'u.nombre', 'u.apellido')
            ->where('det.id_factura', '=', $id_factura)
            ->orderBy('det.created_at', 'desc')
            ->get();

        return view('admin.procesos.facturas.detalles', compact('servicios'));  
    }

    public function create()
    {
        Carbon::setLocale('es');
        $clientes = Clientes::orderBy('nombre_comercial', 'asc')
            ->where('estatus','=','1')
            ->get(['id', 'nombre_comercial']);
        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();

        return view('admin.facturacion.facturas.create',["clientes"=>$clientes, "porcentaje_iva"=>$porcentaje_iva]);
    }

    public function getRazones($id)
    {
        $razones_sociales = RazonSocial::where('id_cliente', '=', $id)->where('estatus', '=', '1')->get();
            return Response::json($razones_sociales);
    }

    public function getServicios($id)
    {
        $servicios = DB::table('servicios as s')
            ->leftjoin('catalogo_servicios as c', 's.id_catalogo_servicio', '=', 'c.id')
            ->select('s.id', 'c.clave', 'c.servicio', 's.tramite', 's.costo', 's.facturado', 's.estatus_cobranza', 's.clase')
            ->where('estatus_cobranza', '=', 'Pendiente')
            ->where('id_cliente', '=', $id)
            ->orderBy('c.clave', 'asc')
            //->groupBy('s.id', 'c.clave', 'c.servicio', 's.tramite', 's.costo', 's.facturado', 's.estatus_cobranza', 's.clase')
            ->get();
        return Response::json($servicios);
    }

    public function actualizar_iva(Request $request, $id)
    {
        $factura = Facturas::findOrFail($id);

        $factura->subtotal = $request->subtotal;
        $factura->iva = $request->iva;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        //$factura->pagado = 0;
        $factura->total = $request->total;
        $factura->saldo = $request->total - $request->pagado;

        $factura->save();

        $mensaje = array(
                'message' => 'Se actualizaron los datos de la factura.', 
                'alert-type' => 'success'
            );

        return response()->json($factura);
    }

    public function edit($id)
    {
        Carbon::setLocale('es');
        $factura = DB::table('facturas as f')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'f.id_razon_social')
            ->leftjoin('clientes as cli', 'f.id_cliente', '=', 'cli.id')
            ->leftjoin('facturas_detalles as det', 'det.id_factura', '=', 'f.id')
            ->select('f.id', 'f.tipo', 'f.folio_factura', 'folio_recibo', 'f.folio_fiscal', 'f.razon_social', 'f.fecha', 'f.created_at', 'f.updated_at', 'f.fecha_compromiso', 'f.fecha_pagada', 'f.subtotal', 'f.porcentaje_iva', 'f.iva', 'f.total', 'f.pagado', 'f.pagado_terminado', 'f.saldo', 'f.estatus', 'f.comentarios', 'f.id_cliente', 'f.id_razon_social', 'f.id_admin', 'f.con_iva', 'cli.nombre_comercial', 'raz.rfc', 'raz.razon_social', DB::raw('count(det.id_factura) as detalles'))
            ->where('f.id', '=', $id)
            ->groupBy('f.id', 'f.tipo', 'f.folio_factura', 'folio_recibo', 'f.folio_fiscal', 'f.razon_social', 'f.fecha', 'f.created_at', 'f.updated_at', 'f.fecha_compromiso', 'f.fecha_pagada', 'f.subtotal', 'f.porcentaje_iva', 'f.iva', 'f.total', 'f.pagado', 'f.pagado_terminado', 'f.saldo', 'f.estatus', 'f.comentarios', 'f.id_cliente', 'f.id_razon_social', 'f.id_admin', 'f.con_iva', 'cli.nombre_comercial', 'raz.rfc', 'raz.razon_social')
            ->first();

        return response()->json($factura);
    }

    public function insertarRazonSocial(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'id_admin'=>'required',
                'razon_social'=>'required|max:200|unique:razones_sociales',
                'rfc'=>'required|max:15|unique:razones_sociales'
            ]);

        $razon = new RazonSocial;
        $razon->razon_social = $request->razon_social;
        $razon->rfc = $request->rfc;
        $razon->id_admin = $request->id_admin;
        $razon->id_cliente = $request->id_cliente;
        $razon->save();

        return response()->json($razon);
    }

    public function insertar_detalle(Request $request, $id)
    {
        if($request->con_iva == 1)
        {
            $fact = $request->monto + $request->facturado;
            $subtotal = $request->subtotal + $request->monto;
            $iva = $subtotal * ($request->porcentaje_iva / 100);
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }
        else if($request->con_iva == 0)
        {
            $fact = $request->monto + $request->facturado;
            $subtotal = $request->subtotal + $request->monto;
            $iva = 0;
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }

        $factura = Facturas::findOrFail($id);
        $factura->subtotal = $subtotal;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->iva = $iva;
        $factura->con_iva = $request->con_iva;
        $factura->total = $total;
        $factura->saldo = $saldo;
        $factura->estatus = 'Pendiente';
        $factura->update();

        $detalle = new FacturasDetalles;
        $detalle->monto = $request->monto;
        $detalle->id_servicio = $request->id_servicio;
        $detalle->id_factura = $id;
        $detalle->save();

        if($fact == $request->costo)
        {
            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'facturado' => $fact,
                        'facturado_terminado' => '1'
                    ]);
        }
        else
        {
            $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'facturado' => $fact
                    ]);
        }

        return response()->json($detalle);
    }

    public function eliminar_detalle(Request $request, $id, $id_det)
    {
        if($request->con_iva == 1)
        {
            $monto = $request->facturado_id_det;
            $subtotal = $request->subtotal - $monto;
            $iva = $subtotal * ($request->porcentaje_iva / 100);
            $total = $subtotal + $iva;
        }
        else if($request->con_iva == 0)
        {
            $monto = $request->facturado_id_det;
            $subtotal = $request->subtotal - $monto;
            $iva = 0;
            $total = $subtotal + $iva;
        }

        if($total <= $request->pagado)
        {
            if($total == 0)
            {
                $saldo = $total - $request->pagado;
                $estatus = 'Pendiente';
                $pagado_terminado = 0;
            }
            else
            {
                $saldo = 0;
                $estatus = 'Pagado';
                $pagado_terminado = 1;
            }
            
        }
        else
        {
            $saldo = $total - $request->pagado;
            $estatus = 'Pendiente';
            $pagado_terminado = 0;
        }

        $factura = Facturas::findOrFail($id);
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->con_iva = $request->con_iva;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->total = $total;
        $factura->saldo = $saldo;
        $factura->pagado_terminado = $pagado_terminado;
        $factura->estatus = $estatus;
        $factura->update();

        $detalle = DB::table('facturas_detalles')
            ->where('id', '=', $id_det)
            ->delete();

        return response()->json($factura);
    }

    public function getDetalles(Request $request)
    {
        $detalles = DB::table('facturas_detalles as det')
            ->join('facturas as f', 'det.id_factura', '=', 'f.id')
            ->join('servicios as s', 'det.id_servicio', '=', 's.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->select('det.id', 'det.id_factura', 'det.id_servicio', 'cat.clave', 'cat.servicio', 's.tramite', 's.clase', 'det.created_at', 'det.monto')
            ->where('det.id_factura', $request->get('id'))
            ->orderBy('det.created_at', 'asc')
            //->groupBy('s.id', 'c.clave', 'c.servicio', 's.tramite', 's.costo', 's.facturado', 's.estatus_cobranza', 's.clase')
            ->get();
        return json_encode($detalles);

        /*$detalles = FacturasDetalles::where('id_factura', '=', $id)->get();
            return Response::json($detalles);*/
    }

    public function destroy(Request $request, $id)
    {

        if($request->estatus == 'Cancelado')
        {
            $factura = Facturas::findOrFail($id);
            $factura->estatus=$request->estatus;
            $factura->subtotal=0;
            $factura->iva=0;
            $factura->total=0;
            $factura->saldo=0;
            $factura->id_admin=$request->id_admin;
            $factura->update();

            $detalle = DB::table('facturas_detalles')
                ->where('id_factura', '=', $id)
                ->delete();
            
            
        }
        else if($request->estatus == 'Pendiente')
        {
            $factura = Facturas::findOrFail($id);
            $factura->estatus=$request->estatus;
            $factura->id_admin=$request->id_admin;
            $factura->update();
        }

        return response()->json($factura);
    }

    public function servicios($id_cliente, $id_factura, $estatus)
    {
        if($estatus == 'Pendiente')
        {
            $servicios = DB::table('servicios as s')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('clientes as c', 'c.id', '=', 's.id_cliente')
                ->leftjoin('control as co', 'co.id', '=', 's.id_control')
                ->leftjoin('users as a', 'a.id', '=', 's.id_admin')
                ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
                ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                //->leftjoin('facturas as fac', 'fac.id', '=', 'det.id_factura')
                ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado', 's.facturado_terminado', 'det.id as id_det', 'det.monto')
                ->where('det.id_factura', '=', $id_factura)
                ->orWhere(function($q) use ($id_cliente)
                {
                    $q->where('c.id', '=', $id_cliente)
                    ->where('s.facturado_terminado', '=', '0');
                })
                ->orderBy('s.created_at', 'asc')
                ->get();

            $monto_pendiente = DB::table('servicios as s')
                ->select(DB::raw('sum(s.costo - s.facturado) as suma_total'))
                ->where('s.facturado_terminado', '=', '0')
                ->where('s.id_cliente', '=', $id_cliente)
                ->first();
        }
        else if($estatus == 'Pagado')
        {
            $servicios = DB::table('servicios as s')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as co', 'co.id', '=', 's.id_control')
                ->leftjoin('users as a', 'a.id', '=', 's.id_admin')
                ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
                ->join('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                //->leftjoin('facturas as fac', 'fac.id', '=', 'det.id_factura')
                ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado', 's.facturado_terminado', 'det.id as id_det', 'det.monto')
                ->where('det.id_factura', '=', $id_factura)
                ->orderBy('s.created_at', 'asc')
                ->get();

            $monto_pendiente = '';
        }



        return view('admin.procesos.facturas.servicios-pendientes', compact('servicios', 'monto_pendiente'));
    }

    public function servicios_recibo($id_cliente, $id_factura, $estatus)
    {
        if($estatus == 'Pendiente')
        {
            $servicios = DB::table('servicios as s')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('clientes as c', 'c.id', '=', 's.id_cliente')
                ->leftjoin('control as co', 'co.id', '=', 's.id_control')
                ->leftjoin('users as a', 'a.id', '=', 's.id_admin')
                ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
                ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                //->leftjoin('facturas as fac', 'fac.id', '=', 'det.id_factura')
                ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado', 's.facturado_terminado', 'det.id as id_det', 'det.monto')
                ->where('det.id_factura', '=', $id_factura)
                ->orWhere(function($q) use ($id_cliente)
                {
                    $q->where('c.id', '=', $id_cliente)
                    ->where('s.facturado_terminado', '=', '0');
                })
                ->orderBy('s.created_at', 'asc')
                ->get();

            $monto_pendiente = DB::table('servicios as s')
                ->select(DB::raw('sum(s.costo - s.facturado) as suma_total'))
                ->where('s.facturado_terminado', '=', '0')
                ->where('s.id_cliente', '=', $id_cliente)
                ->first();
        }
        else if($estatus == 'Pagado')
        {
            $servicios = DB::table('servicios as s')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as co', 'co.id', '=', 's.id_control')
                ->leftjoin('users as a', 'a.id', '=', 's.id_admin')
                ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
                ->join('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                //->leftjoin('facturas as fac', 'fac.id', '=', 'det.id_factura')
                ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado', 's.facturado_terminado', 'det.id as id_det', 'det.monto')
                ->where('det.id_factura', '=', $id_factura)
                ->orderBy('s.created_at', 'asc')
                ->get();

            $monto_pendiente = '';
        }

        return view('admin.procesos.recibos.servicios-pendientes', compact('servicios', 'monto_pendiente'));
    }

    public function serviciosPendientes($id_cliente)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('servicios as s')
            ->join('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->join('control as co', 'co.id', '=', 's.id_control')
            ->join('users as a', 'a.id', '=', 's.id_admin')
            ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 's.clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado')
            ->where('s.facturado_terminado', '=', '0')
            ->where('s.id_cliente', '=', $id_cliente)
            ->orderBy('s.created_at', 'asc')
            ->get();

        $monto_pendiente = DB::table('servicios as s')
            ->select(DB::raw('sum(s.costo) as suma_total'))
            ->where('s.facturado_terminado', '=', '0')
            ->where('s.id_cliente', '=', $id_cliente)
            ->sum('s.costo');

        return view('admin.facturacion.facturas.servicios-pendientes', compact('servicios', 'monto_pendiente'));
    }   

    public function serviciosFacturados($id_factura)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('facturas_detalles as det')
            ->join('servicios as s', 's.id', '=', 'det.id_servicio')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as co', 'co.id', '=', 's.id_control')
            ->leftjoin('users as a', 'a.id', '=', 's.id_admin')
            ->join('facturas as f', 'f.id', '=', 'det.id_factura')
            ->select('det.*', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 's.clase', 's.descuento', 's.costo', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('det.id_factura', '=', $id_factura)
            ->orderBy('det.created_at', 'asc')
            ->get();

        return view('admin.facturacion.facturas.servicios-pagados', compact('servicios'));
    }

    public function agregarFacturaRecibo(Request $request, $id)
    {
        $this->validate($request,
            [
                'monto'=>'required|min:1',
                'id_servicio'=>'required',
                'id_factura'=>'required',
            ]);

        $subtotal = $request->subtotal + $request->monto;
        $iva = $request->iva + ($subtotal * ($request->porcentaje_iva / 100));
        $total = $request->total + $subtotal + $iva;
        $saldo = $total + $request->saldo;

        $mytime = Carbon::now('America/Chihuahua');
        $fecha = $mytime->toDateString();

        //$facturado = $request->costo - ($request->monto + $request->facturado);

        if($request->restante == 0)
        {
            $facturado_terminado = 0;
        }
        else if($request->restante > 0)
        {
            $facturado_terminado = 1;
        }

        $factura = Facturas::findOrFail($id);
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->total = $total;
        $factura->saldo = $saldo;
        $factura->estatus = 'Pendiente';
        $factura->pagado_terminado = 0;

        $factura_detalles = DB::table('facturas_detalles')
            ->insert(
                [
                    'monto' => $request->monto,
                    'id_servicio' => $request->id_servicio,
                    'id_factura' => $request->id_factura,
                    'created_at' => $fecha,
                    'updated_at' => $fecha
                ]);

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'facturado' => $request->facturado,
                    'facturado_terminado' => $request->facturado_terminado
                ]);

        return response()->json($factura);
    }
}
