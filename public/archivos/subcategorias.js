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

function Listar()
{
    var url_listar = $('#url_listar').val();

    $.ajax(
    {
        type: 'get',
        url: url_listar,
        success: function(data)
        {
            $('#listado').empty().html(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });
}

function ActualizarRegistro(id)
{
    url_actuailzar = $('#url_actualizar').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_actuailzar + id,
        success: function(data)
        {
            //console.log(data);
            $('#sub-'+id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });   
}

$('#renovacion').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#renovacion_check").val(this.value);
}).change();

function Create()
{
	$('.modal-header').css(
	{
	    'background-color': '#348FE2'
	});
	$('.modal-title').css(
	{
	    'color': 'white'
	});
	$('.close').css(
	{
	    'color': 'white',
	    'font-size': 35
	});
	$('.modal-title').html('Agregar Subcategoría');
	BorrarDatos();
	QuitarErrores();
}

$('#btn-guardar-subcategoria').click(function()
{
	$('#btn-guardar-subcategoria').attr('disabled', 'disabled');
	id = $('#id_subcategoria').val();
	token = $('#_token').val();
	subcategoria = $('#subcategoria').val();
	id_categoria = $('#id_categoria').val();
	renovacion = $('#renovacion_check').val();
	comprobacion_uso = $('#comprobacion_uso').val();
	vencimiento = $('#vencimiento').val();
	recordatorio = $('#recordatorio').val();

	recordatorio_plazo = $('#recordatorio_plazo').val();
	comprobacion_uso_plazo = $('#comprobacion_uso_plazo').val();
	vencimiento_plazo = $('#vencimiento_plazo').val();

	if(recordatorio == 0 || recordatorio == '')
	{
		recordatorio = 0;
	}
	else
	{
		if(recordatorio_plazo == 'Anios')
		{
			recordatorio = recordatorio * 364;
		}
		else if(recordatorio_plazo == 'Meses')
		{
			recordatorio = recordatorio * 30.4;
		}
		else if(recordatorio_plazo == 'Dias')
		{
			recordatorio = recordatorio * 1;
		}
	}
	
	if(comprobacion_uso == 0 || comprobacion_uso == '')
	{
		comprobacion_uso = 0;
	}
	else
	{
		if(comprobacion_uso_plazo == 'Anios')
		{
			comprobacion_uso = comprobacion_uso * 364;
		}
		else if(comprobacion_uso_plazo == 'Meses')
		{
			comprobacion_uso = comprobacion_uso * 30.4;
		}
		else if(comprobacion_uso_plazo == 'Dias')
		{
			comprobacion_uso = comprobacion_uso * 1;
		}
	}

	if(vencimiento == 0 || vencimiento == '')
	{
		vencimiento = 0;
	}
	else
	{
		if(vencimiento_plazo == 'Anios')
		{
			vencimiento = vencimiento * 364;
		}
		else if(vencimiento_plazo == 'Meses')
		{
			vencimiento = vencimiento * 30.4;
		}
		else if(vencimiento_plazo == 'Dias')
		{
			vencimiento = vencimiento * 1;
		}
	}

	formData = 
	{
		subcategoria, id_categoria, renovacion, comprobacion_uso, vencimiento, recordatorio
	}

	//console.log(formData);

	if(id == '')
	{
		//console.log(formData);
		route = '/admin/subcategorias/store';
		
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
		    	$('#btn-guardar-subcategoria').removeAttr('disabled');
		        toastr.success('Se creó la subcategoría: '+ data.subcategoria);
		        $('#modal-subcategoria').modal('toggle');
		       	Listar();
		        BorrarDatos();
		        QuitarErrores();
		    },
		    error: function(data)
		    {
		        $('#btn-guardar-subcategoria').removeAttr('disabled');
		        console.log(data);
		        if (data.responseJSON.errors.id_categoria)
		        {
		            $("#id_categoria_error").html(data.responseJSON.errors.id_categoria);
		            $("#id_categoria_error").fadeIn();
		        }
		        else
		        {
		            $("#id_categoria_error").fadeOut();
		        }

		        if (data.responseJSON.errors.subcategoria)
		        {
		            $("#subcategoria_error").html(data.responseJSON.errors.subcategoria);
		            $("#subcategoria_error").fadeIn();
		        }
		        else
		        {
		            $("#subcategoria_error").fadeOut();
		        }
		        
		        
		        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
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
		route = '/admin/subcategorias/update/' + id;
		
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
		    	$('#btn-guardar-subcategoria').removeAttr('disabled');
		        toastr.success('Se editó la subcategoría: ' + data.subcategoria);
		        $('#modal-subcategoria').modal('toggle');
		       	ActualizarRegistro(id);
		        BorrarDatos();
		        QuitarErrores();
		    },
		    error: function(data)
		    {
		        $('#btn-guardar-subcategoria').removeAttr('disabled');
		        console.log(data);
		        if (data.responseJSON.errors.id_categoria)
		        {
		            $("#id_categoria_error").html(data.responseJSON.errors.id_categoria);
		            $("#id_categoria_error").fadeIn();
		        }
		        else
		        {
		            $("#id_categoria_error").fadeOut();
		        }

		        if (data.responseJSON.errors.subcategoria)
		        {
		            $("#subcategoria_error").html(data.responseJSON.errors.subcategoria);
		            $("#subcategoria_error").fadeIn();
		        }
		        else
		        {
		            $("#subcategoria_error").fadeOut();
		        }
		        
		        
		        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
		        if (data.status == 422)
		        {
		            console.clear();
		        }
		        //console.clear();
		    }
		});
	}
});

