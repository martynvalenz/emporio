<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\User;
use Emporio\Model\Estados;
use Emporio\Model\Paises;
use Emporio\Model\Proveedores;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class ProveedoresController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');

            $query=trim($request->get('searchText'));
            $estados = Estados::orderBy('estado','asc')->where('estatus','=','1')->get();
            $paises = Paises::orderBy('id','asc')->where('estatus','=','1')->get();

            $proveedores=DB::table('proveedores as p')
                ->leftjoin('estados as e', 'p.id_estado', '=', 'e.id')
                ->leftjoin('paises as pa', 'p.id_pais', '=', 'pa.id')
                ->leftjoin('users as a', 'p.id_admin', '=', 'a.id')
                ->leftjoin('estados_cuenta as es', 'es.id_proveedor', '=', 'p.id')
                ->select('p.id', 'p.nombre_comercial', 'p.razon_social', 'p.rfc', 'p.calle', 'p.numero', 'p.numero_int', 'p.colonia', 'p.cp', 'p.localidad', 'p.municipio', 'e.estado', 'pa.pais', 'a.nombre', 'a.apellido', 'a.iniciales', 'p.id_admin', 'p.id_estado', 'p.id_pais', 'p.created_at', 'p.updated_at', 'p.contacto', 'p.telefono', 'p.telefono2', 'p.correo', 'p.comentarios', 'p.estatus', DB::raw('sum(es.retiro) as retiros'))
                ->where('p.id','LIKE','%'.$query.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$query.'%')
                ->orWhere('p.razon_social','LIKE','%'.$query.'%')
                ->orWhere('p.rfc','LIKE','%'.$query.'%')
                ->orWhere('p.calle','LIKE','%'.$query.'%')
                ->orWhere('p.colonia','LIKE','%'.$query.'%')
                ->orWhere('p.cp','LIKE','%'.$query.'%')
                ->orWhere('p.localidad','LIKE','%'.$query.'%')
                ->orWhere('p.municipio','LIKE','%'.$query.'%')
                ->orWhere('e.estado','LIKE','%'.$query.'%')
                ->orWhere('pa.pais','LIKE','%'.$query.'%')
                ->orWhere('p.correo','LIKE','%'.$query.'%')
                ->orWhere('p.telefono','LIKE','%'.$query.'%')
                ->orWhere('p.telefono2','LIKE','%'.$query.'%')
                ->orWhere('a.nombre','LIKE','%'.$query.'%')
                ->orWhere('a.apellido','LIKE','%'.$query.'%')
                ->orWhere('a.iniciales','LIKE','%'.$query.'%')
                ->orWhere('p.contacto','LIKE','%'.$query.'%')
                ->orderBy('p.razon_social', 'asc')
                //->groupBy('p.id')
                ->groupBy('p.id', 'p.nombre_comercial', 'p.razon_social', 'p.rfc', 'p.calle', 'p.numero', 'p.numero_int', 'p.colonia', 'p.cp', 'p.localidad', 'p.municipio', 'e.estado', 'pa.pais', 'a.nombre', 'a.apellido', 'a.iniciales', 'p.id_admin', 'p.id_estado', 'p.id_pais', 'p.created_at', 'p.updated_at', 'p.contacto', 'p.telefono', 'p.telefono2', 'p.correo', 'p.comentarios', 'p.estatus')
                ->paginate(30);


            return view('admin.proveedores.index',["searchText"=>$query, "estados"=>$estados, "paises"=>$paises, "proveedores"=>$proveedores]);
        }
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial' => 'max:100|unique:proveedores|required',
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
                'contacto' => 'max:50',
                'correo' => 'max:100',
            ]);

        if($request)
        {
            $prov = new Proveedores;
            $prov->nombre_comercial=$request->nombre_comercial;
            $prov->razon_social=$request->razon_social;
            $prov->rfc = $request->rfc;
            $prov->calle=$request->calle;
            $prov->numero=$request->numero;
            $prov->numero_int=$request->numero_int;
            $prov->colonia=$request->colonia;
            $prov->cp=$request->cp;
            $prov->localidad=$request->localidad;
            $prov->municipio=$request->municipio;
            $prov->id_estado=$request->id_estado;
            $prov->id_pais=$request->id_pais;
            $prov->telefono=$request->telefono;
            $prov->telefono2=$request->telefono2;
            $prov->correo=$request->correo;
            $prov->contacto=$request->contacto;
            $prov->id_admin=$request->id_admin;
            $prov->comentarios=$request->comentarios;
            $prov->estatus = $request->has('estatus') ? 1 : 0;
            
            $prov->save();
            
            $mensaje = array(
                        'message' => 'Se creó el proveedor exitosamente.', 
                        'alert-type' => 'success'
                    );

            return back()->with($mensaje);
        }
        else
        {
            $mensaje = array(
                        'message' => 'No se pudo crear el proveedor, revise de nuevo el formulario.', 
                        'alert-type' => 'danger'
                    );

            return back()->with($mensaje);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $prov = Proveedores::findOrFail($id);
        
        $this->validate($request,
            [
                'nombre_comercial'=>'required|max:100|unique_with:proveedores,'.$prov->id,
                'razon_social' => 'max:100',
                'rfc' => 'max:15',
                'calle' => 'max:50',
                'numero' => 'max:20',
                'numero_int' => 'max:20',
                'colonia' => 'max:50',
                'cp' => 'max:5',
                'localidad' => 'max:50',
                'municipio' => 'max:50',
                'correo' => 'max:100',
            ]);

        
        $prov->nombre_comercial=$request->nombre_comercial;
        $prov->razon_social=$request->razon_social;
        $prov->rfc = $request->rfc;
        $prov->calle=$request->calle;
        $prov->numero=$request->numero;
        $prov->numero_int=$request->numero_int;
        $prov->colonia=$request->colonia;
        $prov->cp=$request->cp;
        $prov->localidad=$request->localidad;
        $prov->municipio=$request->municipio;
        $prov->id_estado=$request->id_estado;
        $prov->id_pais=$request->id_pais;
        $prov->telefono=$request->telefono;
        $prov->telefono2=$request->telefono2;
        $prov->correo=$request->correo;
        $prov->contacto=$request->contacto;
        $prov->comentarios=$request->comentarios;
        $prov->update();
        
        $mensaje = array(
                    'message' => 'Se editó el proveedor exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $prov = Proveedores::findOrFail($id);
        $prov->estatus=$request->estatus;
        $prov->update();
        
        $mensaje = array(
                    'message' => 'El estatus del proveedor fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }
}
