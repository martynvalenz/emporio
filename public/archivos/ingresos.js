$.ajaxSetup(
{
   headers: 
   {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

function Ingresos()
{
	ListarIngresos();
}

$('#reservation_ingresos').on('change', function()
{
    ListarIngresos();
});

$('#ingresos_estatus_select').on('change', function()
{   
    setTimeout(ListarIngresos, 300);
}); 

$('#ingresos_cuenta_select').on('change', function()
{  
    setTimeout(ListarIngresos, 300);
}); 

$('#ingresos_formas_pago_select').on('change', function()
{  
    setTimeout(ListarIngresos, 300);
}); 

$("#btn-borrar-ingresos").click(function()
{
    //ResetearFecha();
    $('#buscar-ingresos').val('');
    setTimeout(ListarIngresos, 300);
});
$("#btn-buscar-ingresos").on("click", function(e)
{
    e.preventDefault();
    ListarIngresos();
});

$('#buscar-ingresos').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        ListarIngresos();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

function ResetearFecha()
{
    fecha_inicio = $('#fecha_inicio_ingresos_reset').val();
    fecha_fin = $('#fecha_fin_ingresos_reset').val();
    $('#reservation_ingresos').val(fecha_inicio + '  -  ' + fecha_fin);
}

function ListarIngresos()
{
	url_listar = $('#url_listar_ingresos').val();
	url_buscar = $('#url_buscar_ingresos').val();

	estatus = $('#ingresos_estatus_select').val();
	cuenta = $('#ingresos_cuenta_select').val();
	forma_pago = $('#ingresos_formas_pago_select').val();
	buscar = $('#buscar-ingresos').val();

	FechaRango = document.getElementById('reservation_ingresos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];

	if(fecha_inicio == null)
	{
	    $('#reservation_ingresos_error').html('La fecha inicial no puede estar vacía');
	    $('#reservation_ingresos_error').fadeIn();
	}
	else if(fecha_fin == null)
	{
	    $('#reservation_ingresos_error').html('La fecha final no puede estar vacía');
	    $('#reservation_ingresos_error').fadeIn();
	}
	else if(fecha_inicio > fecha_fin)
	{
	    $('#reservation_ingresos_error').html('La fecha inicial no puede ser mayor a la fecha final');
	    $('#reservation_ingresos_error').fadeIn();
	    ResetearFechaEgreso();
	}
	else
	{
		if (buscar == '')
		{
		    
		    $.ajax(
		    {
		        type: 'get',
		        url: url_listar + estatus + '/' + cuenta + '/' + forma_pago 
		        + '/' + fecha_inicio + '/' + fecha_fin,
		        success: function(data)
		        {
		            $('#listado-ingresos').empty().html(data);
		            $(".tooltip").tooltip("hide");
		            $(function()
		            {
		                $('#example1').stickyTableHeaders();
		            });
		            
		            ActualizarIngresoMonto();
		        }
		    });
		}
		else
		{
		    $.ajax(
		    {
		        type: 'get',
		        url: url_buscar + estatus + '/' + cuenta + '/'  + forma_pago 
		        + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin,
		        success: function(data)
		        {
		            $('#listado-ingresos').empty().html(data);
		            $(".tooltip").tooltip("hide");
		            $(function()
		            {
		                $('#example1').stickyTableHeaders();
		            });

		            ActualizarIngresoMonto();
		        }
		    });
		}
	}
}

function ActualizarIngresoMonto()
{
	url_listar = $('#url_listar_ingresos').val();
	url_buscar = $('#url_buscar_ingresos').val();

	estatus = $('#ingresos_estatus_select').val();
	cuenta = $('#ingresos_cuenta_select').val();
	forma_pago = $('#ingresos_formas_pago_select').val();
	buscar = $('#buscar-ingresos').val();

	FechaRango = document.getElementById('reservation_ingresos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];

	if (buscar == '')
	{
		route = url_listar + 'total/' + estatus + '/' + cuenta + '/' + forma_pago 
        + '/' + fecha_inicio + '/' + fecha_fin;

		$.get(route, function(data)
		{
	    	$('#ingreso_monto_total').html('Total: $ ' + parseFloat(data, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
	    });
	}
	else
	{
		route = url_buscar + 'total/' + estatus + '/' + cuenta + '/'  + forma_pago 
		        + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin;

		$.get(route, function(data)
		{
	    	$('#ingreso_monto_total').html('Total: $ ' + parseFloat(data, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());	
	    });
	}

    
}

function AgregarIngresoListado(id)
{
	url_nuevo = $('#url_actualizar_ingresos').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_nuevo + id,
	    success: function(data)
	    {
	        $('#list-ingreso').prepend(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });

	        ActualizarIngresoMonto();
	    }
	});
}

function AcutalizarIngresoListado(id)
{
	url_actuailzar = $('#url_actualizar_ingresos').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_actuailzar + id,
	    success: function(data)
	    {
	        //console.log(data);
	        $('#listado-ingreso-' + id).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });

	        ActualizarIngresoMonto();
	    }
	}); 
}

$(document).on("click", ".ingresos-pagination .pagination li a", function(e)
{
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-ingresos').empty().html(data);
        }
    });
});

