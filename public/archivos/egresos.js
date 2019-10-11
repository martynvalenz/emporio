$.ajaxSetup(
{
   headers: 
   {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

function Egresos()
{
	ListarEgreso();
}

$('#reservation_egresos').on('change', function()
{
    ListarEgreso();
});

$('#egresos_estatus_select').on('change', function()
{   
    setTimeout(ListarEgreso, 300);
}); 

$('#egresos_tipo').on('change', function()
{  
    setTimeout(ListarEgreso, 300);
}); 

$('#egresos_cuenta_select').on('change', function()
{  
    setTimeout(ListarEgreso, 300);
}); 

$('#egresos_formas_pago_select').on('change', function()
{  
    setTimeout(ListarEgreso, 300);
}); 

$("#btn-borrar-egresos").click(function()
{
    //ResetearFecha();
    $('#buscar-egresos').val('');
    setTimeout(ListarEgreso, 300);
});
$("#btn-buscar-egresos").on("click", function(e)
{
    e.preventDefault();
    ListarEgreso();
});

$('#buscar-egresos').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        ListarEgreso();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

function ResetearFecha()
{
    fecha_inicio = $('#fecha_inicio_egresos_reset').val();
    fecha_fin = $('#fecha_fin_egresos_reset').val();
    $('#reservation_egresos').val(fecha_inicio + '  -  ' + fecha_fin);
}

function ListarEgreso()
{
	url_listar = $('#url_listar_egresos').val();
	url_buscar = $('#url_buscar_egresos').val();

	estatus = $('#egresos_estatus_select').val();
	tipo = $('#egresos_tipo').val();
	cuenta = $('#egresos_cuenta_select').val();
	forma_pago = $('#egresos_formas_pago_select').val();
	buscar = $('#buscar-egresos').val();

	FechaRango = document.getElementById('reservation_egresos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];

	if(fecha_inicio == null)
	{
	    $('#reservation_egresos_error').html('La fecha inicial no puede estar vacía');
	    $('#reservation_egresos_error').fadeIn();
	}
	else if(fecha_fin == null)
	{
	    $('#reservation_egresos_error').html('La fecha final no puede estar vacía');
	    $('#reservation_egresos_error').fadeIn();
	}
	else if(fecha_inicio > fecha_fin)
	{
	    $('#reservation_egresos_error').html('La fecha inicial no puede ser mayor a la fecha final');
	    $('#reservation_egresos_error').fadeIn();
	    ResetearFechaEgreso();
	}
	else
	{
		if (buscar == '')
		{
		    
		    $.ajax(
		    {
		        type: 'get',
		        url: url_listar + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
		        + '/' + fecha_inicio + '/' + fecha_fin,
		        success: function(data)
		        {
		            $('#listado-egresos').empty().html(data);
		            $(".tooltip").tooltip("hide");
		            $(function()
		            {
		                $('#example1').stickyTableHeaders();
		            });

		            ActualizarEgresoMonto();
		        }
		    });
		}
		else
		{
		    $.ajax(
		    {
		        type: 'get',
		        url: url_buscar + estatus + '/' + tipo + '/' + cuenta + '/'  + forma_pago 
		        + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin,
		        success: function(data)
		        {
		            $('#listado-egresos').empty().html(data);
		            $(".tooltip").tooltip("hide");
		            $(function()
		            {
		                $('#example1').stickyTableHeaders();
		            });

		            ActualizarEgresoMonto();
		        }
		    });
		}
	}
}

function ActualizarEgresoMonto()
{
	url_listar = $('#url_listar_egresos').val();
	url_buscar = $('#url_buscar_egresos').val();

	estatus = $('#egresos_estatus_select').val();
	tipo = $('#egresos_tipo').val();
	cuenta = $('#egresos_cuenta_select').val();
	forma_pago = $('#egresos_formas_pago_select').val();
	buscar = $('#buscar-egresos').val();

	FechaRango = document.getElementById('reservation_egresos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];

	if (buscar == '')
	{
		route_monto = url_listar + 'total/' + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
		        + '/' + fecha_inicio + '/' + fecha_fin;

		$.get(route_monto, function(data)
		{
	    	$('#egreso_monto_total_filtro').html('Total: $ ' + parseFloat(data, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());	
	    });
	}
	else
	{
		route_monto = url_buscar + 'total/' + estatus + '/' + tipo + '/' + cuenta + '/'  + forma_pago 
		        + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin;

		$.get(route_monto, function(data)
		{
	    	$('#egreso_monto_total_filtro').html('Total: $ ' + parseFloat(data, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());	
	    });
	}

    
}

function AgregarEgresoListado(id)
{
	url_nuevo = $('#url_actualizar_egresos').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_nuevo + id,
	    success: function(data)
	    {
	        $('#list-egreso').prepend(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });
	        //console.log(data);
	        ActualizarEgresoMonto();
	    }
	});
}

function AcutalizarEgresoListado(id)
{
	url_actualizar = $('#url_actualizar_egresos').val();
	//console.log(url_actualizar);
	$.ajax(
	{
	    type: 'get',
	    url: url_actualizar + id,
	    success: function(data)
	    {
	        //console.log(data);
	        $('#listado-egreso-' + id).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });
	        //console.log(data);
	        ActualizarEgresoMonto();
	    }
	}); 
}

$(document).on("click", ".egresos-pagination .pagination li a", function(e)
{
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-egresos').empty().html(data);
        }
    });
});

//Egresos generales
$('#check_porcentaje_iva_egreso').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#check_porcentaje_iva_egreso_val").val(this.value);
}).change();

function CargarProveedores()
{
	route = '/admin/egresos/proveedores/0';
	$('#proveedor_egreso').empty();

	$.get(route, function(data)
	{
		$('#proveedor_egreso').append('<option value="" selected>-Sin selección-</option>');
		$.each(data, function(index, item)
		{
			$('#proveedor_egreso').append('<option value="'+ item.id + '_' + item.realiza_pagos +'">'+ item.nombre_comercial +'</option>');
		});
		//$('#proveedor_egreso').selectpicker('refresh');
	});
}

$('#proveedor_egreso').change(function()
{
	//id_proveedor = $(this).val();

	accion = $('#accion_egreso').val();
	id_egreso = $('#id_egreso_egreso').val();

	if(id_egreso == '')
	{
		id_egreso = 0;
	}

	if(accion == 'Create')
	{	
		var datosProveedor = $(this).val().split('_');
		$('#id_proveedor_egreso').val(datosProveedor[0]);
		realiza_pagos = datosProveedor[1];
		$('#realiza_pagos_egreso').val(realiza_pagos);

		if(realiza_pagos == 1)
		{
			CargarPagosPendientes(id_egreso);
			$('#monto_egreso').attr('disabled', 'disabled');
			$('#check_porcentaje_iva_egreso').prop('checked', true);
			$('#check_porcentaje_iva_egreso_val').val('1');
		}
		else if(realiza_pagos == 0)
		{
			$('#listado-egreso-pagos').empty();
			$('#monto_egreso').removeAttr('disabled');
			id_egreso = 0;
			$('#check_porcentaje_iva_egreso').prop('checked', false);
			$('#check_porcentaje_iva_egreso_val').val('0');
		}
	}
	else if(accion == 'Editar')
	{
		//
	}
});

