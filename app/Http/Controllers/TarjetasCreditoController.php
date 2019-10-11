<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\TarjetasCredito;
use DB;
use Carbon\Carbon;
use Emporio\User;
use Emporio\Model\Proveedores;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\CategoriaEgresos;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\ServiciosPagos;
use Response;
use Illuminate\Support\Collection;

class TarjetasCreditoController extends Controller
{
    public function index()
    {
    	Carbon::setLocale('es');
    	$mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()/*->addMonth(-4)*/;
    	$mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
    	$fecha_inicio = $mytime_inicio->toDateString();
    	$fecha_fin = $mytime_fin->toDateString();

    	$proveedores = Proveedores::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
    	$cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->where('id', '!=', '1')->get();
    	//$formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
    	//$categoria_egresos = CategoriaEgresos::orderBy('categoria','asc')->where('estatus','=','1')->get();
    	$porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
    	$clientes = Clientes::where('estatus', '=', '1')->orderBy('nombre_comercial')->get();

    	$tipo_egreso = 'todo';
    	$variable_estatus = 'pendiente';
    	$url_listar = '/admin/tarjetas-credito/listar/';
    	$url_buscar = '/admin/tarjetas-credito/buscar/';
    	$url_actualizar = '/admin/tarjetas-credito/actualizar/';

    	return view('admin.egresos.tarjetas-credito.index', compact('cuentas', /*'formas_pago',*/ 'porcentaje_iva', 'clientes', 'fecha_inicio', 'fecha_fin', 'tipo_egreso', 'variable_estatus', 'url_listar', 'url_buscar', 'url_actualizar', 'seccion', 'proveedores'));
    }

