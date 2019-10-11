<?php

namespace Emporio\Http\Controllers;

use Illuminate\Http\Request;
use Emporio\Model\Colores;
use Emporio\Model\CategoriaEstatus;
use Carbon\Carbon;
use DB;

class ColoresController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            Carbon::setLocale('es');
            //$uso=trim($request->get('searchUso'));
            $categorias = CategoriaEstatus::where('estatus','=', '1')->orderBy('id', 'asc')->get();
            $listado = DB::table('listado_estatus as l')
                ->join('categoria_estatus as e', 'l.id_bitacoras_estatus', '=', 'e.id')
                ->select('l.id', 'l.estatus', 'l.id_bitacoras_estatus', 'l.activo', 'l.color', 'l.texto', 'l.created_at', 'l.updated_at', 'e.clave', 'e.bitacora')
                ->get();
            return view('admin.colores.index',["listado"=>$listado, "categorias"=>$categorias]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'estatus'=>'required|max:50|unique_with:listado_estatus, id_bitacoras_estatus',
                'id_bitacoras_estatus' => 'required',
                'color' => 'required',
                'texto' => 'required'
            ]);

        if($request)
        {
            $list = new Colores;
            $list->estatus = $request->estatus;
            $list->id_bitacoras_estatus = $request->id_bitacoras_estatus;
            $list->color = $request->color;
            $list->texto = $request->texto;
            $list->activo = $request->activo;
            $list->save();

            
        }

        return response()->json($list);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