function CargarPagosPendientes(id_egreso)
{
	route = '/admin/egresos/servicios-pendientes/';

	$.ajax(
	{
	    type: 'get',
	    url: route + id_egreso,
	    success: function(data)
	    {
	        //console.log(data);
	        $('#listado-egreso-pagos').empty().html(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

function CreateEgreso()
{
	BorrarDatosEgresos();
	QuitarErroresEgresos();
	$('.modal-header').css({
		'background-color': '#218CBF'
	});
	$('.modal-title').html('Agregar Egreso');
	$('#fecha_egreso').datepicker().datepicker('setDate', 'today');

	route = '/admin/egresos/ultimo-orden';
	$.get(route, function(data)
	{
		//console.log(data);
		orden = (data.orden * 1) + 1;
		$('#orden_egreso').val(orden);		
	});	

	$('#accion_egreso').val('Create');
	
	CargarProveedores();
}

function EditarEgreso(id, pago_servicios)
{
	//console.log(id, pago_servicios);
	$('#accion_egreso').val('Editar');
	$('#id_egreso_egreso').val(id);
	$('#listado-egreso-pagos').empty();
	QuitarErroresEgresos();
	$('.modal-header').css({
		'background-color': '#49adad'
	});
	$('.modal-title').html('Editar egreso: ' + id);

	route = '/admin/egresos/edit/' + id;

	$.get(route, function(data)
	{
		$('#id_proveedor_egreso').val(data.id_proveedor);
		$('#tipo_egreso').val(data.tipo);
		$('#fecha_egreso').val(data.fecha);
		$('#id_cuenta_egreso').val(data.id_cuenta).change();
		$('#id_forma_pago_egreso').val(data.id_forma_pago).change();
		$('#monto_egreso').val(data.retiro);
		$('#monto_egreso_val').val(data.retiro);
		$('#cheque_egreso').val(data.cheque);
		$('#movimiento_egreso').val(data.movimiento);
		$('#concepto_egreso').val(data.concepto);
		$('#orden_egreso').val(data.orden);
		$('#realiza_pagos_egreso').val(pago_servicios);

		if(data.con_iva == 1)
		{
			$('#check_porcentaje_iva_egreso_val').val('1');
			$('#check_porcentaje_iva_egreso').prop( "checked", true );
		}
		else if(data.con_iva == 0)
		{
			$('#check_porcentaje_iva_egreso_val').val('0');
			$('#check_porcentaje_iva_egreso').prop( "checked", false );
		}

		if(pago_servicios == 1)
		{
			CargarPagosPendientes(id);
			$('#monto_egreso').attr('disabled', 'disabled');

			$('#proveedor_egreso').empty();
			$('#proveedor_egreso').append('<option selected value="'+data.id_proveedor+ '_' + 
				pago_servicios + '">'+data.nombre_comercial+'</option><option value="">-------------------</option>');

			router = '/admin/egresos/proveedores/1';
			$.get(router, function(data)
			{
				$.each(data, function(index, item)
				{
					$('#proveedor_egreso').append('<option value="'+ item.id + '_' + 
						item.realiza_pagos +'">'+ item.nombre_comercial +'</option>');
				});
				//$('#proveedor_egreso').selectpicker('refresh');
			});
		}
		else if(pago_servicios == 0)
		{
			$('#monto_egreso').removeAttr('disabled');
			
			router = '/admin/egresos/proveedores/0';
			$('#proveedor_egreso').empty();
			$('#proveedor_egreso').append('<option selected value="'+data.id_proveedor+ '_' + 
				pago_servicios + '">'+data.nombre_comercial+'</option><option value="">-------------------</option>');

			$.get(router, function(data)
			{
				$.each(data, function(index, item)
				{
					$('#proveedor_egreso').append('<option value="'+ item.id + '_' + 
						item.realiza_pagos +'">'+ item.nombre_comercial +'</option>');
				});
				//$('#proveedor_egreso').selectpicker('refresh');
			});
		}
	});

	$('#accion_egreso').val('Create');
}

$('#btn-guardar-egreso').click(function()
{
	$('#btn-guardar-egreso').attr('disabled', 'disabled');
	realiza_pagos = $('#realiza_pagos_egreso').val();
	id_egreso = $('#id_egreso_egreso').val();
	id_admin = $('#id_admin').val();
	token = $('#_token').val();

	id_proveedor = $('#id_proveedor_egreso').val();
	fecha = $('#fecha_egreso').val();
	id_cuenta = $('#id_cuenta_egreso').val();
	id_forma_pago = $('#id_forma_pago_egreso').val();
	con_iva = $('#check_porcentaje_iva_egreso_val').val();
	porcentaje_iva = $('#porcentaje_iva_egreso').val();
	cheque = $('#cheque_egreso').val();
	movimiento = $('#movimiento_egreso').val();
	concepto = $('#concepto_egreso').val();
	orden = $('#orden_egreso').val();

	if(id_egreso == '' || id_egreso == 0)
	{
		if(realiza_pagos == 1)
		{
			monto = $('#monto_egreso_val').val();
			tipo = 'Despacho';

			formData =
			{
				id_proveedor, tipo, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, cheque, 
				movimiento, concepto, orden, monto, id_admin, realiza_pagos
			}

			route = '/admin/egresos/store';

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
					toastr.success('Se agregó el egreso exitosamente, ahora queda pendiente seleccionar los servicios que se van a agregar al pago.');
					$('#btn-guardar-egreso').removeAttr('disabled');
					//BorrarDatosEgresos();
					QuitarErroresEgresos();
					//$('#modal-egreso').modal('toggle');
					AgregarEgresoListado(data.id);
					$('#id_egreso_egreso').val(data.id);
				},
				error: function(data)
				{
					console.log(data);
					toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
					$('#btn-guardar-egreso').removeAttr('disabled');

					if (data.responseJSON.errors.fecha)
					{
					    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
					    $("#fecha_egreso_error").fadeIn();
					}
					else
					{
					    $("#fecha_egreso_error").fadeOut();
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

					if (data.responseJSON.errors.procentaje_iva)
					{
					    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
					    $("#procentaje_iva_egreso_error").fadeIn();
					}
					else
					{
					    $("#procentaje_iva_egreso_error").fadeOut();
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
				}
			});
		}
		else if(realiza_pagos == 0)
		{
			monto = $('#monto_egreso').val();
			tipo = $('#tipo_egreso').val();

			formData =
			{
				id_proveedor, tipo, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, cheque, 
				movimiento, concepto, orden, monto, id_admin, realiza_pagos
			}

			//console.log(formData);

			route = '/admin/egresos/store';

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
					toastr.success('Se agregó el egreso exitosamente');
					$('#btn-guardar-egreso').removeAttr('disabled');
					BorrarDatosEgresos();
					QuitarErroresEgresos();
					$('#modal-egreso').modal('toggle');
					AgregarEgresoListado(data.id);
				},
				error: function(data)
				{
					console.log(data);
					toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
					$('#btn-guardar-egreso').removeAttr('disabled');

					if (data.responseJSON.errors.fecha)
					{
					    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
					    $("#fecha_egreso_error").fadeIn();
					}
					else
					{
					    $("#fecha_egreso_error").fadeOut();
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

					if (data.responseJSON.errors.procentaje_iva)
					{
					    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
					    $("#procentaje_iva_egreso_error").fadeIn();
					}
					else
					{
					    $("#procentaje_iva_egreso_error").fadeOut();
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
				}
			});
		}
	}
	else
	{
		if(realiza_pagos == 1)
		{
			monto = $('#monto_egreso_val').val();
			tipo = $('#tipo_egreso').val();

			formData =
			{
				id_proveedor, tipo, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, cheque, 
				movimiento, concepto, monto, id_admin, realiza_pagos
			}

			//console.log(formData);

			route = '/admin/egresos/update/' + id_egreso;

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
					toastr.success('Se actualizó el egreso exitosamente');
					$('#btn-guardar-egreso').removeAttr('disabled');
					//BorrarDatosEgresos();
					QuitarErroresEgresos();
					//$('#modal-egreso').modal('toggle');
					AcutalizarEgresoListado(data.id);
				},
				error: function(data)
				{
					console.log(data);
					toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
					$('#btn-guardar-egreso').removeAttr('disabled');

					if (data.responseJSON.errors.fecha)
					{
					    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
					    $("#fecha_egreso_error").fadeIn();
					}
					else
					{
					    $("#fecha_egreso_error").fadeOut();
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

					if (data.responseJSON.errors.procentaje_iva)
					{
					    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
					    $("#procentaje_iva_egreso_error").fadeIn();
					}
					else
					{
					    $("#procentaje_iva_egreso_error").fadeOut();
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
				}
			});
		}
		else if(realiza_pagos == 0)
		{
			monto = $('#monto_egreso').val();
			tipo = $('#tipo_egreso').val();

			formData =
			{
				id_proveedor, tipo, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, cheque, 
				movimiento, concepto, monto, id_admin, realiza_pagos
			}

			//console.log(formData);

			route = '/admin/egresos/update/' + id_egreso;

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
					toastr.success('Se actualizó el egreso exitosamente');
					$('#btn-guardar-egreso').removeAttr('disabled');
					BorrarDatosEgresos();
					QuitarErroresEgresos();
					$('#modal-egreso').modal('toggle');
					AcutalizarEgresoListado(data.id);
				},
				error: function(data)
				{
					console.log(data);
					toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
					$('#btn-guardar-egreso').removeAttr('disabled');

					if (data.responseJSON.errors.fecha)
					{
					    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
					    $("#fecha_egreso_error").fadeIn();
					}
					else
					{
					    $("#fecha_egreso_error").fadeOut();
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

					if (data.responseJSON.errors.procentaje_iva)
					{
					    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
					    $("#procentaje_iva_egreso_error").fadeIn();
					}
					else
					{
					    $("#procentaje_iva_egreso_error").fadeOut();
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
				}
			});
		}
	}
});

function ActivarEgreso(id)
{
    token = $('#_token').val();
    estatus = 'Pagado';
    id_admin = $('#id_admin').val();
    formData =
    {
        estatus, id_admin
    }
    $.confirm(
    {
        title: '¿Desea pasar el egreso a estatus de pagado?',
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
                    router = '/admin/egresos/estatus/' + id;

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
                            toastr.info('Se activó el egreso.');

                            AcutalizarEgresoListado(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar el egreso.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function CancelarEgreso(id, pago_servicios)
{
    token = $('#_token').val();
    estatus = 'Cancelado';
    id_admin = $('#id_admin').val();
    formData =
    {
        estatus, pago_servicios, id_admin
    }
    $.confirm(
    {
        title: '¿Desea cancelar el egreso?',
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
                    router = '/admin/egresos/estatus/' + id;

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
                            toastr.info('Se canceló el egreso.');

                            AcutalizarEgresoListado(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo cancelar el egreso.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function PendienteEgreso(id)
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
        title: '¿Desea pasar el egreso a estatus de pendiente?',
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
                text: 'Pendiente',
                btnClass: 'btn-orange any-other-class',
                action: function () 
                {
                    router = '/admin/egresos/estatus/' + id;

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
                            toastr.info('Se activó el egreso.');

                            AcutalizarEgresoListado(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar el egreso.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function CheckPagoServicio(id)
{
	id_servicio = id;
	valor = $('#servicio-pagar-val-' + id).val();
	var cells = $('#servicio-pagar-list-' + id).children('td'); 
	id_cliente = cells.eq(1).text();
	id_control = cells.eq(2).text();
	id_pago = cells.eq(3).text();
	monto = cells.eq(5).text();
	monto = monto * 1;
	
	//formData = {id_servicio, id_cliente, id_control, id_pago, monto}
	//console.log(formData);

	if(valor == 0)
	{
		valor = 1;
		InsertarPagoServicio(id_servicio, id_cliente, id_control, monto, valor);
	}
	else if(valor == 1)
	{
		valor = 0;
		QuitarPagoServicio(id_pago, id_servicio, id_cliente, id_control, monto, valor);
	}
	
}

function InsertarPagoServicio(id_servicio, id_cliente, id_control, monto, valor)
{
	id_egreso = $('#id_egreso_egreso').val();
	token = $('#_token').val();
	id_admin = $('#id_admin').val();

	id_proveedor = $('#id_proveedor_egreso').val();
	fecha = $('#fecha_egreso').val();
	id_cuenta = $('#id_cuenta_egreso').val();
	id_forma_pago = $('#id_forma_pago_egreso').val();
	con_iva = $('#check_porcentaje_iva_egreso_val').val();
	porcentaje_iva = $('#porcentaje_iva_egreso').val();
	cheque = $('#cheque_egreso').val();
	movimiento = $('#movimiento_egreso').val();
	concepto = $('#concepto_egreso').val();
	costo_pendiente = $('#costo_pendiente_val').val();
	costo_pendiente = costo_pendiente * 1;
	monto_total = $('#monto_egreso_val').val();
	orden = $('#orden_egreso').val();

	if(id_egreso == '')
	{
		route = '/admin/egresos/insertar-pago';
		formData = {id_admin, id_proveedor, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, 
			cheque, movimiento, concepto, orden, id_servicio, id_cliente, id_control, monto}

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
				toastr.success('Se agregó el egreso exitosamente.');
				QuitarErroresEgresos();
				AgregarEgresoListado(data.id_egreso);
				$('#id_egreso_egreso').val(data.id_egreso);
				$('#servicio-pagar-val-' + id_servicio).val(valor);
				costo_pendiente = (costo_pendiente * 1) - (monto * 1);
				monto_total = (monto_total * 1) + (monto * 1);
				monto_total = monto_total.toFixed(2);
				$('#costo_pendiente_val').val(costo_pendiente);
				$('#costo_pendiente').html(parseFloat(costo_pendiente, 10).toFixed(2).replace(
	                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#monto_egreso_val').val(monto_total);
				$('#monto_egreso').val(monto_total);
				var cells = $('#servicio-pagar-list-' + id_servicio).children('td'); 
				cells.eq(3).text(data.id);  
			},
			error: function(data)
			{
				console.log(data);
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

				if(valor == 1)
				{
					valor = 0;
					$('#servicio-pagar-' + id_servicio).prop( "checked", false );
				}
				else if(valor == 0)
				{
					valor = 1;
					$('#servicio-pagar-' + id_servicio).prop( "checked", true );
				}

				$('#btn-guardar-egreso').removeAttr('disabled');

				if (data.responseJSON.errors.fecha)
				{
				    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
				    $("#fecha_egreso_error").fadeIn();
				}
				else
				{
				    $("#fecha_egreso_error").fadeOut();
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

				if (data.responseJSON.errors.procentaje_iva)
				{
				    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
				    $("#procentaje_iva_egreso_error").fadeIn();
				}
				else
				{
				    $("#procentaje_iva_egreso_error").fadeOut();
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
			}
		});
	}
	else
	{
		route = '/admin/egresos/pago-servicio/' + id_egreso;

		formData = {id_admin, id_proveedor, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, 
			cheque, movimiento, concepto, id_servicio, id_cliente, id_control, monto, monto_total}

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
				toastr.success('Se agregó el egreso exitosamente.');
				QuitarErroresEgresos();
				AcutalizarEgresoListado(data.id_egreso);
				$('#id_egreso_egreso').val(data.id_egreso);
				$('#servicio-pagar-val-' + id_servicio).val(valor);
				costo_pendiente = (costo_pendiente * 1) - (monto * 1);
				monto_total = (monto_total * 1) + (monto * 1);
				monto_total = monto_total.toFixed(2);
				$('#costo_pendiente_val').val(costo_pendiente);
				$('#costo_pendiente').html(parseFloat(costo_pendiente, 10).toFixed(2).replace(
	                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
				$('#monto_egreso_val').val(monto_total);
				$('#monto_egreso').val(monto_total);
				var cells = $('#servicio-pagar-list-' + id_servicio).children('td'); 
				cells.eq(3).text(data.id); 
			},
			error: function(data)
			{
				console.log(data);
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

				if(valor == 1)
				{
					valor = 0;
					$('#servicio-pagar-' + id_servicio).prop( "checked", false );
				}
				else if(valor == 0)
				{
					valor = 1;
					$('#servicio-pagar-' + id_servicio).prop( "checked", true );
				}

				$('#btn-guardar-egreso').removeAttr('disabled');

				if (data.responseJSON.errors.fecha)
				{
				    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
				    $("#fecha_egreso_error").fadeIn();
				}
				else
				{
				    $("#fecha_egreso_error").fadeOut();
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

				if (data.responseJSON.errors.procentaje_iva)
				{
				    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
				    $("#procentaje_iva_egreso_error").fadeIn();
				}
				else
				{
				    $("#procentaje_iva_egreso_error").fadeOut();
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
			}
		});
	}
}

function QuitarPagoServicio(id_pago, id_servicio, id_cliente, id_control, monto, valor)
{
	id_egreso = $('#id_egreso_egreso').val();
	token = $('#_token').val();

	id_proveedor = $('#id_proveedor_egreso').val();
	fecha = $('#fecha_egreso').val();
	id_cuenta = $('#id_cuenta_egreso').val();
	id_forma_pago = $('#id_forma_pago_egreso').val();
	con_iva = $('#check_porcentaje_iva_egreso_val').val();
	porcentaje_iva = $('#porcentaje_iva_egreso').val();
	cheque = $('#cheque_egreso').val();
	movimiento = $('#movimiento_egreso').val();
	concepto = $('#concepto_egreso').val();
	costo_pendiente = $('#costo_pendiente_val').val();
	costo_pendiente = costo_pendiente * 1;
	monto_total = $('#monto_egreso_val').val();

	route = '/admin/egresos/quitar-pago-servicio/' + id_pago + '/' + id_egreso;
	formData = {id_proveedor, fecha, id_cuenta, id_forma_pago, con_iva, porcentaje_iva, 
		cheque, movimiento, concepto, id_servicio, monto, monto_total}

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
			toastr.success('Se quitó el servicio del pago.');
			QuitarErroresEgresos();
			AcutalizarEgresoListado(id_egreso);
			$('#id_egreso_egreso').val(id_egreso);
			$('#servicio-pagar-val-' + id_servicio).val(valor);
			costo_pendiente = (costo_pendiente * 1) + (monto * 1);
			monto_total = (monto_total * 1) - (monto * 1);
			monto_total = monto_total.toFixed(2);
			$('#costo_pendiente_val').val(costo_pendiente);
			$('#costo_pendiente').html(parseFloat(costo_pendiente, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
			$('#monto_egreso_val').val(monto_total);
			$('#monto_egreso').val(monto_total);
			var cells = $('#servicio-pagar-list-' + id_servicio).children('td'); 
			cells.eq(3).text('');  
		},
		error: function(data)
		{
			console.log(data);
			toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

			if(valor == 1)
			{
				valor = 0;
				$('#servicio-pagar-' + id_servicio).prop( "checked", false );
			}
			else if(valor == 0)
			{
				valor = 1;
				$('#servicio-pagar-' + id_servicio).prop( "checked", true );
			}

			$('#btn-guardar-egreso').removeAttr('disabled');

			if (data.responseJSON.errors.fecha)
			{
			    $("#fecha_egreso_error").html(data.responseJSON.errors.fecha);
			    $("#fecha_egreso_error").fadeIn();
			}
			else
			{
			    $("#fecha_egreso_error").fadeOut();
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

			if (data.responseJSON.errors.procentaje_iva)
			{
			    $("#procentaje_iva_egreso_error").html(data.responseJSON.errors.procentaje_iva);
			    $("#procentaje_iva_egreso_error").fadeIn();
			}
			else
			{
			    $("#procentaje_iva_egreso_error").fadeOut();
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
		}
	});
}

function BorrarDatosEgresos()
{
	$('#realiza_pagos_egreso').val('');
	$('#id_egreso_egreso').val('');

	$('#id_proveedor_egreso').val('');
	//$('#proveedor_egreso').val('').change();
	$('#tipo_egreso').val('Despacho');
	$('#fecha_egreso').datepicker().datepicker('setDate', 'today');
	$('#id_cuenta_egreso').val('').change();
	$('#id_forma_pago_egreso').val('').change();
	$('#cheque_egreso').val('');
	$('#movimiento_egreso').val('');
	$('#concepto_egreso').val('');
	$('#orden_egreso').val('');
	$('#monto_egreso').val('0');
	$('#monto_egreso_val').val('0');
	$('#accion_egreso').val('Create');
	$('#monto_egreso').removeAttr('disabled');
	$('#listado-egreso-pagos').empty();
}

function QuitarErroresEgresos()
{
	$("#proveedor_egreso_error").fadeOut();
	$("#fecha_egreso_error").fadeOut();
	$("#id_cuenta_egreso_error").fadeOut();
	$("#id_forma_pago_egreso_error").fadeOut();
	$("#procentaje_iva_egreso_error").fadeOut();
	$("#monto_egreso_error").fadeOut();
}

function AgregarProveedor()
{
	$('#modal-agregar-proveedor').modal('toggle');
	$('#nombre_proveedor').val('');
	$('#nombre_proveedor_error').fadeOut();

	$('#header-proveedor').css(
		{
			'background-color' : '#49adad'
		});
	$('#proveedor-title').html('Agregar Proveedor');

	$("#realiza_pagos_check").val("0").change();
	$('#realiza_pagos_check').prop('checked', false);
	$("#realiza_pagos_check_val").val("0");
}

$('#realiza_pagos_check').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#realiza_pagos_check_val").val(this.value);
}).change();

$('.cerrar-proveedor').click(function()
{
	$('#nombre_proveedor').val('');
	$('#nombre_proveedor_error').fadeOut();
	$('#modal-agregar-proveedor').modal('toggle');
});

$('#btn-agregar-proveedor').click(function()
{
	$('#btn-agregar-proveedor').attr('disabled', 'disabled');
	id_admin = $('#id_admin').val();
	token = $('#_token').val();
	nombre_comercial = $('#nombre_proveedor').val();
	realiza_pagos = $('#realiza_pagos_check_val').val();

	formData = {nombre_comercial, id_admin, realiza_pagos}
	route = '/admin/egresos/agregarProveedor';

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
			$('#btn-agregar-proveedor').removeAttr('disabled');
			$("#nombre_proveedor_error").fadeOut();
			toastr.success('Se agregó el proveedor exitosamente');
			$('#modal-agregar-proveedor').modal('toggle');
			$('#proveedor_egreso').prepend('<option value="'+ data.id + '_' + data.realiza_pagos +
				'" selected>'+ data.nombre_comercial +'</option>');
			$('#id_proveedor_egreso').val(data.id);
			$('#realiza_pagos_egreso').val(data.realiza_pagos);
		},
		error: function(data)
		{
			console.log(data);
			toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
			$('#btn-agregar-proveedor').removeAttr('disabled');

			if (data.responseJSON.errors.nombre_comercial)
			{
			    $("#nombre_proveedor_error").html(data.responseJSON.errors.nombre_comercial);
			    $("#nombre_proveedor_error").fadeIn();
			}
			else
			{
			    $("#nombre_proveedor_error").fadeOut();
			}
		}
	});	
});
















//Comisiones
function CreateComision()
{
	BorrarDatosComisiones();
	QuitarErroresComisiones();
	$('.modal-header').css({
		'background-color': '#218CBF'
	});
	$('.modal-title').html('Pagar Comisión');
	$('#btn-aplicar-comision-egreso').removeAttr('disabled');

	route = '/admin/egresos/ultimo-orden';
	$.get(route, function(data)
	{
		//console.log(data);
		orden = (data.orden * 1) + 1;
		$('#orden_egresos_comision').val(orden);		
	});

	$('#comision_usuario').empty();
	route_usuario = '/admin/egresos/usuarios-comision';

	$.get(route_usuario, function(data)
	{
		$('#comision_usuario').append('<option value="" selected>-Seleccionar-</option>');
		$.each(data, function(index, item)
		{
			$('#comision_usuario').append('<option value="'+ item.id  + '">'+ item.iniciales + ' - ' +
				item.nombre + ' ' + item.apellido + '</option>');
		});
	});

	/*orden_new = $('#orden_egresos_comision').val();
	if(orden_new == 'NaN')
	{
		$('#orden_egresos_comision').val(orden_new);
	}
	
	console.log(orden_new);*/
	
}

function EditComision(id)
{
	$('#id_comision_egreso').val(id);
	route = '/admin/egresos/edit/' + id;
	$('#comision_usuario').empty();
	$('#btn-aplicar-comision-egreso').removeAttr('disabled');
	$('.modal-title').html('Editar comision ' + id);

	//console.log(route);

	$('.modal-header').css({
		'background-color': '#49B6D6'
	});

	$.get(route, function(data)
	{
		$('#comision_usuario').append('<option value="'+ data.id_comisionado  + '">'+ data.iniciales_comisionado + ' - ' +
			data.nombre_comisionado + ' ' + data.apellido_comisionado + '</option>');
		$('#comision_usuario_val').val(data.id_comisionado);
		$('#comision_fecha').val(data.fecha);
		$('#comision_id_cuenta').val(data.id_cuenta);
		$('#comision_id_forma_pago').val(data.id_forma_pago);
		$('#comision_total').val(data.retiro);
		$('#comision_total_val').val(data.retiro);
		$('#comision_total_th').html('$ ' + parseFloat(data.retiro, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
	                "$1,").toString());
		$('#comision_cheque').val(data.cheque);
		$('#comision_movimiento').val(data.movimiento);
		$('#comision_estatus').val(data.estatus);
		$('#comision_concepto').val(data.concepto);
		$('#orden_egresos_comision').val(data.orden);
		

		$.ajax(
		{
		    type: 'get',
		    url: '/admin/egresos/comisiones/cargarServiciosPendientes/' + data.id_comisionado + '/' + id,
		    success: function(data)
		    {
		        $('#listado-comision-edit').empty().html(data);
		        $(".tooltip").tooltip("hide");
		        //CalcularTotalComision();
		    }
		});
	});

	$('#comision_usuario').attr('disabled', 'disabled');
}

$('#comision_id_cuenta').change(function()
{
	cuenta = $(this).val();
	$('#btn-aplicar-comision-egreso').attr('disabled', 'disabled');

	if(cuenta == 1)
	{
		$('#comision_id_forma_pago').val('1').change();
	}
	else
	{
		//$('#comision_id_forma_pago').val('1').change();
	}
});

function ActualizarListadoComisiones()
{
	id_admin = $('#comision_usuario').val();
	id_admin_val = $('#comision_usuario_val').val();

	//console.log(id_admin);

	id_egreso = $('#id_comision_egreso').val();

	if(id_egreso == '' || id_egreso == 0)
	{
		if(id_admin == '')
		{

		}
		else
		{
			$.ajax(
			{
			    type: 'get',
			    url: '/admin/egresos/comisiones/cargarServiciosPendientes/' + id_admin + '/' + 0,
			    success: function(data)
			    {
			        $('#listado-comision-edit').empty().html(data);
			        $(".tooltip").tooltip("hide");
			        CalcularTotalComision();
			    }
			});
		}
	}
	else
	{
		$.ajax(
		{
		    type: 'get',
		    url: '/admin/egresos/comisiones/cargarServiciosPendientes/' + id_admin_val + '/' + id_egreso,
		    success: function(data)
		    {
		        $('#listado-comision-edit').empty().html(data);
		        $(".tooltip").tooltip("hide");
		        //CalcularTotalComision();
		    }
		});
	}	
}

$('#comision_usuario').change(function()
{
	ActualizarListadoComisiones();
});

function CalcularTotalComision()
{
	id_egreso = $('#id_comision_egreso').val();
	var sum = 0;
	var rows = $('#listado-comisiones-seleccionadas tbody tr').length;

	if(rows == 0)
	{
		$('#comision_total_th').html('$ 0.00');
		$('#comision_total').val('0');
		$('#comision_total_val').val('0');
	}
	else if(rows > 0)
	{
		$(".comision_monto").each(function() {

		    var value = $(this).text();
		    // add only if the value is number
		    if(!isNaN(value) && value.length != 0) 
		    {
		        sum += parseFloat(value);

		        $('#comision_total_th').html('$ ' + parseFloat(sum, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
	                "$1,").toString());
		        $('#comision_total').val(sum);
		        $('#comision_total_val').val(sum);
		    }
		    else
		    {
		        $('#comision_total_th').html('$ 0.00');
		        $('#comision_total').val('0');
		        $('#comision_total_val').val('0');
		    }
		});
	}
}

function QuitarComision(id)
{
	route = '/admin/egresos/quitar-comision/' + id;
	token = $('#_token').val();

	$.ajax(
	{
	    url: route,
	    headers:
	    {
	        'X-CSRF-TOKEN': token
	    },
	    type: 'PUT',
	    dataType: 'json',
	    success: function(data)
	    {
	        $('#comision-'+id).remove();
	        CalcularTotalComision();
	    },
	    error: function(data)
	    {
	        console.log(data);
	        if (data.status == 422)
	        {
	            //console.clear();
	        }
	        //console.clear();
	    }
	});
}

$('#btn-aplicar-comision-egreso').click(function()
{
	$('#btn-aplicar-comision-egreso').attr('disabled', 'disabled');
	AplicarComision();
});

function AplicarComision()
{

	$('#btn-aplicar-comision-egreso').attr('disabled', 'disabled');
	id_egreso = $('#id_comision_egreso').val();
	id_comisionado = $('#comision_usuario').val();
	fecha = $('#comision_fecha').val();
	id_cuenta = $('#comision_id_cuenta').val();
	id_forma_pago = $('#comision_id_forma_pago').val();
	cheque = $('#comision_cheque').val();
	movimiento = $('#comision_movimiento').val();
	concepto = $('#comision_concepto').val();
	id_admin = $('#id_admin').val();
	token = $('#_token').val();
	orden = $('#orden_egresos_comision').val();
	monto = $('#comision_total_val').val();

	if(orden == 'NaN')
	{
		orden = 1;
	}

	formData =
	{
		id_comisionado, fecha, id_cuenta, id_forma_pago, cheque, 
		movimiento, concepto, id_admin, monto, orden
	}

	//console.log(formData);

	if(id_egreso == '')
	{
		route = '/admin/egresos/comision-insertar';

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
		    	QuitarErroresComisiones();
		    	BorrarDatosComisiones();
		        toastr.success('Se insertó la comisión exitosamente');
		        AgregarEgresoListado(data.id);
		        $('#modal-egreso-comision').modal('toggle');
		        $('#btn-aplicar-comision-egreso').removeAttr('disabled');
		    },
		    error: function(data)
		    {
		        console.log(data);
		        
		        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
		        $('#btn-aplicar-comision-egreso').removeAttr('disabled');

		        if (data.responseJSON.errors.id_comisionado)
		        {
		            $("#comision_usuario_error").html(data.responseJSON.errors.id_comisionado);
		            $("#comision_usuario_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_usuario_error").fadeOut();
		        }

		        if (data.responseJSON.errors.fecha)
		        {
		            $("#comision_fecha_error").html(data.responseJSON.errors.fecha);
		            $("#comision_fecha_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_fecha_error").fadeOut();
		        }

		        if (data.responseJSON.errors.id_cuenta)
		        {
		            $("#comision_id_cuenta_error").html(data.responseJSON.errors.id_cuenta);
		            $("#comision_id_cuenta_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_id_cuenta_error").fadeOut();
		        }

		        if (data.responseJSON.errors.id_forma_pago)
		        {
		            $("#comision_id_forma_pago_error").html(data.responseJSON.errors.id_forma_pago);
		            $("#comision_id_forma_pago_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_id_forma_pago_error").fadeOut();
		        }

		        if (data.status == 422)
		        {
		            console.clear();
		        }
		        //console.clear();
		    }
		});
	}
	else
	{
		
		route = '/admin/egresos/comision-editar/' + id_egreso + '/' + id;

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
		        $('#btn-aplicar-comision-egreso').removeAttr('disabled');
		        toastr.success('Se actualizó el registro exitosamente');
		        $('#comision-servicio-id-'+id).val(value);
		        AcutalizarEgresoListado(data.id);
		        $('#comision_total').val(data.retiro);
		        $('#comision_total_val').val(data.retiro);
		    },
		    error: function(data)
		    {
		        console.log(data);
		        $('.checkbox_comisiones').removeAttr('disabled');
		        if(value == 1)
		        {
		        	$('#comision-servicio-'+id).prop( "checked", false );
		        }
		        else if(value == 0)
		        {
		        	$('#comision-servicio-'+id).prop( "checked", true );
		        }
		        
		        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

		        if (data.responseJSON.errors.id_comisionado)
		        {
		            $("#comision_usuario_error").html(data.responseJSON.errors.id_comisionado);
		            $("#comision_usuario_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_usuario_error").fadeOut();
		        }

		        if (data.responseJSON.errors.fecha)
		        {
		            $("#comision_fecha_error").html(data.responseJSON.errors.fecha);
		            $("#comision_fecha_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_fecha_error").fadeOut();
		        }

		        if (data.responseJSON.errors.id_cuenta)
		        {
		            $("#comision_id_cuenta_error").html(data.responseJSON.errors.id_cuenta);
		            $("#comision_id_cuenta_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_id_cuenta_error").fadeOut();
		        }

		        if (data.responseJSON.errors.id_forma_pago)
		        {
		            $("#comision_id_forma_pago_error").html(data.responseJSON.errors.id_forma_pago);
		            $("#comision_id_forma_pago_error").fadeIn();
		        }
		        else
		        {
		            $("#comision_id_forma_pago_error").fadeOut();
		        }

		        if (data.status == 422)
		        {
		            //console.clear();
		        }
		    }
		});
	}
}

function ConceptoComision(id, monto, accion)
{
	$('.btn-anexar-comision').attr('disabled', 'disabled');
	$('.btn-eliminar-comision').attr('disabled', 'disabled');

	token = $('#_token').val();
	fecha =$('#comision_fecha').val();
	id_egreso = $('#id_comision_egreso').val();
	total = $('#comision_total_val').val();
	total = total * 1;
	monto = monto * 1;

	formData = {fecha, id_egreso, total, monto, accion}

	route = '/admin/egresos/ConceptoComision/' + id;

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
		    $('.btn-anexar-comision').removeAttr('disabled');
		    $('.btn-eliminar-comision').removeAttr('disabled');
		    ActualizarListadoComisiones();
		    AcutalizarEgresoListado(id_egreso);
		    toastr.success('Se guardaron los cambios en el egreso');

		    if(accion == 1)
		    {
		    	total_nuevo = total + monto;

		    }
		    else if(accion == 0)
		    {
		    	total_nuevo = total - monto;
		    }
		    
		    $('#comision_total_val').val(total_nuevo);
		    $('#comision_total').val(total_nuevo);
		    $('#comision_total_th').html('$ ' + parseFloat(total_nuevo, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
	                "$1,").toString());

		},
		error: function(data)
		{
		    console.log(data);
		    $('.btn-anexar-comision').removeAttr('disabled');
		    $('.btn-eliminar-comision').removeAttr('disabled');
		    
		    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

		    if (data.status == 422)
		    {
		        //console.clear();
		    }
		}
	});
}


