<?php

namespace Emporio\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Emporio\Model\EstadosCuenta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use DB;

class EstadosCuentaExport implements FromCollection
{
    use Exportable;

    private $estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin;

    public function __construct($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin)
    {
        $this->estatus = $estatus;
        $this->tipo = $tipo;
        $this->cuenta = $cuenta;
        $this->forma_pago = $forma_pago;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function collection()
    {
    	Carbon::setLocale('es');
    	$estados_cuenta=DB::table('estados_cuenta as e')
    	    ->leftjoin('cuentas as cu', 'e.id_cuenta', '=', 'cu.id')
    	    ->leftjoin('bancos as b', 'cu.id_banco', '=', 'b.id')
    	    ->leftjoin('users as u', 'e.id_admin', '=', 'u.id')
    	    ->leftjoin('proveedores as p', 'e.id_proveedor', '=', 'p.id')
    	    ->leftjoin('users as com', 'e.id_comisionado', '=', 'com.id')
    	    ->leftjoin('cuentas as cu_tras', 'e.id_cuenta_traspaso', '=', 'cu_tras.id')
    	    ->leftjoin('formas_pago as f', 'e.id_forma_pago', '=', 'f.id')
    	    ->leftjoin('clientes as cli', 'e.id_cliente', '=', 'cli.id')
    	    ->select('e.*', 'f.forma_pago', 'f.codigo', 'cu.alias', 'b.banco', 'u.iniciales', 'u.nombre', 'u.apellido', 'p.nombre_comercial as proveedor', 'cli.nombre_comercial as cliente', 'cli.saldo as saldo_cliente', 'com.iniciales as iniciales_comisionado', 'com.nombre as nombre_comisionado', 'com.apellido as apellido_comisionado', 'cu_tras.alias as cuenta_traspaso')
    	    ->where('e.fecha', '>=', $this->fecha_inicio)
    	    ->where('e.fecha', '<=', $this->fecha_fin)
    	    ->orderBy('e.fecha', 'desc')
    	    ->orderBy('e.orden', 'desc');

    	    if($this->estatus == 'todos')
    	    {
    	        //
    	    }
    	    else if($this->estatus != 'todos')
    	    {
    	        $estados_cuenta->where('e.estatus', '=', $this->estatus);
    	    }

    	    if($this->tipo == 'todos')
    	    {
    	        //
    	    }
    	    else if($this->tipo != 'todos')
    	    {
    	        $estados_cuenta->where('e.tipo', '=', $this->tipo);
    	    }

    	    if($this->cuenta == 'todos')
    	    {
    	        //
    	    }
    	    else if($this->cuenta != 'todos')
    	    {
    	        $estados_cuenta->where('e.id_cuenta', '=', $this->cuenta);
    	    }

    	    if($this->forma_pago == 'todos')
    	    {
    	        //
    	    }
    	    else if($this->forma_pago != 'todos')
    	    {
    	        $estados_cuenta->where('e.id_forma_pago', '=', $this->forma_pago);
    	    }

    	    $estados_cuenta = $estados_cuenta->get();

        return $estados_cuenta;
    }
}