function CargarClientesIngreso()
{
	accion = $('#accion_ingreso').val();

	if(accion == 'Create')
	{
		var route = "/admin/procesos/servicios/cargar_clientes";
		$.get(route, function(data)
		{
		    $('#id_cliente_ingreso').empty();
		    $('#id_cliente_ingreso').append('<option value ="">-Seleccionar cliente-</option>');
		    $.each(data, function(index, item)
		    {
		        $('#id_cliente_ingreso').append('<option value ="' + item.id + '">' + item.nombre_comercial +
		            '</option>');
		    });
		    $('#id_cliente_ingreso').selectpicker('refresh');
		});
	}
	else if(accion == 'Edit')
	{
		//
	}
}

$('#id_cuenta_ingreso').change(function()
{
	cuenta = $(this).val();

	if(cuenta == 1)
	{
		$('#id_forma_pago_ingreso').val(cuenta).change();
	}
	else
	{
		$('#id_forma_pago_ingreso').val('').change();
	}
});

$('#tipo_ingreso').change(function()
{
	tipo = $(this).val();
	id_cliente = $('#id_cliente_ingreso_val').val();
	id_ingreso = $('#id_ingreso').val();

	if(tipo == 'Cliente')
	{
		//
	}
	else
	{
		$('#id_cliente_ingreso').val('').change();
	}
});

$('#id_cliente_ingreso').change(function()
{
	id_cliente = $(this).val();
	ClienteIngresoChange(id_cliente);
	// accion = $('#accion_ingreso').val();
	// //console.log(id_cliente);

	// if(accion == 'Create')
	// {

	// }
	// else if(accion == 'Edit')
	// {
	// 	//
	// }
});

function ClienteIngresoChange(id_cliente)
{
	accion = $('#accion_ingreso').val();

	if(accion == 'Create')
	{
		if(id_cliente == '')
		{
			$('#saldo_ingreso').val('0');
			$('#saldo_ingreso_val').val('0');
			$('#id_cliente_ingreso_val').val('');
		}
		else
		{
			$('#id_cliente_ingreso_val').val(id_cliente);
			route = '/admin/clientes/saldo/' + id_cliente;

			$.get(route, function(data)
			{
				//console.log(data);
				$('#saldo_ingreso').val(data.saldo);
				$('#saldo_ingreso_val').val(data.saldo);
			});
		}
	}
	else if(accion == 'Edit')
	{
		//
	}
}

function CreateIngreso()
{
	BorrarDatosIngresos();
	QuitarErroresIngresos();

	$('.modal-header').css(
	{
		'background-image': 'linear-gradient(to right, #7FC0BF, #54C8DF , #49B9E9)'
	});
	$('.modal-title').html('Agregar Ingreso');

	$('#btn-save-ingreso').html('Generar Ingreso <span class="fas fa-save"></span>');
	CargarClientesIngreso();

	route = '/admin/egresos/ultimo-orden';
	$.get(route, function(data)
	{
		//console.log(data);
		orden = (data.orden * 1) + 1;
		$('#orden_ingreso').val(orden);		
	});	
}

