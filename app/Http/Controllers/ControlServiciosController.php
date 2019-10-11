<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clientes;
use Emporio\Model\Clases;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\Servicios;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;

class ControlServiciosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        /*$mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-1);
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $mytime = Carbon::now('America/Chihuahua');
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();
        $fecha_inicio_anio = Carbon::now('America/Chihuahua')->startOfYear()->toDateString();
        $fecha_fin_anio = Carbon::now('America/Chihuahua')->endOfYear()->toDateString();*/

        $s

        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->where('id', '!=', '4')->get();
        $estrategias = Estrategias::orderBy('id','asc')->where('estatus','=','1')->get();
        $monedas = Monedas::orderBy('id', 'asc')->get();
        $admins = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->where('responsabilidad','=','1')->get();
        $clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $catalogo_servicios = DB::table('catalogo_servicios as cat')
            ->join('monedas as m', 'm.clave', '=', 'cat.moneda')
            ->select('cat.*', 'm.conversion')
            ->orderBy('cat.clave', 'asc')
            ->where('cat.estatus','=','1')
            ->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        return view('admin.control-servicios.index',compact('servicios', 'clientes', 'controles', 'catalogo_servicios', 'bitacoras', 'estatus'));
    }

    public function cliente(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial'=>'required|max:50|unique:clientes'
            ]);

        $cliente = new Clientes;
        $cliente->nombre_comercial=$request->nombre_comercial;
        $cliente->id_admin=$request->id_admin;
        $cliente->id_estrategia=$request->id_estrategia;
        $cliente->id_estado='6';
        $cliente->id_pais='1';
        $cliente->estatus = '1';
        $cliente->save();

        $mensaje = array(
                    'message' => 'El cliente fue creado exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect()->route('procesos.index')
            ->with($mensaje);
    }

    public function marca(Request $request)
    {
        $this->validate($request,
        [
            'nombre'=>'required|max:100|unique:control',
            'id_cliente'=>'required',
        ]);

        $control = new Control;
        $control->nombre=$request->get('nombre');
        $control->id_cliente=$request->get('id_cliente');
        $control->descripcion=$request->get('descripcion');
        $control->estatus = $request->has('estatus') ? 1 : 0;
        $control->save();

        $mensaje = array(
                    'message' => 'Se creó la marca o nombre comercial exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('procesos.index'))->with($mensaje);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
