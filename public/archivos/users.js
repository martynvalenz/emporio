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

$("#btn-borrar").click(function()
{
    //ResetearFecha();
    $('#buscar').val('');
    setTimeout(Listar, 300);
});

$("#btn-buscar").on("click", function(e)
{
    e.preventDefault();
    Listar();
});

$('#buscar').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        Listar();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

function Listar()
{
	var buscar = $("#buscar").val();
	estatus = $('#estatus_select').val();

	if(buscar == '')
	{
		$.ajax(
		{
		    type: 'get',
		    url: '/admin/usuarios-listado/' + estatus,
		    success: function(data)
		    {
		        $('#listado').empty().html(data);
		        $(".tooltip").tooltip("hide");
		        $(function()
		        {
		            $('#example').stickyTableHeaders();
		        });
		    },
		    error: function(data)
		    {
		    	console.log(data);
		    }
		});
	}
	else
	{
		$.ajax(
		{
		    type: 'get',
		    url: '/admin/usuarios-buscar/' + buscar,
		    success: function(data)
		    {
		        $('#listado').empty().html(data);
		        $(".tooltip").tooltip("hide");
		        $(function()
		        {
		            $('#example').stickyTableHeaders();
		        });
		    },
		    error: function(data)
		    {
		    	console.log(data);
		    }
		});
	}
}

function AgregarListado(id)
{
	url_nuevo = '/admin/usuarios-actualizar/';
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_nuevo + id,
	    success: function(data)
	    {
	        $('#list').prepend(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });
	        //console.log(data);
	    }
	});
}

function ActualizarListado(id)
{
	url_actualizar = '/admin/usuarios-actualizar/';
	//console.log(url_actualizar);
	$.ajax(
	{
	    type: 'get',
	    url: url_actualizar + id,
	    success: function(data)
	    {
	        //console.log(data);
	        $('#user-' + id).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });
	        //console.log(data);
	    }
	}); 
}

$('#estatus').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#estatus_check").val(this.value);
}).change();

$('#acepta_comision').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#acepta_comision_check").val(this.value);
}).change();

$('#responsabilidad').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#responsabilidad_check").val(this.value);
}).change();

$('#nomina').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#nomina_check").val(this.value);

    if(this.value == 0)
    {
    	$('#sueldo_quincenal_boolean').attr('hidden', 'hidden');
    }
    else
    {
    	$('#sueldo_quincenal_boolean').removeAttr('hidden');
    }

}).change();

function CreateUser()
{
	$('.modal-title').html('Agregar usuario');
	BorrarUser();
	QuitarErroresUser();
}

function EditUser(id)
{
	$('.modal-title').html('Editar usuario: ' + id);	
	QuitarErroresUser();
	$('#id_usuario').val(id);
	route = '/admin/usuarios/edit/' + id;
	$.get(route, function(data)
	{
		$('#role_id').val(data.role_id).change();
		$('#area').val(data.area).change();
		$('#iniciales').val(data.iniciales);
		$('#nombre').val(data.nombre);
		$('#apellido').val(data.apellido);
		$('#usuario').val(data.usuario);
		$('#email').val(data.email);
		$('#password').val(data.contra);
		$('#telefono').val(data.telefono);
		$('#celular').val(data.celular);
		$('#oficina').val(data.oficina);

		if(data.estatus == 1)
		{
			$('#estatus').prop('checked', true);
			$("#estatus_check").val("1");
		}
		else
		{
			$('#estatus').prop('checked', false);
			$("#estatus_check").val("0");
		}

		if(data.acepta_comision == 1)
		{
			$('#acepta_comision').prop('checked', true);
			$("#acepta_comision_check").val("1");
		}
		else
		{
			$('#acepta_comision').prop('checked', false);
			$("#acepta_comision_check").val("0");
		}

		if(data.responsabilidad == 1)
		{
			$('#responsabilidad').prop('checked', true);
			$("#responsabilidad_check").val("1");
		}
		else
		{
			$('#responsabilidad').prop('checked', false);
			$("#responsabilidad_check").val("0");
		}

		if(data.nomina == 1)
		{
			$('#nomina').prop('checked', true);
			$('#sueldo_quincenal_boolean').removeAttr('hidden');
			$('#sueldo_quincenal').val(data.sueldo_quincenal);
			$("#nomina_check").val("1");
		}
		else
		{
			$('#nomina').prop('checked', false);
			$('#sueldo_quincenal_boolean').attr('hidden', 'hidden');
			$('#sueldo_quincenal').val('0');
			$("#nomina_check").val("0");
		}
	});
}

