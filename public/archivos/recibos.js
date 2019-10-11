$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function Recibos()
{
    ListarRecibos();
}

$('#recibos_select').on('change', function()
{   
    setTimeout(ListarRecibos, 300);
}); 

$("#btn-borrar-recibo").click(function()
{
    //ResetearFecha();
    $('#buscar-recibo').val('');
    setTimeout(ListarRecibos, 300);
});

$("#btn-buscar-recibo").on("click", function(e)
{
    e.preventDefault();
    ListarRecibos();
});

$('#buscar-recibo').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        ListarRecibos();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});
$(document).on("click", ".pagination-recibos .pagination li a", function(e)
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

function ListarRecibos()
{
    var estatus = $("#recibos_select").val();
    var buscar = $("#buscar-recibo").val();
    var url_listar = $('#url_listar_recibos').val();
    var url_buscar = $('#url_buscar_recibos').val();

    FechaRango = document.getElementById('reservation_recibo').value.split('  -  ');
    fecha_inicio = FechaRango[0];
    fecha_fin = FechaRango[1];

    if(fecha_inicio == null)
    {
        $('#reservation_recibo_error').html('La fecha inicial no puede estar vacía');
        $('#reservation_recibo_error').fadeIn();
        ResetearFechaRecibo();
    }
    else if(fecha_fin == null)
    {
        $('#reservation_recibo_error').html('La fecha final no puede estar vacía');
        $('#reservation_recibo_error').fadeIn();
        ResetearFechaRecibo();
    }
    else if(fecha_inicio > fecha_fin)
    {
        $('#reservation_recibo_error').html('La fecha inicial no puede ser mayor a la fecha final');
        $('#reservation_recibo_error').fadeIn();
        ResetearFechaRecibo();
    }
    else
    {
    	if (buscar == '')
    	{
    	    
    	    $.ajax(
    	    {
    	        type: 'get',
    	        url: url_listar + estatus + '/' + fecha_inicio + '/' + fecha_fin,
    	        success: function(data)
    	        {
    	            $('#listado-recibos').empty().html(data);
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
    	        url: url_buscar + estatus + '/' + buscar + 
                '/' + fecha_inicio + '/' + fecha_fin,
    	        success: function(data)
    	        {
    	            $('#listado-recibos').empty().html(data);
    	            $(".tooltip").tooltip("hide");
    	            $(function()
    	            {
    	                $('#example1').stickyTableHeaders();
    	            });
    	        }
    	    });
    	}
    }
}

function ResetearFechaRecibo()
{
    fecha_inicio = $('#fecha_inicio_reset_recibo').val();
    fecha_fin = $('#fecha_fin_reset_recibo').val();
    $('#reservation_recibo').val(fecha_inicio + '  -  ' + fecha_fin);
}

function ReciboNuevo(id_recibo)
{
    url_nuevo = $('#url_actualizar_recibos').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_nuevo + id_recibo,
        success: function(data)
        {
            $('#list-recibo').append(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });
}

function ActualizarRecibo(id_recibo)
{
	url_actualizar = $('#url_actualizar_recibos').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_actualizar + id_recibo,
	    success: function(data)
	    {
	        $('#recibo-' + id_recibo).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	    }
	});
}

$('#porcentaje_iva_recibo_check').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#porcentaje_iva_recibo_check_val").val(this.value);
}).change();

function cargarClientesRecibo()
{
    accion = $('#accion_recibo').val();

    if(accion == 'Create')
    {
        var route = "/admin/procesos/servicios/cargar_clientes";
        $.get(route, function(data)
        {
            $('#id_cliente_recibo').empty();
            $('#id_cliente_recibo').append('<option value ="">-Seleccionar cliente-</option>');
            $.each(data, function(index, item)
            {
                $('#id_cliente_recibo').append('<option value ="' + item.id + '">' + item.nombre_comercial +
                    '</option>');
            });
            $('#id_cliente_recibo').selectpicker('refresh');
        });
    }
    else if(accion == 'Edit')
    {
        //
    }
}

$('#id_cliente_recibo').change(function()
{
    $('#id_cliente_recibo_error').fadeOut();
    id_cliente = $(this).val();
    id_recibo = $('#id_recibo').val();
    $('#id_cliente_recibo_val').val(id_cliente);
    if(id_cliente == '')
    {
        $('#servicios-pendientes-facturar').empty();
    }
    else if(id_recibo == '')
    {
        MostrarServiciosPendientesRecibos(id_cliente, 0);
        CargarRazonesRecibos(id_cliente);
    }
    else
    {
        MostrarServiciosPendientesRecibos(id_cliente, id_recibo);
        CargarRazonesRecibos(id_cliente);
    }
});

