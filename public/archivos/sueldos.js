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

$('#estatus_select').change(function()
{
    Listar();
});

function Listar()
{
    var estatus = $('#estatus_select').val();
    var url_listar = $('#url_listar').val();
    //console.log(id_admin);

    $.ajax(
    {
        type: 'get',
        url: url_listar + estatus,
        success: function(data)
        {
            $('#listado').empty().html(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        }
    });
}

function Actualizar(id)
{
	var url_actualizar = $('#url_actualizar').val();
	//console.log(id_admin);

	$.ajax(
	{
	    type: 'get',
	    url: url_actualizar + id,
	    success: function(data)
	    {
	        $('#empleado-' + id).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('#example1').stickyTableHeaders();
	        });
	    }
	});
}

function EditarEmpleado(id, name, sueldo)
{
	$('.modal-title').html('Editar sueldo de: ' + name);
	$('#name_empleado').val(name);
	$('#id_empleado').val(id);
	sueldo_diario = sueldo / 15;
	sueldo_quincenal = sueldo;
	sueldo_diario = sueldo_diario.toFixed(2);
	sueldo_quincenal = sueldo_quincenal.toFixed(2);
	$('#sueldo_diario').val(sueldo_diario);
	$('#sueldo_quincenal').val(sueldo_quincenal);
	$('#sueldo_diario_error').fadeOut();
	$('#sueldo_quincenal_error').fadeOut();
}

$('#sueldo_quincenal').change(function()
{
	sueldo = $(this).val();

	if(sueldo == '')
	{
		sueldo_diario = 0;
	}
	else
	{
		sueldo_quincenal = sueldo * 1;
		sueldo_diario = sueldo_quincenal / 15
		sueldo_diario = sueldo_diario.toFixed(2);
		sueldo_quincenal = sueldo_quincenal.toFixed(2);
		$('#sueldo_diario').val(sueldo_diario);
	}
});

$('#btn-guardar-empleado').click(function()
{
	$('#btn-guardar-empleado').attr('disabled', 'disabled');
	sueldo = $('#sueldo_quincenal').val();
	id = $('#id_empleado').val();
	token = $('#_token').val();
	name_empleado = $('#name_empleado').val();

	if(sueldo == '')
	{
		sueldo_diario = 0;
		$('#sueldo_quincenal_error').html('Ingrese un monto');
		$('#sueldo_quincenal_error').fadeIn();
		$('#btn-guardar-empleado').removeAttr('disabled');
	}
	else
	{
		sueldo_quincenal = sueldo * 1;
		sueldo_diario = sueldo_quincenal / 15
		sueldo_diario = sueldo_diario.toFixed(2);
		sueldo_quincenal = sueldo_quincenal.toFixed(2);
		$('#sueldo_diario').val(sueldo_diario);

		formData = {sueldo_diario, sueldo_quincenal}

		$.ajax(
		{
			url: '/admin/direccion/sueldos-update/' + id,
			headers:
			{
			    'X-CSRF-TOKEN': token
			},
			type: 'PUT',
			dataType: 'json',
			data: formData,
			success: function(data)
			{
				toastr.success('Se editó el empleado: ' + name_empleado);
				$('#btn-guardar-empleado').removeAttr('disabled');
			    Actualizar(id);
			    $('#modal-empleado').modal('toggle');
			    $('#sueldo_diario_error').fadeOut();
			    $('#sueldo_quincenal_error').fadeOut();
			},
			error: function(data)
			{
			    console.log(data);
			    $('#btn-guardar-empleado').removeAttr('disabled');
			    toastr.error('No se pudo ingresar el registro, revise los errores en la consola.');

			    if (data.responseJSON.errors.sueldo_diario)
			    {
			        $("#sueldo_diario_error").html(data.responseJSON.errors.sueldo_diario);
			        $("#sueldo_diario_error").fadeIn();
			    }
			    else
			    {
			        $("#sueldo_diario_error").fadeOut();
			    }
			    if (data.responseJSON.errors.sueldo_quincenal)
			    {
			        $("#sueldo_quincenal_error").html(data.responseJSON.errors.sueldo_quincenal);
			        $("#sueldo_quincenal_error").fadeIn();
			    }
			    else
			    {
			        $("#sueldo_quincenal_error").fadeOut();
			    }
			    			    if (data.status == 422)
			    {
			        console.clear();
			    }
			}
		});
	}
});

function Activar(id)
{
    token = $('#_token').val();
    estatus = 1;
    formData =
    {
        estatus
    }
    $.confirm(
    {
        title: '¿Desea activar el usuario?',
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
                    router = '/admin/direccion/sueldos-estatus/' + id;

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
                            toastr.info('Se activó el usuario.');

                            Actualizar(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar el usuario.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function Inactivar(id)
{
	token = $('#_token').val();
	estatus = 0;
	formData =
	{
	    estatus
	}
	$.confirm(
	{
	    title: '¿Desea inactivar el usuario?',
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
	                router = '/admin/direccion/sueldos-estatus/' + id;

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
	                        toastr.info('Se inactivó el usuario.');

	                        Actualizar(id);
	                    },
	                    error: function(data)
	                    {
	                        toastr.error('No se pudo activar el usuario.')
	                        console.log(data);
	                    }
	                });
	                
	            }
	        },
	    }
	});
}














