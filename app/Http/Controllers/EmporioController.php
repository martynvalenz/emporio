<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Emporio;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use DB;

class EmporioController extends Controller
{
    public function index()
    {
        $emporio = Emporio::get()->first();
        $estados=DB::table('estados')->orderBy('estado','ASC')->get();
        $paises=DB::table('paises')->get();
        return view('admin.fiscal.fiscal', ["emporio"=>$emporio, "estados"=>$estados, "paises"=>$paises]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //$emporio = Emporio::find($id);
        //return view('admin.fiscal.fiscal', compact('emporio'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'nombre_comercial'=>'required|max:50',
            'razon_social'=>'required|max:100',
            'rfc'=>'max:15',
        ]);

        $emporio = Emporio::findOrFail($id);
        $emporio->nombre_comercial=$request->get('nombre_comercial');
        $emporio->razon_social=$request->get('razon_social');
        $emporio->rfc=$request->get('rfc');
        $emporio->calle=$request->get('calle');
        $emporio->numero=$request->get('numero');
        $emporio->numero_int=$request->get('numero_int');
        $emporio->colonia=$request->get('colonia');
        $emporio->cp=$request->get('cp');
        $emporio->localidad=$request->get('localidad');
        $emporio->municipio=$request->get('municipio');
        $emporio->estado=$request->get('estado');
        $emporio->pais=$request->get('pais');
        $emporio->telefono=$request->get('telefono');
        $emporio->telefono2=$request->get('telefono2');
        $emporio->telefono3=$request->get('telefono3');
        $emporio->pagina_web=$request->get('pagina_web');

        /*if($request->hasFile('logo'))
        {
            $filename= $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/images/logo', $filename);
            $usuario->logo=$filename;
        }
        else
        {
            //$usuario->imagen='c10.jpg';
        }*/

        $emporio->update();

        $mensaje = array(
                    'message' => 'Los datos de la empresa fueron editados exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect()->back()->with($mensaje);
    }

    public function destroy($id)
    {
        //
    }
}
