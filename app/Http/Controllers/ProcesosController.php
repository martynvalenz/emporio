<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\Control;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\Clases;
use Emporio\User;
use Emporio\Model\Monedas;
use Emporio\Model\Facturas;
use Emporio\Model\FacturasDetalles;
use Emporio\Model\RazonSocial;
use Emporio\Model\Nomina;
use Emporio\Model\PorcentajeIVA;
use Emporio\Model\Estrategias;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\CobranzaDetalles;
use Emporio\Model\ServiciosComentarios;
use Emporio\Model\ServiciosProceso;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use DB;

class ProcesosController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $mytime_inicio = Carbon::now('America/Chihuahua')->startOfMonth()->addMonth(-1);
        $mytime_fin = Carbon::now('America/Chihuahua')->endOfMonth();
        $mytime = Carbon::now('America/Chihuahua');
        $fecha_inicio = $mytime_inicio->toDateString();
        $fecha_fin = $mytime_fin->toDateString();
        $fecha_inicio_anio = Carbon::now('America/Chihuahua')->startOfYear()->toDateString();
        $fecha_fin_anio = Carbon::now('America/Chihuahua')->endOfYear()->toDateString();

        $porcentaje_iva = PorcentajeIVA::orderBy('porcentaje_iva','asc')->first();
        $cuentas = Cuentas::orderBy('id','asc')->where('estatus','=','1')->get();
        $formas_pago = FormasPago::orderBy('id','asc')->where('estatus','=','1')->where('id', '!=', '4')->get();
        $estrategias = Estrategias::orderBy('id','asc')->where('estatus','=','1')->get();
        $monedas = Monedas::orderBy('id', 'asc')->get();
        $admins = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->where('responsabilidad','=','1')->get();
        $admins_comision = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->where('responsabilidad','=','1')->where('acepta_comision', '=', '1')->get();
        $clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $catalogo_servicios = DB::table('catalogo_servicios as cat')
            ->join('monedas as m', 'm.clave', '=', 'cat.moneda')
            ->select('cat.*', 'm.conversion')
            ->orderBy('cat.clave', 'asc')
            ->where('cat.estatus','=','1')
            ->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        //$tipo_vista = 'Control';
        /*$url_listar = '/admin/procesos-listar/';
        $url_buscar = '/admin/procesos-buscar/';
        $url_actualizar = '/admin/procesos/actualizar/';

        $url_listar_facturas = '/admin/facturas-listado/';
        $url_buscar_facturas = '/admin/facturas-buscar/';
        $url_actualizar_facturas = '/admin/facturas-actualizar/';*/

        return view('admin.procesos.index', compact('monedas', 'admins', 'admins_comision', 'porcentaje_iva', 'cuentas', 'formas_pago', 'variable_estatus', 'clases', 'bitacoras', 'estrategias', /*'url_listar', 'url_buscar', 'url_actualizar', */'fecha_inicio', 'fecha_fin', 'catalogo_servicios', 'fecha_inicio_anio', 'fecha_fin_anio'/*, 'url_listar_facturas', 'url_buscar_facturas', 'url_actualizar_facturas'*/));
    }

    public function listar($estatus, $tramite, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        if($folio == 0)
        {
            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
                //->where('s.fecha', '>=', $fecha_inicio)
                //->where('s.fecha', '<=', $fecha_fin)
                ->where('s.historico', '=', '0')
                ->orderBy('s.fecha', 'desc')
                ->orderBy('s.created_at', 'desc');

                if($estatus == 'todos')
                {
                    //
                }
                else if($estatus != 'todos')
                {
                    $servicios->where('s.estatus_cobranza', '=', $estatus);
                }

                if($tramite == 'todos')
                {
                    //
                }
                else if($tramite == 'sin Bitacora')
                {
                    $servicios->where('s.mostrar_bitacora', '=', '0');
                }
                else
                {
                    $servicios->where('s.estatus_registro', '=', $tramite);
                }

                $servicios = $servicios->paginate(50);

            $facturas = DB::table('facturas_detalles as det')
                ->join('facturas as f', 'det.id_factura', '=', 'f.id')
                ->join('servicios as s', 'det.id_servicio', '=', 's.id')
                ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo', 'f.id_cliente', 'f.pagado_terminado', 'f.saldo', 'f.pagado', 'f.total', 'f.porcentaje_iva', 'f.iva', 'f.subtotal', 'f.con_iva', 'f.pagado_terminado')
                ->where('f.estatus', '!=', 'Cancelado')
                ->orderBy('f.created_at', 'asc')
                ->get();
        }
        else
        {
            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->leftjoin('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
                ->leftjoin('facturas as f', 'det.id_factura', '=', 'f.id')
                ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
                //->where('s.fecha', '>=', $fecha_inicio)
                //->where('s.fecha', '<=', $fecha_fin)
                ->where('s.historico', '=', '0')
                ->where(function($k) use ($folio)
                {
                    $k->where('f.folio_factura', 'LIKE', '%'.$folio.'%')
                    ->orWhere('f.folio_recibo', 'LIKE', '%'.$folio.'%');
                })
                ->orderBy('s.fecha', 'desc')
                ->orderBy('s.created_at', 'desc');

                if($estatus == 'todos')
                {
                    //
                }
                else if($estatus != 'todos')
                {
                    $servicios->where('s.estatus_cobranza', '=', $estatus);
                }

                if($tramite == 'todos')
                {
                    //
                }
                else if($tramite == 'sin Bitacora')
                {
                    $servicios->where('s.mostrar_bitacora', '=', '0');
                }
                else
                {
                    $servicios->where('s.estatus_registro', '=', $tramite);
                }

                $servicios = $servicios->paginate(50);

            $facturas = DB::table('facturas_detalles as det')
                ->join('facturas as f', 'det.id_factura', '=', 'f.id')
                ->join('servicios as s', 'det.id_servicio', '=', 's.id')
                ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo', 'f.id_cliente', 'f.pagado_terminado', 'f.saldo', 'f.pagado', 'f.total', 'f.porcentaje_iva', 'f.iva', 'f.subtotal', 'f.con_iva', 'f.pagado_terminado')
                ->where('f.estatus', '!=', 'Cancelado')
                ->orderBy('f.created_at', 'asc')
                ->get();
        }

        return view('admin.procesos.servicios.listado', compact('servicios', 'facturas'));
    }

    public function buscar($estatus, $tramite, $buscar, $fecha_inicio, $fecha_fin, $folio)
    {
        Carbon::setLocale('es');

        if($folio == 0)
        {
            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                //->leftjoin('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
                //->leftjoin('facturas as f', 'f.id', '=', 'det.id_factura')
                ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
                //->where('s.estatus_cobranza', '=', $estatus)
                // ->where('s.fecha', '>=', $fecha_inicio)
                // ->where('s.fecha', '<=', $fecha_fin)
                ->where('s.historico', '=', '0')
                ->where(function($q) use ($buscar)
                {
                    $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                    ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
                    ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                    ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                    ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                    ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
                    ->orWhere('s.costo','LIKE',$buscar)
                    ->orWhere('s.id','LIKE',$buscar)
                    //->orWhere('f.folio_factura','LIKE',$buscar)
                    //->orWhere('f.folio_recibo','LIKE',$buscar)
                    ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
                })
                ->orderBy('s.fecha', 'desc')
                ->orderBy('s.created_at', 'desc');

                if($estatus == 'todos')
                {
                    //
                }
                else if($estatus != 'todos')
                {
                    $servicios->where('s.estatus_cobranza', '=', $estatus);
                }

                if($tramite == 'todos')
                {
                    //
                }
                else if($tramite == 'sin Bitacora')
                {
                    $servicios->where('s.mostrar_bitacora', '=', '0');
                }
                else
                {
                    $servicios->where('s.estatus_registro', '=', $tramite);
                }

                $servicios = $servicios->paginate(50);

            $facturas = DB::table('facturas_detalles as det')
                ->join('facturas as f', 'det.id_factura', '=', 'f.id')
                ->join('servicios as s', 'det.id_servicio', '=', 's.id')
                ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo', 'f.id_cliente', 'f.pagado_terminado', 'f.saldo', 'f.pagado', 'f.total', 'f.porcentaje_iva', 'f.iva', 'f.subtotal', 'f.con_iva', 'f.pagado_terminado')
                ->where('f.estatus', '!=', 'Cancelado')
                ->orderBy('f.created_at', 'asc')
                ->get();
        }
        else
        {
            $servicios=DB::table('servicios as s')
                ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
                ->leftjoin('control as con', 's.id_control', '=', 'con.id')
                ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
                ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
                ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->leftjoin('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
                ->leftjoin('facturas as f', 'det.id_factura', '=', 'f.id')
                ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
                // ->where('s.fecha', '>=', $fecha_inicio)
                // ->where('s.fecha', '<=', $fecha_fin)
                ->where('s.historico', '=', '0')
                ->where(function($k) use ($folio)
                {
                    $k->where('f.folio_factura', 'LIKE', '%'.$folio.'%')
                    ->orWhere('f.folio_recibo', 'LIKE', '%'.$folio.'%');
                })
                ->where(function($q) use ($buscar)
                {
                    $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                    ->orWhere('con.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('cat.servicio','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.clave','LIKE','%'.$buscar.'%')
                    ->orWhere('bit.bitacora','LIKE','%'.$buscar.'%')
                    ->orWhere('s.id_admin','LIKE','%'.$buscar.'%')
                    ->orWhere('ad.iniciales','LIKE','%'.$buscar.'%')
                    ->orWhere('ad.nombre','LIKE','%'.$buscar.'%')
                    ->orWhere('ad.apellido','LIKE','%'.$buscar.'%')
                    ->orWhere('cla.clase','LIKE','%'.$buscar.'%')
                    ->orWhere('s.costo','LIKE',$buscar)
                    ->orWhere('s.id','LIKE',$buscar)
                    //->orWhere('f.folio_factura','LIKE',$buscar)
                    //->orWhere('f.folio_recibo','LIKE',$buscar)
                    ->orWhere('s.tramite','LIKE','%'.$buscar.'%');
                })
                ->orderBy('s.fecha', 'desc')
                ->orderBy('s.created_at', 'desc');

                if($estatus == 'todos')
                {
                    //
                }
                else if($estatus != 'todos')
                {
                    $servicios->where('s.estatus_cobranza', '=', $estatus);
                }

                if($tramite == 'todos')
                {
                    //
                }
                else if($tramite == 'sin Bitacora')
                {
                    $servicios->where('s.mostrar_bitacora', '=', '0');
                }
                else
                {
                    $servicios->where('s.estatus_registro', '=', $tramite);
                }

                $servicios = $servicios->paginate(50);

            $facturas = DB::table('facturas_detalles as det')
                ->join('facturas as f', 'det.id_factura', '=', 'f.id')
                ->join('servicios as s', 'det.id_servicio', '=', 's.id')
                ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo', 'f.id_cliente', 'f.pagado_terminado', 'f.saldo', 'f.pagado', 'f.total', 'f.porcentaje_iva', 'f.iva', 'f.subtotal', 'f.con_iva', 'f.pagado_terminado')
                ->where('f.estatus', '!=', 'Cancelado')
                ->orderBy('f.created_at', 'asc')
                ->get();
        }

        return view('admin.procesos.servicios.listado', compact('servicios', 'facturas'));
    }

    public function servicioActualizar($id_servicio)
    {
        Carbon::setLocale('es');
        $servicio=DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
            ->where('s.id', '=', $id_servicio)
            ->first();

        $facturas = DB::table('facturas as f')
            ->join('facturas_detalles as det', 'det.id_factura', '=', 'f.id')
            ->join('servicios as s', 'det.id_servicio', '=', 's.id')
            ->select('det.id_servicio', 'det.id_factura', 'f.folio_factura', 'f.folio_recibo', 'f.id_cliente', 'f.pagado_terminado', 'f.saldo', 'f.pagado', 'f.total', 'f.porcentaje_iva', 'f.iva', 'f.subtotal', 'f.con_iva', 'f.pagado_terminado')
            ->where('f.estatus', '!=', 'Cancelado')
            ->where('det.id_servicio', '=', $id_servicio)
            ->orderBy('f.created_at', 'asc')
            ->get();

        return view('admin.procesos.servicios.listado-actualizar', compact('servicio', 'facturas'));
    }

    public function cliente(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial'=>'required|max:100|unique:clientes',
                'id_estrategia' => 'required'
            ]);

        $cliente = new Clientes;
        $cliente->nombre_comercial=$request->nombre_comercial;
        $cliente->id_admin=$request->id_admin;
        $cliente->id_estrategia=$request->id_estrategia;
        $cliente->estatus = '1';
        $cliente->save();

        return response()->json($cliente);
    }

    public function marca(Request $request)
    {
        $this->validate($request,
            [
                'nombre'=>'required|max:512|unique_with:control,id_cliente',
                'id_cliente'=>'required'
            ]);

        $cliente = new Control;
        $cliente->nombre=$request->nombre;
        $cliente->id_cliente=$request->id_cliente;
        $cliente->estatus = $request->estatus;
        $cliente->descripcion = $request->descripcion;
        $cliente->id_admin = $request->id_admin;
        $cliente->save();

        return response()->json($cliente);
    }

    public function cargar_clientes()
    {
        $clientes = Clientes::where('estatus', '=', '1')->orderBy('nombre_comercial', 'asc')->get();
        return response()->json($clientes);
    }

    public function cargar_servicios()
    {
        $servicios = DB::table('catalogo_servicios as cat')
            ->join('monedas as m', 'm.clave', '=', 'cat.moneda')
            ->select('cat.id', 'cat.concepto', 'cat.moneda', 'cat.costo', 'cat.comision_venta', 'cat.comision_venta_monto', 'cat.comision_operativa', 'cat.comision_operativa_monto', 'cat.comision_gestion', 'cat.comision_gestion_monto', 'm.conversion', 'cat.id_categoria_bitacora', 'cat.costo_servicio', 'cat.clave', 'cat.servicio', 'cat.porcentaje_venta', 'cat.porcentaje_operativa', 'cat.porcentaje_gestion', 'cat.avance_total')
            ->where('cat.estatus', '=', '1')
            ->orderBy('cat.clave', 'asc')
            ->get();
        return response()->json($servicios);
    }

    public function cargar_clases()
    {
        $clientes = Clases::where('estatus', '=', '1')->orderBy('clase', 'asc')->get();
        return response()->json($clientes);
    }

    public function cargar_admins()
    {
        $clientes = User::where('estatus', '=', '1')->where('responsabilidad','=','1')->orderBy('clase', 'asc')->get();
        return response()->json($clientes);
    }

    public function listadoProceso($id)
    {
        $requisitos = DB::table('servicio_requisitos as s')
            ->join('requisitos as r', 'r.id', '=', 's.id_requisitos')
            ->select('s.*', 'r.categoria', 'r.requisito')
            ->where('s.id_catalogo_servicio', '=', $id)
            ->get();

        return view('admin.procesos.servicios.listado-proceso', compact('requisitos'));
    }

    public function insertarProceso(Request $request)
    {
        $proceso = json_decode($request->string, true);

        ServiciosProceso::insert($proceso);

        return response()->json($proceso);
    }

    public function avance_total(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);

        $servicio->avance_total = $request->avance_total;
        $servicio->avance = 0;
        $servicio->update();

        return response()->json($servicio);
    }

    public function create()
    {
        Carbon::setLocale('es');
        $clientex='';
        $marcax='';
        $clientes = Clientes::orderBy('nombre_comercial', 'asc')
            ->where('estatus','=','1')
            ->get(['id', 'nombre_comercial']);
        $admins = User::orderBy('nombre', 'asc')->where('estatus','=', '1')->get();
        $clases = Clases::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $monedas = Monedas::orderBy('id', 'asc')->where('estatus','=','1')->get();
        $catalogo_servicios = CatalogoServicios::orderBy('clave', 'asc')->where('estatus','=','1')->get();
        $bitacoras = CategoriaBitacoras::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        return view('admin.procesos.create',["clientes"=>$clientes, "catalogo_servicios"=>$catalogo_servicios, "bitacoras"=>$bitacoras, "clases"=>$clases, "monedas"=>$monedas, "admins"=>$admins, "clientex"=>$clientex, "marcax"=>$marcax]);

        //return Response::json(["catalogo_servicios"=>$catalogo_servicios, "bitacoras"=>$bitacoras, "clases"=>$clases, "monedas"=>$monedas, "admins"=>$admins, "clientex"=>$clientex, "marcax"=>$marcax, "clientes"=>$clientes]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'id_catalogo_servicio' => 'required',
                'costo' => 'required|min:0',
                'tramite' => 'max:150',
                'id_bitacoras' => 'required',
                'id_admin' => 'required',
                //'id_sesion' => 'required',
                'tipo_cambio' => 'required|min:1',
                'fecha' => 'required'
            ]);

        $mytime = Carbon::now('America/Chihuahua');
        $fecha = $mytime->toDateString();

        $servicio = new Servicios;
        $servicio->tramite=$request->tramite;
        $servicio->fecha=$request->fecha;
        $servicio->id_clase=$request->id_clase;
        $servicio->concepto_costo=$request->concepto_costo;
        $servicio->moneda=$request->moneda;
        $servicio->tipo_cambio=$request->tipo_cambio;
        $servicio->asignar_costo_servicio=$request->asignar_costo_servicio;
        $servicio->costo_servicio=$request->costo_servicio;
        $servicio->costo_ini=$request->costo_ini;
        $servicio->porcentaje_descuento=$request->porcentaje_descuento;
        $servicio->descuento=$request->descuento;
        $servicio->costo=$request->costo;
        $servicio->saldo=$request->costo;
        $servicio->cobrado='0';
        $servicio->facturado='0';
        $servicio->concepto_venta=$request->concepto_venta;
        $servicio->concepto_operativo=$request->concepto_operativo;
        $servicio->concepto_gestion=$request->concepto_gestion;
        $servicio->mostrar_bitacora=$request->mostrar_bitacora;
        $servicio->avance_total=$request->avance_total;

        if($request->concepto_venta == '')
        {
            $servicio->comision_venta='0';
            $servicio->comision_venta_restante='0';
        }
        else
        {
            $servicio->comision_venta=$request->comision_venta;
            $servicio->comision_venta_restante=$request->comision_venta;
            $servicio->porcentaje_comision_venta=$request->porcentaje_comision_venta;
        }

        if($request->concepto_operativo == '')
        {
            $servicio->comision_operativa='0';
            $servicio->comision_operativa_restante='0';
        }
        else
        {
            $servicio->comision_operativa=$request->comision_operativa;
            $servicio->comision_operativa_restante=$request->comision_operativa;
            $servicio->porcentaje_comision_operativa=$request->porcentaje_comision_operativa;
        }

        if($request->concepto_gestion == '')
        {
            $servicio->comision_gestion='0';
            $servicio->comision_gestion_restante='0';
        }
        else
        {
            $servicio->comision_gestion=$request->comision_gestion;
            $servicio->comision_gestion_restante=$request->comision_gestion;
            $servicio->porcentaje_comision_gestion=$request->porcentaje_comision_gestion;
        }

        $servicio->estatus_registro = 'Pendiente';

        if($request->costo == 0)
        {
            $servicio->cobrado_terminado = 1;
            $servicio->estatus_cobranza = 'Pagado';
            $servicio->fecha_pagado=$mytime->toDateString();
        }
        else if($request->costo > 0)
        {
            $servicio->cobrado_terminado = 0;
            $servicio->estatus_cobranza = 'Pendiente';
        }

        //$servicio->estatus_cobranza=$request->estatus_cobranza;
        $servicio->id_cliente=$request->id_cliente;
        $servicio->id_control=$request->id_control;
        $servicio->id_catalogo_servicio=$request->id_catalogo_servicio;
        $servicio->id_admin=$request->id_admin;
        $servicio->id_bitacoras=$request->id_bitacoras;
        $servicio->aplica_comision_venta = $request->aplica_comision_venta;
        $servicio->aplica_comision_operativa = $request->aplica_comision_operativa;
        $servicio->aplica_comision_gestion = $request->aplica_comision_gestion;
        $servicio->logo_url = 'logo-marca.png';

        if($request->id_bitacoras == 3)
        {
            $fecha_vencimiento = $mytime->addDays(30)->toDateString();
            $servicio->fecha_vencimiento = $fecha_vencimiento;
        }
        else if($request->id_bitacoras == 5)
        {

        }

        $servicio->save();

        return response()->json($servicio);
    }

    public function post(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'id_catalogo_servicio' => 'required',
                'costo' => 'required|min:0',
                'tramite' => 'max:150',
                'id_bitacoras' => 'required',
                'id_admin' => 'required',
                //'id_sesion' => 'required',
                'tipo_cambio' => 'required|min:1',
                'fecha' => 'required'
            ]);

        $mytime = Carbon::now('America/Chihuahua');
        $fecha = $mytime->toDateString();

        $servicio = new Servicios;
        $servicio->tramite = $request->tramite;
        $servicio->fecha=$request->fecha;
        $servicio->id_clase = $request->id_clase;
        $servicio->concepto_costo = $request->concepto_costo;
        $servicio->moneda = $request->moneda;
        $servicio->tipo_cambio = $request->tipo_cambio;
        $servicio->asignar_costo_servicio = $request->asignar_costo_servicio_check;
        $servicio->costo_servicio = $request->costo_servicio;
        $servicio->costo_ini = $request->costo_ini;
        $servicio->porcentaje_descuento = $request->porcentaje_descuento;
        $servicio->descuento = $request->descuento;
        $servicio->costo = $request->costo;
        $servicio->saldo = $request->costo;
        $servicio->cobrado = '0';
        $servicio->facturado = '0';
        $servicio->concepto_venta = $request->concepto_venta;
        $servicio->concepto_operativo = $request->concepto_operativo;
        $servicio->concepto_gestion = $request->concepto_gestion;
        $servicio->mostrar_bitacora = $request->mostrar_bitacora;
        $servicio->avance_total = $request->avance_total;

        if($request->concepto_venta == '')
        {
            $servicio->comision_venta = '0';
            $servicio->comision_venta_restante = '0';
        }
        else
        {
            $servicio->comision_venta = $request->comision_venta;
            $servicio->comision_venta_restante = $request->comision_venta;
            $servicio->porcentaje_comision_venta = $request->porcentaje_comision_venta;
        }

        if($request->concepto_operativo == '')
        {
            $servicio->comision_operativa = '0';
            $servicio->comision_operativa_restante = '0';
        }
        else
        {
            $servicio->comision_operativa = $request->comision_operativa;
            $servicio->comision_operativa_restante = $request->comision_operativa;
            $servicio->porcentaje_comision_operativa = $request->porcentaje_comision_operativa;
        }

        if($request->concepto_gestion == '')
        {
            $servicio->comision_gestion = '0';
            $servicio->comision_gestion_restante = '0';
        }
        else
        {
            $servicio->comision_gestion = $request->comision_gestion;
            $servicio->comision_gestion_restante = $request->comision_gestion;
            $servicio->porcentaje_comision_gestion = $request->porcentaje_comision_gestion;
        }

        $servicio->estatus_registro = 'Pendiente';

        if($request->costo == 0)
        {
            $servicio->cobrado_terminado = 1;
            $servicio->estatus_cobranza = 'Pagado';
            $servicio->fecha_pagado=$mytime->toDateString();
        }
        else if($request->costo > 0)
        {
            $servicio->cobrado_terminado = 0;
            $servicio->estatus_cobranza = 'Pendiente';
        }

        //$servicio->estatus_cobranza=$request->estatus_cobranza;
        $servicio->id_cliente = $request->id_cliente;
        $servicio->id_control = $request->id_control;
        $servicio->id_catalogo_servicio = $request->id_catalogo_servicio;
        $servicio->id_admin = $request->id_admin;
        $servicio->id_bitacoras = $request->id_bitacoras;
        $servicio->aplica_comision_venta = $request->aplica_comision_venta;
        $servicio->aplica_comision_operativa = $request->aplica_comision_operativa;
        $servicio->aplica_comision_gestion = $request->aplica_comision_gestion;
        $servicio->logo_url = 'logo-marca.png';

        if($request->id_bitacoras == 3)
        {
            $fecha_vencimiento = $mytime->addDays(30)->toDateString();
            $servicio->fecha_vencimiento = $fecha_vencimiento;
        }
        else if($request->id_bitacoras == 5)
        {

        }

        $servicio->save();

        $mensaje = array(
                    'message' => 'Se creó el servicio de forma manual.'.$servicio->id, 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function edit_creado($id)
    {
        Carbon::setLocale('es');
        $servicio = Servicios::find($id);

        $comisiones=Nomina::orderBy('id','ASC')
            ->where('id_servicio','=', $servicio->id)
            ->where('concepto', '=', 'Comisión')
            ->get();

        $admins=User::orderBy('nombre')
            ->where('estatus', '=', '1')
            ->where('acepta_comision', '=', '1')
            ->get();

        return view('admin.procesos.comisiones', compact('servicio', 'comisiones', 'admins'));
    }   

    public function getDetalles(Request $request)
    {
        Carbon::setLocale('es');
        $detalles = DB::table('facturas_detalles as det')
            ->join('servicios as s', 'det.id_servicio', '=', 's.id')
            ->join('facturas as f', 'det.id_factura', '=', 'f.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('det.id', 'det.id_factura', 'det.id_servicio', 'f.folio_factura', 'f.folio_recibo', 's.tramite', 'cla.clave as clase', DB::raw('DATE_FORMAT(det.created_at, "%d-%b-%Y") as created_at_formated'), 'det.monto')
            ->where('det.id_servicio', $request->get('id'))
            ->orderBy('det.created_at', 'asc')
            ->get();
        return json_encode($detalles);
    }

    public function descuentoCliente($id_cliente, $id_catalogo_servicio)
    {
        $porcentaje_descuento = DB::table('descuentos as d')
            ->select('d.porcentaje_descuento')
            ->where('d.id_cliente', '=', $id_cliente)
            ->where('d.id_catalogo_servicio', '=', $id_catalogo_servicio)
            ->first();

        return response()->json($porcentaje_descuento);
    }

    public function actualizarTipoCambio(Request $request, $clave)
    {
        $mytime = Carbon::now('America/Chihuahua');
        $updated_at = $mytime->toDateTimeString();

        $moneda = DB::table('monedas')
            ->where('clave', '=', $clave)
            ->update(
                [   
                    'conversion' => $request->conversion_nueva,
                    'updated_at' => $updated_at
                ]);

        return response()->json($moneda);
    }

    public function edit($id)
    {
        //$servicio = Servicios::findOrFail($id);
        $servicio = DB::table('servicios as s')
            ->leftjoin('clientes as c', 's.id_cliente', '=', 'c.id')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('users as ad', 's.id_admin', '=', 'ad.id')
            ->leftjoin('categoria_bitacoras as bit', 's.id_bitacoras', '=', 'bit.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.*', 'cla.clave as clase', 'cat.clave', 'cat.servicio', DB::raw('con.nombre as marca'), 'c.nombre_comercial', DB::raw('bit.clave as clave_bit'), 'bit.bitacora', 'ad.nombre', 'ad.apellido', 'ad.iniciales', 'ad.email', 'cat.costo_servicio')
            ->where('s.id', '=', $id)
            ->first();

        return response()->json($servicio);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'id_catalogo_servicio' => 'required',
                'costo' => 'required',
                'tramite' => 'max:150',
                'id_bitacoras' => 'required',
                'id_admin' => 'required', 
                'fecha' => 'required'
            ]);

        $servicio = Servicios::findOrFail($id);
        $servicio->tramite=$request->tramite;
        $servicio->fecha=$request->fecha;
        $servicio->id_clase=$request->id_clase;
        $servicio->concepto_costo=$request->concepto_costo;
        $servicio->moneda=$request->moneda;
        $servicio->tipo_cambio=$request->tipo_cambio;
        $servicio->costo_servicio=$request->costo_servicio;
        $servicio->costo_ini=$request->costo_ini;
        $servicio->porcentaje_descuento=$request->porcentaje_descuento;
        $servicio->descuento=$request->descuento;
        $servicio->costo=$request->costo;
        $servicio->saldo=$request->costo - $request->cobrado;
        $servicio->concepto_venta=$request->concepto_venta;
        $servicio->concepto_operativo=$request->concepto_operativo;
        $servicio->concepto_gestion=$request->concepto_gestion;
        $servicio->mostrar_bitacora=$request->mostrar_bitacora;

        if($request->concepto_venta == '')
        {
            $servicio->comision_venta='0';
            $servicio->comision_venta_restante='0';
        }
        else
        {
            $servicio->comision_venta=$request->comision_venta;
            $servicio->comision_venta_restante=$request->comision_venta;
            $servicio->porcentaje_comision_venta=$request->porcentaje_comision_venta;
        }

        if($request->concepto_operativo == '')
        {
            $servicio->comision_operativa='0';
            $servicio->comision_operativa_restante='0';
        }
        else
        {
            $servicio->comision_operativa=$request->comision_operativa;
            $servicio->comision_operativa_restante=$request->comision_operativa;
            $servicio->porcentaje_comision_operativa=$request->porcentaje_comision_operativa;
        }

        if($request->concepto_gestion == '')
        {
            $servicio->comision_gestion='0';
            $servicio->comision_gestion_restante='0';
        }
        else
        {
            $servicio->comision_gestion=$request->comision_gestion;
            $servicio->comision_gestion_restante=$request->comision_gestion;
            $servicio->porcentaje_comision_gestion=$request->porcentaje_comision_gestion;
        }

        $servicio->id_cliente=$request->id_cliente;
        $servicio->id_control=$request->id_control;
        $servicio->id_catalogo_servicio=$request->id_catalogo_servicio;
        $servicio->id_admin=$request->id_admin;
        $servicio->id_bitacoras=$request->id_bitacoras;
        $servicio->aplica_comision_venta = $request->aplica_comision_venta;
        $servicio->aplica_comision_operativa = $request->aplica_comision_operativa;
        $servicio->aplica_comision_gestion = $request->aplica_comision_gestion;

        if($request->costo = 0)
        {
            $servicio->cobrado_terminado = 1;
            $servicio->estatus_cobranza = 'Pagado';
            $mytime = Carbon::now('America/Chihuahua');
            $servicio->fecha_pagado=$mytime->toDateString();
        }
        /*else if($request->costo > 0)
        {
            if($request->cobrado >= $request->costo)
            {
                if($request->cobrado_terminado == 1)
                {

                }
                else if($request->cobrado_terminado == 0)
                {
                    $servicio->cobrado_terminado = 1;
                    $servicio->estatus_cobranza = 'Pagado';
                }
            }
            else if($request->cobrado < $request->costo)
            {
                $servicio->cobrado_terminado = 0;
                $servicio->estatus_cobranza = 'Pendiente';
            }
        }*/

        $servicio->update();
        
        return response()->json($servicio);
    }

    public function getStatus($id)
    {
        $servicio = DB::table('servicios as s')
            ->join('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->select('s.id', 'cat.clave', 'con.nombre', 's.tramite', 's.id_clase', 's.id_cliente', 'c.nombre_comercial', 's.costo', 's.facturado', DB::raw('s.costo - s.facturado as monto_pendiente'), 's.facturado_terminado', 's.cobrado_terminado', 's.facturado')
            ->where('s.id', '=', $id)
            ->first();

        return response()->json($servicio);
    }

    public function destroy(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        $servicio->estatus_registro=$request->estatus;
        //$servicio->mostrar_bitacora=$request->mostrar_bitacora;
        $servicio->update();

        return response()->json($servicio);
    }


    public function insertar_cliente(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial' => 'max:100|required|unique:clientes'
            ]);

        if($request)
        {
            $cliente = new Clientes;
            $cliente->nombre_comercial=$request->nombre_comercial;
            $cliente->id_admin=$request->id_admin;
            $cliente->id_estrategia=$request->id_estrategia;
            $cliente->estatus = 1;
            
            $cliente->save();
        }

            return response()->json($cliente);
    }

    public function getClientes()
    {
        $clientes = Clientes::orderBy('nombre_comercial', 'asc')
            ->where('estatus','=','1')
            ->get(['id', 'nombre_comercial']);
        return response()->json($clientes);
    }

    public function insertar_marca(Request $request)
    {
        $this->validate($request,
            [
                'nombre' => 'required|unique_with:control,id_cliente',
                'id_cliente' => 'required'
            ]);

        if($request)
        {
            $marca = new Control;
            $marca->nombre=$request->nombre;
            $marca->id_admin=$request->id_admin;
            $marca->id_cliente=$request->id_cliente;
            $marca->estatus = 1;
            
            $marca->save();
        }

            return response()->json($marca);
    }

    public function getMarcas($id)
    {
        $marcas = Control::where('id_cliente', '=', $id)
            ->where('estatus', '=', '1')
            ->orderBy('nombre', 'asc')
            ->get();
        return Response::json($marcas);
    }

    public function getFacturas($id)
    {
        $factura = DB::table('facturas as f')
            ->select('f.id', 'f.tipo', 'f.folio_factura', 'f.folio_recibo', 'f.subtotal', 'f.porcentaje_iva', 'f.iva', 'f.total', 'f.pagado', 'f.saldo', 'f.estatus')
            ->where('f.id_cliente', '=', $id)
            ->where('f.pagado_terminado', '=', '0')
            ->orderBy('f.id', 'asc')
            ->get();

        return response()->json($factura);
    }

    //Cargar datos del servicio
    public function getServicios($id)
    {
        $servicios_clientes = DB::table('servicios as s')
            ->join('clientes as c', 'c.id', '=', 's.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 's.id_control')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 'cat.clave', 'con.nombre', 's.tramite', 'cla.clave as clase')
            ->where('c.id', '=', $id)
            ->orderBy('cat.clave')
            ->get();
        return $servicios_clientes;
    }

    //Comentarios
    public function comentarios($id_servicio)
    {
        Carbon::setLocale('es');
        $comentarios = DB::table('servicios_comentarios as com')
            ->leftjoin('servicios as s', 's.id', '=', 'com.id_servicio')
            ->leftjoin('users as ad', 'ad.id', '=', 'com.id_admin')
            //->leftjoin('control as c', 'c.id', '=', 'com.id_control')
            ->select('com.id', 'com.comentario', 'com.created_at', 'com.updated_at', 'com.id_servicio', 'com.id_admin', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.imagen', 's.id as id_serv')
            ->where('com.id_servicio', '=', $id_servicio)
            ->orderBy('com.created_at', 'asc')
            ->get();

        return view('admin.procesos.servicios.historial', compact('comentarios'));
    }

    public function insertarComentario(Request $request)
    {
        $comentario = new ServiciosComentarios;
        $comentario->comentario = $request->comentario;
        $comentario->id_servicio = $request->id_servicio;
        $comentario->id_estatus = $request->id_estatus;
        $comentario->id_admin = $request->id_admin;
        $comentario->save();

        return response()->json($comentario);
    }

    public function eliminarComentario($id)
    {
        $comentario = ServiciosComentarios::findOrFail($id);
        $comentario->delete();

        return response()->json($comentario);
    }

    public function actualizarComentario(Request $request, $id)
    {
        $comentario = ServiciosComentarios::findOrFail($id);
        $comentario->id_estatus = $request->id_estatus;
        $comentario->id_servicio = $request->id_servicio;
        $comentario->comentario = $request->comentario;
        $comentario->save();

        return response()->json($comentario);
    }


    //Facturación
    public function cargarFacturas($id_cliente)
    {
        $facturas = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->select('f.id', 'f.id_cliente', 'f.folio_factura','f.subtotal', 'f.porcentaje_iva', 'f.iva', 'f.total', 'f.pagado', 'f.saldo', 'f.folio_recibo')
            ->where('f.id_cliente', '=', $id_cliente)
            ->where('f.pagado_terminado', '=', '0')
            ->where('f.estatus', '=', 'Pendiente')
            ->where('f.tipo', '=', 'Factura')
            ->orderBy('f.created_at', 'asc')
            ->get();

        return response()->json($facturas);
    }

    public function cargarRecibos($id_cliente)
    {
        $recibos = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->select('f.id', 'f.id_cliente', 'f.folio_factura', 'f.folio_recibo')
            ->where('f.id_cliente', '=', $id_cliente)
            ->where('f.pagado_terminado', '=', '0')
            ->where('f.estatus', '=', 'Pendiente')
            ->where('f.tipo', '=', 'Recibo')
            ->orderBy('f.created_at', 'asc')
            ->get();

        return response()->json($recibos);
    }

    public function cargarDatosFactura($id)
    {
        $factura = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->select('f.id', 'f.id_cliente', 'f.folio_factura','f.subtotal', 'f.porcentaje_iva', 'f.iva', 'f.total', 'f.pagado', 'f.saldo', 'f.folio_recibo', 'f.fecha')
            ->where('f.id', '=', $id)
            ->first();

        return response()->json($factura);          
    }

    public function cargarRazonSocial($id_cliente)
    {
        $razones_sociales = DB::table('razones_sociales as r')
            ->join('clientes as c', 'c.id', '=', 'r.id_cliente')
            ->select('r.id', 'r.id_cliente', 'r.razon_social', 'r.rfc')
            ->where('r.id_cliente', '=', $id_cliente)
            ->orderBy('r.created_at', 'desc')
            ->get();

        return response()->json($razones_sociales);
    }

    public function serviciosPendientes($id_cliente)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('servicios as s')
            ->join('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->join('control as co', 'co.id', '=', 's.id_control')
            ->join('users as a', 'a.id', '=', 's.id_admin')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado')
            ->where('s.facturado_terminado', '=', '0')
            ->where('s.estatus_cobranza', '=', 'Pendiente')
            ->where('s.id_cliente', '=', $id_cliente)
            ->orderBy('s.created_at', 'asc')
            ->get();

        $monto_pendiente = DB::table('servicios as s')
            ->select(DB::raw('sum(s.costo) as suma_total'))
            ->where('s.facturado_terminado', '=', '0')
            ->where('s.estatus_cobranza', '=', 'Pendiente')
            ->where('s.id_cliente', '=', $id_cliente)
            ->sum('s.costo');

        return view('admin.procesos.servicios-pendientes', compact('servicios', 'monto_pendiente'));
    }

    public function cargarDetalles($id_factura)
    {
        Carbon::setLocale('es');
        $detalles = DB::table('facturas_detalles as det')
            ->join('servicios as s', 's.id', '=', 'det.id_servicio')
            ->leftjoin('control as c', 'c.id', '=', 's.id_control')
            ->leftjoin('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->select('det.id', 'det.id_servicio', 'cat.clave', 'cat.servicio', 's.tramite', 's.id_clase', 'c.nombre as marca', 'det.created_at', 'det.monto')
            ->where('det.id_factura', '=', $id_factura)
            ->orderBy('det.created_at', 'desc')
            ->get();

        return view('admin.procesos.servicios-facturados', compact('detalles'));  
    }

    public function crearFactura(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'folio_factura'=>'required|unique:facturas',
                'fecha'=>'required',
                'id_admin' => 'required',
                'porcentaje_iva' => 'required|min:0'
            ]);

        $factura = new Facturas;
        $factura->folio_factura = $request->folio_factura; 
        $factura->fecha = $request->fecha;
        $factura->subtotal = 0;
        $factura->iva = 0;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->pagado = 0;
        $factura->total = 0;
        $factura->saldo = 0;
        $factura->estatus = 'Pendiente';
        $factura->tipo = 'Factura';
        $factura->id_cliente = $request->id_cliente;
        $factura->id_razon_social = $request->id_razon_social;
        $factura->id_admin = $request->id_admin;
        $factura->comentarios = $request->comentarios;
        $factura->save();

        return response()->json($factura);
    }

    public function actualizarFactura(Request $request, $id_factura)
    {
        $factura = Facturas::findOrFail($id_factura);

        $this->validate($request,
            [
                'fecha'=>'required'
            ]);

        if($request->con_iva == 1)
        {
            $iva = $request->subtotal * ($request->porcentaje_iva / 100);
            $subtotal = $request->subtotal;
            $total = $subtotal + $iva;
        }
        else if($request->con_iva == 0)
        {
            $iva = 0;
            $subtotal = $request->subtotal;
            $total = $subtotal + $iva;
        }

        $factura->fecha = $request->fecha;
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->total = $total;
        $factura->id_razon_social = $request->id_razon_social;
        $factura->comentarios = $request->comentarios;
        $factura->save();

        return response()->json($factura);
    }

    public function crearRecibo(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'folio_recibo'=>'required|unique:facturas',
                'fecha'=>'required',
                'id_admin' => 'required',
                'porcentaje_iva' => 'required|min:0'
            ]);

        $factura = new Facturas;
        $factura->folio_recibo = $request->folio_recibo; 
        $factura->fecha = $request->fecha;
        $factura->subtotal = 0;
        $factura->iva = 0;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->pagado = 0;
        $factura->total = 0;
        $factura->saldo = 0;
        $factura->estatus = 'Pendiente';
        $factura->tipo = 'Recibo';
        $factura->id_cliente = $request->id_cliente;
        $factura->id_admin = $request->id_admin;
        $factura->comentarios = $request->comentarios;
        $factura->save();

        return response()->json($factura);
    }

    public function crearRazon(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'razon_social'=>'required|unique:razones_sociales',
                'rfc'=>'required|unique:razones_sociales|max:15'
            ]);

        $razon = new RazonSocial;
        $razon->razon_social = $request->razon_social; 
        $razon->rfc = $request->rfc; 
        $razon->id_cliente = $request->id_cliente; 
        $razon->id_admin = $request->id_admin; 
        $razon->estatus = '1'; 
        $razon->save();

        return response()->json($razon);
    }

    public function insertarFactura(Request $request)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'monto' => 'required|min:1',
                'porcentaje_iva' => 'required',
                'fecha' => 'required',
                'id_factura' => 'required'
            ]);   

        $facturado_val = $request->monto_factura_limite - $request->monto;
        $facturado_bool = 0;

        if($facturado_val <= 1)
        {
            $facturado_bool = 1;
        }   
        else if($facturado_val > 1)
        {
            $facturado_bool = 0;
        }

        $facturado = $request->facturado + $request->monto;

        $servicio = DB::table('servicios')
        ->where('id', '=', $request->id_servicio)
        ->update(
            [
                'facturado' => $facturado,
                'id_razon_social' => $request->id_razon_social,
                'facturado_terminado' => $facturado_bool
            ]);

        if($request->con_iva == 1)
        {
            $subtotal = $request->subtotal + $request->monto;
            $iva = $subtotal * ($request->porcentaje_iva / 100);
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }
        else if($request->con_iva == 0)
        {
            $subtotal = $request->subtotal + $request->monto;
            $iva = 0;
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }

        $factura = DB::table('facturas')
        ->where('id', '=', $request->id_factura)
        ->update(
            [
                'fecha_pagada' => null,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'porcentaje_iva' => $request->porcentaje_iva,
                'total' => $total,
                'estatus' => 'Pendiente',
                'pagado_terminado' => '0',
                'comentarios' => $request->comentarios,
                'id_razon_social' => $request->id_razon_social,
                'saldo' => $saldo
            ]);

        $detalle = new FacturasDetalles;
        $detalle->monto = $request->monto; 
        $detalle->id_servicio = $request->id_servicio; 
        $detalle->id_factura = $request->id_factura; 
        //$detalle->pagado = $request->pagado; 
        $detalle->save();

        return response()->json($detalle);
    }

    public function agregarIngreso(Request $request)
    {
        $this->validate($request,
            [
                'id_cuenta'=>'required',
                'id_forma_pago'=>'required',
                'total'=>'required|numeric',
                'fecha' => 'required|date'
            ]);

        $ingreso = new EstadosCuenta;
        $ingreso->tipo = 'Ingreso';
        $ingreso->concepto = $request->concepto;
        $ingreso->fecha = $request->fecha;
        $ingreso->con_iva = '0';
        $ingreso->cheque = $request->cheque;
        $ingreso->movimiento = $request->movimiento;
        $ingreso->subtotal = 0;
        $ingreso->porcentaje_iva = $request->porcentaje_iva;
        $ingreso->iva = 0;
        $ingreso->total = 0;
        $ingreso->deposito = $request->total;
        $ingreso->restante = $request->total;
        $ingreso->estatus = 'Pendiente';
        $ingreso->pagado_boolean = '1';
        $ingreso->cerrado_boolean = '0';
        $ingreso->id_forma_pago = $request->id_forma_pago;
        $ingreso->id_cuenta = $request->id_cuenta;
        $ingreso->id_admin = $request->id_admin;
        $ingreso->id_cliente = $request->id_cliente;

        $ingreso->save();

        return response()->json($ingreso);
    }

    public function cargarCobros($id_cliente)
    {
        $cobros = DB::table('estados_cuenta')
            ->select('id', 'deposito')
            ->where('id_cliente', '=', $id_cliente)
            ->where('cerrado_boolean', '=', '0')
            ->where('tipo', '=', 'Ingreso')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($cobros);
    }

    public function datosCobranza($id)
    {
        $detalles = DB::table('estados_cuenta')
            ->select('concepto', 'fecha', 'con_iva', 'cheque', 'movimiento', 'subtotal', 'iva', 'total', 'deposito', 'pagado', 'restante', 'estatus', 'created_at', 'updated_at', 'id_cuenta', 'id_forma_pago', 'porcentaje_iva')
            ->where('id', '=', $id)
            ->first();

        return response()->json($detalles);

    }

    public function cargarFacturasPendientesCobro($id_cliente)
    {
        Carbon::setLocale('es');
        $facturas_pendientes = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'f.id_razon_social')
            ->select('f.id', 'f.folio_factura', 'f.folio_recibo', 'f.fecha', 'f.subtotal', 'f.iva', 'f.total', 'f.saldo', 'f.comentarios', 'f.id_razon_social', 'raz.razon_social', 'raz.rfc', 'f.pagado', 'porcentaje_iva')
            ->where('f.id_cliente', '=', $id_cliente)
            ->where('f.pagado_terminado', '=', '0')
            ->where('f.saldo', '>', 0)
            ->where('f.estatus', '!=', 'Cancelado')
            ->orderBy('f.id', 'asc')
            ->get();

        $monto_pendiente = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->select(DB::raw('sum(f.total) as suma_total'))
            ->where('f.id_cliente', '=', $id_cliente)
            ->where('f.pagado_terminado', '=', '0')
            ->where('f.estatus', '!=', 'Cancelado')
            //->groupBy('f.id')
            ->sum('f.total');

        return view('admin.procesos.detalles-facturas-pendientes', compact('facturas_pendientes', 'monto_pendiente'));
    }

    public function cargarDetallesCobro($id_cobranza, $id_cliente)
    {
        Carbon::setLocale('es');

        $facturas_disponibles = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'f.id_razon_social')
            ->select('f.id', 'f.folio_factura', 'f.folio_recibo', 'f.fecha', 'f.subtotal', 'f.iva', 'f.total', 'f.saldo', 'f.comentarios', 'f.id_razon_social', 'raz.razon_social', 'raz.rfc', 'f.pagado', 'porcentaje_iva')
            ->where('f.id_cliente', '=', $id_cliente)
            ->where('f.pagado_terminado', '=', '0')
            ->where('f.saldo', '>', 0)
            ->where('f.estatus', '=', 'Pendiente')
            ->orderBy('f.id', 'asc')
            ->get();

        $monto_disponible = DB::table('facturas as f')
            ->join('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->select(DB::raw('sum(f.total) as suma_total'))
            ->where('f.id_cliente', '=', $id_cliente)
            ->where('f.pagado_terminado', '=', '0')
            ->where('f.estatus', '!=', 'Cancelado')
            //->groupBy('f.id')
            ->sum('f.total');

        $cobro = DB::table('estados_cuenta')
            ->select('id', 'pagado', 'restante', 'deposito')
            ->where('id', '=', $id_cobranza)
            ->first();

        $detalles_cobranza = DB::table('cobranza_detalles as det')
            ->join('estados_cuenta as est', 'est.id', '=', 'det.id_cobranza')
            ->join('facturas as f', 'f.id', '=', 'det.id_factura')
            ->leftjoin('clientes as c', 'c.id', '=', 'f.id_cliente')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'f.id_razon_social')
            ->select('det.id', 'f.folio_factura', 'f.folio_recibo', 'det.id_cobranza', 'f.id_cliente', 'f.id_razon_social', 'raz.razon_social', 'raz.rfc', 'f.fecha', 'f.total', 'f.pagado', 'det.monto', 'f.saldo')
            ->where('det.id_cobranza', '=', $id_cobranza)
            ->orderBy('det.id', 'asc')
            ->get();

        return view('admin.procesos.detalles-cobranza', compact('detalles_cobranza', 'facturas_disponibles', 'cobro', 'monto_disponible'));  
    }

    public function actualizarCobro(Request $request, $id)
    {
        $cobro = EstadosCuenta::findOrFail($id);

        $this->validate($request,
            [
                'fecha'=>'required',
                'deposito' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required'
            ]);

        $restante = $request->deposito - $request->pagado;

        $cobro->fecha=$request->fecha;
        $cobro->id_cuenta = $request->id_cuenta;
        $cobro->id_forma_pago = $request->id_forma_pago;
        $cobro->deposito = $request->deposito;
        $cobro->pagado = $request->pagado;
        $cobro->restante = $restante;
        $cobro->cheque = $request->cheque;
        $cobro->movimiento = $request->movimiento;
        $cobro->concepto = $request->concepto;

        if($restante <= 1)
        {
            $cobro->cerrado_boolean = 1;
            $cobro->estatus = 'Cerrado';
        }
        else if($restante > 1)
        {
            $cobro->cerrado_boolean = 0;
            $cobro->estatus = 'Abierto';
        }

        $cobro->save();
        
        return response()->json($cobro);
    }

    public function insertar_factura_cobro(Request $request)
    {
        $restante = $request->deposito - $request->total - $request->total_ant;
        $saldo_final = $request->total_fact - $request->total - $request->pagado_fact;
        $saldo_factura = $request->saldo - $request->total;

        if($restante <= 1)
        {
            $cobranza = DB::table('estados_cuenta')
            ->where('id', '=', $request->id_cobranza)
            ->update(
                [
                    'subtotal' => $request->subtotal_ant + $request->subtotal,
                    'iva' => $request->iva_ant + $request->iva,
                    'total' => $request->total_ant + $request->total,
                    'pagado' => $request->pagado + $request->total,
                    'restante' => $request->restante - $request->total,
                    'cerrado_boolean' => 1,
                    'estatus' => 'Cerrado'
                ]);
        }
        else if($restante > 1)
        {
            $cobranza = DB::table('estados_cuenta')
            ->where('id', '=', $request->id_cobranza)
            ->update(
                [
                    'subtotal' => $request->subtotal_ant + $request->subtotal,
                    'iva' => $request->iva_ant + $request->iva,
                    'total' => $request->total_ant + $request->total,
                    'pagado' => $request->pagado + $request->total,
                    'restante' => $request->restante - $request->total,
                    'cerrado_boolean' => 0,
                    'estatus' => 'Abierto'
                ]);
        }

        if($saldo_final <= 1)
        {
            $detalle = new CobranzaDetalles;
            $detalle->monto = $request->total;
            $detalle->id_cobranza = $request->id_cobranza;
            $detalle->id_factura = $request->id_factura;
            $detalle->pagado = 1;
            $detalle->save();

            $factura = DB::table('facturas')
                ->where('id', '=', $request->id_factura)
                ->update(
                    [
                        'pagado' => $request->pagado_fact + $request->total,
                        'saldo' => $saldo_factura,
                        'estatus' => 'Pagado',
                        'pagado_terminado' => 1,
                        'fecha_pagada' => $request->fecha
                    ]);
        }
        else if($saldo_final > 1)
        {
            $detalle = new CobranzaDetalles;
            $detalle->monto = $request->total;
            $detalle->id_cobranza = $request->id_cobranza;
            $detalle->id_factura = $request->id_factura;
            $detalle->save();

            $factura = DB::table('facturas')
                ->where('id', '=', $request->id_factura)
                ->update(
                    [
                        'pagado' => $request->pagado_fact + $request->total,
                        'saldo' => $saldo_factura,
                        'estatus' => 'Pendiente',
                        'pagado_terminado' => 0,
                        'fecha_pagada' => null
                    ]);
        }

        return response()->json($detalle);
    }

    public function cargarServiciosFactura($id_factura, $estatus, $id_cliente)
    {
        Carbon::setLocale('es');
        $servicios = DB::table('servicios as s')
            ->join('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
            ->leftjoin('control as co', 'co.id', '=', 's.id_control')
            ->join('users as a', 'a.id', '=', 's.id_admin')
            ->join('facturas_detalles as det', 'det.id_servicio', '=', 's.id')
            // ->leftjoin('facturas as fact', 'fact.id', '=', 'det.id_factura')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado', 'det.monto', 'det.id as id_det', 's.cobrado', 's.fecha')
            ->where('det.id_factura', '=', $id_factura)
            ->orderBy('s.fecha', 'asc')
            ->get();

        if($estatus == 1)
        {
            $servicios_pendientes = '';
        }
        else if($estatus == 0)
        {
            $servicios_usados = DB::table('facturas_detalles as det')
                ->where('det.id_factura', '=', $id_factura)
                ->pluck('det.id_servicio');

            $servicios_pendientes = DB::table('servicios as s')
                ->join('catalogo_servicios as cat', 'cat.id', '=', 's.id_catalogo_servicio')
                ->leftjoin('control as co', 'co.id', '=', 's.id_control')
                ->join('users as a', 'a.id', '=', 's.id_admin')
                ->join('clientes as c', 'c.id', '=', 's.id_cliente')
                ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
                ->select('s.id', 'cat.clave', 'cat.servicio', 's.tramite', 'co.nombre as marca', 'cla.clave as clase', 's.descuento', 's.costo', 's.created_at', 'a.iniciales', 'a.nombre', 's.facturado', 's.cobrado', 's.fecha')
                ->where('c.id', '=', $id_cliente)
                ->where('s.estatus_cobranza', '=', 'Pendiente')
                ->where('s.cobrado_terminado', '=', '0')
                ->whereNotIn('s.id', $servicios_usados)
                ->orderBy('s.fecha', 'asc')
                ->get();
        }

        return view('admin.procesos.servicios.listado-factura-pagada', compact('servicios', 'servicios_pendientes'));
    }

    //Edición de facturas pagadas
    public function update_factura_pagada(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_cliente'=>'required',
                'monto' => 'required|min:1'
            ]);

        if($request->accion == 'Delete')
        {
            //Cliente
            $saldo_nuevo = $request->saldo_cliente + $request->monto_ant;

            $cliente = DB::table('clientes')
                ->where('id', '=', $request->id_cliente)
                ->update(
                    [
                        'saldo' => $saldo_nuevo
                    ]);
        }
        else if($request->accion == 'Update')
        {
            //Cliente
            $saldo_nuevo = $request->saldo_cliente + $request->monto_ant - $request->monto;
            $cliente = DB::table('clientes')
                ->where('id', '=', $request->id_cliente)
                ->update(
                    [
                        'saldo' => $saldo_nuevo
                    ]);

            //Factura
            $subtotal = $request->subtotal - $request->monto_ant + $request->monto;
            if($request->con_iva == 1)
            {
                $iva = $subtotal * ($request->porcentaje_iva / 100);
                $total = $subtotal + $iva;
            }
            else if($request->con_iva == 0)
            {
                $iva = 0;
                $total = $subtotal;
            }

            $mytime = Carbon::now('America/Chihuahua');
            $fecha = $mytime->toDateString();
            

            //Detalle
            $cobrado = $request->cobrado - $request->monto_ant + $request->monto;

            if($request->cobrado == $request->costo)
            {
                $pagado = 1;
                $fecha_pagado = $fecha;
            }
            else 
            {
                $pagado = 0;
                $fecha_pagado = null;
            }

            $detalle = DB::table('facturas_detalles')
                ->where('id', '=', $request->id_det)
                ->delete();

            $detalle = new FacturasDetalles;
            $detalle->monto = $request->monto;
            $detalle->pagado_monto = $request->monto;
            $detalle->pagado = $pagado;
            $detalle->fecha_pagado = $fecha_pagado;
            $detalle->id_servicio = $request->id_servicio;
            $detalle->id_factura = $request->id_factura;
            $detalle->save();

            $factura = Facturas::findOrFail($id);
            $factura->subtotal = $subtotal;
            $factura->iva = $iva;
            $factura->total = $total;
            $factura->pagado = $total;
            $factura->pagado_terminado = 1;
            $factura->update();

            return response()->json($factura);
        }
    }


    //Comisiones
    public function listadoComisiones($id)
    {
        $comisiones = DB::table('nomina as n')
            ->join('servicios as s', 's.id', '=', 'n.id_servicio')
            ->join('users as a', 'a.id', '=', 'n.id_admin')
            ->select('n.*', 'a.nombre', 'a.apellido', 's.comision_venta_restante', 's.comision_operativa_restante', 's.comision_gestion_restante')
            ->where('n.id_servicio', '=', $id)
            ->get();

        return view('admin.procesos.servicios.comisiones-listado', compact('comisiones'));
    }

    public function valorComisionRestante($id)
    {
        $valor = DB::table('servicios')
            ->select('id', 'comision_venta_restante', 'comision_operativa_restante', 'comision_gestion_restante', 'listo_comision_venta', 'listo_comision_operativa', 'listo_comision_gestion', 'comision_venta', 'comision_operativa', 'comision_gestion', 'aplica_comision_venta', 'aplica_comision_gestion', 'aplica_comision_operativa')
            ->where('id', '=', $id)
            ->first();

        return response()->json($valor);
    }

    public function insertar_comision(Request $request)
    {
        $this->validate($request,
            [
                'id_servicio'=>'required',
                'id_admin'=>'required',
                'monto' => 'required|numeric|min:1',
                'porcentaje_comision' => 'required|numeric',
                'tipo_comision' => 'required',
                'monto_restante' => 'required',
                //'monto_disponible' =>
            ]);

        if($request->tipo_comision == 'Venta')
        {
            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_venta_restante' => $request->monto_restante]);
        }
        else if($request->tipo_comision == 'Operativa')
        {
            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_operativa_restante' => $request->monto_restante]);
        }
        else if($request->tipo_comision == 'Gestión')
        {
            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_gestion_restante' => $request->monto_restante]);
        }

        $comision = new Nomina;
        $comision->tipo_comision=$request->tipo_comision;
        $comision->comentarios=$request->comentarios;
        $comision->monto=$request->monto;
        $comision->id_admin=$request->id_admin;
        $comision->id_servicio=$request->id_servicio;
        $comision->porcentaje_comision=$request->porcentaje_comision;
        $comision->concepto='Comisión';
        $mytime = Carbon::now('America/Chihuahua');
        $comision->fecha_comision=$mytime->toDateString();

        if($request->tipo_comision == 'Venta' && $request->listo_comision == 1)
        {
            $comision->listo_comision = 1;
            $comision->estatus = 'Liberada';
            $comision->fecha_aplicada = $mytime->toDateString();
        }
        else if($request->tipo_comision == 'Operativa' && $request->listo_comision == 1)
        {
            $comision->listo_comision = 1;
            $comision->estatus = 'Liberada';
            $comision->fecha_aplicada = $mytime->toDateString();
        }
        else if($request->tipo_comision == 'Gestión' && $request->listo_comision == 1)
        {
            $comision->listo_comision = 1;
            $comision->estatus = 'Liberada';
            $comision->fecha_aplicada = $mytime->toDateString();
        }
        else
        {
            $comision->listo_comision = 0;
            $comision->estatus = 'Pendiente';
            $comision->fecha_aplicada = null;
        }

        $comision->save();

        if($request->repartir_comision == 1 && $request->usuario_repartir != '')
        {
            $comision_descontada = new Nomina;
            $comision_descontada->tipo_comision = $request->tipo_comision;
            $comision_descontada->comentarios = $request->comentarios;
            $comision_descontada->monto = $request->monto_descontado;
            $comision_descontada->id_admin = $request->usuario_repartir;
            $comision_descontada->id_servicio = $request->id_servicio;
            $comision_descontada->porcentaje_comision = $request->porcentaje_descontado;
            $comision_descontada->concepto = 'Comisión';
            $comision_descontada->fecha_comision = $mytime->toDateString();

            if($request->tipo_comision == 'Venta' && $request->listo_comision == 1)
            {
                $comision_descontada->listo_comision = 1;
                $comision_descontada->estatus = 'Liberada';
                $comision_descontada->fecha_aplicada = $mytime->toDateString();
            }
            else if($request->tipo_comision == 'Operativa' && $request->listo_comision == 1)
            {
                $comision_descontada->listo_comision = 1;
                $comision_descontada->estatus = 'Liberada';
                $comision_descontada->fecha_aplicada = $mytime->toDateString();
            }
            else if($request->tipo_comision == 'Gestión' && $request->listo_comision == 1)
            {
                $comision_descontada->listo_comision = 1;
                $comision_descontada->estatus = 'Liberada';
                $comision_descontada->fecha_aplicada = $mytime->toDateString();
            }
            else
            {
                $comision_descontada->listo_comision = 0;
                $comision_descontada->estatus = 'Pendiente';
                $comision_descontada->fecha_aplicada = null;
            }

            $comision_descontada->save();
        }

        //return back()->with($mensaje);
        return response()->json($comision);
        
    }

    public function editar_comision(Request $request, $id)
    {
        $comision = DB::table('nomina as n')
            ->join('servicios as s', 's.id', '=', 'n.id_servicio')
            ->select('n.*', 's.comision_venta_restante', 's.comision_operativa_restante', 's.comision_gestion_restante', 's.listo_comision_venta', 's.listo_comision_operativa', 's.listo_comision_gestion', 's.comision_venta', 's.comision_operativa', 's.comision_gestion', DB::RAW('s.comision_venta_restante + n.monto as max_venta'), DB::RAW('s.comision_operativa_restante + n.monto as max_operativa'), DB::RAW('s.comision_gestion_restante + n.monto as max_gestion'))
            ->where('n.id', '=', $id)
            ->first();

        //return $comision;

        return response()->json($comision);
    }

    public function actualizar_comision(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_comision'=>'required',
                'id_servicio'=>'required',
                'listo_comision'=>'required',
                'monto' => 'required|numeric|min:1',
                'monto_restante' => 'required|numeric|min:0',
                'id_admin' => 'required'
            ]);

        if($request->tipo_comision == 'Venta')
        {
            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_venta_restante' => $request->monto_restante]);
        }
        else if($request->tipo_comision == 'Operativa')
        {
            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_operativa_restante' => $request->monto_restante]);
        }
        else if($request->tipo_comision == 'Gestión')
        {
            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_gestion_restante' => $request->monto_restante]);
        }

        $mytime = Carbon::now('America/Chihuahua');

        $comision = Nomina::findOrFail($id);
        $comision->comentarios=$request->comentarios;
        $comision->monto=$request->monto;
        $comision->id_admin=$request->id_admin;
        $comision->porcentaje_comision=$request->porcentaje_comision;
        //$comision->preseleccionar_comision = 0;

        if($request->tipo_comision == 'Venta' && $request->listo_comision == 1)
        {
            $comision->listo_comision = 1;
            $comision->estatus = 'Liberada';
            $comision->fecha_aplicada = $mytime->toDateString();
        }
        else if($request->tipo_comision == 'Operativa' && $request->listo_comision == 1)
        {
            $comision->listo_comision = 1;
            $comision->estatus = 'Liberada';
            $comision->fecha_aplicada = $mytime->toDateString();
        }
        else if($request->tipo_comision == 'Gestión' && $request->listo_comision == 1)
        {
            $comision->listo_comision = 1;
            $comision->estatus = 'Liberada';
            $comision->fecha_aplicada = $mytime->toDateString();
        }
        else
        {
            $comision->listo_comision = 0;
            $comision->estatus = 'Pendiente';
            $comision->fecha_aplicada = null;
        }

        $comision->update();

        //return back()->with($mensaje);
        return response()->json($comision);
    }

    public function cancelar_comision(Request $request, $id)
    {
        $this->validate($request,
            [
                'id_servicio'=>'required',
                'monto' => 'required|numeric',
                'tipo_comision' => 'required'
            ]);

        if($request->tipo_comision == 'Venta')
        {
            $monto_restante = $request->comision_venta_restante + $request->monto;

            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_venta_restante' => $monto_restante]);
        }
        else if($request->tipo_comision == 'Operativa')
        {

            $monto_restante = $request->comision_operativa_restante + $request->monto;

            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_operativa_restante' => $monto_restante]);
        }
        else if($request->tipo_comision == 'Gestión')
        {
            $monto_restante = $request->comision_gestion_restante + $request->monto;

            $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(['comision_gestion_restante' => $monto_restante]);
        }

        $comision = Nomina::findOrFail($id);
        $comision->estatus = 'Cancelado';
        $comision->fecha_aplicada = null;
        $comision->listo_comision = 1;
        $comision->save();

        return response()->json($comision); 
    }

    //Facturas en Control de Servicios
    public function getSaldoFactura($id)
    {
        $factura = Facturas::select('saldo', 'pagado', 'iva', 'porcentaje_iva', 'con_iva', 'subtotal', 'total')->where('id', '=', $id)->first();

        return response()->json($factura);
    }

    public function servicio_facturas($id_cliente)
    {
        $facturas = Facturas::where('id_cliente', '=', $id_cliente)
        ->where('pagado_terminado', '=', '0')
        ->where('estatus', '=', 'Pendiente')
        ->where('tipo', '=', 'Factura')
        ->get();

        return response()->json($facturas);
    }

    public function servicio_recibos($id_cliente)
    {
        $recibos = Facturas::where('id_cliente', '=', $id_cliente)
        ->where('pagado_terminado', '=', '0')
        ->where('estatus', '=', 'Pendiente')
        ->where('tipo', '=', 'Recibo')
        ->get();

        return response()->json($recibos);
    }

    public function servicio_folio_factura_nuevo(Request $request)
    {
        $this->validate($request,
            [
                'monto'=>'required|numeric',
                'fecha' => 'required',
                'folio_factura' => 'required|unique:facturas',
                'porcentaje_iva' => 'required',
                'id_cliente' => 'required',
                'id_servicio' => 'required',
                'id_admin' => 'required'
            ]);

        $subtotal = $request->monto;
        $iva = $request->monto * ($request->porcentaje_iva /100);
        $total = $subtotal + $iva;

        $facturado = $request->monto + $request->facturado;
        $restante = $request->costo - $facturado;

        if($restante == 0)
        {
            $facturado_terminado = 1;
        }
        else if($restante > 0)
        {
            $facturado_terminado = 0;
        }

        $factura = new Facturas;
        $factura->tipo = $request->tipo;
        $factura->folio_factura = $request->folio_factura;
        $factura->fecha = $request->fecha;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->con_iva = 1;
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->total = $total;
        $factura->pagado = 0;
        $factura->pagado_terminado = 0;
        $factura->saldo = $total;
        $factura->estatus = 'Pendiente';
        $factura->id_cliente = $request->id_cliente;
        $factura->id_admin = $request->id_admin;
        $factura->save();

        $detalle = new FacturasDetalles;
        $detalle->monto = $request->monto;
        $detalle->id_servicio = $request->id_servicio;
        $detalle->id_factura = $factura->id;
        $detalle->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'facturado' => $facturado,
                    'facturado_terminado' => $facturado_terminado
                ]);

        return response()->json($factura);
    }

    public function servicio_folio_recibo_nuevo(Request $request)
    {
        $this->validate($request,
            [
                'monto'=>'required|numeric',
                'fecha' => 'required',
                'folio_recibo' => 'required|unique:facturas',
                'porcentaje_iva' => 'required',
                'id_cliente' => 'required',
                'id_servicio' => 'required',
                'id_admin' => 'required'
            ]);

        if($request->con_iva == 0)
        {
            $subtotal = $request->monto;
            $iva = 0;
            $total = $subtotal + $iva;
        }
        else if($request->con_iva == 1)
        {
            $subtotal = $request->monto;
            $iva = $request->monto * ($request->porcentaje_iva /100);
            $total = $subtotal + $iva;
        }

        $facturado = $request->monto + $request->facturado;
        $restante = $request->costo - $facturado;

        if($restante == 0)
        {
            $facturado_terminado = 1;
        }
        else if($restante > 0)
        {
            $facturado_terminado = 0;
        }

        $factura = new Facturas;
        $factura->tipo = $request->tipo;
        $factura->folio_recibo = $request->folio_recibo;
        $factura->fecha = $request->fecha;
        $factura->porcentaje_iva = $request->porcentaje_iva;
        $factura->con_iva = $request->con_iva;
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->total = $total;
        $factura->pagado = 0;
        $factura->pagado_terminado = 0;
        $factura->saldo = $total;
        $factura->estatus = 'Pendiente';
        $factura->id_cliente = $request->id_cliente;
        $factura->id_admin = $request->id_admin;
        $factura->save();

        $detalle = new FacturasDetalles;
        $detalle->monto = $request->monto;
        $detalle->id_servicio = $request->id_servicio;
        $detalle->id_factura = $factura->id;
        $detalle->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'facturado' => $facturado,
                    'facturado_terminado' => $facturado_terminado
                ]);

        return response()->json($factura);
    }

    public function cambiar_iva_factura(Request $request, $id)
    {
        $this->validate($request,
            [
                'porcentaje_iva'=> ($request->get('con_iva') == '1') ? 'required|min:1' : '',
            ]);

        if($request->con_iva == 0)
        {
            $subtotal = $request->subtotal;
            $iva = 0;
            
        }
        else if($request->con_iva == 1)
        {
            $subtotal = $request->subtotal;
            $iva = $subtotal * ($request->porcentaje_iva /100);
        }

        $total = $subtotal + $iva;
        $saldo = $total - $request->pagado;

        if($saldo == 0)
        {
            $pagado_terminado = 1;
            $estatus = 'Pagado';
        }
        else if($saldo > 0)
        {
            $pagado_terminado = 0;
            $estatus = 'Pendiente';
        }

        $factura = Facturas::findOrFail($id);
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->total = $total;
        $factura->pagado_terminado = 0;
        $factura->saldo = $saldo;
        $factura->estatus = $estatus;
        $factura->id_admin = $request->id_admin;
        $factura->update();

        return response()->json($factura);
    }

    public function servicio_folio_existente(Request $request, $id)
    {
        $this->validate($request,
            [
                'monto'=>'required|numeric',
                //'id_cliente' => 'required',
                'id_servicio' => 'required',
                'id_admin' => 'required'
            ]);

        if($request->con_iva == 0)
        {
            $subtotal = $request->subtotal + $request->monto;
            $iva = 0;
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }
        else if($request->con_iva == 1)
        {
            $subtotal = $request->subtotal + $request->monto;
            $iva = $subtotal * ($request->porcentaje_iva /100);
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }

        $facturado = $request->monto + $request->facturado;
        $restante = $request->costo - $facturado;

        if($restante == 0)
        {
            $facturado_terminado = 1;
        }
        else if($restante > 0)
        {
            $facturado_terminado = 0;
        } 

        $factura = Facturas::findOrFail($id);
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->con_iva = $request->con_iva;
        $factura->total = $total;
        $factura->pagado_terminado = 0;
        $factura->saldo = $saldo;
        //$factura->estatus = 'Pendiente';
        //$factura->id_cliente = $request->id_cliente;
        $factura->id_admin = $request->id_admin;
        $factura->update();

        $detalle = new FacturasDetalles;
        $detalle->monto = $request->monto;
        $detalle->id_servicio = $request->id_servicio;
        $detalle->id_factura = $id;
        $detalle->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'facturado' => $facturado,
                    'facturado_terminado' => $facturado_terminado
                ]);

        return response()->json($factura);
    }

    public function editar_detalle(Request $request, $id)
    {
        $this->validate($request,
            [
                'monto'=>'required|numeric',
                //'id_cliente' => 'required',
                'id_servicio' => 'required',
                'id_admin' => 'required'
            ]);

        if($request->con_iva == 0)
        {
            $subtotal = $request->subtotal + $request->monto;
            $iva = 0;
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }
        else if($request->con_iva == 1)
        {
            $subtotal = $request->subtotal + $request->monto;
            $iva = $subtotal * ($request->porcentaje_iva /100);
            $total = $subtotal + $iva;
            $saldo = $total - $request->pagado;
        }

        $facturado = $request->monto + $request->facturado;
        $restante = $request->costo - $facturado;

        if($restante == 0)
        {
            $facturado_terminado = 1;
        }
        else if($restante > 0)
        {
            $facturado_terminado = 0;
        } 

        $factura = Facturas::findOrFail($id);
        $factura->subtotal = $subtotal;
        $factura->iva = $iva;
        $factura->total = $total;
        $factura->pagado_terminado = 0;
        $factura->saldo = $saldo;
        //$factura->estatus = 'Pendiente';
        //$factura->id_cliente = $request->id_cliente;
        $factura->id_admin = $request->id_admin;
        $factura->update();

        $detalle = new FacturasDetalles;
        $detalle->monto = $request->monto;
        $detalle->id_servicio = $request->id_servicio;
        $detalle->id_factura = $id;
        $detalle->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'facturado' => $facturado,
                    'facturado_terminado' => $facturado_terminado
                ]);

        return response()->json($factura);
    }

    //Pagar factura o recibo

    public function pagar_factura(Request $request, $id)
    {
        $this->validate($request,
            [
                'deposito'=>'required|numeric|min:0',
                'id_cliente' => 'required',
                'id_admin' => 'required',
                'pagado_fact' => 'required',
                'saldo_cliente' => 'required|min:1|numeric',
                'total_fact' => 'required',
            ]);

        $mytime = Carbon::now('America/Chihuahua');

        //Saldos
        if($request->deposito > $request->saldo_cliente)
        {
            $deposito = $request->saldo_cliente;
            $saldo = 0;
        }
        /*else if($request->deposito == $request->saldo_cliente)
        {
            $deposito = $request->deposito;
            $saldo = $request->saldo_cliente - $deposito;
        }*/
        else if($request->deposito <= $request->saldo_cliente)
        {
            $deposito = $request->deposito;
            $saldo = $request->saldo_cliente - $deposito;
        }

        //Factura
        $pagado_fact = $deposito + $request->pagado_fact;
        $saldo_fact = $request->total_fact - $pagado_fact;

        if($pagado_fact == $request->total_fact)
        {
            $pagado_terminado = 1;
            $estatus = 'Pagado';
            $fecha_pagada = $mytime->toDateString();
        }
        else if($pagado_fact < $request->total_fact)
        {
            $pagado_terminado = 0;
            $estatus = 'Pendiente';
            $fecha_pagada = null;
        }

        //return response()->json($pagado_terminado); 

        $factura = Facturas::findOrFail($id);
        $factura->pagado_terminado = $pagado_terminado;
        $factura->estatus = $estatus;
        $factura->fecha_pagada = $fecha_pagada;
        $factura->pagado = $pagado_fact;
        $factura->saldo = $saldo_fact;
        $factura->update();

        $cliente = DB::table('clientes')
            ->where('id', '=', $request->id_cliente)
            ->update(['saldo' => $saldo]);

        return response()->json($factura);
    }

    public function liberar_factura(Request $request, $id)
    {
        $saldo_cliente = $request->saldo_cliente + $request->pagado;

        $factura = Facturas::findOrFail($id);
        $factura->estatus = $request->estatus;
        $factura->pagado_terminado = 0;
        $factura->pagado = 0;
        $factura->iva = 0;
        $factura->subtotal = 0;
        $factura->total = 0;
        $factura->saldo = 0;
        $factura->fecha_pagada = null;
        $factura->update();

        $detalle = DB::table('facturas_detalles')
            ->where('id_factura', '=', $id)
            ->delete();

        $cliente = DB::table('clientes')
            ->where('id', '=', $request->id_cliente)
            ->update(
                [
                    'saldo' => $saldo_cliente
                ]);


        return response()->json($factura);
    }

    public function quitar_servicio(Request $request, $id)
    {
        $subtotal = $request->subtotal - $request->monto;

        if($request->con_iva == 0)
        {
            $iva = 0;
            $total = $subtotal + $iva;
            $monto = $request->monto;
            $saldo = $request->saldo - $monto;
        }
        else if($request->con_iva == 1)
        {
            $iva = $subtotal * ($request->porcentaje_iva /100);
            $total = $subtotal + $iva;
            $monto = $request->monto * (1 + ($request->porcentaje_iva / 100));
            $saldo = $request->saldo - $monto;
        }

        $factura = Facturas::findOrFail($id);
        $factura->estatus = 'Pendiente';
        $factura->pagado_terminado = 0;
        $factura->iva = $iva;
        $factura->subtotal = $subtotal;
        $factura->total = $total;
        $factura->saldo = $saldo;
        $factura->fecha_pagada = null;
        $factura->update();

        $detalle = DB::table('facturas_detalles')
            ->where('id', '=', $request->id_det)
            ->delete();

        return response()->json($factura);
    }

    //Cobros

    public function insertar_cobro(Request $request)
    {
        $this->validate($request,
            [
                'monto'=>'required|numeric',
                'id_cliente' => 'required',
                'id_admin' => 'required',
                'id_cuenta' => 'required',
                'id_forma_pago' => 'required',
                'id_factura' => 'required',
                'porcentaje_iva' => 'required',
                'iva' => 'required',
                'pagado_fact' => 'required',
                'deposito' => 'required|min:1|numeric',
                'total_fact' => 'required',
            ]);

        //validación del monto
        if($request->deposito < $request->monto)
        {
            $monto = $request->deposito;
        }
        else
        {
            $monto = $request->monto;
        }
        
        //Factura
        $pagado_fact = $monto + $request->pagado_fact;
        $saldo = $request->total_fact - $pagado_fact;

        if($pagado_fact == $request->total_fact)
        {
            $pagado_terminado = 1;
            $estatus = 'Pagado';
            $fecha_pagada = $request->fecha;
        }
        else if($pagado_fact < $request->total_fact)
        {
            $pagado_terminado = 0;
            $estatus = 'Pendiente';
            $fecha_pagada = '';
        }

        //Cobro
        $total = $monto;
        $restante = $request->deposito - $monto;

        if($request->iva > 0)
        {
            $subtotal = $monto / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
            $con_iva = 1;
        }
        else if($request->iva == 0)
        {
            $iva = 0;
            $subtotal = $monto;
            $con_iva = 0;
        }

        $restante = $restante * 1;
        if($restante == 0)
        {
            $cerrado_boolean = 1;
        }
        else if($restante > 0)
        {
            $cerrado_boolean = 0;
        }

        $cobro = new EstadosCuenta;
        $cobro->tipo = 'INGRESO';
        $cobro->tipo_movimiento = 'INGRESO';
        $cobro->orden = $request->orden;
        $cobro->fecha = $request->fecha;
        $cobro->id_cuenta = $request->id_cuenta;
        $cobro->id_forma_pago = $request->id_forma_pago;
        $cobro->id_admin = $request->id_admin;
        $cobro->id_cliente = $request->id_cliente;
        $cobro->concepto = $request->concepto;
        $cobro->con_iva = $con_iva;
        $cobro->movimiento = $request->movimiento;
        $cobro->cheque = $request->cheque;
        $cobro->subtotal = $subtotal;
        $cobro->iva = $iva;
        $cobro->porcentaje_iva = $request->porcentaje_iva;
        $cobro->total = $total;
        $cobro->deposito = $request->deposito;
        $cobro->pagado = $monto;
        $cobro->restante = $restante;
        $cobro->estatus = 'Pagado';
        $cobro->pagado_boolean = 1;
        $cobro->cerrado_boolean = $cerrado_boolean;
        $cobro->save();

        $detalle = new CobranzaDetalles;
        $detalle->id_cobranza = $cobro->id;
        $detalle->id_factura = $request->id_factura;
        $detalle->monto = $monto;
        $detalle->save();

        $factura = DB::table('facturas')
            ->where('id', '=', $request->id_factura)
            ->update(
                [
                    'pagado' => $pagado_fact,
                    'fecha_pagada' => $fecha_pagada,
                    'pagado_terminado' => $pagado_terminado,
                    'saldo' => $saldo,
                    'estatus' => $estatus
                ]);

        return response()->json($cobro);
    }

    public function editar_cobro(Request $request, $id)
    {
        $this->validate($request,
            [
                'monto'=>'required|numeric',
                'id_factura' => 'required',
                'porcentaje_iva' => 'required',
                'iva' => 'required',
                'pagado' => 'required',
                'restante' => 'required',
                'total_fact' => 'required',
                'pagado_fact' => 'required',
                'total' => 'required'
            ]);

        //validación del monto
        if($request->restante < $request->monto)
        {
            $monto = $request->restante;
        }
        else
        {
            $monto = $request->monto;
        }
        
        //Factura
        $pagado_fact = $monto + $request->pagado_fact;
        $saldo = $request->total_fact - $pagado_fact;

        if($pagado_fact == $request->total_fact)
        {
            $pagado_terminado = 1;
            $estatus = 'Pagado';
            $fecha_pagada = $request->fecha;
        }
        else if($pagado_fact < $request->total_fact)
        {
            $pagado_terminado = 0;
            $estatus = 'Pendiente';
            $fecha_pagada = '';
        }

        //Cobro
        $total = $request->total + $monto;
        $restante = $request->restante - $monto;
        $pagado = $request->pagado + $monto;

        if($request->iva > 0)
        {
            $subtotal = $total / (1 + ($request->porcentaje_iva / 100));
            $iva = $total - $subtotal;
        }
        else if($request->iva == 0)
        {
            $iva = 0;
            $subtotal = $total;
        }

        $restante = $restante * 1;
        if($restante == 0)
        {
            $cerrado_boolean = 1;
        }
        else if($restante > 0)
        {
            $cerrado_boolean = 0;
        }

        $cobro = EstadosCuenta::findOrFail($id);
        $cobro->subtotal = $subtotal;
        $cobro->iva = $iva;
        $cobro->total = $total;
        $cobro->pagado = $pagado;
        $cobro->restante = $restante;
        $cobro->cerrado_boolean = $cerrado_boolean;
        $cobro->update();

        $detalle = new CobranzaDetalles;
        $detalle->id_cobranza = $id;
        $detalle->id_factura = $request->id_factura;
        $detalle->monto = $monto;
        $detalle->save();

        $factura = DB::table('facturas')
            ->where('id', '=', $request->id_factura)
            ->update(
                [
                    'pagado' => $pagado_fact,
                    'fecha_pagada' => $fecha_pagada,
                    'pagado_terminado' => $pagado_terminado,
                    'saldo' => $saldo,
                    'estatus' => $estatus
                ]);

        return response()->json($cobro);
    }
}





















