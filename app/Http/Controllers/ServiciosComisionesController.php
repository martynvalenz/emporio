<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Emporio\Model\CatalogoServicios;
use Carbon\Carbon;

class ServiciosComisionesController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $categoria_servicios=DB::table('categoria_servicios')
            ->orderBy('categoria', 'asc')
            ->where('estatus','=','1')
            ->get();
        $categoria_estatus=DB::table('categoria_estatus')
            ->orderBy('bitacora', 'asc')
            ->where('estatus','=','1')
            ->get();
        $categoria_bitacoras=DB::table('categoria_bitacoras')
            ->orderBy('bitacora', 'asc')
            ->where('estatus','=','1')
            ->get();
        $monedas=DB::table('monedas')
            ->orderBy('id', 'asc')
            ->where('estatus','=','1')
            ->get();

        $url_listar = '/admin/servicios-comisiones/listado/';
        $url_buscar = '/admin/servicios-comisiones/buscar/';
        $url_actualizar = '/admin/servicios-comisiones/actualizar/';
        $url_exportar = '/admin/servicios/exportar/';

        return view('admin.servicios.comisiones.index', compact('categoria_servicios', 'categoria_estatus', 'categoria_bitacoras', 'monedas', 'url_listar', 'url_buscar', 'url_actualizar', 'url_exportar'));
    }

    public function listado($estatus)
    {
        Carbon::setLocale('es');
        $catalogos = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->select('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre', 'c.porcentaje_venta', 'c.porcentaje_operativa', 'c.porcentaje_gestion')
            ->orderBy('c.clave', 'asc');

        if($estatus == 'todos')
        {
            //
        }
        else if($estatus != 'todos')
        {
            $catalogos->where('c.estatus', '=', $estatus);
        }

        $catalogos = $catalogos->get();

        return view('admin.servicios.comisiones.listado', compact('catalogos'));
    }

    public function buscar($buscar)
    {
        Carbon::setLocale('es');
        $catalogos = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->select('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre', 'c.porcentaje_venta', 'c.porcentaje_operativa', 'c.porcentaje_gestion')
            ->where('c.servicio','LIKE','%'.$buscar.'%')
            ->orWhere('c.clave','LIKE','%'.$buscar.'%')
            ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
            ->orWhere('cat.categoria','LIKE','%'.$buscar.'%')
            ->orderBy('c.clave', 'asc');
        
        if($estatus == 'todos')
        {
            //
        }
        else if($estatus != 'todos')
        {
            $catalogos->where('c.estatus', '=', $estatus);
        }

        $catalogos = $catalogos->get();

        return view('admin.servicios.comisiones.listado', compact('comisiones')); 
    }

    public function actualizar($id)
    {
        Carbon::setLocale('es');
        $catalogo = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->select('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre')
            ->where('c.id', '=', $id)
            ->first();

        return view('admin.servicios.comisiones.listado-actualizar', compact('catalogo'));
    }
}