function BorrarDatosComisiones()
{
	$('#comision_usuario').val('').change();
	$('#comision_usuario').removeAttr('disabled');
	$('#comision_usuario_val').val('');
	$('#comision_fecha').datepicker().datepicker('setDate', 'today');
	$('#comision_id_cuenta').val('').change();
	$('#comision_id_forma_pago').val('').change();
	$('#comision_cheque').val('');
	$('#comision_movimiento').val('');
	$('#comision_estatus').val('Pendiente');
	$('#comision_concepto').val('');
	$('#id_comision_egreso').val('');

	$('#comision_total').val('0');
	$('#comision_total_val').val('0');
	$('#btn-aplicar-comision-egreso').removeAttr('disabled');
	$('#listado-comision-edit').empty();
}

function QuitarErroresComisiones()
{
	$('#comision_usuario_error').fadeOut();
	$('#comision_fecha_error').fadeOut();
	$('#comision_id_cuenta_error').fadeOut();
	$('#comision_id_forma_pago_error').fadeOut();
	$('#comision_total_error').fadeOut();
	$('#comision_cheque_error').fadeOut();
	$('#comision_movimiento_error').fadeOut();
	$('#comision_concepto_error').fadeOut();
}








//Nomina
function Nomina()
{
	$('.modal-title').html('Generar Nómina');
	$('.modal-header').css(
	{
		'background-color': '#218CBF'
	});
	$('#btn-actualizar-listado-empleados').removeAttr('hidden');
	$('#tipo_nomina').removeAttr('disabled');
	$('#fecha_inicio_nomina').datepicker().datepicker('setDate', 'today');
	$('#fecha_fin_nomina').datepicker().datepicker('setDate', 'today');

	route = '/admin/egresos/ultimo-orden';
	$.get(route, function(data)
	{
		//console.log(data);
		orden = (data.orden * 1) + 1;
		$('#orden_nomina').val(orden);		
	});	
	tipo = $('#tipo_nomina').val();
	$('#cheque_nomina').val('');
	$('#concepto_nomina').val('');

	MostrarListadoEmpleados(tipo);
}	

