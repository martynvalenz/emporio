<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Carbon\Carbon;
use Emporio\Model\Facturas;
use Emporio\Model\Servicios;
use Emporio\Model\LoginImagenes;
use Emporio\Model\Metas;
use DB;

class AdminController extends Controller
{
    public function index()
    {
    	$facturas_pendientes = Servicios::where('estatus_cobranza', '=', 'Pendiente')->get(); 
        $facturas_pagadas = Servicios::where('estatus_cobranza', '=', 'Pagado')->get(); 

        $servicios_pendientes = Servicios::where('estatus_registro', '=', 'Pendiente')->get();
        $servicios_terminados = Servicios::where('estatus_registro', '=', 'Terminado')->get();

        $tramites_nuevos = Servicios::select(DB::raw('count(*)'))->where('id_bitacoras', '=', 1)->where('estatus_registro', '=', 'Pendiente')->count();
        $estudios_factibilidad = Servicios::select(DB::raw('count(*)'))->where('id_bitacoras', '=', 2)->where('estatus_registro', '=', 'Pendiente')->count();
        $titulos_certificados = Servicios::select(DB::raw('count(*)'))->where('id_bitacoras', '=', 4)->where('estatus_registro', '=', 'Pendiente')->count();
        $requisitos_objeciones = Servicios::select(DB::raw('count(*)'))->where('id_bitacoras', '=', 5)->where('estatus_registro', '=', 'Pendiente')->count();
        $negativas = Servicios::select(DB::raw('count(*)'))->where('id_bitacoras', '=', 3)->where('estatus_registro', '=', 'Pendiente')->count();


        $anio_actual = Carbon::now('America/Chihuahua')->year;
        $metas = Metas::all();

        return view('admin.admin', compact('facturas_pendientes', 'facturas_pagadas', 'servicios_pendientes', 'servicios_terminados', 'anio_actual', 'metas', 'tramites_nuevos', 'estudios_factibilidad', 'titulos_certificados', 'requisitos_objeciones', 'negativas'));

        //return view('admin.admin');
    }

    public function cambiarImagen($id)
    {
        $imagenes = DB::table('login_images')
        ->update(['principal' => '0'
            ]);

        $imagen = LoginImagenes::findOrFail($id);
        $imagen->principal = 1;
        $imagen->update();

        return response()->json($imagen);
    }

    public function mostrarImagen()
    {
    	$imagen_principal = LoginImagenes::where('principal', '=', '1')->first();

    	return response()->json($imagen_principal);
    }

    public function notificaciones_juridico()
    {
        $notificaciones_juridico = DB::table('servicio_progreso as pro')
            ->join('requisitos as req', 'req.id', '=', 'pro.id_requisitos')
            ->select('pro.id_servicio')
            ->where('req.categoria', '=', 'Jurídico')
            ->where('pro.estatus', '=', '0')
            ->groupBy('pro.id_servicio')
            ->get();

        return response()->json($notificaciones_juridico);
    }

    public function notificaciones_gestion()
    {
        $notificaciones_gestion = DB::table('servicio_progreso as pro')
            ->join('requisitos as req', 'req.id', '=', 'pro.id_requisitos')
            ->select('pro.id_servicio')
            ->where('req.categoria', '=', 'Gestión')
            ->where('pro.estatus', '=', '0')
            ->groupBy('pro.id_servicio')
            ->get();

        return $notificaciones_gestion;
    }

    public function notificaciones_operaciones()
    {
        $notificaciones_operaciones = DB::table('servicio_progreso as pro')
            ->join('requisitos as req', 'req.id', '=', 'pro.id_requisitos')
            ->select('pro.id_servicio')
            ->where('req.categoria', '=', 'Operaciones')
            ->where('pro.estatus', '=', '0')
            ->groupBy('pro.id_servicio')
            ->get();

        return $notificaciones_operaciones;
    }
}