function EditIngreso(id)
{
	$('#accion_ingreso').val('Edit');
	$('#accion_ingreso').val('Edit');
	$('#id_ingreso').val(id);
	$('#id_cliente_ingreso').empty();
	QuitarErroresIngresos();
	$('#id_ingreso').val();
	$('.modal-title').html('Editar Ingreso: ' + id);
	$('.modal-header').css(
	{
		'background-image': 'linear-gradient(to right, #7FC0BF, #54C8DF , #49B9E9)'
	});
	$('#btn-save-ingreso').html('Guardar Ingreso <span class="fas fa-save"></span>');

	route = '/admin/ingresos/edit/' + id;

	$.get(route, function(data)
	{
		//console.log(data);
		$('#id_cliente_ingreso_val').val(data.id_cliente);
		$('#id_cliente_ingreso_ant').val(data.id_cliente);
		$('#fecha_ingreso').val(data.fecha);
		$('#tipo_ingreso').val(data.tipo).change();
		$('#id_cuenta_ingreso').val(data.id_cuenta);
		$('#id_forma_pago_ingreso').val(data.id_forma_pago);
		$('#monto_ingreso').val(data.deposito);
		$('#monto_ingreso_ant').val(data.deposito);
		if(data.id_cliente == null)
		{
			$('#id_cliente_ingreso').append('<option value="">-Sin selección-</option>');
			$('#saldo_ingreso').val('0');
			$('#saldo_ingreso_val').val('0');
			ClienteIngresoChange('');
		}
		else
		{
			$('#id_cliente_ingreso').append('<option value="' + data.id_cliente + '">' + data.nombre_comercial +
			            '</option><option>------------------------------</option>');
			$('#saldo_ingreso').val(data.saldo);
			$('#saldo_ingreso_val').val(data.saldo);
			$('#saldo_ingreso_ant').val(data.saldo);
			ClienteIngresoChange(data.id_cliente);

		}

		var route = "/admin/procesos/servicios/cargar_clientes";
		$.get(route, function(data)
		{
		    $.each(data, function(index, item)
		    {
		        $('#id_cliente_ingreso').append('<option value ="' + item.id + '">' + item.nombre_comercial +
		            '</option>');
		    });
		    $('#id_cliente_ingreso').selectpicker('refresh');
		});

		$('#movimiento_ingreso').val(data.movimiento);
		$('#cheque_ingreso').val(data.cheque);
		$('#comentarios_ingreso').val(data.comentarios);
	});

	$('#accion_ingreso').val('Create');
}