function Edit(id)
{
	$('.modal-header').css(
	{
	    'background-color': '#49ADAD'
	});
	$('.modal-title').css(
	{
	    'color': 'white'
	});
	$('.close').css(
	{
	    'color': 'white',
	    'font-size': 35
	});

	$('#id_subcategoria').val(id);

	route = '/admin/subcategorias/edit/' + id;

	$.get(route, function(data)
	{
		$('.modal-title').html('Editar subcategoría: ' + data.subcategoria);
		$('#subcategoria').val(data.subcategoria);
		$('#id_categoria').val(data.id_categoria).change();
		if(data.renovacion == 1)
		{
			$('#renovacion').attr('checked', 'checked');
		}
		else if(data.renovacion == 0)
		{
			$('#renovacion').removeAttr('checked');
		}
		$('#renovacion_check').val(data.renovacion);

		if(data.comprobacion_uso == 0)
		{
			$('#comprobacion_uso_plazo').val('').change();
			$('#comprobacion_uso').val('0');
		}
		else
		{
			$('#comprobacion_uso_plazo').val('Anios').change();
			comprobacion_uso = data.comprobacion_uso / 364;
			comprobacion_uso = comprobacion_uso.toFixed(0);
			$('#comprobacion_uso').val(comprobacion_uso);
		}

		if(data.recordatorio == 0)
		{
			$('#recordatorio_plazo').val('').change();
			$('#recordatorio').val('0');
		}
		else
		{
			$('#recordatorio_plazo').val('Meses').change();
			recordatorio = data.recordatorio / 30.4;
			recordatorio = recordatorio.toFixed(0);
			$('#recordatorio').val(recordatorio);
		}

		if(data.vencimiento == 0)
		{
			$('#vencimiento_plazo').val('').change();
			$('#vencimiento').val('0');
		}
		else
		{
			$('#vencimiento_plazo').val('Anios').change();
			vencimiento = data.vencimiento / 364;
			vencimiento = vencimiento.toFixed(0);
			$('#vencimiento').val(vencimiento);
		}
	});
}

function Inactivar(id)
{
    token = $('#_token').val();
    estatus = '0';
    formData =
    {
        estatus
    }
    $.confirm(
    {
        title: '¿Desea inactivar la subcategoría?',
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
                text: 'Inactivar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/subcategorias/estatus/' + id;

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        data: formData,
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data)
                        {
                            toastr.info('Se inactivó la subcategoría: ' + data.subcategoria);

                            ActualizarRegistro(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo cancelar la subcategoría.');
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function Activar(id)
{
    token = $('#_token').val();
    estatus = '1';
    formData =
    {
        estatus
    }
    $.confirm(
    {
        title: '¿Desea activar la subcategoría?',
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
                    router = '/admin/subcategorias/estatus/' + id;

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        data: formData,
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data)
                        {
                            toastr.info('Se activó la subcategoría: ' + data.subcategoria);

                            ActualizarRegistro(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar el servicio.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function BorrarDatos()
{
	$('#id_subcategoria').val('');
	$('#subcategoria').val('');
	$('#id_categoria').val('').change();
	$('#comprobacion_uso_plazo').val('').change();
	$('#comprobacion_uso').val('0');
	$('#recordatorio_plazo').val('').change();
	$('#recordatorio').val('0');
	$('#vencimiento_plazo').val('').change();
	$('#vencimiento').val('0');
	$('#renovacion').attr('checked', 'checked');
	$('#renovacion_check').val('1');

}

function QuitarErrores()
{
	$("#id_categoria_error").fadeOut();
	$("#subcategoria_error").fadeOut();
}











