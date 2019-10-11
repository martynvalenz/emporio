<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clientes;
use Emporio\Model\RazonSocial;
use Emporio\Model\Estados;
use Emporio\Model\Paises;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class ClienteRazonesController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');

            $query=trim($request->get('searchText'));
            $clientes = Clientes::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
            $estados = Estados::orderBy('estado','asc')->where('estatus','=','1')->get();
            $paises = Paises::orderBy('id','asc')->where('estatus','=','1')->get();

            $razones_sociales=DB::table('razones_sociales as raz')
                ->leftjoin('clientes as c', 'raz.id_cliente', '=', 'c.id')
                ->leftjoin('estados as e', 'raz.id_estado', '=', 'e.id')
                ->leftjoin('paises as p', 'raz.id_pais', '=', 'p.id')
                ->leftjoin('users as a', 'raz.id_admin', '=', 'a.id')
                ->select('raz.id', 'raz.razon_social', 'raz.rfc', 'raz.calle', 'raz.numero', 'raz.numero_int', 'raz.colonia', 'raz.cp', 'raz.localidad', 'raz.municipio', 'e.estado', 'p.pais', 'c.nombre_comercial', 'a.nombre', 'a.apellido', 'a.iniciales', 'raz.id_admin', 'raz.id_cliente', 'raz.id_estado', 'raz.id_pais', 'raz.created_at', 'raz.updated_at', 'raz.telefono', 'raz.subcarpeta', 'raz.correo', 'raz.comentarios', 'raz.estatus')
                ->where('raz.id','LIKE','%'.$query.'%')
                ->orWhere('c.nombre_comercial','LIKE','%'.$query.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$query.'%')
                ->orWhere('raz.rfc','LIKE','%'.$query.'%')
                ->orWhere('raz.calle','LIKE','%'.$query.'%')
                ->orWhere('raz.colonia','LIKE','%'.$query.'%')
                ->orWhere('raz.cp','LIKE','%'.$query.'%')
                ->orWhere('raz.localidad','LIKE','%'.$query.'%')
                ->orWhere('raz.municipio','LIKE','%'.$query.'%')
                ->orWhere('e.estado','LIKE','%'.$query.'%')
                ->orWhere('p.pais','LIKE','%'.$query.'%')
                ->orWhere('raz.correo','LIKE','%'.$query.'%')
                ->orWhere('raz.telefono','LIKE','%'.$query.'%')
                ->orWhere('a.nombre','LIKE','%'.$query.'%')
                ->orWhere('a.apellido','LIKE','%'.$query.'%')
                ->orWhere('a.iniciales','LIKE','%'.$query.'%')
                ->orderBy('raz.razon_social', 'asc')
                //->groupBy('raz.id', 'raz.razon_social', 'raz.rfc', 'raz.calle', 'raz.numero', 'raz.numero_int', 'raz.colonia', 'raz.cp', 'raz.localidad', 'raz.municipio', 'e.estado', 'p.pais', 'c.nombre_comercial', 'a.nombre', 'a.apellido', 'a.iniciales', 'raz.id_admin', 'raz.id_cliente', 'raz.id_estado', 'raz.id_pais', 'raz.created_at', 'raz.updated_at', 'raz.telefono', 'raz.subcarpeta', 'raz.correo', 'raz.comentarios', 'raz.estatus')
                ->paginate(30);


            return view('admin.clientes.razones_sociales.index',["clientes"=>$clientes, "searchText"=>$query, "estados"=>$estados, "paises"=>$paises, "razones_sociales"=>$razones_sociales]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'razon_social' => 'max:100',
                'rfc' => 'max:15',
                'calle' => 'max:50',
                'numero' => 'max:20',
                'numero_int' => 'max:20',
                'colonia' => 'max:50',
                'cp' => 'max:5',
                'localidad' => 'max:50',
                'municipio' => 'max:50',
                'telefono' => 'max:25',
                'subcarpeta' => 'max:300',
                'correo' => 'max:100',
            ]);

        if($request)
        {
            $razon = new RazonSocial;
            $razon->razon_social=$request->razon_social;
            $razon->rfc = $request->rfc;
            $razon->calle=$request->calle;
            $razon->numero=$request->numero;
            $razon->numero_int=$request->numero_int;
            $razon->colonia=$request->colonia;
            $razon->cp=$request->cp;
            $razon->localidad=$request->localidad;
            $razon->municipio=$request->municipio;
            $razon->id_estado=$request->id_estado;
            $razon->id_pais=$request->id_pais;
            $razon->telefono=$request->telefono;
            $razon->correo=$request->correo;
            $razon->subcarpeta=$request->subcarpeta;
            $razon->id_cliente=$request->id_cliente;
            $razon->id_estado=$request->id_estado;
            $razon->id_pais=$request->id_pais;
            $razon->id_admin=$request->id_admin;
            $razon->comentarios=$request->comentarios;
            $razon->estatus = $request->has('estatus') ? 1 : 0;
            
            $razon->save();
            
            $mensaje = array(
                        'message' => 'Se creó la razón social exitosamente.', 
                        'alert-type' => 'success'
                    );

            return back()->with($mensaje);
        }
        else
        {
            $mensaje = array(
                        'message' => 'No se pudo crear la razón social, revise de nuevo el formulario.', 
                        'alert-type' => 'danger'
                    );

            return back()->with($mensaje);
        }
    }

    public function insertar_razon(Request $request)
    {
        $this->validate($request,
            [
                'razon_social' => 'max:100|required|unique_with:razones_sociales,id_cliente',
                'rfc' => 'max:15|required|unique_with:razones_sociales,id_cliente',
                'id_cliente' => 'required'
            ]);

        if($request)
        {
            $razon = new RazonSocial;
            $razon->razon_social=$request->razon_social;
            $razon->rfc = $request->rfc;
            $razon->id_cliente=$request->id_cliente;
            $razon->id_admin=$request->id_admin;
            $razon->estatus = $request->estatus;
            
            $razon->save();
        }

            return response()->json($razon);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'razon_social' => 'max:100',
                'rfc' => 'max:15',
                'calle' => 'max:50',
                'numero' => 'max:20',
                'numero_int' => 'max:20',
                'colonia' => 'max:50',
                'cp' => 'max:5',
                'localidad' => 'max:50',
                'municipio' => 'max:50',
                'telefono' => 'max:25',
                'subcarpeta' => 'max:300',
                'correo' => 'max:100',
            ]);

        $razon = RazonSocial::findOrFail($id);
        $razon->razon_social=$request->razon_social;
        $razon->rfc = $request->rfc;
        $razon->calle=$request->calle;
        $razon->numero=$request->numero;
        $razon->numero_int=$request->numero_int;
        $razon->colonia=$request->colonia;
        $razon->cp=$request->cp;
        $razon->localidad=$request->localidad;
        $razon->municipio=$request->municipio;
        $razon->id_estado=$request->id_estado;
        $razon->id_pais=$request->id_pais;
        $razon->telefono=$request->telefono;
        $razon->correo=$request->correo;
        $razon->subcarpeta=$request->subcarpeta;
        $razon->id_cliente=$request->id_cliente;
        $razon->id_estado=$request->id_estado;
        $razon->id_pais=$request->id_pais;
        $razon->id_admin=$request->id_admin;
        $razon->comentarios=$request->comentarios;
        $razon->update();
        
        $mensaje = array(
                    'message' => 'Se editó la razón social exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function destroy(Request $request, $id)
    {
        $razon = RazonSocial::findOrFail($id);
        $razon->estatus=$request->estatus;
        $razon->update();
        
        $mensaje = array(
                    'message' => 'Se cambió el estatus de la razón social.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }

    public function subcarpeta(Request $request, $id)
    {
        
            $this->validate($request,
                [
                    'subcarpeta'=>'required|max:300',
                ]);

        if($request)
        {

            $razon = RazonSocial::findOrFail($id);
            $razon->subcarpeta=$request->subcarpeta;
            $razon->update();

            $mensaje = array(
                        'message' => 'La URL de carpeta se agregó exitosamente.', 
                        'alert-type' => 'success'
                    );  

            return back()->with($mensaje);
        }
        else
        {
            $mensaje = array(
                        'message' => 'La URL de carpeta no se pudo agregar, revise de nuevo el formulario.', 
                        'alert-type' => 'danger'
                    );  

            return back()->with($mensaje);
        }
    }

    public function correo(Request $request, $id)
    {
        
            $this->validate($request,
                [
                    'correo'=>'required|max:100',
                ]);

        if($request)
        {

            $razon = RazonSocial::findOrFail($id);
            $razon->correo=$request->correo;
            $razon->update();

            $mensaje = array(
                        'message' => 'El correo de facturación se agregó exitosamente.', 
                        'alert-type' => 'success'
                    );  

            return back()->with($mensaje);
        }
        else
        {
            $mensaje = array(
                        'message' => 'El correo no se pudo agregar, revise de nuevo el formulario.', 
                        'alert-type' => 'danger'
                    );  

            return back()->with($mensaje);
        }
    }
}
