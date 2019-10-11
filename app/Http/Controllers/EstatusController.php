<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\Control;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\SubcategoriaServicios;
use Emporio\Model\ListadoEstatus;
use Emporio\Model\Estatus;
use Emporio\User;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use Image;
use Carbon\Carbon;

class EstatusController extends Controller
{
    public function index()
    {
        $url_listar = '/admin/estatus/signos-distintivos-listar/';
        $url_buscar = '/admin/estatus/signos-distintivos-buscar/';
        $url_actualizar = '/admin/estatus/signos-distintivos-actualizar/';
        $listado_estatus = ListadoEstatus::orderBy('estatus')->where('activo', '=', '1')->get();
        $bitacoras_estatus = CategoriaEstatus::orderBy('bitacora', 'asc')->where('estatus','=','1')->get();

        return view('admin.estatus.index', compact('url_listar', 'url_buscar', 'url_actualizar', 'listado_estatus', 'bitacoras_estatus'));
    }

    public function signos_distintivos_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '1')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-signos-distintivos', compact('bitacoras', 'today'));
    }

    public function signos_distintivos_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '1')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.id','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-signos-distintivos', compact('bitacoras', 'today'));
    }

    public function signos_distintivos_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-signos-distintivos-actualizar', compact('bitacora', 'today'));
    }

    public function declaracion_uso_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.comprobacion_uso', '=', '0')
            ->where('est.fecha_comprobacion_uso', '!=', '')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-declaracion-uso', compact('bitacoras', 'today'));
    }

    public function declaracion_uso_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '1')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.id','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-declaracion-uso', compact('bitacoras', 'today'));
    }

    public function declaracion_uso_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-signos-distintivos-actualizar', compact('bitacora', 'today'));
    }

    public function busqueda_tecnica_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '2')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-busqueda-tecnica', compact('bitacoras', 'today'));
    }

    public function busqueda_tecnica_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '2')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-busqueda-tecnica', compact('bitacoras', 'today'));
    }

    public function busqueda_tecnica_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-busqueda-tecnica-actualizar', compact('bitacora', 'today'));
    }

    public function invenciones_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '3')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-invenciones', compact('bitacoras', 'today'));
    }

    public function invenciones_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '3')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-invenciones', compact('bitacoras', 'today'));
    }

    public function invenciones_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-invenciones-actualizar', compact('bitacora', 'today'));
    }

    public function dictamen_previo_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '4')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-dictamen-previo', compact('bitacoras', 'today'));
    }

    public function dictamen_previo_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '4')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-dictamen-previo', compact('bitacoras', 'today'));
    }

    public function dictamen_previo_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-dictamen-previo-actualizar', compact('bitacora', 'today'));
    }

    public function codigos_barra_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '5')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-codigos-barra', compact('bitacoras', 'today'));
    }

    public function codigos_barra_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '5')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-codigos-barra', compact('bitacoras', 'today'));
    }

    public function codigos_barra_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-codigos-barra-actualizar', compact('bitacora', 'today'));
    }


    public function registro_obras_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '6')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-registro-obras', compact('bitacoras', 'today'));
    }

    public function registro_obras_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '6')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-registro-obras', compact('bitacoras', 'today'));
    }

    public function registro_obras_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-registro-obras-actualizar', compact('bitacora', 'today'));
    }

    public function reserva_derechos_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '7')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-reserva-derechos', compact('bitacoras', 'today'));
    }

    public function reserva_derechos_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '7')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-reserva-derechos', compact('bitacoras', 'today'));
    }

    public function reserva_derechos_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-reserva-derechos-actualizar', compact('bitacora', 'today'));
    }

    public function juicios_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '8')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-juicios', compact('bitacoras', 'today'));
    }

    public function juicios_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '8')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-juicios', compact('bitacoras', 'today'));
    }

    public function juicios_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-juicios-actualizar', compact('bitacora', 'today'));
    }

    public function franquicias_listar($estatus, $vigencia)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '9')
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-franquicias', compact('bitacoras', 'today'));
    }

    public function franquicias_buscar($estatus, $vigencia, $buscar)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacoras = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id_bitacoras_estatus', '=', '9')
            ->where(function($q) use ($buscar)
            {
                $q->where('c.nombre_comercial','LIKE','%'.$buscar.'%')
                ->orWhere('mar.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.iniciales','LIKE','%'.$buscar.'%')
                ->orWhere('u.nombre','LIKE','%'.$buscar.'%')
                ->orWhere('u.apellido','LIKE','%'.$buscar.'%')
                ->orWhere('cla.clave','LIKE','%'.$buscar.'%')
                ->orWhere('sub.subcategoria','LIKE','%'.$buscar.'%')
                ->orWhere('raz.rfc','LIKE','%'.$buscar.'%')
                ->orWhere('raz.razon_social','LIKE','%'.$buscar.'%')
                ->orWhere('est.comprobacion','LIKE','%'.$buscar.'%')
                ->orWhere('est.representante','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_expediente','LIKE','%'.$buscar.'%')
                ->orWhere('est.numero_registro','LIKE','%'.$buscar.'%')
                ->orWhere('est.observaciones','LIKE','%'.$buscar.'%')
                ->orWhere('est.comentarios','LIKE','%'.$buscar.'%');
            })
            
            ->orderBy('est.fecha_vencimiento', 'asc');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $bitacoras->where('est.id_estatus', '=', $estatus);
            }

            if($vigencia == 'todos')
            {
                //
            }
            else if($vigencia != 'todos')
            {
                $bitacoras->where('est.vigencia', '=', $vigencia);
            }

            $bitacoras = $bitacoras->paginate(50);

        return view('admin.estatus.listado-franquicias', compact('bitacoras', 'today'));
    }

    public function franquicias_actualizar($id)
    {
        Carbon::setLocale('es');
        $mytime = Carbon::now('America/Chihuahua');
        $today = $mytime->toDateString();

        $bitacora = DB::table('bitacoras_estatus as est')
            ->leftjoin('clientes as c', 'c.id', '=', 'est.id_cliente')
            ->leftjoin('users as u', 'u.id', '=', 'est.id_admin')
            ->leftjoin('listado_estatus as list', 'list.id', '=', 'est.id_estatus')
            ->leftjoin('razones_sociales as raz', 'raz.id', '=', 'est.id_razon_social')
            ->leftjoin('clases as cla', 'cla.id', '=', 'est.id_clase')
            ->leftjoin('control as mar', 'mar.id', '=', 'est.id_marca')
            ->leftjoin('subcategoria_servicios as sub', 'sub.id', '=', 'est.id_subcategoria')
            ->select('est.*', 'c.nombre_comercial', 'u.iniciales', 'u.nombre', 'u.apellido', 'list.estatus', 'cla.clave as clase', 'mar.nombre as marca', 'sub.subcategoria', 'raz.rfc', 'raz.razon_social', 'list.color', 'list.texto')
            ->where('est.id', '=', $id)
            ->first();

        return view('admin.estatus.listado-franquicias-actualizar', compact('bitacora', 'today'));
    }

    public function clientes_estatus_nuevo()
    {
        $clientes = DB::table('clientes as c')
            ->join('servicios as s', 's.id_cliente', '=', 'c.id')
            ->select('c.id', 'c.nombre_comercial')
            ->where('s.id_estatus', '=', null)
            ->where('s.estatus_registro', '=', 'Terminado')
            ->groupBy('c.id', 'c.nombre_comercial')
            ->orderBy('c.nombre_comercial', 'asc')
            ->get();

        return response()->json($clientes);
    }

    public function servicios_clientes($id_cliente)
    {
        $servicios=DB::table('servicios as s')
            ->leftjoin('control as con', 's.id_control', '=', 'con.id')
            ->leftjoin('catalogo_servicios as cat', 's.id_catalogo_servicio', '=', 'cat.id')
            ->leftjoin('clases as cla', 's.id_clase', '=', 'cla.id')
            ->select('s.id', 's.id_clase', 's.id_control', 'cat.clave', 's.fecha_registro', 'con.nombre as marca', 'cla.clave as clase')
            ->where('s.id_cliente', '=', $id_cliente)
            ->where('s.id_estatus', '=', null)
            ->where('s.estatus_registro', '=', 'Terminado')
            ->orderBy('cat.servicio')
            ->get();

        return response()->json($servicios);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'required',
                // 'id_subcategoria' => 'required',
                'id_estatus' => 'required',
                'id_cliente' => 'required',
                'id_servicio' => 'required',
                'numero_expediente' => ($request->get('numero_expediente') != "") ? 'unique:bitacoras_estatus' : '',
                'numero_registro' => ($request->get('numero_registro') != "") ? 'unique:bitacoras_estatus' : '',
                'codigo_barras' => ($request->get('codigo_barras') != "") ? 'unique:bitacoras_estatus' : ''
            ]);

        $estatus = new Estatus;
        $estatus->numero_expediente = $request->numero_expediente;
        $estatus->numero_registro = $request->numero_registro;
        $estatus->patente = $request->patente;
        $estatus->codigo_barras = $request->codigo_barras;
        $estatus->comprobacion = $request->comprobacion;
        $estatus->vencimiento = $request->vencimiento;
        $estatus->recordatorio = $request->recordatorio;
        $estatus->renovacion = $request->renovacion;
        $estatus->comprobacion_uso = $request->comprobacion_uso;
        $estatus->fecha_inicio = $request->fecha_inicio;
        $estatus->fecha_recordatorio = $request->fecha_recordatorio;
        $estatus->fecha_vencimiento = $request->fecha_vencimiento;
        $estatus->fecha_comprobacion_uso = $request->fecha_comprobacion_uso;
        $estatus->vigencia = '1';
        $estatus->id_cliente = $request->id_cliente;
        $estatus->id_admin = $request->id_admin;
        $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
        $estatus->id_estatus = $request->id_estatus;
        $estatus->id_clase = $request->id_clase;
        $estatus->id_marca = $request->id_marca;
        $estatus->id_subcategoria = $request->id_subcategoria;
        $estatus->save();

        $servicio = DB::table('servicios')
            ->where('id', '=', $request->id_servicio)
            ->update(
                [
                    'id_estatus' => $estatus->id
                ]);

        return response()->json($estatus);
    }

    public function edit($id)
    {
        $estatus = DB::table('bitacoras_estatus as e')
            ->join('listado_estatus as li', 'li.id', '=', 'e.id_estatus')
            ->join('clientes as c', 'c.id', '=', 'e.id_cliente')
            ->leftjoin('control as con', 'con.id', '=', 'e.id_marca')
            ->leftjoin('clases as cla', 'cla.id', '=', 'e.id_clase')
            ->leftjoin('subcategoria_servicios as sub', 'e.id_subcategoria', '=', 'sub.id')
            ->select('e.*', 'li.texto', 'li.color', 'c.nombre_comercial', 'cla.clave as clase', 'sub.subcategoria')
            ->where('e.id', '=', $id)
            ->first();

        return response()->json($estatus);
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
        $estatus = Estatus::findOrFail($id);

        $this->validate($request,
            [
                'id_bitacoras_estatus' => 'required',
                'id_subcategoria' => 'required',
                'id_estatus' => 'required',
                'numero_expediente' => ($request->get('numero_expediente') != "") ? 'unique_with:bitacoras_estatus,'.$estatus->id : '',
                'numero_registro' => ($request->get('numero_registro') != "") ? 'unique_with:bitacoras_estatus,'.$estatus->id : '',
                'codigo_barras' => ($request->get('codigo_barras') != "") ? 'unique_with:bitacoras_estatus,'.$estatus->id : ''
            ]);

        $estatus->numero_expediente = $request->numero_expediente;
        $estatus->numero_registro = $request->numero_registro;
        $estatus->patente = $request->patente;
        $estatus->codigo_barras = $request->codigo_barras;
        $estatus->comprobacion = $request->comprobacion;
        $estatus->vencimiento = $request->vencimiento;
        $estatus->recordatorio = $request->recordatorio;
        $estatus->renovacion = $request->renovacion;
        $estatus->comprobacion_uso = $request->comprobacion_uso;
        $estatus->fecha_inicio = $request->fecha_inicio;
        $estatus->fecha_recordatorio = $request->fecha_recordatorio;
        $estatus->fecha_vencimiento = $request->fecha_vencimiento;
        $estatus->fecha_comprobacion_uso = $request->fecha_comprobacion_uso;
        $estatus->id_bitacoras_estatus = $request->id_bitacoras_estatus;
        $estatus->id_estatus = $request->id_estatus;
        $estatus->id_subcategoria = $request->id_subcategoria;
        $estatus->update();

        return response()->json($estatus);
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

    public function estatus_marca($id_control)
    {
        $estatus = DB::table('bitacoras_estatus as bit')
            ->join('control as mar', 'mar.id', '=', 'bit.id_marca')
            ->join('listado_estatus as li', 'li.id', '=', 'bit.id_estatus')
            ->leftjoin('subcategoria_servicios as sub', 'bit.id_subcategoria', '=', 'sub.id')
            ->join('categoria_estatus as cat', 'cat.id', '=', 'bit.id_bitacoras_estatus')
            ->select('bit.*', 'mar.nombre', 'li.estatus', 'cat.bitacora', 'cat.clave', 'li.texto', 'li.color', 'sub.subcategoria')
            ->where('bit.id_marca', '=', $id_control)
            ->where('bit.renovacion', '=', '1')
            ->orderBy('bit.fecha_vencimiento', 'asc')
            ->get();

        $mytime = Carbon::now('America/Chihuahua');
        $fecha_hoy = $mytime->toDateString();

            //return $estatus;

        return view('admin.bitacoras.estatus-listado', compact('estatus', 'fecha_hoy'));
    }

    public function editar_estatus($id_estatus)
    {
        $estatus = DB::table('bitacoras_estatus as est') 
            ->leftjoin('servicios as s', 's.id_estatus', '=', 'est.id')  
            ->leftjoin('subcategoria_servicios as sub', 'est.id_subcategoria', '=', 'sub.id')
            ->leftjoin('listado_estatus as li', 'est.id_estatus', '=', 'li.id')
            ->select('est.*', 's.id as id_servicio', 'sub.subcategoria', 'li.estatus', 'li.color', 'li.texto')
            ->where('est.id', '=', $id_estatus)
            ->first();

        return response()->json($estatus);
    }

    public function editar_servicio($id)
    {
        $servicio = DB::table('servicios as s')
            ->select('s.*')
            ->where('s.id', '=', $id)
            ->first();

        return response()->json($servicio);
    }

    public function subcategoria($id)
    {
        $subcategorias = DB::table('subcategoria_servicios as sub')
            ->join('categoria_estatus as cat', 'cat.id', '=', 'sub.id_categoria')
            ->select('sub.*', 'cat.bitacora')
            ->where('sub.id_categoria', '=', $id)
            ->where('sub.estatus', '=', '1')
            ->get();

        return response()->json($subcategorias);
    }

    public function estatus_listado($id)
    {
        $listados = DB::table('listado_estatus as l')
            ->join('categoria_estatus as cat', 'cat.id', '=', 'l.id_bitacoras_estatus')
            ->select('l.*', 'cat.bitacora')
            ->where('l.id_bitacoras_estatus', '=', $id)
            ->where('l.activo', '=', '1')
            ->get();

        return response()->json($listados);
    }

    public function enviar_fechas($id, $fecha_inicio, $declaracion, $recordatorio, $vencimiento, $aplica_comprobacion)
    {
        if($aplica_comprobacion == 1)
        {
            $fecha_comprobacion_uso = Carbon::createFromFormat('Y-m-d', $fecha_inicio)->addDays($declaracion)->toDateString();
        }
        else if($aplica_comprobacion == 0)
        {
            $fecha_comprobacion_uso = '';
        }
        
        $fecha_recordatorio = Carbon::createFromFormat('Y-m-d', $fecha_inicio)->addDays($recordatorio)->toDateString();
        $fecha_vencimiento = Carbon::createFromFormat('Y-m-d', $fecha_inicio)->addDays($vencimiento)->toDateString();

        $fechas = compact('fecha_comprobacion_uso', 'fecha_recordatorio', 'fecha_vencimiento');

        return response()->json($fechas);
    }

    //Comentarios
    public function comentarios($id)
    {
        Carbon::setLocale('es');
        $comentarios = DB::table('servicios_comentarios as com')
            //->leftjoin('servicios as s', 's.id', '=', 'com.id_servicio')
            ->leftjoin('users as ad', 'ad.id', '=', 'com.id_admin')
            //->leftjoin('control as c', 'c.id', '=', 'com.id_control')
            ->select('com.id', 'com.comentario', 'com.created_at', 'com.updated_at', 'com.id_servicio', 'com.id_admin', 'ad.iniciales', 'ad.nombre', 'ad.apellido', 'ad.imagen')
            ->where('com.id_estatus', '=', $id)
            ->orderBy('com.created_at', 'asc')
            ->get();

        return view('admin.estatus.historial', compact('comentarios'));
    }
}













