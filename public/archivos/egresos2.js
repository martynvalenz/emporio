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
    $("#id_proveedor").change(Proveedor_change);
});

$("#tipo_todos").click(function()
{
    $("#tipo_egreso").val("todo");
    $("#titulo-egresos").html("Egresos Generales ");
    setTimeout(Listar, 300);
});
$("#tipo_despacho").click(function()
{
    $("#tipo_egreso").val("Despacho");
    $("#titulo-egresos").html("Egresos de Despacho ");
    setTimeout(Listar, 300);
    
});
$("#tipo_hogar").click(function()
{
    $("#tipo_egreso").val("Hogar");
    $("#titulo-egresos").html("Egresos de Hogar ");
    setTimeout(Listar, 300);
});
$("#tipo_personal").click(function()
{
    $("#tipo_egreso").val("Personal");
    $("#titulo-egresos").html("Egresos Personales ");
    setTimeout(Listar, 300);
});

$("#tipo_comision").click(function()
{
    $("#tipo_egreso").val("Comision");
    $("#titulo-egresos").html("Comisiones ");
    setTimeout(Listar, 300);
});

$("#tipo_ingreso").click(function()
{
    $("#tipo_egreso").val("Ingreso");
    $("#titulo-egresos").html("Ingresoes ");
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

$("#estatus_todo").click(function()
{
    $("#variable_estatus").val("todo");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-primary");
    $("#label-estatus").html("Todos");
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

$('#cuenta_select').on('change', function()
{
    Listar();
});

$('#formas_pago_select').on('change', function()
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
$(".btn-cerrar-actualizar").on("click", function(e)
{
    $('#menu').hide();
    e.preventDefault();
    Listar();
    BorrarFacturacion();
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
    var tipo;
    var cuenta;
    var seccion;
    estatus = $("#variable_estatus").val();
    tipo = $("#tipo_egreso").val();
    buscar = $("#buscar").val();
    cuenta = $("#cuenta_select").val();
    forma_pago = $("#formas_pago_select").val();
    seccion = $("#seccion").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    FechaRango = document.getElementById('reservation').value.split('  -  ');
    fecha_inicio = FechaRango[0];
    fecha_fin = FechaRango[1];

    //route = url_listar + estatus + '/' + fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59';
    //console.log(route);

    if(fecha_inicio == null)
    {
        $('#reservation_error').html('La fecha inicial no puede estar vacía');
        $('#reservation_error').fadeIn();
    }
    else if(fecha_fin == null)
    {
        $('#reservation_error').html('La fecha final no puede estar vacía');
        $('#reservation_error').fadeIn();
    }
    else if(fecha_inicio > fecha_fin)
    {
        $('#reservation_error').html('La fecha inicial no puede ser mayor a la fecha final');
        $('#reservation_error').fadeIn();
        ResetearFecha();
    }
    else
    {
        $('#reservation_error').fadeOut();
        if(seccion == 'Egresos')
        {
            if (buscar == '')
            {
                
                $.ajax(
                {
                    type: 'get',
                    url: url_listar + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
                    + '/' + fecha_inicio + '/' + fecha_fin,
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
                    url: url_buscar + estatus + '/' + tipo + '/' + cuenta + '/'  + forma_pago 
                    + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin,
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
        else if(seccion == 'CuentasPorPagar')
        {
            
        }
    }
}

$('#btn-exportar-estado').click(function()
{
    var estatus;
    var buscar;
    var tipo;
    var cuenta;
    var formas_pago;
    estatus = $("#variable_estatus").val();
    tipo = $("#tipo_egreso").val();
    buscar = $("#buscar").val();
    cuenta = $("#cuenta_select").val();
    forma_pago = $("#formas_pago_select").val();

    FechaRango = document.getElementById('reservation').value.split('  -  ');
    fecha_inicio = FechaRango[0];
    fecha_fin = FechaRango[1];

    //route = url_listar + estatus + '/' + fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59';
    //console.log(route);

    if(fecha_inicio == null)
    {
        $('#reservation_error').html('La fecha inicial no puede estar vacía');
        $('#reservation_error').fadeIn();
    }
    else if(fecha_fin == null)
    {
        $('#reservation_error').html('La fecha final no puede estar vacía');
        $('#reservation_error').fadeIn();
    }
    else if(fecha_inicio > fecha_fin)
    {
        $('#reservation_error').html('La fecha inicial no puede ser mayor a la fecha final');
        $('#reservation_error').fadeIn();
        ResetearFecha();
    }
    else
    {
        $('#reservation_error').fadeOut();
        route = '/admin/estados-cuenta-exportar/' + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
        + '/' + fecha_inicio + '/' + fecha_fin;
        window.open(route, '_blank');
    }
});

$('#btn-exportar-egresos').click(function()
{
    var estatus;
    var buscar;
    var tipo;
    var cuenta;
    var formas_pago;
    estatus = $("#variable_estatus").val();
    tipo = $("#tipo_egreso").val();
    buscar = $("#buscar").val();
    cuenta = $("#cuenta_select").val();
    forma_pago = $("#formas_pago_select").val();

    FechaRango = document.getElementById('reservation').value.split('  -  ');
    fecha_inicio = FechaRango[0];
    fecha_fin = FechaRango[1];

    //route = url_listar + estatus + '/' + fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59';
    //console.log(route);

    if(fecha_inicio == null)
    {
        $('#reservation_error').html('La fecha inicial no puede estar vacía');
        $('#reservation_error').fadeIn();
    }
    else if(fecha_fin == null)
    {
        $('#reservation_error').html('La fecha final no puede estar vacía');
        $('#reservation_error').fadeIn();
    }
    else if(fecha_inicio > fecha_fin)
    {
        $('#reservation_error').html('La fecha inicial no puede ser mayor a la fecha final');
        $('#reservation_error').fadeIn();
        ResetearFecha();
    }
    else
    {
        $('#reservation_error').fadeOut();
        route = '/admin/egresos-exportar/' + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
        + '/' + fecha_inicio + '/' + fecha_fin;
        window.open(route, '_blank');
    }
});

function ActualizarEgreso(id_egreso)
{
    url_actuailzar = $('#url_actualizar').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_actuailzar + id_egreso,
        success: function(data)
        {
            $('#egreso-' + id_egreso).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        }
    });   
}

function MostrarNuevo(id)
{
    url_nuevo = $('#url_actualizar').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_nuevo + id,
        success: function(data)
        {
            $('#list').append(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        }
    });  
}

$('#reservation').on('change', function()
{
    Listar();
});

function ResetearFecha()
{
    fecha_inicio = $('#fecha_inicio_reset').val();
    fecha_fin = $('#fecha_fin_reset').val();
    $('#reservation').val(fecha_inicio + '  -  ' + fecha_fin);
}

$("#btn-agregar-egreso").click(function()
{
    sesion = $("#id_sesion").val();
    if (sesion == '')
    {
        RecargarPagina();
    }
    else
    {
        CreateEgreso();
        BorrarCampos();
        QuitarErrores();
    }
});

function RecargarPagina()
{
    location.reload();
}

function Proveedor_change()
{
    Proveedor = document.getElementById('id_proveedor').value.split('_');
    id_proveedor = Proveedor[0];
    realiza_pagos = Proveedor[1];
    aplicar_servicios = 1;
    $('#aplicar_servicios').val(Proveedor[1]);
    $('#proveedor_val').val(Proveedor[0]);

    if(realiza_pagos == 1)
    {
        MostrarServiciosPendientes(realiza_pagos);
        $('#restante_div').removeAttr('hidden');
    }
    else
    {
        $('#servicios').empty();
        $('#restante_div').attr('hidden', true);
    }    
}


//Cuenta cobranza
$('#id_cuenta').on('change', function()
{
    id_cuenta = $("#id_cuenta").val();
    if (id_cuenta == '1')
    {
        $("#id_forma_pago").val("1").change();
    }
    else
    {
        $("#id_forma_pago").val("").change();
    }
});

$('#id_cliente_edit').on('change', function(e)
{
    //console.log(e);

    var id_cliente_edit = e.target.value;

    //ajax
    $.get('/admin/egresos/servicios-edit/' + id_cliente_edit, function(data)
    {
        //console.log(data);

            $('#id_servicio_edit').empty();
            $('#id_servicio_edit').append('<option value ="">--Sin selección--</option>');

        $.each(data, function(index, subcatObj)
        {

            $('#id_servicio_edit').append('<option value ="'+ subcatObj.id +'">'+subcatObj.clave+' '+subcatObj.servicio+' '+subcatObj.tramite+' '+subcatObj.clase+'</option>');

        });
    });
});


$('#con_iva').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#con_iva_checked").val(this.value);
}).change();

function CargarProveedores()
{
    var route = "/admin/egresos/proveedores/1";
    $.get(route, function(data)
    {
        $('#id_proveedor').empty();
        $('#id_proveedor').append('<option value ="">-Seleccionar proveedor-</option>');
        $.each(data, function(index, item)
        {
            $('#id_proveedor').append('<option value ="' + item.id + '_' + item.realiza_pagos + '">' + item.proveedor + 
                '</option>');
        });
        $('#id_proveedor').selectpicker('refresh');
    });
}

function CargarCategorias()
{
    var router = "/admin/egresos/categorias/1";
    $.get(router, function(data)
    {
        $.each(data, function(index, item)
        {
            $('#id_categoria').append('<option value ="' + item.id + '">' + item.categoria +
                '</option>');
        });
    });
}

//Botón para agregar o actualizar egreso
$('#btn-egreso').on('click', function()
{
    accion = $('#accion').val();
    aplicar_servicios = $('#aplicar_servicios').val();

    //console.log(accion);
    if(accion == 'Agregar')
    {
        if(aplicar_servicios == 1)
        {
            AgregarEgreso();
            setTimeout(cargarEgresoCreado, 300);
            EditarEgreso();

        }
        else if(aplicar_servicios == 0)
        {
            AgregarEgreso();
            BorrarCampos();
            //$("#egresos").modal('toggle');
        }
        
    }
    else if (accion == 'Editar')
    {
        if(aplicar_servicios == 1)
        {
            UpdateEgreso();
        }
        else if(aplicar_servicios == 0)
        {
            UpdateEgreso();
            BorrarCampos();
        }
    }
});

function CreateEgreso()
{
    $("#accion").val("Agregar");
    $("#egresos-title").html("Agregar Egreso");
    $('#encabezado').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-egreso").removeClass();
    $("#btn-egreso").toggleClass("btn btn-primary btn-flat");
    $("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Agregar");
    $('#fecha').datepicker().datepicker('setDate', 'today');
    $('#id_proveedor').empty();
    $('#id_categoria').empty();
    $('#id_categoria').append('<option value="">-Seleccionar categoría-</option>');
    CargarProveedores();
    $('#con_iva').prop('checked', true);
    $('#con_iva_checked').val(1);
    $('#tipo').empty();
    $('#tipo').append('<option value="" selected>-Seleccionar tipo-</option>'+
        '<option value="Despacho">Despacho</option><option value="Hogar">Hogar</option>'+
        '<option value="Personal">Personal</option>');
    $('#apagar_tipo').val('');
}

function EditarEgreso()
{
    //egreso = $('#id_egreso').val();
    $("#accion").val("Editar");
    $("#egresos-title").html("Editar Egreso "/* + egreso*/);
    $('#encabezado').css(
    {
        'background-color': '#EE8F14'
    });
    $("#btn-egreso").removeClass();
    $("#btn-egreso").toggleClass("btn btn-success btn-flat");
    $("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar");
    
}

function AgregarEgreso()
{
    var buscar = $("#buscar").val();
    var route = "/admin/procesos";
    var token = $("#_token_egresos").val();

    Proveedor = document.getElementById('id_proveedor').value.split('_')
    id_proveedor = Proveedor[0];
    realiza_pagos = Proveedor[1];

    var formData = {
        tipo: $('#tipo').val(),
        id_categoria: $('#id_categoria').val(),
        id_proveedor: id_proveedor,
        realiza_pagos: realiza_pagos,
        fecha: $('#fecha').val(),
        id_cuenta: $('#id_cuenta').val(),
        id_forma_pago: $('#id_forma_pago').val(),
        con_iva: $('#con_iva_checked').val(),
        total: $('#total').val(),
        retiro: $('#total').val(),
        porcentaje_iva: $('#porcentaje_iva').val(),
        cheque: $('#cheque').val(),
        movimiento: $('#movimiento').val(),
        concepto: $('#concepto').val(),
        id_admin: $('#id_admin_egreso').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/egresos/store',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se agregó el egreso exitosamente');
            MostrarNuevo(data.id);
            QuitarErrores();
            aplicar_servicios = $('#aplicar_servicios').val();
            if(aplicar_servicios == 0)
            {
                $('#egresos').modal('toggle');
            }
            
        },
        error: function(data)
        {
            QuitarErrores();
            console.log(data);
            if (data.responseJSON.errors.concepto)
            {
                $("#concepto_error").html(data.responseJSON.errors.concepto);
                $("#concepto_error").fadeIn();
            }
            else
            {
                $("#concepto_error").fadeOut();
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

            if (data.responseJSON.errors.id_categoria)
            {
                $("#id_categoria_error").html(data.responseJSON.errors.id_categoria);
                $("#id_categoria_error").fadeIn();
            }
            else
            {
                $("#id_categoria_error").fadeOut();
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

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_error").html(data.responseJSON.errors.fecha);
                $("#fecha_error").fadeIn();
            }
            else
            {
                $("#fecha_error").fadeOut();
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

            if (data.responseJSON.errors.retiro)
            {
                $("#total_error").html(data.responseJSON.errors.retiro);
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

function BorrarCampos()
{
    $('#tipo').val('').change();
    $('#id_categoria').empty();
    $('#id_categoria').append('<option value="">-Sin selección-</option>');
    $('#id_proveedor').val('').change();
    $('#fecha').datepicker().datepicker('setDate', 'today');
    $('#id_cuenta').val('').change();
    $('#id_forma_pago').val('').change();
    $("#con_factura").val("1").change();
    $('#con_factura').prop('checked', true);
    $("#con_factura_check").val("1");
    $("#total").val("0.00");
    $("#total_ant").val("0");
    $("#monto_restante").val("0.00");
    $("#monto_restante_val").val("0");
    $("#pagado").val("0");
    $("#cheque").val('');
    $("#movimiento").val('');
    $("#id_egreso").val('');
    $("#concepto").val('');
    $("#servicios").empty();
    $("#servicios-pagados").empty();
    $("#aplicar_servicios").val("0").change();
    $('#aplicar_servicios').prop('checked', false);
    $("#aplicar_servicios_check").val("0");
    //$("#servicios").empty();
    

}

function QuitarErrores()
{
    $("#concepto_error").fadeOut();
    $("#tipo_error").fadeOut();
    $("#id_categoria_error").fadeOut();
    $("#id_cuenta_error").fadeOut();
    $("#fecha_error").fadeOut();
    $("#id_forma_pago_error").fadeOut();
    $("#total_error").fadeOut();
    $('#restante_error').fadeOut();
}

function cargarEgresoCreado()
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/egreso-creado/1',
        success: function(data)
        {
            $('#id_egreso').val(data.id);
            $('#monto_restante').val('$ ' + parseFloat(data.restante, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());;
            $('#monto_restante_val').val(data.restante);
        }
    });
}

$(document).on('click','.btn-pagar-servicio', function()
{
    id_egreso = $('#id_egreso').val();
    fecha = $('#fecha').val();
    id_admin = $('#id_admin_egreso').val();
    restante = $('#monto_restante_val').val();
    pagado = $('#pagado').val();
    realiza_pagos = $('#aplicar_servicios').val();
    restante = restante * 1;
    pagado = pagado * 1;

    if(id_egreso == '' || id_egreso == null)
    {
        toastr.error('Genere primero el egreso para asignarle servicios');
    }
    else if(restante == 0)
    {
        $('#restante_error').html('El monto restante no puede ser 0');
        $('#restante_error').fadeIn();
    }
    else
    {
        var cells = $(this).closest("tr").children("td");
        var id_servicio = cells.eq(0).text();
        var id_control = cells.eq(1).text();
        var costo_servicio = cells.eq(3).text(); 
        total = costo_servicio * 1;

        if(costo_servicio > restante)
        {
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            $('#restante_error').html('El monto restante no puede ser menor al costo del servicio.');
            $('#restante_error').fadeIn();
        }
        else if( costo_servicio <= restante)
        {
            $('#restante_error').fadeOut();
            InsertarServicio(id_servicio, id_control, total, id_egreso, restante, fecha, id_admin, realiza_pagos, pagado);
        }
        
    }  
});



function InsertarServicio(id_servicio, id_control, total, id_egreso, restante, fecha, id_admin, realiza_pagos, pagado)
{
    var token = $("#_token_egresos").val();

    var formData = 
    {
        id_servicio, id_control, total, id_egreso, restante, fecha, id_admin, pagado
    }
    //console.log(formData);
    
    $.ajax(
    {
        url: '/admin/egresos/insertar-servicio',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se agregó el servicio al pago exitosamente');
            ActualizarEgreso(id_egreso);
            QuitarErrores();
            MostrarServiciosPendientes(realiza_pagos);
            ServiciosAplicados(realiza_pagos);
            restante = restante - total;
            $('#monto_restante_val').val(restante);
            $('#monto_restante').val('$ ' + parseFloat(restante, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());;
            
        },
        error: function(data)
        {
            QuitarErrores();
            console.log(data);

            if (data.responseJSON.errors.fecha)
            {
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                $("#fecha_error").html(data.responseJSON.errors.fecha);
                $("#fecha_error").fadeIn();
            }
            else
            {
                $("#fecha_error").fadeOut();
            }

            if (data.responseJSON.errors.id_admin)
            {
                toastr.error('La sesión de usuario ha expirado, refresque el navegador para volver a iniciar sesión.');
            }

            if (data.responseJSON.errors.total)
            {
                toastr.error('El monto es incorrecto.');
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');  
            
            console.clear();
        }
    });
}

function MostrarServiciosPendientes(aplica_servicios)
{
    if(aplica_servicios == 1)
    {
        $.ajax(
        {
            type: 'get',
            url: '/admin/egresos-mostrar-servicios/' + aplica_servicios,
            success: function(data)
            {
                $('#servicios').empty().html(data);
            }
        });
    }
    else
    {
        $('#servicios').empty();
    }
}

function ServiciosAplicados(aplica_servicios)
{
    id_egreso = $('#id_egreso').val();

    if(id_egreso == '')
    {

    }
    else
    {
        if(aplica_servicios == 1)
        {
            $.ajax(
            {
                type: 'get',
                url: '/admin/egresos-mostrar-pagados/' + id_egreso,
                success: function(data)
                {
                    $('#servicios-pagados').empty().html(data);
                }
            });
        }
        else
        {
            $('#servicios-pagados').empty();
        }
    }
}

var Edit = function(id)
{
    EditarEgreso();
    var router = "/admin/egreso/" + id + "/edit";
    
    $.get(router, function(data)
    {
        $('#apagar_tipo').val(data.id);
        //console.log(data);
        $('#id_egreso').val(data.id);
        $("#egresos-title").html("Editar egreso: " + data.id);
        $('#tipo').empty();
        $('#tipo').append('<option value="" selected>-Seleccionar tipo-</option>'+
            '<option value="Despacho">Despacho</option><option value="Hogar">Hogar</option>'+
            '<option value="Personal">Personal</option>');
        $('#tipo').val(data.tipo).change();
        $('#id_categoria').val(data.id_categoria).change();
        $('#aplicar_servicios').val(data.realiza_pagos);
        $('#proveedor_val').val(data.id_proveedor);
        $('#fecha').val(data.fecha);
        $('#id_cuenta').val(data.id_cuenta).change();
        $('#id_forma_pago').val(data.id_forma_pago).change();
        $('#porcentaje_iva').val(data.porcentaje_iva);
        $('#total').val(data.retiro);
        $('#total_ant').val(data.retiro);
        $('#monto_restante').val(data.restante);
        $('#monto_restante_val').val(data.restante);
        $('#pagado').val(data.pagado);
        $('#cheque').val(data.cheque);
        $('#movimiento').val(data.movimiento);
        $('#concepto').val(data.concepto);

        if (data.con_iva == 1)
        {
            $("#con_iva").val("1").change();
            $('#con_iva').prop('checked', true);
            $("#con_iva_checked").val("1");
        }
        else if (data.con_iva == 0)
        {
            $("#con_iva").val("0").change();
            $('#con_iva').prop('checked', false);
            $("#con_iva_checked").val("0");
        }

        $('#id_proveedor').empty();
        $('#id_proveedor').append('<option selected value="' + data.id_proveedor + '_' + data.realiza_pagos + '">' + 
            data.proveedor +
            '</option><option value="">-------------------------</option>');
        
        var route = "/admin/egresos/proveedores/1";
        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#id_proveedor').append('<option value ="' + item.id + '_' + item.realiza_pagos + '">' + item.proveedor +
                    '</option>');
            });
            $('#id_proveedor').selectpicker('refresh');
        });
        

        /*$.get('/admin/egresos/categorias-egresos/' + data.tipo, function(data)
        {
            $.each(data, function(index, subcatObj)
            {

                $('#id_categoria').append('<option value ="'+ subcatObj.id +'">'+subcatObj.categoria+
                  '</option>');

            });
        });*/

        $('#id_categoria').prepend('<option selected value="' + data.id_categoria + '">' + data.categoria +
            '</option><option value="">-------------------------</option>');

        $('#apagar_tipo').val('');

        MostrarServiciosPendientes(data.realiza_pagos);
        ServiciosAplicados(data.realiza_pagos);

        if(data.realiza_pagos == 1)
        {
            $('#restante_div').removeAttr('hidden');
        }
        else
        {
            $('#servicios').empty();
            $('#restante_div').attr('hidden', true);
        } 
    }); 
}

$('#tipo').on('change', function()
{
    //console.log(e);
    var tipo = $(this).val();
    var apagar = $('#apagar_tipo').val();
    cargarCategorias2(tipo, apagar);
});

function cargarCategorias2(tipo, apagar)
{
    if(tipo == '')
    {
        $('#id_categoria').empty();
        $('#id_categoria').append('<option value ="">-Sin opción-</option>');
    }
    else if(apagar > 0)
    {
        $.get('/admin/egresos/categorias-egresos/' + tipo, function(data)
        {

            $.each(data, function(index, subcatObj)
            {

                $('#id_categoria').append('<option value ="'+ subcatObj.id +'">'+subcatObj.categoria+
                  '</option>');

            });
        });
    }
    else if(apagar == 0 || apagar == '')
    {
        //ajax
        $.get('/admin/egresos/categorias-egresos/' + tipo, function(data)
        {
            $('#id_categoria').empty();
            $('#id_categoria').append('<option value ="">-Seleccionar categoría-</option>');

            $.each(data, function(index, subcatObj)
            {

                $('#id_categoria').append('<option value ="'+ subcatObj.id +'">'+subcatObj.categoria+
                  '</option>');

            });
        });
    }
}

function UpdateEgreso()
{
    var token = $("#_token_egresos").val();
    var route = '/admin/egresos/update/';
    var id_egreso = $('#id_egreso').val();

    total = $('#total').val();
    total = total * 1;
    total_ant = $('#total_ant').val();
    total_ant = total_ant * 1;
    pagado = $('#pagado').val();
    pagado = pagado * 1;

    if(total < pagado)
    {
        $('#total_error').html('El monto total no puede ser menor al monto utilizado en los costos de servicios.');
        $('#total_error').fadeIn();
        $('#total').val(total_ant);
    }
    else
    {
        var formData = {
            tipo: $('#tipo').val(),
            id_categoria: $('#id_categoria').val(),
            id_proveedor: $('#proveedor_val').val(),
            fecha: $('#fecha').val(),
            id_cuenta: $('#id_cuenta').val(),
            id_forma_pago: $('#id_forma_pago').val(),
            con_iva: $('#con_iva_checked').val(),
            total: $('#total').val(),
            retiro: $('#total').val(),
            total_ant: $('#total_ant').val(),
            restante: $('#monto_restante_val').val(),
            pagado: $('#pagado').val(),
            porcentaje_iva: $('#porcentaje_iva').val(),
            cheque: $('#cheque').val(),
            movimiento: $('#movimiento').val(),
            concepto: $('#concepto').val(),
            id_admin: $('#id_admin_egreso').val()
        }
        //console.log(formData);
        $.ajax(
        {
            url: route + id_egreso,
            headers:
            {
                'X-CSRF-TOKEN': token
            },
            type: 'PUT',
            dataType: 'json',
            data: formData,
            success: function(data)
            {
                restante = total - pagado;
                $('#monto_restante').val(restante);
                $('#monto_restante_val').val(restante);
                toastr.success('Se agregó el egreso exitosamente');
                ActualizarEgreso(id_egreso);
                QuitarErrores();
                aplicar_servicios = $('#aplicar_servicios').val();
                if(aplicar_servicios == 0)
                {
                    $('#egresos').modal('toggle');
                }
                
            },
            error: function(data)
            {
                QuitarErrores();
                console.log(data);
                if (data.responseJSON.errors.concepto)
                {
                    $("#concepto_error").html(data.responseJSON.errors.concepto);
                    $("#concepto_error").fadeIn();
                }
                else
                {
                    $("#concepto_error").fadeOut();
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

                if (data.responseJSON.errors.id_categoria)
                {
                    $("#id_categoria_error").html(data.responseJSON.errors.id_categoria);
                    $("#id_categoria_error").fadeIn();
                }
                else
                {
                    $("#id_categoria_error").fadeOut();
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

                if (data.responseJSON.errors.fecha)
                {
                    $("#fecha_error").html(data.responseJSON.errors.fecha);
                    $("#fecha_error").fadeIn();
                }
                else
                {
                    $("#fecha_error").fadeOut();
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

                if (data.responseJSON.errors.retiro)
                {
                    $("#total_error").html(data.responseJSON.errors.retiro);
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

    
}

$("#egresos").on("hidden.bs.modal", function()
{
    $('#apagar_tipo').val('');
    $('#id_categoria').empty();
});



//Categorías
function AgregarCategoria()
{
    tipo = $('#tipo').val();
    QuitarErroresCategoria();

    if(tipo == '')
    {
        $('#tipo_categoria').val('sinSeleccion');
        $('#clasificacion').val('').change();
    }
    else
    {
        $('#tipo_categoria').val('Seleccionado');
        $('#clasificacion').val(tipo).change();
    }

    $('#categoria_agregar').val('');
    $('#descripcion_categoria').val('');
}

$('#btn-guardar-categoria').click(function()
{
    tipo_categoria = $('#tipo_categoria').val();
    clasificacion = $('#clasificacion').val();
    categoria = $('#categoria_agregar').val();
    descripcion = $('#descripcion_categoria').val();
    apagar = $('#apagar_tipo').val();
    token = $('#_token_egresos').val();

    var formData = {
        clasificacion, categoria, descripcion
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/egreso/agregarCategoria',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se agregó la categoría exitosamente');
            QuitarErroresCategoria();
            if(tipo_categoria == 'sinSeleccion')
            {
                $('#agregar-categoria').modal('toggle');
                $('#tipo').val(clasificacion).change();
            }
            else if(tipo_categoria == 'Seleccionado')
            {
                $('#agregar-categoria').modal('toggle');
                cargarCategorias2(clasificacion, apagar);
            }
            
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.clasificacion)
            {
                $("#clasificacion_error").html(data.responseJSON.errors.clasificacion);
                $("#clasificacion_error").fadeIn();
            }
            else
            {
                $("#clasificacion_error").fadeOut();
            }

            if (data.responseJSON.errors.categoria)
            {
                $("#categoria_agregar_error").html(data.responseJSON.errors.categoria);
                $("#categoria_agregar_error").fadeIn();
            }
            else
            {
                $("#categoria_agregar_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, tal vez intentó ingresar una categoría existente o faltan campos de llenar.');
            
            //console.clear();
        }
    });
});

$('.btn-categoria-cerrar').click(function()
{
    $('#agregar-categoria').modal('toggle');
    var tipo = $('#tipo').val();
    var apagar = $('#apagar_tipo').val();
    cargarCategorias2(tipo, apagar);

});

function QuitarErroresCategoria()
{
    $("#clasificacion_error").fadeOut();
    $("#categoria_agregar_error").fadeOut();
}

function AgregarProveedor()
{
    $("#nombre_comercial_error").fadeOut();
    $('#nombre_comercial').val('');
}

$('.btn-proveedor-cerrar').click(function()
{
    $('#modal-proveedor').modal('toggle');
});

$('#btn-guardar-proveedor').click(function()
{
    nombre_comercial = $('#nombre_comercial').val();
    token = $('#_token_egresos').val();

    var formData = {
        nombre_comercial, id_admin: $('#id_admin_egreso').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/egreso/agregarProveedor',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se agregó el proveedor exitosamente');
            $("#nombre_comercial_error").fadeOut();
            //$('#id_proveedor').prepend('<option id="'+data.id+'" selected>'+data.nombre_comercial+'</option>');
            CargarProveedores();
            $('#nombre_comercial').val('');
            $('#modal-proveedor').modal('toggle');
            
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.nombre_comercial)
            {
                $("#nombre_comercial_error").html(data.responseJSON.errors.nombre_comercial);
                $("#nombre_comercial_error").fadeIn();
            }
            else
            {
                $("#nombre_comercial_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, tal vez intentó ingresar un proveedor existente o faltan campos de llenar.');
            
            //console.clear();
        }
    });
});

function CancelarEgreso(id)
{
    $.confirm(
    {
        title: '¿Desea cancelar el egreso?',
        content: '',
        autoClose: 'Cerrar|8000',
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
                    router = '/admin/cuentas-por-pagar/cancelar/' + id;
                    token = $('#_token_egresos');

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data)
                        {
                            ActualizarEgreso(data.id);
                            toastr.info('Se canceló el egreso satisfactoriamente');
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

function ActivarEgreso(id, total, pagado_boolean)
{
    var formData ={
        total:total, pagado_boolean:pagado_boolean
    }

    $.confirm(
    {
        title: '¿Desea activar el egreso?',
        content: '',
        autoClose: 'Cerrar|8000',
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
                    router = '/admin/cuentas-por-pagar/activar/' + id;
                    token = $('#_token_egresos');

                    $.ajax(
                    {
                        url: router,
                        type: 'PUT',
                        dataType: 'json',
                        data:formData,
                        success: function(data)
                        {
                            ActualizarEgreso(data.id);
                            toastr.info('Se activó el egreso satisfactoriamente');
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

function PendienteEgreso(id)
{
    $.confirm(
    {
        title: '¿Desea pasar el egreso a estatus de pendiente de pago?',
        content: '',
        autoClose: 'Cerrar|8000',
        buttons: 
        {
            Cerrar: function () 
            {
                //$.alert('action is canceled');
            },
            deleteUser: 
            {
                text: 'Pendiente',
                btnClass: 'btn-orange any-other-class',
                action: function () 
                {
                    router = '/admin/cuentas-por-pagar/pendiente/' + id;
                    token = $('#_token_egresos');

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data)
                        {
                            ActualizarEgreso(data.id);
                            toastr.warning('Se pasó el egreso a estatus de pendiente.');
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


///Pagar

function Pagar(id)
{
    QuitarErroresPago();
    var router = "/admin/egreso/" + id + "/edit";
    $('#btn-pagar').removeAttr('disabled');
    
    //console.log(router);
    $.get(router, function(data)
    {
        $('#id_egreso_pagar').val(data.id);
        $(".modal-title").html("Pagar egreso: " + data.id);
        $('.modal-header').css(
        {
            'background-color': '#4EA75B'
        });
        $("#btn-egreso").removeClass();
        $("#btn-egreso").toggleClass("btn btn-warning btn-flat");
        $("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar");

        $('#created_at').val(data.created_at);
        $('#updated_at').val(data.updated_at);
        $('#categoria_pagar').val(data.categoria);
        $('#tipo_pagar').val(data.tipo);
        $('#proveedor_pagar').val(data.proveedor);
        $('#porcentaje_iva_pagar').val(data.porcentaje_iva);
        $('#total_pagar').val(data.total);
        $('#concepto_pagar').val(data.concepto);
        $("#con_iva_pagar").val(data.con_iva).change(); 
        $('#fecha_pagar').datepicker().datepicker('setDate', 'today');
    }); 
}

$('#btn-pagar').click(function()
{
    $('#btn-pagar').attr('disabled', 'disabled');
    var token = $("#_token").val();

    var id = $('#id_egreso_pagar').val();

    var formData = {
        id_cuenta: $('#id_cuenta_pagar').val(),
        id_forma_pago: $('#id_forma_pago_pagar').val(),
        fecha: $('#fecha_pagar').val(),
        con_iva: $('#con_iva_pagar').val(),
        total: $('#total_pagar').val(),
        porcentaje_iva: $('#porcentaje_iva_pagar').val(),
        concepto: $('#concepto_pagar').val(),
        id_admin: $('#id_sesion').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/cuentas-por-pagar/pagar/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se pagó el egreso exitosamente');
            ActualizarEgreso(data.id);
            QuitarErroresPago();
            BorrarPago();
            $('#modal-pagar').modal('toggle');
            $('#btn-pagar').removeAttr('disabled');
            
        },
        error: function(data)
        {
            $('#btn-pagar').removeAttr('disabled');
            //QuitarErrores();
            console.log(data);
            if (data.responseJSON.errors.id_forma_pago)
            {
                $("#id_forma_pago_pagar_error").html(data.responseJSON.errors.id_forma_pago);
                $("#id_forma_pago_pagar_error").fadeIn();
            }
            else
            {
                $("#id_forma_pago_pagar_error").fadeOut();
            }

            if (data.responseJSON.errors.id_cuenta)
            {
                $("#id_cuenta_pagar_error").html(data.responseJSON.errors.id_cuenta);
                $("#id_cuenta_pagar_error").fadeIn();
            }
            else
            {
                $("#id_cuenta_pagar_error").fadeOut();
            }

            if (data.responseJSON.errors.porcentaje_iva)
            {
                $("#porcentaje_iva_pagar_error").html(data.responseJSON.errors.porcentaje_iva);
                $("#porcentaje_iva_pagar_error").fadeIn();
            }
            else
            {
                $("#porcentaje_iva_pagar_error").fadeOut();
            }

            if (data.responseJSON.errors.total)
            {
                $("#total_pagar_error").html(data.responseJSON.errors.total);
                $("#total_pagar_error").fadeIn();
            }
            else
            {
                $("#total_pagar_error").fadeOut();
            }

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_pagar_error").html(data.responseJSON.errors.fecha);
                $("#fecha_pagar_error").fadeIn();
            }
            else
            {
                $("#fecha_pagar_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            console.clear();
        }
    });
});

function QuitarErroresPago()
{
    $("#id_forma_pago_pagar_error").fadeOut();
    $("#id_cuenta_pagar_error").fadeOut();
    $("#porcentaje_iva_pagar_error").fadeOut();
    $("#total_pagar_error").fadeOut();
    $("#fecha_pagar_error").fadeOut();
}

function BorrarPago()
{
    $('#created_at').val('');
    $('#updated_at').val('');
    $('#tipo_pagar').val('');
    $('#categoria_pagar').val('');
    $('#proveedor_pagar').val('');
    $('#id_cuenta_pagar').val('').change();
    $('#id_forma_pago_pagar').val('').change();
    $('#fecha_pagar').datepicker().datepicker('setDate', 'today');
    $('#con_iva_pagar').val('1').change();
    $('#total_pagar').val('');
    $('#porcentaje_iva_pagar').val('');
    $('#concepto_pagar').val('');
}

$("#modal-pagar").on("hidden.bs.modal", function()
{
    BorrarPago();
});

$('#id_cuenta_pagar').on('change', function()
{
    id_cuenta = $(this).val();

    if(id_cuenta == 1)
    {
        $('#id_forma_pago_pagar').val('1').change();
    }
    else
    {
        //
    }
});


//Tarjetas de crédito
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------

$('#id_cuenta_pendiente').on('change', function()
{
    id_cuenta = $(this).val();
    restante = $('#monto_restante_tarjeta_val').val();

    //$('#id_cuenta_pendiente').val(id_cuenta).change();
    if(id_cuenta == '')
    {
        $('#servicios_tarjeta').empty();
    }
    else
    {
        MostrarTarjetaPendientes(id_cuenta, restante);    
    }
    
});

function MostrarTarjetaPendientes(id_cuenta, restante)
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/egresos/tarjeta-credito/pendientes/' + id_cuenta + '/' + restante,
        success: function(data)
        {
            $('#servicios_tarjeta').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

function MostrarTarjetaPagados(id_egreso)
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/egresos/tarjeta-credito/pagados/' + id_egreso,
        success: function(data)
        {
            $('#servicios-pagados_tarjeta').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

function CreateTarjeta()
{
    $("#egresos-title_tarjeta").html("Pagar tarjeta de crédito");
    $('#encabezado_tarjeta').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-tarjeta").removeClass();
    $("#btn-tarjeta").toggleClass("btn btn-primary btn-flat");
    $("#btn-tarjeta").html("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar");
    BorrarCamposTarjeta();
    QuitarErroresTarjeta();
}

function EditTarjeta(id)
{
    QuitarErroresTarjeta();
    $("#id_egreso_tarjeta").val(id);
    $("#egresos-title_tarjeta").html("Editar Egreso: " + id);
    $('#encabezado_tarjeta').css(
    {
        'background-color': '#EE8F14'
    });
    $("#btn-tarjeta").removeClass();
    $("#btn-tarjeta").toggleClass("btn btn-success btn-flat");
    $("#btn-tarjeta").html("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar");
    MostrarTarjetaPagados(id);
    
    var router = "/admin/egreso/" + id + "/edit";
    //console.log(router);
    $.get(router, function(data)
    {
        //console.log(data);
        $('#tipo_tarjeta').val(data.tipo).change();
        $('#fecha_tarjeta').val(data.fecha);
        $('#id_cuenta_tarjeta').val(data.id_cuenta).change();
        $('#id_forma_pago_tarjeta').val(data.id_forma_pago).change();
        $('#porcentaje_iva_tarjeta').val(data.porcentaje_iva);
        $('#total_tarjeta').val(data.retiro);
        $('#total_tarjeta_ant').val(data.retiro);
        $('#iva_tarjeta_ant').val(data.iva);
        $('#subtotal_tarjeta_ant').val(data.subtotal);
        $('#monto_restante_tarjeta').val(data.restante);
        $('#monto_restante_tarjeta_val').val(data.restante);
        $('#pagado_tarjeta').val(data.pagado);
        $('#pagado_tarjeta_show').val(data.pagado);
        $('#cheque_tarjeta').val(data.cheque);
        $('#movimiento_tarjeta').val(data.movimiento);
        $('#concepto_tarjeta').val(data.concepto);
    });
}

$('#btn-tarjeta').click(function()
{
    id_egreso = $('#id_egreso_tarjeta').val();
    total = $('#total_tarjeta').val();
    pagado = $('#pagado_tarjeta').val();

    total = total * 1;
    pagado = pagado * 1;

    console.log(total);
    console.log(pagado);

    if(id_egreso == '')
    {
        StoreTarjeta();
    }
    else 
    {
        if(total < pagado)
        {
            $('#total_tarjeta_error').html('El monto total no puede ser menor al monto pagado.');
            $('#total_tarjeta_error').fadeIn();
        }
        else
        {
            $('#total_tarjeta_error').fadeOut();
            UpdateTarjeta(id_egreso);
        }
    }
});

function StoreTarjeta()
{
    $('#btn-tarjeta').attr('disabled', 'disabled');
    var token = $("#_token").val();
    var id_cuenta_pendiente = $('#id_cuenta_pendiente').val();

    var formData = {
        tipo: $('#tipo_tarjeta').val(),
        id_categoria: $('#id_categoria_tarjeta').val(),
        fecha: $('#fecha_tarjeta').val(),
        id_cuenta: $('#id_cuenta_tarjeta').val(),
        id_forma_pago: $('#id_forma_pago_tarjeta').val(),
        retiro: $('#total_tarjeta').val(),
        total: '0',
        porcentaje_iva: $('#porcentaje_iva_tarjeta').val(),
        cheque: $('#cheque_tarjeta').val(),
        movimiento: $('#movimiento_tarjeta').val(),
        concepto: $('#concepto_tarjeta').val(),
        id_admin: $('#id_sesion').val(),
        con_iva:'0'
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/egresos/store',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            $('#btn-tarjeta').removeAttr('disabled');
            toastr.success('Se agregó el egreso exitosamente');

            if(id_cuenta_pendiente == '')
            {
                $('#servicios_tarjeta').empty();
            }
            else
            {
                MostrarTarjetaPendientes(id_cuenta_pendiente, data.restante);
            }
            
            MostrarNuevo(data.id);
            MostrarTarjetaPagados(data.id);
            QuitarErroresTarjeta();
            $('#id_egreso_tarjeta').val(data.id);
            $('#total_tarjeta_ant').val(data.total);
            $('#porcentaje_iva_tarjeta').val(data.porcentaje_iva);
            $('#monto_restante_tarjeta').val(data.restante);
            $('#monto_restante_tarjeta_val').val(data.restante);
            $('#pagado_tarjeta').val(data.pagado);
            $('#pagado_tarjeta_show').val(data.pagado);
            
        },
        error: function(data)
        {
            $('#btn-tarjeta').removeAttr('disabled');
            QuitarErroresTarjeta();
            console.log(data);

            if (data.responseJSON.errors.tipo)
            {
                $("#tipo_tarjeta_error").html(data.responseJSON.errors.tipo);
                $("#tipo_tarjeta_error").fadeIn();
            }
            else
            {
                $("#tipo_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.id_categoria)
            {
                $("#id_categoria_tarjeta_error").html(data.responseJSON.errors.id_categoria);
                $("#id_categoria_tarjeta_error").fadeIn();
            }
            else
            {
                $("#id_categoria_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.id_cuenta)
            {
                $("#id_cuenta_tarjeta_error").html(data.responseJSON.errors.id_cuenta);
                $("#id_cuenta_tarjeta_error").fadeIn();
            }
            else
            {
                $("#id_cuenta_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_tarjeta_error").html(data.responseJSON.errors.fecha);
                $("#fecha_tarjeta_error").fadeIn();
            }
            else
            {
                $("#fecha_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.id_forma_pago)
            {
                $("#id_forma_pago_tarjeta_error").html(data.responseJSON.errors.id_forma_pago);
                $("#id_forma_pago_tarjeta_error").fadeIn();
            }
            else
            {
                $("#id_forma_pago_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.total)
            {
                $("#total_tarjeta_error").html(data.responseJSON.errors.total);
                $("#total_tarjeta_error").fadeIn();
            }
            else
            {
                $("#total_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.retiro)
            {
                $("#total_tarjeta_error").html(data.responseJSON.errors.retiro);
                $("#total_tarjeta_error").fadeIn();
            }
            else
            {
                $("#total_tarjeta_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            console.clear();
        }
    });
}

function UpdateTarjeta(id)
{
    $('#btn-tarjeta').attr('disabled', 'disabled');
    var token = $("#_token").val();
    var id_cuenta_pendiente = $('#id_cuenta_pendiente').val();

    var formData = {
        tipo: $('#tipo_tarjeta').val(),
        id_categoria: $('#id_categoria_tarjeta').val(),
        fecha: $('#fecha_tarjeta').val(),
        id_cuenta: $('#id_cuenta_tarjeta').val(),
        id_forma_pago: $('#id_forma_pago_tarjeta').val(),
        retiro: $('#total_tarjeta').val(),
        total: '0',
        pagado: $('#pagado_tarjeta').val(),
        porcentaje_iva: $('#porcentaje_iva_tarjeta').val(),
        cheque: $('#cheque_tarjeta').val(),
        movimiento: $('#movimiento_tarjeta').val(),
        concepto: $('#concepto_tarjeta').val(),
        id_admin: $('#id_sesion').val(),
        con_iva:'0'
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/egresos/update/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            $('#btn-tarjeta').removeAttr('disabled');
            toastr.success('Se agregó el egreso exitosamente');

            if(id_cuenta_pendiente == '')
            {
                $('#servicios_tarjeta').empty();
            }
            else
            {
                MostrarTarjetaPendientes(id_cuenta_pendiente, data.restante);
            }

            ActualizarEgreso(data.id);
            MostrarTarjetaPagados(data.id);
            QuitarErroresTarjeta();
            $('#id_egreso_tarjeta').val(data.id);
            $('#total_tarjeta_ant').val(data.total);
            $('#porcentaje_iva_tarjeta').val(data.porcentaje_iva);
            $('#monto_restante_tarjeta').val(data.restante);
            $('#monto_restante_tarjeta_val').val(data.restante);
            $('#pagado_tarjeta').val(data.pagado);
            $('#pagado_tarjeta_show').val(data.pagado);
            
        },
        error: function(data)
        {
            $('#btn-tarjeta').removeAttr('disabled');
            QuitarErroresTarjeta();
            console.log(data);

            if (data.responseJSON.errors.tipo)
            {
                $("#tipo_tarjeta_error").html(data.responseJSON.errors.tipo);
                $("#tipo_tarjeta_error").fadeIn();
            }
            else
            {
                $("#tipo_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.id_categoria)
            {
                $("#id_categoria_tarjeta_error").html(data.responseJSON.errors.id_categoria);
                $("#id_categoria_tarjeta_error").fadeIn();
            }
            else
            {
                $("#id_categoria_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.id_cuenta)
            {
                $("#id_cuenta_tarjeta_error").html(data.responseJSON.errors.id_cuenta);
                $("#id_cuenta_tarjeta_error").fadeIn();
            }
            else
            {
                $("#id_cuenta_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_tarjeta_error").html(data.responseJSON.errors.fecha);
                $("#fecha_tarjeta_error").fadeIn();
            }
            else
            {
                $("#fecha_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.id_forma_pago)
            {
                $("#id_forma_pago_tarjeta_error").html(data.responseJSON.errors.id_forma_pago);
                $("#id_forma_pago_tarjeta_error").fadeIn();
            }
            else
            {
                $("#id_forma_pago_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.total)
            {
                $("#total_tarjeta_error").html(data.responseJSON.errors.total);
                $("#total_tarjeta_error").fadeIn();
            }
            else
            {
                $("#total_tarjeta_error").fadeOut();
            }

            if (data.responseJSON.errors.retiro)
            {
                $("#total_tarjeta_error").html(data.responseJSON.errors.retiro);
                $("#total_tarjeta_error").fadeIn();
            }
            else
            {
                $("#total_tarjeta_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            //console.clear();
        }
    });
}

$(document).on('click','.btn-agregar-tarjeta', function()
{
    $('.btn-agregar-tarjeta').attr('disabled', 'disabled');

    id = $('#id_egreso_tarjeta').val();
    restante = $('#monto_restante_tarjeta_val').val();
    fecha = $('#fecha_tarjeta').val();
    total_ant = $('#total_tarjeta_ant').val();
    iva_ant = $('#iva_tarjeta_ant').val();
    subtotal_ant = $('#subtotal_tarjeta_ant').val();
    id_admin = $('#id_sesion').val();

    var cells = $(this).closest("tr").children("td");
    var id_tarjeta = cells.eq(0).text();
    var id_cuenta = cells.eq(1).text();
    var saldo = cells.eq(8).text();
    var pagado = cells.eq(9).text();
    var total_tarjeta = cells.eq(10).text();
    var subtotal = cells.eq(11).text();
    var iva = cells.eq(12).text();
    var pagado_ant = cells.eq(13).text();

    saldo = saldo * 1;
    pagado = pagado * 1;
    pagado_ant = pagado_ant * 1;
    restante = restante * 1;

    if(pagado == 0)
    {
        toastr.error('No hay monto restante disponible para asignar pagos.');
        $("#restante_tarjeta_error").html('No hay monto restante disponible para asignar pagos.');
        $("#restante_tarjeta_error").fadeIn();
        $('.btn-agregar-tarjeta').removeAttr('disabled');
    }
    else if(pagado > restante)
    {
        toastr.error('El monto total no puede ser mayor al monto restante del egreso.');
        $("#restante_tarjeta_error").html('El monto total no puede ser mayor al monto restante del egreso');
        $("#restante_tarjeta_error").fadeIn();
        $('.btn-agregar-tarjeta').removeAttr('disabled');
    }
    else if(pagado > saldo)
    {
        toastr.error('El monto total debe ser igual o menor al monto pendiente del egreso');
        $('.btn-agregar-tarjeta').removeAttr('disabled');
    }
    else
    {
        PagarTarjetaCredito(id, restante, fecha, total_ant, iva_ant, subtotal_ant, id_tarjeta, id_cuenta,
    saldo, pagado, total_tarjeta, iva, subtotal, pagado_ant, id_admin);
    }
});

function PagarTarjetaCredito(id, restante, fecha, total_ant, iva_ant, subtotal_ant, id_tarjeta, id_cuenta,
    saldo, pagado, total_tarjeta, iva, subtotal, pagado_ant, id_admin)
{
    var token = $("#_token").val();

    formData =
    {
        restante, fecha, total_ant, iva_ant, subtotal_ant, id_tarjeta, id_cuenta, saldo, 
        pagado, total_tarjeta, iva, subtotal, pagado_ant, id_admin
    }

    //console.log(formData);
    $.ajax(
    {
        url: '/admin/egresos/tarjeta-credito/pagarEgresoTarjeta/' + id + '/' + id_tarjeta,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            $('.btn-agregar-tarjeta').removeAttr('disabled');
            toastr.success('Se pagó el egreso exitosamente');
            $('#monto_restante_tarjeta').val(data.restante);
            $('#monto_restante_tarjeta_val').val(data.restante);
            $('#total_tarjeta').val(data.retiro);
            $('#total_tarjeta_ant').val(data.retiro);
            $('#iva_tarjeta_ant').val(data.iva);
            $('#subtotal_tarjeta_ant').val(data.subtotal);
            QuitarErroresTarjeta();
            MostrarTarjetaPendientes(id_cuenta, data.restante);
            MostrarTarjetaPagados(data.id);

        },
        error: function(data)
        {
            $('.btn-agregar-tarjeta').removeAttr('disabled');
            //QuitarErroresTarjeta();
            console.log(data);
        }
    });
}

function QuitarErroresTarjeta()
{
    $("#tipo_tarjeta_error").fadeOut();
    $("#id_categoria_tarjeta_error").fadeOut();
    $("#id_cuenta_tarjeta_error").fadeOut();
    $("#fecha_tarjeta_error").fadeOut();
    $("#id_forma_pago_tarjeta_error").fadeOut();
    $("#total_tarjeta_error").fadeOut();
    $("#restante_tarjeta_error").fadeOut();
}

function BorrarCamposTarjeta()
{
    $('#tipo_tarjeta').val('').change();
    $('#fecha_tarjeta').datepicker('setDate', 'today');
    $('#id_cuenta_tarjeta').val('').change();
    $('#id_cuenta_pendiente').val('').change();
    $('#id_forma_pago_tarjeta').val('').change();
    $('#total_tarjeta').val('');
    $('#total_tarjeta_ant').val('');
    $('#monto_restante_tarjeta').val('0');
    $('#monto_restante_tarjeta_val').val('0');
    $('#pagado_tarjeta').val('0');
    $('#pagado_tarjeta_show').val('0');
    $('#cheque_tarjeta').val('');
    $('#movimiento_tarjeta').val('');
    $('#concepto_tarjeta').val('');
    $('#id_egreso_tarjeta').val('');
}





















