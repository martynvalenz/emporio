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

$("#estatus_todo").click(function()
{
    $("#variable_estatus").val("todas");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-primary");
    $("#label-estatus").html("Todas");
    setTimeout(Listar, 300);
});

$("#estatus_pendiente").click(function()
{
    $("#variable_estatus").val("Pendiente");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-warning");
    $("#label-estatus").html("Pendientes");
    setTimeout(Listar, 300);
    
});

$("#estatus_pagado").click(function()
{
    $("#variable_estatus").val("Pagado");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-success");
    $("#label-estatus").html("Pagados");
    setTimeout(Listar, 300);
});

$("#estatus_cancelado").click(function()
{
    $("#variable_estatus").val("Cancelado");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-danger");
    $("#label-estatus").html("Cancelados");
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
$(".btn-cerrar-actualizar").on("click", function(e)
{
    $('#menu').hide();
    e.preventDefault();
    Listar();
    BorrarFactura();
    QuitarErroresFactura();
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
    var estatus;
    var buscar;
    estatus = $("#variable_estatus").val();
    buscar = $("#buscar").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();

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

$(".btn-detalle").on('click', function(e)
{
    //e.preventDevault();
    var id_factura = $(this).data('id');
    var path = $(this).data('path');
    var token = $(this).data('token');
    var modal_body = $(".modal-body");
    var loading = '<p>' +
        '<i class="fas fa-spinner fa-spin"></i> Cargando datos' +
        '</p>';
    var table = $("#table-detalle tbody");
    var data = {
        '_token': token,
        'id': id_factura
    }
    //modal_title.html('Detalle del Pedido: ' + parseFloat(id_pedido).toFixed(2));
    table.html(loading);
    console.log(data);
    $.post(
        path,
        data,
        function(data)
        {
            //console.log(response);
            table.html("");
            for (var i = 0; i < data.length; i++)
            {
                var fila = '<tr style="font-size: 16px">';
                fila += '<td style="width:80%;" valign="left">' + data[i].clave + ' ' + data[i].servicio +
                    ' ' + data[i].tramite + ' ' + data[i].clase + '</td>';
                fila += '<td style="width:20%;" valign="middle" align="right">' + parseFloat(data[i].monto)
                    .toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() + '</td>';
                fila += '</tr>';
                table.append(fila);
                //console.log(fila);
            }
        },
        'json'
    );
});

//Agregar Razon Social
$(".cerrar-razon").click(function()
{
    $("#agregar_razon").modal('toggle');
});

$("#btn_agregar_razon").on('click', function()
{
    id_cliente = $('#id_cliente').val();

    if (id_cliente == '')
    {
        $('#id_cliente_error').html('Seleccione primero un cliente.');
        $('#id_cliente_error').fadeIn();
    }
    else
    {
    	 $('#id_cliente_error').fadeOut();
    	 $('#agregar_razon').modal('toggle');
    }
});

$("#agregar_razon").on("hidden.bs.modal", function()
{
    $("#razon_social_razon").val("");
    $("#razon_social_razon_error").fadeOut();
    $("#rfc_razon").val("");
    $("#rfc_razon_error").fadeOut();

    id_factura = $('#id_factura').val();

    if(id_factura == '')
    {
        id_cliente = $('#id_cliente').val();

        $.get('/admin/procesos/cargarRazonSocial/' + id_cliente, function(data)
        {
            //console.log(data);
            $('#id_razon_social').empty();
            $.each(data, function(index, subcatObj)
            {
                $('#id_razon_social').append('<option value ="' + subcatObj.id + '">' + subcatObj.razon_social +
                    ' | ' + subcatObj.rfc + '</option>');
            });
        });
    }
    else
    {
        //Edit(id_factura);
    }
});

$("#btn_razon").click(function()
{
    var route = "/admin/procesos/razon-social";
    var token = $('#_token').val();
    id_cliente = $('#id_cliente').val();
    //console.log(token);
    var formData = {
        razon_social: $('#razon_social_razon').val(),
        rfc: $('#rfc_razon').val(),
        id_cliente,
        id_admin: $('#id_admin').val()
    }
    //console.log(formData);
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
            $('#agregar_razon').modal('toggle');
            toastr.success('Se agregó la razón social exitosamente');
            $.get('/admin/procesos/cargarRazonSocial/' + id_cliente, function(data)
            {
                //console.log(data);
                $('#id_razon_social').empty();
                $.each(data, function(index, subcatObj)
                {
                    $('#id_razon_social').append('<option value ="' + subcatObj.id + '">' + subcatObj.razon_social +
                        ' | ' + subcatObj.rfc + '</option>');
                });
            });

        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.razon_social)
            {
                $("#razon_social_razon_error").html(data.responseJSON.errors.razon_social);
                $("#razon_social_razon_error").fadeIn();
            }
            else
            {
                $("#razon_social_razon_error").fadeOut();
            }
            if (data.responseJSON.errors.rfc)
            {
                $("#rfc_razon_error").html(data.responseJSON.errors.rfc);
                $("#rfc_razon_error").fadeIn();
            }
            else
            {
                $("#rfc_razon_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
});


function Create()
{
	QuitarErroresFactura();
	BorrarFactura();
	$("#modal-title").html("Agregar Factura");
	$('#modal-header').css(
	{
	    'background-color': '#218CBF'
	});
    $('#btn_factura').removeClass();
	$('#btn_factura').html('<span class="glyphicon glyphicon-floppy-disk"></span> Agregar');
	$('#btn_factura').addClass('btn btn-primary btn-flat');

    $('#servicios-facturados').empty();
    $('#servicios-pendientes').empty();
}

function Edit(id_factura)
{
    QuitarErroresFactura();
    $('#id_razon_social').empty();

    var route = "/admin/factura-edit/" + id_factura;

    $.get(route, function(data)
    {
        $('#apagar_cliente').val(data.id);
        $("#modal-title").html("Editar Factura:" + data.folio_factura);
        $('#modal-header').css(
        {
            'background-color': '#FE9800'
        });
        $('#btn_factura').removeClass();
        $('#btn_factura').html('<span class="glyphicon glyphicon-floppy-disk"></span> Actualizar');
        $('#btn_factura').addClass('btn btn-warning btn-flat');

        cargarServiciosFacturados(id_factura);
        cargarDatosFactura(id_factura);
        cargarServiciosPendientes(data.id_cliente, id_factura);
        $('#id_cliente').val(data.id_cliente).change();
        $('#id_cliente_val').val(data.id_cliente);
        $('#folio_factura').val(data.folio_factura);
        $('#comentarios').val(data.comentarios);
        $('#porcentaje_iva').val(data.porcentaje_iva);
        $('#fecha').val(data.fecha);
        $('#id_factura').val(data.id);



        /*$.get('/admin/procesos/cargarRazonSocial/' + data.id_cliente, function(data)
        {
            //console.log(data);
            
            $.each(data, function(index, subcatObj)
            {
                $('#id_razon_social').append('<option value ="' + subcatObj.id + '">' + subcatObj.razon_social +
                    ' | ' + subcatObj.rfc + '</option>');
            });
        });*/
        if(data.id_razon_social == null)
        {
            $('#id_razon_social').empty();
        }
        else
        {
            $('#id_razon_social').empty();
            $('#id_razon_social').append('<option value ="' + data.id_razon_social + '" selected>' + data.razon_social +
                    ' | ' + data.rfc + '</option><option>-------------------------------------</option>');
        }
        

        $('#apagar_cliente').val('');

    });
}

function Detalles(id_factura)
{
    $('#id_factura_detalles').val(id_factura);

    $.ajax(
    {
        type: 'get',
        url: '/admin/facturas/serviciosFacturados/' + id_factura,
        success: function(data)
        {
            $('#listado-detalles-table').empty().html(data);
            $(".tooltip").tooltip("hide");
            $('.btn-quitar-factura').attr('disabled', 'disabled');
            $('.btn-quitar-factura').removeAttr('title');
        }
    });

    if (id_factura == '')
    {
        $("#subtotal_detalles").html('0.00');
        $("#iva_detalles").html('0.00');
        $("#total_detalles").html('0.00');
    }
    else
    {
        var route = "/admin/procesos/cargarDatosFactura/" + id_factura;
        $.get(route, function(data)
        {
            //$("#porcentaje_iva_detalles").val(data.porcentaje_iva);
            $("#subtotal_detalles").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#iva_detalles").html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#total_detalles").html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
        });
    }

    var router = "/admin/factura-edit/" + id_factura;

    $.get(router, function(data)
    {
        $('.modal-title').html('Detalles de factura: ' + data.folio_factura);
    });
}

$('#id_cliente').on('change', function()
{
    var id_cliente = $(this).val();
    var apagar_cliente = $('#apagar_cliente').val();

    if(id_cliente == '')
    {
        $('#id_razon_social').empty();
        $('#id_categoria').append('<option value ="">-Sin opción-</option>');
    }
    else if(apagar_cliente > 0)
    {
        //ajax
        $.get('/admin/procesos/cargarRazonSocial/' + id_cliente, function(data)
        {
            
            $.each(data, function(index, subcatObj)
            {
                $('#id_razon_social').append('<option value ="' + subcatObj.id + '">' + subcatObj.razon_social +
                    ' | ' + subcatObj.rfc + '</option>');
            });
        });
    }
    else if(apagar_cliente == 0 || apagar_cliente == '')
    {
        //ajax
        $.get('/admin/procesos/cargarRazonSocial/' + id_cliente, function(data)
        {
            //console.log(data);
            $('#id_razon_social').empty();
            $.each(data, function(index, subcatObj)
            {
                $('#id_razon_social').append('<option value ="' + subcatObj.id + '">' + subcatObj.razon_social +
                    ' | ' + subcatObj.rfc + '</option>');
            });
        });
    }
});

function cargarDatosFactura(id_factura)
{
    if (id_factura == '')
    {
        $("#subtotal_factura").html('0.00');
        $("#subtotal_final_factura").val("0");
        $("#iva_factura").html('0.00');
        $("#iva_final_factura").val("0");
        $("#total_factura").html('0.00');
        $("#total_final_factura").val("0");
        $("#pagado_factura").val("0");
        $("#saldo_factura").val("0");
        $('#fecha').datepicker().datepicker('setDate', 'today');
    }
    else
    {
        var route = "/admin/procesos/cargarDatosFactura/" + id_factura;
        $.get(route, function(data)
        {
            //$("#porcentaje_iva_factura").val(data.porcentaje_iva);
            $("#subtotal_factura").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#subtotal_final_factura").val(data.subtotal);
            $("#iva_factura").html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#iva_final_factura").val(data.iva);
            $("#total_factura").html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#total_final_factura").val(data.total);
            $("#pagado_factura").val(data.pagado);
            $("#saldo_factura").val(data.saldo);
            fecha = data.fecha;
            if (data.fecha == null)
            {
                $('#fecha_factura').datepicker().datepicker('setDate', 'today');
            }
            else
            {
                $("#fecha_factura").val(data.fecha);
            }
        });
    }
}

function cargarDetallesFactura(id_factura)
{
    if(id_factura == '')
    {

    }
    else
    {
    	$.ajax(
    	{
    	    type: 'get',
    	    url: '/admin/procesos/cargarDetalles/' + id_factura,
    	    success: function(data)
    	    {
    	        $('#servicios-facturados').empty().html(data);
    	    }
    	});
    }
}

function cargarServiciosPendientes(id_cliente, id_factura)
{
    if(id_cliente == '' || id_factura == '')
    {
        $('#servicios-pendientes').empty();
    }
    else
    {
        $.ajax(
        {
            type: 'get',
            url: '/admin/facturas/serviciosPendientes/' + id_cliente,
            success: function(data)
            {
                $('#servicios-pendientes').empty().html(data);
                $(".tooltip").tooltip("hide");
            }
        });
    }
}

function cargarServiciosFacturados(id_factura)
{
    if(id_factura == '')
    {
        $('#servicios-facturados').empty();
    }
    else
    {
        $.ajax(
        {
            type: 'get',
            url: '/admin/facturas/serviciosFacturados/' + id_factura,
            success: function(data)
            {
                $('#servicios-facturados').empty().html(data);
                $(".tooltip").tooltip("hide");
                $('.btn-quitar-factura').removeAttr('disabled');
                $('.btn-quitar-factura').removeAttr('title');
                $('.btn-quitar-factura').attr('title', 'Quitar servicio');
            }
        });
    }
}

$('#btn_factura').click(function()
{
	id_factura = $('#id_factura').val();

	if(id_factura == '')
	{
		Agregar();
	}
	else if(id_factura > 0 || id_factura != '')
	{
		Actualizar(id_factura);
	}
});

function Agregar()
{
    var route = "/admin/procesos/crear-factura";
    var token = $('#_token').val();
    var id_cliente = $('#id_cliente').val();
    //console.log(token);
    var formData = {
        folio_factura: $('#folio_factura').val(),
        fecha: $('#fecha').val(),
        porcentaje_iva: $('#porcentaje_iva').val(),
        id_cliente,
        id_razon_social: $('#id_razon_social').val(),
        id_admin: $('#id_admin').val()
    }
    //console.log(formData);
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
            toastr.success('Se agregó la factura exitosamente');
            $('#id_factura').val(data.id)
            cargarServiciosPendientes(id_cliente, data.id);
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.folio_factura)
            {
                $("#folio_factura_error").html(data.responseJSON.errors.folio_factura);
                $("#folio_factura_error").fadeIn();
            }
            else
            {
                $("#folio_factura_error").fadeOut();
            }
            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_error").html(data.responseJSON.errors.fecha);
                $("#fecha_error").fadeIn();
            }
            else
            {
                $("#fecha_error").fadeOut();
            }
            if (data.responseJSON.errors.id_cliente)
            {
                $("#id_cliente_error").html(data.responseJSON.errors.id_cliente);
                $("#id_cliente_error").fadeIn();
            }
            else
            {
                $("#id_cliente_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
}

function Actualizar(id_factura)
{

}


function QuitarErroresFactura()
{
	$('#id_cliente_error').fadeOut();
	$('#fecha_error').fadeOut();
	$('#folio_factura_error').fadeOut();
}

function BorrarFactura()
{
	$('#id_cliente').val('').change();
	$('#id_razon_social').empty();
	$('#folio_factura').val('');
	$('#comentarios').val('');
	$('#fecha').datepicker().datepicker('setDate', 'today');
}

$("#factura-modal").on("hidden.bs.modal", function()
{
    $('#apagar_cliente').val('');
    $('#id_razon_social').empty();
});

$(document).on('click','.btn-insertar-factura-recibo', function()
{
    iva = $('#iva_final_factura').val();
    id_factura = $('#id_factura').val();
    porcentaje_iva = $('#porcentaje_iva').val();
    subtotal = $('#subtotal_final_factura').val();
    total = $('#total_final_factura').val();
    pagado = $('#pagado_factura').val();
    saldo = $('#saldo_factura').val();

    var cells = $(this).closest("tr").children("td");
    var id_servicio = cells.eq(0).text();
    var monto = cells.eq(6).text();
    var monto_max = cells.eq(7).text();
    var costo = cells.eq(8).text();
    var facturado = cells.eq(9).text();

    monto = monto * 1;
    monto_max = monto_max * 1;
    costo = costo * 1;
    facturado = facturado * 1;

    restante = costo - (facturado + monto);
    facturado = (facturado + monto);

    if(restante == 0)
    {
        facturado_terminado = 1;
    }
    else if(restante > 0)
    {
        facturado_terminado = 0;
    }

    if(monto > monto_max)
    {
        toastr.error('El monto no puede ser mayor a: ' + monto_max);
        cargarDetallesFactura(id_factura);
    }
    else
    {
        agregarFacturaRecibo(id_factura, iva, porcentaje_iva, subtotal, total, pagado, saldo, id_servicio,
            monto, costo, facturado, monto_max, restante, );
    }
});


//Agregar factura o servicio al cobro
function agregarFacturaRecibo(id_factura, iva, porcentaje_iva, subtotal, total, pagado, saldo, id_servicio,
            monto, costo, facturado, monto_max, restante, )
{
    token = $('#_token').val();

    var formData = 
    {
        id_factura, iva, porcentaje_iva, subtotal, total, pagado, saldo, id_servicio,
            monto, costo, facturado, monto_max, restante, facturado_terminado 
    }
    console.log(formData);
    $.ajax(
    {
        url: '/admin/facturas/insertar-detalle/' + id_factura,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se agregó el servicio a la factura/recibo.');
            cargarServiciosFacturados(data.id);
            cargarServiciosPendientes(data.id_cliente, data.id);

            $('#iva_final_factura').val(data.iva);
            $('#porcentaje_iva').val(data.porcentaje_iva);
            $('#subtotal_final_factura').val(data.subtotal);
            $('#total_final_factura').val(data.total);
            $('#pagado_factura').val(data.pagado);
            $('#saldo_factura').val(data.saldo);

            $("#subtotal_factura").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#iva_factura").html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#total_factura").html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
        }
    });
}





















