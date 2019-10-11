$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() 
{
	id_catalogo_servicio = $('#id_catalogo_servicio').val();

    RequisitosOptions(id_catalogo_servicio);

    RequisitosListado(id_catalogo_servicio);

    Highlight.init();
});

function Habilitar(id, id_servicio)
{
	$('#option-'+id).attr('disabled', 'disabled');

	habilitado = $('#option-'+id+'-val').val();
	id_catalogo_servicio = $('#id_catalogo_servicio').val();
	token = $('#_token').val();
	avance_total = $('#avance_total').val();
	ultimo_orden = $('#ultimo_orden').val();
	url_eliminar = $('#url_eliminar').val();

	avance_total = avance_total * 1;
	ultimo_orden = ultimo_orden * 1;

	if(id_servicio > 0)
	{
		avance_total = avance_total - 1;
		var route = url_eliminar + id_servicio;

		formData =
		{
			avance_total
		}

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
				$('#option-'+id+'-val').val('0');
				$('#option-'+id).val('0');
				$('#option-'+id).removeAttr('onclick');
				$('#option-'+id).attr('onclick', 'Habilitar('+id+',0)');
				$('#option-'+id).removeAttr('disabled');
				RequisitosListado(id_catalogo_servicio);
				$('#avance_total').val(avance_total);
			},
			error: function(data)
			{
				toastr.error('No se pudo insertar el registro');
				console.log(data);
			}
		});
	}
	else if(id_servicio == 0)
	{
		avance_total = avance_total + 1;
		orden = ultimo_orden + 1;
		id_requisitos = id;
		var route = $('#url_insertar').val();

		formData =
		{
			orden, id_requisitos, id_catalogo_servicio, avance_total
		}

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
				$('#avance_total').val(avance_total);
				$('#option-'+id+'-val').val('1');
				$('#option-'+id).val('1');
				$('#option-'+id).removeAttr('onclick');
				$('#option-'+id).attr('onclick', 'Habilitar('+id+','+data.id+')');
				$('#option-'+id).removeAttr('disabled');
				RequisitosListado(id_catalogo_servicio);
			},
			error: function(data)
			{
				toastr.error('No se pudo insertar el registro');
				console.log(data);
			}

		});

		$('#option-'+id+'-val').val('1');
	}
	//toastr.success(id, id_servicio);
}

function HabilitarProgreso(id, id_prog)
{
	$('#option-'+id).attr('disabled', 'disabled');

	habilitado = $('#option-'+id+'-val').val();
	id_servicio = $('#id_catalogo_servicio').val();
	token = $('#_token').val();
	avance_total = $('#avance_total').val();
	ultimo_orden = $('#ultimo_orden').val();
	url_eliminar = $('#url_eliminar').val();

	avance_total = avance_total * 1;
	ultimo_orden = ultimo_orden * 1;

	if(id_prog > 0)
	{
		avance_total = avance_total - 1;
		var route = url_eliminar + id_prog;

		formData =
		{
			id_servicio, avance_total
		}

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
				$('#option-'+id+'-val').val('0');
				$('#option-'+id).val('0');
				$('#option-'+id).removeAttr('onclick');
				$('#option-'+id).attr('onclick', 'Habilitar('+id+',0)');
				$('#option-'+id).removeAttr('disabled');
				RequisitosListado(id_servicio);
				$('#avance_total').val(avance_total);
			},
			error: function(data)
			{
				toastr.error('No se pudo insertar el registro');
				console.log(data);
			}
		});
	}
	else if(id_prog == 0)
	{
		avance_total = avance_total + 1;
		orden = ultimo_orden + 1;
		id_requisitos = id;
		var route = $('#url_insertar').val();

		formData =
		{
			orden, id_requisitos, id_servicio, avance_total
		}

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
				$('#avance_total').val(avance_total);
				$('#option-'+id+'-val').val('1');
				$('#option-'+id).val('1');
				$('#option-'+id).removeAttr('onclick');
				$('#option-'+id).attr('onclick', 'Habilitar('+id+','+data.id+')');
				$('#option-'+id).removeAttr('disabled');
				RequisitosListado(id_servicio);
			},
			error: function(data)
			{
				toastr.error('No se pudo insertar el registro');
				console.log(data);
			}

		});

		$('#option-'+id+'-val').val('1');
	}
	//toastr.success(id, id_servicio);
}