$('#btn-save-ingreso').click(function()
{
	$('#btn-save-ingreso').attr('disabled', 'disabled');
	id = $('#id_ingreso').val();
	tipo = $('#tipo_ingreso').val();
	id_cliente = $('#id_cliente_ingreso_val').val();
	id_cliente_ant = $('#id_cliente_ingreso_ant').val();
	fecha = $('#fecha_ingreso').val();
	id_cuenta = $('#id_cuenta_ingreso').val();
	id_forma_pago = $('#id_forma_pago_ingreso').val();
	id_admin = $('#id_admin').val();
	token = $('#_token').val();
	movimiento = $('#movimiento_ingreso').val();
	cheque = $('#cheque_ingreso').val();
	orden = $('#orden_ingreso').val();
	concepto = $('#comentarios_ingreso').val();
	porcentaje_iva = $('#porcentaje_iva_ingreso').val();
	deposito = $('#monto_ingreso').val();
	monto_ant = $('#monto_ingreso_ant').val();
	saldo = $('#saldo_ingreso_val').val();
	saldo_ant = $('#saldo_ingreso_ant').val();
	pagado = $('#pagado_ingreso_val').val();

	deposito = deposito * 1;
	monto_ant = monto_ant * 1;
	saldo = saldo * 1;
	saldo_ant = saldo_ant * 1;

	formData ={
		tipo, id_cliente, id_cliente_ant, fecha, id_cuenta, id_forma_pago, id_admin, movimiento, cheque, orden, concepto,
		porcentaje_iva, deposito, saldo, saldo_ant, monto_ant
	}

	if(id == '')
	{
		route = '/admin/ingresos/store';

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
				toastr.success('Se agregó el ingreso exitosamente.');
				$('#btn-save-ingreso').removeAttr('disabled');
				QuitarErroresIngresos();
				AgregarIngresoListado(data.id);
				$('#modal-ingreso').modal('toggle');
			},
			error: function(data)
			{
				console.log(data);
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
				$('#btn-save-ingreso').removeAttr('disabled');

				if (data.responseJSON.errors.fecha)
				{
				    $("#fecha_ingreso_error").html(data.responseJSON.errors.fecha);
				    $("#fecha_ingreso_error").fadeIn();
				}
				else
				{
				    $("#fecha_ingreso_error").fadeOut();
				}

				if (data.responseJSON.errors.id_cuenta)
				{
				    $("#id_cuenta_ingreso_error").html(data.responseJSON.errors.id_cuenta);
				    $("#id_cuenta_ingreso_error").fadeIn();
				}
				else
				{
				    $("#id_cuenta_ingreso_error").fadeOut();
				}

				if (data.responseJSON.errors.id_forma_pago)
				{
				    $("#id_forma_pago_ingreso_error").html(data.responseJSON.errors.id_forma_pago);
				    $("#id_forma_pago_ingreso_error").fadeIn();
				}
				else
				{
				    $("#id_forma_pago_ingreso_error").fadeOut();
				}

				if (data.responseJSON.errors.deposito)
				{
				    $("#monto_ingreso_error").html(data.responseJSON.errors.deposito);
				    $("#monto_ingreso_error").fadeIn();
				}
				else
				{
				    $("#monto_ingreso_error").fadeOut();
				}
			}
		});
	}
	else
	{
		if(id_cliente_ant != '')
		{	
			//Mismo cliente
			if(id_cliente == id_cliente_ant)
			{
				saldo_final = saldo_ant - monto_ant + deposito;
				//console.log(saldo_final);
				if(saldo_final < 0)
				{
					toastr.error('El cliente no tiene el suficiente saldo para bajar el monto del ingreso.');
				}
				else
				{
					UpdateIngreso(tipo, id_cliente, id_cliente_ant, fecha, id_cuenta, id_forma_pago, id_admin, movimiento, cheque, orden, concepto,
		porcentaje_iva, deposito, saldo, saldo_ant, monto_ant, id);
				}
			}
			//Cliente Diferente
			else if(id_cliente != id_cliente_ant)
			{
				if(saldo_ant < monto_ant)
				{
					toastr.error('El cliente anterior no tiene el suficiente saldo para cancelarle el monto del ingreso.');
				}
				else
				{
					UpdateIngreso(tipo, id_cliente, id_cliente_ant, fecha, id_cuenta, id_forma_pago, id_admin, movimiento, cheque, orden, concepto,
		porcentaje_iva, deposito, saldo, saldo_ant, monto_ant, id);
				}
			}
		}
		else
		{
			UpdateIngreso(tipo, id_cliente, id_cliente_ant, fecha, id_cuenta, id_forma_pago, id_admin, movimiento, cheque, orden, concepto,
		porcentaje_iva, deposito, saldo, saldo_ant, monto_ant, id);
		}
	}
});

