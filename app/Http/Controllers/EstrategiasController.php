<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Estrategias;
use Emporio\Model\Clientes;
use Carbon\Carbon;
use DB;

class EstrategiasController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        return view('admin.estrategias.index');
    }

    public function listado()
    {
        Carbon::setLocale('es');
        $estrategias = DB::table('estrategias as e')
            ->leftjoin('clientes as c', 'c.id_estrategia', '=', 'e.id')
            ->select('e.id', 'e.estrategia', 'e.estatus', 'e.created_at', 'e.updated_at', DB::raw('count(c.id_estrategia) as clientes'))
            ->orderBy('id', 'asc')
            ->groupBy('e.id', 'e.estrategia', 'e.estatus', 'e.created_at', 'e.updated_at')
            ->get();

        return view('admin.estrategias.listado',compact('estrategias'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'estrategia'=>'required|max:50|unique:estrategias'
            ]);

        $estrategia = new Estrategias;
        $estrategia->estrategia=$request->estrategia;
        $estrategia->estatus = $request->estatus;
        $estrategia->save();
        
        return response()->json($estrategia);
    }

    public function edit($id)
    {
        $estrategia = Estrategias::findOrFail($id);
        return response()->json($estrategia);
    }

    public function update(Request $request, $id)
    {
        $estrategia = Estrategias::findOrFail($id);

        $this->validate($request,
        [
            'estrategia'=>'required|max:50|unique_with:estrategias,'.$estrategia->id
        ]);

        
        $estrategia->estrategia=$request->estrategia;
        $estrategia->estatus = $request->estatus;
        $estrategia->update();

        return response()->json($estrategia);
    }

    public function status(Request $request, $id)
    {
        $estrategia = Estrategias::findOrFail($id);
        $estrategia->estatus=$request->estatus;
        $estrategia->update();
        
        return response()->json($estrategia);
    }
}