function MostrarServiciosPendientesRecibos(id_cliente, id_recibo)
{
    estatus = $('#estatus_recibo').val();
    route = '/admin/recibos/servicios-cliente/' + id_cliente + '/' + id_recibo + '/' + estatus;

    $.ajax(
    {
        type: 'get',
        url: route,
        success: function(data)
        {
            $('#servicios-pendientes-recibo').empty().html(data);
            $(".tooltip").tooltip("hide");

            if(estatus == 'Pendiente')
            {
                $('.checkbox_servicio_recibo_div').show();
                $('.checkbox_servicio_recibo_pagado').hide();
            }
            else if(estatus == 'Pagado')
            {
                $('.checkbox_servicio_recibo_div').hide();
                $('.checkbox_servicio_recibo_pagado').show();
            }
        }
    });
}

function CargarRazonesRecibos(id_cliente)
{
    route = '/admin/facturas/get-razones/' + id_cliente;
    accion = $('#accion_recibo').val();

    if(accion == 'Create')
    {
        $.get(route, function(data)
        {
            if(data == '')
            {
                $('#id_razon_social_recibo').empty();
                $('#id_razon_social_recibo').append('<option value="" selected>-Sin selección-</option>');
            }
            else
            {
                $('#id_razon_social_recibo').empty();
                $('#id_razon_social_recibo').append('<option value="" selected>-Sin selección-</option>');
                $.each(data, function(index, item)
                {
                    $('#id_razon_social_recibo').append('<option value="'+item.id+'">'+item.razon_social+
                        '|' + item.rfc + '</option>');
                });
            }
            
        }); 
    }
    else if(accion == 'Edit')
    {

        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#id_razon_social_recibo').append('<option value="'+item.id+'">'+item.razon_social+
                    '|' + item.rfc + '</option>');
            });
        }); 
    }
}

function ActualizarTotalesRecibo(id_recibo)
{
    route = '/admin/facturas-actualizar-totales/' + id_recibo;

    $.get(route, function(data)
    {
        $("#subtotal_recibo").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#iva_recibo').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#total_recibo').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#subtotal_final_recibo').val(data.subtotal);
        $('#iva_final_recibo').val(data.iva);
        $('#total_final_recibo').val(data.total);
        $('#pagado_recibo').val(data.pagado);
        $('#saldo_recibo').val(data.saldo);
    });
}

function CreateRecibo()
{
    BorrarRecibo();
    QuitarErroresRecibo();
    $(".modal-title").html("Agregar Recibo");
    $('.modal-header').css(
    {
        'background-color': '#348FE2'
    });
    $('#btn-save-recibo').val('Generar Recibo <span class="fas fa-save"></span>');
    $('#fecha_recibo').datepicker().datepicker('setDate', 'today');
    //$('#id_cliente_recibo_text').attr('hidden', true);
    $('#id_cliente_recibo_select').removeAttr('hidden');
    $('#id_cliente_recibo_div').attr('hidden', 'hidden');
    cargarClientesRecibo();
    $('#estatus_recibo').val('Pendiente');
}