function EditarNomina(id)
{
	$('.modal-title').html('Editar Nómina');
	$('#id_egreso_nomina_edit').val(id);
	//QuitarErroresNominaEdit();
	$('.modal-header').css({
		'background-color': '#49adad'
	});

	route = '/admin/egresos/edit/' + id;

	$.get(route, function(data)
	{
		console.log(data)
		$('#tipo_nomina_edit').val(data.tipo).change();
		$('#fecha_inicio_nomina_edit').datepicker().val(data.fecha_ini);
		$('#fecha_fin_nomina_edit').datepicker().val(data.fecha);
		$('#id_cuenta_nomina_edit').val(data.id_cuenta).change();
		$('#id_forma_pago_nomina_edit').val(data.id_forma_pago).change();
		$('#cheque_nomina_edit').val(data.cheque);
		$('#concepto_nomina_edit').val(data.concepto);

	});

	MostrarListadoEmpleadosEdit(id);
}

function actualizarListadoEmpleados()
{
	tipo = $('#tipo_nomina').val();

	MostrarListadoEmpleados(tipo);
}

function MostrarListadoEmpleados(tipo)
{
	//$('#listado-empleados').empty();
	if(tipo == 'Nómina')
	{
		route = '/admin/egresos/mostrar-empleados';

		$.ajax(
		{
		    type: 'get',
		    url: route,
		    success: function(data)
		    {
		        //console.log(data);
		        $('#listado-empleados').empty().html(data);
		        $(".tooltip").tooltip("hide"); 
		        CalcularTotalNomina();
		    }
		});

		$('#fecha_inicio_nomina').datepicker().datepicker('setDate', 'today');
		$('#fecha_fin_nomina').datepicker().datepicker('setDate', 'today');
	}
	else if(tipo == 'Aguinaldo')
	{
		route = '/admin/egresos/mostrar-empleados-aguinaldo';

		$.ajax(
		{
		    type: 'get',
		    url: route,
		    success: function(data)
		    {
		        //console.log(data);
		        $('#listado-empleados').empty().html(data);
		        $(".tooltip").tooltip("hide"); 
		        CalcularTotalNomina();
		    }
		});

		inicio_anio = $('#fecha_inicio_anio').val();
		fin_anio = $('#fecha_fin_anio').val();

		$('#fecha_inicio_nomina').val(inicio_anio);
		$('#fecha_fin_nomina').val(fin_anio);
	}
}

