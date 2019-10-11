@if(count($recibos) > 0)
	@foreach($recibos as $rec)
	    <a target="_blank" href="{{ route('facturas.edit', $rec->id_factura) }}">{{ $rec->folio_recibo }}</a>
	@endforeach
@endif