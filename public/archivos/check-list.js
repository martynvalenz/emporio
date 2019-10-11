$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function()
{
    variable = $('#variable').val();
    $('#pendiente_proceso').val(variable).change();
    setTimeout(Listar, 300);
});

$('#servicios_select').on('change', function()
{   
    setTimeout(Listar, 300);
}); 

$('#servicios_tramite').on('change', function()
{  
    setTimeout(Listar, 300);
}); 

$('#pendiente_proceso').on('change', function()
{  
    setTimeout(Listar, 300);
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
    estatus = $("#servicios_select").val();
    tramite = $("#servicios_tramite").val();
    pendiente = $("#pendiente_proceso").val();
    buscar = $("#buscar").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();

    if (buscar == '')
    {
        route_listar = url_listar + estatus + '/' + tramite + '/' + pendiente;
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
            url: url_buscar + estatus + '/' + tramite + '/' + pendiente + '/' + buscar,
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

function Detalles(id)
{
	route = '/admin/check-list/detalles/' + id;

	$('.modal-title').html('Proceso de servicio: ' + id)

	$.ajax(
    {
        type: 'get',
        url: route,
        success: function(data)
        {
            $('#listado-detalles').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

function Check(id, id_servicio, libera_venta, libera_operativa, libera_gestion, registro, id_control,
    categoria, area, iniciales, nombre, apellido)
{
    $('.checkbox_proceso').attr('disabled', 'disabled');
    token = $('#_token').val();
    id_admin = $('#id_admin').val();
    avance = $('#avance_parcial_bitacora').val();
    avance = avance * 1;
    estatus = $('#estatus_val-' + id).val();
    //estatus = estatus * 1;

    if(estatus == 0)
    {
        estatus = 1;
        avance = avance + 1;
    }
    else if(estatus == 1)
    {
        estatus = 0;
        avance = avance - 1;
    }

    //console.log(token);

    formData =
    {
        id, id_servicio, estatus, libera_venta, libera_operativa, libera_gestion, id_admin, avance, registro, id_control
    }

    //console.log(formData);

    if(estatus == 0)
    {
        route = '/admin/bitacoras/check_process/' + id;

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
                var cells = $('#listado-detalles-' + id).children('td'); 
                cells.eq(4).text('');
                $('.checkbox_proceso').removeAttr('disabled');
                //toastr.success('Se actualizó el registro exitosamente');
                $('#estatus_val-' + id).val(estatus);
                $('#avance_parcial_bitacora').val(avance);
            },
            error: function(data)
            {
                console.log(data);
                $('.checkbox_proceso').removeAttr('disabled');
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                if(estatus == 0)
                {
                    $('#paso-' + id).prop('checked', true);
                }
                else if(estatus == 1)
                {
                    $('#paso-' + id).prop('checked', false);
                }

                if (data.status == 422)
                {
                    console.clear();
                }
                //console.clear();
            }
        });
    }
    else if(estatus == 1)
    {
        route = '/admin/bitacoras/uncheck_process/' + id;

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
                var cells = $('#listado-detalles-' + id).children('td'); 
                cells.eq(4).text(iniciales + ' - ' + nombre + ' ' + apellido);
                $('.checkbox_proceso').removeAttr('disabled');
                //toastr.success('Se actualizó el registro exitosamente');
                $('#estatus_val-' + id).val(estatus);
                $('#avance_parcial_bitacora').val(avance);
            },
            error: function(data)
            {
                $('.checkbox_proceso').removeAttr('disabled');
                console.log(data);
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                if(estatus == 0)
                {
                    $('#paso-' + id).prop('checked', true);
                }
                else if(estatus == 1)
                {
                    $('#paso-' + id).prop('checked', false);
                }

                if (data.status == 422)
                {
                    console.clear();
                }
                //console.clear();
            }
        });
    }

    // if(area == 'Operaciones' && categoria != 'Operaciones')
    // {
    //     toastr.error('No tiene permisos para editar ese paso');
    //     $('.checkbox_proceso').removeAttr('disabled');
    //     if(estatus == 0)
    //     {
    //         $('#paso-' + id).prop('checked', true);
    //     }
    //     else if(estatus == 1)
    //     {
    //         $('#paso-' + id).prop('checked', false);
    //     }
    // }
    // else if(area == 'Gestion' && categoria != 'Gestión')
    // {
    //     toastr.error('No tiene permisos para editar ese paso');
    //     $('.checkbox_proceso').removeAttr('disabled');
    //     if(estatus == 0)
    //     {
    //         $('#paso-' + id).prop('checked', true);
    //     }
    //     else if(estatus == 1)
    //     {
    //         $('#paso-' + id).prop('checked', false);
    //     }
    // }
    // else
    // {
        
    // }
}
















