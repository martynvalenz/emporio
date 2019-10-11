<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Emporio\Model\Metas;
use DB;

class MetasController extends Controller
{
    public function index()
    {
    	Carbon::setLocale('es');
    	$metas = Metas::orderBy('anio', 'desc')->get();

    	return view('admin.direccion.metas.index', compact('metas'));
    }
}