function EditRecibo(id, estatus)
{
    $('#accion_recibo').val('Edit');
    QuitarErroresRecibo();
    $('#id_recibo').val(id);
    $('#id_cliente_recibo').empty();
    $('#estatus_recibo').val(estatus);
    $('#btn-save-recibo').val('Guardar <span class="fas fa-save"></span>');

    route = '/admin/factura-edit/' + id;

    $.get(route, function(data)
    {
        //console.log(data);
        $(".modal-title").html("Editar Recibo: " + data.folio_recibo);
        $('.modal-header').css(
        {
            'background-color': '#49B6D6'
        });

        $('#id_cliente_recibo_val').val(data.id_cliente);
        $('#id_cliente_recibo').append('<option value ="' + data.id_cliente + '">' + data.nombre_comercial +
                    '</option><option value ="">-----------------------------</option>');
        $('#id_cliente_recibo_text').val(data.nombre_comercial);

        if(data.id_razon_social == null)
        {
            $('#id_razon_social_recibo').empty();
            $('#id_razon_social_recibo').append('<option value="">-Sin razón social-</option>');
        }
        else
        {
            $('#id_razon_social_recibo').empty();
            $('#id_razon_social_recibo').append('<option value="'+data.id_razon_social+'" selected>'
                +data.razon_social+ '|' + data.rfc + '</option>');
            $('#id_razon_social_recibo').append('<option value="">----------------------------</option>');
        }

        if(data.con_iva == 1)
        {
            $('#porcentaje_iva_recibo_check_val').val('1');
            $('#porcentaje_iva_recibo_check').prop('checked',true);
        }
        else if(data.con_iva == 0)
        {
            $('#porcentaje_iva_recibo_check_val').val('0');
            $('#porcentaje_iva_recibo_check').prop('checked', false);
        }

        $('#fecha_recibo').val(data.fecha);
        $('#folio_recibo').val(data.folio_recibo);
        $('#comentarios_recibo').val(data.comentarios);
        $("#subtotal_recibo").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#iva_recibo').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#total_recibo').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#subtotal_final_recibo').val(data.subtotal);
        $('#iva_final_recibo').val(data.iva);
        $('#total_final_recibo').val(data.total);
        $('#pagado_recibo').val(data.pagado);
        $('#saldo_recibo').val(data.saldo);
        $('#detalles_recibo').val(data.detalles);

        MostrarServiciosPendientesRecibos(data.id_cliente, id);
        CargarRazonesRecibos(data.id_cliente);
        //MostrarServiciosFacturados(id);

        detalles = data.detalles * 1;

        if(detalles > 0)
        {
            $('#id_cliente_recibo_select').attr('hidden', 'hidden');
            $('#id_cliente_recibo_div').removeAttr('hidden');
        }
        else if(detalles == 0)
        {
            //$('#id_cliente_recibo_text').attr('hidden', true);
            $('#id_cliente_recibo_select').removeAttr('hidden');
            $('#id_cliente_recibo_div').attr('hidden', 'hidden');

            var route = "/admin/procesos/servicios/cargar_clientes";
            $.get(route, function(data)
            {
                $.each(data, function(index, item)
                {
                    $('#id_cliente_recibo').append('<option value ="' + item.id + '">' + item.nombre_comercial +
                        '</option>');
                });
                $('#id_cliente_recibo').selectpicker('refresh');
            });
        }
    });

    $('#accion_recibo').val('Create');
}