function MostrarListadoEmpleadosEdit(id)
{
	route = '/admin/egresos/mostrar-empleados-nomina/' + id;

	$.ajax(
	{
	    type: 'get',
	    url: route,
	    success: function(data)
	    {
	        //console.log(data);
	        $('#listado-empleados-nomina-edit').empty().html(data);
	        $(".tooltip").tooltip("hide"); 
	        CalcularTotalNominaEdit();
	    }
	});
}

$('#tipo_nomina').change(function()
{
	tipo = $(this).val();
	MostrarListadoEmpleados(tipo);
});

$('#fecha_inicio_nomina').change(function()
{
	fecha = $(this).val();
	fecha_fin_anio = $('#fecha_fin_anio').val();
	tipo = $('#tipo_nomina').val();

	if(fecha == '')
	{

	}
	else
	{
		if(tipo == 'Nómina')
		{
			FechaInicial = document.getElementById('fecha_inicio_nomina').value.split('-');
			anio = FechaInicial[0];
			mes = FechaInicial[1];
			dias = FechaInicial[2];
			dias = dias * 1;
			hasta = dias + 14;

			$('#fecha_fin_nomina').val(anio + '-' + mes + '-' + hasta);
		}
		else if(tipo == 'Aguinaldo')
		{
			$('#fecha_fin_nomina').val(fecha_fin_anio);
		}
	}
});

