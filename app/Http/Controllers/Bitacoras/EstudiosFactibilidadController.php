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

class EstudiosFactibilidadController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-1);
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();

        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
        $estrategias = Estrategias::orderBy('id','asc')->where('estatus','=','1')->get();
        $monedas = Monedas::orderBy('id', 'asc')->get();
        $admins = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->where('responsabilidad','=','1')->get();
        $clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();
        $bitacoras_estatus = CategoriaEstatus::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        $tipo_vista = 'Bitacora';
        $variable_estatus = 'pendiente';
        $url_listar = '/admin/bitacora/estudios-factibilidad-listar/';
        $url_buscar = '/admin/bitacora/estudios-factibilidad-buscar/';
        $url_actualizar = '/admin/bitacora/estudios-factibilidad/servicio-actualizar/';

        return view('admin.bitacoras.estudios-factibilidad.index',["monedas" => $monedas, "admins" => $admins, "porcentaje_iva"=>$porcentaje_iva, "cuentas"=>$cuentas, "formas_pago"=>$formas_pago, "variable_estatus"=>$variable_estatus, "clases"=>$clases, "bitacoras"=>$bitacoras, "estrategias"=>$estrategias, "url_listar" => $url_listar, "url_buscar"=>$url_buscar, "fecha_inicio" => $fecha_inicio, "fecha_fin"=>$fecha_fin, "tipo_vista"=>$tipo_vista, "bitacoras_estatus"=>$bitacoras_estatus, "url_actualizar"=>$url_actualizar]);
    }

    public function listar($estatus, $fecha_inicio, $fecha_fin)
    {
        if($estatus == 'todos')
        {
            Carbon::setLocale('es');

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('razones_sociales as raz', 's.id_razon_social', '=', 'raz.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->select('s.id', 's.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios', 's.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios')
                //->where('s.estatus_cobranza', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.mostrar_bitacora', '=', '1')
                ->where('s.id_bitacoras', '=', '2')
                ->orderBy('s.created_at', 'desc')
                ->paginate(30);

            return view('admin.bitacoras.estudios-factibilidad.listado', compact('servicios'));    
        }
        else
        {
            Carbon::setLocale('es');

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->leftjoin('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios', 's.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios')
                ->where('s.estatus_tramite', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.id_bitacoras', '=', '2')
                ->where('s.mostrar_bitacora', '=', '1')
                ->orderBy('s.created_at', 'desc')
                ->paginate(30);

            return view('admin.bitacoras.estudios-factibilidad.listado', compact('servicios'));
        }
    }

    public function buscar($estatus, $buscar, $fecha_inicio, $fecha_fin)
    {
        if($estatus == 'todos')
        {
            Carbon::setLocale('es');

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
                ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios', 's.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios')
                //->where('s.estatus_tramite', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.id_bitacoras', '=', '2')
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

            return view('admin.bitacoras.estudios-factibilidad.listado', compact('servicios'));
            
        }

        else
        {
            Carbon::setLocale('es');

            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
                ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
                ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios', 's.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios')
                ->where('s.estatus_tramite', '=', $estatus)
                ->where('s.created_at', '>=', $fecha_inicio)
                ->where('s.created_at', '<=', $fecha_fin)
                ->where('s.id_bitacoras', '=', '2')
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

            return view('admin.bitacoras.estudios-factibilidad.listado', compact('servicios', 'facturas'));
        }
    }

    public function actualizarServicio($id_servicio)
    {
        Carbon::setLocale('es');

        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
            ->leftjoin('facturas_detalles as det', 's.id', '=', 'det.id_servicio')
            ->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
            ->select('s.id','s.id_control','s.tramite', 's.clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha', 's.explicacion_comentarios_comentarios', 's.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.respuesta_cliente_comentarios')
            ->where('s.id', '=', $id_servicio)
            ->first();

        return view('admin.bitacoras.estudios-factibilidad.listado-servicio', compact('servicio'));
    }

    public function recepcion(Request $request, $id)
    {

        $servicio = Servicios::findOrFail($id);

        if($request->recepcion_alta != '')
        {
            $this->validate($request,
                [
                    'recepcion_alta_fecha' => 'required'
                ]);

            $servicio->recepcion_alta_boolean=1;
            $servicio->recepcion_alta=$request->recepcion_alta;
            $servicio->recepcion_alta_fecha=$request->recepcion_alta_fecha;
        }
        else
        {
            $servicio->recepcion_alta_boolean=0;
            $servicio->recepcion_alta=$request->recepcion_alta;
            $servicio->recepcion_alta_fecha=null;
        }

        if($request->elaboracion_expediente != '')
        {
            $this->validate($request,
                [
                    'elaboracion_expediente_fecha' => 'required'
                ]);

            $servicio->elaboracion_expediente_boolean=1;
            $servicio->elaboracion_expediente=$request->elaboracion_expediente;
            $servicio->elaboracion_expediente_fecha=$request->elaboracion_expediente_fecha;
        }
        else
        {
            $servicio->elaboracion_expediente_boolean=0;
            $servicio->elaboracion_expediente=$request->elaboracion_expediente;
            $servicio->elaboracion_expediente_fecha=null;
        }

        if($request->revision != '')
        {
            $this->validate($request,
                [
                    'revision_fecha' => 'required'
                ]);

            $servicio->revision_boolean=1;
            $servicio->revision=$request->revision;
            $servicio->revision_fecha=$request->revision_fecha;
        }
        else
        {
            $servicio->revision_boolean=0;
            $servicio->revision=$request->revision;
            $servicio->revision_fecha=null;
        }

        if($request->envio_expediente != '')
        {
            $this->validate($request,
                [
                    'envio_expediente_fecha' => 'required'
                ]);

            $servicio->envio_expediente_boolean=1;
            $servicio->envio_expediente=$request->envio_expediente;
            $servicio->envio_expediente_fecha=$request->envio_expediente_fecha;
        }
        else
        {
            $servicio->envio_expediente_boolean=0;
            $servicio->envio_expediente=$request->envio_expediente;
            $servicio->envio_expediente_fecha=null;
        }

        $servicio->update();

        return response()->json($servicio);

        
    }

    public function registro(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

        if($request->registro != '')
        {
            $this->validate($request,
                [
                    'registro_fecha' => 'required'
                ]);


            $servicio->registro_fecha = $request->registro_fecha;
            $servicio->registro = $request->registro;
            $servicio->registro_boolean = 1;

            if($request->registro == 'Realizado')
            {
                if($request->registro_fecha == $request->registro_fecha_val && $request->registro == $request->registro_val)
                {

                }
                else if($request->registro_fecha != $request->registro_fecha_val || $request->registro != $request->registro_val)
                {
                    $servicio->listo_comision_operativa = '1';
                    $servicio->listo_comision_venta = '1';
                    $servicio->listo_comision_gestion = '1';
                    $servicio->fecha_comision_operativa = $request->registro_fecha;
                    $servicio->fecha_comision_venta = $request->registro_fecha;
                    $servicio->fecha_comision_gestion = $request->registro_fecha;


                    $control = DB::table('control')
                    ->where('id', '=', $request->id_control)
                    ->update(
                        [
                            'registrada' => '1',
                            'fecha_registrada' => $request->registro_fecha
                        ]);

                    $comision = DB::table('nomina')
                        ->where('id_servicio', '=', $request->id_servicio)
                        ->where('estatus', '=', 'Pendiente')
                        ->update(['listo_comision' => '1',
                                    'estatus' => 'Liberada',
                                    'fecha_aplicada' => $request->registro_fecha
                                ]);
                }
            }
            else if($request->registro == 'Cancelado')
            {
                $servicio->listo_comision_operativa = '0';
                $servicio->fecha_comision_operativa = null;

                $control = DB::table('control')
                ->where('id', '=', $request->id_control)
                ->update(
                    [
                        'registrada' => '0',
                        'fecha_registrada' => null
                    ]);

                $comision = DB::table('nomina')
                    ->where('id_servicio', '=', $request->id_servicio)
                    ->where('estatus', '=', 'Pendiente')
                    ->update(['listo_comision' => '0',
                                'estatus' => 'Cancelada',
                                'fecha_aplicada' => null
                            ]);
            }
        }
        else
        {
            $servicio->registro_boolean=0;
            $servicio->registro=null;
            $servicio->registro_fecha=null;
        }

        $servicio->estatus_tramite = $request->estatus_tramite;
        $servicio->explicacion_comentarios_comentarios = $request->explicacion_comentarios_comentarios;

        if($request->explicacion_comentarios_comentarios != '' && $request->explicacion_comentarios_comentarios != $request->explicacion_comentarios_comentarios_value)
        {
            $comentario = DB::table('servicios_comentarios')
                ->insert(
                    [
                        'comentario' => 'Explicación: '.$request->explicacion_comentarios_comentarios,
                        'id_servicio' => $request->id_servicio,
                        'id_control' => $request->id_control,
                        'id_admin' => $request->id_admin
                    ]);
        }
        else
        {
            
        }

        //Bitacora Estatus
        if($request->id_bitacoras_estatus == '')
        {

        }
        else if($request->id_bitacoras_estatus == $request->id_bitacoras_estatus_value)
        {

        }
        else if($request->id_bitacoras_estatus != $request->id_bitacoras_estatus_value)
        {
            $servicio->id_bitacoras_estatus=$request->id_bitacoras_estatus;
            $mytime = $mytime = Carbon::now('America/Chihuahua');
            $datetime = $mytime->toDateTimeString();

            $estatus = DB::table('bitacoras_estatus')
                ->insert(
                    [
                        'id_cliente' => $request->id_cliente,
                        'id_control' => $request->id_control,
                        'id_servicio' => $request->id_servicio,
                        'id_admin' => $request->id_admin,
                        'id_bitacoras_estatus' => $request->id_bitacoras_estatus,
                        'fecha_inicio' => $request->alta_estatus_fecha,
                        'estatus' => 'Trámite',
                        'created_at' => $datetime,
                        'updated_at' => $datetime
                    ]);
            
        }

        $servicio->update();

        return response()->json($servicio);
    }
}
