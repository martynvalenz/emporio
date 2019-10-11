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
    $('#id_admin_filtro').val('0').change();
    setTimeout(Listar, 300);
});
$("#btn-buscar").on("click", function(e)
{
    e.preventDefault();
    Listar();
});
$(".btn-cerrar-actualizar").on("click", function(e)
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

$('#id_admin_filtro').on('change', function()
{
    Listar();
});


function Listar()
{
    var id_admin;
    var buscar;
    buscar = $("#buscar").val();
    id_admin = $("#id_admin_filtro").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();
    var estatus = $('#estatus_select').val();
    var estatus_cobranza = $('#estatus_cobranza_select').val();
    // var id_admin = $('#id_admin_filtro').val();
    // var buscar = $('#buscar').val();
    //console.log(id_admin);

    if (buscar == '')
    {
        
        $.ajax(
        {
            type: 'get',
            url: url_listar + estatus + '/' + id_admin,
            success: function(data)
            {
                $('#listado').empty().html(data);
                $(".tooltip").tooltip("hide");
                $(function()
                {
                    $('#example1').stickyTableHeaders();
                });

                ComisionesTotales();
            }
        });
    }
    else
    {
        $.ajax(
        {
            type: 'get',
            url: url_buscar + estatus + '/' + id_admin + '/' + buscar,
            success: function(data)
            {
                //console.log(data)
                $('#listado').empty().html(data);
                $(".tooltip").tooltip("hide");
                $(function()
                {
                    $('#example1').stickyTableHeaders();
                });

                ComisionesTotales();
            }
        });
    }
}

function ComisionesTotales()
{
    buscar = $("#buscar").val();
    id_admin = $("#id_admin_filtro").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();
    var estatus = $('#estatus_select').val();
    var estatus_cobranza = $('#estatus_cobranza_select').val();

    if (buscar == '')
    {
        
        route = url_listar + 'total/' + estatus + '/' + id_admin;

        $.get(route, function(data)
        {
            $('#monto_total_comision').html('Total: $ ' + parseFloat(data, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        });
    }
    else
    {
        route = url_listar + 'total/' + estatus + '/' + id_admin + '/' + buscar;

        $.get(route, function(data)
        {
            $('#monto_total_comision').html('Total: $ ' + parseFloat(data, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        });
    }
}

$("#btn-borrar-asignacion").click(function()
{
    //ResetearFecha();
    $('#buscar-asignacion').val('');
    setTimeout(ListarAsignacion, 300);
});
$("#btn-buscar-asignacion").on("click", function(e)
{
    e.preventDefault();
    ListarAsignacion();
});

$('#buscar-asignacion').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        ListarAsignacion();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});


function ActualizarComisionListado(id)
{
    url_actualizar = $('#url_actualizar').val();
    //console.log(url_actualizar);
    $.ajax(
    {
        type: 'get',
        url: url_actualizar + id,
        success: function(data)
        {
            //console.log(data);
            $('#comision-' + id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });

            ComisionesTotales();
        }
    });  
}

function ActualizarAsignacion(id)
{
    url_actualizar = '/admin/comisiones-asignacion-actualizar/';
    //console.log(url_actualizar);
    $.ajax(
    {
        type: 'get',
        url: url_actualizar + id,
        success: function(data)
        {
            //console.log(data);
            $('#listado-asignacion-' + id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });  
}

$('#id_usuario').on('change', function()
{
    cargarServiciosPendientes();
});

function cargarServiciosPendientes()
{
    id_admin = $('#id_usuario').val();

    if(id_admin == '')
    {

    }
    else
    {
        route = '/admin/comision-cargar-servicios-pendientes/' + id_admin;

        $.ajax(
        {
            type: 'get',
            url: route,
            success: function(data)
            {
                //console.log(data)
                $('#servicios').empty().html(data);
                $(".tooltip").tooltip("hide");
            }
        });
    }
}

function cargarServiciosPagados()
{
    id_admin = $('#id_usuario').val();
    id_egreso = $('#id_egreso').val();

    if(id_admin == '' && id_egreso == '')
    {

    }
    else
    {
        route = '/admin/comision-cargar-servicios-pagados/' + id_admin + '/' + id_egreso;

        $.ajax(
        {
            type: 'get',
            url: route,
            success: function(data)
            {
                //console.log(data)
                $('#servicios-pagados').empty().html(data);
                $(".tooltip").tooltip("hide");
            }
        });
    }
}

function BorrarComision()
{
    $('#id_egreso').val('');
    $('#fecha').datepicker().datepicker('setDate', 'today');
    $('#id_usuario').val('').change();
    $('#id_cuenta').val('').change();
    $('#id_forma_pago').val('').change();
    $('#total').val('0.00');
    $('#total_val').val('0');
    $('#cheque').val('');
    $('#movimiento').val('');
    $('#concepto').val('');
    $('#estatus').val('');

    $('#servicios').empty();
    $('#servicios-pagados').empty();
}

function QuitarErroresComision()
{
    $('#id_usuario_error').fadeOut();
    $('#fecha_error').fadeOut();
    $('#id_cuenta_error').fadeOut();
    $('#id_forma_pago_error').fadeOut();
    $('#total_error').fadeOut();
    $('#cheque_error').fadeOut();
    $('#movimiento_error').fadeOut();
    $('#concepto_error').fadeOut();
}

function CreateComision()
{
    BorrarComision();
    QuitarErroresComision();
    $("#encabezado-title").html("Agregar Comisiones");
    $('#encabezado').css(
    {
        'background-color': '#218CBF'
    });
}

function EditComision(id)
{
    BorrarComision();
    QuitarErroresComision();

    $("#encabezado-title").html("Editar Comision: " + id);
    $('#encabezado').css(
    {
        'background-color': '#ff9900'
    });

    $('#id_egreso').val(id);
    $('#accion').val('Editar')

    var router = "/admin/comisiones/edit/" + id;
    $.get(router, function(data)
    {
        $('#estatus').val(data.estatus)
        $('#id_usuario').val(data.id_admin).change();
        $('#fecha').val(data.fecha);
        $('#id_cuenta').val(data.id_cuenta).change();
        $('#id_forma_pago').val(data.id_forma_pago).change();
        $('#cheque').val(data.cheque);
        $('#movimiento').val(data.movimiento);
        $('#concepto').val(data.concepto);

        if(data.estatus == 'Pagado')
        {
            $('#total').val(data.retiro);
            $('#total_val').val(data.retiro);
        }
        else if(data.estatus == 'Cancelado')
        {
            $('#total').val('0');
            $('#total_val').val('0');
        }
    });

    setTimeout(cargarServiciosPendientes,400);
    setTimeout(cargarServiciosPagados,400);
}

$(document).on('click','.btn-agregar-comision', function()
{
    QuitarErroresComision();

    var cells = $(this).closest("tr").children("td");
    var id_comision = cells.eq(0).text();
    var total = cells.eq(8).text();
    id_egreso = $('#id_egreso').val();
    total_val = $('#total_val').val();
    fecha = $('#fecha').val();

    total = total * 1;
    total_val = total_val * 1;

    //console.log(total);
    //console.log(id_comision); 

    if(id_egreso == '')
    {
        Store(id_comision, total);
    }
    else
    {
        Update(id_comision, total, id_egreso, total_val, fecha)
    }
});

function Store(id_comision, total)
{
    id_admin = $('#id_usuario').val();
    fecha = $('#fecha').val();
    id_cuenta = $('#id_cuenta').val();
    id_forma_pago = $('#id_forma_pago').val();
    cheque = $('#cheque').val();
    movimiento = $('#movimiento').val();
    concepto = $('#concepto').val();
    token = $('#_token_egresos').val();

    var formData = 
    {
        id_admin, fecha, id_cuenta, id_forma_pago, cheque, movimiento, concepto, total, id_comision
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/comisiones/store',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se agregó el egreso existosamente.');
            $("#id_egreso").val(data.id);
            $("#total").val(data.retiro);
            $("#total_val").val(data.retiro);
            $("#estatus").val(data.estatus);

            setTimeout(cargarServiciosPendientes,400);
            setTimeout(cargarServiciosPagados,400);
            
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.id_admin)
            {
                $("#id_usuario_error").html(data.responseJSON.errors.id_admin);
                $("#id_usuario_error").fadeIn();
            }
            else
            {
                $("#id_usuario_error").fadeOut();
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
            if (data.responseJSON.errors.id_cuenta)
            {
                $("#id_cuenta_error").html(data.responseJSON.errors.id_cuenta);
                $("#id_cuenta_error").fadeIn();
            }
            else
            {
                $("#id_cuenta_error").fadeOut();
            }
            if (data.responseJSON.errors.id_forma_pago)
            {
                $("#id_forma_pago_error").html(data.responseJSON.errors.id_forma_pago);
                $("#id_forma_pago_error").fadeIn();
            }
            else
            {
                $("#id_forma_pago_error").fadeOut();
            }
            if (data.responseJSON.errors.total)
            {
                $("#total_error").html(data.responseJSON.errors.total);
                $("#total_error").fadeIn();
            }
            else
            {
                $("#total_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            console.clear();
        }
    });
}

function insertarComision(id_comision)
{
    
}

function Update(id_comision, total, id_egreso, total_val, fecha)
{
    token = $('#_token_egresos').val();
    id_cuenta = $('#id_cuenta').val();
    id_forma_pago = $('#id_forma_pago').val();
    cheque = $('#cheque').val();
    movimiento = $('#movimiento').val();
    concepto = $('#concepto').val();
    
    var formData = 
    {
        id_comision, total, id_egreso, total_val, fecha, id_cuenta, id_forma_pago, cheque, movimiento, concepto
    }
    console.log(formData);
    $.ajax(
    {
        url: '/admin/comisiones/update/' + id_egreso,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            $("#id_egreso").val(data.id);
            $("#total").val(data.retiro);
            $("#total_val").val(data.retiro);
            $("#estatus").val(data.estatus);

            setTimeout(cargarServiciosPendientes,400);
            setTimeout(cargarServiciosPagados,400);
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
        }
    });
}

/*$('#btn-guardar-comision').click(function()
{
    id_egreso = $('#id_egreso').val();

    if(id_egreso == '')
    {
        id_admin = $('#id_usuario').val();
        fecha = $('#fecha').val();
        id_cuenta = $('#id_cuenta').val();
        id_forma_pago = $('#id_forma_pago').val();
        cheque = $('#cheque').val();
        movimiento = $('#movimiento').val();
        concepto = $('#concepto').val();
        token = $('#_token_egresos').val();

        var formData = 
        {
            id_admin, fecha, id_cuenta, id_forma_pago, cheque, movimiento, concepto
        }
        //console.log(formData);
        $.ajax(
        {
            url: '/admin/comisiones/guardar',
            headers:
            {
                'X-CSRF-TOKEN': token
            },
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(data)
            {
                toastr.success('Se agregó el egreso existosamente.');
                $("#id_egreso").val(data.id);
                $("#total").val(data.retiro);
                $("#total_val").val(data.retiro);
                $("#estatus").val(data.estatus);

                setTimeout(cargarServiciosPendientes,400);
                setTimeout(cargarServiciosPagados,400);
                
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.id_admin)
                {
                    $("#id_usuario_error").html(data.responseJSON.errors.id_admin);
                    $("#id_usuario_error").fadeIn();
                }
                else
                {
                    $("#id_usuario_error").fadeOut();
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
                if (data.responseJSON.errors.id_cuenta)
                {
                    $("#id_cuenta_error").html(data.responseJSON.errors.id_cuenta);
                    $("#id_cuenta_error").fadeIn();
                }
                else
                {
                    $("#id_cuenta_error").fadeOut();
                }
                if (data.responseJSON.errors.id_forma_pago)
                {
                    $("#id_forma_pago_error").html(data.responseJSON.errors.id_forma_pago);
                    $("#id_forma_pago_error").fadeIn();
                }
                else
                {
                    $("#id_forma_pago_error").fadeOut();
                }
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                //console.clear();
            }
        });
    }
    else
    {
        id_egreso = $('#id_egreso').val();
        fecha = $('#fecha').val();
        id_cuenta = $('#id_cuenta').val();
        id_forma_pago = $('#id_forma_pago').val();
        cheque = $('#cheque').val();
        movimiento = $('#movimiento').val();
        concepto = $('#concepto').val();
        token = $('#_token_egresos').val();

        var formData = 
        {
            fecha, id_cuenta, id_forma_pago, cheque, movimiento, concepto
        }
        //console.log(formData);
        $.ajax(
        {
            url: '/admin/comisiones/actualizar/' + id_egreso,
            headers:
            {
                'X-CSRF-TOKEN': token
            },
            type: 'PUT',
            dataType: 'json',
            data: formData,
            success: function(data)
            {
                toastr.success('Se actualizó el egreso existosamente.');
                $("#id_egreso").val(data.id);
                $("#total").val(data.retiro);
                $("#total_val").val(data.retiro);
                $("#estatus").val(data.estatus);

                setTimeout(cargarServiciosPendientes,400);
                setTimeout(cargarServiciosPagados,400);
                
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.fecha)
                {
                    $("#fecha_error").html(data.responseJSON.errors.fecha);
                    $("#fecha_error").fadeIn();
                }
                else
                {
                    $("#fecha_error").fadeOut();
                }
                if (data.responseJSON.errors.id_cuenta)
                {
                    $("#id_cuenta_error").html(data.responseJSON.errors.id_cuenta);
                    $("#id_cuenta_error").fadeIn();
                }
                else
                {
                    $("#id_cuenta_error").fadeOut();
                }
                if (data.responseJSON.errors.id_forma_pago)
                {
                    $("#id_forma_pago_error").html(data.responseJSON.errors.id_forma_pago);
                    $("#id_forma_pago_error").fadeIn();
                }
                else
                {
                    $("#id_forma_pago_error").fadeOut();
                }
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                //console.clear();
            }
        });
    }
});*/

function DetallesComision(id, id_admin)
{
    route = '/admin/comision-cargar-servicios-pagados/' + id_admin + '/' + id;

    $.ajax(
    {
        type: 'get',
        url: route,
        success: function(data)
        {
            //console.log(data)
            $('#comisiones-detalles').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

$(document).on('click','.btn-quitar-comision', function()
{
    QuitarErroresComision();

    var cells = $(this).closest("tr").children("td");
    var id_comision = cells.eq(0).text();
    var total = cells.eq(8).text();
    id_egreso = $('#id_egreso').val();
    total_val = $('#total_val').val();

    total = total * 1;
    total_val = total_val * 1;

    token = $('#_token_egresos').val();

    var formData = 
    {
        id_comision, total, id_egreso, total_val
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/comisiones/quitar-comision/' + id_egreso + '/' + id_comision,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se quitó la comisión del egreso existosamente.');
            $("#id_egreso").val(data.id);
            $("#total").val(data.retiro);
            $("#total_val").val(data.retiro);

            setTimeout(cargarServiciosPendientes,400);
            setTimeout(cargarServiciosPagados,400);
            
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            //console.clear();
        }
    });
});

function EliminarComision(id)
{
    $.confirm(
    {
        title: '¿Desea eliminar la comisión?',
        content: '',
        autoClose: 'Cancelar|8000',
        buttons: 
        {
            Cancelar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Eliminar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/comisiones/eliminar-comision/' + id;
                    token = $('#_token_egresos');

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data)
                        {
                            Listar();
                        },
                        error: function(data)
                        {
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}


//Dirección
function EditarComisionMonto(id, monto)
{
    $('#id_comision_monto').val(id);
    $('#monto_direccion').val(monto);
}

$('#btn-editar-monto-comision').click(function()
{
    $('#btn-editar-monto-comision').attr('disabled', 'disabled');
    id = $('#id_comision_monto').val();
    monto = $('#monto_direccion').val();
    token = $('#_token').val();
    modificada = 1;

    formData = {monto, modificada}
    route = '/admin/direccion/comision-monto/' + id

    $.ajax(
    {
        url: route,
        type: 'PUT',
        data: formData,
        dataType: 'json',
        success: function(data)
        {
            $("#monto_direccion_error").fadeOut();
            $('#btn-editar-monto-comision').removeAttr('disabled');
            ActualizarComisionListado(data.id);
            $('#modal-comision-monto').modal('toggle');
            toastr.success('Se actualizó el monto de la comisión');
        },
        error: function(data)
        {
            $('#btn-editar-monto-comision').removeAttr('disabled');
            console.log(data);
            toastr.error('No se pudo actualizar el  monto, revise los errores.');

            if (data.responseJSON.errors.monto)
            {
                $("#monto_direccion_error").html(data.responseJSON.errors.monto);
                $("#monto_direccion_error").fadeIn();
            }
            else
            {
                $("#monto_direccion_error").fadeOut();
            }
        }
    });
});


function LiberarComision(id)
{
    $.confirm(
    {
        title: '¿Desea liberar la comisión?',
        content: '',
        autoClose: 'Cancelar|8000',
        buttons: 
        {
            Cancelar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Liberar',
                btnClass: 'btn-blue any-other-class',
                action: function () 
                {
                    router = '/admin/direccion/comision-liberar/' + id;
                    token = $('#_token');

                    $.ajax(
                    {
                        url: router,
                        type: 'PUT',
                        dataType: 'json',
                        success: function(data)
                        {
                            ActualizarComisionListado(data.id);
                        },
                        error: function(data)
                        {
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function PendienteComision(id)
{
    $.confirm(
    {
        title: '¿Desea pasar a estatus de pendiente la comisión?',
        content: '',
        autoClose: 'Cancelar|8000',
        buttons: 
        {
            Cancelar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Pendiente',
                btnClass: 'btn-orange any-other-class',
                action: function () 
                {
                    router = '/admin/direccion/comision-pendiente/' + id;
                    token = $('#_token');

                    $.ajax(
                    {
                        url: router,
                        type: 'PUT',
                        dataType: 'json',
                        success: function(data)
                        {
                            ActualizarComisionListado(data.id);
                        },
                        error: function(data)
                        {
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}


//Preseleccionar comisiones
function CargarComisionesPendientes()
{
    id_admin = $('#id_admin_pendientes').val();
    $.ajax(
    {
        type: 'get',
        url: '/admin/comisiones-preseleccionar-listado/' + id_admin,
        success: function(data)
        {
            $('#preseleccionar-listado').empty().html(data);
            $(".tooltip").tooltip("hide");
            //CalcularTotalComision();
        }
    });
}

$('#id_admin_pendientes').change(function()
{
    CargarComisionesPendientes();
});

function PreseleccionarComision(id, monto)
{
    valor = $('#comision-servicio-id-' + id).val();
    monto_total = $('#monto_total_val').val();
    token = $('#_token').val();

    monto = monto * 1;
    monto_total = monto_total * 1;

    if(valor == 1)
    {
        valor = 0;
    }
    else if(valor == 0)
    {
        valor = 1;
    }

    route = '/admin/comisiones-preseleccionar/' + id;

    formData = {valor}

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
            if(valor == 1)
            {
                $('#comision-servicio-id-' + id).prop('checked', true);
                monto_total = monto_total + monto;
                $('#monto_total_val').val(monto_total);
                $('.monto-total').html(parseFloat(monto_total, 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "1,").toString());
            }
            else if(valor == 0)
            {
                $('#comision-servicio-id-' + id).prop('checked', false);
                monto_total = monto_total - monto;
                $('#monto_total_val').val(monto_total);
                $('.monto-total').html(parseFloat(monto_total, 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "1,").toString());
            }

            $('#comision-servicio-id-' + id).val(valor);
        },
        error: function(data)
        {
            console.log(data);

            if(valor == 1)
            {
                $('#comision-servicio-id-' + id).prop('checked', false);
                $('#comision-servicio-id-' + id).val(0);
            }
            else if(valor == 0)
            {
                $('#comision-servicio-id-' + id).prop('checked', true);
                $('#comision-servicio-id-' + id).val(1);
            }

            

            if (data.status == 422)
            {
                //console.clear();
            }
            //console.clear();
        }
    });
}

$('#btn-refrescar').click(function()
{
    CargarComisionesPendientes();

    id_admin = $('#id_admin_pendientes').val();

    router = '/admin/comisiones-total-seleccionar/' + id_admin;

    $.get(router, function(data)
    {
        $('#monto_total_val').val(data);
        $('.monto-total').html(parseFloat(data, 10).toFixed(2).replace(
            /(\d)(?=(\d{3})+\.)/g, "1,").toString());
    });
});

function Seleccionar()
{
    token = $('#_token').val();
    id_admin = $('#id_admin_pendientes').val();
    route = '/admin/comisiones-seleccionar/' + id_admin;

    $.ajax(
    {
        url: route,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        success: function(data)
        {
            CargarComisionesPendientes();
            //console.log(data);

            router = '/admin/comisiones-total-seleccionar/' + id_admin;

            $.get(router, function(data)
            {
                $('#monto_total_val').val(data);
                $('.monto-total').html(parseFloat(data, 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "1,").toString());
            });
            
        },
        error: function(data)
        {
            console.log(data);
        }
    });    
}


// ------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------
//Comisiones Menu
//Menu
var Menu = function(id, id_comi)
{
    var route = "/admin/procesos/getstatus/" + id;
    $('#id_comision_egreso').val(id_comi);

    $.get(route, function(data)
    {
        $("#menu-title").html('Comisiones de servicio: ' + data.id + ' | ' + data.clave);
        $("#id_servicio_menu").val(data.id);

        listadoComisiones(data.id);
        QuitarErroresComision();
        BorrarComision();
    });
}


$('#tipo_comision').change(function()
{
    tipo = $(this).val();
    id = $('#id_servicio_menu').val();

    if(tipo == '')
    {
        $('#id_comision').val('');
        $('#monto_disponible_comision').val('');
        $('#monto_disponible_comision_val').val('');
        $('#monto_disponible_val').val('');
        $('#porcentaje_comision').val('');
        $('#monto_comision_usuario').val('');
        $('#listo_comision').val('0');
        QuitarErroresComision();
    }
    else 
    {
        valorComision(id, tipo); 
    }

    
});

function valorComision(id, tipo)
{
    var router = "/admin/comisiones/monto-restante/" + id;
    $.get(router, function(data)
    {
        //console.log(data);
        //gerencia_operativa = $("#gerencia_operativa_check").val();

        if(tipo == 'Operativa')
        {
            $('#monto_comision_usuario').val(data.comision_operativa_restante);
            $('#monto_comision_usuario').attr('max', data.comision_operativa_restante);
            $('#monto_max').val(data.comision_operativa_restante);
            $('#monto_disponible_comision').val(data.comision_operativa_restante);
            $('#monto_disponible_comision_val').val(data.comision_operativa_restante);
            $('#monto_disponible_val').val(data.comision_operativa);
            $('#listo_comision').val(data.listo_comision_operativa);
            porcentaje_comision = (data.comision_operativa_restante / data.comision_operativa) * 100;
            porcentaje_comision = porcentaje_comision.toFixed(2);
            $('#porcentaje_comision').val(porcentaje_comision);
            $('#porcentaje_comision').attr('max', porcentaje_comision);
        }
        else if(tipo == 'Gestión')
        {
            $('#monto_comision_usuario').val(data.comision_gestion_restante);
            $('#monto_comision_usuario').attr('max', data.comision_gestion_restante);
            $('#monto_max').val(data.comision_gestion_restante);
            $('#monto_comision_usuario').attr(data.comision_gestion_restante);
            $('#monto_disponible_comision').val(data.comision_gestion_restante);
            $('#monto_disponible_comision_val').val(data.comision_gestion_restante);
            $('#monto_disponible_val').val(data.comision_gestion);
            $('#listo_comision').val(data.listo_comision_gestion);
            porcentaje_comision = (data.comision_gestion_restante / data.comision_gestion) * 100;
            porcentaje_comision = porcentaje_comision.toFixed(2);
            $('#porcentaje_comision').val(porcentaje_comision);
            $('#porcentaje_comision').attr('max', porcentaje_comision);
        }
        else if(tipo == 'Venta')
        {
            $('#monto_comision_usuario').val(data.comision_venta_restante);
            $('#monto_comision_usuario').attr('max', data.comision_venta_restante);
            $('#monto_max').val(data.comision_venta_restante);
            $('#monto_disponible_comision').val(data.comision_venta_restante);
            $('#monto_disponible_comision_val').val(data.comision_venta_restante);
            $('#monto_disponible_val').val(data.comision_venta);
            $('#listo_comision').val(data.listo_comision_venta);
            porcentaje_comision = (data.comision_venta_restante / data.comision_venta) * 100;
            porcentaje_comision = porcentaje_comision.toFixed(2);
            $('#porcentaje_comision').val(porcentaje_comision);
            $('#porcentaje_comision').attr('max', porcentaje_comision);
        }
    });
}

$('#btn-actualizar-porcentaje-comision').click(function()
{
    porcentaje_comision = $('#porcentaje_comision').val();
    ActualizarPorcentajeComision(porcentaje_comision);
});

$('#porcentaje_comision').on('keypress', function(e)
{
    if (e.which === 13)
    {
        porcentaje_comision = $(this).val();
        ActualizarPorcentajeComision(porcentaje_comision);
    }
});

function ActualizarPorcentajeComision(porcentaje_comision)
{
    if(porcentaje_comision == '')
    {
        $('monto_comision_usuario').val("0");
    }
    else if(porcentaje_comision > 100)
    {
        $('#porcentaje_comision_error').html('El porcentaje no puede ser mayor al 100%.');
        $('#porcentaje_comision_error').fadeIn();
    }
    else
    {
        total = $('#monto_disponible_val').val();

        porcentaje = porcentaje_comision;

        monto = total * (porcentaje / 100);

        monto_max = $('#monto_max').val();

        if(monto > monto_max)
        {
            $('#monto_comision_usuario_error').html('El monto de la comisión no puede ser mayor al monto disponible.');
            $('#monto_comision_usuario_error').fadeIn();
        }
        else
        {
            $('#monto_comision_usuario_error').fadeOut();
            $('#porcentaje_comision_error').fadeOut();

            //restante = monto_max - monto;
            //console.log(restante);
            monto = monto.toFixed(2);
            //restante = restante.toFixed(2);
            
            $('#monto_comision_usuario').val(monto);
            //$('#monto_disponible_comision_val').val(restante);
            //$('#monto_disponible_comision').val(restante);
        }
    }
}

$('#monto_comision_usuario').on('keypress', function(e)
{
    if (e.which === 13)
    {
        if($(this).val() == '')
        {
            $('porcentaje_comision').val("0");
        }

        else
        {
            total = $(this).val();

            porcentaje = total * (porcentaje / 100);

            monto_max = $('#monto_max').val();

            if(monto > monto_max)
            {
                $('#monto_comision_usuario_error').html('El monto de la comisión no puede ser mayor al monto disponible.');
                $('#monto_comision_usuario_error').fadeIn();
            }
            else
            {
                $('#monto_comision_usuario_error').fadeOut();

                //restante = monto_max - monto;
                //restante = restante.toFixed(2);
                //console.log(restante);
                porcentaje = porcentaje.toFixed(2);
                //$('#monto_disponible_comision_val').val(restante);
                //$('#monto_disponible_comision').val(restante);
                $('#porcentaje_comision').val(porcentaje);
            }
        }
    }
});

//repartir 20%
$('#aplica_repartir_comision').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_repartir_comision_check").val(this.value);
}).change();

$('#btn-guardar-comision').click(function()
{
    id_comision = $('#id_comision').val();

    if(id_comision == '')
    {
        InsertarComision();
    }
    else
    {
        ActualizarComision(id_comision);
    }
});

function InsertarComision()
{
    $('#btn-guardar-comision').attr('disabled', 'disabled');
    monto = $('#monto_comision_usuario').val();
    monto_disponible = $('#monto_disponible_comision_val').val();
    porcentaje_comision = $('#porcentaje_comision').val();
    id_servicio = $('#id_servicio_menu').val();
    repartir_comision = $('#aplica_repartir_comision_check').val();
    usuario_repartir = $('#usuario_repartir_comision').val();
    id_admin = $('#usuario_comision').val();

    monto = monto * 1;
    monto_repartido = monto;
    monto_disponible = monto_disponible * 1;
    porcentaje_comision = porcentaje_comision * 1;
    porcentaje_repartido = porcentaje_comision;

    
    if(repartir_comision == 1 && usuario_repartir != '')
    {
        monto = monto * (80/100);
        monto_descontado = monto_repartido - monto;
        porcentaje_comision = porcentaje_comision * (80/100);
        porcentaje_descontado = porcentaje_repartido - porcentaje_comision;
    }
    else 
    {
        monto_descontado = 0;
        porcentaje_descontado = 0;
    }

    if(monto_disponible == 0)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
        $("#monto_disponible_comision_error").html('No hay monto disponible para generar comisión.');
        $("#monto_disponible_comision_error").fadeIn();
    }
    else if(monto_disponible < monto)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
        $("#monto_comision_usuario_error").html('El monto de la comisión no puede ser mayor al monto disponible');
        $("#monto_comision_usuario_error").fadeIn();
    }
    else if(porcentaje_comision > 100)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
        $("#porcentaje_comision_error").html('El porcentaje no puede ser mayor a 100%');
        $("#porcentaje_comision_error").fadeIn();
    }
    else if(repartir_comision == 1 && usuario_repartir == '')
    {
        $('#usuario_repartir_comision_error').html('Seleccione el usuario al cual se va a repartir el 20%');
        $('#usuario_repartir_comision_error').fadeIn();
    }
    else if(repartir_comision == 1 && usuario_repartir == id_admin)
    {
        $('#usuario_repartir_comision_error').html('El usuario de la comisión no puede ser el mismo del 20%');
        $('#usuario_repartir_comision_error').fadeIn();
    }
    else
    {
        monto_restante = monto_disponible - monto - monto_descontado;
        monto_restante = monto_restante * 1;
        //console.log(monto_restante);

        $("#monto_comision_usuario_error").fadeOut();
        $("#porcentaje_comision_error").fadeOut();
        $("#monto_disponible_comision_error").fadeOut();
        $("#usuario_repartir_comision_error").fadeOut();

        var route = "/admin/procesos/crear-comisiones";
        var token = $("#_token").val();
        var formData = 
        {
            tipo_comision: $('#tipo_comision').val(),
            comentarios: $('#comentarios_comision').val(),
            monto,
            id_admin,
            id_servicio,
            listo_comision: $('#listo_comision').val(),
            monto_restante,
            porcentaje_comision,
            monto_descontado, 
            porcentaje_descontado, 
            usuario_repartir,
            repartir_comision
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
                $('#tipo_comision').removeAttr('disabled');
                $('#btn-guardar-comision').removeAttr('disabled');
                toastr.success('Se agregó la comisión exitosamente');
                listadoComisiones(id_servicio);
                ActualizarAsignacion(id_servicio);
                BorrarComision();
                QuitarErroresComision();
            },
            error: function(data)
            {
                $('#btn-guardar-comision').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.id_admin)
                {
                    $("#usuario_comision_error").html(data.responseJSON.errors.id_admin);
                    $("#usuario_comision_error").fadeIn();
                }
                else
                {
                    $("#usuario_comision_error").fadeOut();
                }
                if (data.responseJSON.errors.monto)
                {
                    $("#monto_comision_usuario_error").html(data.responseJSON.errors.monto);
                    $("#monto_comision_usuario_error").fadeIn();
                }
                else
                {
                    $("#monto_comision_usuario_error").fadeOut();
                }
                if (data.responseJSON.errors.porcentaje_comision)
                {
                    $("#porcentaje_comision_error").html(data.responseJSON.errors.porcentaje_comision);
                    $("#porcentaje_comision_error").fadeIn();
                }
                else
                {
                    $("#porcentaje_comision_error").fadeOut();
                }
                if (data.responseJSON.errors.tipo_comision)
                {
                    $("#tipo_comision_error").html(data.responseJSON.errors.tipo_comision);
                    $("#tipo_comision_error").fadeIn();
                }
                else
                {
                    $("#tipo_comision_error").fadeOut();
                }
                
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                
            }
        });
    }
}

function EditarComision(id)
{
    $('#tipo_comision_input').removeAttr('hidden');
    $('#tipo_comision_select').attr('hidden', 'hidden');
    QuitarErroresComision();
    BorrarComision();

    route = '/admin/procesos/editar-comision/' + id;

    $.get(route, function(data)
    {
        console.log(data);
        //$('#tipo_comision').removeAttr('disabled');
        $('#tipo_comision_input_val').val(data.tipo_comision);
        $('#tipo_comision_val').val(data.tipo_comision);
        $('#usuario_comision').val(data.id_admin).change();

        if(data.tipo_comision == 'Venta')
        {
            $('#id_comision').val(data.id);
            $('#monto_disponible_comision').val(data.comision_venta_restante);
            $('#monto_comision_usuario').val(data.monto);
            $('#monto_comision_usuario').attr('max', data.max_venta);
            $('#monto_comision_usuario').attr('title', 'Monto máximo: ' + data.max_venta);
            $('#monto_max').val(data.max_venta);
            $('#monto_disponible_comision').val(data.max_venta);
            $('#monto_disponible_comision_val').val(data.max_venta);
            $('#monto_disponible_val').val(data.comision_venta);
            $('#listo_comision').val(data.listo_comision_venta);
            $('#porcentaje_comision').val(data.porcentaje_comision);
            $('#comentarios_comision').val(data.comentarios);
        }
        else if(data.tipo_comision == 'Gestión')
        {
            $('#id_comision').val(data.id);
            $('#monto_disponible_comision').val(data.comision_gestion_restante);
            $('#monto_comision_usuario').val(data.monto);
            $('#monto_comision_usuario').attr('max', data.max_gestion);
            $('#monto_comision_usuario').attr('title', 'Monto máximo: ' + data.max_gestion);
            $('#monto_max').val(data.max_gestion);
            $('#monto_disponible_comision').val(data.max_gestion);
            $('#monto_disponible_comision_val').val(data.max_gestion);
            $('#monto_disponible_val').val(data.comision_gestion);
            $('#listo_comision').val(data.listo_comision_gestion);
            $('#porcentaje_comision').val(data.porcentaje_comision);
            $('#comentarios_comision').val(data.comentarios);
        }
        else if(data.tipo_comision == 'Operativa')
        {
            $('#id_comision').val(data.id);
            $('#monto_disponible_comision').val(data.comision_operativa_restante);
            $('#monto_comision_usuario').val(data.monto);
            $('#monto_comision_usuario').attr('max', data.max_operativa);
            $('#monto_comision_usuario').attr('title', 'Monto máximo: ' + data.max_operativa);
            $('#monto_max').val(data.max_operativa);
            $('#monto_disponible_comision').val(data.max_operativa);
            $('#monto_disponible_comision_val').val(data.max_operativa);
            $('#monto_disponible_val').val(data.comision_operativa);
            $('#listo_comision').val(data.listo_comision_operativa);
            $('#porcentaje_comision').val(data.porcentaje_comision);
            $('#comentarios_comision').val(data.comentarios);
        }
    });
}

function ActualizarComision(id)
{
    $('#btn-guardar-comision').attr('disabled', 'disabled');
    monto = $('#monto_comision_usuario').val();
    monto_disponible = $('#monto_disponible_comision_val').val();
    porcentaje_comision = $('#porcentaje_comision').val();
    id_servicio = $('#id_servicio_menu').val();
    id_comision = $('#id_comision').val();

    monto = monto * 1;
    monto_disponible = monto_disponible * 1;
    porcentaje_comision = porcentaje_comision * 1;

    if(monto_disponible == 0)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
        $("#monto_disponible_comision_error").html('No hay monto disponible para generar comisión.');
        $("#monto_disponible_comision_error").fadeIn();
    }
    else if(monto_disponible < monto)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
        $("#monto_comision_usuario_error").html('El monto de la comisión no puede ser mayor al monto disponible');
        $("#monto_comision_usuario_error").fadeIn();
    }
    else if(porcentaje_comision > 100)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
        $("#porcentaje_comision_error").html('El porcentaje no puede ser mayor a 100%');
        $("#porcentaje_comision_error").fadeIn();
    }
    else
    {
        monto_restante = monto_disponible - monto;
        monto_restante = monto_restante * 1;

        $("#monto_comision_usuario_error").fadeOut();
        $("#porcentaje_comision_error").fadeOut();
        $("#monto_disponible_comision_error").fadeOut();

        var route = "/admin/procesos/actualizar-comision/" + id;
        var token = $("#_token").val();
        var formData = 
        {
            comentarios: $('#comentarios_comision').val(),
            monto,
            id_admin: $('#usuario_comision').val(),
            id_servicio,
            listo_comision: $('#listo_comision').val(),
            monto_restante,
            porcentaje_comision,
            monto_disponible,
            id_comision:id,
            tipo_comision:$('#tipo_comision_val').val()
        }
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
                $('#btn-guardar-comision').removeAttr('disabled');
                toastr.success('Se actualizó la comisión exitosamente');
                listadoComisiones(id_servicio);
                ActualizarAsignacion(id_servicio);
                BorrarComision();
                QuitarErroresComision();
                $('#tipo_comision_select').removeAttr('hidden');
                $('#tipo_comision_input').attr('hidden', 'hidden');

                if(id_comision == 0)
                {

                }
                else if(id_comision > 0)
                {
                    ActualizarComisionListado(id_comision);
                }

            },
            error: function(data)
            {
                $('#btn-guardar-comision').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.id_admin)
                {
                    $("#usuario_comision_error").html(data.responseJSON.errors.id_admin);
                    $("#usuario_comision_error").fadeIn();
                }
                else
                {
                    $("#usuario_comision_error").fadeOut();
                }
                if (data.responseJSON.errors.monto)
                {
                    $("#monto_comision_usuario_error").html(data.responseJSON.errors.monto);
                    $("#monto_comision_usuario_error").fadeIn();
                }
                else
                {
                    $("#monto_comision_usuario_error").fadeOut();
                }
                if (data.responseJSON.errors.porcentaje_comision)
                {
                    $("#porcentaje_comision_error").html(data.responseJSON.errors.porcentaje_comision);
                    $("#porcentaje_comision_error").fadeIn();
                }
                else
                {
                    $("#porcentaje_comision_error").fadeOut();
                }
                if (data.responseJSON.errors.tipo_comision)
                {
                    $("#tipo_comision_error").html(data.responseJSON.errors.tipo_comision);
                    $("#tipo_comision_error").fadeIn();
                }
                else
                {
                    $("#tipo_comision_error").fadeOut();
                }
                
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            }
        });
    }
}

function listadoComisiones(id_servicio)
{
    url = '/admin/comisiones/listadoComisiones/';

    $.ajax(
    {
        type: 'get',
        url: url + id_servicio,
        success: function(data)
        {
            $('#comisiones-listado').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });   

    var router = "/admin/comisiones/monto-restante/" + id_servicio;
    $.get(router, function(data)
    {
        $('#total_venta').html('$ ' + parseFloat(data.comision_venta, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#disponible_venta').html('$ ' + parseFloat(data.comision_venta_restante, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());

        $('#total_operativa').html('$ ' + parseFloat(data.comision_operativa, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#disponible_operativa').html('$ ' + parseFloat(data.comision_operativa_restante, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        
        $('#total_gestion').html('$ ' + parseFloat(data.comision_gestion, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#disponible_gestion').html('$ ' + parseFloat(data.comision_gestion_restante, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());

        if(data.aplica_comision_venta == 0)
        {
            $('#venta_habilitada').attr('hidden', 'hidden');
            $('#venta_habilitada_select').attr('hidden', 'hidden');
        }   
        else if(data.aplica_comision_venta == 1)
        {
            $('#venta_habilitada').removeAttr('hidden');
            $('#venta_habilitada_select').removeAttr('hidden');
        }

        if(data.aplica_comision_operativa == 0)
        {
            $('#operativa_habilitada').attr('hidden', 'hidden');
            $('#operativa_habilitada_select').attr('hidden', 'hidden');
        }   
        else if(data.aplica_comision_operativa == 1)
        {
            $('#operativa_habilitada').removeAttr('hidden');
            $('#operativa_habilitada_select').removeAttr('hidden');
        }

        if(data.aplica_comision_gestion == 0)
        {
            $('#gestion_habilitada').attr('hidden', 'hidden');
            $('#gestion_habilitada_select').attr('hidden', 'hidden');
        }   
        else if(data.aplica_comision_gestion == 1)
        {
            $('#gestion_habilitada').removeAttr('hidden');
            $('#gestion_habilitada_select').removeAttr('hidden');
        }
    });
}

function CancelarComision(id, id_servicio, monto, tipo_comision, comision_venta_restante, comision_gestion_restante, 
    comision_operativa_restante)
{
    $.confirm(
    {
        title: '¿Desea cancelar la comisión?',
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
                    route = '/admin/procesos/cancelar-comision/' + id;
                    token = $('#_token_comisiones');
                    formData = 
                    {
                        id, id_servicio, monto, tipo_comision, comision_venta_restante, comision_gestion_restante, 
                        comision_operativa_restante
                    }
                    //console.log(formData);

                    $.ajax(
                    {
                        url: route,
                        /*headers:
                        {
                            'X-CSRF-TOKEN': token
                        },*/ 
                        type: 'DELETE',
                        dataType: 'json',
                        data:formData,
                        success: function(data)
                        {
                            $('#btn-guardar-comision').removeAttr('disabled');
                            toastr.info('Se canceló la comisión exitosamente');
                            listadoComisiones(id_servicio);
                            ActualizarAsignacion(id_servicio);
                            BorrarComision();
                            QuitarErroresComision();
                            $('#tipo_comision_select').removeAttr('hidden');
                            $('#tipo_comision_input').attr('hidden', 'hidden');
                        },
                        error: function(data)
                        {
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

$('#btn-cancelar-comision').click(function()
{
    BorrarComision();
    QuitarErroresComision();
    $('#tipo_comision_select').removeAttr('hidden');
    $('#tipo_comision_input').attr('hidden', 'hidden');
});

function BorrarComision()
{
    $('#tipo_comision').val("").change();
    $('#monto_disponible_comision').val('');
    $('#monto_disponible_comision_val').val('');
    $('#monto_disponible_val').val('');
    $('#monto_max').val('');
    $('#usuario_comision').val("").change();
    $('#porcentaje_comision').val('');
    $('#monto_comision_usuario').val('');
    $('#listo_comision').val('0');
    $('#comentarios_comision').val('');
    $('#id_comision').val('');
    $('#aplica_repartir_comision_check').val('0');
    $('#aplica_repartir_comision').prop('checked', false);
}

function QuitarErroresComision()
{
    $("#usuario_comision_error").fadeOut();
    $("#monto_comision_usuario_error").fadeOut();
    $("#porcentaje_comision_error").fadeOut();
    $("#tipo_comision_error").fadeOut();
    $("#monto_disponible_comision_error").fadeOut();
    $("#monto_disponible_comision_error").fadeOut();
    $("#usuario_repartir_comision_error").fadeOut();
}




















































