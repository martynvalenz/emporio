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
use Emporio\Model\Admin;
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
use Emporio\Model\ListadoEstatus;
use Emporio\User;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use DB;
use Image;

class TramitesNuevosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-2);
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
        //$catalogo_servicios = CatalogoServicios::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();
        $bitacoras_estatus = CategoriaEstatus::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();
        $listado_estatus = ListadoEstatus::where('id_bitacoras_estatus', '=', '1')->where('activo', '=', '1')->orderBy('estatus', 'asc')->get();

        $tipo_vista = 'Bitacora';
        $variable_estatus = 'pendiente';
        $url_listar = '/admin/bitacora/tramites-nuevos-listar/';
        $url_buscar = '/admin/bitacora/tramites-nuevos-buscar/';
        $url_actualizar = '/admin/bitacora/tramites-nuevos/servicio-actualizar/';

        return view('admin.bitacoras.tramites-nuevos.index', compact('monedas', 'admins', 'porcentaje_iva', 'cuentas', 'formas_pago', 'variable_estatus', 'clases', 'bitacoras_estatus', 'bitacoras', 'estrategias', 'url_listar', 'url_buscar', 'url_actualizar', 'fecha_inicio', 'fecha_fin', 'tipo_vista', 'listado_estatus'));
    }

    public function listar($estatus, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            //->leftjoin('categoria_estatus as est', 's.id_cate', '=', 'est.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 's.id_control','s.tramite', 's.id_clase', 'cla.clave as clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.id_estatus')
            //->where('s.estatus_cobranza', '=', $estatus)
            ->where('s.created_at', '>=', $fecha_inicio)
            ->where('s.created_at', '<=', $fecha_fin)
            ->where('s.mostrar_bitacora', '=', '1')
            ->where('s.id_bitacoras', '=', '1')
            ->orderBy('s.created_at', 'desc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_tramite', '=', $estatus);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.bitacoras.tramites-nuevos.listado', compact('servicios'));
    }

    public function buscar($estatus, $buscar, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            //->leftjoin('categoria_estatus as est', 's.id_cate', '=', 'est.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 's.id_control','s.tramite', 's.id_clase', 'cla.clave as clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.id_estatus')
            //->where('s.estatus_tramite', '=', $estatus)
            ->where('s.created_at', '>=', $fecha_inicio)
            ->where('s.created_at', '<=', $fecha_fin)
            ->where('s.id_bitacoras', '=', '1')
            //->where('s.mostrar_bitacora', '=', '1')
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
            ->orderBy('s.created_at', 'desc');
            
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $servicios->where('s.estatus_tramite', '=', $estatus);
            }

            $servicios = $servicios->paginate(50);

        return view('admin.bitacoras.tramites-nuevos.listado', compact('servicios'));
    
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
            //->leftjoin('categoria_estatus as est', 's.id_cate', '=', 'est.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 's.id_control','s.tramite', 's.id_clase', 'cla.clave as clase', 's.moneda', 's.costo', 's.descuento', 's.porcentaje_descuento', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email','s.alta_control_archivar_boolean', 'cat.costo_servicio', 's.saldo', 's.concepto_costo', 's.tipo_cambio', 's.costo_ini', 's.concepto_venta', 's.concepto_operativo', 's.concepto_gestion', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.facturado', 's.cobrado', 's.presentacion_fecha', 's.id_cliente', 's.id_razon_social', 's.id_bitacoras', 'mostrar_bitacora', 's.listo_comision_venta', 's.listo_comision_gestion','s.listo_comision_operativa','s.fecha_comision_venta', 's.fecha_comision_gestion', 's.fecha_comision_operativa','s.avance_total', 'mostrar_bitacora','s.alta_control_archivar','s.alta_estatus','s.carta_poder','s.cobro','s.contrato','s.elaboracion_notificacion_agradecimiento','s.elaboracion_expediente','s.entrega_titulo_agradecimiento','s.envio_notificacion','s.envio_resultados','s.escaneo','s.explicacion_comentarios','s.firma_fiel','s.formato','s.impresion','s.logo','s.logo_url','s.marca_lista_ingreso','s.pago','s.presentacion','s.recepcion_alta','s.registro','s.reglas_uso','s.respuesta_cliente','s.revision','s.pago_marca','s.validacion_marca','s.vencimiento_tramite','s.estatus_tramite','s.estatus_cobranza','s.alta_control_archivar_fecha','s.alta_estatus_fecha','s.carta_poder_fecha','s.cobro_fecha','s.contrato_fecha','s.elaboracion_notificacion_agradecimiento_fecha','s.elaboracion_expediente_fecha','s.entrega_titulo_agradecimiento_fecha','s.envio_notificacion_fecha','s.envio_resultados_fecha','s.escaneo_fecha','s.explicacion_comentarios_fecha','s.firma_fiel_fecha','s.formato_fecha','s.impresion_fecha','s.logo_fecha','s.marca_lista_ingreso_fecha','s.pago_fecha','s.presentacion_fecha','s.recepcion_alta_fecha','s.registro_fecha','s.reglas_uso_fecha','s.respuesta_cliente_fecha','s.revision_fecha','s.pago_marca_fecha','s.validacion_marca_fecha','s.vencimiento_tramite_fecha','s.estatus_tramite_fecha','s.estatus_cobranza_fecha','s.alta_control_archivar_boolean','s.alta_estatus_boolean','s.carta_poder_boolean','s.cobro_boolean','s.contrato_boolean','s.elaboracion_notificacion_agradecimiento_boolean','s.elaboracion_expediente_boolean','s.entrega_titulo_agradecimiento_boolean','s.envio_notificacion_boolean','s.envio_resultados_boolean','s.escaneo_boolean','s.explicacion_comentarios_boolean','s.firma_fiel_boolean','s.formato_boolean','s.impresion_boolean','s.logo_boolean','s.marca_lista_ingreso_boolean','s.pago_boolean','s.presentacion_boolean','s.recepcion_alta_boolean','s.registro_boolean','s.reglas_uso_boolean','s.respuesta_cliente_boolean','s.revision_boolean','s.pago_marca_boolean','s.validacion_marca_boolean','s.vencimiento_tramite_boolean', 's.envio_expediente_boolean', 's.envio_expediente_fecha', 's.envio_expediente', 's.id_estatus')
            ->where('s.id', '=', $id_servicio)
            ->first();

        return view('admin.bitacoras.tramites-nuevos.listado-servicio', compact('servicio', 'today'));
    }

    public function getServicio($id)
    {
        $servicio = DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->select('s.*', 'c.nombre_comercial','cat.clave', 'cat.servicio', 'con.nombre')
            ->where('s.id', '=', $id)
            ->first();

        return response()->json($servicio);
    }

    public function getLogo($id)
    {
        $logo = DB::table('servicios')
            ->select('logo_url')
            ->where('id','=',$id)
            ->first();

        return view('admin.bitacoras.tramites-nuevos.logo', compact('logo'));
    }

    public function postLogo(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

        $this->validate($request,
            [
                'logo_url' => 'image|mimes:jpeg,jpg,png,gif'
            ]);

        if($request->hasFile('logo_url'))
        {
            $logo_url = $request->file('logo_url');
            $filename = time() . '.' . $logo_url->getClientOriginalExtension();
            $path = 'images/logos/' . $filename;
            Image::make($logo_url->getRealPath())->save($path);
            $servicio->logo_url = $filename;

            $servicio->update();
        }
        else
        {
            //
        }

        return response()->json($servicio);
    }

    public function getServicios($id)
    {
        $servicios_clientes = DB::table('servicios as s')
            ->join('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->select('s.id', 'cat.clave', 'con.nombre', 's.tramite', 's.clase')
            ->where('c.id', '=', $id)
            ->where('s.id_bitacoras', '=', '1')
            ->orderBy('cat.clave')
            ->get();
        return $servicios_clientes;
    }

    public function show(Request $request, $id)
    {
        Carbon::setLocale('es');
        $query=trim($request->get('searchText'));
        $clientes = Clientes::orderBy('nombre_comercial', 'asc')->get();
        $variable_estatus = 'Todos';
        $clientes_filtro = DB::table('clientes as cli')
                ->join('servicios as s', 's.id_cliente', '=', 'cli.id')
                ->select('cli.id', 'cli.nombre_comercial')
                ->where('s.id_bitacoras', '=', '1')
                ->orderBy('cli.nombre_comercial', 'asc')
                ->groupBy('cli.id', 'cli.nombre_comercial')
                ->get();
        
        /*$servicios_filtro = DB::table('servicios as s')
                ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as con', 'con.id', '=', 's.id_control')
                ->select('s.id', 's.tramite', 'cat.clave', 'cat.servicio', 'con.nombre', 's.clase')
                ->where('s.id_bitacoras', '=', '2')
                ->orderBy('cat.clave', 'asc')
                ->orderBy('con.nombre', 'asc')
                ->groupBy('s.id')
                ->get();*/

            $servicios_filtro = 0;
        $bitacora_estatus = CategoriaEstatus::where('estatus', '=', '1')->orderBy('clave', 'asc')->get();

        $servicios=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('categoria_estatus as est', 's.id_bitacoras_estatus', '=', 'est.id')
            ->select('s.id','s.tramite', 's.clase', 's.moneda', 's.costo', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', 's.estatus_tramite', 's.estatus_cobranza', 's.created_at', 's.updated_at', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 's.id_bitacoras', 's.formato', 's.envio_resultados', 's.contrato', 's.carta_poder', 's.logo', 's.logo_url', 's.reglas_uso', 's.escaneo', 's.recepcion_alta', 's.marca_lista_ingreso', 's.validacion_marca', 's.revision', 's.firma_fiel', 's.impresion', 's.alta_estatus', 's.alta_control_archivar', 's.elaboracion_expediente', 's.envio_expediente', 's.formato_fecha', 's.envio_resultados_fecha', 's.contrato_fecha', 's.carta_poder_fecha', 's.logo_fecha', 's.reglas_uso_fecha', 's.escaneo_fecha', 's.recepcion_alta_fecha', 's.marca_lista_ingreso_fecha', 's.validacion_marca_fecha', 's.revision_fecha', 's.firma_fiel_fecha', 's.impresion_fecha', 's.alta_estatus_fecha', 's.alta_control_archivar_fecha', 's.elaboracion_expediente_fecha', 's.envio_expediente_fecha', 's.formato_comentarios', 's.envio_resultados_comentarios', 's.contrato_comentarios', 's.carta_poder_comentarios', 's.logo_comentarios', 's.reglas_uso_comentarios', 's.escaneo_comentarios', 's.recepcion_alta_comentarios', 's.marca_lista_ingreso_comentarios', 's.validacion_marca_comentarios', 's.revision_comentarios', 's.firma_fiel_comentarios', 's.impresion_comentarios', 's.alta_estatus_comentarios', 's.alta_control_archivar_comentarios', 's.elaboracion_expediente_comentarios', 's.envio_expediente_comentarios', 's.formato_boolean', 's.envio_resultados_boolean', 's.contrato_boolean', 's.carta_poder_boolean', 's.logo_boolean', 's.reglas_uso_boolean', 's.escaneo_boolean', 's.recepcion_alta_boolean', 's.marca_lista_ingreso_boolean', 's.validacion_marca_boolean', 's.revision_boolean', 's.firma_fiel_boolean', 's.impresion_boolean', 's.alta_estatus_boolean', 's.alta_control_archivar_boolean', 's.elaboracion_expediente_boolean', 's.envio_expediente_boolean', 's.saldo', 's.id_bitacoras_estatus', 's.concepto_costo', 's.concepto_operativo', 's.concepto_venta', 's.concepto_gestion', 's.tipo_cambio', 's.costo_servicio', 's.costo_ini', 's.aplica_comision_venta', 's.aplica_comision_operativa', 's.aplica_comision_gestion', 's.id_control', 's.id_cliente', 'c.carpeta', DB::raw('est.clave as clave_est'), DB::raw('est.bitacora as bitacora_estatus'), 's.registro_fecha', 's.id_estatus')
            ->where('s.id', '=', $id)
            ->paginate(25);
            
        return view('admin.bitacoras.tramites-nuevos.index',["servicios"=>$servicios, "clientes"=>$clientes, "searchText"=>$query, "variable_estatus"=>$variable_estatus, "clientes_filtro"=>$clientes_filtro, "servicios_filtro"=>$servicios_filtro, "bitacora_estatus"=>$bitacora_estatus]);
    }

    public function formato(Request $request, $id)
    {
        

        if($request->id_control != '' && $request->logo_url_logo !='')
        {

            $marca = DB::table('control')
                ->where('id', '=', $request->id_control)
                ->update(
                    [
                        'logo_url' => $request->logo_url
                    ]);
        }

        $servicio = Servicios::findOrFail($id);

        if($request->formato != '')
        {
            $this->validate($request,
                [
                    'formato_fecha' => 'required'
                ]);

            $servicio->formato_boolean=1;
            $servicio->formato=$request->formato;
            $servicio->formato_fecha=$request->formato_fecha;
        }
        else
        {
            $servicio->formato_boolean=0;
            $servicio->formato=$request->formato;
            $servicio->formato_fecha=null;
        }

        if($request->envio_resultados != '')
        {
            $this->validate($request,
                [
                    'envio_resultados_fecha' => 'required'
                ]);

            $servicio->envio_resultados_boolean=1;
            $servicio->envio_resultados=$request->envio_resultados;
            $servicio->envio_resultados_fecha=$request->envio_resultados_fecha;
        }
        else
        {
            $servicio->envio_resultados_boolean=0;
            $servicio->envio_resultados=$request->envio_resultados;
            $servicio->envio_resultados_fecha=null;
        }
        

        if($request->contrato != '')
        {
            $this->validate($request,
                [
                    'contrato_fecha' => 'required'
                ]);

            $servicio->contrato_boolean=1;
            $servicio->contrato=$request->contrato;
            $servicio->contrato_fecha=$request->contrato_fecha;
        }
        else
        {
            $servicio->contrato_boolean=0;
            $servicio->contrato=$request->contrato;
            $servicio->contrato_fecha=null;
        }

        if($request->carta_poder != '')
        {
            $this->validate($request,
                [
                    'carta_poder_fecha' => 'required'
                ]);

            $servicio->carta_poder_boolean=1;
            $servicio->carta_poder=$request->carta_poder;
            $servicio->carta_poder_fecha=$request->carta_poder_fecha;
        }
        else
        {
            $servicio->carta_poder_boolean=0;
            $servicio->carta_poder=$request->carta_poder;
            $servicio->carta_poder_fecha=null;
        }

        if($request->logo != '')
        {
            $this->validate($request,
                [
                    'logo_fecha' => 'required'
                ]);

            $servicio->logo_boolean=1;
            $servicio->logo=$request->logo;
            $servicio->logo_fecha=$request->logo_fecha;
        }
        else
        {
            $servicio->logo_boolean=0;
            $servicio->logo=$request->logo;
            $servicio->logo_fecha=null;
        }

        if($request->reglas_uso != '')
        {
            $this->validate($request,
                [
                    'reglas_uso_fecha' => 'required'
                ]);

            $servicio->reglas_uso_boolean=1;
            $servicio->reglas_uso=$request->reglas_uso;
            $servicio->reglas_uso_fecha=$request->reglas_uso_fecha;
        }
        else
        {
            $servicio->reglas_uso_boolean=0;
            $servicio->reglas_uso=$request->reglas_uso;
            $servicio->reglas_uso_fecha=null;
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

        if($request->marca_lista_ingreso != '')
        {
            $this->validate($request,
                [
                    'marca_lista_ingreso_fecha' => 'required'
                ]);

            $servicio->marca_lista_ingreso_boolean=1;
            $servicio->marca_lista_ingreso=$request->marca_lista_ingreso;
            $servicio->marca_lista_ingreso_fecha=$request->marca_lista_ingreso_fecha;
        }
        else
        {
            $servicio->marca_lista_ingreso_boolean=0;
            $servicio->marca_lista_ingreso=$request->marca_lista_ingreso;
            $servicio->marca_lista_ingreso_fecha=null;
        }

        if($request->validacion_marca != '')
        {
            $this->validate($request,
                [
                    'validacion_marca_fecha' => 'required'
                ]);

            $servicio->validacion_marca_boolean=1;
            $servicio->validacion_marca=$request->validacion_marca;
            $servicio->validacion_marca_fecha=$request->validacion_marca_fecha;
        }
        else
        {
            $servicio->validacion_marca_boolean=0;
            $servicio->validacion_marca=$request->validacion_marca;
            $servicio->validacion_marca_fecha=null;
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

        if($request->firma_fiel != '')
        {
            $this->validate($request,
                [
                    'firma_fiel_fecha' => 'required'
                ]);

            $servicio->firma_fiel_boolean=1;
            $servicio->firma_fiel=$request->firma_fiel;
            $servicio->firma_fiel_fecha=$request->firma_fiel_fecha;
        }
        else
        {
            $servicio->firma_fiel_boolean=0;
            $servicio->firma_fiel=$request->firma_fiel;
            $servicio->firma_fiel_fecha=null;
        }

        if($request->firma_fiel == 'Realizado' || $request->firma_fiel == 'No Aplica')
        {
            $servicio->registro = $request->firma_fiel;
            $servicio->registro_boolean = 1;
            $servicio->registro_fecha = $request->firma_fiel_fecha;
            $servicio->listo_comision_operativa = '1';
            //$servicio->listo_comision_venta = '1';
            //$servicio->listo_comision_gestion = '1';
            $servicio->fecha_comision_operativa = $request->firma_fiel_fecha;
            //$servicio->fecha_comision_venta = $request->alta_control_archivar_fecha;
            //$servicio->fecha_comision_gestion = $request->alta_control_archivar_fecha;
            $servicio->presentacion_fecha = $request->firma_fiel_fecha;

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Pendiente')
                ->where('tipo_comision', '=', 'Operativa')
                ->update(['listo_comision' => '1',
                            'estatus' => 'Liberada',
                            'fecha_aplicada' => $request->firma_fiel_fecha
                        ]);
            if($request->id_control != '')
            {
                $control = DB::table('control')
                    ->where('id', '=', $request->id_control)
                    ->update(
                        [
                            'registrada' => '1',
                            'fecha_registrada' => $request->firma_fiel_fecha
                        ]);
            }
            
        }
        else if($request->firma_fiel == 'Cancelado')
        {       
            $servicio->registro = $request->firma_fiel;
            $servicio->registro_boolean = 0;
            $servicio->registro_fecha = null;

            $servicio->listo_comision_operativa = '0';
            //$servicio->listo_comision_venta = '1';
            //$servicio->listo_comision_gestion = '1';
            $servicio->fecha_comision_operativa = null;
            //$servicio->fecha_comision_venta = $request->alta_control_archivar_fecha;
            //$servicio->fecha_comision_gestion = $request->alta_control_archivar_fecha;
            $servicio->presentacion_fecha = null;

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Liberada')
                ->where('tipo_comision', '=', 'Operativa')
                ->update(['listo_comision' => '0',
                            'estatus' => 'Pendiente',
                            'fecha_aplicada' => null
                        ]);

            if($request->id_control != '')
            {
                $control = DB::table('control')
                    ->where('id', '=', $request->id_control)
                    ->update(
                        [
                            'registrada' => '0',
                            'fecha_registrada' => null
                        ]);
            }
        }

        if($request->impresion != '')
        {
            $this->validate($request,
                [
                    'impresion_fecha' => 'required'
                ]);

            $servicio->impresion_boolean=1;
            $servicio->impresion=$request->impresion;
            $servicio->impresion_fecha=$request->impresion_fecha;
        }
        else
        {
            $servicio->impresion_boolean=0;
            $servicio->impresion=$request->impresion;
            $servicio->impresion_fecha=null;
        }

        

        //Bitacora Estatus
        if($request->id_bitacoras_estatus == '')
        {

        }
        else if($request->id_bitacoras_estatus == $request->id_bitacoras_estatus_value)
        {

        }
        else if($request->id_bitacoras_estatus != $request->id_bitacoras_estatus_value && $request->firma_fiel == 'Realizado')
        {
            $mytime = $mytime = Carbon::now('America/Chihuahua');
            $datetime = $mytime->toDateTimeString();

            $estatus = new Estatus;
            $estatus->id_cliente = $request->id_cliente;
            $estatus->id_marca = $request->id_control;
            $estatus->id_admin = $request->id_admin;
            $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
            $estatus->fecha_inicio = $request->fecha_inicio;
            $estatus->fecha_vencimiento = $request->fecha_vencimiento;
            $estatus->id_estatus = 8;
            $estatus->save();

            $servicio->id_estatus = $estatus->id;
            
        }

        $servicio->update();

        return response()->json($servicio);
    }

    public function elaboracion_expediente(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

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

        $servicio->estatus_tramite = $request->estatus_tramite;

        if($request->estatus_tramite == 'Terminado')
        {
            $servicio->listo_comision_venta = '1';
            $servicio->listo_comision_gestion = '1';
            $servicio->fecha_comision_venta = $request->envio_expediente_fecha;
            $servicio->fecha_comision_gestion = $request->envio_expediente_fecha;

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Pendiente')
                ->where('tipo_comision', '=', 'Venta')
                ->update(['listo_comision' => '1',
                            'estatus' => 'Liberada',
                            'fecha_aplicada' => $request->envio_expediente_fecha
                        ]);

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Pendiente')
                ->where('tipo_comision', '=', 'Gestión')
                ->update(['listo_comision' => '1',
                            'estatus' => 'Liberada',
                            'fecha_aplicada' => $request->envio_expediente_fecha
                        ]);
        }
        else if($request->estatus_tramite == 'Cancelado' || $request->estatus_tramite == 'No Registro')
        {
            $servicio->listo_comision_venta = 0;
            $servicio->listo_comision_gestion = 0;
            $servicio->fecha_comision_venta = null;
            $servicio->fecha_comision_gestion = null;

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Liberada')
                ->where('tipo_comision', '=', 'Venta')
                ->update(['listo_comision' => '0',
                            'estatus' => 'Pendiente',
                            'fecha_aplicada' => null
                        ]);

            $comision = DB::table('nomina')
                ->where('id_servicio', '=', $request->id_servicio)
                ->where('estatus', '=', 'Liberada')
                ->where('tipo_comision', '=', 'Gestión')
                ->update(['listo_comision' => '0',
                            'estatus' => 'Pendiente',
                            'fecha_aplicada' => null
                        ]);
        }
        

        $servicio->save();

        return response()->json($servicio);
    }

    public function enviar_estatus(Request $request)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'unique_with:bitacoras_estatus, id_servicio'
            ]);


        $estatus = new Estatus;
        $estatus->id_cliente=$request->id_cliente;
        $estatus->id_control=$request->id_control;
        $estatus->id_servicio=$request->id_servicio;
        $estatus->id_admin=$request->id_admin;
        $estatus->id_bitacoras_estatus=$request->id_bitacoras_estatus;
        $estatus->fecha_inicio=$request->fecha;
        //$estatus->fecha_vencimiento=$request->addYears('firma_fiel_fecha', 10);
        $estatus->carpeta_url=$request->carpeta;
        $estatus->estatus='Trámite';

        $estatus->save();

        $mensaje = array(
                    'message' => 'El servicio se envió a la bitácora de Estatus.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function crear_estatus(Request $request)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'required',
                //'numero_expediente' => 'unique:bitacoras_estatus',
                //'numero_registro' => 'unique:bitacoras_estatus',
                'id_estatus' => 'required'
            ]);

        $estatus = new Estatus;
        $estatus->id_marca = $request->id_marca;
        $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
        $estatus->id_estatus = $request->id_estatus;
        $estatus->id_cliente = $request->id_cliente;
        $estatus->id_admin = $request->id_admin;
        $estatus->id_clase = $request->id_clase;

        $estatus->numero_expediente = $request->numero_expediente;
        $estatus->numero_registro = $request->numero_registro;
        $estatus->fecha_inicio = $request->fecha_inicio;
        $estatus->fecha_comprobacion_uso = $request->fecha_comprobacion_uso;
        $estatus->fecha_vencimiento = $request->fecha_vencimiento;

        $estatus->save();

        $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'id_estatus' => $estatus->id
                    ]);

        return response()->json($estatus);

    }

    public function editar_estatus(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'required',
                //'numero_expediente' => 'unique:bitacoras_estatus',
                //'numero_registro' => 'unique:bitacoras_estatus',
                'id_estatus' => 'required'
            ]);

        $estatus = Estatus::findOrFail($id);
        $estatus->id_marca = $request->id_marca;
        $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
        $estatus->id_estatus = $request->id_estatus;
        $estatus->id_cliente = $request->id_cliente;
        $estatus->id_admin = $request->id_admin;
        $estatus->id_clase = $request->id_clase;

        $estatus->numero_expediente = $request->numero_expediente;
        $estatus->numero_registro = $request->numero_registro;
        $estatus->fecha_inicio = $request->fecha_inicio;
        $estatus->fecha_comprobacion_uso = $request->fecha_comprobacion_uso;
        $estatus->fecha_vencimiento = $request->fecha_vencimiento;

        $estatus->update();

        $servicio = DB::table('servicios')
                ->where('id', '=', $request->id_servicio)
                ->update(
                    [
                        'id_estatus' => $id
                    ]);

        return response()->json($estatus);
    }
}







