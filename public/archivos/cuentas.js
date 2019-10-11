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
	$.ajax(
	{
	    type: 'get',
	    url: '/admin/cuentas-listar',
	    success: function(data)
	    {
	        $('#listado').empty().html(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            //$('#example').stickyTableHeaders();
	        });
	    },
	    error: function(data)
	    {
	    	console.log(data);
	    }
	});
}

function Create()
{
	$('.modal-header').css(
	{
		'background-color': '#348FE2'
	});
	$('.modal-title').html('Agregar cuenta');
	BorrarDatos();
	QuitarErrores();
}

function Edit(id)
{
	$('.modal-header').css(
		{
			'background-color': '#FE9800'
		});

	$('#id_cuenta').val(id);
	QuitarErrores();
	route = '/admin/cuentas/' + id + '/edit';

	$.get(route, function(data)
	{
		$('.modal-title').html('Editar cuenta ' + data.alias);

		$('#tipo').val(data.tipo).change();
		$('#alias').val(data.alias);
		$('#id_banco').val(data.id_banco).change();
		$('#saldo_inicial').val(data.saldo_inicial);
		$('#cuenta').val(data.cuenta);
		$('#clabe').val(data.clabe);
		$('#tarjeta').val(data.tarjeta);
		$('#comentarios').val(data.comentarios);
	});
}

$('#btn-save').click(function()
{
	$('#btn-save').attr('disabled', 'disabled');
	id_cuenta = $('#id_cuenta').val();
	tipo = $('#tipo').val();
	alias = $('#alias').val();
	id_banco = $('#id_banco').val();
	saldo_inicial = $('#saldo_inicial').val();
	cuenta = $('#cuenta').val();
	clabe = $('#clabe').val();
	tarjeta = $('#tarjeta').val();
	comentarios = $('#comentarios').val();
	token = $('#_token').val();

	formData ={id_cuenta, tipo, alias, id_banco, saldo_inicial, cuenta, clabe, tarjeta, comentarios}

	if(id_cuenta == '')
	{
		route = '/admin/cuentas/store';

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
			    
			    toastr.success('Se agregó la cuenta exitosamente');
			    Listar();
			    $('#btn-save').removeAttr('disabled');
			    $("#modal-cuenta").modal('toggle');
			    QuitarErrores();
			    BorrarDatos();
			},
			error: function(data)
			{
			    $('#btn-save').removeAttr('disabled');

			    console.log(data);
			    if (data.responseJSON.errors.alias)
			    {
			        $("#alias_error").html(data.responseJSON.errors.alias);
			        $("#alias_error").fadeIn();
			    }
			    else
			    {
			        $("#alias_error").fadeOut();
			    }

			    if (data.responseJSON.errors.tipo)
			    {
			        $("#tipo_error").html(data.responseJSON.errors.tipo);
			        $("#tipo_error").fadeIn();
			    }
			    else
			    {
			        $("#tipo_error").fadeOut();
			    }

			    if (data.responseJSON.errors.cuenta)
			    {
			        $("#cuenta_error").html(data.responseJSON.errors.cuenta);
			        $("#cuenta_error").fadeIn();
			    }
			    else
			    {
			        $("#cuenta_error").fadeOut();
			    }

			    if (data.responseJSON.errors.clabe)
			    {
			        $("#clabe_error").html(data.responseJSON.errors.clabe);
			        $("#clabe_error").fadeIn();
			    }
			    else
			    {
			        $("#clabe_error").fadeOut();
			    }

			    if (data.responseJSON.errors.tarjeta)
			    {
			        $("#tarjeta_error").html(data.responseJSON.errors.tarjeta);
			        $("#tarjeta_error").fadeIn();
			    }
			    else
			    {
			        $("#tarjeta_error").fadeOut();
			    }

			    if (data.responseJSON.errors.saldo_inicial)
			    {
			        $("#saldo_inicial_error").html(data.responseJSON.errors.saldo_inicial);
			        $("#saldo_inicial_error").fadeIn();
			    }
			    else
			    {
			        $("#saldo_inicial_error").fadeOut();
			    }

			    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
			    if (data.status == 422)
			    {
			        console.clear();
			    }
			    console.clear();
			}
		});
	}
	else
	{
		route = '/admin/cuentas/update/' + id_cuenta;

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
			    toastr.success('Se editó la cuenta exitosamente');
			    Listar();
			    $('#btn-save').removeAttr('disabled');
			    $("#modal-cuenta").modal('toggle');
			    QuitarErrores();
			    BorrarDatos();
			},
			error: function(data)
			{
			    $('#btn-save').removeAttr('disabled');

			    console.log(data);
			    if (data.responseJSON.errors.alias)
			    {
			        $("#alias_error").html(data.responseJSON.errors.alias);
			        $("#alias_error").fadeIn();
			    }
			    else
			    {
			        $("#alias_error").fadeOut();
			    }

			    if (data.responseJSON.errors.tipo)
			    {
			        $("#tipo_error").html(data.responseJSON.errors.tipo);
			        $("#tipo_error").fadeIn();
			    }
			    else
			    {
			        $("#tipo_error").fadeOut();
			    }

			    if (data.responseJSON.errors.cuenta)
			    {
			        $("#cuenta_error").html(data.responseJSON.errors.cuenta);
			        $("#cuenta_error").fadeIn();
			    }
			    else
			    {
			        $("#cuenta_error").fadeOut();
			    }

			    if (data.responseJSON.errors.clabe)
			    {
			        $("#clabe_error").html(data.responseJSON.errors.clabe);
			        $("#clabe_error").fadeIn();
			    }
			    else
			    {
			        $("#clabe_error").fadeOut();
			    }

			    if (data.responseJSON.errors.tarjeta)
			    {
			        $("#tarjeta_error").html(data.responseJSON.errors.tarjeta);
			        $("#tarjeta_error").fadeIn();
			    }
			    else
			    {
			        $("#tarjeta_error").fadeOut();
			    }

			    if (data.responseJSON.errors.saldo_inicial)
			    {
			        $("#saldo_inicial_error").html(data.responseJSON.errors.saldo_inicial);
			        $("#saldo_inicial_error").fadeIn();
			    }
			    else
			    {
			        $("#saldo_inicial_error").fadeOut();
			    }

			    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
			    if (data.status == 422)
			    {
			        console.clear();
			    }
			    console.clear();
			}
		});
	}
});

function BorrarDatos()
{
	$('#tipo').val('').change();
	$('#alias').val('');
	$('#id_banco').val('').change();
	$('#saldo_inicial').val('0');
	$('#cuenta').val('');
	$('#clabe').val('');
	$('#tarjeta').val('');
	$('#comentarios').val('');
	$('#id_cuenta').val('');
}

function QuitarErrores()
{
	$('#tipo_error').fadeOut();
	$('#alias_error').fadeOut();
	$('#id_banco_error').fadeOut();
	$('#saldo_inicial_error').fadeOut();
	$('#cuenta_error').fadeOut();
	$('#clabe_error').fadeOut();
	$('#tarjeta_error').fadeOut();
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
        title: '¿Desea activar la cuenta o tarjeta?',
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
                    router = '/admin/cuentas/destroy/' + id;

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
                            toastr.info('Se activó la cuenta.');

                            Listar();
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar la cuenta.')
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
    estatus = '0';
    formData =
    {
        estatus
    }
    $.confirm(
    {
        title: '¿Desea inactivar la cuenta o tarjeta',
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
                    router = '/admin/cuentas/destroy/' + id;

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
                            toastr.info('Se inactivó la cuenta.');
                            Listar();
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo inactivar la cuenta.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}


















