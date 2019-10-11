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

$("#btn-buscar").on("click", function(e)
{
    e.preventDefault();
    Listar();

});


$('#estatus_select').on('change', function()
{
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

$("#btn-borrar").click(function()
{
    $('#buscar').val('');
    setTimeout(Listar, 300);
});

function Exportar()
{
    estatus = $("#estatus_select").val();
    buscar = $("#buscar").val();

    if(buscar == '')
    {
        buscar = 0;
    }
    else
    {
        //
    }

    url = '/admin/servicios/exportar/' + estatus + '/' + buscar;
    window.location.href = url;

}

var Listar = function()
{
    estatus = $("#estatus_select").val();
    buscar = $("#buscar").val();

    url_listar = $('#url_listar').val();
    url_buscar = $('#url_buscar').val();
    //console.log(route);

    if (buscar == '')
    {
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
    else
    {
        //toastr.error('hubo un error');
        $.ajax(
        {
            type: 'get',
            url: url_buscar + estatus + '/' + buscar,
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
}

function ActualizarRegistro(id)
{
    url_actualizar = $('#url_actualizar').val();
    route = url_actualizar + id
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: route,
        success: function(data)
        {
            $('#catalogo-' + id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        }
    });
}

/*var Create = function()
{
    $("#encabezado-servicio").html("Agregar Servicio");
    $('#encabezado').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-servicio").removeClass();
    $("#btn-servicio").toggleClass("btn btn-primary btn-flat");

    $("#estatus").val("1").change();
    $('#estatus').prop('checked', true);
    $("#estatus_check").val("1");

    $("#costo_servicio").val("0.00");
    $("#costo").val("0.00");
    $("#comision_venta_monto").val("0.00");
    $("#comision_gestion_monto").val("0.00");
    $("#comision_operativa_monto").val("0.00");

}*/

/*$('#id_categoria_servicios').on('change', function()
{
    id_categoria = $(this).val();
    select_change = $('#select_change').val();

    if(select_change  == 0)
    {
        $('#id_subcategoria').empty();

        if(id_categoria == '')
        {
            $('#id_subcategoria').append('<option value="">-Sin selección-</option>');
        }
        else
        {
            route = '/admin/servicios/subcategoria/' + id_categoria;
            $.get(route, function(data)
            {
                //$('#id_subcategoria').append('<option value="">-Sin selección-</option>');

                $.each(data, function(index, item)
                {
                    $('#id_subcategoria').append('<option value ="' + item.id + '">' + item.subcategoria +
                        '</option>');
                });
            });
        }
    }
    else
    {
        //
    }
});*/

$('#concepto').on('change', function()
{
    $('#validar').val('0');
});

$('#moneda').on('change', function()
{
    $('#validar').val('0');
});

$('#costo_servicio').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#costo').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#comision_venta').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#comision_operativa').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#comision_gestion').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#comision_venta_monto').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#comision_operativa_monto').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#comision_gestion_monto').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#porcentaje_venta').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#porcentaje_operativa').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

$('#porcentaje_gestion').on('change', function()
{
    $('#validar').val('0');
    // ActualizarMontos();
});

function ActualizarMontos()
{
    costo_servicio = $('#costo_servicio').val();
    costo = $('#costo').val();
    comision_venta = $('#comision_venta').val();
    comision_operativa = $('#comision_operativa').val();
    comision_gestion = $('#comision_gestion').val();
    comision_venta_monto = $('#comision_venta_monto').val();
    comision_operativa_monto = $('#comision_operativa_monto').val();
    comision_gestion_monto = $('#comision_gestion_monto').val();
    porcentaje_venta = $('#porcentaje_venta').val();
    porcentaje_operativa = $('#porcentaje_operativa').val();
    porcentaje_gestion = $('#porcentaje_gestion').val();

    if(costo_servicio >= 0 && costo >= 0 && costo >= costo_servicio)
    {
        margen = (costo * 1) - (costo_servicio * 1);

        if(comision_venta_monto == 0)
        {
            $('#porcentaje_venta').val('0');
        }
        else if((comision_venta == 'Monto fijo' || comision_venta == 'Monto Fijo') && comision_venta_monto > 0)
        {
            porcentaje_venta = Math.round(comision_venta_monto / margen * 100);
            $('#porcentaje_venta').val(porcentaje_venta);
        }
        else if((comision_venta == 'Porcentaje' || comision_venta == 'Porcentaje Utilidad') && porcentaje_venta > 0)
        {
            comision_venta_monto = Math.round((porcentaje_venta / 100) * margen);
        }

        if(comision_operativa_monto == 0)
        {
            $('#porcentaje_operativa').val('0');
        }
        else if((comision_operativa == 'Monto fijo' || comision_operativa == 'Monto Fijo') && comision_operativa_monto > 0)
        {
            porcentaje_operativa = Math.round(comision_operativa_monto / margen * 100);
            $('#porcentaje_operativa').val(porcentaje_operativa);
        }
        else if((comision_operativa == 'Porcentaje' || comision_operativa == 'Porcentaje Utilidad') && porcentaje_operativa > 0)
        {
            comision_operativa_monto = Math.round((porcentaje_operativa / 100) * margen);
        }

        if(comision_gestion_monto == 0)
        {
            $('#porcentaje_gestion').val('0');
        }
        else if((comision_gestion == 'Monto fijo' || comision_gestion == 'Monto Fijo') && comision_gestion_monto > 0)
        {
            porcentaje_gestion = Math.round(comision_gestion_monto / margen * 100);
            $('#porcentaje_gestion').val(porcentaje_gestion);
        }
        else if((comision_gestion == 'Porcentaje' || comision_gestion == 'Porcentaje Utilidad') && porcentaje_gestion > 0)
        {
            comision_gestion_monto = Math.round((porcentaje_gestion / 100) * margen);
        }
    }
}

$('#btn-validar').click(function()
{
    QuitarErrores();
    concepto = $('#concepto').val();
    costo_servicio = $('#costo_servicio').val();
    costo = $('#costo').val();
    comision_venta = $('#comision_venta').val();
    comision_venta_monto = $('#comision_venta_monto').val();
    comision_operativa = $('#comision_operativa').val();
    comision_operativa_monto = $('#comision_operativa_monto').val();
    comision_gestion = $('#comision_gestion').val();
    comision_gestion_monto = $('#comision_gestion_monto').val();
    porcentaje_venta = $('#porcentaje_venta').val();
    porcentaje_operativa = $('#porcentaje_operativa').val();
    porcentaje_gestion = $('#porcentaje_gestion').val();

    margen = (costo * 1) - (costo_servicio * 1);

    if(concepto == '')
    {
        $('#concepto').addClass('is-invalid')
        $('#concepto_error').html('El campo concepto de costo no puede estar vacío.');
        $('#concepto_error').fadeIn();
    }
    else if(costo_servicio == '' || costo_servicio < 0)
    {
        $('#costo_servicio').addClass('is-invalid')
        $('#costo_servicio_error').html('El campo costo Emporio no puede estar vacío o ser menor a 0.');
        $('#costo_servicio_error').fadeIn();
        $('#costo_servicio').val('0');
    }
    else if(costo == '' || costo < 0)
    {
        $('#costo').addClass('is-invalid')
        $('#costo_error').html('El campo costo no puede estar vacío o ser menor a 0.');
        $('#costo_error').fadeIn();
        $('#costo').val('0');
    }
    else if(margen < 0)
    {
        $('#costo').addClass('is-invalid');
        $('#costo_servicio').addClass('is-invalid');
        $('#costo_error').html('El campo costo no puede ser menor al costo del servicio.');
        $('#costo_error').fadeIn();
        $('#costo').val('0');
    }
    else if(comision_venta_monto == '' || comision_venta_monto < 0)
    {
        $('#comision_venta_monto').addClass('is-invalid')
        $('#comision_venta_monto_error').html('El campo comisión venta no puede estar vacío o ser menor a 0.');
        $('#comision_venta_monto_error').fadeIn();
        $('#comision_venta_monto').val('0');
    }
    else if(comision_operativa_monto == '' || comision_operativa_monto < 0)
    {
        $('#comision_operativa_monto').addClass('is-invalid')
        $('#comision_operativa_monto_error').html('El campo comisión operativa no puede estar vacío o ser menor a 0.');
        $('#comision_operativa_monto_error').fadeIn();
        $('#comision_operativa_monto').val('0');
    }
    else if(comision_gestion_monto == '' || comision_gestion_monto < 0)
    {
        $('#comision_gestion_monto').addClass('is-invalid')
        $('#comision_gestion_monto_error').html('El campo comisión por gestión no puede estar vacío o ser menor a 0.');
        $('#comision_gestion_monto_error').fadeIn();
        $('#comision_gestion_monto').val('0');
    }
    else if(porcentaje_venta == '' || porcentaje_venta < 0 || porcentaje_venta > 100)
    {
        $('#porcentaje_venta').addClass('is-invalid')
        $('#porcentaje_venta_error').html('El campo porcentaje de venta no puede estar vacío o ser menor a 0 o mayor a 100.');
        $('#porcentaje_venta_error').fadeIn();
        $('#porcentaje_venta').val('0');
    }
    else if(porcentaje_operativa == '' || porcentaje_operativa < 0 || porcentaje_operativa > 100)
    {
        $('#porcentaje_operativa').addClass('is-invalid')
        $('#porcentaje_operativa_error').html('El campo porcentaje de operaciones no puede estar vacío o ser menor a 0 o mayor a 100.');
        $('#porcentaje_operativa_error').fadeIn();
        $('#porcentaje_operativa').val('0');
    }
    else if(porcentaje_gestion == '' || porcentaje_gestion < 0 || porcentaje_gestion > 100)
    {
        $('#porcentaje_gestion').addClass('is-invalid')
        $('#porcentaje_gestion_error').html('El campo porcentaje de gestión no puede estar vacío o ser menor a 0 o mayor a 100.');
        $('#porcentaje_gestion_error').fadeIn();
        $('#porcentaje_gestion').val('0');
    }
    else
    {
        QuitarErrores();

        costo = costo * 1;
        costo_servicio = costo_servicio * 1;

        //Comisión Venta
        if(comision_venta == '')
        {
            $('#comision_venta_monto').val('0');
            $('#porcentaje_venta').val('0');
         
            comision_venta_monto = 0;
            porcentaje_venta = 0;
        }
        else if(comision_venta == 'Monto Fijo' || comision_venta == 'Monto fijo')
        {
            comision_venta_monto = comision_venta_monto * 1;

            if(costo == 0 && costo_servicio == 0)
            {
                $('#porcentaje_venta').val('0');
            }
            else if(comision_venta_monto >= margen && costo > 0)
            {
                $('#comision_venta_monto').addClass('is-invalid')
                $('#comision_venta_monto_error').html('La comision no puede ser mayor o igual al margen residual del costo menos el costo Emporio.');
                $('#comision_venta_monto_error').fadeIn();
                $('#comision_venta_monto').val('0');
                $('#porcentaje_venta').val('0');
                comision_venta_monto = 0;
            }
            else if(comision_venta_monto == 0)
            {
                $('#porcentaje_venta').val('0');
                porcentaje_venta = 0;
            }
            else if(comision_venta_monto < margen)
            {
                porcentaje_venta = Math.round(comision_venta_monto / margen * 100);
                $('#porcentaje_venta').val(porcentaje_venta);
            }
        }
        else if(comision_venta == 'Porcentaje' || comision_venta == 'Porcentaje Utilidad')
        {
            porcentaje_venta = porcentaje_venta * 1;

            if(costo == 0 && costo_servicio == 0)
            {
                $('#comision_venta_monto').val('0');
                comision_venta_monto = 0;
            }
            else if(porcentaje_venta > 100)
            {
                $('#porcentaje_venta').addClass('is-invalid')
                $('#porcentaje_venta_error').html('El porcentaje de comision no puede ser mayor a 100%.');
                $('#porcentaje_venta_error').fadeIn();
                $('#porcentaje_venta').val('0');
                $('#comision_venta_monto').val('0');
                porcentaje_venta = 0;
            }
            else if(porcentaje_venta == 0)
            {
                comision_venta_monto = 0;
                $('#comision_venta_monto').val('0');
            }
            else
            {
                if(margen == 0)
                {
                    comision_venta_monto = 0;
                    $('#comision_venta_monto').val('0');
                }
                else if(margen > 0)
                {
                    comision_venta_monto = Math.round(margen * (porcentaje_venta / 100));
                    $('#comision_venta_monto').val(comision_venta_monto);
                }
            }
            
        }

        //Comisión Operativa
        if(comision_operativa == '')
        {
            $('#comision_operativa_monto').val('0');
            $('#porcentaje_operativa').val('0');
         
            comision_operativa_monto = 0;
            porcentaje_operativa = 0;
        }
        else if(comision_operativa == 'Monto Fijo' || comision_operativa == 'Monto fijo')
        {
            comision_operativa_monto = comision_operativa_monto * 1;

            if(costo == 0 && costo_servicio == 0)
            {
                $('#porcentaje_operativa').val('0');
            }
            else if(comision_operativa_monto >= margen && costo > 0)
            {
                $('#comision_operativa_monto').addClass('is-invalid')
                $('#comision_operativa_monto_error').html('La comision no puede ser mayor o igual al margen residual del costo menos el costo Emporio.');
                $('#comision_operativa_monto_error').fadeIn();
                $('#comision_operativa_monto').val('0');
                $('#porcentaje_operativa').val('0');
                comision_operativa_monto = 0;
            }
            else if(comision_operativa_monto == 0)
            {
                $('#porcentaje_operativa').val('0');
                porcentaje_operativa = 0;
            }
            else if(comision_operativa_monto < margen)
            {
                porcentaje_operativa = Math.round(comision_operativa_monto / margen * 100);
                $('#porcentaje_operativa').val(porcentaje_operativa);
            }
        }
        else if(comision_operativa == 'Porcentaje' || comision_operativa == 'Porcentaje Utilidad')
        {
            porcentaje_operativa = porcentaje_operativa * 1;

            if(costo == 0 && costo_servicio == 0)
            {
                $('#comision_operativa_monto').val('0');
                comision_operativa_monto = 0;
            }
            else if(porcentaje_operativa > 100)
            {
                $('#porcentaje_operativa').addClass('is-invalid')
                $('#porcentaje_operativa_error').html('El porcentaje de comision no puede ser mayor a 100%.');
                $('#porcentaje_operativa_error').fadeIn();
                $('#porcentaje_operativa').val('0');
                $('#comision_operativa_monto').val('0');
                porcentaje_operativa = 0;
            }
            else if(porcentaje_operativa == 0)
            {
                comision_operativa_monto = 0;
                $('#comision_operativa_monto').val('0');
            }
            else
            {
                if(margen == 0)
                {
                    comision_operativa_monto = 0;
                    $('#comision_operativa_monto').val('0');
                }
                else if(margen > 0)
                {
                    comision_operativa_monto = Math.round(margen * (porcentaje_operativa / 100));
                    $('#comision_operativa_monto').val(comision_operativa_monto);
                }
            }
            
        }

        //Comisión Gestión
        if(comision_gestion == '')
        {
            $('#comision_gestion_monto').val('0');
            $('#porcentaje_gestion').val('0');
         
            comision_gestion_monto = 0;
            porcentaje_gestion = 0;
        }
        else if(comision_gestion == 'Monto Fijo' || comision_gestion == 'Monto fijo')
        {
            comision_gestion_monto = comision_gestion_monto * 1;

            if(costo == 0 && costo_servicio == 0)
            {
                $('#porcentaje_gestion').val('0');
            }
            else if(comision_gestion_monto >= margen && costo > 0)
            {
                $('#comision_gestion_monto').addClass('is-invalid')
                $('#comision_gestion_monto_error').html('La comision no puede ser mayor o igual al margen residual del costo menos el costo Emporio.');
                $('#comision_gestion_monto_error').fadeIn();
                $('#comision_gestion_monto').val('0');
                $('#porcentaje_gestion').val('0');
                comision_gestion_monto = 0;
            }
            else if(comision_gestion_monto == 0)
            {
                $('#porcentaje_gestion').val('0');
                porcentaje_gestion = 0;
            }
            else if(comision_gestion_monto < margen)
            {
                porcentaje_gestion = Math.round(comision_gestion_monto / margen * 100);
                $('#porcentaje_gestion').val(porcentaje_gestion);
            }
        }
        else if(comision_gestion == 'Porcentaje' || comision_gestion == 'Porcentaje Utilidad')
        {
            porcentaje_gestion = porcentaje_gestion * 1;

            if(costo == 0 && costo_servicio == 0)
            {
                $('#comision_gestion_monto').val('0');
                comision_gestion_monto = 0;
            }
            else if(porcentaje_gestion > 100)
            {
                $('#porcentaje_gestion').addClass('is-invalid')
                $('#porcentaje_gestion_error').html('El porcentaje de comision no puede ser mayor a 100%.');
                $('#porcentaje_gestion_error').fadeIn();
                $('#porcentaje_gestion').val('0');
                $('#comision_gestion_monto').val('0');
                porcentaje_gestion = 0;
            }
            else if(porcentaje_gestion == 0)
            {
                comision_gestion_monto = 0;
                $('#comision_gestion_monto').val('0');
            }
            else
            {
                if(margen == 0)
                {
                    comision_gestion_monto = 0;
                    $('#comision_gestion_monto').val('0');
                }
                else if(margen > 0)
                {
                    comision_gestion_monto = Math.round(margen * (porcentaje_gestion / 100));
                    $('#comision_gestion_monto').val(comision_gestion_monto);
                }
            }
            
        }

        $('#honorarios').val(margen);
        $('#honorarios_val').val(margen);
        comisiones = comision_venta_monto + comision_operativa_monto;
        
        utilidad = margen - comisiones;
        porcentaje_utilidad = (utilidad / margen) * 100;

        if(utilidad == 0)
        {
            porcentaje_utilidad = 0;
        }

        /*console.log(margen + ' ' + utilidad + ' ' + porcentaje_utilidad + ' ' + comision_venta_monto +
            ' ' + comision_operativa_monto +  ' ' + comision_gestion_monto);*/

        utilidad = Math.round(utilidad * 100) /100;
        $('#utilidad').val(utilidad);
        $('#utilidad_val').val(utilidad);

        porcentaje_utilidad = Math.round(porcentaje_utilidad *100) / 100;
        $('#porcentaje_utilidad').val(porcentaje_utilidad);
        $('#porcentaje_utilidad_val').val(porcentaje_utilidad);

        $('#validar').val('1');
        toastr.success('Quedaron validados las comisiones y montos');
    }

});

$('#btn-save').click(function()
{
    $('#btn-save').attr('disabled', 'disabled');
    id_catalogo_servicio = $('#id_catalogo_servicio').val();
    CatalogoServicio(id_catalogo_servicio);
});

function CatalogoServicio(id_catalogo_servicio)
{
    var token = $("#_token").val();

    clave = $('#clave').val();
    servicio = $('#servicio').val();
    comentarios = $('#comentarios').val();
    id_categoria_servicios = $('#id_categoria_servicios').val();
    //id_subcategoria = $('#id_subcategoria').val();
    id_categoria_bitacora = $('#id_categoria_bitacora').val();
    id_categoria_estatus = $('#id_categoria_estatus').val();
    concepto = $('#concepto').val();
    moneda = $('#moneda').val();
    costo_servicio = $('#costo_servicio').val();
    costo = $('#costo').val();
    comision_venta = $('#comision_venta').val();
    comision_venta_monto = $('#comision_venta_monto').val();
    porcentaje_venta = $('#porcentaje_venta').val();
    comision_operativa = $('#comision_operativa').val();
    comision_operativa_monto = $('#comision_operativa_monto').val();
    porcentaje_operativa = $('#porcentaje_operativa').val();
    comision_gestion = $('#comision_gestion').val();
    comision_gestion_monto = $('#comision_gestion_monto').val();
    porcentaje_gestion = $('#porcentaje_gestion').val();
    honorarios = $('#honorarios_val').val();
    utilidad = $('#utilidad_val').val();
    porcentaje_utilidad = $('#porcentaje_utilidad_val').val();
    validar = $('#validar').val();

    var formData = {
        clave, servicio, comentarios, id_categoria_servicios, /*id_subcategoria,*/ id_categoria_bitacora,
        id_categoria_estatus, concepto, moneda, costo_servicio, costo, comision_venta, comision_venta_monto,
        porcentaje_venta, comision_operativa, comision_operativa_monto, porcentaje_operativa, 
        comision_gestion, comision_gestion_monto, porcentaje_gestion, honorarios, utilidad,
        porcentaje_utilidad
    }

    //console.log(formData);

    if(validar == 0)
    {
        toastr.error('El cálculo de totales y comisiones aún no está validado');
        $('#btn-save').removeAttr('disabled');
    }
    else if(validar ==1)
    {
        if(id_catalogo_servicio == '')
        {
            var route = "/admin/servicios/store";

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
                    $('#btn-save').removeAttr('disabled');
                    toastr.success('Se agregó el servicio exitosamente');
                    route_location = '/admin/servicios/edit-requisito/' + data.id;
                    window.location.href = route_location;
                },
                error: function(data)
                {
                    console.log(data);
                    $('#btn-save').removeAttr('disabled');

                    if (data.responseJSON.errors.clave)
                    {
                        $("#clave_error").html(data.responseJSON.errors.clave);
                        $("#clave_error").fadeIn();
                        $('#clave').addClass('is-invalid');
                    }
                    else
                    {
                        $("#clave_error").fadeOut();
                        $('#clave').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.servicio)
                    {
                        $("#servicio_error").html(data.responseJSON.errors.servicio);
                        $("#servicio_error").fadeIn();
                        $('#servicio').addClass('is-invalid');
                    }
                    else
                    {
                        $("#servicio_error").fadeOut();
                        $('#servicio').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.costo)
                    {
                        $("#costo_error").html(data.responseJSON.errors.costo);
                        $("#costo_error").fadeIn();
                        $('#costo').addClass('is-invalid');
                    }
                    else
                    {
                        $("#costo_error").fadeOut();
                        $('#costo').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.costo_servicio)
                    {
                        $("#costo_servicio_error").html(data.responseJSON.errors.costo_servicio);
                        $("#costo_servicio_error").fadeIn();
                        $('#costo_servicio').addClass('is-invalid');
                    }
                    else
                    {
                        $("#costo_servicio_error").fadeOut();
                        $('#costo_servicio').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.comision_venta_monto)
                    {
                        $("#comision_venta_monto_error").html(data.responseJSON.errors.comision_venta_monto);
                        $("#comision_venta_monto_error").fadeIn();
                        $('#comision_venta_monto').addClass('is-invalid');
                    }
                    else
                    {
                        $("#comision_venta_monto_error").fadeOut();
                        $('#comision_venta_monto').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.comision_gestion_monto)
                    {
                        $("#comision_gestion_monto_error").html(data.responseJSON.errors.comision_gestion_monto);
                        $("#comision_gestion_monto_error").fadeIn();
                        $('#comision_gestion_monto').addClass('is-invalid');
                    }
                    else
                    {
                        $("#comision_gestion_monto_error").fadeOut();
                        $('#comision_gestion_monto').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.comision_operativa_monto)
                    {
                        $("#comision_operativa_monto_error").html(data.responseJSON.errors.comision_operativa_monto);
                        $("#comision_operativa_monto_error").fadeIn();
                        $('#comision_operativa_monto').addClass('is-invalid');
                    }
                    else
                    {
                        $("#comision_operativa_monto_error").fadeOut();
                        $('#comision_operativa_monto').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.id_categoria_bitacora)
                    {
                        $("#id_categoria_bitacora_error").html(data.responseJSON.errors.id_categoria_bitacora);
                        $("#id_categoria_bitacora_error").fadeIn();
                        $('#id_categoria_bitacora').addClass('is-invalid');
                    }
                    else
                    {
                        $("#id_categoria_bitacora_error").fadeOut();
                        $('#id_categoria_bitacora').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.id_categoria_servicios)
                    {
                        $("#id_categoria_servicios_error").html(data.responseJSON.errors.id_categoria_servicios);
                        $("#id_categoria_servicios_error").fadeIn();
                        $('#id_categoria_servicios').addClass('is-invalid');
                    }
                    else
                    {
                        $("#id_categoria_servicios_error").fadeOut();
                        $('#id_categoria_servicios').removeClass('is-invalid');
                    }



                    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

                    if (data.status == 422)
                    {
                        console.clear();
                    }
                }
            });
        }
        else if(id_catalogo_servicio > 0)
        {
            var route = "/admin/servicios/update/" + id_catalogo_servicio;

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
                    $('#btn-save').removeAttr('disabled');
                    toastr.success('Se actualizó el servicio: ' + data.clave);
                    //route_location = '/admin/servicios/edit-requisito/' + data.id;
                    //window.location.href = route_location;
                },
                error: function(data)
                {
                    console.log(data);
                    $('#btn-save').removeAttr('disabled');

                    if (data.responseJSON.errors.clave)
                    {
                        $("#clave_error").html(data.responseJSON.errors.clave);
                        $("#clave_error").fadeIn();
                        $('#clave').addClass('is-invalid');
                    }
                    else
                    {
                        $("#clave_error").fadeOut();
                        $('#clave').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.servicio)
                    {
                        $("#servicio_error").html(data.responseJSON.errors.servicio);
                        $("#servicio_error").fadeIn();
                        $('#servicio').addClass('is-invalid');
                    }
                    else
                    {
                        $("#servicio_error").fadeOut();
                        $('#servicio').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.costo)
                    {
                        $("#costo_error").html(data.responseJSON.errors.costo);
                        $("#costo_error").fadeIn();
                        $('#costo').addClass('is-invalid');
                    }
                    else
                    {
                        $("#costo_error").fadeOut();
                        $('#costo').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.costo_servicio)
                    {
                        $("#costo_servicio_error").html(data.responseJSON.errors.costo_servicio);
                        $("#costo_servicio_error").fadeIn();
                        $('#costo_servicio').addClass('is-invalid');
                    }
                    else
                    {
                        $("#costo_servicio_error").fadeOut();
                        $('#costo_servicio').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.comision_venta_monto)
                    {
                        $("#comision_venta_monto_error").html(data.responseJSON.errors.comision_venta_monto);
                        $("#comision_venta_monto_error").fadeIn();
                        $('#comision_venta_monto').addClass('is-invalid');
                    }
                    else
                    {
                        $("#comision_venta_monto_error").fadeOut();
                        $('#comision_venta_monto').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.comision_gestion_monto)
                    {
                        $("#comision_gestion_monto_error").html(data.responseJSON.errors.comision_gestion_monto);
                        $("#comision_gestion_monto_error").fadeIn();
                        $('#comision_gestion_monto').addClass('is-invalid');
                    }
                    else
                    {
                        $("#comision_gestion_monto_error").fadeOut();
                        $('#comision_gestion_monto').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.comision_operativa_monto)
                    {
                        $("#comision_operativa_monto_error").html(data.responseJSON.errors.comision_operativa_monto);
                        $("#comision_operativa_monto_error").fadeIn();
                        $('#comision_operativa_monto').addClass('is-invalid');
                    }
                    else
                    {
                        $("#comision_operativa_monto_error").fadeOut();
                        $('#comision_operativa_monto').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.id_categoria_bitacora)
                    {
                        $("#id_categoria_bitacora_error").html(data.responseJSON.errors.id_categoria_bitacora);
                        $("#id_categoria_bitacora_error").fadeIn();
                        $('#id_categoria_bitacora').addClass('is-invalid');
                    }
                    else
                    {
                        $("#id_categoria_bitacora_error").fadeOut();
                        $('#id_categoria_bitacora').removeClass('is-invalid');
                    }

                    if (data.responseJSON.errors.id_categoria_servicios)
                    {
                        $("#id_categoria_servicios_error").html(data.responseJSON.errors.id_categoria_servicios);
                        $("#id_categoria_servicios_error").fadeIn();
                        $('#id_categoria_servicios').addClass('is-invalid');
                    }
                    else
                    {
                        $("#id_categoria_servicios_error").fadeOut();
                        $('#id_categoria_servicios').removeClass('is-invalid');
                    }



                    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

                    if (data.status == 422)
                    {
                        console.clear();
                    }
                }
            });
        }
    }
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
        title: '¿Desea inactivar el servicio?',
        content: '',
        autoClose: 'Cancelar|5000',
        buttons: 
        {
            Cancelar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Inactivar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/servicios/destroy/' + id;

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
                            toastr.info('Se inactivó el servicio.');

                            ActualizarRegistro(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo inactivar el servicio.');
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
    estatus = 1;
    formData =
    {
        estatus
    }
    $.confirm(
    {
        title: '¿Desea activar el servicio?',
        content: '',
        autoClose: 'Cancelar|5000',
        buttons: 
        {
            Cancelar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Activar',
                btnClass: 'btn-green any-other-class',
                action: function () 
                {
                    router = '/admin/servicios/destroy/' + id;

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
                            toastr.info('Se activó el servicio.');

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

$("#btn-cancelar").click(function()
{
    CancelarServicio();
});

$("#btn-activar").click(function()
{
    ActivarServicio();
});

function ActivarServicio()
{
    var id = $("#id_activar").val();
    var route = "/admin/servicios/" + id;
    var token = $("#_token").val();
    var formData = {
        id: $('input[name=id_activar]').val(),
        estatus: $('input[name=estatus_activar]').val(),
    }

    //console.log(formData);

    $.ajax(
    {
        url: route,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'DELETE',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se activó el registro exitosamente');
            Listar();

            $("#activar-modal").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);

            toastr.error('No se pudo activar el registro.');

            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
}

function CancelarServicio()
{
    var id = $("#id_cancelar").val();
    var route = "/admin/servicios/" + id;
    var token = $("#_token").val();
    var formData = {
        id: $('input[name=id_cancelar]').val(),
        estatus: $('input[name=estatus_cancelar]').val(),
    }

    //console.log(formData);

    $.ajax(
    {
        url: route,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'DELETE',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se canceló el registro exitosamente');
            Listar();

            $("#cancelar-modal").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);

            toastr.error('No se pudo cancelar el registro.');

            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
}

var Detalles = function(id)
{
    //BorrarFormualario();
    //QuitarErrores();

    var router = "/admin/servicios/show/" + id;

    $.get(router, function(data)
    {
        //console.log(data);

        $('#id_servicio').val(data.id);
        $(".modal-title").html(data.clave + ' - ' + data.servicio);
        $('#comentarios').val(data.comentarios);
        $('#det_categoria').val(data.id_categoria_servicios).change();
        $('#det_bitacora').val(data.id_categoria_bitacora).change();
        $('#det_bit_estatus').val(data.id_categoria_estatus).change();
        $('#det_concepto').val(data.concepto).change();
        $('#det_moneda').val(data.moneda).change();
        $('#det_costo_servicio').val(data.costo_servicio);
        $('#det_costo').val(data.costo);
        $('#det_comision_venta').val(data.comision_venta).change();
        $('#det_comision_operativa').val(data.comision_operativa).change();
        $('#det_comision_gestion').val(data.comision_gestion).change();
        $('#det_comision_gestion_monto').val(data.comision_gestion_monto);
        $('#det_comision_venta_monto').val(data.comision_venta_monto);
        $('#det_comision_operativa_monto').val(data.comision_operativa_monto);
        $('#det_procedimiento').html(data.procedimiento);

        if (data.comision_venta == 'Dolares' || data.comision_venta == 'Monto Fijo')
        {
            $('#det_span_venta').addClass('fas fa-dollar-sign');
        }
        else if (data.comision_venta == 'Porcentaje Utilidad' || data.comision_venta == 'Porcentaje')
        {
            $('#det_span_venta').addClass('fas fa-percent');
        }

        if (data.comision_operativa == 'Dolares' || data.comision_operativa == 'Monto Fijo')
        {
            $('#det_span_operativo').addClass('fas fa-dollar-sign');
        }
        else if (data.comision_operativa == 'Porcentaje Utilidad' || data.comision_operativa == 'Porcentaje')
        {
            $('#det_span_operativo').addClass('fas fa-percent');
        }

        if (data.comision_gestion == 'Dolares' || data.comision_gestion == 'Monto Fijo')
        {
            $('#det_span_gestion').addClass('fas fa-dollar-sign');
        }
        else if (data.comision_gestion == 'Porcentaje Utilidad' || data.comision_gestion == 'Porcentaje')
        {
            $('#det_span_gestion').addClass('fas fa-percent');
        }

        if (data.estatus == 1)
        {
            $("#det_estatus").val("1").change();
            $('#det_estatus').prop('checked', true);
        }
        else if (data.estatus == 0)
        {
            $("#det_estatus").val("0").change();
            $('#det_estatus').prop('checked', false);
        }
    });
}

var BorrarFormualario = function()
{
    $("#clave").val("");
    $("#servicio").val("");
    $("#comentarios").val("");
    $("#comentarios").val("");
    $("#id_categoria_servicios").val("").change();
    $("#id_categoria_bitacora").val("").change();
    $("#id_categoria_estatus").val("").change();
    $("#concepto_costo").val("Neto").change();
    $("#moneda").val("MXN").change();
    $("#costo").val("0.00");
    $("#costo_servicio").val("0.00");
    $("#comision_venta").val("").change();
    $("#comision_gestion").val("").change();
    $("#comision_operativa").val("").change();
    $("#comision_venta_monto").val("0.00");
    $("#comision_gestion_monto").val("0.00");
    $("#comision_operativa_monto").val("0.00");
    $("#porcentaje_venta").val("0");
    $("#porcentaje_operativa").val("0");
    $("#porcentaje_gestion").val("0");
    $("#estatus").val("1");
    $('#estatus').prop('checked', true);
    $("#estatus_check").val("1");
    $("#editor1").val("");
    $("#created_at").val("");
    $("#updated_at").val("");
    $("#span_venta").removeClass();
    $("#span_operativo").removeClass();
    $("#span_gestion").removeClass();

}

var QuitarErrores = function()
{
    $("#clave_error").fadeOut();
    $("#clave").removeClass('is-invalid');
    $("#servicio_error").fadeOut();
    $("#servicio").removeClass('is-invalid');
    $("#id_categoria_servicios_error").fadeOut();
    $("#id_categoria_servicios").removeClass('is-invalid');
    $("#id_categoria_bitacora_error").fadeOut();
    $("#id_categoria_bitacora").removeClass('is-invalid');
    $("#id_categoria_estatus_error").fadeOut();
    $("#id_categoria_estatus").removeClass('is-invalid');
    $("#costo_servicio_error").fadeOut();
    $("#costo_servicio").removeClass('is-invalid');
    $("#costo_error").fadeOut();
    $("#costo").removeClass('is-invalid');
    $("#comision_venta_monto_error").fadeOut();
    $("#comision_venta_monto").removeClass('is-invalid');
    $("#comision_operativa_monto_error").fadeOut();
    $("#comision_operativa_monto").removeClass('is-invalid');
    $("#comision_gestion_monto_error").fadeOut();
    $("#comision_gestion_monto").removeClass('is-invalid');
    $("#porcentaje_venta_error").fadeOut();
    $("#porcentaje_venta").removeClass('is-invalid');
    $("#porcentaje_operativa_error").fadeOut();
    $("#porcentaje_operativa").removeClass('is-invalid');
    $("#porcentaje_gestion_error").fadeOut();
    $("#porcentaje_gestion").removeClass('is-invalid');
}





