$('#btn-save-recibo').click(function()
{
    $('#btn-save-recibo').attr('disabled', 'disabled');
    token = $('#_token').val();
    id_recibo = $('#id_recibo').val();
    id_cliente = $('#id_cliente_recibo_val').val();
    id_admin = $('#id_admin').val();
    fecha = $('#fecha_recibo').val();
    id_razon_social = $('#id_razon_social_recibo').val();
    folio_recibo = $('#folio_recibo').val();
    comentarios = $('#comentarios_recibo').val();
    subtotal = $('#subtotal_final_recibo').val();
    iva = $('#iva_final_recibo').val();
    porcentaje_iva = $('#porcentaje_iva_recibo').val();
    total = $('#total_final_recibo').val();
    pagado = $('#pagado_recibo').val();
    saldo = $('#saldo_recibo').val();
    tipo = $('#tipo_recibo').val();
    con_iva = $('#porcentaje_iva_recibo_check_val').val();

    formData = 
    {
        id_cliente, id_admin, fecha, id_razon_social, folio_recibo, comentarios, subtotal, iva, porcentaje_iva, 
        total, pagado, saldo, tipo, con_iva
    }

    if(id_recibo == '')
    {
        route = '/admin/facturas/store';
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
                $('#btn-save-recibo').removeAttr('disabled');
                QuitarErroresRecibo();
                ReciboNuevo(data.id);
                $('#id_recibo').val(data.id);
                toastr.success('Se creó el recibo exitosamente. Asigne los servicios');
                $("#subtotal_recibo").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                        /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $('#iva_recibo').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
                        /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $('#total_recibo').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
                        /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $('#subtotal_final_recibo').val(data.subtotal);
                $('#iva_final_recibo').val(data.iva);
                $('#total_final_recibo').val(data.total);
                $('#pagado_recibo').val(data.pagado);
                $('#saldo_recibo').val(data.saldo);
            },
            error: function(data)
            {
                console.log(data);
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                $('#btn-save-recibo').removeAttr('disabled');
                if (data.responseJSON.errors.id_cliente)
                {
                    $("#id_cliente_recibo_error").html(data.responseJSON.errors.id_cliente);
                    $("#id_cliente_recibo_error").fadeIn();
                }
                else
                {
                    $("#id_cliente_recibo_error").fadeOut();
                }

                if (data.responseJSON.errors.fecha)
                {
                    $("#fecha_recibo_error").html(data.responseJSON.errors.fecha);
                    $("#fecha_recibo_error").fadeIn();
                }
                else
                {
                    $("#fecha_recibo_error").fadeOut();
                }

                if (data.responseJSON.errors.folio_recibo)
                {
                    $("#folio_recibo_error").html(data.responseJSON.errors.folio_recibo);
                    $("#folio_recibo_error").fadeIn();
                }
                else
                {
                    $("#folio_recibo_error").fadeOut();
                }

                console.clear();
            }
        });
    }
    else
    {
        route = '/admin/facturas/update/' + id_recibo;
        //console.log(route);
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
                $('#btn-save-recibo').removeAttr('disabled');
                QuitarErroresRecibo();
                ActualizarRecibo(id_recibo);
                $('#id_recibo').val(data.id);
                toastr.success('Se actualizó el recibo exitosamente. Asigne los servicios');
                $("#subtotal_recibo").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                        /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $('#iva_recibo').html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(
                        /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $('#total_recibo').html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(
                        /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $('#subtotal_final_recibo').val(data.subtotal);
                $('#iva_final_recibo').val(data.iva);
                $('#total_final_recibo').val(data.total);
                $('#pagado_recibo').val(data.pagado);
                $('#saldo_recibo').val(data.saldo);
            },
            error: function(data)
            {
                console.log(data);
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                $('#btn-save-recibo').removeAttr('disabled');
                if (data.responseJSON.errors.id_cliente)
                {
                    $("#id_cliente_recibo_error").html(data.responseJSON.errors.id_cliente);
                    $("#id_cliente_recibo_error").fadeIn();
                }
                else
                {
                    $("#id_cliente_recibo_error").fadeOut();
                }

                if (data.responseJSON.errors.fecha)
                {
                    $("#fecha_recibo_error").html(data.responseJSON.errors.fecha);
                    $("#fecha_recibo_error").fadeIn();
                }
                else
                {
                    $("#fecha_recibo_error").fadeOut();
                }

                if (data.responseJSON.errors.folio_recibo)
                {
                    $("#folio_recibo_error").html(data.responseJSON.errors.folio_recibo);
                    $("#folio_recibo_error").fadeIn();
                }
                else
                {
                    $("#folio_recibo_error").fadeOut();
                }

                console.clear();
            }
        });
    }
});

function RecibirServicio(id)
{
    id_cliente = $('#id_cliente_recibo_val').val();
    id_recibo = $('#id_recibo').val();
    var cells = $('#servicio-recibo-' + id).children('td'); 
    var id_servicio = cells.eq(0).text();
    var monto = cells.eq(6).text();
    var monto_max = cells.eq(7).text();
    var costo = cells.eq(8).text();
    var facturado = cells.eq(9).text();
    var facturado_id_det = cells.eq(10).text();
    var id_det = cells.eq(11).text();

    monto = monto * 1;
    monto_max = monto_max * 1;
    costo = costo * 1;
    facturado = facturado * 1;

    valor = $('#servicio-recibo-pendiente-val-' + id).val();

    /*formData ={
        id_servicio, monto, monto_max, costo, facturado
    }*/

    //console.log(formData);

    if(monto > monto_max)
    {
        toastr.error('El monto a facturar debe ser menor al monto pendiente del servicio, el cual es: ' + monto_max);
        cells.eq(6).text(monto_max);
        $('#servicio-recibo-pendiente-val-' + id_servicio).val(valor);
        $('#servicio-recibo-pendiente-' + id_servicio).prop('checked', false);
    }
    else if(id_recibo == '')
    {
        toastr.error('Genere primero el recibo');
        $('#servicio-recibo-pendiente-val-' + id_servicio).val(valor);
        $('#servicio-recibo-pendiente-' + id_servicio).prop('checked', false);
    }
    else if(valor == 0)
    {
        valor = 1;
        insertarRecibo(id_cliente, id_servicio, monto, monto_max, costo, facturado, valor);
    }   
    else if(valor == 1)
    {
        valor = 0;
        QuitarServicioRecibo(id_det, id_servicio, facturado_id_det, monto, valor, monto_max);
        //$('#servicio-pendiente-val-' + id).val(valor);
    }
}

