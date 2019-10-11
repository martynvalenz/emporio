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
use Emporio\Model\Nomina;
use Emporio\Model\Facturas;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\PorcentajeIVA;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use DB;

class CobranzaServiciosController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            Carbon::setLocale('es');
            $query=trim($request->get('searchText'));

            $clientes = Clientes::orderBy('nombre_comercial', 'asc')->get();
            $monedas = Monedas::orderBy('id', 'asc')->get();
            $admins = Admin::orderBy('id', 'asc')->get();
            $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
            $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
            $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
            /*$servicios = Servicios::orderBy('created_at', 'desc')
                ->where('tramite','LIKE','%'.$query.'%')
                ->paginate(25);*/

            //$admins = Admin::orderBy('nombre', 'asc')->where('estatus','=', '1')->get();

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->leftjoin('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.id','s.tramite', 's.clase', 's.moneda', 's.costo', 's.responsable_venta', 's.responsable_operativo', 'responsable_gestion', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', 'c.id as id_cliente', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 'f.id as id_fact', 'f.folio_factura', 'f.folio_recibo', 'det.monto', 's.presentacion_fecha')
                
                ->where('s.alta_control_archivar_boolean', '=', '1')
                //->where('s.estatus_cobranza', '=', 'Pendiente')
                ->where(function($q) use ($query)
                {
                    $q->orWhere('cat.servicio','LIKE','%'.$query.'%')
                    ->where('cat.clave','LIKE','%'.$query.'%')
                    ->orWhere('con.nombre','LIKE','%'.$query.'%')
                    ->orWhere('c.nombre_comercial','LIKE','%'.$query.'%')
                    ->orWhere('s.costo','LIKE','%'.$query.'%')
                    ->orWhere('bit.clave','LIKE','%'.$query.'%')
                    ->orWhere('bit.bitacora','LIKE','%'.$query.'%')
                    ->orWhere('ad.nombre','LIKE','%'.$query.'%')
                    ->orWhere('ad.iniciales','LIKE','%'.$query.'%')
                    ->orWhere('f.folio_factura','LIKE','%'.$query.'%')
                    ->orWhere('f.folio_recibo','LIKE','%'.$query.'%')
                    ->orWhere('ad.email','LIKE','%'.$query.'%');
                })
                ->orderBy('s.created_at', 'desc')
                //->groupBy('s.id','s.tramite', 's.clase', 's.moneda', 's.costo', 's.responsable_venta', 's.responsable_operativo', 'responsable_gestion', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', 'con.nombre', 'c.nombre_comercial', 'bit.clave', 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo','s.concepto_costo','s.tipo_cambio','s.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion')
                ->paginate(25);
                //->get();
            return view('admin.ingresos.servicios.index',["servicios"=>$servicios, "searchText"=>$query, "clientes"=>$clientes, "monedas" => $monedas, "admins" => $admins, "porcentaje_iva"=>$porcentaje_iva, "cuentas"=>$cuentas, "formas_pago"=>$formas_pago]);
        }
    }
}