    public function listado($estatus, $tipo, $cuenta, $fecha_inicio, $fecha_fin)
    {
        Carbon::setLocale('es');
        $egresos = DB::table('tarjetas_credito as t')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select('t.*', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria', 'cu.alias', 'a.iniciales', 'a.nombre', 'a.apellido', 'b.banco')

            ->where('t.created_at', '>=', $fecha_inicio)
            ->where('t.created_at', '<=', $fecha_fin)
            ->orderBy('t.created_at', 'asc');

            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('t.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('t.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('t.id_cuenta', '=', $cuenta);
            }

        $egresos = $egresos->paginate(50);

        $saldo = DB::table('tarjetas_credito as t')
            ->select(DB::raw('sum(t.saldo) as saldo'))
            ->where('t.created_at', '>=', $fecha_inicio)
            ->where('t.created_at', '<=', $fecha_fin);

            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $saldo->where('t.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $saldo->where('t.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $saldo->where('t.id_cuenta', '=', $cuenta);
            }

        $saldo = $saldo->sum('t.saldo');

        return view('admin.egresos.tarjetas-credito.listado', compact('egresos', 'saldo'));
    }

    public function buscar($estatus, $tipo, $cuenta, $fecha_inicio, $fecha_fin, $buscar)
    {
        Carbon::setLocale('es');
        $egresos = DB::table('tarjetas_credito as t')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select('t.*', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria', 'cu.alias', 'a.iniciales', 'a.nombre', 'a.apellido', 'b.banco')

            ->where('t.created_at', '>=', $fecha_inicio)
            ->where('t.created_at', '<=', $fecha_fin)
            ->where(function($q) use ($buscar)
            {
                $q->where('t.id','LIKE',$buscar)
                ->orWhere('t.total','LIKE','%'.$buscar.'%')
                ->orWhere('t.saldo','LIKE','%'.$buscar.'%')
                ->orWhere('t.pagado','LIKE','%'.$buscar.'%')
                ->orWhere('t.id_egreso','LIKE','%'.$buscar.'%')
                ->orWhere('t.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('p.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('p.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%');
            })
            ->orderBy('t.created_at', 'asc');

            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $egresos->where('t.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('t.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $egresos->where('t.id_cuenta', '=', $cuenta);
            }

        $egresos = $egresos->paginate(50);

        $saldo = DB::table('tarjetas_credito as t')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select(DB::raw('sum(t.saldo) as saldo'))
            ->where('t.created_at', '>=', $fecha_inicio)
            ->where('t.created_at', '<=', $fecha_fin)
            ->where(function($q) use ($buscar)
            {
                $q->where('t.id','LIKE',$buscar)
                ->orWhere('t.total','LIKE','%'.$buscar.'%')
                ->orWhere('t.saldo','LIKE','%'.$buscar.'%')
                ->orWhere('t.pagado','LIKE','%'.$buscar.'%')
                ->orWhere('t.id_egreso','LIKE','%'.$buscar.'%')
                ->orWhere('t.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('p.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('p.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%');
            });

            if($estatus == 'todo')
            {
                //
            }
            else if($estatus != 'todo')
            {
                $saldo->where('t.estatus', '=', $estatus);
            }

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $saldo->where('t.tipo', '=', $tipo);
            }

            if($cuenta == 'todo')
            {
                //
            }
            else if($cuenta != 'todo')
            {
                $saldo->where('t.id_cuenta', '=', $cuenta);
            }

        $saldo = $saldo->sum('t.saldo');

        //return $saldo;

        return view('admin.egresos.tarjetas-credito.listado', compact('egresos', 'saldo'));
    }

    public function actualizar($id)
    {
        Carbon::setLocale('es');
        $egreso = DB::table('tarjetas_credito as t')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select('t.*', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria', 'cu.alias', 'a.iniciales', 'a.nombre', 'a.apellido', 'b.banco')
            ->where('t.id', '=', $id)
            ->first();

        return view('admin.egresos.tarjetas-credito.listado-actualizar', compact('egreso'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_categoria' => 'required',
                'porcentaje_iva' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'tipo' => 'required',
                'fecha' => 'required',
                'id_cuenta' => 'required'
            ]);

        $egreso = new TarjetasCredito;
        $egreso->tipo = $request->tipo;
        $egreso->fecha = $request->fecha;
        $egreso->con_iva = $request->con_iva;
        $egreso->concepto = $request->concepto;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->id_categoria = $request->id_categoria;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_cuenta = $request->id_cuenta;
        $egreso->estatus = 'Pendiente';
        $egreso->pagado_boolean = 0;

        if($request->con_iva == 1)
        {
            $val_total = $request->total;
            $porcentaje = $request->porcentaje_iva;
            $egreso->porcentaje_iva = $request->porcentaje_iva;
            $subtotal_calc = $val_total / (1 + ($porcentaje/100));
            $iva_calc = $val_total - $subtotal_calc;

            $egreso->total = $request->total;
            $egreso->subtotal = $subtotal_calc;
            $egreso->iva = $iva_calc;
            $egreso->saldo=$request->total;
            $egreso->pagado = 0;
        }
        else if($request->con_iva == 0)
        {
            $egreso->total=$request->total;
            $egreso->saldo=$request->total;
            $egreso->subtotal=$request->total;
            $egreso->iva=0;
            $egreso->pagado=0;
            $egreso->porcentaje_iva = $request->porcentaje_iva;
        }

        $egreso->save();

        return response()->json($egreso);
    }

    public function edit($id)
    {
        $egreso = DB::table('tarjetas_credito as t')
            ->leftjoin('proveedores as p', 'p.id', '=', 't.id_proveedor')
            ->leftjoin('categoria_egresos as cat', 'cat.id', '=', 't.id_categoria')
            ->leftjoin('cuentas as cu', 'cu.id', '=', 't.id_cuenta')
            ->leftjoin('bancos as b', 'b.id', '=', 'cu.id_banco')
            ->leftjoin('users as a', 'a.id', '=', 't.id_admin')
            ->select('t.*', 'p.nombre_comercial as proveedor', 'p.rfc', 'p.razon_social', 'cat.categoria', 'cu.alias', 'a.iniciales', 'a.nombre', 'a.apellido', 'b.banco')
            ->where('t.id', '=', $id)
            ->first();

        return response()->json($egreso);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_categoria' => 'required',
                'porcentaje_iva' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'tipo' => 'required',
                'fecha' => 'required',
                'id_cuenta' => 'required'
            ]);

        $egreso = TarjetasCredito::findOrFail($id);
        $egreso->tipo = $request->tipo;
        $egreso->fecha = $request->fecha;
        $egreso->con_iva = $request->con_iva;
        $egreso->concepto = $request->concepto;
        $egreso->id_proveedor = $request->id_proveedor;
        $egreso->id_categoria = $request->id_categoria;
        $egreso->id_admin = $request->id_admin;
        $egreso->id_cuenta = $request->id_cuenta;

        if($request->con_iva == 1)
        {
            $val_total = $request->total;
            $porcentaje = $request->porcentaje_iva;
            $egreso->porcentaje_iva = $request->porcentaje_iva;
            $subtotal_calc = $val_total / (1 + ($porcentaje/100));
            $iva_calc = $val_total - $subtotal_calc;

            $egreso->total = $request->total;
            $egreso->subtotal = $subtotal_calc;
            $egreso->iva = $iva_calc;
            $egreso->saldo=$request->total;
            $egreso->pagado = 0;
        }
        else if($request->con_iva == 0)
        {
            $egreso->total=$request->total;
            $egreso->saldo=$request->total;
            $egreso->subtotal=$request->total;
            $egreso->iva=0;
            $egreso->pagado=0;
            $egreso->porcentaje_iva = $request->porcentaje_iva;
        }

        $egreso->update();

        return response()->json($egreso);
    }

    public function cancelar($id)
    {
        $egreso = TarjetasCredito::findOrFail($id);
        $egreso->estatus = 'Cancelado';
        $egreso->fecha = null;
        $egreso->pagado_boolean = 0;
        $egreso->update();
        
        return response()->json($egreso);
    }

    public function activar($id)
    {
        $egreso = TarjetasCredito::findOrFail($id);
        $egreso->estatus = 'Pendiente';
        
        $egreso->update();
        
        return response()->json($egreso);
    }
}
