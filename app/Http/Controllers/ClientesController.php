<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Emporio\Model\Clientes;
use Emporio\User;
use Emporio\Model\Estrategias;
use Emporio\Model\Contactos;
use Emporio\Model\ClientesUser;
use Emporio\Model\RazonSocial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use Image;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
    	Carbon::setLocale('es');
        $estrategias = Estrategias::orderBy('estrategia','asc')->where('estatus','=','1')->get();

        return view('admin.clientes.clientes.index', compact('estrategias'));
    }

    public function listar()
    {
        $clientes=DB::table('clientes as c')
            ->join('users as a', 'c.id_admin', '=', 'a.id')
            ->join('estrategias as e', 'c.id_estrategia', '=', 'e.id')
            ->leftjoin('razones_sociales as raz', 'raz.id_cliente', '=', 'c.id')
            ->leftjoin('control as mar', 'mar.id_cliente', '=', 'c.id')
            ->leftjoin('clientes_users as us', 'us.id_cliente', '=', 'c.id')
            ->select('c.id', 'c.nombre_comercial', 'c.logo', 'c.pagina_web', 'c.logo', 'c.carpeta', 'c.comentarios', 'c.estatus', 'c.created_at', 'c.updated_at', 'a.nombre', 'a.apellido', 'a.iniciales', 'e.estrategia', 'c.id_admin', 'c.id_estrategia', 'c.saldo')
            ->orderBy('c.nombre_comercial', 'asc')
            ->groupBy('c.id', 'c.nombre_comercial', 'c.logo', 'c.pagina_web', 'c.carpeta', 'c.comentarios', 'c.estatus', 'c.created_at', 'c.updated_at', 'a.nombre', 'a.apellido', 'a.iniciales', 'e.estrategia', 'c.id_admin', 'c.id_estrategia', 'c.saldo')
            ->paginate(50);


        return view('admin.clientes.clientes.listado', compact('clientes'));
    }

    public function buscar($buscar)
    {
        $clientes=DB::table('clientes as c')
            ->join('users as a', 'c.id_admin', '=', 'a.id')
            ->join('estrategias as e', 'c.id_estrategia', '=', 'e.id')
            ->leftjoin('razones_sociales as raz', 'raz.id_cliente', '=', 'c.id')
            ->leftjoin('control as mar', 'mar.id_cliente', '=', 'c.id')
            ->leftjoin('clientes_users as us', 'us.id_cliente', '=', 'c.id')
            ->select('c.id', 'c.nombre_comercial', 'c.logo', 'c.pagina_web', 'c.logo', 'c.carpeta', 'c.comentarios', 'c.estatus', 'c.created_at', 'c.updated_at', 'a.nombre', 'a.apellido', 'a.iniciales', 'e.estrategia', 'c.id_admin', 'c.id_estrategia', 'c.saldo')
            ->where('c.id','LIKE','%'.$buscar.'%')
            ->orWhere('c.nombre_comercial','LIKE','%'.$buscar.'%')
            ->orWhere('c.logo','LIKE','%'.$buscar.'%')
            ->orWhere('c.pagina_web','LIKE','%'.$buscar.'%')
            ->orWhere('c.carpeta','LIKE','%'.$buscar.'%')
            ->orWhere('c.comentarios','LIKE','%'.$buscar.'%')
            ->orWhere('c.estatus','LIKE','%'.$buscar.'%')
            ->orWhere('a.nombre','LIKE','%'.$buscar.'%')
            ->orWhere('a.apellido','LIKE','%'.$buscar.'%')
            ->orWhere('a.iniciales','LIKE','%'.$buscar.'%')
            ->orWhere('e.estrategia','LIKE','%'.$buscar.'%')
            ->orderBy('c.nombre_comercial', 'asc')
            ->groupBy('c.id', 'c.nombre_comercial', 'c.logo', 'c.pagina_web', 'c.carpeta', 'c.comentarios', 'c.estatus', 'c.created_at', 'c.updated_at', 'a.nombre', 'a.apellido', 'a.iniciales', 'e.estrategia', 'c.id_admin', 'c.id_estrategia', 'c.saldo')
            ->paginate(50);


        return view('admin.clientes.clientes.listado', compact('clientes'));
    }

    public function actualizar($id)
    {
        $cliente = DB::table('clientes as c')
            ->join('users as a', 'c.id_admin', '=', 'a.id')
            ->join('estrategias as e', 'c.id_estrategia', '=', 'e.id')
            ->leftjoin('razones_sociales as raz', 'raz.id_cliente', '=', 'c.id')
            ->leftjoin('control as mar', 'mar.id_cliente', '=', 'c.id')
            ->leftjoin('clientes_users as us', 'us.id_cliente', '=', 'c.id')
            ->select('c.id', 'c.nombre_comercial', 'c.logo', 'c.pagina_web', 'c.logo', 'c.carpeta', 'c.comentarios', 'c.estatus', 'c.created_at', 'c.updated_at', 'a.nombre', 'a.apellido', 'a.iniciales', 'e.estrategia', 'c.id_admin', 'c.id_estrategia', 'c.saldo')
            ->addSelect(DB::raw('count(raz.id_cliente) as razones'))
            ->addSelect(DB::raw('count(mar.id_cliente) as marcas'))
            ->addSelect(DB::raw('count(us.id_cliente) as usuarios'))
            ->where('c.id', '=', $id)
            ->orderBy('c.nombre_comercial', 'asc')
            ->groupBy('c.id', 'c.nombre_comercial', 'c.logo', 'c.pagina_web', 'c.carpeta', 'c.comentarios', 'c.estatus', 'c.created_at', 'c.updated_at', 'a.nombre', 'a.apellido', 'a.iniciales', 'e.estrategia', 'c.id_admin', 'c.id_estrategia', 'c.saldo')
            ->first();

        return view('admin.clientes.clientes.listado-actualizar', compact('cliente'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'nombre_comercial'=>'required|max:50|unique:clientes',
                'logo' => 'image|max:10240|mimes:jpeg,jpg,png,gif,svg',
                'pagina_web' => 'max:100',
                'carpeta' => 'max:300',
                'id_estrategia' => 'required'
            ]);

        $cliente = new Clientes;
        $cliente->nombre_comercial=$request->nombre_comercial;
        $cliente->pagina_web=$request->pagina_web;
        $cliente->carpeta=$request->carpeta;
        $cliente->comentarios=$request->comentarios;
        $cliente->estatus = $request->estatus;
        $cliente->id_admin=$request->id_admin;
        $cliente->id_estrategia=$request->id_estrategia;

        if($request->hasFile('logo'))
        {
            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $path = 'images/clients/' . $filename;
            Image::make($logo->getRealPath())->save($path);
            $cliente->logo = $filename;
        }
        else
        {
            $cliente->logo='cliente.png';
        }

        $cliente->save();
        
        return response()->json($cliente);
    }

    public function getLogo($id)
    {
        $cliente = DB::table('clientes')
            ->select('logo')
            ->where('id', '=', $id)
            ->first();

        return view('admin.clientes.clientes.logo', compact('cliente'));
    }

    public function cargarLogo(Request $request, $id)
    {
        $cliente = Clientes::findOrFail($id);

        $this->validate($request,
            [
                'logo'=>'image|max:10240|mimes:jpeg,jpg,png,gif,svg'
            ]);

        if($request->hasFile('logo'))
        {
            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $path = 'images/clients/' . $filename;
            Image::make($logo->getRealPath())->save($path);
            $cliente->logo = $filename;
        }
        else
        {
            //$cliente->logo='cliente.png';
        }

        $cliente->save();

        return response()->json($cliente);
    }

    public function getSaldo($id)
    {
        $saldo = Clientes::select('saldo')->where('id', '=', $id)->first();

        return response()->json($saldo);
    }

    public function edit($id)
    {
        Carbon::setLocale('es');
        $cliente = Clientes::findOrFail($id);

        return response()->json($cliente);
    }

    public function edit_creado()
    {
        $cliente = Clientes::find($id);
        return view('admin.clientes.edit-creado', compact('cliente'));
    }

    public function estrategia_crear(Request $request)
    {
        $this->validate($request,
            [
                'estrategia'=>'required|max:50|unique:estrategias'
            ]);

        $estrategia = new Estrategias;
        $estrategia->estrategia=$request->estrategia;
        $estrategia->estatus = "1";
        $estrategia->save();
        
        $mensaje = array(
                    'message' => 'Se creó la Estrategia exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    /*public function edit($id)
    {
        Carbon::setLocale('es');
        $cliente = Clientes::find($id);

        $razones_sociales=DB::table('razones_sociales')
            ->orderBy('id','ASC')
            ->Where('id_cliente','=', $cliente->id)
            ->get();

        $paises=DB::table('paises')
            ->orderBy('id','ASC')
            ->Where('estatus','=', '1')
            ->get();
            
        $estados=DB::table('estados')
            ->orderBy('estado','ASC')
            ->Where('estatus','=', '1')
            ->get();

        $users=DB::table('clientes_users')
            ->orderBy('nombre','ASC')
            ->Where('id_cliente','=', $cliente->id)
            ->get();

        return view('admin.clientes.edit-creado', compact('cliente', 'razones_sociales', 'users', 'paises', 'estados'));
    }*/

    public function update(Request $request, $id)
    {
        $cliente = Clientes::findOrFail($id);

        $this->validate($request,
            [
                'nombre_comercial'=>'required|max:50|unique_with:clientes,'.$cliente->id,
                'pagina_web' => 'max:100',
                'carpeta' => 'max:300'
            ]);
        
        $cliente->nombre_comercial=$request->nombre_comercial;
        $cliente->pagina_web=$request->pagina_web;
        $cliente->carpeta=$request->carpeta;
        $cliente->comentarios=$request->comentarios;
        $cliente->estatus = $request->estatus;
        $cliente->id_estrategia=$request->id_estrategia;

        $cliente->update();

        return response()->json($cliente);
    }

    public function status(Request $request, $id)
    {
        $cliente = Clientes::findOrFail($id);
        $cliente->estatus=$request->estatus;
        $cliente->update();
        
        return response()->json($cliente);
    }

    public function carpeta(Request $request, $id)
    {
    	$this->validate($request,
            [
                'carpeta'=>'required|max:300',
            ]);

        $cliente = Clientes::findOrFail($id);
        $cliente->carpeta=$request->carpeta;
        $cliente->update();

        return response()->json($cliente);
    }

    //Razones sociales
    public function razones_index(Request $request, $id)
    {
        $razones_sociales=DB::table('razones_sociales as r')
            ->select('r.*')
            ->orderBy('r.id','ASC')
            ->Where('r.id_cliente','=', $id)
            ->get();

        return view('admin.clientes.clientes.listado-razones', compact('razones_sociales'));
    }

    public function razon_insertar(Request $request)
    {
        $this->validate($request,
            [
                'razon_social'=>'required|max:200|unique_with: razones_sociales, id_cliente',
                'rfc'=>'required|max:15|unique_with: razones_sociales, id_cliente',
            ]);

        $razon = new RazonSocial;
        $razon->razon_social = $request->razon_social;
        $razon->rfc = $request->rfc;
        $razon->id_cliente = $request->id_cliente;
        $razon->save();

        return response()->json($razon);
    }

    public function razon_actualizar(Request $request, $id)
    {
        $razon = RazonSocial::findOrFail($id);

        $this->validate($request,
            [
                'razon_social'=>'required|max:200|unique_with: razones_sociales, id_cliente,'.$id,
                'rfc'=>'required|max:15|unique_with: razones_sociales, id_cliente,'.$id,
            ]);

        $razon->razon_social = $request->razon_social;
        $razon->rfc = $request->rfc;
        $razon->update();

        return response()->json($razon);
    }

    public function razon_status(Request $request, $id)
    {
        $razon = RazonSocial::findOrFail($id);
        $razon->estatus=$request->estatus;
        $razon->update();
        
        return response()->json($razon);
    }

    public function clientes_usuarios($id)
    {
        Carbon::setLocale('es');
        $cliente = Clientes::find($id);
        $users=DB::table('clientes_users')
            ->orderBy('nombre','ASC')
            ->where('id_cliente', '=', $cliente)
            ->get();
        
        
        return view('admin.clientes.usuarios', compact('cliente', 'users'));
    }

    public function usuarios_crear(Request $request)
    {
        $this->validate($request, 
            [
                'nombre' => 'required', 
                'email' => 'unique:users',
            ]);

        User::create($request->all());

        return;
    }

    public function user_index(Request $request, $id)
    {
        $cliente = Clientes::find($id);

        $razones_sociales=DB::table('razones_sociales')
            ->orderBy('id','ASC')
            ->Where('id_cliente','=', $cliente->id)
            ->get();

        $users=DB::table('clientes_users')
            ->orderBy('nombre','ASC')
            ->Where('id_cliente','=', $cliente->id)
            ->get();

        return view('admin.clientes.users.clientes.index', compact('cliente', 'razones_sociales', 'users'));
    }

    

    public function marcas_index(Request $request, $id)
    {
        $cliente = Clientes::find($id);

        $clientes = Clientes::orderBy('nombre_comercial', 'asc')->where('estatus', '=', '1')->get();

        $controles=DB::table('control as c')
            ->join('users as a', 'a.id', 'c.id_admin')
            ->select('c.id', 'c.nombre', 'c.descripcion', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.id_admin', 'c.id_cliente', 'a.nombre as user', 'a.iniciales', 'a.apellido')
            ->orderBy('id','ASC')
            ->Where('id_cliente','=', $cliente->id)
            /*->groupBy('c.id', 'c.nombre', 'c.descripcion', 'c.estatus', 'c.created_at', 'c.updated_at', 'c.id_admin', 'c.id_cliente')*/
            ->get();

        return view('admin.clientes.marcas.index', compact('cliente', 'controles', 'clientes'));
    }

    public function saldos($id)
    {
        $saldo = Clientes::select('saldo')->where('id', '=', $id)->first();

        return response()->json($saldo);
    }

    //Contactos
    public function listado_contactos($id_cliente)
    {
        $contactos = DB::table('clientes_users')
            ->select('id', 'puesto', 'titulo', 'area', 'nombre', 'email', 'email2', 'telefono', 'telefono2', 'telefono3', 'comentarios', 'id_cliente', 'created_at')
            ->where('id_cliente', '=', $id_cliente)
            ->get();

        return view('admin.clientes.contactos.listado-contactos', compact('contactos'));
    }

    public function contactos_insertar(Request $request)
    {
        $this->validate($request, 
            [
                'nombre' => 'required|unique_with: clientes_users, id_cliente', 
                'email' => ($request->get('email') != '') ? 'email' : "",
                'email2' => ($request->get('email2') != '') ? 'email' : "",
            ]);

        $contacto = new Contactos;
        $contacto->nombre = $request->nombre;
        $contacto->puesto = $request->puesto;
        $contacto->titulo = $request->titulo;
        $contacto->area = $request->area;
        $contacto->telefono = $request->telefono;
        $contacto->telefono2 = $request->telefono2;
        $contacto->telefono3 = $request->telefono3;
        $contacto->email = $request->email;
        $contacto->email2 = $request->email2;
        $contacto->comentarios = $request->comentarios;
        $contacto->id_cliente = $request->id_cliente;
        $contacto->save();

        return response()->json($contacto);
    }

    public function contactos_editar(Request $request, $id)
    {
        $contacto = Contactos::findOrFail($id);

        $this->validate($request, 
            [
                'nombre' => 'required|unique_with: clientes_users, id_cliente,'.$id, 
                'email' => ($request->get('email') != '') ? 'email' : "",
                'email2' => ($request->get('email2') != '') ? 'email' : "",
            ]);

        $contacto->nombre = $request->nombre;
        $contacto->puesto = $request->puesto;
        $contacto->titulo = $request->titulo;
        $contacto->area = $request->area;
        $contacto->telefono = $request->telefono;
        $contacto->telefono2 = $request->telefono2;
        $contacto->telefono3 = $request->telefono3;
        $contacto->email = $request->email;
        $contacto->email2 = $request->email2;
        $contacto->comentarios = $request->comentarios;
        $contacto->update();

        return response()->json($contacto);
    }
}








