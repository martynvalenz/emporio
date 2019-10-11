<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Emporio\Model\Nomina;
use Emporio\User;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\EstadosCuenta;
use DB;

class NominaController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $admins = DB::table('users as a')
            ->select('a.id', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('a.estatus','=','1')
            ->where('a.acepta_comision','=','1')
            ->get();

        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();

        $variable_estatus = 'Liberada';
        $url_listar = '/admin/nomina-listar/';
        $url_buscar = '/admin/nomina-buscar/';
        $url_actualizar = '/admin/nomina/actualizar/';

        return view('admin.egresos.nomina.index', compact('admins', 'cuentas', 'formas_pago', 'variable_estatus', 'url_listar', 'url_buscar'/*', url_actualizar'*/));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