function UpdateIngreso(tipo, id_cliente, id_cliente_ant, fecha, id_cuenta, id_forma_pago, id_admin, movimiento, cheque, orden, concepto,
		porcentaje_iva, deposito, saldo, saldo_ant, monto_ant, id)
{
	token = $('#_token').val();
	formData ={tipo, id_cliente, id_cliente_ant, fecha, id_cuenta, id_forma_pago, id_admin, movimiento, cheque, orden, concepto,
		porcentaje_iva, deposito, saldo, saldo_ant, monto_ant}
	//console.log(formData);
	route = '/admin/ingresos/update/' + id;

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
			toastr.success('Se editó el ingreso exitosamente.');
			$('#btn-save-ingreso').removeAttr('disabled');
			QuitarErroresIngresos();
			AcutalizarIngresoListado(data.id);
			$('#modal-ingreso').modal('toggle');
		},
		error: function(data)
		{
			console.log(data);
			toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
			$('#btn-save-ingreso').removeAttr('disabled');

			if (data.responseJSON.errors.fecha)
			{
			    $("#fecha_ingreso_error").html(data.responseJSON.errors.fecha);
			    $("#fecha_ingreso_error").fadeIn();
			}
			else
			{
			    $("#fecha_ingreso_error").fadeOut();
			}

			if (data.responseJSON.errors.id_cuenta)
			{
			    $("#id_cuenta_ingreso_error").html(data.responseJSON.errors.id_cuenta);
			    $("#id_cuenta_ingreso_error").fadeIn();
			}
			else
			{
			    $("#id_cuenta_ingreso_error").fadeOut();
			}

			if (data.responseJSON.errors.id_forma_pago)
			{
			    $("#id_forma_pago_ingreso_error").html(data.responseJSON.errors.id_forma_pago);
			    $("#id_forma_pago_ingreso_error").fadeIn();
			}
			else
			{
			    $("#id_forma_pago_ingreso_error").fadeOut();
			}

			if (data.responseJSON.errors.deposito)
			{
			    $("#monto_ingreso_error").html(data.responseJSON.errors.deposito);
			    $("#monto_ingreso_error").fadeIn();
			}
			else
			{
			    $("#monto_ingreso_error").fadeOut();
			}
		}
	});
}

function BorrarDatosIngresos()
{
	$('#accion_ingreso').val('Create');
	$('#id_ingreso').val('');
	$('#estatus_ingreso').val('');
	//$('#id_cliente_ingreso').val('').change();
	$('#id_cliente_ingreso_text').val('');
	$('#id_cliente_ingreso_val').val('');
	$('#id_cliente_ingreso_ant').val('');
	$('#fecha_ingreso').datepicker().datepicker('setDate', 'today');
	$('#id_cuenta_ingreso').val('').change();
	$('#id_forma_pago_ingreso').val('').change();
	$('#tipo_ingreso').val('Ingreso').change();
	$('#monto_ingreso').val('0');
	$('#monto_ingreso_ant').val('0');
	$('#saldo_ingreso').val('0');
	$('#saldo_ingreso_val').val('0');
	$('#saldo_ingreso_ant').val('0');
	$('#movimiento_ingreso').val('');
	$('#cheque_ingreso').val('');
	$('#comentarios_ingreso').val('');
	$('#facturas-por-ingresos').empty();
}

function QuitarErroresIngresos()
{
	$('#id_cliente_ingreso_error').fadeOut();
	$('#fecha_ingreso_error').fadeOut();
	$('#id_cuenta_ingreso_error').fadeOut();
	$('#id_forma_pago_ingreso_error').fadeOut();
	$('#monto_ingreso_error').fadeOut();
	$('#saldo_ingreso_error').fadeOut();
}

function cancelarIngreso(id, deposito, saldo, id_cliente)
{
	token = $('#_token').val();
	id_admin = $('#id_admin').val();
	formData =
	{
	    deposito, saldo, id_admin, id_cliente
	}

	if(saldo < deposito)
	{
		toastr.error('No se puede cancelar el ingreso ya que se ha utilizado parte del depósito ' + 
			'del cliente para pagar a un servicio, tiene que cancelar el pago para poder cancelar el ingreso.');
	}
	else
	{
		// console.log(formData);
		$.confirm(
		{
		    title: '¿Desea cancelar el ingreso?',
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
		                router = '/admin/ingresos/cancelar/' + id;

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
		                        toastr.info('Se canceló el ingreso.');

		                        AcutalizarIngresoListado(id);
		                    },
		                    error: function(data)
		                    {
		                        toastr.error('No se pudo cancelar el ingreso.');
		                        console.log(data);
		                    }
		                });
		                
		            }
		        },
		    }
		});
	}
	
}















