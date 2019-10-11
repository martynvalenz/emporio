<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\User;
use Carbon\Carbon;
use Emporio\Model\Puestos;
use Emporio\Model\RoleModel;
use Caffeinated\Shinobi\Models\Role;
use DB;
use Image;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $puestos = Role::all();

    	return view('admin.users.index', compact('puestos'));
    }

    public function listado($estatus)
    {
        Carbon::setLocale('es');
        $users = DB::table('users as u') 
            ->leftjoin('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto');

            if($estatus == 'todos')
            {
                //
            }
            else if($estatus != 'todos')
            {
                $users->where('u.estatus', '=', $estatus);
            }
            $users = $users->get();

        return view('admin.users.listado', compact('users'));
    }

    public function buscar($estatus)
    {
        Carbon::setLocale('es');
        $users = DB::table('users as u') 
            ->leftjoin('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto')
            ->where('u.nombre', 'LIKE', '%'.$buscar.'%')
            ->orWhere('u.apellido', 'LIKE', '%'.$buscar.'%')
            ->orWhere('u.iniciales', 'LIKE', '%'.$buscar.'%')
            ->orWhere('u.rfc', 'LIKE', '%'.$buscar.'%')
            ->orWhere('r.name', 'LIKE', '%'.$buscar.'%')
            ->orWhere('u.colonia', 'LIKE', '%'.$buscar.'%')
            ->orWhere('u.calle', 'LIKE', '%'.$buscar.'%')
            ->paginate(10);

        return view('admin.users.listado', compact('users'));
    }

    public function actualizar($id)
    {
        Carbon::setLocale('es');
        $user  = DB::table('users as u') 
            ->leftjoin('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->leftjoin('roles as r', 'ru.role_id', '=', 'r.id')
            ->select('u.*', 'r.name as puesto')
            ->where('u.id', '=', $id)
            ->first();

        return view('admin.users.listado-actualizar', compact('user'));
    }

    public function puestos(Request $request)
    {
        $this->validate($request,
            [
                'puesto'=>'required|max:50|unique:puestos'
            ]);

        $puesto = new Puestos;
        $puesto->puesto=$request->puesto;
        $puesto->descripcion=$request->descripcion;
        $puesto->estatus = $request->has('estatus') ? 1 : 0;
        $puesto->save();

        $mensaje = array(
                    'message' => 'El puesto fue creado exitosamente.', 
                    'alert-type' => 'success'
                );

        return redirect(route('usuarios.index'))->with($mensaje);
    }

    public function create()
    {
        $puestos=DB::table('puestos')
            ->orderBy('puesto','ASC')
            ->where('estatus','=','1')
            ->get();
        $estados=DB::table('estados')->orderBy('estado','ASC')->get();
        $paises=DB::table('paises')->get();
        return view ('admin.users.create', ["puestos"=>$puestos, "estados"=>$estados, "paises"=>$paises]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'iniciales' => 'max:5|required|unique:users',
                'nombre'=>'required|max:50|string',
                'apellido'=>'required|max:50|string',
                'email'=> ($request->get('email') != '') ? 'max:50|email' : '',
                'usuario' => ($request->get('usuario') != '') ? 'max:30|unique:users': '',
                'password' => ($request->get('password') != "") ? 'min:6' : "",
                'sueldo_quincenal' => ($request->get('nomina') == 1) ? 'required|min:1' : "",
                'role_id' => 'required',
                'area' => 'required',
            ]);

        $user = new User;
        $user->area = $request->area;
        $user->iniciales = $request->iniciales;
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->usuario = $request->usuario;
        $user->email = $request->email;
        // $user->rfc = $request->rfc;
        // $user->imss = $request->imss;
        // $user->calle=$request->calle;
        // $user->numero=$request->numero;
        // $user->numero_int=$request->numero_int;
        // $user->colonia=$request->colonia;
        // $user->cp=$request->cp;
        // $user->localidad=$request->localidad;
        // $user->municipio=$request->municipio;
        // $user->id_estado=$request->id_estado;
        $user->id_pais='1';
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->oficina=$request->oficina;
        $user->imagen= 'avatar.png';
        //$user->comentarios=$request->comentarios;
        $user->estatus = $request->estatus;
        $user->acepta_comision = $request->acepta_comision;
        $user->responsabilidad = $request->responsabilidad;
        $user->nomina = $request->nomina;
        $user->remember_token = str_random(50);

        if($request->get('password') != "")
        {
            $user->contra = $request->password;
            $user->password=bcrypt($request->get('password'));
        }

        if($request->nomina == 0)
        {
            $user->sueldo_quincenal == 0;
            $user->sueldo_diario == 0;
        }
        else
        {
            $user->sueldo_quincenal = $request->sueldo_quincenal;

            $sueldo_diario = $request->sueldo_quincenal / 15;
            $user->sueldo_diario = $sueldo_diario;
        }

        $user->save();

        $role = new RoleModel;
        $role->role_id = $request->role_id;
        $role->user_id = $user->id;
        $role->save();
        
        return response()->json($user);
    }

    public function edit($id)
    {
        Carbon::setLocale('es');
        $user = DB::table('users as u')
            ->join('role_user as rol', 'rol.user_id', '=', 'u.id')
            ->select('u.*', 'rol.role_id')
            ->where('u.id', '=', $id)
            ->first();

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $this->validate($request,
            [
                'iniciales' => 'max:5|required|unique_with:users,'.$user->id,
                'nombre'=>'required|max:50|string',
                'apellido'=>'required|max:50|string',
                'email'=> ($request->get('email') != '') ? 'max:50|email' : '',
                'usuario' => ($request->get('usuario') != '') ? 'max:30|unique_with:users,'.$user->id: '',
                'password' => ($request->get('password') != "") ? 'min:6' : "",
                'sueldo_quincenal' => ($request->get('nomina') == 1) ? 'required|min:1' : "",
                'role_id' => 'required',
                'area' => 'required'
            ]);

        
        $user->area = $request->area;
        $user->iniciales = $request->iniciales;
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->usuario = $request->usuario;
        $user->email = $request->email;
        //$user->id_pais='1';
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->oficina=$request->oficina;
        $user->estatus = $request->estatus;
        $user->acepta_comision = $request->acepta_comision;
        $user->responsabilidad = $request->responsabilidad;
        $user->nomina = $request->nomina;
        $user->remember_token = str_random(50);

        if($request->get('password') != "")
        {
            $user->contra = $request->password;
            $user->password=bcrypt($request->get('password'));
        }

        if($request->nomina == 0)
        {
            $user->sueldo_quincenal == 0;
            $user->sueldo_diario == 0;
        }
        else
        {
            $user->sueldo_quincenal = $request->sueldo_quincenal;

            $sueldo_diario = $request->sueldo_quincenal / 15;
            $user->sueldo_diario = $sueldo_diario;
        }

        $user->update();

        $role = DB::table('role_user')
            ->where('user_id', '=', $id)
            ->update(
                [
                    'role_id' => $request->role_id
                ]);
        
        return response()->json($user);
    }

    public function contra(Request $request, $id)
    {
        if($request->get('password') != "")
        {   
            $user = User::findOrFail($id);

            $user->contra = $request->password;
            $user->password=bcrypt($request->get('password'));

            $user->update();
        }
        else
        {
            $user = 'No se actualizó la contraseña';
        }

        return response()->json($user);
    }

    public function estatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->estatus=$request->estatus;
        $user->update();
        
        return response()->json($user);
    }

    public function perfil()
    {
        Carbon::setLocale('es');
        return view('admin.users.perfil', array('usuario' => Auth::user()));
    }

    public function upload(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,
            [
                'imagen' => 'required|image|max:10240'
            ]);

        if($request->hasFile('imagen'))
        {
            $imagen = $request->file('imagen');
            $filename = time() . '.' . $imagen->getClientOriginalExtension();
            $path = 'images/users/' . $filename;
            Image::make($imagen->getRealPath())->save($path);
            $user->imagen = $filename;
            $user->update();
        }
        else
        {
            //return back();
        }
        
        return back();
    }

    public function perfil_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,
            [
                'password' => ($request->get('password') != "") ? 'required|confirmed' : "",
                'usuario' => 'max:50|required|unique_with:users,'.$user->id
            ]);

        $user->usuario = $request->usuario;
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->oficina=$request->oficina;

        if($request->get('password') != "")
        {
            $user->contra = $request->password;
            $user->password=bcrypt($request->get('password'));
        }
        else
        {
            //
        }

        $user->update();
        
        $mensaje = array(
                    'message' => 'El usuario fue editado exitosamente.', 
                    'alert-type' => 'success'
                );

        return back()->with($mensaje);
    }
}
