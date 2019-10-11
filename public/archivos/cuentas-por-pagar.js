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

$("#tipo_todos").click(function()
{
    $("#tipo_egreso").val("todo");
    $("#label-egreso").removeClass();
    $("#label-egreso").toggleClass("label label-default");
    $("#label-egreso").html("Todas");
    setTimeout(Listar, 300);
});

$("#tipo_despacho").click(function()
{
    $("#tipo_egreso").val("Despacho");
    $("#label-egreso").removeClass();
    $("#label-egreso").toggleClass("label label-info");
    $("#label-egreso").html("Despacho");
    setTimeout(Listar, 300);
    
});

$("#tipo_hogar").click(function()
{
    $("#tipo_egreso").val("Hogar");
    $("#label-egreso").removeClass();
    $("#label-egreso").toggleClass("label label-success");
    $("#label-egreso").html("Hogar");
    setTimeout(Listar, 300);
});

$("#tipo_personal").click(function()
{
    $("#tipo_egreso").val("Personal");
    $("#label-egreso").removeClass();
    $("#label-egreso").toggleClass("label label-warning");
    $("#label-egreso").html("Personales");
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
    var buscar;
    var tipo;
    tipo = $("#tipo_egreso").val();
    buscar = $("#buscar").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();

    if (buscar == '')
    {
        
        $.ajax(
        {
            type: 'get',
            url: url_listar + tipo,
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
            url: url_buscar + tipo + '/' + buscar,
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

function RecargarPagina()
{
    location.reload();
}

$('#tipo').on('change', function()
{
    tipo = $(this).val();

    if(tipo == '')
    {
        $('#id_categoria').empty();
        $('#id_categoria').append('<option value="">-Seleccionar categoría-</option>');
    }
    else
    {
        $.get('/admin/egresos/categorias-egresos/' + tipo, function(data)
        {
            //$('#id_categoria').empty();
            $.each(data, function(index, subcatObj)
            {

                $('#id_categoria').append('<option value ="'+ subcatObj.id +'">'+subcatObj.categoria+
                  '</option>');

            });
        });
    }
});

$("#btn-agregar-egreso").click(function()
{
    sesion = $("#id_sesion").val();
    if (sesion == '')
    {
        RecargarPagina();
    }
    else
    {
        Create();
        BorrarCampos();
        QuitarErrores();
    }
});

$('.btn-editar').click(function()
{
    sesion = $("#id_sesion").val();
    if (sesion == '')
    {
        RecargarPagina();
    }
    else
    {
        BorrarCampos();
        QuitarErrores();
    }
});

$("#btn-editar-egreso").click(function()
{
    sesion = $("#id_sesion").val();
    if (sesion == '')
    {
        RecargarPagina();
    }
    else
    {
        QuitarErrores();
    }
});

function Create()
{
    $("#accion").val("Agregar");
    $(".modal-title").html("Agregar Egreso");
    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-egreso").removeClass();
    $("#btn-egreso").toggleClass("btn btn-primary btn-flat");
    $("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Agregar");
}

function Edit(id)
{
    sesion = $("#id_sesion").val();
    if (sesion == '')
    {
        RecargarPagina();
    }
    else
    {
        Create();
        BorrarCampos();
        QuitarErrores();
        $('#id_categoria').empty();
        $("#accion").val("Editar");
        var router = "/admin/egreso/" + id + "/edit";
        
        //console.log(router);
        $.get(router, function(data)
        {
            $('#id_egreso').val(data.id);
            $(".modal-title").html("Editar egreso: " + data.id);
            $('.modal-header').css(
            {
                'background-color': '#F39D31'
            });
            $("#btn-egreso").removeClass();
            $("#btn-egreso").toggleClass("btn btn-warning btn-flat");
            $("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar");

            $('#tipo').val(data.tipo).change();
            $('#id_proveedor').val(data.id_proveedor).change();
            $('#porcentaje_iva').val(data.porcentaje_iva);
            $('#total').val(data.total);
            $('#concepto').val(data.concepto);
            $("#con_iva").val(data.con_iva).change(); 
            $('#id_categoria').append('<option value ="'+ data.id_categoria +'" selected>'+data.categoria+
                      '</option><option>-----------------------------</option>');
        });
    }
     
}

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

//Botón para agregar o actualizar egreso
$('#btn-egreso').on('click', function()
{
    accion = $('#accion').val();
    id = $('#id_egreso').val();

    //console.log(accion);
    if(accion == 'Agregar')
    {
        Store();
        
    }
    else if (accion == 'Editar')
    {
        Update(id);
    }
});

function Store()
{
    $('#btn-egreso').attr('disabled', 'disabled');
    var token = $("#_token_egresos").val();

    var formData = {
        tipo: $('#tipo').val(),
        id_categoria: $('#id_categoria').val(),
        id_proveedor: $('#id_proveedor').val(),
        con_iva: $('#con_iva').val(),
        total: $('#total').val(),
        porcentaje_iva: $('#porcentaje_iva').val(),
        concepto: $('#concepto').val(),
        id_admin: $('#id_sesion').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/cuentas-por-pagar/store',
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
            $('#modal-cxp').modal('toggle');
            $('#btn-egreso').removeAttr('disabled');
            
        },
        error: function(data)
        {
            $('#btn-egreso').removeAttr('disabled');
            //QuitarErrores();
            console.log(data);
            if (data.responseJSON.errors.porcentaje_iva)
            {
                $("#porcentaje_iva_error").html(data.responseJSON.errors.porcentaje_iva);
                $("#porcentaje_iva_error").fadeIn();
            }
            else
            {
                $("#porcentaje_iva_error").fadeOut();
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

function Actualizar(id)
{
    url_actuailzar = $('#url_actualizar').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_actuailzar + id,
        success: function(data)
        {
            $('#egreso-' + id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        }
    });  
}

function Remover(id)
{
    $('#egreso-' + id).remove();
    $(".tooltip").tooltip("hide");
}

function Update(id)
{
    $('#btn-egreso').attr('disabled', 'disabled');
    var token = $("#_token_egresos").val();

    var formData = {
        tipo: $('#tipo').val(),
        id_categoria: $('#id_categoria').val(),
        id_proveedor: $('#id_proveedor').val(),
        con_iva: $('#con_iva').val(),
        total: $('#total').val(),
        porcentaje_iva: $('#porcentaje_iva').val(),
        concepto: $('#concepto').val(),
        id_admin: $('#id_sesion').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/cuentas-por-pagar/update/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se actualizó el egreso exitosamente');
            Actualizar(data.id);
            Listar();
            QuitarErrores();
            $('#modal-cxp').modal('toggle');
            $('#btn-egreso').removeAttr('disabled');
            
        },
        error: function(data)
        {
            $('#btn-egreso').removeAttr('disabled');
            //QuitarErrores();
            console.log(data);
            if (data.responseJSON.errors.porcentaje_iva)
            {
                $("#porcentaje_iva_error").html(data.responseJSON.errors.porcentaje_iva);
                $("#porcentaje_iva_error").fadeIn();
            }
            else
            {
                $("#porcentaje_iva_error").fadeOut();
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
            Remover(data.id);
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

function BorrarCampos()
{
    $('#id_proveedor').val('').change();
    $('#id_categoria').empty();
    $('#id_categoria').append('<option value="">-Seleccionar categoría-</option>');
    $('#tipo').val('').change();
    $('#con_iva').val('1').change();
    $('#id_egreso').val('');
    $('#total').val('');
    $('#concepto').val('');
}

function QuitarErrores()
{
    $("#tipo_error").fadeOut();
    $("#total_error").fadeOut();
    $("#id_categoria_error").fadeOut();
}

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
                    token = $('#_token');

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data)
                        {
                            Remover(data.id);
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
















