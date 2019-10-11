$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function Facturas()
{
    ListarFacturas();
}

$('#facturas_select').on('change', function()
{   
    setTimeout(ListarFacturas, 300);
}); 

$("#btn-borrar-factura").click(function()
{
    //ResetearFecha();
    $('#buscar-factura').val('');
    setTimeout(ListarFacturas, 300);
});

$("#btn-buscar-factura").on("click", function(e)
{
    e.preventDefault();
    ListarFacturas();
});

$('#buscar-factura').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        ListarFacturas();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});
$(document).on("click", ".pagination-facturas .pagination li a", function(e)
{
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado').empty().html(data);
        }
    });
});

function ListarFacturas()
{
    var estatus = $("#facturas_select").val();
    var buscar = $("#buscar-factura").val();
    var url_listar = $('#url_listar_facturas').val();
    var url_buscar = $('#url_buscar_facturas').val();

    FechaRango = document.getElementById('reservation_factura').value.split('  -  ');
    fecha_inicio = FechaRango[0];
    fecha_fin = FechaRango[1];

    if(fecha_inicio == null)
    {
        $('#reservation_factura_error').html('La fecha inicial no puede estar vacía');
        $('#reservation_factura_error').fadeIn();
        ResetearFechaFactura();
    }
    else if(fecha_fin == null)
    {
        $('#reservation_factura_error').html('La fecha final no puede estar vacía');
        $('#reservation_factura_error').fadeIn();
        ResetearFechaFactura();
    }
    else if(fecha_inicio > fecha_fin)
    {
        $('#reservation_factura_error').html('La fecha inicial no puede ser mayor a la fecha final');
        $('#reservation_factura_error').fadeIn();
        ResetearFechaFactura();
    }
    else
    {
    	if (buscar == '')
    	{
    	    
    	    $.ajax(
    	    {
    	        type: 'get',
    	        url: url_listar + estatus + '/' + fecha_inicio + '/' + fecha_fin,
    	        success: function(data)
    	        {
    	            $('#listado-facturas').empty().html(data);
    	            $(".tooltip").tooltip("hide");
    	            $(function()
    	            {
    	                $('#example1').stickyTableHeaders();
    	            });
    	        }
    	    });
    	}
    	else
    	{
    	    $.ajax(
    	    {
    	        type: 'get',
    	        url: url_buscar + estatus + '/' + buscar + 
                '/' + fecha_inicio + '/' + fecha_fin,
    	        success: function(data)
    	        {
    	            $('#listado-facturas').empty().html(data);
    	            $(".tooltip").tooltip("hide");
    	            $(function()
    	            {
    	                $('#example1').stickyTableHeaders();
    	            });
    	        }
    	    });
    	}
    }
}
function FacturaNueva(id_factura)
{
    url_nuevo = $('#url_actualizar_facturas').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_nuevo + id_factura,
        success: function(data)
        {
            $('#list-factura').append(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });
}

