<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\User;
use Emporio\Model\Proveedores;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\CategoriaEgresos;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class CuentasPorPagarController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('es');
        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()/*->addMonth(-4)*/;
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();

        $proveedores = Proveedores::orderBy('nombre_comercial','asc')->where('estatus','=','1')->get();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->get();
        $categoria_egresos = CategoriaEgresos::orderBy('categoria','asc')->where('estatus','=','1')->get();
        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();

        $tipo_egreso = 'Despacho';
        $url_listar = '/admin/cuentas-por-pagar/listar/';
        $url_buscar = '/admin/cuentas-por-pagar/buscar/';
        $url_actualizar = '/admin/cuentas-por-pagar/actualizar/';

        return view('admin.egresos.cxp.index', compact('fecha_inicio', 'fecha_fin', 'proveedores', 'cuentas', 'formas_pago', 'categoria_egresos', 'porcentaje_iva', 'seccion', 'url_listar', 'url_buscar', 'url_actualizar', 'tipo_egreso'));
    }

    public function listado($tipo)
    {
        Carbon::setLocale('es');
        $egresos=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->select('e.*', 'a.iniciales', 'a.nombre', 'a.apellido', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria')
            ->where('e.tipo', '!=', 'Ingreso')
            ->where('e.estatus', '=', 'Pendiente')
            ->orderBy('e.created_at', 'asc');

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

        $egresos = $egresos->paginate(50);

        $total = DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->select(DB::raw('sum(e.total) as total'))
            ->where('e.estatus', '=', 'Pendiente')
            ->where('e.tipo', '!=', 'Ingreso');

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $total->where('e.tipo', '=', $tipo);
            }

        $total = $total->sum('e.total');

        return view('admin.egresos.cxp.listado', compact('egresos', 'total'));
    }

    public function buscar($tipo, $buscar)
    {
        Carbon::setLocale('es');
        $egresos=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->select('e.*', 'a.iniciales', 'a.nombre', 'a.apellido', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria')
            ->where('e.estatus', '=', 'Pendiente')
            ->where('e.tipo', '!=', 'Ingreso')
            ->where(function($q) use ($buscar)
            {
                $q->where('e.id','LIKE',$buscar)
                ->orWhere('e.tipo','LIKE','%'.$buscar.'%')
                ->orWhere('e.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('e.folio','LIKE','%'.$buscar.'%')
                ->orWhere('e.cheque','LIKE','%'.$buscar.'%')
                ->orWhere('e.movimiento','LIKE','%'.$buscar.'%')
                ->orWhere('e.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('e.total','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%');
            })
            ->orderBy('e.created_at', 'asc');

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $egresos->where('e.tipo', '=', $tipo);
            }

        $egresos = $egresos->paginate(50);

        $total = DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->select(DB::raw('sum(e.total) as total'))
            ->where('e.estatus', '=', 'Pendiente')
            ->where('e.tipo', '!=', 'Ingreso')
            ->where(function($q) use ($buscar)
            {
                $q->where('e.id','LIKE',$buscar)
                ->orWhere('e.tipo','LIKE','%'.$buscar.'%')
                ->orWhere('e.concepto','LIKE','%'.$buscar.'%')
                ->orWhere('e.folio','LIKE','%'.$buscar.'%')
                ->orWhere('e.cheque','LIKE','%'.$buscar.'%')
                ->orWhere('e.movimiento','LIKE','%'.$buscar.'%')
                ->orWhere('e.subtotal','LIKE','%'.$buscar.'%')
                ->orWhere('e.total','LIKE','%'.$buscar.'%')
                ->orWhere('p.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('cat.categoria','LIKE','%'.$buscar.'%');
            });

            if($tipo == 'todo')
            {
                //
            }
            else if($tipo != 'todo')
            {
                $total->where('e.tipo', '=', $tipo);
            }

        $total = $total->sum('e.total');

        return view('admin.egresos.cxp.listado', compact('egresos', 'total'));
    }

    public function actualizar($id)
    {
        Carbon::setLocale('es');
        $egreso=DB::table('estados_cuenta as e')
            ->leftjoin('users as a', 'e.id_admin', '=', 'a.id')
            ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
            ->leftjoin('categoria_egresos as cat', 'e.id_categoria', '=', 'cat.id')
            ->select('e.*', 'a.iniciales', 'a.nombre', 'a.apellido', 'p.nombre_comercial', 'p.rfc', 'p.razon_social', 'cat.categoria')
            ->where('e.id', '=', $id)
            ->first();

        return view('admin.egresos.cxp.listado-actualizar', compact('egreso'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_categoria' => 'required',
                'porcentaje_iva' => 'required|numeric|min:1',
                'total' => 'required|numeric|min:0',
                'tipo' => 'required'
            ]);

        $egreso = new EstadosCuenta;
        $egreso->tipo=$request->tipo;
        $egreso->id_categoria=$request->id_categoria;
        $egreso->id_proveedor=$request->id_proveedor;
        $egreso->concepto=$request->concepto;
        $egreso->con_iva = $request->con_iva;
        $egreso->pagado = 0;
        $egreso->id_admin = $request->id_admin;
        $egreso->estatus = 'Pendiente';

        if($request->total == '')
        {
            $egreso->total = 0;
            $egreso->subtotal = 0;
            $egreso->iva = 0;
        }
        else
        {
            if($request->con_iva == '1')
            {
                $val_total = $request->total;
                $porcentaje = $request->porcentaje_iva;
                $egreso->porcentaje_iva = $request->porcentaje_iva;
                $subtotal_calc = $val_total / (1 + ($porcentaje/100));
                $iva_calc = $val_total - $subtotal_calc;

                $egreso->total = $request->total;
                $egreso->subtotal = $subtotal_calc;
                $egreso->iva = $iva_calc;
            }
            else
            {
                $egreso->total=$request->total;
                $egreso->subtotal=$request->total;
                $egreso->iva=0;
                //$egreso->porcentaje_iva=0;
            }
        }
        
        $egreso->save();

        return response()->json($egreso);
    }

    public function update(Request $request, $id)
    {
        $egreso = EstadosCuenta::findOrFail($id);

        $this->validate($request,
        [
            'id_categoria' => 'required',
            'porcentaje_iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'tipo' => 'required'
        ]);

        $egreso->tipo=$request->tipo;
        $egreso->id_categoria=$request->id_categoria;
        $egreso->id_proveedor=$request->id_proveedor;
        $egreso->concepto=$request->concepto;
        $egreso->con_iva = $request->con_iva;
        $egreso->pagado = 0;
        $egreso->id_admin = $request->id_admin;
        $egreso->estatus = 'Pendiente';

        if($request->total == '')
        {
            $egreso->total = 0;
            $egreso->subtotal = 0;
            $egreso->iva = 0;
        }
        else
        {
            if($request->con_iva == '1')
            {
                $val_total = $request->total;
                $porcentaje = $request->porcentaje_iva;
                $egreso->porcentaje_iva = $request->porcentaje_iva;
                $subtotal_calc = $val_total / (1 + ($porcentaje/100));
                $iva_calc = $val_total - $subtotal_calc;

                $egreso->total = $request->total;
                $egreso->subtotal = $subtotal_calc;
                $egreso->iva = $iva_calc;
            }
            else
            {
                $egreso->total=$request->total;
                $egreso->subtotal=$request->total;
                $egreso->iva=0;
                //$egreso->porcentaje_iva=0;
            }
        }
        
        $egreso->update();

        return response()->json($egreso);
    }

    public function pagar(Request $request, $id)
    {
        $this->validate($request,
        [
            'id_forma_pago' => 'required',
            'id_cuenta' => 'required',
            'porcentaje_iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'fecha' => 'required'
        ]);

        $egreso = EstadosCuenta::findOrFail($id);

        if($request->total == '')
        {
            $egreso->total = 0;
            $egreso->subtotal = 0;
            $egreso->iva = 0;
        }
        else
        {
            if($request->con_iva == '1')
            {
                $val_total = $request->total;
                $egreso->retiro = $request->total;
                $porcentaje = $request->porcentaje_iva;
                $egreso->porcentaje_iva=$request->porcentaje_iva;
                $subtotal_calc = $val_total / (1 + ($porcentaje/100));
                $iva_calc = $val_total - $subtotal_calc;

                $egreso->total = $request->total;
                $egreso->subtotal = $subtotal_calc;
                $egreso->iva = $iva_calc;
            }
            else
            {
                $egreso->total=$request->total;
                $egreso->retiro = $request->total;
                $egreso->subtotal=$request->total;
                $egreso->iva=0;
                //$egreso->porcentaje_iva=0;
            }
        }

        $egreso->estatus='Pagado';
        $egreso->pagado_boolean=1;
        $egreso->con_iva = $request->con_iva;
        $egreso->id_cuenta=$request->id_cuenta;
        $egreso->id_forma_pago=$request->id_forma_pago;
        $egreso->fecha=$request->fecha;
        $egreso->concepto=$request->concepto;
        $egreso->id_admin=$request->id_admin;

        $egreso->update();

        return response()->json($egreso);
    }

    public function cancelar($id)
    {
        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->estatus = 'Cancelado';
        $egreso->retiro = 0;
        $mytime = Carbon::now('America/Chihuahua');
        $egreso->cancelado_at=$mytime->toDateTimeString();
        $egreso->fecha = null;
        $egreso->update();
        
        return response()->json($egreso);
    }

    public function activar(Request $request, $id)
    {
        $egreso = EstadosCuenta::findOrFail($id);

        if($request->pagado_boolean == 1)
        {
            $egreso->estatus = 'Pagado';
            $egreso->retiro = $request->total;
            $mytime = Carbon::now('America/Chihuahua');
            $egreso->fecha=$mytime->toDateString();
        }
        else if($request->pagado_boolean == 0)
        {
            $egreso->estatus = 'Pendiente';
        }
        
        $egreso->cancelado_at = null;
        $egreso->update();
        
        return response()->json($egreso);
    }

    public function pendiente($id)
    {
        $egreso = EstadosCuenta::findOrFail($id);
        $egreso->estatus = 'Pendiente';
        $egreso->pagado_boolean = 0;
        $egreso->retiro = 0;
        $egreso->cancelado_at = null;
        $egreso->fecha = null;
        $egreso->update();
        
        return response()->json($egreso);
    }
}
