<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Servicios;
use Emporio\Model\Facturas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('emporio.emporio');
    }
}
