<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Clientes;
use Emporio\Model\ClientesUser;
use Emporio\Model\RazonSocial;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;

class ClienteUsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request) 
        {
            Carbon::setLocale('es');

            $query=trim($request->get('searchText'));
            $clientes = Clientes::orderBy('nombre_comercial', 'asc')
                ->where('estatus','=', '1')
                ->get();
            $razones_sociales = RazonSocial::orderBy('razon_social', 'asc')
                ->where('estatus','=', '1')
                ->get();
            $users=DB::table('clientes_users as u')
                ->leftjoin('clientes as c', 'u.id_cliente', '=', 'c.id')
                ->leftjoin('razones_sociales as raz', 'u.id_razon_social', '=', 'raz.id')
                ->select('u.id', 'u.puesto', 'u.titulo', 'u.area', 'u.nombre', 'u.user', 'u.email', 'u.email2','u.email3', 'u.contra', 'u.tipo', 'u.telefono', 'u.ext', 'u.tipo2', 'u.telefono2', 'u.ext2', 'u.tipo3', 'u.telefono3', 'u.ext3', 'u.estatus', 'u.id_cliente','u.created_at', 'u.updated_at','c.id', 'c.nombre_comercial', 'u.comentarios', 'u.id_razon_social', 'raz.razon_social', 'raz.rfc')
                ->where('u.puesto','LIKE','%'.$query.'%')
                ->orWhere('u.titulo','LIKE','%'.$query.'%')
                ->orWhere('u.area','LIKE','%'.$query.'%')
                ->orWhere('u.nombre','LIKE','%'.$query.'%')
                ->orWhere('u.email','LIKE','%'.$query.'%')
                ->orWhere('u.email2','LIKE','%'.$query.'%')
                ->orWhere('u.email3','LIKE','%'.$query.'%')
                ->orWhere('u.telefono','LIKE','%'.$query.'%')
                ->orWhere('u.telefono2','LIKE','%'.$query.'%')
                ->orWhere('u.telefono3','LIKE','%'.$query.'%')
                ->orWhere('c.nombre_comercial','LIKE','%'.$query.'%')
                ->orderBy('u.nombre', 'asc')
                ->paginate(25);

            return view('admin.clientes.users.index',["users"=>$users, "searchText"=>$query, "clientes" => $clientes, "razones_sociales"=>$razones_sociales]);
        }
    }

    /*public function getRazones($id) 
    {
        return RazonSocial::where('id_cliente', $request->id_cliente)->pluck('razon_social', 'id');
    }*/ 

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'nombre'=>'required|max:50',
                'password' => ($request->get('password') != "") ? 'required|confirmed' : "",
                'user' => ($request->get('user') != "") ? 'unique:users|max:50' : ""
            ]);

        $user = new User;
        $user->puesto=$request->puesto;
        $user->titulo=$request->titulo;
        $user->area=$request->area;
        $user->nombre=$request->nombre;
        $user->user=$request->user;
        $user->email=$request->email;
        $user->email2=$request->email2;
        $user->email3=$request->email3;
        if($request->get('password') != "")
        {
            $user->contra = $request->password;
            $user->password=bcrypt($request->get('password'));
        }
        else
        {

        }
        $user->tipo=$request->tipo;
        $user->tipo2=$request->tipo2;
        $user->tipo3=$request->tipo3;
        $user->telefono=$request->telefono;
        $user->telefono2=$request->telefono2;
        $user->telefono3=$request->telefono3;
        $user->ext=$request->ext;
        $user->ext2=$request->ext2;
        $user->ext3=$request->ext3;
        $user->comentarios=$request->comentarios;
        $user->id_cliente=$request->id_cliente;
        //$user->id_razon_social=$request->id_razon_social;
        $user->estatus = $request->has('estatus') ? 1 : 0;
        $user->save();
        
        $mensaje = array(
                    'message' => 'Se creó el contacto exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = ClientesUser::findOrFail($id);

        $this->validate($request,
            [
                'nombre'=>'required|max:50',
                'password' => ($request->get('password') != "") ? 'required|confirmed' : "",
                'user' => ($request->get('user') != "") ? 'max:50|unique_with:users,'.$user->id : ""
            ]);

        
        $user->puesto=$request->puesto;
        $user->titulo=$request->titulo;
        $user->area=$request->area;
        $user->nombre=$request->nombre;
        $user->email=$request->email;
        $user->email2=$request->email2;
        $user->email3=$request->email3;
        $user->tipo=$request->tipo;
        $user->tipo2=$request->tipo2;
        $user->tipo3=$request->tipo3;
        $user->telefono=$request->telefono;
        $user->telefono2=$request->telefono2;
        $user->telefono3=$request->telefono3;
        $user->ext=$request->ext;
        $user->ext2=$request->ext2;
        $user->ext3=$request->ext3;
        $user->comentarios=$request->comentarios;
        $user->id_cliente=$request->id_cliente;
        //$user->estatus = $request->has('estatus') ? 1 : 0;
        $user->user=$request->user;

        if($request->get('password') != "")
        {
            $user->contra = $request->password;
            $user->password=bcrypt($request->get('password'));
        }
        else
        {
            //
        }

        //$user->id_razon_social=$request->id_razon_social;
        $user->update();
        
        $mensaje = array(
                    'message' => 'Se editó el contacto exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }

    public function activar_inactivar(Request $request, $id)
    {
        $user = ClientesUser::findOrFail($id);
        $user->estatus=$request->estatus;
        $user->update();
        
        $mensaje = array(
                    'message' => 'Se cambió el estatus del usuario.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }

    public function destroy($id)
    {
        $user = ClientesUser::findOrFail($id);
        $user->delete();
        
        $mensaje = array(
                    'message' => 'Se eliminó el usuario.', 
                    'alert-type' => 'info'
                );

        return back()->with($mensaje);
    }
}
