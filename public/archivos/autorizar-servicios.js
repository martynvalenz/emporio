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

$(document).on("click", ".pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado").val();
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

function Listar()
{
    var buscar;
    buscar = $("#buscar").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();

    if (buscar == '')
    {
        route_listar = url_listar;
        //console.log(route_listar);
        $.ajax(
        {
            type: 'get',
            url: route_listar,
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
    else
    {
        $.ajax(
        {
            type: 'get',
            url: url_buscar + buscar,
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
}

function MostrarBitacora(id)
{
    token = $('#_token').val();
    $.confirm(
    {
        title: '¿Desea mostrar el servicio en su bitácora correspondiente?',
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
                text: 'Autorizar',
                btnClass: 'btn-green any-other-class',
                action: function () 
                {
                    router = '/admin/autorizar-servicio/' + id;

                    $.ajax(
                    {
                        url: router,
                        type: 'PUT',
                        dataType: 'json',
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data)
                        {
                            toastr.info('Se autorizó el servicio en la bitácora.');

                            $('#servicio-'+id).remove();
                            NotificacionActualizarServicios();
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo autorizar el servicio.');
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function Cancelar(id)
{
	token = $('#_token').val();
	estatus = 'Cancelado';
	formData =
	{
	    estatus
	}
	$.confirm(
	{
	    title: '¿Desea cancelar el servicio?',
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
	                router = '/admin/procesos/' + id;

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
	                        toastr.info('Se canceló el servicio.');

	                        $('#servicio-'+id).remove();
                            NotificacionActualizarServicios();
	                    },
	                    error: function(data)
	                    {
	                        toastr.error('No se pudo cancelar el servicio.');
	                        console.log(data);
	                    }
	                });
	                
	            }
	        },
	    }
	});
}

function NotificacionActualizarServicios()
{
    route = '/admin/notificacion/servicios-pendientes'
    $.get(route, function(data)
    {
        if(data == '' || data == 0)
        {
            $('#servicios_pendientes_count').html('0');
            $('#servicios_pendientes_count').css(
                {
                    'background-color' : '#49ADAD'
                });
        }
        else
        {
            $('#servicios_pendientes_count').html(data);
            $('#servicios_pendientes_count').css(
                {
                    'background-color' : '#EE5755'
                });
        }
    });
}









