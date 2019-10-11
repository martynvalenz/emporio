<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Monedas;
use Carbon\Carbon;
use DB;

class MonedasController extends Controller
{
    public function index()
    {
    	Carbon::setLocale('es');
        $monedas = Monedas::orderBy('id','asc')->get();
        $paises=DB::table('paises')->orderBy('id','ASC')->get();
        return view('admin.monedas.index',compact('monedas', 'paises'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'clave'=>'required|max:10|unique:monedas',
            'moneda'=>'required|max:50|unique:monedas',
            'conversion'=>'required',
        ]);

        $moneda = new Monedas;
        $moneda->clave=$request->get('clave');
        $moneda->moneda=$request->get('moneda');
        $moneda->pais=$request->get('pais');
        $moneda->conversion=$request->get('conversion');
        $moneda->estatus = $request->has('estatus') ? 1 : 0;
        $moneda->save();

        $mensaje = array(
                    'message' => 'Se creó el tipo de cambio exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function edit($id)
    {
        $moneda = Monedas::findOrFail($id);
        $paises=DB::table('paises')->orderBy('id','ASC')->get();
        return view('admin.monedas.edit', compact('moneda', 'paises'));
    }

    public function update(Request $request, $id)
    {
        $moneda = Monedas::findOrFail($id);

        $this->validate($request,
        [
            'conversion'=>'required',
            'clave'=>'required|max:10|unique_with:monedas,'.$moneda->id,
            'moneda'=>'required|max:50|unique_with:monedas,'.$moneda->id
        ]);

        
        $moneda->clave=$request->get('clave');
        $moneda->moneda=$request->get('moneda');
        $moneda->pais=$request->get('pais');
        $moneda->conversion=$request->get('conversion');
        $moneda->estatus = $request->has('estatus') ? 1 : 0;
        $moneda->update();

        $mensaje = array(
                    'message' => 'Se editó el tipo de cambio exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }
}