function insertarRecibo(id_cliente, id_servicio, monto, monto_max, costo, facturado, valor)
{
    id_recibo = $('#id_recibo').val();
    subtotal = $('#subtotal_final_recibo').val();
    porcentaje_iva = $('#porcentaje_iva_recibo').val();
    iva = $('#iva_final_recibo').val();
    total = $('#total_final_recibo').val();
    pagado = $('#pagado_recibo').val();
    saldo = $('#saldo_recibo').val();
    token = $('#_token').val();
    con_iva = $('#porcentaje_iva_recibo_check_val').val();
    monto_pendiente = $('#recibo_pendiente_val').val();
    monto_pendiente = monto_pendiente * 1;
    monto = monto * 1;
    monto_max = monto_max * 1;

    var formData =
    {
        id_cliente, id_servicio, monto, costo, facturado, id_recibo, subtotal,
        porcentaje_iva, iva, total, pagado, saldo, con_iva
    }

    //console.log(formData);
    $.ajax(
    {
        url: '/admin/facturas/insertar-detalle/' + id_recibo,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            //console.log(data);
            toastr.success('Se agregó el servicio al recibo.');
            $('#servicio-recibo-pendiente-val-' + id_servicio).val(valor);
            ActualizarTotalesRecibo(id_recibo);
            ActualizarRecibo(id_recibo);  
            var cells = $('#servicio-recibo-' + id_servicio).children('td');   
            monto_nuevo = monto_max - monto;  
            cells.eq(11).text(data.id);
            cells.eq(6).text(monto_nuevo);
            cells.eq(7).text(monto_nuevo);
            cells.eq(10).text(monto);
            cells.eq(5).text(parseFloat(monto, 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            pendiente = monto_pendiente - monto;
            $('#recibo_pendiente_val').val(pendiente);
            $('#recibo_pendiente').html(parseFloat(pendiente, 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if(valor == 1)
            {
                valor = 0;
                $('#servicio-recibo-pendiente-'+id_servicio).prop( "checked", false );
                //$('#servicio-pendiente-val-' + id_servicio).val(valor);
            }
            else if(valor == 0)
            {
                valor = 1;
                $('#servicio-recibo-pendiente-'+id_servicio).prop( "checked", true );
            }
        }
    });
}

function QuitarServicioRecibo(id_det, id_servicio, facturado_id_det, monto, valor, monto_max)
{
    id_recibo = $('#id_recibo').val();
    subtotal = $('#subtotal_final_recibo').val();
    porcentaje_iva = $('#porcentaje_iva_recibo').val();
    iva = $('#iva_final_recibo').val();
    total = $('#total_final_recibo').val();
    pagado = $('#pagado_recibo').val();
    saldo = $('#saldo_recibo').val();
    token = $('#_token').val();
    con_iva = $('#porcentaje_iva_recibo_check_val').val();
    monto_pendiente = $('#recibo_pendiente_val').val();
    monto_pendiente = monto_pendiente * 1;
    facturado_id_det = facturado_id_det * 1;
    monto = monto * 1;
    monto_max = monto_max * 1;

    var formData =
    {
        facturado_id_det, subtotal, porcentaje_iva, iva, total, pagado, saldo, con_iva
    }

    //console.log(formData);
    $.ajax(
    {
        url: '/admin/facturas/eliminar-detalle/' + id_recibo + '/' + id_det,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            //console.log(data);
            toastr.success('Se quitó el servicio del recibo.');
            $('#servicio-recibo-pendiente-val-' + id_servicio).val(valor);

            ActualizarTotalesRecibo(id_recibo);
            ActualizarRecibo(id_recibo);  
            var cells = $('#servicio-recibo-' + id_servicio).children('td');  

            pendiente_val = (monto_max * 1) + (facturado_id_det * 1);
            cells.eq(6).text(pendiente_val);
            cells.eq(7).text(pendiente_val);
            cells.eq(10).text('0');
            cells.eq(11).text('');
            cells.eq(5).text('0');
            pendiente = monto_pendiente + pendiente_val;
            $('#recibo_pendiente_val').val(pendiente);
            $('#recibo_pendiente').html(parseFloat(pendiente, 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "$1,").toString());;
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if(valor == 1)
            {
                valor = 0;
                $('#servicio-recibo-pendiente-'+id_servicio).prop( "checked", false );
                //$('#servicio-pendiente-val-' + id_servicio).val(valor);
            }
            else if(valor == 0)
            {
                valor = 1;
                $('#servicio-recibo-pendiente-'+id_servicio).prop( "checked", true );
            }
        }
    });
}

function BorrarRecibo()
{
    $('#id_recibo').val('');
    $('#accion_recibo').val('Create');
    $('#comentarios_recibo').val('');
    $('#porcentaje_iva_recibo_check_val').val('0');
    $('#porcentaje_iva_recibo_check').prop('checked', false);
    $('#subtotal_recibo').html('$ 0.00');
    $('#iva_recibo').html('$ 0.00');
    $('#total_recibo').html('$ 0.00');
    $('#subtotal_final_recibo').val('0');
    $('#iva_final_recibo').val('0');
    $('#total_final_recibo').val('0');
    $('#pagado_recibo').val('0');
    $('#saldo_recibo').val('0');
    $('#folio_recibo').val('');
    $('#id_razon_social_recibo').empty();
    $('#id_razon_social_recibo').append('<option value="" selected>-Seleccionar opción-</option>');
    $('#id_cliente_recibo').empty();
    //
    $('#id_cliente_recibo_val').val('');
    $('#detalles_recibo').val('0');
    $('#servicios-pendientes-recibor').empty();
    $('#servicios-recibodos').empty();
    $('#fecha_recibo').datepicker().datepicker('setDate', 'today');
}

function QuitarErroresRecibo()
{
    
}

//Razon social
function AgregarRazonSocialRecibo()
{
    id_cliente = $('#id_cliente_recibo_val').val();

    if(id_cliente == '')
    {
        $('#id_cliente_recibo_error').html('Seleccione primero un cliente');
        $('#id_cliente_recibo_error').fadeIn();
    }
    else
    {
        $('#modal-agregar-razon-recibo').modal('toggle');
        $('.header-razon-social').css(
        {
            'background-color' : '#49adad'
        });
    }
}

$('#btn-agregar-razon-recibo').click(function()
{
    $('#btn-agregar-razon-recibo').attr('disabled', 'disabled');
    token = $('#_token').val();
    id_admin = $('#id_admin').val();
    razon_social = $('#razon_social_recibo').val();
    rfc = $('#rfc_recibo').val();
    id_cliente = $('#id_cliente_recibo_val').val();

    formData = {razon_social, rfc, id_admin, id_cliente}

    //console.log(formData);
    
    route = '/admin/facturas/insertar-razon';
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
            $('#btn-agregar-razon-recibo').removeAttr('disabled');
            QuitarErroresRazonSocialRecibo();
            BorrarDatosRazonSocialRecibo();
            $('#id_razon_social_recibo').prepend('<option value="'+data.id_razon_social+'" selected>'
                +data.razon_social+ '|' + data.rfc + '</option>')
            toastr.success('Se agregó la razón social exitosamente.');
            $('#modal-agregar-razon-recibo').modal('toggle');
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            $('#btn-agregar-razon-recibo').removeAttr('disabled');

            if (data.responseJSON.errors.razon_social)
            {
                $("#razon_social_recibo_error").html(data.responseJSON.errors.razon_social);
                $("#razon_social_recibo_error").fadeIn();
            }
            else
            {
                $("#razon_social_recibo_error").fadeOut();
            }

            if (data.responseJSON.errors.rfc)
            {
                $("#rfc_recibo_error").html(data.responseJSON.errors.rfc);
                $("#rfc_recibo_error").fadeIn();
            }
            else
            {
                $("#rfc_recibo_error").fadeOut();
            }

            //console.clear();
        }
    });
});

$(".cerrar-razon-recibo").click(function()
{
    $("#modal-agregar-razon-recibo").modal('toggle');
});

function QuitarErroresRazonSocialRecibo()
{
    $('#razon_social_recibo_error').fadeOut();
    $('#rfc_recibo_error').fadeOut();
}

function BorrarDatosRazonSocialRecibo()
{
    $('#razon_social_recibo').val('');
    $('#rfc_recibo').val('');
}

//Pagar Recibo
function PagarRecibo(id, folio, saldo, tipo)
{

}