function QuitarRequisito(id_servicio, id_catalogo_servicio)
{
	token = $('#_token').val();
	avance_total = $('#avance_total').val();
	avance_total = avance_total * 1;
	avance_total = avance_total - 1;
	url_eliminar = $('#url_eliminar').val();
	var route = url_eliminar + id_servicio;

	formData =
	{
		avance_total,
		id_catalogo_servicio
	}

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
			RequisitosOptions(id_catalogo_servicio);
			RequisitosListado(id_catalogo_servicio);
			$('#avance_total').val(avance_total);
		},
		error: function(data)
		{
			toastr.error('No se pudo insertar el registro');
			console.log(data);
		}
	});
}

function RequisitosOptions(id_catalogo_servicio)
{
	url_options = $('#url_options').val();
	$.ajax(
	{
	    type: 'get',
	    url: url_options + id_catalogo_servicio,
	    success: function(data)
	    {
	        $('#requisitos-options').empty().html(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

function RequisitosListado(id)
{
	url_cargar_requisitos = $('#url_cargar_requisitos').val();
	$.ajax(
	{
	    type: 'get',
	    url: url_cargar_requisitos + id,
	    success: function(data)
	    {
	        $('#requisitos-listado').empty().html(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

function SubirOrden(id, orden)
{
	url_subir = $('#url_subir').val();
	var route = url_subir + id + '/' + orden;
	token = $('#_token').val();
	id_catalogo_servicio = $('#id_catalogo_servicio').val();

	formData =
	{
		id_catalogo_servicio
	}

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
			RequisitosListado(id_catalogo_servicio);
		},
		error: function(data)
		{
			toastr.error('No se pudo actualizar el registro');
			console.log(data);
		}
	});
}

function BajarOrden(id, orden)
{
	url_bajar = $('#url_bajar').val();
	var route = url_bajar + id + '/' + orden;

	token = $('#_token').val();
	id_catalogo_servicio = $('#id_catalogo_servicio').val();
	ultimo_orden = $('#ultimo_orden').val();

	formData =
	{
		id_catalogo_servicio, ultimo_orden
	}

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
			RequisitosListado(id_catalogo_servicio);
		},
		error: function(data)
		{
			toastr.error('No se pudo actualizar el registro');
			console.log(data);
		}
	});
}

function SubirOrdenServicio(id, orden)
{
	url_subir = $('#url_subir').val();
	var route = url_subir + id + '/' + orden;
	token = $('#_token').val();
	id_servicio = $('#id_catalogo_servicio').val();

	formData =
	{
		id_servicio
	}

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
			RequisitosListado(id_servicio);
		},
		error: function(data)
		{
			toastr.error('No se pudo actualizar el registro');
			console.log(data);
		}
	});
}

function BajarOrdenServicio(id, orden)
{
	url_bajar = $('#url_bajar').val();
	var route = url_bajar + id + '/' + orden;

	token = $('#_token').val();
	id_servicio = $('#id_catalogo_servicio').val();
	ultimo_orden = $('#ultimo_orden').val();

	formData =
	{
		id_servicio, ultimo_orden
	}

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
			RequisitosListado(id_servicio);
		},
		error: function(data)
		{
			toastr.error('No se pudo actualizar el registro');
			console.log(data);
		}
	});
}

