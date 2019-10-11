$.ajaxSetup(
{
   headers: 
   {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

$(document).ready(function()
{
    Tarjetas()
});

$("#tipo_todos").click(function()
{
    $("#tipo_egreso").val("todo");
    setTimeout(Tarjetas, 300);
});
$("#tipo_despacho").click(function()
{
    $("#tipo_egreso").val("Despacho");
    setTimeout(Tarjetas, 300);
    
});
$("#tipo_hogar").click(function()
{
    $("#tipo_egreso").val("Hogar");
    setTimeout(Tarjetas, 300);
});
$("#tipo_personal").click(function()
{
    $("#tipo_egreso").val("Personal");
    setTimeout(Tarjetas, 300);
});

$("#estatus_pagado").click(function()
{
    $("#variable_estatus").val("Pagado");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-success");
    $("#label-estatus").html("Pagados");
    setTimeout(Tarjetas, 300);
});
$("#estatus_cancelado").click(function()
{
    $("#variable_estatus").val("Cancelado");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-danger"); 
    $("#label-estatus").html("Cancelados");
    setTimeout(Tarjetas, 300);
});

$("#estatus_todo").click(function()
{
    $("#variable_estatus").val("todo");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-primary");
    $("#label-estatus").html("Todos");
    setTimeout(Tarjetas, 300);
});
$("#estatus_pendiente").click(function()
{
    $("#variable_estatus").val("Pendiente");
    $("#label-estatus").removeClass();
    $("#label-estatus").toggleClass("label label-warning");
    $("#label-estatus").html("Pendientes");
    setTimeout(Tarjetas, 300);
});

$("#btn-borrar").click(function()
{
    //ResetearFecha();
    $('#buscar').val('');
    setTimeout(Tarjetas, 300);
});
$("#btn-buscar").on("click", function(e)
{
    e.preventDefault();
    Tarjetas();
});

$('#buscar').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        Tarjetas();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

$('#reservation').on('change', function()
{
    Tarjetas();
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

function Tarjetas()
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
        if (buscar == '')
        {
            
            $.ajax(
            {
                type: 'get',
                url: url_listar + estatus + '/' + tipo + '/' + cuenta + '/' + 
                fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59',
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
                url: url_buscar + estatus + '/' + tipo + '/' + cuenta + '/' + 
                fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59' + '/' + buscar,
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
}

$('#cuenta_select').on('change', function()
{
    Tarjetas();
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
        //$('#id_proveedor').empty();
        $('#id_proveedor').append('<option value ="">-Seleccionar proveedor-</option>');
        $.each(data, function(index, item)
        {
            $('#id_proveedor').append('<option value ="' + item.id + '">' + item.proveedor + 
                '</option>');
        });
        $('#id_proveedor').selectpicker('refresh');
    });
}

$('#tipo').on('change', function()
{
    //console.log(e);
    var tipo = $(this).val();
    var apagar = $('#apagar_tipo').val();
    cargarCategorias(tipo, apagar);
});

function cargarCategorias(tipo, apagar)
{
    if(tipo == '')
    {
        $('#id_categoria').empty();
        $('#id_categoria').append('<option value ="">-Sin opción-</option>');
    }
    else if(apagar == 1)
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

function CrearTarjetaCredito()
{
    $("#accion").val("Create");
    $('#btn-egreso').removeAttr('disabled');
    $(".modal-title").html("Agregar Egreso");
    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-egreso").removeClass();
    $("#btn-egreso").toggleClass("btn btn-primary btn-flat");
    $("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Agregar");
    BorrarCampos();
    QuitarErrores();
    
}

function Edit(id)
{
	//egreso = $('#id_egreso').val();
	$("#accion").val("Edit");
	$('#apagar_tipo').val('1');
	$('#btn-egreso').removeAttr('disabled');
	CargarProveedores();
	$('.modal-header').css(
	{
	    'background-color': '#EE8F14'
	});
	$("#btn-egreso").removeClass();
	$("#btn-egreso").toggleClass("btn btn-success btn-flat");
	$("#btn-egreso").html("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar");

	var router = '/admin/tarjetas-credito/edit/' + id;
    
    $.get(router, function(data)
    {
    	//console.log(data);
    	$('#id_egreso').val(data.id);
    	$(".modal-title").html("Editar egreso: " + data.id);
    	$('#tipo').val(data.tipo).change();
    	$('#id_cuenta').val(data.id_cuenta).change();
    	$('#porcentaje_iva').val(data.porcentaje_iva);
    	$('#total').val(data.total);
    	$('#total_ant').val(data.total);
    	$('#pagado').val(data.pagado);
    	$('#saldo').val(data.saldo);
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

    	if(data.fecha == '')
    	{
    		$('#fecha').datepicker().datepicker('setDate', 'today');
    	}
    	else
    	{
    		$('#fecha').val(data.fecha);
    	}

    	$('#id_proveedor').empty();
    	$('#id_proveedor').append('<option selected value="' + data.id_proveedor + '">' + 
    	    data.proveedor +
    	    '</option><option value="">-------------------------</option>');
    	
    	var route = "/admin/egresos/proveedores/1";
    	$.get(route, function(data)
    	{
    	    $.each(data, function(index, item)
    	    {
    	        $('#id_proveedor').append('<option value ="' + item.id + '">' + item.proveedor +
    	            '</option>');
    	    });
    	    $('#id_proveedor').selectpicker('refresh');
    	});

    	$('#id_categoria').prepend('<option selected value="' + data.id_categoria + '">' + data.categoria +
    	    '</option><option value="">-------------------------</option>');

    	$('#apagar_tipo').val('0');
    });
}

function NuevoRegistro(id)
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

function ActualizarEgreso(id)
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

function RecargarPagina()
{
    location.reload();
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
        Create();
        BorrarCampos();
        QuitarErrores();
    }
});

$('#btn-egreso').click(function()
{
	accion = $('#accion').val();
	id = $('#id_egreso').val();

	if(accion == 'Create')
	{
		Store();
	}
	else if(accion == 'Edit')
	{
		Update(id)
	}
});

function Store()
{
	$('#btn-egreso').attr('disabled', 'disabled');
	var token = $("#_token").val();

	var formData = 
	{
	    tipo: $('#tipo').val(),
	    id_categoria: $('#id_categoria').val(),
	    id_proveedor: $('#id_proveedor').val(),
	    fecha: $('#fecha').val(),
	    id_cuenta: $('#id_cuenta').val(),
	    id_forma_pago: '4',
	    con_iva: $('#con_iva_checked').val(),
	    total: $('#total').val(),
	    porcentaje_iva: $('#porcentaje_iva').val(),
	    concepto: $('#concepto').val(),
	    id_admin: $('#id_sesion').val()
	}
	//console.log(formData);
	$.ajax(
	{
	    url: '/admin/tarjetas-credito/store',
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
	        NuevoRegistro(data.id);
	        QuitarErrores();
	        BorrarCampos();
	        $('#modal-tarjeta-credito').modal('toggle');
	        $('#btn-egreso').removeAttr('disabled');
	        
	    },
	    error: function(data)
	    {
	    	$('#btn-egreso').removeAttr('disabled');
	        console.log(data); 

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

	        if (data.responseJSON.errors.total)
	        {
	            $("#total_error").html(data.responseJSON.errors.total);
	            $("#total_error").fadeIn();
	        }
	        else
	        {
	            $("#total_error").fadeOut();
	        }

	        if (data.responseJSON.errors.porcentaje_iva)
	        {
	            $("#porcentaje_iva_error").html(data.responseJSON.errors.porcentaje_iva);
	            $("#porcentaje_iva_error").fadeIn();
	        }
	        else
	        {
	            $("#porcentaje_iva_error").fadeOut();
	        }
	        
	        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
	        
	        console.clear();
	    }
	});
}

function Update(id)
{
	$('#btn-egreso').attr('disabled', 'disabled');
	var token = $("#_token").val();

	var formData = 
	{
	    tipo: $('#tipo').val(),
	    id_categoria: $('#id_categoria').val(),
	    id_proveedor: $('#id_proveedor').val(),
	    fecha: $('#fecha').val(),
	    id_cuenta: $('#id_cuenta').val(),
	    id_forma_pago: '4',
	    con_iva: $('#con_iva_checked').val(),
	    total: $('#total').val(),
	    porcentaje_iva: $('#porcentaje_iva').val(),
	    concepto: $('#concepto').val(),
	    id_admin: $('#id_sesion').val()
	}
	//console.log(formData);
	$.ajax(
	{
	    url: '/admin/tarjetas-credito/update/' + id,
	    headers:
	    {
	        'X-CSRF-TOKEN': token
	    },
	    type: 'PUT',
	    dataType: 'json',
	    data: formData,
	    success: function(data)
	    {
	        toastr.success('Se actualizó el egreso satisfactoriamente.');
	        ActualizarEgreso(data.id);
	        QuitarErrores();
	        BorrarCampos();
	        $('#modal-tarjeta-credito').modal('toggle');
	        $('#btn-egreso').removeAttr('disabled');
	        
	    },
	    error: function(data)
	    {
	    	$('#btn-egreso').removeAttr('disabled');
	        console.log(data); 

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

	        if (data.responseJSON.errors.total)
	        {
	            $("#total_error").html(data.responseJSON.errors.total);
	            $("#total_error").fadeIn();
	        }
	        else
	        {
	            $("#total_error").fadeOut();
	        }

	        if (data.responseJSON.errors.porcentaje_iva)
	        {
	            $("#porcentaje_iva_error").html(data.responseJSON.errors.porcentaje_iva);
	            $("#porcentaje_iva_error").fadeIn();
	        }
	        else
	        {
	            $("#porcentaje_iva_error").fadeOut();
	        }
	        
	        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
	        
	        console.clear();
	    }
	});
}

function BorrarCampos()
{
	$('#fecha').datepicker().datepicker('setDate', 'today');
	$('#id_proveedor').empty();
	CargarProveedores();
	$('#id_categoria').empty();
	$('#id_categoria').append('<option value="">-Seleccionar categoría-</option>');
	
	$('#con_iva').prop('checked', true);
	$('#con_iva_checked').val(1);
	$('#apagar_tipo').val('0');
	$('#tipo').val('').change();
	$('#id_cuenta').val('').change();
	$('#total').val('');
	$('#total_ant').val('');
	$('#pagado').val('');
	$('#saldo').val('');
	$('#concepto').val('');
}

function QuitarErrores()
{
	$("#tipo_error").fadeOut();
	$("#id_categoria_error").fadeOut();
	$("#id_cuenta_error").fadeOut();
	$("#fecha_error").fadeOut();
    $("#total_error").fadeOut();
    $("#porcentaje_iva_error").fadeOut();
}

$("#modal-tarjeta-credito").on("hidden.bs.modal", function()
{
    $('#apagar_tipo').val('0');
    $('#id_categoria').empty();
    $('#id_proveedor').empty();
    BorrarCampos();
    QuitarErrores();
});

function Cancelar(id)
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
	                router = '/admin/tarjetas-credito/cancelar/' + id;
	                token = $('#_token');

	                $.ajax(
	                {
	                    url: router,
	                    type: 'PUT',
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

function Activar(id)
{
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
	                router = '/admin/tarjetas-credito/activar/' + id;
	                token = $('#_token');

	                $.ajax(
	                {
	                    url: router,
	                    type: 'PUT',
	                    dataType: 'json',
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

//Agregar catálogos
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
    token = $('#_token').val();

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
    token = $('#_token').val();

    var formData = {
        nombre_comercial, id_admin: $('#id_sesion').val()
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
            $('id_proveedor').empty();
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