function ActualizarFactura(id_factura)
{
	url_actualizar = $('#url_actualizar_facturas').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_actualizar + id_factura,
	    success: function(data)
	    {
	        $('#factura-' + id_factura).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

function ActualizarTotalesFactura(id_factura)
{
    route = '/admin/facturas-actualizar-totales/' + id_factura;

    $.get(route, function(data)
    {
		$("#subtotal_factura").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
	            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		$('#iva_factura').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
	            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		$('#total_factura').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
	            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		$('#subtotal_final_factura').val(data.subtotal);
		$('#iva_final_factura').val(data.iva);
		$('#total_final_factura').val(data.total);
		$('#pagado_factura').val(data.pagado);
		$('#saldo_factura').val(data.saldo);
    });
}

$('#reservation_factura').on('change', function()
{
    ListarFacturas();
});

function ResetearFechaFactura()
{
    fecha_inicio = $('#fecha_inicio_reset_factura').val();
    fecha_fin = $('#fecha_fin_reset_factura').val();
    $('#reservation_factura').val(fecha_inicio + '  -  ' + fecha_fin);
}

function CreateFactura()
{
	BorrarFactura();
	QuitarErroresFactura();
	$(".modal-title").html("Agregar Factura");
	$('.modal-header').css(
	{
	    'background-color': '#348FE2'
	});
	$('#btn-save-factura').html('Generar Factura <span class="fas fa-save"></span>');
	$('#fecha_factura').datepicker().datepicker('setDate', 'today');
	//$('#id_cliente_factura_text').attr('hidden', true);
	$('#id_cliente_factura_select').removeAttr('hidden');
	$('#id_cliente_factura_div').attr('hidden', 'hidden');
	cargarClientesFactura();
	$('#estatus_factura').val('Pendiente');
}

function EditFactura(id, estatus)
{
	$('#accion_factura').val('Edit');
	QuitarErroresFactura();
	$('#id_factura').val(id);
	$('#id_cliente_factura').empty();
	$('#estatus_factura').val(estatus);
	$('#btn-save-factura').html('Guardar <span class="fas fa-save"></span>');

	route = '/admin/factura-edit/' + id;

	$.get(route, function(data)
	{
		//console.log(data);
		$(".modal-title").html("Editar Factura: " + data.folio_factura);
		$('.modal-header').css(
		{
		    'background-color': '#49B6D6'
		});

		$('#id_cliente_factura_val').val(data.id_cliente);
		$('#id_cliente_factura').append('<option value ="' + data.id_cliente + '">' + data.nombre_comercial +
		            '</option><option value ="">-----------------------------</option>');
		$('#id_cliente_factura_text').val(data.nombre_comercial);

		if(data.id_razon_social == null)
		{
			$('#id_razon_social_factura').empty();
			$('#id_razon_social_factura').append('<option value="">-Sin razón social-</option>');
		}
		else
		{
			$('#id_razon_social_factura').empty();
			$('#id_razon_social_factura').append('<option value="'+data.id_razon_social+'" selected>'
				+data.razon_social+ '|' + data.rfc + '</option>');
			$('#id_razon_social_factura').append('<option value="">----------------------------</option>');
		}

		$('#fecha_factura').val(data.fecha);
		$('#folio_factura').val(data.folio_factura);
		$('#comentarios_factura').val(data.comentarios);
		$("#subtotal_factura").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		$('#iva_factura').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		$('#total_factura').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		$('#subtotal_final_factura').val(data.subtotal);
		$('#iva_final_factura').val(data.iva);
		$('#total_final_factura').val(data.total);
		$('#pagado_factura').val(data.pagado);
		$('#saldo_factura').val(data.saldo);
		$('#detalles_factura').val(data.detalles);

		MostrarServiciosPendientes(data.id_cliente, id);
		CargarRazones(data.id_cliente);
		//MostrarServiciosFacturados(id);

		detalles = data.detalles * 1;

		if(detalles > 0)
		{
			$('#id_cliente_factura_select').attr('hidden', 'hidden');
			$('#id_cliente_factura_div').removeAttr('hidden');
		}
		else if(detalles == 0)
		{
			//$('#id_cliente_factura_text').attr('hidden', true);
			$('#id_cliente_factura_select').removeAttr('hidden');
			$('#id_cliente_factura_div').attr('hidden', 'hidden');

			var route = "/admin/procesos/servicios/cargar_clientes";
			$.get(route, function(data)
			{
			    $.each(data, function(index, item)
			    {
			        $('#id_cliente_factura').append('<option value ="' + item.id + '">' + item.nombre_comercial +
			            '</option>');
			    });
			    $('#id_cliente_factura').selectpicker('refresh');
			});
		}
	});

	$('#accion_factura').val('Create');
}

$('#id_cliente_factura').change(function()
{
	$('#id_cliente_factura_error').fadeOut();
	id_cliente = $(this).val();
	id_factura = $('#id_factura').val();
	$('#id_cliente_factura_val').val(id_cliente);
	if(id_cliente == '')
	{
		$('#servicios-pendientes-facturar').empty();
	}
	else if(id_factura == '')
	{
		MostrarServiciosPendientes(id_cliente, 0);
		CargarRazones(id_cliente);
	}
	else
	{
		MostrarServiciosPendientes(id_cliente, id_factura);
		CargarRazones(id_cliente);
	}
});

function cargarClientesFactura()
{
	accion = $('#accion_factura').val();

	if(accion == 'Create')
	{
		var route = "/admin/procesos/servicios/cargar_clientes";
		$.get(route, function(data)
		{
		    $('#id_cliente_factura').empty();
		    $('#id_cliente_factura').append('<option value ="">-Seleccionar cliente-</option>');
		    $.each(data, function(index, item)
		    {
		        $('#id_cliente_factura').append('<option value ="' + item.id + '">' + item.nombre_comercial +
		            '</option>');
		    });
		    $('#id_cliente_factura').selectpicker('refresh');
		});
	}
	else if(accion == 'Edit')
	{
		//
	}
	
}

function CargarRazones(id_cliente)
{
	route = '/admin/facturas/get-razones/' + id_cliente;
	accion = $('#accion_factura').val();

	if(accion == 'Create')
	{
		$.get(route, function(data)
		{
			if(data == '')
			{
				$('#id_razon_social_factura').empty();
				$('#id_razon_social_factura').append('<option value="" selected>-Sin selección-</option>');
			}
			else
			{
				$('#id_razon_social_factura').empty();
				$('#id_razon_social_factura').append('<option value="" selected>-Sin selección-</option>');
				$.each(data, function(index, item)
				{
					$('#id_razon_social_factura').append('<option value="'+item.id+'">'+item.razon_social+
						'|' + item.rfc + '</option>');
				});
			}
			
		});	
	}
	else if(accion == 'Edit')
	{
		$.get(route, function(data)
		{
			$.each(data, function(index, item)
			{
				$('#id_razon_social_factura').append('<option value="'+item.id+'">'+item.razon_social+
					'|' + item.rfc + '</option>');
			});
		});	
	}	
}

$('#btn-save-factura').click(function()
{
	$('#btn-save-factura').attr('disabled', 'disabled');
	token = $('#_token').val();
	id_factura = $('#id_factura').val();
	id_cliente = $('#id_cliente_factura_val').val();
	id_admin = $('#id_admin').val();
	fecha = $('#fecha_factura').val();
	id_razon_social = $('#id_razon_social_factura').val();
	folio_factura = $('#folio_factura').val();
	comentarios = $('#comentarios_factura').val();
	subtotal = $('#subtotal_final_factura').val();
	iva = $('#iva_final_factura').val();
	porcentaje_iva = $('#porcentaje_iva_factura').val();
	total = $('#total_final_factura').val();
	pagado = $('#pagado_factura').val();
	saldo = $('#saldo_factura').val();
	tipo = $('#tipo_factura').val();
	con_iva = '1';

	formData = 
	{
		id_cliente, id_admin, fecha, id_razon_social, folio_factura, comentarios, subtotal, iva, porcentaje_iva, 
		total, pagado, saldo, tipo, con_iva
	}

	if(id_factura == '')
	{
		route = '/admin/facturas/store';
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
				$('#btn-save-factura').removeAttr('disabled');
				QuitarErroresFactura();
				FacturaNueva(data.id);
				$('#id_factura').val(data.id);
				toastr.success('Se creó la factura exitosamente. Asigne los servicios');

				$("#subtotal_factura").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
	            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#iva_factura').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
			            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#total_factura').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
			            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#subtotal_final_factura').val(data.subtotal);
				$('#iva_final_factura').val(data.iva);
				$('#total_final_factura').val(data.total);
				$('#pagado_factura').val(data.pagado);
				$('#saldo_factura').val(data.saldo);
			},
			error: function(data)
			{
				console.log(data);
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
				$('#btn-save-factura').removeAttr('disabled');
				if (data.responseJSON.errors.id_cliente)
				{
				    $("#id_cliente_factura_error").html(data.responseJSON.errors.id_cliente);
				    $("#id_cliente_factura_error").fadeIn();
				}
				else
				{
				    $("#id_cliente_factura_error").fadeOut();
				}

				if (data.responseJSON.errors.fecha)
				{
				    $("#fecha_factura_error").html(data.responseJSON.errors.fecha);
				    $("#fecha_factura_error").fadeIn();
				}
				else
				{
				    $("#fecha_factura_error").fadeOut();
				}

				if (data.responseJSON.errors.folio_factura)
				{
				    $("#folio_factura_error").html(data.responseJSON.errors.folio_factura);
				    $("#folio_factura_error").fadeIn();
				}
				else
				{
				    $("#folio_factura_error").fadeOut();
				}

				console.clear();
			}
		});
	}
	else
	{
		route = '/admin/facturas/update/' + id_factura;
		//console.log(route);
		//console.log(formData);
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
				$('#btn-save-factura').removeAttr('disabled');
				QuitarErroresFactura();
				ActualizarFactura(id_factura);
				$('#id_factura').val(data.id);
				toastr.success('Se actualizó la factura exitosamente. Asigne los servicios');

				$("#subtotal_factura").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
	            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#iva_factura').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
			            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#total_factura').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
			            /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#subtotal_final_factura').val(data.subtotal);
				$('#iva_final_factura').val(data.iva);
				$('#total_final_factura').val(data.total);
				$('#pagado_factura').val(data.pagado);
				$('#saldo_factura').val(data.saldo);
			},
			error: function(data)
			{
				console.log(data);
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
				$('#btn-save-factura').removeAttr('disabled');
				if (data.responseJSON.errors.id_cliente)
				{
				    $("#id_cliente_factura_error").html(data.responseJSON.errors.id_cliente);
				    $("#id_cliente_factura_error").fadeIn();
				}
				else
				{
				    $("#id_cliente_factura_error").fadeOut();
				}

				if (data.responseJSON.errors.fecha)
				{
				    $("#fecha_factura_error").html(data.responseJSON.errors.fecha);
				    $("#fecha_factura_error").fadeIn();
				}
				else
				{
				    $("#fecha_factura_error").fadeOut();
				}

				if (data.responseJSON.errors.folio_factura)
				{
				    $("#folio_factura_error").html(data.responseJSON.errors.folio_factura);
				    $("#folio_factura_error").fadeIn();
				}
				else
				{
				    $("#folio_factura_error").fadeOut();
				}

				console.clear();
			}
		});
	}
});