function QuitarEmpleado(id)
{
	$('#empleado-' + id).remove();
	CalcularTotalNomina();
}


$('.nomina_monto').on('keypress', function(e)
{
    if (e.which === 13)
    {
        CalcularTotalNomina();
    }
});

$('.nomina_monto').on('change', function(e)
{
    CalcularTotalNomina();
});

function ModificarTotalesNomina()
{
	CalcularTotalNomina();
}

function CalcularTotalNomina()
{
	var rows = $('#listado-empleados-nomina tbody tr').length;

	if(rows == 0)
	{
		$('#nomina_total_th').html('$ 0.00');
		$('#total_nomina').val('0');
	}
	else if(rows > 0)
	{
		var sum = 0;
		// iterate through each td based on class and add the values
		$(".nomina_monto").each(function() {

		    var value = $(this).text();
		    // add only if the value is number
		    if(!isNaN(value) && value.length != 0) 
		    {
		        sum += parseFloat(value);

		        $('#nomina_total_th').html('$ ' + parseFloat(sum, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
	                "$1,").toString());
		        $('#total_nomina').val(sum);
		    }
		    else
		    {
		        $('#nomina_total_th').html('$ 0.00');
		        $('#total_nomina').val('0');
		    }
		});
	}
}

function CalcularTotalNominaEdit()
{
	var rows = $('#listado-empleados-nomina-edit-table tbody tr').length;

	if(rows == 0)
	{
		$('#nomina_total_th-edit').html('$ 0.00');
		$('#total_nomina').val('0');
	}
	else if(rows > 0)
	{
		var sum = 0;
		// iterate through each td based on class and add the values
		$(".nomina_monto_edit").each(function() {

		    var value = $(this).text();
		    // add only if the value is number
		    if(!isNaN(value) && value.length != 0) 
		    {
		        sum += parseFloat(value);

		        $('#nomina_total_th-edit').html('$ ' + parseFloat(sum, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
	                "$1,").toString());
		        $('#total_nomina').val(sum);
		    }
		    else
		    {
		        $('#nomina_total_th-edit').html('$ 0.00');
		        $('#total_nomina').val('0');
		    }
		});
	}
}



