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

class FacturasDetallesController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');

            $query=trim($request->get('searchText'));
            $clientes = Clientes::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
            $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();

            $detalles = DB::table('facturas_detalles as det')
            	->join('facturas as fac', 'fac.id', '=', 'id_factura')
            	->join('servicios as ser', 'ser.id', '=', 'id_servicio')
            	->leftjoin('clientes as cl', 'cl.id', '=', 'fac.id_cliente')
	            	->leftjoin('control as mar', 'mar.id', '=', 'ser.id_control')
            	->leftjoin('razones_sociales as raz', 'raz.id_cliente', '=', 'cl.id')
            	->leftjoin('users as ad', 'ad.id', '=', 'fac.id_admin')
            	->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 'ser.id_catalogo_servicio')
            	->select('det.id', 'det.id_factura', 'det.id_servicio', 'det.created_at', 'det.updated_at', 'det.monto', 'det.pagado as pagado_det', 'fac.folio_factura', 'fac.folio_recibo', 'fac.estatus', 'cl.nombre_comercial', 'raz.razon_social', 'raz.rfc', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ser.tramite', 'ser.clase', 'cat.clave', 'cat.servicio', 'mar.nombre as marca', 'fac.pagado', 'ser.facturado', 'fac.subtotal', 'fac.porcentaje_iva', 'ser.costo')
            	->where('fac.folio_factura','LIKE','%'.$query.'%')
            	->orWhere('fac.folio_recibo','LIKE','%'.$query.'%')
            	->orWhere('cl.nombre_comercial','LIKE','%'.$query.'%')
            	->orWhere('raz.razon_social','LIKE','%'.$query.'%')
            	->orWhere('raz.rfc','LIKE','%'.$query.'%')
            	->orWhere('ser.tramite','LIKE','%'.$query.'%')
            	->orWhere('ser.clase','LIKE','%'.$query.'%')
            	->orWhere('cat.clave','LIKE','%'.$query.'%')
            	->orWhere('cat.servicio','LIKE','%'.$query.'%')
            	->orWhere('ad.nombre','LIKE','%'.$query.'%')
            	->orWhere('ad.apellido','LIKE','%'.$query.'%')
            	->orWhere('ad.iniciales','LIKE','%'.$query.'%')
            	->orWhere('det.monto','LIKE','%'.$query.'%')
            	->orWhere('mar.nombre','LIKE','%'.$query.'%')
            	->orderBy('det.created_at', 'desc')
            	->paginate(30);
            	

            return view('admin.facturacion.detalles.index',["searchText"=>$query, "clientes"=>$clientes, "porcentaje_iva"=>$porcentaje_iva, "detalles"=>$detalles]);
        }
    }
}
