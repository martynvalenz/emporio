<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Emporio\Model\Bancos;
use Carbon\Carbon;


class BancosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $bancos = Bancos::orderBy('banco','asc')->get();
        return view('admin.cuentas.bancos.index',compact('bancos'));
    }

    public function listado()
    {

    }

    public function buscar()
    {

    }

    public function actualizar($id)
    {

    }
    
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'banco' => 'required|max:50|unique:bancos'
            ]);

        $banco = new Bancos;
        $banco->banco=$request->banco;
        $banco->estatus = $request->has('estatus') ? 1 : 0;
        $banco->save();

        $mensaje = array(
                    'message' => 'El banco fue creado exitosamente.', 
                    'alert-type' => 'success'
                );

        

        return back()->with($mensaje);
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
        $banco = Bancos::findOrFail($id);

        $this->validate($request,
        [
            'banco'=>'required|max:50|unique_with:bancos,'.$banco->id
        ]);
        
        $banco->banco=$request->banco;
        $banco->update();

        $mensaje = array(
                    'message' => 'El banco fue editado exitosamente.', 
                    'alert-type' => 'info'
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
        $banco = Bancos::findOrFail($id);
        $banco->estatus=$request->estatus;
        $banco->update();
        
        $mensaje = array(
                    'message' => 'El estatus del banco fue editado exitosamente.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }
}