$('#btn-save-user').click(function()
{
	$('#btn-save-user').attr('disabled', 'disabled');
	token = $('#_token').val();
	estatus = $("#estatus_check").val();
	acepta_comision = $("#acepta_comision_check").val();
	responsabilidad = $("#responsabilidad_check").val();
	nomina = $("#nomina_check").val();
	sueldo_quincenal = $('#sueldo_quincenal').val();
	role_id = $('#role_id').val();
	area = $('#area').val();
	iniciales = $('#iniciales').val();
	nombre = $('#nombre').val();
	apellido = $('#apellido').val();
	usuario = $('#usuario').val();
	email = $('#email').val();
	password = $('#password').val();
	telefono = $('#telefono').val();
	celular = $('#celular').val();
	oficina = $('#oficina').val();
	id_usuario = $('#id_usuario').val();

	formData = {estatus, acepta_comision, responsabilidad, nomina, sueldo_quincenal, role_id, area, iniciales, nombre, 
		apellido, usuario, email, password, telefono, celular, oficina}

	if(id_usuario == '')
	{
		route = '/admin/usuarios/store';

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
				$('#btn-save-user').removeAttr('disabled');
				toastr.success('Se agregó el usuario existosamente');
				BorrarUser();
				QuitarErroresUser();
				$('#modal-user').modal('toggle');
				AgregarListado(data.id);
			},
			error: function(data)
			{
				$('#btn-save-user').removeAttr('disabled');
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');
				console.log(data);
				if (data.responseJSON.errors.iniciales)
				{
				    $("#iniciales_error").html(data.responseJSON.errors.iniciales);
				    $("#iniciales_error").fadeIn();
				}
				else
				{
				    $("#iniciales_error").fadeOut();
				}

				if (data.responseJSON.errors.nombre)
				{
				    $("#nombre_error").html(data.responseJSON.errors.nombre);
				    $("#nombre_error").fadeIn();
				}
				else
				{
				    $("#nombre_error").fadeOut();
				}

				if (data.responseJSON.errors.apellido)
				{
				    $("#apellido_error").html(data.responseJSON.errors.apellido);
				    $("#apellido_error").fadeIn();
				}
				else
				{
				    $("#apellido_error").fadeOut();
				}

				if (data.responseJSON.errors.email)
				{
				    $("#email_error").html(data.responseJSON.errors.email);
				    $("#email_error").fadeIn();
				}
				else
				{
				    $("#email_error").fadeOut();
				}

				if (data.responseJSON.errors.usuario)
				{
				    $("#usuario_error").html(data.responseJSON.errors.usuario);
				    $("#usuario_error").fadeIn();
				}
				else
				{
				    $("#usuario_error").fadeOut();
				}

				if (data.responseJSON.errors.password)
				{
				    $("#password_error").html(data.responseJSON.errors.password);
				    $("#password_error").fadeIn();
				}
				else
				{
				    $("#password_error").fadeOut();
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

				if (data.responseJSON.errors.role_id)
				{
				    $("#role_id_error").html(data.responseJSON.errors.role_id);
				    $("#role_id_error").fadeIn();
				}
				else
				{
				    $("#role_id_error").fadeOut();
				}

				if (data.responseJSON.errors.area)
				{
				    $("#area_error").html(data.responseJSON.errors.area);
				    $("#area_error").fadeIn();
				}
				else
				{
				    $("#area_error").fadeOut();
				}

				if (data.status == 422)
				{
				    console.clear();
				}
			}
		});
	}
	else
	{
		route = '/admin/usuarios/update/' + id_usuario;

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
				$('#btn-save-user').removeAttr('disabled');
				toastr.success('Se editó el usuario ' + nombre + ' ' + apellido);
				BorrarUser();
				QuitarErroresUser();
				$('#modal-user').modal('toggle');
				ActualizarListado(data.id);
			},
			error: function(data)
			{
				$('#btn-save-user').removeAttr('disabled');
				toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');
				console.log(data);
				if (data.responseJSON.errors.iniciales)
				{
				    $("#iniciales_error").html(data.responseJSON.errors.iniciales);
				    $("#iniciales_error").fadeIn();
				}
				else
				{
				    $("#iniciales_error").fadeOut();
				}

				if (data.responseJSON.errors.nombre)
				{
				    $("#nombre_error").html(data.responseJSON.errors.nombre);
				    $("#nombre_error").fadeIn();
				}
				else
				{
				    $("#nombre_error").fadeOut();
				}

				if (data.responseJSON.errors.apellido)
				{
				    $("#apellido_error").html(data.responseJSON.errors.apellido);
				    $("#apellido_error").fadeIn();
				}
				else
				{
				    $("#apellido_error").fadeOut();
				}

				if (data.responseJSON.errors.email)
				{
				    $("#email_error").html(data.responseJSON.errors.email);
				    $("#email_error").fadeIn();
				}
				else
				{
				    $("#email_error").fadeOut();
				}

				if (data.responseJSON.errors.usuario)
				{
				    $("#usuario_error").html(data.responseJSON.errors.usuario);
				    $("#usuario_error").fadeIn();
				}
				else
				{
				    $("#usuario_error").fadeOut();
				}

				if (data.responseJSON.errors.password)
				{
				    $("#password_error").html(data.responseJSON.errors.password);
				    $("#password_error").fadeIn();
				}
				else
				{
				    $("#password_error").fadeOut();
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

				if (data.responseJSON.errors.role_id)
				{
				    $("#role_id_error").html(data.responseJSON.errors.role_id);
				    $("#role_id_error").fadeIn();
				}
				else
				{
				    $("#role_id_error").fadeOut();
				}

				if (data.responseJSON.errors.area)
				{
				    $("#area_error").html(data.responseJSON.errors.area);
				    $("#area_error").fadeIn();
				}
				else
				{
				    $("#area_error").fadeOut();
				}

				if (data.status == 422)
				{
				    console.clear();
				}
			}
		});		
	}
});