function FacturarServicio(id)
{
	id_cliente = $('#id_cliente_factura_val').val();
	id_factura = $('#id_factura').val();
	var cells = $('#servicio-facturar-' + id).children('td'); 
	var id_servicio = cells.eq(0).text();
	var monto = cells.eq(6).text();
	var monto_max = cells.eq(7).text();
	var costo = cells.eq(8).text();
	var facturado = cells.eq(9).text();
	var facturado_id_det = cells.eq(10).text();
	var id_det = cells.eq(11).text();

	monto = monto * 1;
	monto_max = monto_max * 1;
	costo = costo * 1;
	facturado = facturado * 1;

	valor = $('#servicio-pendiente-val-' + id).val();

	/*formData ={
		id_servicio, monto, monto_max, costo, facturado
	}*/

	//console.log(formData);

	if(monto > monto_max)
	{
	    toastr.error('El monto a facturar debe ser menor al monto pendiente del servicio, el cual es: ' + monto_max);
	    cells.eq(6).text(monto_max);
	    $('#servicio-pendiente-val-' + id_servicio).val(valor);
	    $('#servicio-pendiente-' + id_servicio).prop('checked', false);
	}
	else if(id_factura == '')
	{
	    toastr.error('Generar primero la factura');
	    $('#servicio-pendiente-val-' + id_servicio).val(valor);
	    $('#servicio-pendiente-' + id_servicio).prop('checked', false);
	}
	else if(valor == 0)
    {
    	valor = 1;
        insertarFactura(id_cliente, id_servicio, monto, monto_max, costo, facturado, valor);
    }   
    else if(valor == 1)
    {
    	valor = 0;
    	QuitarServicioFactura(id_det, id_servicio, facturado_id_det, monto, valor, monto_max);
    	//$('#servicio-pendiente-val-' + id).val(valor);
    }
}

