<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Nomina;
use DB;
use Carbon\Carbon;
use Emporio\User;

class DireccionController extends Controller
{
    public function direccion()
    {
    	return view('admin.direccion.index');
    }

    //COMISIONES

    public function comisiones()
    {
        Carbon::setLocale('es');
        $admins = DB::table('users as a')
            ->select('a.id', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('a.estatus','=','1')
            ->where('a.acepta_comision','=','1')
            ->get();

        $url_listar = '/admin/direccion/comisiones-listado/';
        $url_buscar = '/admin/direccion/comisiones-buscar/';
        $url_actualizar = '/admin/direccion/comisiones-actualizar/';

        return view('admin.direccion.comisiones.index', compact('admins', 'url_listar', 'url_buscar', 'url_actualizar'));
    }

    public function listar_usuario($estatus, $id_admin)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where('n.concepto', '=', 'Comisión')
            ->orderBy('n.created_at', 'desc');
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $comisiones->where('n.estatus', '=', $estatus);
            }

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $comisiones->where('n.id_admin', '=', $id_admin);
            }

            $comisiones = $comisiones->paginate(50);

        return view('admin.direccion.comisiones.listado', compact('comisiones'));
        
    }

    public function listar_usuario_total($estatus, $id_admin)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->select(DB::raw('sum(n.monto) as monto_total'))
            ->where('n.concepto', '=', 'Comisión');
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $comisiones->where('n.estatus', '=', $estatus);
            }

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $comisiones->where('n.id_admin', '=', $id_admin);
            }

            $comisiones = $comisiones->sum('n.monto');

        return response()->json($comisiones);
        
    }

    public function buscar_usuario($estatus, $id_admin, $buscar)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where('n.concepto', '=', 'Comisión')
            ->where(function($q) use ($buscar)
            {
                $q->where('n.id_servicio','LIKE',$buscar)
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('n.tipo_comision','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            })
            ->orderBy('n.created_at', 'desc');
            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $comisiones->where('n.estatus', '=', $estatus);
            }

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $comisiones->where('n.id_admin', '=', $id_admin);
            }


            $comisiones = $comisiones->paginate(50);

        return view('admin.direccion.comisiones.listado', compact('comisiones'));
    }

    public function buscar_usuario_total($estatus, $id_admin, $buscar)
    {
        Carbon::setLocale('es');
        $comisiones = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select(DB::raw('sum(n.monto) as monto_total'))
            ->where('n.concepto', '=', 'Comisión')
            ->where(function($q) use ($buscar)
            {
                $q->where('n.id_servicio','LIKE',$buscar)
                ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('n.tipo_comision','LIKE','%'.$buscar.'%')
                ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cli.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
            });

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $comisiones->where('n.estatus', '=', $estatus);
            }

            if($id_admin == '0')
            {
                //
            }
            else if($id_admin > 0)
            {
                $comisiones->where('n.id_admin', '=', $id_admin);
            }


            $comisiones = $comisiones->sum('n.monto');

        return response()->json($comisiones);
    }

    public function actualizar_comision($id)
    {
        Carbon::setLocale('es');
        $comision = DB::table('nomina as n')
            ->leftjoin('servicios as s', 'n.id_servicio', '=', 's.id')
            ->leftjoin('users as ad', 'n.id_admin', '=', 'ad.id')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('clientes as cli', 'cli.id', '=', 's.id_cliente')
            ->leftjoin('clases as cla', 'cla.id', '=', 's.id_clase')
            ->select('n.*', 'cat.clave', 'cat.servicio', 'cla.clave as clase', 's.tramite', 's.estatus_cobranza', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.usuario', 'con.nombre as marca', 'cli.nombre_comercial', 's.saldo')
            ->where('n.id', '=', $id)
            ->first();

        return view('admin.direccion.comisiones.listado-actualizar', compact('comision'));
    }

    public function liberar_comision($id)
    {
        $mytime = Carbon::now('America/Chihuahua');
        $fecha = $mytime->toDateString();

        $comision = Nomina::findOrFail($id);
        $comision->fecha_aplicada = $fecha;
        $comision->listo_comision = 1;
        $comision->estatus = 'Liberada';
        $comision->update();

        return response()->json($comision);
    }

    public function pendiente_comision($id)
    {
        $comision = Nomina::findOrFail($id);
        $comision->fecha_aplicada = null;
        $comision->listo_comision = 0;
        $comision->estatus = 'Pendiente';
        $comision->update();

        return response()->json($comision);
    }

    public function editar_monto_comision(Request $request, $id)
    {
        $this->validate($request,
            [
                'monto' => 'required|min:0|numeric'
            ]);

        $comision = Nomina::findOrFail($id);
        $comision->monto = $request->monto;
        $comision->modificada = $request->modificada;
        $comision->update();

        return response()->json($comision);
    }

    //Sueldos
    public function sueldos()
    {
        Carbon::setLocale('es');
        $admins = DB::table('users as a')
            ->select('a.id', 'a.iniciales', 'a.nombre', 'a.apellido')
            ->where('a.estatus','=','1')
            //->where('a.acepta_comision','=','1')
            ->get();

        $url_listar = '/admin/direccion/sueldos-listado/';
        $url_actualizar = '/admin/direccion/sueldos-actualizar/';

        return view('admin.direccion.sueldos.index', compact('admins', 'url_listar', 'url_actualizar'));
    }

    public function listar($estatus)
    {
        $empleados = DB::table('users as u')
            ->leftjoin('role_user as ru', 'ru.user_id', '=', 'u.id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto', DB::raw('CONCAT(u.nombre," ",u.apellido) as nombre_completo'))
            ->where('u.nomina', '=', '1')
            ->orderBy('u.nombre', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $empleados->where('u.estatus', '=', $estatus);
            }

        $empleados = $empleados->get();

        return view('admin.direccion.sueldos.listado', compact('empleados'));
    }

    public function actualizar($id)
    {
        $empleado = DB::table('users as u')
             ->leftjoin('role_user as ru', 'ru.user_id', '=', 'u.id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto', DB::raw('CONCAT(u.nombre," ",u.apellido) as nombre_completo'))
            ->where('u.id', '=', $id)
            ->first();

        return view('admin.direccion.sueldos.listado-actualizar', compact('empleado'));
    }

    public function sueldos_update(Request $request, $id)
    {
        $this->validate($request,
            [
                'sueldo_diario' => 'required|min:0|numeric',
                'sueldo_quincenal' => 'required|min:0|numeric'
            ]);

        $empleado = User::findOrFail($id);
        $empleado->sueldo_diario = $request->sueldo_diario;
        $empleado->sueldo_quincenal = $request->sueldo_quincenal;
        $empleado->update();

        return response()->json($empleado);
    }

    public function empleado_estatus(Request $request, $id)
    {
        $empleado = User::findOrFail($id);
        $empleado->estatus = $request->estatus;
        $empleado->update();

        return response()->json($empleado);
    }

    public function anio_actual()
    {
    	$anio = Carbon::now()->format('Y');
    	return response()->json($anio);
    }

    public function mensual($anio)
    {
    	$enero_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as enero'))
            ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '01')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

    	$febrero_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as febrero'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '02')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

       	$marzo_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as marzo'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '03')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $abril_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as abril'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '04')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $mayo_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as mayo'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '05')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $junio_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as junio'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '06')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $julio_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as julio'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '07')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $agosto_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as agosto'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '08')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $septiembre_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as septiembre'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '09')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $octubre_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as octubre'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '10')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $noviembre_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as noviembre'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '11')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');

        $diciembre_ingresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.deposito) as diciembre'))
             ->where('e.tipo', '=', 'Ingreso')
            ->whereMonth('e.fecha', '=', '12')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('deposito');


    	$enero_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as enero_egreso'))
            ->where('e.tipo', '=', 'Ingreso')
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '01')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

    	$febrero_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as febrero_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '02')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

       	$marzo_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as marzo_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '03')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $abril_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as abril_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '04')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $mayo_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as mayo_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '05')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $junio_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as junio_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '06')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $julio_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as julio_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '07')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $agosto_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as agosto_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '08')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $septiembre_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as septiembre_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '09')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $octubre_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as octubre_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '10')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $noviembre_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as noviembre_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '11')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');

        $diciembre_egresos = DB::table('estados_cuenta as e')
            ->select(DB::raw('sum(e.retiro) as diciembre_egreso'))
            ->where(function($q)
            {
                $q->where('e.tipo','=','Comision')
                ->orWhere('e.tipo','=','Hogar')
                ->orWhere('e.tipo','=','Despacho')
                ->orWhere('e.tipo','=','Personal');
            })
            ->whereMonth('e.fecha', '=', '12')
            ->whereYear('e.fecha', '=', $anio)
            ->sum('retiro');


            $valores = compact('enero_ingresos', 'febrero_ingresos', 'marzo_ingresos', 'abril_ingresos', 'mayo_ingresos', 'junio_ingresos', 'julio_ingresos', 'agosto_ingresos', 'septiembre_ingresos', 'octubre_ingresos', 'noviembre_ingresos', 'diciembre_ingresos', 'enero_egresos', 'febrero_egresos', 'marzo_egresos', 'abril_egresos', 'mayo_egresos', 'junio_egresos', 'julio_egresos', 'agosto_egresos', 'septiembre_egresos', 'octubre_egresos', 'noviembre_egresos', 'diciembre_egresos');

        return response()->json($valores);
    }
}