function BorrarUser()
{
	$("#estatus").val("1").change();
    $('#estatus').prop('checked', true);
    $("#estatus_check").val("1");
    $("#acepta_comision").val("0").change();
    $('#acepta_comision').prop('checked', false);
    $("#acepta_comision_check").val("0");
    $("#responsabilidad").val("0").change();
    $('#responsabilidad').prop('checked', false);
    $("#responsabilidad_check").val("0");
    $("#nomina").val("0").change();
    $('#nomina').prop('checked', false);
    $("#nomina_check").val("0");
    $('#sueldo_quincenal_boolean').attr('hidden', 'hidden');
    $('#sueldo_quincenal').val('0');

    $('#role_id').val('').change();
    $('#area').val('').change();
    $('#iniciales').val('');
    $('#nombre').val('');
    $('#apellido').val('');
    $('#usuario').val('');
    $('#email').val('');
    $('#password').val('');
    $('#telefono').val('');
    $('#celular').val('');
    $('#oficina').val('');
    $('#id_usuario').val('');
}

function QuitarErroresUser()
{
	$('#role_id_error').fadeOut();
	$('#area_error').fadeOut();
	$('#iniciales_error').fadeOut();
	$('#nombre_error').fadeOut();
	$('#apellido_error').fadeOut();
	$('#usuario_error').fadeOut();
	$('#email_error').fadeOut();
	$('#password_error').fadeOut();
	$('#telefono_error').fadeOut();
	$('#celular_error').fadeOut();
	$('#oficina_error').fadeOut();
	$('#sueldo_quincenal_error').fadeOut();
}

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
	                router = '/admin/usuarios/estatus/' + id;

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
	                        toastr.info('Se activó el usuario.');

	                        ActualizarListado(id);
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
	                router = '/admin/usuarios/estatus/' + id;

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
	                        toastr.info('Se inactivó el usuario.');

	                        ActualizarListado(id);
	                    },
	                    error: function(data)
	                    {
	                        toastr.error('No se pudo inactivar el usuario.')
	                        console.log(data);
	                    }
	                });
	                
	            }
	        },
	    }
	});
}







//Cambiar Contra

function Contra(id, iniciales, nombre, apellido, contra)
{
	$('#usuario_password').html(iniciales + ' - ' + nombre + ' ' + apellido);
	$('#id_password').val(id);
	$('#contra_actual').val(contra);
	QuitarErroresContra();
}

$('#btn-guardar-contra').click(function()
{
	$('#btn-guardar-contra').attr('disabled', 'disabled');
	token = $('#_token').val();
	id = $('#id_password').val();
	password = $('#password_nuevo').val();
	confirmacion = $('#password_confirmation_nuevo').val();

	if(password == '')
	{
		$('#btn-guardar-contra').removeAttr('disabled');
		toastr.info('No se cambió la contraseña.');
		$('#modal-contra').modal('toggle');
		QuitarErroresContra();
		BorrarContra();
	}
	else if(password != '' && password != confirmacion)
	{
		$('#btn-guardar-contra').removeAttr('disabled');
		$('#password_nuevo_error').fadeIn();
		$('#password_nuevo_error').html('Las contraseñas no coinciden');
		$('#password_confirmation_nuevo_error').fadeIn();
		$('#password_confirmation_nuevo_error').html('Las contraseñas no coinciden');
	}
	else if(password != '' && password == confirmacion)
	{
		formData = {password}
		route = '/admin/usuarios/contra/' + id;

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
				$('#btn-guardar-contra').removeAttr('disabled');
				$('#modal-contra').modal('toggle');
				toastr.success('Se cambió la contraseña');
				ActualizarListado(id);
				QuitarErroresContra();
				BorrarContra();
			},
			error: function(data)
			{
				$('#btn-guardar-contra').removeAttr('disabled');
				console.log(data);
				toastr.error('No se pudo cambiar la contraseña');
			}
		});
	}
});

function BorrarContra()
{
	//$('#usuario_password').html('');
	$('#id_password').val('');
	$('#contra_actual').val('');
	$('#password_nuevo').val('');
	$('#password_confirmation_nuevo').val('');
}

function QuitarErroresContra()
{
	$('#password_nuevo_error').fadeOut();
	$('#password_confirmation_nuevo_error').fadeOut();
}

























