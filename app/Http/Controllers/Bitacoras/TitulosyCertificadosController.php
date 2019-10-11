<?php

namespace Emporio\Http\Controllers\Bitacoras;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\Control;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\Estatus;
use Emporio\Model\Clases;
use Emporio\User;
use Emporio\Model\Monedas;
use Emporio\Model\Facturas;
use Emporio\Model\FacturasDetalles;
use Emporio\Model\RazonSocial;
use Emporio\Model\Nomina;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Estrategias;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\CobranzaDetalles;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use DB;
use Image;

class TitulosyCertificadosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-1);
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();


        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
        $estrategias = Estrategias::orderBy('id','asc')->where('estatus','=','1')->get();
        $monedas = Monedas::orderBy('id', 'asc')->get();
        $admins = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->where('responsabilidad','=','1')->get();
        $clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        //$catalogo_servicios = CatalogoServicios::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();
        $bitacoras_estatus = CategoriaEstatus::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        $tipo_vista = 'Bitacora';
        $variable_estatus = 'pendiente';
        $url_listar = '/admin/bitacora/titulos-listar/';
        $url_buscar = '/admin/bitacora/titulos-buscar/';
        $url_actualizar = '/admin/bitacora/titulos/actualizar-servicio/';

        return view('admin.bitacoras.titulos-certificados.index', compact('monedas', 'admins', 'porcentaje_iva', 'cuentas', 'formas_pago', 'variable_estatus', 'clases', 'bitacoras', 'estrategias', 'url_listar', 'url_buscar', 'fecha_inicio', 'fecha_fin', 'tipo_vista', 'bitacoras_estatus', 'url_actualizar', 'today'));
    }

    public function listar($estatus, $fecha_inicio, $fecha_fin)
    {
        if($estatus == 'todos')
        {
            Carbon::setLocale('es');

            $mytime = Carbon::now('America/Chihuahua');
            $today = $mytime->toDateString();

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('razones_sociales as raz', 's.id_razon_social', '=', 'raz.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->select('s.id', 's.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios', 'est.id as bit_est')
                //->where('s.estatus_cobranza', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio) 
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.mostrar_bitacora', '=', '1')
                ->where('s.id_bitacoras', '=', '4')
                ->orderBy('s.created_at', 'desc')
                ->paginate(30);

            return view('admin.bitacoras.titulos-certificados.listado', compact('servicios', 'today'));    
        }
        else
        {
            Carbon::setLocale('es');

            $mytime = Carbon::now('America/Chihuahua');
            $today = $mytime->toDateString();

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->leftjoin('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios', 'est.id as bit_est')
                ->where('s.estatus_tramite', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.id_bitacoras', '=', '4')
                ->where('s.mostrar_bitacora', '=', '1')
                ->orderBy('s.created_at', 'desc')
                ->paginate(30);

            return view('admin.bitacoras.titulos-certificados.listado', compact('servicios', 'today'));
        }
    }

    public function buscar($estatus, $buscar, $fecha_inicio, $fecha_fin)
    {
        if($estatus == 'todos')
        {
            Carbon::setLocale('es');

            $mytime = Carbon::now('America/Chihuahua');
            $today = $mytime->toDateString();

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios', 'est.id as bit_est')
                //->where('s.estatus_tramite', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.id_bitacoras', '=', '4')
                ->where('s.mostrar_bitacora', '=', '1')
                ->where(function($q) use ($buscar)
                {
                    $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                    ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
                    ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                    ->orWhere('s.clase','LIKE','%'.$buscar.'%')
                    ->orWhere('s.costo','LIKE',$buscar)
                    ->orWhere('s.id','LIKE',$buscar)
                    ->orWhere('f.folio_factura','LIKE',$buscar)
                    ->orWhere('f.folio_recibo','LIKE',$buscar)
                    ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
                })
                //->orWhere('s.estatus_tramite', '=', 'Pendiente')
                ->orderBy('s.created_at', 'desc')
                ->paginate(30);

            $facturas = DB::table('facturas as f')
                ->join('facturas_detalles as det', 'det.id_factura', '=', 'f.id')
                ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo')
                ->where('f.estatus', '!=', 'Cancelado')
                ->orderBy('f.created_at', 'asc')
                ->get();

            return view('admin.bitacoras.titulos-certificados.listado', compact('servicios', 'today'));
            
        }

        else
        {
            Carbon::setLocale('es');

            $mytime = Carbon::now('America/Chihuahua');
            $today = $mytime->toDateString();

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios', 'est.id as bit_est')
                ->where('s.estatus_tramite', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.id_bitacoras', '=', '4')
                ->where('s.mostrar_bitacora', '=', '1')
                ->where(function($q) use ($buscar)
                {
                    $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                    ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
                    ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                    ->orWhere('s.clase','LIKE','%'.$buscar.'%')
                    ->orWhere('s.costo','LIKE',$buscar)
                    ->orWhere('s.id','LIKE',$buscar)
                    ->orWhere('f.folio_factura','LIKE',$buscar)
                    ->orWhere('f.folio_recibo','LIKE',$buscar)
                    ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
                })
                //->orWhere('s.estatus_tramite', '=', 'Pendiente')
                ->orderBy('s.created_at', 'desc')
                ->paginate(30);

            $facturas = DB::table('facturas as f')
                ->join('facturas_detalles as det', 'det.id_factura', '=', 'f.id')
                ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo')
                ->where('f.estatus', '!=', 'Cancelado')
                ->orderBy('f.created_at', 'asc')
                ->get();

            return view('admin.bitacoras.titulos-certificados.listado', compact('servicios', 'facturas', 'today'));
        }
    }

    public function actualizarServicio($id_servicio)
    {
        Carbon::setLocale('es');

        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
            ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
            ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
            ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios', 'est.id as bit_est')
            ->where('s.id', '=', $id_servicio)
            ->first();

        return view('admin.bitacoras.titulos-certificados.listado-servicios', compact('servicio', 'today'));
    }

    public function Alta_Estatus(Request $request, $id)
    {

        $servicio = Servicios::findOrFail($id);

        if($request->alta_estatus != '')
        {
            $this->validate($request,
                [
                    'alta_estatus_fecha' => 'required'
                ]);

            $servicio->alta_estatus_boolean=1;
            $servicio->alta_estatus=$request->alta_estatus;
            $servicio->alta_estatus_fecha=$request->alta_estatus_fecha;
        }
        else
        {
            $servicio->alta_estatus_boolean=0;
            $servicio->alta_estatus=$request->alta_estatus;
            $servicio->alta_estatus_fecha=null;
        }

        if($request->escaneo != '')
        {
            $this->validate($request,
                [
                    'escaneo_fecha' => 'required'
                ]);

            $servicio->escaneo_boolean=1;
            $servicio->escaneo=$request->escaneo;
            $servicio->escaneo_fecha=$request->escaneo_fecha;
        }
        else
        {
            $servicio->escaneo_boolean=0;
            $servicio->escaneo=$request->escaneo;
            $servicio->escaneo_fecha=null;
        }
        
        $servicio->update();

        return response()->json($servicio);
    }

    public function EntregaTitulo(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

        if($request->elaboracion_notificacion_agradecimiento != '')
        {
            $this->validate($request,
                [
                    'elaboracion_notificacion_agradecimiento_fecha' => 'required'
                ]);

            $servicio->elaboracion_notificacion_agradecimiento_boolean=1;
            $servicio->elaboracion_notificacion_agradecimiento=$request->elaboracion_notificacion_agradecimiento;
            $servicio->elaboracion_notificacion_agradecimiento_fecha=$request->elaboracion_notificacion_agradecimiento_fecha;
        }
        else
        {
            $servicio->elaboracion_notificacion_agradecimiento_boolean=0;
            $servicio->elaboracion_notificacion_agradecimiento=$request->elaboracion_notificacion_agradecimiento;
            $servicio->elaboracion_notificacion_agradecimiento_fecha=null;
        }

        if($request->envio_notificacion != '')
        {
            $this->validate($request,
                [
                    'envio_notificacion_fecha' => 'required'
                ]);

            $servicio->envio_notificacion_boolean=1;
            $servicio->envio_notificacion=$request->envio_notificacion;
            $servicio->envio_notificacion_fecha=$request->envio_notificacion_fecha;
        }
        else
        {
            $servicio->envio_notificacion_boolean=0;
            $servicio->envio_notificacion=$request->envio_notificacion;
            $servicio->envio_notificacion_fecha=null;
        }

        if($request->entrega_titulo_agradecimiento != '')
        {
            $this->validate($request,
                [
                    'entrega_titulo_agradecimiento_fecha' => 'required'
                ]);

            $servicio->entrega_titulo_agradecimiento_boolean=1;
            $servicio->entrega_titulo_agradecimiento=$request->entrega_titulo_agradecimiento;
            $servicio->entrega_titulo_agradecimiento_fecha=$request->entrega_titulo_agradecimiento_fecha;
        }
        else
        {
            $servicio->entrega_titulo_agradecimiento_boolean=0;
            $servicio->entrega_titulo_agradecimiento=$request->entrega_titulo_agradecimiento;
            $servicio->entrega_titulo_agradecimiento_fecha=null;
        }

        $servicio->estatus_tramite = $request->estatus_tramite;

        if($request->estatus_tramite == 'Terminado')
        {
            $servicio->listo_comision_operativa = '1';
            $servicio->listo_comision_venta = '1';
            $servicio->listo_comision_gestion = '1';
            $servicio->fecha_comision_operativa = $request->entrega_titulo_agradecimiento_fecha;
            $servicio->fecha_comision_venta = $request->entrega_titulo_agradecimiento_fecha;
            $servicio->fecha_comision_gestion = $request->entrega_titulo_agradecimiento_fecha;
            $servicio->presentacion_fecha = $request->entrega_titulo_agradecimiento_fecha;

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Pendiente')
                ->update(['listo_comision' => '1',
                            'estatus' => 'Liberada',
                            'fecha_aplicada' => $request->entrega_titulo_agradecimiento_fecha
                        ]);
        }
        else if($request->estatus_tramite == 'Cancelado' || $request->estatus_tramite == 'No Registro')
        {
            $servicio->listo_comision_operativa = 0;
            $servicio->listo_comision_venta = 0;
            $servicio->listo_comision_gestion = 0;
            $servicio->fecha_comision_operativa = null;
            $servicio->fecha_comision_venta = null;
            $servicio->fecha_comision_gestion = null;
            $servicio->presentacion_fecha = null;

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Pendiente')
                ->update(['listo_comision' => '0',
                            'estatus' => 'Cancelada',
                            'fecha_aplicada' => null
                        ]);
        }
        
        $servicio->update();

        return response()->json($servicio);
    }
}