$('#btn-save-proceso').click(function()
{
	$('#btn-save-proceso').attr('disabled', 'disabled');
	id_requisito = $('#id_requisito').val();
	requisito = $('#requisito').val();
	categoria = $('#categoria').val();
	estatus = $('#estatus').val();
	id_catalogo_servicio = $('#id_catalogo_servicio').val();
	token = $('#_token').val();
	url_store = $('#url_store').val();

	formData = 
	{
		requisito, categoria, estatus
	}

	if(id_requisito == '')
	{
		$.ajax(
		{
			url: url_store,
			headers:
			{
			    'X-CSRF-TOKEN': token
			},
			type: 'POST',
			dataType: 'json',
			data: formData,
			success: function(data)
			{
				$('#btn-save-proceso').removeAttr('disabled');
				toastr.success('Se agregó el registro: "' + data.requisito +'"');
				RequisitosOptions(id_catalogo_servicio);
				RequisitosListado(id_catalogo_servicio);
				Borrar();
				QuitarErrores();

			},
			error: function(data)
			{
				$('#btn-save-proceso').removeAttr('disabled');
				console.log(data);
				toastr.error('No se pudo guardar el registro, revise los errores en el formulario.')

				if (data.responseJSON.errors.requisito)
				{
				    $("#requisito_error").html(data.responseJSON.errors.requisito);
				    $("#requisito_error").fadeIn();
				    $('#requisito').addClass('is-invalid');
				}
				else
				{
				    $("#requisito_error").fadeOut();
				    $('#requisito').removeClass('is-invalid');
				}

				if (data.responseJSON.errors.categoria)
				{
				    $("#categoria_error").html(data.responseJSON.errors.categoria);
				    $("#categoria_error").fadeIn();
				    $('#categoria').addClass('is-invalid');
				}
				else
				{
				    $("#categoria_error").fadeOut();
				    $('#categoria').removeClass('is-invalid');
				}
			}
		});
	}
	else
	{
		url_update = $('#url_update').val();
		var route = url_update + id_requisito;

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
				$('#btn-save-proceso').removeAttr('disabled');
				toastr.success('Se editó el registro: "' + data.requisito +'"');
				RequisitosOptions(id_catalogo_servicio);
				RequisitosListado(id_catalogo_servicio);
				Borrar();
				QuitarErrores();

			},
			error: function(data)
			{
				$('#btn-save-proceso').removeAttr('disabled');
				console.log(data);
				toastr.error('No se pudo guardar el registro, revise los errores en el formulario.')

				if (data.responseJSON.errors.requisito)
				{
				    $("#requisito_error").html(data.responseJSON.errors.requisito);
				    $("#requisito_error").fadeIn();
				    $('#requisito').addClass('is-invalid');
				}
				else
				{
				    $("#requisito_error").fadeOut();
				    $('#requisito').removeClass('is-invalid');
				}

				if (data.responseJSON.errors.categoria)
				{
				    $("#categoria_error").html(data.responseJSON.errors.categoria);
				    $("#categoria_error").fadeIn();
				    $('#categoria').addClass('is-invalid');
				}
				else
				{
				    $("#categoria_error").fadeOut();
				    $('#categoria').removeClass('is-invalid');
				}
			}
		});
	}
});

function LiberarComisiones(num, id, id_catalogo_servicio)
{
	url_liberar_comisiones = $('#url_liberar_comisiones').val();
	token = $('#_token').val();
	var route = url_liberar_comisiones + num + '/' + id + '/' + id_catalogo_servicio;

	formData =
	{
		//
	}

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
			RequisitosListado(id_catalogo_servicio);
		},
		error: function(data)
		{
			toastr.error('No se pudo actualizar el registro');
			console.log(data);
		}
	});
}



function EditarOpcion(id, requisito, categoria, estatus)
{
	QuitarErrores();
	//toastr.success(id);
	$('#id_requisito').val(id);
	$('#requisito').val(requisito);
	$('#categoria').val(categoria).change();
	$('#estatus').val(estatus).change();
}

$('#btn-cancelar-proceso').click(function()
{
	Borrar();
	QuitarErrores();
});

function Borrar()
{
	$('#id_requisito').val('');
	$('#requisito').val('');
	$('#categoria').val('').change();
	$('#estatus').val('1').change();
}

function QuitarErrores()
{
	$("#requisito_error").fadeOut();
	$('#requisito').removeClass('is-invalid');
	$("#categoria_error").fadeOut();
	$('#categoria').removeClass('is-invalid');
}