function storeNomina(id)
{
    var TableData = new Array();
    var dt = new Date();

    anio = dt.getFullYear();
    mes = dt.getMonth() + 1;
    dia = dt.getDate();
    hora = dt.getHours();
    minutos = dt.getMinutes();
    segundos = dt.getSeconds();
    id_egresos = id;

    var datetime = anio + '-' + mes + '-' + dia + ' ' + hora + ':' + minutos + ':' + segundos;

    //console.log(date);
    tipo = $('#tipo_nomina').val();
    fecha = $('#fecha_fin_nomina').val();

    $('#listado-empleados-nomina tbody tr').each(function(row, tr)
    {
        TableData[row] = 
        {
            'fecha_pagado' : fecha,
            'concepto' : tipo,
            'monto' : $(tr).find('td:eq(5)').text(),
            'estatus' : 'Pagada',
            'id_admin' : $(tr).find('td:eq(0)').text(),
            'id_egresos' : id_egresos,
            'created_at' : datetime,
            'updated_at' : datetime
        }
    });

    TableData.shift(); //first row is the table header - so remove
    console.log(TableData);
    return TableData;
}

$('#btn-save-nomina').click(function()
{
	$('#btn-save-nomina').attr('disabled', 'disabled');
	var rows = $('#listado-empleados-nomina tbody tr').length;
	CalcularTotalNomina();
	fecha_inicio = $('#fecha_inicio_nomina').val();
	fecha_fin = $('#fecha_fin_nomina').val();
	id_cuenta = $('#id_cuenta_nomina').val();
	id_forma_pago = $('#id_forma_pago_nomina').val();
	orden = $('#orden_nomina').val();
	tipo = $('#tipo_nomina').val();
	concepto = $('#concepto_nomina').val();
	cheque = $('#cheque_nomina').val();
	id_admin = $('#id_admin').val();
	token = $('#_token').val();

	if(rows == 0)
	{
		toastr.error('No se pudo insertar la nómina debido a que no hay conceptos que registrar.');
    	$('#btn-save-nomina').removeAttr('disabled');
	}
    else if(fecha_inicio == '')
    {
    	toastr.error('No se pudo insertar la nómina, revise los errores en el formulario');
    	$('#btn-save-nomina').removeAttr('disabled');
    	$('#fecha_inicio_nomina_error').html('Seleccione la fecha inicial de la nómina');
    	$('#fecha_inicio_nomina_error').fadeIn();
    }
    else if(fecha_fin == '')
    {
    	toastr.error('No se pudo insertar la nómina, revise los errores en el formulario');
    	$('#btn-save-nomina').removeAttr('disabled');
    	$('#fecha_fin_nomina_error').html('Seleccione la fecha final de la nómina');
    	$('#fecha_fin_nomina_error').fadeIn();
    }
    else if(id_cuenta == '')
    {
    	toastr.error('No se pudo insertar la nómina, revise los errores en el formulario');
    	$('#btn-save-nomina').removeAttr('disabled');
    	$('#id_cuenta_nomina_error').html('Seleccione la cuenta bancaria o si es en efectivo');
    	$('#id_cuenta_nomina_error').fadeIn();
    }
    else if(id_forma_pago == '')
    {
    	toastr.error('No se pudo insertar la nómina, revise los errores en el formulario');
    	$('#btn-save-nomina').removeAttr('disabled');
    	$('#id_forma_pago_nomina_error').html('Seleccione la forma de pago');
    	$('#id_forma_pago_nomina_error').fadeIn();
    }
    else 
    {
    	retiro = $('#total_nomina').val();

    	formData =
    	{
    		tipo, orden, concepto, cheque, fecha_inicio, fecha_fin, retiro, id_forma_pago, id_cuenta, id_admin
    	}

    	$.ajax(
    	{
    		url: '/admin/egresos/insertarNomina',
    		headers:
    		{
    		    'X-CSRF-TOKEN': token
    		},
    		type: 'POST',
    		dataType: 'json',
    		data: formData,
    		success: function(data)
    		{
    			storeNomina(data.id);
    			$('#fecha_inicio_nomina_error').fadeOut();
    			$('#fecha_fin_nomina_error').fadeOut();
    			$('#id_cuenta_nomina_error').fadeOut();
    			$('#id_forma_pago_nomina_error').fadeOut();

    			var TableData;
    			TableData = $.toJSON(storeNomina(data.id));

    			$.ajax(
    			{
    			    type: 'POST',
    			    url: '/admin/egresos/insertarNominas',
    			    data: 'string=' + TableData,
    			    success: function(data)
    			    {
    			        toastr.success('Se generó el egreso de ' + tipo + ' por: $ ' + retiro);
    			        ListarEgreso();
    			        $('#btn-save-nomina').removeAttr('disabled');
    			        $("#modal-nomina").modal('toggle');
    			        //console.log(data)
    			        
    			    },
    			    error: function(data)
    			    {
    			    	$('#btn-save-nomina').removeAttr('disabled');
    			        toastr.error('No se pudo generar la/el ' + tipo + '.');
    			        console.log(data);
    			    }
    			});
    		},
    		error: function(data)
    		{
    			$('#btn-save-nomina').removeAttr('disabled');
    			toastr.error('No se pudo generar la/el ' + tipo + '.');
    			console.log(data);
    		}
    	});
    	
    }
});



$('#btn-save-nomina-edit').click(function()
{
	$('#btn-save-nomina-edit').attr('disabled', 'disabled');

	id_egreso = $('#id_egreso_nomina_edit').val();
	fecha_ini = $('#fecha_inicio_nomina_edit').val();
	fecha = $('#fecha_fin_nomina_edit').val();
	tipo = $('#tipo_nomina_edit').val();
	monto = $('#monto_nomina_edit').val();
	id_cuenta = $('#id_cuenta_nomina_edit').val();
	id_forma_pago = $('#id_forma_pago_nomina_edit').val();
	concepto = $('#concepto_nomina_edit').val();
	token = $('#_token').val();
	id_admin = $('#id_admin').val();

	formData =
	{
		fecha_ini, fecha, tipo, monto, id_cuenta, id_forma_pago, concepto, id_admin
	}

	//console.log(formData);

	route = '/admin/egresos/updateNomina/' + id_egreso;

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
			AcutalizarEgresoListado(id_egreso);
	        $('#btn-save-nomina-edit').removeAttr('disabled');
	        toastr.success('Se actualizó el egreso.');
	        $("#modal-nomina-edit").modal('toggle');
	        QuitarErroresNominaEdit();
		},
		error: function(data)
		{
			console.log(data);
			toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
			$('#btn-save-nomina-edit').removeAttr('disabled');

			if (data.responseJSON.errors.fecha_ini)
			{
			    $("#fecha_inicio_nomina_edit_error").html(data.responseJSON.errors.fecha_ini);
			    $("#fecha_inicio_nomina_edit_error").fadeIn();
			}
			else
			{
			    $("#fecha_inicio_nomina_edit_error").fadeOut();
			}

			if (data.responseJSON.errors.fecha)
			{
			    $("#fecha_fin_nomina_edit_error").html(data.responseJSON.errors.fecha);
			    $("#fecha_fin_nomina_edit_error").fadeIn();
			}
			else
			{
			    $("#fecha_fin_nomina_edit_error").fadeOut();
			}

			if (data.responseJSON.errors.monto)
			{
			    $("#monto_nomina_edit_error").html(data.responseJSON.errors.monto);
			    $("#monto_nomina_edit_error").fadeIn();
			}
			else
			{
			    $("#monto_nomina_edit_error").fadeOut();
			}

			if (data.responseJSON.errors.id_cuenta)
			{
			    $("#id_cuenta_nomina_edit_error").html(data.responseJSON.errors.id_cuenta);
			    $("#id_cuenta_nomina_edit_error").fadeIn();
			}
			else
			{
			    $("#id_cuenta_nomina_edit_error").fadeOut();
			}

			if (data.responseJSON.errors.id_forma_pago)
			{
			    $("#id_forma_pago_nomina_edit_error").html(data.responseJSON.errors.id_forma_pago);
			    $("#id_forma_pago_nomina_edit_error").fadeIn();
			}
			else
			{
			    $("#id_forma_pago_nomina_edit_error").fadeOut();
			}
		}
	});
});	

