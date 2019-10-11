$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function()
{
    Listar();
});

$('#btn-buscar').click(function()
{
	Seleccionar();
});

$('#buscar').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        Seleccionar();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

$('#btn-borrar').click(function()
{
	$('#buscar').val('');
	setTimeout(Seleccionar, 400);
});

function Listar()
{
	route = '/admin/honorarios-listar';

	$.ajax(
	{
	    type: 'get',
	    url: route,
	    success: function(data)
	    {
	        $('#listado').empty().html(data);
	        $(".tooltip").tooltip("hide");
	        setTimeout(CalcularTotal, 300);
	    }
	});
}

function Seleccionar()
{
	buscar = $('#buscar').val();

	if(buscar == '')
	{	
		route = '/admin/honorarios-pendientes';

		$.ajax(
		{
		    type: 'get',
		    url: route,
		    success: function(data)
		    {
		        $('#listado-pendientes').empty().html(data);
		        $(".tooltip").tooltip("hide");
		        $(function()
		        {
		            $('#listado-honorarios-pendientes').stickyTableHeaders();
		        });
		    }
		});
	}
	else
	{
		route = '/admin/honorarios-buscar/' + buscar;

		$.ajax(
		{
		    type: 'get',
		    url: route,
		    success: function(data)
		    {
		        $('#listado-pendientes').empty().html(data);
		        $(".tooltip").tooltip("hide");
		        $(function()
		        {
		            $('#listado-honorarios-pendientes').stickyTableHeaders();
		        });
		    }
		});
	}
}

$(document).on("click", ".pagination li a", function(e)
{
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-pendientes').empty().html(data);
        }
    });
});

function AgregarServicio(id, monto)
{
	token = $('#_token').val();
	monto_total = $('#monto_total_pendiente_val').val();
	gestionar_pago = 1;
	monto_total = monto_total * 1;

	formData = 
	{
		gestionar_pago
	}

	route = '/admin/honorarios-seleccionar/' + id;

	$.ajax(
	{
		url: route,
		headers: 
		{
			'X-CSRF-TOKEN': token
		},
		type: 'PUT',
		dataType: 'json',
		data: formData,
		success: function(data)
		{
			monto_total = monto_total - monto;
			$('#monto_total_pendiente_val').val(monto_total);
			$('#monto_total_pendiente').html(parseFloat(monto_total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
			$('#listado-pendiente-' + id).remove();
		},
		error: function(data)
		{
			toastr.error('No se puedo quitar el registro.');
			console.log(data);
		}

	});	
}

function QuitarServicio(id, monto)
{
	token = $('#_token').val();
	monto_total = $('#monto_total_val').val();
	gestionar_pago = 0;
	monto_total = monto_total * 1;

	formData = 
	{
		gestionar_pago
	}

	route = '/admin/honorarios-seleccionar/' + id;

	$.ajax(
	{
		url: route,
		headers: 
		{
			'X-CSRF-TOKEN': token
		},
		type: 'PUT',
		dataType: 'json',
		data: formData,
		success: function(data)
		{
			$('#listado-' + id).remove();
			setTimeout(CalcularTotal, 300);
		},
		error: function(data)
		{
			toastr.error('No se puedo quitar el registro.');
			console.log(data);
		}

	});	
}

function CalcularTotal()
{
	var sum = 0;
	var rows = $('#listado-honorarios tbody tr').length;

	if(rows == 0)
	{
		$('#monto_total').html('$ 0.00');
		$('#monto_total_val').val('0');
	}
	else if(rows > 0)
	{
		$(".honorarios_monto").each(function() {

		    var value = $(this).text();
		    // add only if the value is number
		    if(!isNaN(value) && value.length != 0) 
		    {
		        sum += parseFloat(value);

		        $('#monto_total').html('$ ' + parseFloat(sum, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
	                "$1,").toString());
		        $('#monto_total_val').val(sum);
		        $('#monto_egreso').val(sum);
		        $('#monto_egreso_val').val(sum);
		    }
		    else
		    {
		        $('#monto_total').html('$ 0.00');
				$('#monto_total_val').val('0');
				$('#monto_egreso').val('0');
		        $('#monto_egreso_val').val('0');
		    }
		});
	}
}

function Pagar()
{
	$('.modal-title').html('Pagar honorarios');
	$('.modal-header').css(
	{
		'background-color' : '#348FE2'
	});

	route = '/admin/egresos/ultimo-orden';
	$.get(route, function(data)
	{
		//console.log(data);
		orden = (data.orden * 1) + 1;
		$('#orden_egreso').val(orden);		
	});	

	route_proveedores = '/admin/honorarios-proveedores';

	$.get(route_proveedores, function(data)
    {
        $('#proveedor_egreso').empty();
        $('#proveedor_egreso').append('<option value="">-Sin selección-</option>');
        $.each(data, function(index, item)
        {
            $('#proveedor_egreso').append('<option value="'+ item.id +
			'">' + item.nombre_comercial + '</option>');
        });
    });

    CalcularTotal();
    QuitarErrores();
    BorrarDatos();
}

$('#id_cuenta_egreso').change(function()
{
	cuenta = $(this).val();

	if(cuenta == '')
	{
		$('#id_forma_pago_egreso').val('').change();
	}
	else if(cuenta == '1')
	{
		$('#id_forma_pago_egreso').val('1').change();
	}
	else
	{
		$('#id_forma_pago_egreso').val('3').change();
	}
});

$('#check_porcentaje_iva_egreso').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#check_porcentaje_iva_egreso_val").val(this.value);
}).change();

