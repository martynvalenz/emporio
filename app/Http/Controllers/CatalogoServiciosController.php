<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Http\Requests;
use Emporio\Http\Controllers\Controller;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\CategoriaServicios;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\SubcategoriaServicios;
use Emporio\Model\Monedas;
use Emporio\Model\Requisitos;
use Emporio\Model\ServiciosRequisitos;
use Carbon\Carbon;
use DB;

class CatalogoServiciosController extends Controller
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

        $url_listar = '/admin/servicios/listado/';
        $url_buscar = '/admin/servicios/buscar/';
        $url_actualizar = '/admin/servicios/actualizar/';
        $url_exportar = '/admin/servicios/exportar/';

        return view('admin.servicios.index', compact('categoria_servicios', 'categoria_estatus', 'categoria_bitacoras', 'monedas', 'url_listar', 'url_buscar', 'url_actualizar', 'url_exportar'));
    }

    public function exportar($estatus, $buscar)
    {
        Carbon::setLocale('es');
        $catalogos = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->select('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre', 'c.porcentaje_venta', 'c.porcentaje_operativa', 'c.porcentaje_gestion')
            ->orderBy('c.clave', 'asc');

        if($buscar == '0')
        {
            //
        }
        else
        {
            $catalogos->where(function($q) use ($buscar)
            {
                $q->where('c.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('c.clave','LIKE','%'.$buscar.'%')
                ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%');
            });
        }
        
        if($estatus == 'todos')
        {
            //
        }
        else if($estatus != 'todos')
        {
            $catalogos->where('c.estatus', '=', $estatus);
        }

        $catalogos = $catalogos->get();

        //return $catalogos;

        return view('admin.servicios.exportar', compact('catalogos'));
    }

    public function listado($estatus)
    {
        Carbon::setLocale('es');
        $catalogos = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->leftjoin('servicio_requisitos as req', 'req.id_catalogo_servicio', '=', 'c.id')
            ->select('c.*','cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre', DB::raw('count(req.id_catalogo_servicio) as requisitos'))
            ->groupBy('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'c.honorarios', 'c.utilidad', 'c.porcentaje_utilidad', 'c.porcentaje_venta', 'c.porcentaje_operativa', 'c.porcentaje_gestion', 'c.avance_total', 'cat.categoria', 'bit.bitacora', 'est.bitacora', 'm.clave', 'm.moneda')
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

        return view('admin.servicios.listado', compact('catalogos'));
    }

    public function buscar($estatus, $buscar)
    {
        Carbon::setLocale('es');
        $catalogos = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->leftjoin('servicio_requisitos as req', 'req.id_catalogo_servicio', '=', 'c.id')
            ->select('c.*','cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre', DB::raw('count(req.id_catalogo_servicio) as requisitos'))
            ->groupBy('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'c.honorarios', 'c.utilidad', 'c.porcentaje_utilidad', 'c.porcentaje_venta', 'c.porcentaje_operativa', 'c.porcentaje_gestion', 'c.avance_total', 'cat.categoria', 'bit.bitacora', 'est.bitacora', 'm.clave', 'm.moneda')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.clave','LIKE','%'.$buscar.'%')
                ->orWhere('c.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('c.comentarios','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%')
                ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%');
            })
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

        return view('admin.servicios.listado', compact('catalogos')); 
    }

    public function actualizar($id)
    {
        Carbon::setLocale('es');
        $catalogo = DB::table('catalogo_servicios as c')
            ->leftjoin('categoria_servicios as cat', 'c.id_categoria_servicios', '=', 'cat.id')
            ->leftjoin('categoria_bitacoras as bit', 'bit.id', '=', 'c.id_categoria_bitacora')
            ->leftjoin('categoria_estatus as est', 'est.id', '=', 'c.id_categoria_estatus')
            ->leftjoin('monedas as m', 'm.clave', '=', 'c.moneda')
            ->leftjoin('servicio_requisitos as req', 'req.id_catalogo_servicio', '=', 'c.id')
            ->select('c.*','cat.categoria', 'bit.bitacora', 'est.bitacora as bit_estatus', 'm.clave as clave_moneda', 'm.moneda as moneda_nombre', DB::raw('count(req.id_catalogo_servicio) as requisitos'))
            ->groupBy('c.id', 'c.clave', 'c.servicio', 'c.comentarios', 'c.concepto', 'c.moneda', 'c.costo', 'c.costo_servicio', 'c.comision_venta', 'c.comision_venta_monto', 'c.comision_gestion', 'c.comision_gestion_monto', 'c.comision_operativa', 'c.comision_operativa_monto', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.procedimiento', 'c.diagrama', 'c.id_categoria_servicios', 'c.id_categoria_bitacora', 'c.id_categoria_estatus', 'c.honorarios', 'c.utilidad', 'c.porcentaje_utilidad', 'c.porcentaje_venta', 'c.porcentaje_operativa', 'c.porcentaje_gestion', 'c.avance_total', 'cat.categoria', 'bit.bitacora', 'est.bitacora', 'm.clave', 'm.moneda')
            ->orderBy('c.clave', 'asc')
            ->first();

        return view('admin.servicios.listado-actualizar', compact('catalogo'));
    }
    
    public function create()
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
        return view ('admin.servicios.create', compact('categoria_servicios', 'categoria_estatus', 'categoria_bitacoras', 'monedas'));
    }

    public function subcategoria($id_categoria_servicios)
    {
        $subcategoria = SubcategoriaServicios::where('id_categoria', '=', $id_categoria_servicios)->get();

        return response()->json($subcategoria);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'clave'=>'required|max:30|unique:catalogo_servicios',
                'servicio' => 'required|max:512|unique:catalogo_servicios',
                'costo_servicio' =>'required|min:0|numeric',
                'costo' =>'required|min:0|numeric',
                'comision_venta_monto' =>'required|min:0|numeric',
                'comision_operativa_monto' =>'required|min:0|numeric',
                'comision_gestion_monto' =>'required|min:0|numeric',
                'id_categoria_bitacora' =>'required',
                'id_categoria_servicios' =>'required'
            ]);

        $catalogo = new CatalogoServicios;
        $catalogo->clave=$request->clave;
        $catalogo->servicio=$request->servicio;
        $catalogo->comentarios=$request->comentarios;
        $catalogo->concepto=$request->concepto;
        $catalogo->moneda=$request->moneda;
        if($request->costo_servicio == '')
        {
            $catalogo->costo_servicio = 0;
        }
        else
        {
            $catalogo->costo_servicio=$request->costo_servicio;
        }
        $catalogo->costo=$request->costo;
        $catalogo->comision_venta=$request->comision_venta;
        $catalogo->comision_operativa=$request->comision_operativa;
        $catalogo->comision_gestion=$request->comision_gestion;
        //$catalogo->procedimiento=$request->procedimiento;
        //$catalogo->diagrama=$request->diagrama;
        $catalogo->id_categoria_servicios=$request->id_categoria_servicios;
        //$catalogo->id_subcategoria=$request->id_subcategoria;
        $catalogo->id_categoria_estatus=$request->id_categoria_estatus;
        $catalogo->id_categoria_bitacora=$request->id_categoria_bitacora;
        //$catalogo->estatus = $request->estatus;
        $catalogo->honorarios = $request->honorarios;
        $catalogo->utilidad = $request->utilidad;
        $catalogo->porcentaje_utilidad = $request->porcentaje_utilidad;

        if($request->comision_venta == '')
        {
            $catalogo->comision_venta_monto = 0;
        }
        else
        {
            $catalogo->comision_venta_monto = $request->comision_venta_monto;
            $catalogo->porcentaje_venta = $request->porcentaje_venta;
        }

        if($request->comision_gestion == '')
        {
            $catalogo->comision_gestion_monto = 0;
        }
        else
        {
            $catalogo->comision_gestion_monto = $request->comision_gestion_monto;
            $catalogo->porcentaje_gestion = $request->porcentaje_gestion;
        }

        if($request->comision_operativa == '')
        {
            $catalogo->comision_operativa_monto = 0;
        }
        else
        {
            $catalogo->comision_operativa_monto = $request->comision_operativa_monto;
            $catalogo->porcentaje_operativa = $request->porcentaje_operativa;
        }

        $catalogo->save();

        return response()->json($catalogo);
    }

    public function show($id)
    {
        $catalogo = CatalogoServicios::findOrFail($id);

        return response()->json($catalogo);
    }

    public function edit($id)
    {
        Carbon::setLocale('es');
        $catalogo = CatalogoServicios::findOrFail($id);

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
        return view ('admin.servicios.edit', compact('categoria_servicios', 'categoria_estatus', 'categoria_bitacoras', 'monedas', 'catalogo'));
    }

    public function update(Request $request, $id)
    {
        
        $catalogo = CatalogoServicios::findOrFail($id);

        $this->validate($request,
            [

                'clave'=>'required|max:30|unique_with:catalogo_servicios,'.$id,
                'servicio' => 'required|max:512|unique_with:catalogo_servicios,'.$catalogo->id,
                'costo_servicio' =>'required|min:0|numeric',
                'costo' =>'required|min:0|numeric',
                'comision_venta_monto' =>'required|min:0|numeric',
                'comision_operativa_monto' =>'required|min:0|numeric',
                'comision_gestion_monto' =>'required|min:0|numeric',
                'id_categoria_bitacora' =>'required',
                'id_categoria_servicios' =>'required'
            ]);
        
        $catalogo->clave=$request->clave;
        $catalogo->servicio=$request->servicio;
        $catalogo->comentarios=$request->comentarios;
        $catalogo->concepto=$request->concepto;
        $catalogo->moneda=$request->moneda;
        if($request->costo_servicio == '')
        {
            $catalogo->costo_servicio = 0;
        }
        else
        {
            $catalogo->costo_servicio=$request->costo_servicio;
        }
        $catalogo->costo=$request->costo;
        $catalogo->comision_venta=$request->comision_venta;
        $catalogo->comision_operativa=$request->comision_operativa;
        $catalogo->comision_gestion=$request->comision_gestion;
        //$catalogo->procedimiento=$request->procedimiento;
        //$catalogo->diagrama=$request->diagrama;
        $catalogo->id_categoria_servicios=$request->id_categoria_servicios;
        //$catalogo->id_subcategoria=$request->id_subcategoria;
        $catalogo->id_categoria_estatus=$request->id_categoria_estatus;
        $catalogo->id_categoria_bitacora=$request->id_categoria_bitacora;
        //$catalogo->estatus = $request->estatus;
        $catalogo->honorarios = $request->honorarios;
        $catalogo->utilidad = $request->utilidad;
        $catalogo->porcentaje_utilidad = $request->porcentaje_utilidad;

        if($request->comision_venta == '')
        {
            $catalogo->comision_venta_monto = 0;
        }
        else
        {
            $catalogo->comision_venta_monto = $request->comision_venta_monto;
            $catalogo->porcentaje_venta = $request->porcentaje_venta;
        }

        if($request->comision_gestion == '')
        {
            $catalogo->comision_gestion_monto = 0;
        }
        else
        {
            $catalogo->comision_gestion_monto = $request->comision_gestion_monto;
            $catalogo->porcentaje_gestion = $request->porcentaje_gestion;
        }

        if($request->comision_operativa == '')
        {
            $catalogo->comision_operativa_monto = 0;
        }
        else
        {
            $catalogo->comision_operativa_monto = $request->comision_operativa_monto;
            $catalogo->porcentaje_operativa = $request->porcentaje_operativa;
        }
        
        $catalogo->update();

        return response()->json($catalogo);
    }

    public function destroy(Request $request, $id)
    {
        $catalogo = CatalogoServicios::findOrFail($id);
        $catalogo->estatus=$request->estatus;
        $catalogo->update();
        
        return response()->json($catalogo);
    }

    //REquisitos

    public function edit_requisito($id)
    {
        $catalogo = CatalogoServicios::findOrFail($id);

        $tipo = 'Catalogo';
        $url_options = '/admin/servicios/requisitos-options/';
        $url_cargar_requisitos = '/admin/servicios/cargar-requisitos/';
        $url_requisitos = '/admin/servicios/requisitos';
        $url_store = '/admin/servicios/requisitos/store';
        $url_update = '/admin/servicios/requisitos/update/';
        $url_insertar = '/admin/servicios/requisitos/insertar';
        $url_eliminar = '/admin/servicios/requisitos/eliminar/';
        $url_subir = '/admin/servicios/requisitos/subir-orden/';
        $url_bajar = '/admin/servicios/requisitos/bajar-orden/';
        $url_liberar_comisiones = '/admin/servicios/requisitos/liberar-comisiones/';

        return view('admin.servicios.proceso', compact('catalogo', 'tipo', 'url_options', 'url_cargar_requisitos', 'url_requisitos', 'url_store', 'url_update', 'url_insertar', 'url_eliminar', 'url_subir', 'url_bajar', 'url_liberar_comisiones'));
    }

    public function requisitos_options($id)
    {
        $array = DB::table('servicio_requisitos as s')
            ->where('s.id_catalogo_servicio', '=', $id)
            ->pluck('s.id_requisitos');

        $requisitos = Requisitos::whereNotIn('id', $array)->select('id', 'categoria', 'requisito', 'estatus')->orderBy('requisito')->get();

        $requisitos_servicio = DB::table('requisitos as r')
            ->join('servicio_requisitos as s', 's.id_requisitos', '=', 'r.id')
            ->select('r.*', 's.id as id_servicio')
            ->where('s.id_catalogo_servicio', '=', $id)
            ->orderBy('r.requisito', 'asc')
            ->get();

        //return $requisitos;

        return view('admin.servicios.requisitos_options', compact('requisitos', 'requisitos_servicio'));
    }

    public function cargar_requisitos($id)
    {
        Carbon::setLocale('es');
        $requisitos_listado = DB::table('servicio_requisitos as s')
            ->join('requisitos as r', 's.id_requisitos', '=', 'r.id')
            ->select('s.*', 'r.categoria', 'r.requisito', 'r.estatus')
            ->where('s.id_catalogo_servicio', '=', $id)
            ->orderBy('s.orden', 'asc')
            ->get();

        $ultimo_orden = ServiciosRequisitos::where('id_catalogo_servicio', '=', $id)->orderBy('orden', 'desc')->first();
        //$penultimo_orden = ServiciosRequisitos::where('id_catalogo_servicio', '=', $id)->orderBy('orden', 'desc')->skip(1)->first();

        return view('admin.servicios.requisitos_listado', compact('requisitos_listado', 'ultimo_orden'/*, 'penultimo_orden'*/));
    }

    public function store_requisito(Request $request)
    {
        $this->validate($request,
            [
                'requisito' => 'required|unique:requisitos',
                'categoria' => 'required'
            ]);

        $requisito = new Requisitos;
        $requisito->requisito = $request->requisito;
        $requisito->categoria = $request->categoria;
        $requisito->estatus = $request->estatus;
        $requisito->save();

        return response()->json($requisito);
    }

    public function update_requisito(Request $request, $id)
    {
        $requisito = Requisitos::findOrFail($id);

        $this->validate($request,
            [
                'requisito' => 'required|unique_with:requisitos,'.$id,
                'categoria' => 'required'
            ]);

        $requisito->requisito = $request->requisito;
        $requisito->categoria = $request->categoria;
        $requisito->estatus = $request->estatus;
        $requisito->update();

        return response()->json($requisito);
    }

    public function insertar_requisito(Request $request)
    {
        $requisito = new ServiciosRequisitos;
        $requisito->orden = $request->orden;
        $requisito->id_requisitos = $request->id_requisitos;
        $requisito->id_catalogo_servicio = $request->id_catalogo_servicio;
        $requisito->save();

        $catalogo = DB::table('catalogo_servicios')
            ->where('id', '=', $request->id_catalogo_servicio)
            ->update(
                [
                    'avance_total' => $request->avance_total
                ]);

        return response()->json($requisito);
    }

    public function eliminar_requisito(Request $request, $id)
    {
        $catalogo = DB::table('catalogo_servicios')
            ->where('id', '=', $request->id_catalogo_servicio)
            ->update(
                [
                    'avance_total' => $request->avance_total
                ]);

        $requisito = ServiciosRequisitos::findOrFail($id);
        $requisito->delete();

        return response()->json($requisito);
    }

    public function requisito_subir(Request $request, $id, $orden)
    {
        if($orden == 1)
        {
            $mensaje = 'No se puede disminuir el orden en el primer registro';
            return response()->json($mensaje);
        }
        else if($orden > 1)
        {
            $sustituido = $orden - 1;

            $requisito_reemplazar = DB::table('servicio_requisitos')
                ->where('orden', '=', $sustituido)
                ->where('id_catalogo_servicio', '=', $request->id_catalogo_servicio)
                ->update(
                    [
                        'orden' => $orden
                    ]);

            $requisito = DB::table('servicio_requisitos')
                ->where('id', '=', $id)
                ->update(
                    [
                        'orden' => $sustituido
                    ]);

            return response()->json($requisito);
        }
    }

    public function requisito_bajar(Request $request, $id, $orden)
    {
        if($orden >= $request->ultimo_orden)
        {
            $mensaje = 'No se puede aumentar el orden en el último registro';
            return response()->json($mensaje);
        }
        else if($orden < $request->ultimo_orden)
        {
            $sustituido = $orden + 1;

            $requisito_reemplazar = DB::table('servicio_requisitos')
                ->where('orden', '=', $sustituido)
                ->where('id_catalogo_servicio', '=', $request->id_catalogo_servicio)
                ->update(
                    [
                        'orden' => $orden
                    ]);

            $requisito = DB::table('servicio_requisitos')
                ->where('id', '=', $id)
                ->update(
                    [
                        'orden' => $sustituido
                    ]);

            return response()->json($requisito);
        }
    }

    public function liberar_comisiones($num, $id, $id_catalogo_servicio)
    {
        if($num == 1)
        {
            $quitar_comision = DB::table('servicio_requisitos')
                ->where('id_catalogo_servicio', '=', $id_catalogo_servicio)
                ->update(
                    [
                        'libera_venta' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_requisitos')
                ->where('id', '=', $id)
                ->update(
                    [
                        'libera_venta' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
        else if($num == 2)
        {
            $quitar_comision = DB::table('servicio_requisitos')
                ->where('id_catalogo_servicio', '=', $id_catalogo_servicio)
                ->update(
                    [
                        'libera_operativa' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_requisitos')
                ->where('id', '=', $id)
                ->update(
                    [
                        'libera_operativa' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
        else if($num == 3)
        {
            $quitar_comision = DB::table('servicio_requisitos')
                ->where('id_catalogo_servicio', '=', $id_catalogo_servicio)
                ->update(
                    [
                        'libera_gestion' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_requisitos')
                ->where('id', '=', $id)
                ->update(
                    [
                        'libera_gestion' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
        else if($num == 4)
        {
            $quitar_comision = DB::table('servicio_requisitos')
                ->where('id_catalogo_servicio', '=', $id_catalogo_servicio)
                ->update(
                    [
                        'registro' => '0'
                    ]);

            $liberar_comision = DB::table('servicio_requisitos')
                ->where('id', '=', $id)
                ->update(
                    [
                        'registro' => '1'
                    ]);

            return response()->json($liberar_comision);
        }
    }
}