function QuitarErroresNominaEdit()
{
	$("#fecha_inicio_nomina_edit_error").fadeOut();
	$("#fecha_fin_nomina_edit_error").fadeOut();
	$("#monto_nomina_edit_error").fadeOut();
	$("#id_cuenta_nomina_edit_error").fadeOut();
	$("#id_forma_pago_nomina_edit_error").fadeOut();
}

//Traspasos

function CreateTraspaso()
{
	BorrarDatosTraspasos();
	QuitarErroresTraspasos();
	$('.modal-header').css({
		'background-color': '#218CBF'
	});
	$('.modal-title').html('Agregar Traspaso');
	$('#fecha_traspaso').datepicker().datepicker('setDate', 'today');

	route = '/admin/egresos/ultimo-orden';
	$.get(route, function(data)
	{
		//console.log(data);
		orden = (data.orden * 1) + 1;
		$('#orden_traspaso').val(orden);		
	});	
}

function EditTraspaso(id)
{
	$('#id_egreso_traspaso').val(id);
	QuitarErroresTraspasos();
	$('.modal-header').css({
		'background-color': '#49adad'
	});
	$('.modal-title').html('Editar traspaso: ' + id);

	route = '/admin/egresos/edit/' + id;

	$.get(route, function(data)
	{
		$('#fecha_traspaso').val(data.fecha);
		$('#id_cuenta_traspaso').val(data.id_cuenta).change();
		$('#id_cuenta_traspaso_deposito').val(data.id_cuenta_traspaso).change();
		$('#id_forma_pago_traspaso').val(data.id_forma_pago).change();
		$('#monto_traspaso').val(data.retiro);
		$('#cheque_traspaso').val(data.cheque);
		$('#movimiento_traspaso').val(data.movimiento);
		$('#concepto_traspaso').val(data.concepto);
		$('#orden_traspaso').val(data.orden);
	});
}

$('#btn-guardar-traspaso').click(function()
{
	$('#btn-guardar-traspaso').attr('disabled', 'disabled');
	id = $('#id_egreso_traspaso').val();
	id_admin = $('#id_admin').val();
	token = $('#_token').val();
	orden = $('#orden_traspaso').val();
	concepto = $('#concepto_traspaso').val();
	fecha = $('#fecha_traspaso').val();
	cheque = $('#cheque_traspaso').val();
	movimiento = $('#movimiento_traspaso').val();
	monto = $('#monto_traspaso').val();
	id_forma_pago = $('#id_forma_pago_traspaso').val();
	id_cuenta = $('#id_cuenta_traspaso').val();
	id_cuenta_traspaso = $('#id_cuenta_traspaso_deposito').val();

	formData =
	{
		id_admin, orden, concepto, fecha, cheque, movimiento, monto, id_forma_pago, id_cuenta, id_cuenta_traspaso
	}

	if(id_cuenta == id_cuenta_traspaso)
	{
		$('#id_cuenta_traspaso_error').html('Las cuentas de retiro y depósito no pueden ser la misma');
		$('#id_cuenta_traspaso_deposito_error').html('Las cuentas de retiro y depósito no pueden ser la misma');
		$('#id_cuenta_traspaso_error').fadeIn();
		$('#id_cuenta_traspaso_deposito_error').fadeIn();
	}
	else
	{
		$('#id_cuenta_traspaso_error').fadeOut();
		$('#id_cuenta_traspaso_deposito_error').fadeOut();

		if(id == '')
		{
			route = '/admin/egresos/traspasos-insertar';

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
					toastr.success('Se agregó el traspaso exitosamente');
					$('#btn-guardar-traspaso').removeAttr('disabled');
					BorrarDatosTraspasos();
					QuitarErroresTraspasos();
					$('#modal-traspaso').modal('toggle');
					AgregarEgresoListado(data.id);
				},
				error: function(data)
				{
					console.log(data);
					toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
					$('#btn-guardar-traspaso').removeAttr('disabled');

					if (data.responseJSON.errors.fecha)
					{
					    $("#fecha_traspaso_error").html(data.responseJSON.errors.fecha);
					    $("#fecha_traspaso_error").fadeIn();
					}
					else
					{
					    $("#fecha_traspaso_error").fadeOut();
					}

					if (data.responseJSON.errors.id_cuenta)
					{
					    $("#id_cuenta_traspaso_error").html(data.responseJSON.errors.id_cuenta);
					    $("#id_cuenta_traspaso_error").fadeIn();
					}
					else
					{
					    $("#id_cuenta_traspaso_error").fadeOut();
					}

					if (data.responseJSON.errors.id_cuenta_traspaso)
					{
					    $("#id_cuenta_traspaso_deposito_error").html(data.responseJSON.errors.id_cuenta_traspaso);
					    $("#id_cuenta_traspaso_deposito_error").fadeIn();
					}
					else
					{
					    $("#id_cuenta_traspaso_deposito_error").fadeOut();
					}

					if (data.responseJSON.errors.id_forma_pago)
					{
					    $("#id_forma_pago_traspaso_error").html(data.responseJSON.errors.id_forma_pago);
					    $("#id_forma_pago_traspaso_error").fadeIn();
					}
					else
					{
					    $("#id_forma_pago_traspaso_error").fadeOut();
					}

					if (data.responseJSON.errors.monto)
					{
					    $("#monto_traspaso_error").html(data.responseJSON.errors.monto);
					    $("#monto_traspaso_error").fadeIn();
					}
					else
					{
					    $("#monto_traspaso_error").fadeOut();
					}
				}
			});
		}
		else
		{
			route = '/admin/egresos/traspasos-editar/' + id;

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
					toastr.success('Se agregó el traspaso exitosamente');
					$('#btn-guardar-traspaso').removeAttr('disabled');
					BorrarDatosTraspasos();
					QuitarErroresTraspasos();
					$('#modal-traspaso').modal('toggle');
					AcutalizarEgresoListado(data.id);
				},
				error: function(data)
				{
					console.log(data);
					toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
					$('#btn-guardar-traspaso').removeAttr('disabled');

					if (data.responseJSON.errors.fecha)
					{
					    $("#fecha_traspaso_error").html(data.responseJSON.errors.fecha);
					    $("#fecha_traspaso_error").fadeIn();
					}
					else
					{
					    $("#fecha_traspaso_error").fadeOut();
					}

					if (data.responseJSON.errors.id_cuenta)
					{
					    $("#id_cuenta_traspaso_error").html(data.responseJSON.errors.id_cuenta);
					    $("#id_cuenta_traspaso_error").fadeIn();
					}
					else
					{
					    $("#id_cuenta_traspaso_error").fadeOut();
					}

					if (data.responseJSON.errors.id_cuenta_traspaso)
					{
					    $("#id_cuenta_traspaso_deposito_error").html(data.responseJSON.errors.id_cuenta_traspaso);
					    $("#id_cuenta_traspaso_deposito_error").fadeIn();
					}
					else
					{
					    $("#id_cuenta_traspaso_deposito_error").fadeOut();
					}

					if (data.responseJSON.errors.id_forma_pago)
					{
					    $("#id_forma_pago_traspaso_error").html(data.responseJSON.errors.id_forma_pago);
					    $("#id_forma_pago_traspaso_error").fadeIn();
					}
					else
					{
					    $("#id_forma_pago_traspaso_error").fadeOut();
					}

					if (data.responseJSON.errors.monto)
					{
					    $("#monto_traspaso_error").html(data.responseJSON.errors.monto);
					    $("#monto_traspaso_error").fadeIn();
					}
					else
					{
					    $("#monto_traspaso_error").fadeOut();
					}
				}
			});
		}
	}
});

function BorrarDatosTraspasos()
{
	$('#id_cuenta_traspaso').val('').change();
	$('#id_cuenta_traspaso_deposito').val('').change();
	$('#id_forma_pago_traspaso').val('').change();
	$('#monto_traspaso').val('0');
	$('#cheque_traspaso').val('');
	$('#movimiento_traspaso').val('');
	$('#concepto_traspaso').val('');
	$('#id_egreso_traspaso').val('');
	//$('#orden_traspaso').val('');
}

function QuitarErroresTraspasos()
{
	$('#id_cuenta_traspaso_error').fadeOut();
	$('#fecha_traspaso_error').fadeOut();
	$('#monto_traspaso_error').fadeOut();
	$('#id_cuenta_traspaso_deposito_error').fadeOut();
	$('#id_forma_pago_traspaso_error').fadeOut();
}




















