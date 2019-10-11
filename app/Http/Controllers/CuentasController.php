<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Cuentas;
use Emporio\Model\Bancos;
use Carbon\Carbon;
use DB;

class CuentasController extends Controller
{
    public function index()
    {	
        $bancos = Bancos::where('estatus', '=', '1')->get();
        return view('admin.cuentas.index', compact('bancos'));
    }

    public function listar()
    {
        Carbon::setLocale('es');
        $cuentas = DB::table('cuentas as c')
            ->join('bancos as b', 'b.id', '=', 'c.id_banco')
            ->leftjoin('estados_cuenta as es', 'c.id', '=', 'es.id_cuenta')
            ->select('c.id', 'c.alias', 'c.tipo', 'c.id_banco', 'b.banco', 'c.cuenta', 'c.tarjeta', 'c.saldo_inicial', 'c.estatus', 'c.comentarios', 'c.tarjeta', 'c.clabe')
            ->addSelect(DB::raw('sum(es.deposito) as ingreso'))
            ->addSelect(DB::raw('sum(es.retiro) as egreso'))
            ->groupBy('c.id', 'c.alias', 'c.tipo', 'c.id_banco', 'b.banco', 'c.cuenta', 'c.tarjeta', 'c.saldo_inicial', 'c.estatus', 'c.comentarios', 'c.tarjeta', 'c.clabe')
            ->orderBy('c.id', 'asc')

            ->get();

        $saldo_inicial = DB::table('cuentas as c')
            ->select(DB::raw('sum(c.saldo_inicial) as saldo_inicial'))
            ->sum('saldo_inicial');

        $ingresos = DB::table('estados_cuenta')
            ->select(DB::raw('sum(deposito) as deposito'))
            ->sum('deposito');

        $egresos = DB::table('estados_cuenta')
            ->select(DB::raw('sum(retiro) as retiro'))
            ->sum('retiro');

            //return $egresos;

        return view('admin.cuentas.listado', compact('cuentas', 'saldo_inicial', 'ingresos', 'egresos'));
    }
    
    public function create()
    {
        $bancos=DB::table('bancos')
            ->orderBy('banco','ASC')
            ->where('estatus','=','1')
            ->get();
        return view ('admin.cuentas.create', ["bancos"=>$bancos]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'alias'=>'required|max:30|unique:cuentas',
                'tipo' => 'required',
                'cuenta' => 'max:20',
                'clabe' => 'max:30',
                'tarjeta' => 'max:20',
                'saldo_inicial' => 'required|numeric',
                'comentarios' => 'max:128'
            ]);

        $cuenta = new Cuentas;
        $cuenta->alias=$request->alias;
        $cuenta->tipo=$request->tipo;
        $cuenta->id_banco=$request->id_banco;
        $cuenta->cuenta=$request->cuenta;
        $cuenta->clabe=$request->clabe;
        $cuenta->tarjeta=$request->tarjeta;
        $cuenta->saldo_inicial=$request->saldo_inicial;
        $cuenta->comentarios=$request->comentarios;
        $cuenta->estatus = 1;
        $cuenta->save();
        
        return response()->json($cuenta);
    }

    public function edit($id)
    {
        Carbon::setLocale('es');
        $cuenta = Cuentas::find($id);

        return response()->json($cuenta);
    }

    public function update(Request $request, $id)
    {
        $cuenta = Cuentas::findOrFail($id);

        $this->validate($request,
            [
                'alias'=>'required|max:30|unique_with:cuentas,'.$cuenta->id,
                'tipo' => 'required',
                'cuenta' => 'max:20',
                'clabe' => 'max:30',
                'tarjeta' => 'max:20',
                'comentarios' => 'max:128',
                'saldo_inicial' => 'numeric'
            ]);

        
        $cuenta->alias=$request->alias;
        $cuenta->tipo=$request->tipo;
        $cuenta->id_banco=$request->id_banco;
        $cuenta->cuenta=$request->cuenta;
        $cuenta->clabe=$request->clabe;
        $cuenta->tarjeta=$request->tarjeta;
        $cuenta->saldo_inicial=$request->saldo_inicial;
        $cuenta->comentarios=$request->comentarios;
        $cuenta->update();

        return response()->json($cuenta);
    }

    public function destroy(Request $request, $id)
    {
        $cuenta = Cuentas::findOrFail($id);
        $cuenta->estatus=$request->estatus;
        $cuenta->update();
        
        return response()->json($cuenta);
    }
}
