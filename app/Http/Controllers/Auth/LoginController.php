<?php

namespace Emporio\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Emporio\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Emporio\User;
use Emporio\Model\LoginImagenes;
use Auth;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/emporio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function showLoginForm()
    {
        $imagen_principal = LoginImagenes::where('principal', '=', '1')->first();

        $imagenes = LoginImagenes::where('estatus', '=', '1')->orderBy('principal', 'desc')->orderBy('id', 'asc')->get();

        return view('auth.login', compact('imagenes', 'imagen_principal'));
    }

    protected function credentials(Request $request)
    {
        $user = User::where('usuario',$request->usuario)->first();

        if($user)
        {
            if ($user->estatus == 0) 
            {
                return['usuario'=>'Inactivo','password'=>'No eres un usuario activo, solicita acceso al administrador.'];
            }
            else
            {
                return['usuario'=>$request->usuario,'password'=>$request->password,'estatus'=>1];
            }
        }

        return $request->only($this->username(), 'password');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}






