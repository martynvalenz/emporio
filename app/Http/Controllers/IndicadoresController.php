<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Emporio\Model\Metas;

class IndicadoresController extends Controller
{
    public function index()
    {
    	$anio_actual = Carbon::now('America/Chihuahua')->year;
    	$metas = Metas::all();

    	return view('admin.indicadores.index', compact('anio_actual', 'metas'));
    }

    public function direccion_estados($anio)
    {
    	$enero = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$febrero = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$marzo = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$abril = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$mayo = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$junio = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$julio = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$agosto = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$septiembre = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$octubre = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$noviembre = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '11')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$diciembre = DB::table('estados_cuenta')
    		->select(DB::raw('sum(deposito) as deposito'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '=', 'Pagado')
    		->sum('deposito');

    	$enero_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$febrero_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$marzo_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$abril_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$mayo_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$junio_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$julio_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$agosto_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$septiembre_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$octubre_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$noviembre_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '11')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	$diciembre_egresos = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '!=', 'Traspaso')
            ->where('revision', '=', 0)
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '=', 'Pagado')
    		->sum('retiro');

    	// $maximo = DB::table('estados_cuenta')
    	// 	->select(DB::raw('sum(total) as total'))
    	// 	->whereYear('fecha', '=', $anio)
    	// 	->where('estatus', '=', 'Pagado')
    	// 	->sum('total');

    	$estados_cuenta = compact('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'enero_egresos', 'febrero_egresos', 'marzo_egresos', 'abril_egresos', 'mayo_egresos', 'junio_egresos', 'julio_egresos', 'agosto_egresos', 'septiembre_egresos', 'octubre_egresos', 'noviembre_egresos', 'diciembre_egresos');

    	return response()->json($estados_cuenta);
    }

    public function servicios_metas($anio)
    {
    	$meta_mensual = 100;

    	$enero = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$febrero = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$marzo = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$abril = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$mayo = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$junio = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$julio = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$agosto = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$septiembre = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$octubre = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$noviembre = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '11')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$diciembre = DB::table('servicios')
    		->select(DB::raw('count(id) as servicios'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->count('id');

    	$servicios = compact('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'meta_mensual');

    	return response()->json($servicios);
    }

    public function ventas_metas($anio)
    {
    	$meta_mensual = 100000;

    	$enero = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$febrero = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$marzo = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$abril = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$mayo = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$junio = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$julio = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$agosto = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$septiembre = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$octubre = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$noviembre = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '11')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$diciembre = DB::table('servicios')
    		->select(DB::raw('sum(costo) as venta'))
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus_registro', '!=', 'Cancelado')
    		->sum('costo');

    	$servicios = compact('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'meta_mensual');

    	return response()->json($servicios);
    }

    public function get_egresos($anio)
    {
    	$enero_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$enero_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$enero_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$enero_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$enero_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '1')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$febrero_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$febrero_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$febrero_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$febrero_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$febrero_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '2')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$marzo_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$marzo_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$marzo_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$marzo_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$marzo_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '3')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$abril_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$abril_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$abril_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$abril_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$abril_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '4')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$mayo_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$mayo_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$mayo_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$mayo_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$mayo_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '5')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$junio_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$junio_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$junio_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$junio_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$junio_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '6')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$julio_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$julio_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$julio_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$julio_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$julio_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '7')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$agosto_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$agosto_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$agosto_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$agosto_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$agosto_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '8')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$septiembre_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$septiembre_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$septiembre_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$septiembre_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$septiembre_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '9')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$octubre_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$octubre_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$octubre_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$octubre_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$octubre_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '10')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$noviembre_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$noviembre_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$noviembre_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$noviembre_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$noviembre_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$diciembre_despacho = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Despacho')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$diciembre_hogar = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Hogar')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$diciembre_nomina = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Nómina')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$diciembre_personal = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'Personal')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');

    	$diciembre_comision = DB::table('estados_cuenta')
    		->select(DB::raw('sum(retiro) as retiro'))
    		->where('tipo', '=', 'COMISION')
    		->whereYear('fecha', '=', $anio)
    		->whereMonth('fecha', '=', '12')
    		->where('estatus', '!=', 'Cancelado')
            ->where('revision', '=', 0)
    		->sum('retiro');
    	

    	$servicios = compact('enero_despacho', 'enero_hogar', 'enero_nomina', 'enero_personal', 'enero_comision', 'febrero_despacho', 'febrero_hogar', 'febrero_nomina', 'febrero_personal', 'febrero_comision', 'marzo_despacho', 'marzo_hogar', 'marzo_nomina', 'marzo_personal', 'marzo_comision', 'abril_despacho', 'abril_hogar', 'abril_nomina', 'abril_personal', 'abril_comision', 'mayo_despacho', 'mayo_hogar', 'mayo_nomina', 'mayo_personal', 'mayo_comision', 'junio_despacho', 'junio_hogar', 'junio_nomina', 'junio_personal', 'junio_comision', 'julio_despacho', 'julio_hogar', 'julio_nomina', 'julio_personal', 'julio_comision', 'agosto_despacho', 'agosto_hogar', 'agosto_nomina', 'agosto_personal', 'agosto_comision', 'septiembre_despacho', 'septiembre_hogar', 'septiembre_nomina', 'septiembre_personal', 'septiembre_comision', 'octubre_despacho', 'octubre_hogar', 'octubre_nomina', 'octubre_personal', 'octubre_comision', 'noviembre_despacho', 'noviembre_hogar', 'noviembre_nomina', 'noviembre_personal', 'noviembre_comision', 'diciembre_despacho', 'diciembre_hogar', 'diciembre_nomina', 'diciembre_personal', 'diciembre_comision');

    	return response()->json($servicios);
    }

    public function tramites()
    {
        $usuarios = DB::table('users as u')
            ->leftjoin('servicios as s', 's.id_admin', '=', 'u.id')
            ->select('u.id','u.iniciales', 'u.nombre', 'u.apellido')
            ->groupBy('u.id','u.iniciales', 'u.nombre', 'u.apellido')
            ->where('s.estatus_registro', 'Pendiente')
            ->get();

        return view('admin.indicadores.tramites', compact('usuarios'));
    }

    public function tramites_usuario(Request $request)
    {
        $servicios = DB::table('servicios as s')
            ->join('users as u', 's.id_admin', '=', 'u.id')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 'c.nombre_comercial', 'con.nombre as marca', 'cla.clave as clase', 'cat.clave', 'u.iniciales', 'u.nombre', 'u.apellido', 's.fecha', 's.costo', 's.estatus_cobranza', 's.avance', 's.avance_total', DB::raw('(s.avance / s. avance_total) * 100 as avance_parcial'), 's.created_at', 's.tramite')
            ->where('s.estatus_registro', '=', 'Pendiente')
            ->where('s.fecha', '>=', '2019-01-01')
            ->orderBy('s.fecha', 'asc');

            if($request->user == 'todos')
            {
                //
            }
            else if($request->user != 'todos')
            {
                $servicios->where('s.id_admin', '=', $request->user);
            }

        // $servicios = $servicios->paginate(50);
        $servicios = $servicios->get();

        return view('admin.indicadores.listado-tramites', compact('servicios'));
    }
}