function insertarFactura(id_cliente, id_servicio, monto, monto_max, costo, facturado, valor)
{
	id_factura = $('#id_factura').val();
	subtotal = $('#subtotal_final_factura').val();
	porcentaje_iva = $('#porcentaje_iva_factura').val();
	iva = $('#iva_final_factura').val();
	total = $('#total_final_factura').val();
	pagado = $('#pagado_factura').val();
	saldo = $('#saldo_factura').val();
	token = $('#_token').val();
	con_iva = 1;
	monto_pendiente = $('#facturado_pendiente_val').val();
	monto_pendiente = monto_pendiente * 1;
	monto = monto * 1;
	monto_max = monto_max * 1;

	var formData =
	{
		id_cliente, id_servicio, monto, costo, facturado, id_factura, subtotal,
		porcentaje_iva, iva, total, pagado, saldo, con_iva
	}

	//console.log(formData);
	$.ajax(
	{
	    url: '/admin/facturas/insertar-detalle/' + id_factura,
	    headers:
	    {
	        'X-CSRF-TOKEN': token
	    },
	    type: 'PUT',
	    dataType: 'json',
	    data: formData,
	    success: function(data)
	    {
	    	//console.log(data);
	        toastr.success('Se agregó el servicio a la factura.');
	        $('#servicio-pendiente-val-' + id_servicio).val(valor);
	        ActualizarTotalesFactura(id_factura);
			ActualizarFactura(id_factura);  
			var cells = $('#servicio-facturar-' + id_servicio).children('td');   
			monto_nuevo = monto_max - monto;  
			cells.eq(11).text(data.id);
			cells.eq(6).text(monto_nuevo);
			cells.eq(7).text(monto_nuevo);
			cells.eq(10).text(monto);
			cells.eq(5).text(parseFloat(monto, 10).toFixed(2).replace(
	                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
			pendiente = monto_pendiente - monto;
			$('#facturado_pendiente_val').val(pendiente);
			$('#facturado_pendiente').html(parseFloat(pendiente, 10).toFixed(2).replace(
	                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
	    },
	    error: function(data)
	    {
	        console.log(data);
	        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
	        if(valor == 1)
	        {
	        	valor = 0;
	        	$('#servicio-pendiente-'+id).prop( "checked", false );
	        	//$('#servicio-pendiente-val-' + id_servicio).val(valor);
	        }
	        else if(valor == 0)
	        {
	        	valor = 1;
	        	$('#servicio-pendiente-'+id).prop( "checked", true );
	        }
	    }
	});
}

function QuitarServicioFactura(id_det, id_servicio, facturado_id_det, monto, valor, monto_max)
{
	id_factura = $('#id_factura').val();
	subtotal = $('#subtotal_final_factura').val();
	porcentaje_iva = $('#porcentaje_iva_factura').val();
	iva = $('#iva_final_factura').val();
	total = $('#total_final_factura').val();
	pagado = $('#pagado_factura').val();
	saldo = $('#saldo_factura').val();
	token = $('#_token').val();
	con_iva = 1;
	monto_pendiente = $('#facturado_pendiente_val').val();
	monto_pendiente = monto_pendiente * 1;
	facturado = facturado_id_det * 1;
	monto = monto * 1;
	monto_max = monto_max * 1;

	var formData =
	{
		facturado_id_det, subtotal, porcentaje_iva, iva, total, pagado, saldo, con_iva
	}

	//console.log(formData);
	$.ajax(
	{
	    url: '/admin/facturas/eliminar-detalle/' + id_factura + '/' + id_det,
	    headers:
	    {
	        'X-CSRF-TOKEN': token
	    },
	    type: 'PUT',
	    dataType: 'json',
	    data: formData,
	    success: function(data)
	    {
	    	//console.log(data);
	        toastr.success('Se quitó el servicio de la factura.');
	        $('#servicio-pendiente-val-' + id_servicio).val(valor);

			ActualizarTotalesFactura(id_factura);
			ActualizarFactura(id_factura);  
			var cells = $('#servicio-facturar-' + id_servicio).children('td');  

			pendiente_val = (monto_max * 1) + (facturado_id_det * 1);
			cells.eq(6).text(pendiente_val);
			cells.eq(7).text(pendiente_val);
			cells.eq(10).text('0');
			cells.eq(11).text('');
			cells.eq(5).text('0');
			pendiente = monto_pendiente + pendiente_val;
			$('#facturado_pendiente_val').val(pendiente);
			$('#facturado_pendiente').html(parseFloat(pendiente, 10).toFixed(2).replace(
	                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());;
	    },
	    error: function(data)
	    {
	        console.log(data);
	        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
	        if(valor == 1)
	        {
	        	valor = 0;
	        	$('#servicio-pendiente-'+id).prop( "checked", false );
	        	//$('#servicio-pendiente-val-' + id_servicio).val(valor);
	        }
	        else if(valor == 0)
	        {
	        	valor = 1;
	        	$('#servicio-pendiente-'+id).prop( "checked", true );
	        }
	    }
	});
}

function MostrarServiciosPendientes(id_cliente, id_factura)
{
	estatus = $('#estatus_factura').val();
	route = '/admin/facturas/servicios-cliente/' + id_cliente + '/' + id_factura + '/' + estatus;

	$.ajax(
	{
	    type: 'get',
	    url: route,
	    success: function(data)
	    {
	        $('#servicios-pendientes-facturar').empty().html(data);
	        $(".tooltip").tooltip("hide");

	        if(estatus == 'Pendiente')
	        {
	        	$('.checkbox_servicio_div').show();
	        	$('.checkbox_servicio_pagado').hide();
	        }
	        else if(estatus == 'Pagado')
	        {
	        	$('.checkbox_servicio_div').hide();
	        	$('.checkbox_servicio_pagado').show();
	        }
	    }
	});
}

function MostrarServiciosFacturados(id_factura)
{
	route = '/admin/facturas/mostrar-servicios-facturados/' + id_factura;

	$.ajax(
	{
	    type: 'get',
	    url: route,
	    success: function(data)
	    {
	        $('#servicios-facturados').empty().html(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

function MostrarDetallesFactura(id_factura, folio, tipo)
{
	$(".modal-title").html("Detalles de " + tipo + ': ' + folio);
	$('.modal-header').css(
	{
	    'background-color': '#748BA4'
	});
	route = '/admin/facturas/mostrar-detalles/' + id_factura;

	$.ajax(
	{
	    type: 'get',
	    url: route,
	    success: function(data)
	    {
	        $('#factura-detalles').empty().html(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

$('#btn-cerrar-factura').click(function()
{
	BorrarFactura();
	QuitarErroresFactura();
});

function BorrarFactura()
{	
	$('#id_factura').val('');
	$('#accion_factura').val('Create');
	$('#comentarios_factura').val('');
	$('#subtotal_factura').html('$ 0.00');
	$('#iva_factura').html('$ 0.00');
	$('#total_factura').html('$ 0.00');
	$('#subtotal_final_factura').val('0');
	$('#iva_final_factura').val('0');
	$('#total_final_factura').val('0');
	$('#pagado_factura').val('0');
	$('#saldo_factura').val('0');
	$('#folio_factura').val('');
	$('#id_razon_social_factura').empty();
	$('#id_razon_social_factura').append('<option value="" selected>-Seleccionar opción-</option>');
	$('#id_cliente_factura').empty();
	//
	$('#id_cliente_factura_val').val('');
	$('#detalles_factura').val('0');
	$('#servicios-pendientes-facturar').empty();
	$('#servicios-facturados').empty();
	$('#fecha_factura').datepicker().datepicker('setDate', 'today');
}

function QuitarErroresFactura()
{
	$("#id_cliente_factura_error").fadeOut();
	$("#fecha_factura_error").fadeOut();
	$("#folio_factura_error").fadeOut();
}

function ActivarFactura(id)
{
    token = $('#_token').val();
    estatus = 'Pendiente';
    id_admin = $('#id_admin').val();
    formData =
    {
        estatus, id_admin
    }
    $.confirm(
    {
        title: '¿Desea activar la factura/egreso?',
        content: '',
        autoClose: 'Cerrar|5000',
        buttons: 
        {
            Cerrar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Activar',
                btnClass: 'btn-green any-other-class',
                action: function () 
                {
                    router = '/admin/factura/destroy/' + id;

                    $.ajax(
                    {
                        url: router,
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data)
                        {
                            toastr.info('Se activó la factura/egreso.');

                            ActualizarFactura(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar la factura/egreso.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function CancelarFactura(id)
{
    token = $('#_token').val();
    estatus = 'Cancelado';
    id_admin = $('#id_admin').val();
    formData =
    {
        estatus, id_admin
    }
    $.confirm(
    {
        title: '¿Desea cancelar la factura/recibo?',
        content: '',
        autoClose: 'Cerrar|5000',
        buttons: 
        {
            Cerrar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Cancelar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/factura/destroy/' + id;

                    $.ajax(
                    {
                        url: router,
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data)
                        {
                            toastr.info('Se canceló la factura/egreso.');

                            ActualizarFactura(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo cancelar la factura/egreso.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}


//Razon social
function AgregarRazonSocial()
{
	id_cliente = $('#id_cliente_factura_val').val();

	if(id_cliente == '')
	{
		$('#id_cliente_factura_error').html('Seleccione primero un cliente');
		$('#id_cliente_factura_error').fadeIn();
	}
	else
	{
		$('#modal-agregar-razon').modal('toggle');
		$('.header-razon-social').css(
		{
			'background-color' : '#49adad'
		});
	}
}

$('#btn-agregar-razon').click(function()
{
	$('#btn-agregar-razon').attr('disabled', 'disabled');
	token = $('#_token').val();
	id_admin = $('#id_admin').val();
	razon_social = $('#razon_social_razon').val();
	rfc = $('#rfc_razon').val();
	id_cliente = $('#id_cliente_factura_val').val();

	formData = {razon_social, rfc, id_admin, id_cliente}

	route = '/admin/facturas/insertar-razon';
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
			$('#btn-agregar-razon').removeAttr('disabled');
			QuitarErroresRazonSocial();
			BorrarDatosRazonSocial();
			$('#id_razon_social_factura').prepend('<option value="'+data.id_razon_social+'" selected>'
				+data.razon_social+ '|' + data.rfc + '</option>')
			toastr.success('Se agregó la razón social exitosamente.');
			$('#modal-agregar-razon').modal('toggle');
		},
		error: function(data)
		{
			console.log(data);
			toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
			$('#btn-agregar-razon').removeAttr('disabled');

			if (data.responseJSON.errors.razon_social)
			{
			    $("#razon_social_razon_error").html(data.responseJSON.errors.razon_social);
			    $("#razon_social_razon_error").fadeIn();
			}
			else
			{
			    $("#razon_social_razon_error").fadeOut();
			}

			if (data.responseJSON.errors.rfc)
			{
			    $("#rfc_razon_error").html(data.responseJSON.errors.rfc);
			    $("#rfc_razon_error").fadeIn();
			}
			else
			{
			    $("#rfc_razon_error").fadeOut();
			}

			//console.clear();
		}
	});
});

$(".cerrar-razon").click(function()
{
    $("#modal-agregar-razon").modal('toggle');
});

function QuitarErroresRazonSocial()
{
	$('#razon_social_razon_error').fadeOut();
	$('#rfc_razon_error').fadeOut();
}

function BorrarDatosRazonSocial()
{
	$('#razon_social_razon').val('');
	$('#rfc_razon').val('');
}
