$('#btn-guardar-egreso').click(function()
{
	$('#btn-guardar-egreso').attr('disabled', 'disabled');
	token = $('#_token').val();
	id_admin = $('#id_admin').val();
	tipo = $('#tipo_egreso').val();
	orden = $('#orden_egreso').val();
	concepto = $('#concepto_egreso').val();
	fecha = $('#fecha').val();
	con_iva = $('#check_porcentaje_iva_egreso_val').val();
	porcentaje_iva = $('#porcentaje_iva_egreso').val();
	cheque = $('#cheque_egreso').val();
	movimiento = $('#movimiento_egreso').val();
	monto = $('#monto_egreso_val').val();
	id_cuenta = $('#id_cuenta_egreso').val();
	id_forma_pago = $('#id_forma_pago_egreso').val();
	id_proveedor = $('#proveedor_egreso').val();

	formData = {id_admin, tipo, orden, concepto, fecha, con_iva, porcentaje_iva, cheque, movimiento, monto, id_cuenta,
		id_forma_pago, id_proveedor}

	//console.log(formData);

	route = '/admin/honorarios-pagar';

	$.ajax(
	{
	    url: route,
	    headers:
	    {
	        'X-CSRF-TOKEN': token
	    },
	    type: 'POST',
	    dataType: 'json',
	    data: formData,
	    success: function(data)
	    {
	    	$('#btn-guardar-egreso').removeAttr('disabled');
	        toastr.success('Se generó el egreso de honorarios por un total de $' + data.retiro);
	        Listar();
	        BorrarDatos();
	        QuitarErrores();
	        $('#modal-pagar').modal('toggle');
	    },
	    error: function(data)
	    {
	    	$('#btn-guardar-egreso').removeAttr('disabled');
	        console.log(data);
	        if (data.responseJSON.errors.id_proveedor)
	        {
	            $("#proveedor_egreso_error").html(data.responseJSON.errors.id_proveedor);
	            $("#proveedor_egreso_error").fadeIn();
	        }
	        else
	        {
	            $("#proveedor_egreso_error").fadeOut();
	        }

	        if (data.responseJSON.errors.fecha)
	        {
	            $("#fecha_error").html(data.responseJSON.errors.fecha);
	            $("#fecha_error").fadeIn();
	        }
	        else
	        {
	            $("#fecha_error").fadeOut();
	        }

	        if (data.responseJSON.errors.id_cuenta)
	        {
	            $("#id_cuenta_egreso_error").html(data.responseJSON.errors.id_cuenta);
	            $("#id_cuenta_egreso_error").fadeIn();
	        }
	        else
	        {
	            $("#id_cuenta_egreso_error").fadeOut();
	        }

	        if (data.responseJSON.errors.id_forma_pago)
	        {
	            $("#id_forma_pago_egreso_error").html(data.responseJSON.errors.id_forma_pago);
	            $("#id_forma_pago_egreso_error").fadeIn();
	        }
	        else
	        {
	            $("#id_forma_pago_egreso_error").fadeOut();
	        }

	        if (data.responseJSON.errors.porcentaje_iva)
	        {
	            $("#porcentaje_iva_egreso_error").html(data.responseJSON.errors.porcentaje_iva);
	            $("#porcentaje_iva_egreso_error").fadeIn();
	        }
	        else
	        {
	            $("#porcentaje_iva_egreso_error").fadeOut();
	        }

	        if (data.responseJSON.errors.monto)
	        {
	            $("#monto_egreso_error").html(data.responseJSON.errors.monto);
	            $("#monto_egreso_error").fadeIn();
	        }
	        else
	        {
	            $("#monto_egreso_error").fadeOut();
	        }

	        //toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
	        if (data.status == 422)
	        {
	            console.clear();
	        }
	    }
	});
});

function QuitarErrores()
{
	$("#proveedor_egreso_error").fadeOut();
	$("#fecha_error").fadeOut();
	$("#id_cuenta_egreso_error").fadeOut();
	$("#id_forma_pago_egreso_error").fadeOut();
	$("#porcentaje_iva_egreso_error").fadeOut();
	$("#monto_egreso_error").fadeOut();
}

function BorrarDatos()
{
	$('#fecha').datepicker().datepicker('setDate', 'today');
    $('#id_cuenta_egreso').val('').change();
    $('#cheque_egreso').val('');
    $('#movimiento_egreso').val('');
    $('#concepto_egreso').val('');
}




















