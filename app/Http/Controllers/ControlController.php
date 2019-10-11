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
use Carbon\Carbon;
use DB;

class ControlController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');
            $clientes = Clientes::orderBy('nombre_comercial', 'asc')
                ->where('estatus','=','1')
                ->get();
            $query=trim($request->get('searchText'));
            $controles = DB::table('control as co')
                ->leftjoin('clientes as cl', 'co.id_cliente', 'cl.id')
                ->leftjoin('users as a', 'co.id_admin', 'a.id')
                ->select('co.id', 'co.nombre', 'co.descripcion', 'co.estatus', 'co.created_at', 'co.updated_at', 'co.id_cliente', 'cl.nombre_comercial', 'co.id_admin', 'a.iniciales', 'a.nombre as user', 'a.apellido')
                ->where('co.id','LIKE','%'.$query.'%')
                ->orWhere('co.nombre','LIKE','%'.$query.'%')
                ->orWhere('co.estatus','LIKE','%'.$query.'%')
                ->orWhere('cl.nombre_comercial','LIKE','%'.$query.'%')
                ->orWhere('a.iniciales','LIKE','%'.$query.'%')
                ->orWhere('a.nombre','LIKE','%'.$query.'%')
                ->orWhere('a.apellido','LIKE','%'.$query.'%')
                ->orderBy('co.nombre','asc')
                //->groupBy('co.id', 'co.nombre', 'co.descripcion', 'co.estatus', 'co.created_at', 'co.updated_at', 'co.id_cliente', 'cl.nombre_comercial', 'co.id_admin', 'a.iniciales', 'a.nombre', 'a.apellido')
                ->paginate(30);
            return view('admin.control.control.index',["clientes"=>$clientes, "controles"=>$controles, "searchText"=>$query]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'nombre'=>'required|max:100|unique_with:control,id_cliente',
            'id_cliente'=>'required',
        ]);

        $control = new Control;
        $control->nombre=$request->get('nombre');
        $control->id_cliente=$request->get('id_cliente');
        $control->id_admin=$request->get('id_admin');
        $control->descripcion=$request->get('descripcion');
        $control->estatus = $request->has('estatus') ? 1 : 0;
        $control->save();

        $mensaje = array(
                    'message' => 'Se creó la marca o título exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function clientes(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial'=>'required|max:50|unique:clientes'
            ]);

        $cliente = new Clientes;
        $cliente->nombre_comercial=$request->nombre_comercial;
        $cliente->id_admin=$request->id_admin;
        $cliente->id_estrategia=$request->id_estrategia;
        $cliente->estatus = '1';
        $cliente->save();

        $mensaje = array(
                    'message' => 'El cliente fue creado exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function update(Request $request, $id)
    {
        $control = Control::findOrFail($id);

        $this->validate($request,
        [
            'nombre'=>'required|max:100|unique_with:control,id_cliente,'.$control->id,
        ]);

        
        $control->nombre=$request->get('nombre');
        $control->id_cliente=$request->get('id_cliente');
        $control->descripcion=$request->get('descripcion');
        $control->estatus=$request->get('estatus');
        $control->update();

        $mensaje = array(
                    'message' => 'Se actualizó la marca o título exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $control = Control::findOrFail($id);
        $control->estatus=$request->estatus;
        $control->update();
        
        $mensaje = array(
                    'message' => 'El estatus de la marca fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }

    public function create_servicio($id)
    {
        Carbon::setLocale('es');
        $marcax = Control::find($id);
        $clientex = Clientes::where('id','=', $marcax->id_cliente)->first();
        $admins = Admin::orderBy('nombre', 'asc')->where('estatus','=', '1')->get();
        $clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $monedas = Monedas::orderBy('id', 'asc')->where('estatus','=','1')->get();
        $catalogo_servicios = CatalogoServicios::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        return view('admin.procesos.create',["marcax"=>$marcax, "catalogo_servicios"=>$catalogo_servicios, "bitacoras"=>$bitacoras, "clases"=>$clases, "monedas"=>$monedas, "admins"=>$admins, "clientex"=>$clientex]);
    }

    public function store_servicio(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'id_catalogo_servicio' => 'required',
                'costo' => 'required',
                'tramite' => 'max:150',
                'id_bitacoras' => 'required'
            ]);

        $servicio = new Servicios;
        $servicio->tramite=$request->tramite;
        $servicio->clase=$request->clase;
        $servicio->concepto_costo=$request->concepto_costo;
        $servicio->moneda=$request->moneda;
        $servicio->tipo_cambio=$request->tipo_cambio;
        $servicio->costo_servicio=$request->costo_servicio;
        $servicio->costo_ini=$request->costo_ini;
        $servicio->costo=$request->costo;
        $servicio->saldo=$request->costo;
        $servicio->concepto_venta=$request->concepto_venta;
        $servicio->concepto_operativo=$request->concepto_operativo;
        $servicio->concepto_gestion=$request->concepto_gestion;
        if($request->comision_venta == null)
        {
            $servicio->comision_venta='0';
            $servicio->comision_venta_resante='0';

        }
        else
        {
            $servicio->comision_venta=$request->comision_venta;
            $servicio->comision_venta_restante=$request->comision_venta;
        }
        if($request->comision_operativa == null)
        {
            $servicio->comision_operativa='0';
            $servicio->comision_operativa_restante='0';
        }
        else
        {
            $servicio->comision_operativa=$request->comision_operativa;
            $servicio->comision_operativa_restante=$request->comision_operativa;
        }
        if($request->comision_gestion == null)
        {
            $servicio->comision_gestion='0';
            $servicio->comision_gestion_restante='0';
        }
        else
        {
            $servicio->comision_gestion=$request->comision_gestion;
            $servicio->comision_gestion_restante=$request->comision_gestion;
        }
        $servicio->estatus_tramite=$request->estatus_tramite;
        $servicio->estatus_cobranza=$request->estatus_cobranza;
        $servicio->id_cliente=$request->id_cliente;
        $servicio->id_control=$request->id_control;
        $servicio->id_catalogo_servicio=$request->id_catalogo_servicio;
        $servicio->id_admin=$request->id_admin;
        $servicio->id_bitacoras=$request->id_bitacoras;
        $servicio->alta_control_archivar_boolean='1';
        $mytime = Carbon::now('America/Chihuahua');
        $servicio->alta_control_archivar_fecha=$mytime->toDateTimeString();
        $servicio->alta_control_archivar='Realizado';
        $servicio->aplica_comision_venta = $request->has('aplica_comision_venta') ? 1 : 0;
        $servicio->aplica_comision_operativa = $request->has('aplica_comision_operativa') ? 1 : 0;
        $servicio->aplica_comision_gestion = $request->has('aplica_comision_gestion') ? 1 : 0;

        if($request->id_bitacoras == 1)
        {
            $servicio->avance_total = 17;
        }
        elseif($request->id_bitacoras == 2)
        {
            $servicio->avance_total = 7;
        }
        elseif($request->id_bitacoras == 3)
        {
            $servicio->avance_total = 7;
        }
        elseif($request->id_bitacoras == 4)
        {
            $servicio->avance_total = 8;
        }
        elseif($request->id_bitacoras == 5)
        {
            $servicio->avance_total = 11;
        }

        $servicio->save();
        
        $mensaje = array(
                    'message' => 'El servicio fue creado exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect()->route('procesos.edit-creado', $servicio->id)->with($mensaje);
    }
}
