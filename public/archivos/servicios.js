$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function ControlServicios()
{
    Listar();
}

$(document).ready(function()
{
    Listar();
});


$('#servicios_select').on('change', function()
{   
    setTimeout(Listar, 300);
}); 

$('#servicios_tramite').on('change', function()
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

$("#btn-borrar-folio").click(function()
{
    //ResetearFecha();
    $('#buscar-folio').val('');
    setTimeout(Listar, 300);
});
$("#btn-buscar-folio").on("click", function(e)
{
    e.preventDefault();
    Listar();
});

$(".btn-cerrar-actualizar").on("click", function(e)
{
    id_servicio = $('#id_servicio_menu').val();
    $('#menu').hide();
    e.preventDefault();
    ActualizarServicioListado(id_servicio);
    BorrarFacturacion();
});

function ActualizarServicioListado(id_servicio)
{
    url_actualizar = $('#url_actualizar').val();
    listado = $("#listado-parametro").val();
    //console.log(url_actualizar);
    $.ajax(
    {
        type: 'get',
        url: url_actualizar + id_servicio,
        success: function(data)
        {
            //console.log(data);
            $('#listado-' + listado + '-' + id_servicio).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });   
}

function NuevoServicio(id_servicio)
{
    url_nuevo = $('#url_actualizar').val();
    listado = $("#listado-parametro").val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_nuevo + id_servicio,
        success: function(data)
        {
            $('#list-' + listado).prepend(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });
}

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

$('#buscar-folio').on('keypress', function(e)
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

$(document).on("click", ".pagination-servicio .pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado-parametro").val();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-' + listado).empty().html(data);
        }
    });
});

function Listar()
{
    var estatus;
    var buscar;
    var folio;
    estatus = $("#servicios_select").val();
    tramite = $("#servicios_tramite").val();
    buscar = $("#buscar").val();
    folio = $("#buscar-folio").val();
    listado = $("#listado-parametro").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    FechaRango = document.getElementById('reservation').value.split('  -  ');
    fecha_inicio = FechaRango[0];
    fecha_fin = FechaRango[1];

    if(folio == '')
    {
        folio = 0;
    }

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
            route_listar = url_listar + estatus + '/' + tramite + 
            '/' + fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59/' + folio;
            //console.log(route_listar);
            $.ajax(
            {
                type: 'get',
                url: route_listar,
                success: function(data)
                {
                    $('#listado-' + listado).empty().html(data);
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
                url: url_buscar + estatus + '/' + tramite + '/' + buscar + 
                '/' + fecha_inicio + ' 00:00:00/' + fecha_fin + ' 23:59:59/' + folio,
                success: function(data)
                {
                    $('#listado-' + listado).empty().html(data);
                    $(".tooltip").tooltip("hide");
                    $(function()
                    {
                        $('.headerfix').stickyTableHeaders();
                    });
                }
            });
        }
    }
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

$('#aplica_comision_venta').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_comision_venta_check").val(this.value);
}).change();
$('#aplica_comision_operativa').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_comision_operativa_check").val(this.value);
}).change();
$('#aplica_comision_gestion').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_comision_gestion_check").val(this.value);
}).change();
$('#mostrar_bitacora').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#mostrar_bitacora_check").val(this.value);
}).change();
$('#asignar_costo_servicio').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#asignar_costo_servicio_check").val(this.value);
}).change();

$("#btn-agregar-servicio").click(function()
{
    sesion = $("#id_sesion").val();
    if (sesion == '')
    {
        RecargarPagina();
    }
    else
    {
        $("#accion").val("Agregar");
        Create();
    }
});

function RecargarPagina()
{
    location.reload();
}
$("#btn-servicio-nuevo").click(function()
{
    id = $('#id_servicio').val();
    if (id == '')
    {
        AgregarServicio();
    }
    else
    {
        ActualizarServicio(id);
    }
});

function CrearCliente()
{
    $('.modal-title').html('Agregar Cliente');
    $('.modal-header').css(
    {
        'background-color' : '#218CBF'
    });
}

$("#btn-agregar-marca").click(function()
{
    var route = "/admin/procesos/servicios/cargar_clientes";
    $.get(route, function(data)
    {
        $('#id_cliente_marca').empty();
        $('#id_cliente_marca').append('<option value ="">-Seleccionar cliente-</option>');
        $.each(data, function(index, item)
        {
            $('#id_cliente_marca').append('<option value ="' + item.id + '">' + item.nombre_comercial +
                '</option>');
        });
        $('#id_cliente_marca').selectpicker('refresh');
    });
});

var cargarClientesServicios = function()
{
    var route = "/admin/procesos/servicios/cargar_clientes";
    $.get(route, function(data)
    {
        $('#id_cliente_agregar').empty();
        $('#id_cliente_agregar').append('<option value ="">-Seleccionar cliente-</option>');
        $.each(data, function(index, item)
        {
            $('#id_cliente_agregar').append('<option value ="' + item.id + '">' + item.nombre_comercial +
                '</option>');
        });
        $('#id_cliente_agregar').selectpicker('refresh');
    });
    var route = "/admin/procesos/servicios/cargar_servicios";
    $.get(route, function(data)
    {
        $('#id_cat').empty();
        $('#id_cat').append('<option value ="">-Seleccionar servicio-</option>');
        $.each(data, function(index, item)
        {
            $('#id_cat').append('<option value ="' + item.id + '_' + item.concepto + '_' + item.moneda +
                '_' + item.conversion + '_' + item.costo + '_' + item.comision_venta + '_' + item.comision_venta_monto +
                '_' + item.comision_operativa + '_' + item.comision_operativa_monto + '_' +
                item.comision_gestion + '_' + item.comision_gestion_monto +
                '_' + item.id_categoria_bitacora + '_' + item.costo_servicio + '_' + item.porcentaje_venta + '_' +
                item.porcentaje_operativa + '_' + item.porcentaje_gestion + '_' + item.avance_total + '"><b>' + item.clave +
                '</b> - ' + item.servicio + '</option>');
        });
        //$('#id_cat').selectpicker('refresh');
    });
}
//Agregar Marca
var MostrarModalMarca = function()
{
    id_cliente = $('#id_cliente_agregar').val();
    if (id_cliente == '')
    {
        $("#id_cliente_agregar_error").html('Seleccione primero un cliente');
        $("#id_cliente_agregar_error").fadeIn();
    }
    else
    {
        $("#id_cliente_agregar_error").fadeOut();
        $("#agregar-marca-servicio").modal('toggle');
        $('#id_cliente_marca_servicio').val(id_cliente);
    }

    $('.modal-title').html('Agregar Trámite, Marca, Obra o Patente');
    $('.modal-header').css(
    {
        'background-color' : '#49B6D6'
    });
}
$(".cerrar-marca-servicio").click(function()
{
    $("#agregar-marca-servicio").modal('toggle');
});
$("#agregar_factura").on("hidden.bs.modal", function()
{
    $("#id_cliente_agregar_error").fadeOut();
    $("#nombre_marca").val("");
});
$("#btn-agregar-marca-servicio").click(function()
{
    var route = "/admin/procesos/crear-marca";
    var token = $("#_token_marca_servicio").val();
    var formData = {
        nombre: $('input[name=nombre_marca]').val(),
        id_cliente: $('input[name=id_cliente_marca_servicio]').val(),
        id_admin: $('input[name=id_admin_marca_servicio]').val(),
        estatus: $('input[name=estatus_marca_servicio]').val()
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
            toastr.success('Se agregó la marca, obra, título o patente exitosamente.');
            $("#nombre_marca").val("");
            $("#id_cliente_marca_servicio").val("").change();
            $("#nombre_marca_error").fadeOut();
            $("#agregar-marca-servicio").modal('toggle');
            $('#id_control_agregar').prepend('<option value ="' + data.id +
                '" selected>' + data.nombre + '</option>')
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.nombre)
            {
                toastr.error(data.responseJSON.errors.nombre);
                $("#nombre_marca_error").html(data.responseJSON.errors.nombre);
                $("#nombre_marca_error").fadeIn();
            }
            else
            {
                $("#nombre_marca_error").fadeOut();
            }
            //toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
});
function Create()
{
    $('#editar_servicio').val('0');
    BorrarCrear();
    QuitarErroresCrear();
    $("#encabezado-servicio").html("Agregar Servicio");
    $('#encabezado').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-servicio-nuevo").attr('hidden', 'hidden');
    $("#btn-servicio-nuevo2").removeAttr('hidden');
    /*$("#aplica_comision_venta").val("0").change();
    $('#aplica_comision_venta').prop('checked', false);
    $("#aplica_comision_venta_check").val("0");
    $("#aplica_comision_operativa").val("0").change();
    $('#aplica_comision_operativa').prop('checked', false);
    $("#aplica_comision_operativa_check").val("0");
    $("#aplica_comision_gestion").val("0").change();
    $('#aplica_comision_gestion').prop('checked', false);
    $("#aplica_comision_gestion_check").val("0");*/
    $("#mostrar_bitacora").val("0").change();
    $('#mostrar_bitacora').prop('checked', false);
    $("#mostrar_bitacora_check").val("0");
    $("#asignar_costo_servicio").val("0").change();
    $('#asignar_costo_servicio').prop('checked', false);
    $("#asignar_costo_servicio_check").val("0");
    $('#btn-servicio-nuevo2').removeAttr('disabled');
    cargarClientesServicios();
}

$('#id_bitacoras').change(function()
{
    bitacora = $(this).val();
    if(bitacora == 1 || bitacora == 2)
    {
        $('#mostrar_bitacora').prop('checked', false);
        $('#mostrar_bitacora_check').val('0');
    }
    else 
    {
        $('#mostrar_bitacora').prop('checked', true);
        $('#mostrar_bitacora_check').val('1');
    }
});

function storeTableValues(id)
{
    var TableData = new Array();
    var dt = new Date();

    anio = dt.getFullYear();
    mes = dt.getMonth() + 1;
    dia = dt.getDate();
    hora = dt.getHours();
    minutos = dt.getMinutes();
    segundos = dt.getSeconds();

    var datetime = anio + '-' + mes + '-' + dia + ' ' + hora + ':' + minutos + ':' + segundos;

    //console.log(date);

    id = id;

    $('#process-list tr').each(function(row, tr)
    {
        /*var TableData = '';
        $('#process-list tr').each(function(row, tr)
        {
            TableData = TableData
                + $(tr).find('td:eq(0)').text() + ' ' //<th>ID</th>
                + $(tr).find('td:eq(1)').text() + ' ' //<th>Orden</th>
                + $(tr).find('td:eq(2)').text() + ' ' //<th>Venta</th>
                + $(tr).find('td:eq(3)').text() + ' ' //<th>Operativa</th>
                + $(tr).find('td:eq(4)').text() + ' ' //<th>Gestión</th>
                + $(tr).find('td:eq(5)').text() + ' ' //<th>Area</th>
                + $(tr).find('td:eq(6)').text() + ' ' //<th>Requisitos</th>
                + $(tr).find('td:eq(7)').text() + ' ' //<th>Idreq</th>
                + $(tr).find('td:eq(8)').text() + ' ' //<th>Idcat</th>
                + '\n';
        });*/

        TableData[row] = 
        {
            //'id' : + $(tr).find('td:eq(0)').text(), //<th>ID</th>
            'orden' :  $(tr).find('td:eq(1)').text(), //<th>Orden</th>
            'libera_venta' : $(tr).find('td:eq(2)').text(), //<th>Venta</th>
            'libera_operativa' : $(tr).find('td:eq(3)').text(), //<th>Operativa</th>
            'libera_gestion' : $(tr).find('td:eq(4)').text(), //<th>Gestión</th>
            'registro' : $(tr).find('td:eq(5)').text(), //<th>Registro</th>
            //'id_servicio' : id_servicio,
            //'categoria' : $(tr).find('td:eq(5)').text(), //<th>Area</th>
            //'requisito' :  $(tr).find('td:eq(6)').text(), //<th>Requisitos</th>
            'id_requisitos' : $(tr).find('td:eq(6)').text(), //<th>Idreq</th>
            //'id_catalogo_servicio' : $(tr).find('td:eq(8)').text() //<th>Idcat</th>
            'id_servicio' : id,
            'created_at' : datetime,
            'updated_at' : datetime
        }
    });

    //TableData.shift(); //first row is the table header - so remove
    //console.log(TableData);
    return TableData;
}

var AgregarServicio = function()
{
    $('#btn-agregar-servicio').attr('disabled', 'disabled');
    
    var token = $("#token").val();
    tramite = $('#tramite').val();
    id_clase = $('#clase').val();
    concepto_costo = $('#concepto_costo').val();
    moneda = $('#moneda').val();
    tipo_cambio = $('#tipo_cambio_val').val();
    costo_servicio = $('#costo_servicio').val();
    costo_ini = $('#costo_ini_val').val();
    porcentaje_descuento = $('#porcentaje_descuento').val();
    descuento = $('#descuento').val();
    costo = $('#costo').val();
    concepto_venta = $('#concepto_venta_val').val();
    concepto_operativo = $('#concepto_operativo_val').val();
    concepto_gestion = $('#concepto_gestion_val').val();
    comision_venta = $('#comision_venta_val').val();
    porcentaje_comision_venta = $('#porcentaje_comision_venta').val();
    comision_gestion = $('#comision_gestion_val').val();
    porcentaje_comision_gestion = $('#porcentaje_comision_gestion').val();
    comision_operativa = $('#comision_operativa_val').val();
    porcentaje_comision_operativa = $('#porcentaje_comision_operativa').val();
    estatus_tramite = $('#estatus_tramite').val();
    id_cliente = $('#id_cliente_agregar').val();
    id_control = $('#id_control_agregar').val();
    id_catalogo_servicio = $('#id_catalogo_servicio').val();
    id_admin = $('#id_admin_servicio').val();
    id_bitacoras = $('#id_bitacoras').val();
    aplica_comision_venta = $('#aplica_comision_venta_check').val();
    aplica_comision_operativa = $('#aplica_comision_operativa_check').val();
    aplica_comision_gestion = $('#aplica_comision_gestion_check').val();
    id_sesion = $('#id_sesion').val();
    mostrar_bitacora = $('#mostrar_bitacora_check').val();
    asignar_costo_servicio = $('#asignar_costo_servicio_check').val();
    fecha = $('#fecha_servicio').val();
    avance_total = $('#avance_total_servicio').val();

    if(porcentaje_comision_venta == '')
    {
        porcentaje_comision_venta = 0;
    }
    if(porcentaje_comision_operativa == '')
    {
        porcentaje_comision_operativa = 0;
    }
    if(porcentaje_comision_gestion == '')
    {
        porcentaje_comision_gestion = 0;
    }

    var formData = 
    {
        tramite, id_clase, concepto_costo, moneda, tipo_cambio, costo_servicio, costo_ini, porcentaje_descuento,
        descuento, costo, concepto_venta, concepto_operativo, concepto_gestion, comision_venta, porcentaje_comision_venta,
        comision_gestion, porcentaje_comision_gestion, comision_operativa, porcentaje_comision_operativa, 
        estatus_tramite, id_cliente, id_control, id_catalogo_servicio, id_admin, id_bitacoras, aplica_comision_venta,
        aplica_comision_operativa, aplica_comision_gestion, id_sesion, mostrar_bitacora, asignar_costo_servicio, 
        fecha_servicio, avance_total
    }

    var route = "/admin/procesos";
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
            
            toastr.success('Se agregó el servicio exitosamente');
            NuevoServicio(data.id);
            $('#btn-agregar-servicio').removeAttr('disabled');
            $("#agregar-servicio").modal('toggle');
            QuitarErroresCrear();
            
            var TableData;
            TableData = $.toJSON(storeTableValues(data.id));

            $.ajax(
            {
                type: 'POST',
                url: '/admin/procesos/insertarProceso',
                data: 'string=' + TableData,
                success: function(data)
                {
                    Listar();
                    
                },
                error: function(data)
                {
                    toastr.error('No se pudo insertar el proceso del servicio.');
                    console.log(data);
                }
            });
        },
        error: function(data)
        {
            $('#btn-agregar-servicio').removeAttr('disabled');

            console.log(data);
            if (data.responseJSON.errors.id_cliente)
            {
                $("#id_cliente_agregar_error").html(data.responseJSON.errors.id_cliente);
                $("#id_cliente_agregar_error").fadeIn();
            }
            else
            {
                $("#id_cliente_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.id_catalogo_servicio)
            {
                $("#id_catalogo_servicio_agregar_error").html(data.responseJSON.errors.id_catalogo_servicio);
                $("#id_catalogo_servicio_agregar_error").fadeIn();
            }
            else
            {
                $("#id_catalogo_servicio_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.costo)
            {
                $("#costo_error").html(data.responseJSON.errors.costo);
                $("#costo_error").fadeIn();
            }
            else
            {
                $("#costo_error").fadeOut();
            }
            if (data.responseJSON.errors.tramite)
            {
                $("#tramite_error").html(data.responseJSON.errors.tramite);
                $("#tramite_error").fadeIn();
            }
            else
            {
                $("#tramite_error").fadeOut();
            }
            if (data.responseJSON.errors.tipo_cambio)
            {
                $("#tipo_cambio_error").html(data.responseJSON.errors.tipo_cambio);
                $("#tipo_cambio_error").fadeIn();
            }
            else
            {
                $("#tipo_cambio_error").fadeOut();
            }
            if (data.responseJSON.errors.id_admin)
            {
                $("#id_admin_error").html(data.responseJSON.errors.id_admin);
                $("#id_admin_error").fadeIn();
            }
            else
            {
                $("#tipo_cambio_error").fadeOut();
            }

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_servicio_error").html(data.responseJSON.errors.fecha);
                $("#fecha_servicio_error").fadeIn();
            }
            else
            {
                $("#fecha_servicio_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
            console.clear();
        }
    });
}

function Edit(id)
{
    $("#editar_servicio").val("1");
    $('#id_cliente_agregar').empty();
    $('#id_control_agregar').empty();
    $('#id_cat').empty();
    $("#accion").val("Editar");
    //id_admin = $("#id_admin").val();
    $('#encabezado').css(
    {
        'background-color': '#FE9800'
    });
    $("#btn-servicio-nuevo").removeAttr('hidden');
    $("#btn-servicio-nuevo2").attr('hidden', 'hidden');

    var router = "/admin/procesos/" + id + "/edit";
    $.get(router, function(data)
    {
        //console.log(data);
        $('#id_servicio').val(data.id);
        $("#encabezado-servicio").html("Editar Servicio: " + data.id);
        $('#id_cliente_agregar').append('<option selected value="' + data.id_cliente + '">' + data.nombre_comercial +
            '</option><option value="">-------------------------</option>');
        //$('#id_cliente_agregar').selectpicker('refresh');
        if (data.id_control == null)
        {
            $('#id_control_agregar').append('<option value ="">-Seleccionar marca-</option>');
        }
        else
        {
            $('#id_control_agregar').append('<option selected value="' + data.id_control + '">' + data.marca +
                '</option><option value="">-------------------------</option>');
        }
        $('#id_cat').append('<option selected value ="' + data.id_cat + '_' + data.concepto + '_' + data.moneda +
            '_' +  data.conversion + '_' + data.costo + '_' + data.comision_venta + '_' + data.comision_venta_monto + '_' + data
            .comision_operativa + '_' + data.comision_operativa_monto + '_' + data.comision_gestion +
            '_' + data.comision_gestion_monto + '_' + data.id_categoria_bitacora +
            '_' + data.costo_servicio + '_' + data.porcentaje_venta + '_' + data.porcentaje_operativa + 
            '_' + data.porcentaje_gestion + '_' + data.avance_total + '"><b>' + data.clave + '</b> - ' + 
            data.servicio + '</option><option value="">-------------------------</option>');
        $("#clase").val(data.id_clase).change();
        $("#id_catalogo_servicio").val(data.id_catalogo_servicio);
        $("#tramite").val(data.tramite);
        $("#concepto_costo").val(data.concepto_costo).change();
        $("#moneda").val(data.moneda);
        $("#moneda_val").val(data.moneda);
        $("#costo_servicio").val(data.costo_servicio);
        $("#costo_ini").val(data.costo_ini);
        $("#costo_ini_val").val(data.costo_ini);
        $("#tipo_cambio_val").val(data.tipo_cambio);
        $("#tipo_cambio_anterior").val(data.tipo_cambio);
        $("#porcentaje_descuento").val(data.porcentaje_descuento);
        $("#descuento").val(data.descuento);
        $("#costo").val(data.costo);
        $("#costo_final").val(data.costo_ini);
        $("#cobrado").val(data.cobrado);
        $("#facturado_servicio").val(data.facturado);
        $("#cobrado_terminado").val(data.cobrado_terminado);
        $("#saldo").val(data.saldo);
        $("#id_bitacoras").val(data.id_bitacoras).change();
        $("#id_admin_servicio").val(data.id_admin).change();

        $("#concepto_venta").val(data.concepto_venta).change();
        $("#concepto_venta_val").val(data.concepto_venta);
        $("#comision_venta").val(data.comision_venta);
        $("#comision_venta_val").val(data.comision_venta);
        $("#comision_venta_constante").val(data.comision_venta);
        $("#porcentaje_comision_venta").val(data.porcentaje_comision_venta);

        $("#concepto_operativo").val(data.concepto_operativo).change();
        $("#concepto_operativo_val").val(data.concepto_operativo);
        $("#comision_operativa").val(data.comision_operativa);
        $("#comision_operativa_val").val(data.comision_operativa);
        $("#porcentaje_comision_operativa").val(data.porcentaje_comision_operativa);

        $("#concepto_gestion").val(data.concepto_gestion).change();
        $("#concepto_gestion_val").val(data.concepto_gestion);
        $("#comision_gestion").val(data.comision_gestion);
        $("#comision_gestion_val").val(data.comision_gestion);
        $("#comision_gestion_constante").val(data.comision_gestion);
        $("#porcentaje_comision_gestion").val(data.porcentaje_comision_gestion);

        $('#fecha_servicio').val(data.fecha);
        if (data.aplica_comision_venta == 1)
        {
            $("#aplica_comision_venta").val("1").change();
            $('#aplica_comision_venta').prop('checked', true);
            $("#aplica_comision_venta_check").val("1");
        }
        else if (data.aplica_comision_venta == 0)
        {
            $("#aplica_comision_venta").val("0").change();
            $('#aplica_comision_venta').prop('checked', false);
            $("#aplica_comision_venta_check").val("0");
        }
        if (data.aplica_comision_operativa == 1)
        {
            $("#aplica_comision_operativa").val("1").change();
            $('#aplica_comision_operativa').prop('checked', true);
            $("#aplica_comision_operativa_check").val("1");
        }
        else if (data.aplica_comision_operativa == 0)
        {
            $("#aplica_comision_operativa").val("0").change();
            $('#aplica_comision_operativa').prop('checked', false);
            $("#aplica_comision_operativa_check").val("0");
        }
        if (data.aplica_comision_gestion == 1)
        {
            $("#aplica_comision_gestion").val("1").change();
            $('#aplica_comision_gestion').prop('checked', true);
            $("#aplica_comision_gestion_check").val("1");
        }
        else if (data.aplica_comision_gestion == 0)
        {
            $("#aplica_comision_gestion").val("0").change();
            $('#aplica_comision_gestion').prop('checked', false);
            $("#aplica_comision_gestion_check").val("0");
        }
        if (data.mostrar_bitacora == 1)
        {
            $("#mostrar_bitacora").val("1").change();
            $('#mostrar_bitacora').prop('checked', true);
            $("#mostrar_bitacora_check").val("1");
        }
        else if (data.mostrar_bitacora == 0)
        {
            $("#mostrar_bitacora").val("0").change();
            $('#mostrar_bitacora').prop('checked', false);
            $("#mostrar_bitacora_check").val("0");
        }
        if (data.asignar_costo_servicio == 1)
        {
            $("#asignar_costo_servicio").val("1").change();
            $('#asignar_costo_servicio').prop('checked', true);
            $("#asignar_costo_servicio_check").val("1");
        }
        else if (data.asignar_costo_servicio == 0)
        {
            $("#asignar_costo_servicio").val("0").change();
            $('#asignar_costo_servicio').prop('checked', false);
            $("#asignar_costo_servicio_check").val("0");
        }
        var routes = "/admin/procesos/marcas/" + data.id_cliente;
        $.get(routes, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#id_control_agregar').append('<option value ="' + item.id + '">' + item.nombre +
                    '</option>');
            });
        });
    });
    var route = "/admin/procesos/servicios/cargar_clientes";
    $.get(route, function(data)
    {
        $.each(data, function(index, item)
        {
            $('#id_cliente_agregar').append('<option value ="' + item.id + '">' + item.nombre_comercial +
                '</option>');
        });
        $('#id_cliente_agregar').selectpicker('refresh');
    });
    var route = "/admin/procesos/servicios/cargar_servicios";
    $.get(route, function(data)
    {
        $.each(data, function(index, item)
        {
            $('#id_cat').append('<option value ="' + item.id + '_' + item.concepto + '_' + item.moneda +
                '_' + item.conversion + '_' + item.costo + '_' + item.comision_venta + '_' + item.comision_venta_monto +
                '_' + item.comision_operativa + '_' + item.comision_operativa_monto + '_' +
                item.comision_gestion + '_' + item.comision_gestion_monto +
                '_' + item.id_categoria_bitacora + '_' + item.costo_servicio + '_' + item.porcentaje_venta + '_' +
                item.porcentaje_operativa + '_' + item.porcentaje_gestion + '_' + item.avance_total + '"><b>' + item.clave +
                '</b> - ' + item.servicio + '</option>');
        });
        //$('#id_cat').selectpicker('refresh');
    });

    $('#editar_servicio').val('0');
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

                            ActualizarServicioListado(id);
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

function Activar(id)
{
    token = $('#_token').val();
    estatus = 'Pendiente';
    formData =
    {
        estatus
    }
    $.confirm(
    {
        title: '¿Desea activar el servicio?',
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
                            toastr.info('Se activó el servicio.');

                            ActualizarServicioListado(id);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo activar el servicio.');
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
}

function ActualizarServicio(id)
{
    $('#btn-agregar-servicio').attr('disabled', 'disabled');
    var route = "/admin/procesos/" + id;
    var token = $("#token").val();
    //console.log(fecha_servicio);
    var formData = 
    {
        tramite: $('#tramite').val(),
        id_clase: $('#clase').val(),
        concepto_costo: $('#concepto_costo').val(),
        moneda: $('#moneda').val(),
        tipo_cambio: $('#tipo_cambio_val').val(),
        costo_servicio: $('#costo_servicio').val(),
        costo_ini: $('#costo_ini_val').val(),
        porcentaje_descuento: $('#porcentaje_descuento').val(),
        descuento: $('#descuento').val(),
        costo: $('#costo').val(),
        concepto_venta: $('#concepto_venta_val').val(),
        concepto_operativo: $('#concepto_operativo_val').val(),
        concepto_gestion: $('#concepto_gestion_val').val(),
        comision_venta: $('#comision_venta_val').val(),
        porcentaje_comision_venta: $('#porcentaje_comision_venta').val(),
        comision_gestion: $('#comision_gestion_val').val(),
        porcentaje_comision_gestion: $('#porcentaje_comision_gestion').val(),
        comision_operativa: $('#comision_operativa_val').val(),
        porcentaje_comision_operativa: $('#porcentaje_comision_operativa').val(),
        estatus_tramite: $('#estatus_tramite').val(),
        id_cliente: $('#id_cliente_agregar').val(),
        id_control: $('#id_control_agregar').val(),
        id_catalogo_servicio: $('#id_catalogo_servicio').val(),
        id_admin: $('#id_admin_servicio').val(),
        id_bitacoras: $('#id_bitacoras').val(),
        aplica_comision_venta: $('#aplica_comision_venta_check').val(),
        aplica_comision_operativa: $('#aplica_comision_operativa_check').val(),
        aplica_comision_gestion: $('#aplica_comision_gestion_check').val(),
        id_sesion: $('#id_sesion').val(),
        mostrar_bitacora: $('#mostrar_bitacora_check').val(),
        asignar_costo_servicio: $('#asignar_costo_servicio_check').val(),
        fecha: $('#fecha_servicio').val(),
        cobrado: $('#cobrado').val(),
        cobrado_terminado: $('#cobrado_terminado').val(),
        saldo: $('#saldo').val()
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
            $('#btn-agregar-servicio').removeAttr('disabled');
            toastr.success('Se actualizó el registro exitosamente');
            //Listar();
            BorrarCrear();
            QuitarErroresCrear();
            ActualizarServicioListado(id);
            $("#agregar-servicio").modal('toggle');
        },
        error: function(data)
        {
            $('#btn-agregar-servicio').removeAttr('disabled');
            console.log(data);
            if (data.responseJSON.errors.id_cliente)
            {
                $("#id_cliente_agregar_error").html(data.responseJSON.errors.id_cliente);
                $("#id_cliente_agregar_error").fadeIn();
            }
            else
            {
                $("#id_cliente_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.id_catalogo_servicio)
            {
                $("#id_catalogo_servicio_agregar_error").html(data.responseJSON.errors.id_catalogo_servicio);
                $("#id_catalogo_servicio_agregar_error").fadeIn();
            }
            else
            {
                $("#id_catalogo_servicio_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.costo)
            {
                $("#costo_error").html(data.responseJSON.errors.costo);
                $("#costo_error").fadeIn();
            }
            else
            {
                $("#costo_error").fadeOut();
            }
            if (data.responseJSON.errors.tramite)
            {
                $("#tramite_error").html(data.responseJSON.errors.tramite);
                $("#tramite_error").fadeIn();
            }
            else
            {
                $("#tramite_error").fadeOut();
            }
            if (data.responseJSON.errors.tipo_cambio)
            {
                $("#tipo_cambio_error").html(data.responseJSON.errors.tipo_cambio);
                $("#tipo_cambio_error").fadeIn();
            }
            else
            {
                $("#tipo_cambio_error").fadeOut();
            }
            if (data.responseJSON.errors.id_admin)
            {
                $("#id_admin_error").html(data.responseJSON.errors.id_admin);
                $("#id_admin_error").fadeIn();
            }
            else
            {
                $("#tipo_cambio_error").fadeOut();
            }
            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_servicio_error").html(data.responseJSON.errors.fecha);
                $("#fecha_servicio_error").fadeIn();
            }
            else
            {
                $("#fecha_servicio_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                //console.clear();
            }
            //console.clear();
        }
    });
}

//Limpiar error cuando se cierra ventana modal

var BorrarCrear = function()
{
    $("#id_cliente_agregar").val("").change();
    $("#id_control_agregar").val("").change();
    $("#clase").val("").change();
    $("#id_cat").val("").change();
    $("#aplica_comision_gestion").val("0");
    $('#fecha_servicio').datepicker().datepicker('setDate', 'today');
    $("#aplica_comision_gestion_check").val("0");
    $('#aplica_comision_gestion').prop('checked', false);
    $("#aplica_comision_operativa").val("1");
    $("#aplica_comision_operativa_check").val("1");
    $('#aplica_comision_operativa').prop('checked', true);
    $("#aplica_comision_venta").val("1");
    $("#aplica_comision_venta_check").val("1");
    $('#aplica_comision_venta').prop('checked', true);
    $("#mostrar_bitacora").val("0");
    $("#mostrar_bitacora_check").val("0");
    $('#mostrar_bitacora').prop('checked', false);
    $("#asignar_costo_servicio_check").val("0");
    $('#asignar_costo_servicio').prop('checked', false);
    $("#tramite").val("");
    $("#avance_total_servicio").val("");
    $("#cobrado").val("0");
    $("#cobrado_terminado").val("0");
    $('#id_control_agregar').empty();
    $('#id_control_agregar').append('<option value ="">-Seleccionar Marca-</option>');
}
var QuitarErroresCrear = function()
{
    $("#id_cliente_agregar_error").fadeOut();
    $("#id_catalogo_servicio_agregar_error").fadeOut();
    $("#costo_error").fadeOut();
    $("#tramite_error").fadeOut();
    $("#tipo_cambio_error").fadeOut();

    $('#porcentaje_descuento_error').fadeOut();
    $('#id_catalogo_servicio_agregar_error').fadeOut();
    $('#costo_error').fadeOut();
    $('#tipo_cambio_error').fadeOut();
}

//Menu
var Menu = function(id)
{
    var route = "/admin/procesos/getstatus/" + id;
    $.get(route, function(data)
    {
        $("#menu-title").html('Comisiones de servicio: ' + data.id + ' | ' + data.clave);
        $("#id_servicio_menu").val(data.id);

        listadoComisiones(data.id);
        QuitarErroresComision();
        BorrarComision();


        /*if (data.nombre == null)
        {
            marca = '';
        }
        else
        {
            marca = data.nombre + ',';
        }
        if (data.tramite == null)
        {
            tramite = '';
        }
        else
        {
            tramite = data.tramite;
        }
        if (data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }
        
        facturado_terminado = data.facturado_terminado;
        cobrado_terminado = data.cobrado_terminado;

        $("#nombre_comercial_cobranza").val(data.nombre_comercial);
        $("#id_cliente_cobranza").val(data.id_cliente);
        setTimeout(cargarCobros, 300);

        //Comisiones
        

        if (facturado_terminado == 0)
        {
            $("#nombre_comercial_factura").val(data.nombre_comercial);
            $("#id_cliente_factura").val(data.id_cliente);
            $("#nombre_comercial_recibo").val(data.nombre_comercial);
            $("#id_cliente_recibo").val(data.id_cliente);
            $("#monto_factura").val(data.monto_pendiente);
            $("#monto_factura_limite").val(data.monto_pendiente);
            $("#monto_facturado").val(data.facturado);
            $("#monto_factura").attr('max', data.monto_pendiente);
            $("#monto_factura").attr('min', 1);
            $("#monto_recibo").val(data.monto_pendiente);
            $("#monto_recibo_limite").val(data.monto_pendiente);
            $("#monto_recibido").val(data.facturado);
            $("#monto_recibo").attr('max', data.monto_pendiente);
            $("#monto_recibo").attr('min', 1);
            $("#aplica_iva_recibo").val("0").change();
            $('#aplica_iva_recibo').prop('checked', false);
            $("#aplica_iva_recibo_check").val("0");
            CargarFactura();
            CargarRazonSocial();
            CargarRecibo();
        }
        else if (facturado_terminado == 1)
        {
            $("#nombre_comercial_factura").val(data.nombre_comercial);
            $("#id_cliente_factura").val(data.id_cliente);
            $("#nombre_comercial_recibo").val(data.nombre_comercial);
            $("#id_cliente_recibo").val(data.id_cliente);
            $("#monto_factura").val(0);
            $("#monto_factura_limite").val(0);
            $("#monto_facturado").val(data.facturado);
            $("#monto_factura").attr('max', 0);
            $("#monto_factura").attr('min', 0);
            $("#monto_recibo").val(0);
            $("#monto_recibo_limite").val(0);
            $("#monto_recibido").val(data.facturado);
            $("#monto_recibo").attr('max', 0);
            $("#monto_recibo").attr('min', 0);
            $("#aplica_iva_recibo").val("0").change();
            $('#aplica_iva_recibo').prop('checked', false);
            $("#aplica_iva_recibo_check").val("0");
            CargarFactura();
            CargarRazonSocial();
            CargarRecibo();
        }
        if (data.cobrado_terminado == 0)
        {
            $("#nombre_comercial_cobranza").val(data.nombre_comercial);
            $("#id_cliente_cobranza").val(data.id_cliente);
            setTimeout(cargarCobros, 300);
            setTimeout(cargarDatosCobro, 400);
            setTimeout(cargarCobrosDetalles, 500);
        }
        else if (cobrado_terminado = 1)
        {
            $("#nombre_comercial_cobranza").val(data.nombre_comercial);
            $("#id_cliente_cobranza").val(data.id_cliente);
            setTimeout(cargarCobros, 300);
            setTimeout(cargarDatosCobro, 400);
            setTimeout(cargarCobrosDetalles, 500);
        }*/
    });
    //CargarFactura();
}

/*function CargarFactura()
{
    id_cliente = $("#id_cliente_factura").val();
    var route_facturas = "/admin/procesos/cargarFacturas/" + id_cliente;
    $.get(route_facturas, function(data)
    {
        $('#folio_factura').empty();
        $.each(data, function(index, item)
        {
            $('#folio_factura').prepend('<option value ="' + item.id + '" selected>' + item.folio_factura +
                '</option>');
        });
    });
    setTimeout(cargarDatosFactura, 300);
    setTimeout(cargarDetallesFactura, 300);
}
$("#folio_factura").on('change', function()
{
    setTimeout(cargarDatosFactura, 300);
    setTimeout(cargarDetallesFactura, 300);
});

function cargarDatosFactura()
{
    id_factura = $("#folio_factura").val();
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
        $('#fecha_factura').datepicker().datepicker('setDate', 'today');
        $('#fecha_recibo').datepicker().datepicker('setDate', 'today');
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

function cargarDetallesFactura()
{
    id_factura = $("#folio_factura").val();
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

function CargarRecibo()
{
    id_cliente = $("#id_cliente_recibo").val();
    var route_recibos = "/admin/procesos/cargarRecibos/" + id_cliente;
    $.get(route_recibos, function(data)
    {
        $('#folio_recibo').empty();
        $.each(data, function(index, item)
        {
            $('#folio_recibo').append('<option value ="' + item.id + '">' + item.folio_recibo +
                '</option>');
        });
    });
    setTimeout(cargarDatosRecibo, 1000);
    setTimeout(cargarDetallesRecibo, 1000);
}
$('#aplica_iva_recibo').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_iva_recibo_check").val(this.value);
}).change();
$("#folio_recibo").on('change', function()
{
    setTimeout(cargarDatosRecibo, 300);
    setTimeout(cargarDetallesRecibo, 300);
});

function cargarDatosRecibo()
{
    id_recibo = $("#folio_recibo").val();
    if (id_recibo == null)
    {
        $("#subtotal_recibo").html('0.00');
        $("#subtotal_final_recibo").val("0");
        $("#iva_recibo").html('0.00');
        $("#iva_final_recibo").val("0");
        $("#total_recibo").html('0.00');
        $("#total_final_recibo").val("0");
        $("#pagado_recibo").val("0");
        $("#saldo_recibo").val("0");
        $('#fecha_recibo').datepicker().datepicker('setDate', 'today');
    }
    else
    {
        var route = "/admin/procesos/cargarDatosFactura/" + id_recibo;
        $.get(route, function(data)
        {
            //$("#porcentaje_iva_factura").val(data.porcentaje_iva);
            $("#subtotal_recibo").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#subtotal_final_recibo").val(data.subtotal);
            $("#iva_recibo").html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#iva_final_recibo").val(data.iva);
            $("#total_recibo").html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#total_final_recibo").val(data.total);
            $("#pagado_recibo").val(data.pagado);
            $("#saldo_recibo").val(data.saldo);
            fecha = data.fecha;
            if (data.fecha == null)
            {
                $('#fecha_recibo').datepicker().datepicker('setDate', 'today');
            }
            else
            {
                $("#fecha_recibo").val(data.fecha);
            }
        });
    }
}

function cargarDetallesRecibo()
{
    id_recibo = $("#folio_recibo").val();
    $.ajax(
    {
        type: 'get',
        url: '/admin/procesos/cargarDetalles/' + id_recibo,
        success: function(data)
        {
            $('#servicios-recibidos').empty().html(data);
        }
    });
}

function CargarRazonSocial()
{
    id_cliente = $("#id_cliente_factura").val();
    var route_razon = "/admin/procesos/cargarRazonSocial/" + id_cliente;
    $.get(route_razon, function(data)
    {
        $('#id_razon_social_factura').empty();
        $.each(data, function(index, item)
        {
            $('#id_razon_social_factura').append('<option value ="' + item.id + '">' + item.razon_social +
                ' - ' + item.rfc + '</option>');
        });
    });
}*/

$("#id_cliente_agregar").on('change', function()
{
    id_cliente = $(this).val();
    //facturado = $('#facturado_servicio').val();
    //facturado = facturado * 1;
    datosServicio = document.getElementById('id_cat').value.split('_');
    //console.log(datosServicio);
    id_servicio = datosServicio[0];

    if (id_cliente == '')
    {
        //$("#id_cliente_id").val("");
    }
    else
    {
        //$("#id_cliente_id").val(id_cliente);
        var route = "/admin/procesos/marcas/" + id_cliente;
        $.get(route, function(data)
        {
            $('#id_control_agregar').empty();
            $('#id_control_agregar').append('<option value ="">-Sin selección-</option>');
            $.each(data, function(index, item)
            {
                $('#id_control_agregar').append('<option value ="' + item.id + '">' + item.nombre +
                    '</option>');
            });
        });

        /*if(facturado == 0)
        {
            $('#factura_servicio_select').removeAttr('hidden');
            var route_fact = '/admin/procesos/facturas-cliente/' + id_cliente;

            $('#factura_servicio').empty();

            $.get(route_fact, function(data)
            {
                
                //console.log(data);
                $('#factura_servicio').append('<option value="" selected>-Sin selección-</option>');

                $.each(data, function(index, item)
                {
                    if(item.folio_factura == '')
                    {
                        folio_factura = '';
                    }
                    else
                    {
                        folio_factura = 'Factura: ' + item.folio_factura;
                    }

                    if(item.folio_recibo == '')
                    {
                        folio_recibo = '';
                    }
                    else
                    {
                        folio_recibo = 'Recibo: ' + item.folio_recibo;
                    }

                    $('#factura_servicio').append('<option value ="' + item.id + '_' + item.tipo + '_' + 
                        item.subtotal + '_' + item.porcentaje_iva + '_' + item.iva + '_' + item.total + '_' + 
                        item.pagado + '_' + item.saldo + '_' + item.estatus + '">' + 
                        folio_factura + folio_recibo + '</option>');

                    $('#id_factura_servicio').val(item.id);
                    $('#tipo_factura_servicio').val(item.tipo);
                    $('#subtotal_factura_servicio').val(item.subtotal);
                    $('#porcentaje_iva_factura_servicio').val(item.porcentaje_iva);
                    $('#iva_factura_servicio').val(item.iva);
                    $('#total_factura_servicio').val(item.total);
                    $('#pagado_factura_servicio').val(item.pagado);
                    $('#saldo_factura_servicio').val(item.saldo);
                    $('#estatus_factura_servicio').val(item.estatus);
                });
            });
        }
        else
        {
            $('#factura_servicio_select').attr('hidden', 'hidden');
        }*/

        

        if(id_servicio == '')
        {

        }
        else
        {
            /*var route_descuento = '/admin/procesos/descuentoCliente/' + id_cliente + '/' + id_servicio;

            $.get(route_descuento, function(data)
            {
                //console.log(data);
                if(data.porcentaje_descuento > '0')
                {
                    $('#porcentaje_descuento').val(data.porcentaje_descuento);
                }
                else
                {
                    $('#porcentaje_descuento').val('0');  
                }
            });*/
            mostrarValores();
        }
    }
});

$('#factura_servicio').on('change', function()
{
    valor_factura = $(this).val();
    //console.log(valor_factura);

    if(valor_factura == '')
    {
        //
    }
    else
    {
        datosFactura = document.getElementById('factura_servicio').value.split('_');
        //console.log(datosFactura);
        $('#id_factura_servicio').val(datosFactura[0]);
        $('#tipo_factura_servicio').val(datosFactura[1]);
        $('#subtotal_factura_servicio').val(datosFactura[2]);
        $('#porcentaje_iva_factura_servicio').val(datosFactura[3]);
        $('#iva_factura_servicio').val(datosFactura[4]);
        $('#total_factura_servicio').val(datosFactura[5]);
        $('#pagado_factura_servicio').val(datosFactura[6]);
        $('#saldo_factura_servicio').val(datosFactura[7]);
        $('#estatus_factura_servicio').val(datosFactura[8]);
    }

    //datosServicio = document.getElementById('id_cat').value.split('_');
    //console.log(datosServicio);
    //id_servicio = datosServicio[0];
});

$("#guardar-cliente").click(function()
{
    var route = "/admin/procesos/crear-cliente";
    var token = $("#token_cliente").val();
    var formData = {
        nombre_comercial: $('input[name=nombre_comercial]').val(),
        id_estrategia: $('select[name=id_estrategia]').val(),
        id_admin: $('input[name=id_admin_agregar_cliente]').val()
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
            toastr.success('Se agregó el cliente exitosamente');
            $("#nombre_comercial").val("");
            $("#id_estrategia").val("").change();
            $("#nombre_comercial_error").fadeOut();
            $("#id_estrategia_error").fadeOut();
            $("#agregar-cliente").modal('toggle');
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
            if (data.responseJSON.errors.id_estrategia)
            {
                $("#id_estrategia_error").html(data.responseJSON.errors.id_estrategia);
                $("#id_estrategia_error").fadeIn();
            }
            else
            {
                $("#id_estrategia_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
});
//Agregar Razon Social
$(".cerrar-razon").click(function()
{
    $("#agregar_razon").modal('toggle');
});
$("#agregar_razon").on("hidden.bs.modal", function()
{
    $("#razon_social_razon").val("");
    $("#razon_social_razon_error").fadeOut();
    $("#rfc_razon").val("");
    $("#rfc_razon_error").fadeOut();
});
$("#btn_razon").click(function()
{
    var route = "/admin/procesos/razon-social";
    var token = $('input[name=_token_razon]').val();
    //console.log(token);
    var formData = {
        razon_social: $('input[name=razon_social_razon]').val(),
        rfc: $('input[name=rfc_razon]').val(),
        id_cliente: $('input[name=id_cliente_factura]').val(),
        id_admin: $('input[name=id_admin_razon]').val()
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
            toastr.success('Se agregó la razón social exitosamente');
            CargarRazonSocial();
            $("#agregar_razon").modal('toggle');
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
//Agregar Factura
/*
$(".cerrar-factura").click(function()
{
    $("#agregar_factura").modal('toggle');
});
$("#agregar_factura").on("hidden.bs.modal", function()
{
    $("#folio_factura_agregar").val("");
    $("#folio_factura_agregar_error").fadeOut();
    $("#folio_factura_agregar").focus();
    $("#fecha_factura_error").fadeOut();
    $("#porcentaje_iva_factura_error").fadeOut();
});
$("#btn_agregar_factura").click(function()
{
    AgregarFactura();
});

$('#folio_factura_agregar').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        AgregarFactura();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

function AgregarFactura()
{
    var route = "/admin/procesos/crear-factura";
    var token = $('input[name=_token_factura]').val();
    //console.log(token);
    var formData = {
        folio_factura: $('input[name=folio_factura_agregar]').val(),
        fecha: $('input[name=fecha_factura]').val(),
        porcentaje_iva: $('input[name=porcentaje_iva_factura]').val(),
        id_cliente: $('input[name=id_cliente_factura]').val(),
        id_razon_social: $('select[name=id_razon_social_factura]').val(),
        id_admin: $('input[name=id_admin_factura_agregar]').val()
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
            CargarFactura();
            $("#agregar_factura").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.folio_factura)
            {
                $("#folio_factura_agregar_error").html(data.responseJSON.errors.folio_factura);
                $("#folio_factura_agregar_error").fadeIn();
            }
            else
            {
                $("#folio_factura_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_factura_error").html(data.responseJSON.errors.fecha);
                $("#fecha_factura_error").fadeIn();
            }
            else
            {
                $("#fecha_factura_error").fadeOut();
            }
            if (data.responseJSON.errors.porcentaje_iva)
            {
                $("#porcentaje_iva_factura_error").html(data.responseJSON.errors.porcentaje_iva);
                $("#porcentaje_iva_factura_error").fadeIn();
            }
            else
            {
                $("#porcentaje_iva_factura_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
}


//Agregar Recibo
$(".cerrar-recibo").click(function()
{
    $("#agregar_recibo").modal('toggle');
});
$("#agregar_recibo").on("hidden.bs.modal", function()
{
    $("#folio_recibo_agregar").val("");
    $("#folio_recibo_agregar_error").fadeOut();
    $("#folio_recibo_agregar").focus();
    $("#fecha_recibo_error").fadeOut();
    $("#porcentaje_iva_recibo_error").fadeOut();
});
$("#btn_agregar_recibo").click(function()
{
    AgregarRecibo();
});

$('#folio_recibo_agregar').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        AgregarFactura();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

function AgregarRecibo()
{
    var route = "/admin/procesos/crear-recibo";
    var token = $('input[name=_token_recibo]').val();
    //console.log(token);
    var formData = {
        folio_recibo: $('input[name=folio_recibo_agregar]').val(),
        fecha: $('input[name=fecha_recibo]').val(),
        porcentaje_iva: $('input[name=porcentaje_iva_recibo]').val(),
        id_cliente: $('input[name=id_cliente_recibo]').val(),
        id_admin: $('input[name=id_admin_recibo_agregar]').val()
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
            toastr.success('Se agregó el recibo exitosamente');
            CargarRecibo();
            $("#agregar_recibo").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.folio_recibo)
            {
                $("#folio_recibo_agregar_error").html(data.responseJSON.errors.folio_recibo);
                $("#folio_recibo_agregar_error").fadeIn();
            }
            else
            {
                $("#folio_recibo_agregar_error").fadeOut();
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
            if (data.responseJSON.errors.porcentaje_iva)
            {
                $("#porcentaje_iva_recibo_error").html(data.responseJSON.errors.porcentaje_iva);
                $("#porcentaje_iva_recibo_error").fadeIn();
            }
            else
            {
                $("#porcentaje_iva_recibo_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
}
*/

//Limpiar error cuando se cierra ventana modal
$("#agregar-cliente").on("hidden.bs.modal", function()
{
    $("#nombre_comercial").val("");
    $("#id_estrategia").val("").change();
    $("#nombre_comercial_error").fadeOut();
    $("#id_estrategia_error").fadeOut();
});
//Agregar Marca
$("#guardar-marca").click(function()
{
    var route = "/admin/procesos/crear-marca";
    var token = $("#token_marca").val();
    var formData = {
        nombre: $('input[name=marca]').val(),
        id_cliente: $('select[name=id_cliente_marca]').val(),
        id_admin: $('input[name=id_admin_marca]').val(),
        estatus: $('input[name=estatus_marca]').val(),
        descripcion: $('textarea[name=descripcion_marca]').val(),
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
            toastr.success('Se agregó la marca, obra, título o patente exitosamente.');
            $("#marca").val("");
            $("#descripcion_marca").val("");
            $("#id_cliente_marca").val("").change();
            $("#estatus_marca").val("1").change();
            $('#estatus_marca').prop('checked', true);
            $("#marca_error").fadeOut();
            $("#id_cliente_marca_error").fadeOut();
            $("#agregar-marca").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);
            if (data.responseJSON.errors.nombre)
            {
                $("#marca_error").html(data.responseJSON.errors.nombre);
                $("#marca_error").fadeIn();
            }
            else
            {
                $("#marca_error").fadeOut();
            }
            if (data.responseJSON.errors.id_cliente)
            {
                $("#id_cliente_marca_error").html(data.responseJSON.errors.id_cliente);
                $("#id_cliente_marca_error").fadeIn();
            }
            else
            {
                $("#id_cliente_marca_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if (data.status == 422)
            {
                console.clear();
            }
        }
    });
});

/*$("#menu").on("hidden.bs.modal", function()
{
    QuitarErroresCobranza();
});*/

//Limpiar error cuando se cierra ventana modal
$("#agregar-marca").on("hidden.bs.modal", function()
{
    $("#marca").val("");
    $("#descripcion_marca").val("");
    $("#id_cliente_marca").val("").change();
    $("#estatus_marca").val("1").change();
    $('#estatus_marca').prop('checked', true);
    $("#marca_error").fadeOut();
    $("#id_cliente_marca_error").fadeOut();
});
//Agregar Servicio a factura
$("#btn-facturar").click(function()
{
    $("#btn-facturar").attr('disabled', 'disabled');
    monto_factura = $("#monto_factura").val();
    monto_factura_limite = $("#monto_factura_limite").val();
    monto_factura = monto_factura * 1;
    monto_factura_limite = monto_factura_limite * 1;
    id_servicio_menu = $('#id_servicio_menu').val();

    //console.log(monto_factura_limite);
    //console.log(monto_factura);
    if (monto_factura == 0)
    {
        toastr.error('El servicio ya está facturado');
        $("#btn-facturar").removeAttr('disabled');
    }
    else if (monto_factura > monto_factura_limite)
    {
        toastr.error('El valor del monto a facturar no puede ser mayor a $ ' + monto_factura_limite);
        $("#monto_factura").val(monto_factura_limite);
        $("#monto_factura").focus();
        $("#btn-facturar").removeAttr('disabled');
    }
    else
    {
        var route = "/admin/procesos/facturar-servicio";
        var token = $("#_token_factura_agregar").val();
        var formData = {
            id_factura: $('select[name=folio_factura]').val(),
            con_iva: $('input[name=con_iva_factura]').val(),
            monto_factura_limite: $('input[name=monto_factura_limite]').val(),
            monto: $('input[name=monto_factura]').val(),
            fecha: $('input[name=fecha_factura]').val(),
            facturado: $('input[name=monto_facturado]').val(),
            id_razon_social: $('select[name=id_razon_social_factura]').val(),
            subtotal: $('input[name=subtotal_final_factura]').val(),
            porcentaje_iva: $('input[name=porcentaje_iva_factura]').val(),
            saldo: $('input[name=saldo_factura]').val(),
            pagado: $('input[name=pagado_factura]').val(),
            comentarios: $('textarea[name=comentarios_factura]').val(),
            id_servicio: $('input[name=id_servicio_menu]').val(),
            id_cliente: $('input[name=id_cliente_factura]').val()
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
                $("#btn-facturar").removeAttr('disabled');
                id_servicio_menu = $('#id_servicio_menu').val();
                toastr.success('Se facturó el servicio exitosamente.');
                ActualizarServicioListado(id_servicio_menu);
                //Menu(id_servicio_menu);
                setTimeout(cargarDatosFactura, 100);
                setTimeout(cargarDetallesFactura, 100);
                monto = $("#monto_factura").val();
                monto_limite = $("#monto_factura_limite").val();
                monto_facturado = $("#monto_facturado").val();
                monto_restante = monto_limite - monto;
                facturado = monto_facturado + monto;
                BorrarFacturacion();
                cargarCobrosDetalles();

                var route = "/admin/procesos/getstatus/" + id_servicio_menu;
                $.get(route, function(data)
                {
                    $("#monto_factura").val(data.monto_pendiente);
                    $("#monto_factura_limite").val(data.monto_pendiente);
                    $("#monto_facturado").val(data.facturado);
                    $("#monto_factura").attr('max', data.monto_pendiente);
                    $("#monto_factura").attr('min', 1);
                    $("#monto_recibo").val(data.monto_pendiente);
                    $("#monto_recibo_limite").val(data.monto_pendiente);
                    $("#monto_recibido").val(data.facturado);
                    $("#monto_recibo").attr('max', data.monto_pendiente);
                    $("#monto_recibo").attr('min', 1);
                });
            },
            error: function(data)
            {
                $("#btn-facturar").removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.monto)
                {
                    $("#monto_factura_error").html(data.responseJSON.errors.monto);
                    $("#monto_factura_error").fadeIn();
                }
                else
                {
                    $("#monto_factura_error").fadeOut();
                }
                if (data.responseJSON.errors.porcentaje_iva)
                {
                    $("#porcentaje_iva_factura_error").html(data.responseJSON.errors.porcentaje_iva);
                    $("#porcentaje_iva_factura_error").fadeIn();
                }
                else
                {
                    $("#porcentaje_iva_factura_error").fadeOut();
                }
                if (data.responseJSON.errors.fecha)
                {
                    $("#fecha_factura_error").html(data.responseJSON.errors.fecha);
                    $("#fecha_factura_error").fadeIn();
                }
                else
                {
                    $("#fecha_factura_error").fadeOut();
                }
                if (data.responseJSON.errors.id_factura)
                {
                    $("#folio_factura_error").html(data.responseJSON.errors.id_factura);
                    $("#folio_factura_error").fadeIn();
                }
                else
                {
                    $("#folio_factura_error").fadeOut();
                }
                toastr.error(
                    'No se pudo ingresar el registro, revise los errores en el formulario.');
            }
        });
    }
});
//Agregar Servicio a recibo
$("#btn-recibir").click(function()
{
    $("#btn-recibir").attr('disabled', 'disabled');
    monto_factura = $("#monto_recibo").val();
    monto_factura_limite = $("#monto_recibo_limite").val();
    monto_factura = monto_factura * 1;
    monto_factura_limite = monto_factura_limite * 1;
    id_servicio_menu = $('#id_servicio_menu').val();
    //console.log(monto_factura_limite);
    //console.log(monto_factura);
    if (monto_factura == 0)
    {
        toastr.error('El servicio ya está facturado');
        $("#btn-recibir").removeAttr('disabled');
    }
    else if (monto_factura > monto_factura_limite)
    {
        toastr.error('El valor del monto a facturar no puede ser mayor a $ ' + monto_factura_limite);
        $("#monto_recibo").val(monto_factura_limite);
        $("#monto_recibo").focus();
        $("#btn-recibir").removeAttr('disabled');
    }
    else
    {
        var route = "/admin/procesos/facturar-servicio";
        var token = $("#_token_recibo_agregar").val();
        var formData = {
            id_factura: $('select[name=folio_recibo]').val(),
            con_iva: $('input[name=aplica_iva_recibo_check]').val(),
            monto_factura_limite: $('input[name=monto_recibo_limite]').val(),
            monto: $('input[name=monto_recibo]').val(),
            fecha: $('input[name=fecha_recibo]').val(),
            facturado: $('input[name=monto_recibido]').val(),
            subtotal: $('input[name=subtotal_final_recibo]').val(),
            porcentaje_iva: $('input[name=porcentaje_iva_recibo]').val(),
            saldo: $('input[name=saldo_recibo]').val(),
            pagado: $('input[name=pagado_recibo]').val(),
            comentarios: $('textarea[name=comentarios_recibo]').val(),
            id_servicio: $('input[name=id_servicio_menu]').val(),
            id_cliente: $('input[name=id_cliente_recibo]').val()
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
                $("#btn-recibir").removeAttr('disabled');
                id_servicio_menu = $('#id_servicio_menu').val();
                toastr.success('Se generó el recibo exitosamente.');
                setTimeout(cargarDatosRecibo, 100);
                setTimeout(cargarDetallesRecibo, 100);
                ActualizarServicioListado(id_servicio_menu);
                monto = $("#monto_recibo").val();
                monto_limite = $("#monto_recibo_limite").val();
                monto_facturado = $("#monto_recibido").val();
                monto_restante = monto_limite - monto;
                facturado = monto_facturado + monto;
                cargarDetallesRecibo();
                cargarCobrosDetalles();
                var route = "/admin/procesos/getstatus/" + id_servicio_menu;
                $.get(route, function(data)
                {
                    $("#monto_recibo").val(data.monto_pendiente);
                    $("#monto_recibo_limite").val(data.monto_pendiente);
                    $("#monto_recibo").val(data.facturado);
                    $("#monto_recibo").attr('max', data.monto_pendiente);
                    $("#monto_recibo").attr('min', 1);
                    $("#monto_recibo").val(data.monto_pendiente);
                    $("#monto_recibo_limite").val(data.monto_pendiente);
                    $("#monto_recibido").val(data.facturado);
                    $("#monto_recibo").attr('max', data.monto_pendiente);
                    $("#monto_recibo").attr('min', 1);
                });
                BorrarRecibos();
            },
            error: function(data)
            {
                $("#btn-recibir").removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.monto)
                {
                    $("#monto_recibo_error").html(data.responseJSON.errors.monto);
                    $("#monto_recibo_error").fadeIn();
                }
                else
                {
                    $("#monto_recibo_error").fadeOut();
                }
                if (data.responseJSON.errors.porcentaje_iva)
                {
                    $("#porcentaje_iva_recibo_error").html(data.responseJSON.errors.porcentaje_iva);
                    $("#porcentaje_iva_recibo_error").fadeIn();
                }
                else
                {
                    $("#porcentaje_iva_recibo_error").fadeOut();
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
                if (data.responseJSON.errors.id_factura)
                {
                    $("#folio_recibo_error").html(data.responseJSON.errors.id_factura);
                    $("#folio_recibo_error").fadeIn();
                }
                else
                {
                    $("#folio_recibo_error").fadeOut();
                }
                toastr.error(
                    'No se pudo ingresar el registro, revise los errores en el formulario.');
            }
        });
    }
});

function BorrarFacturacion()
{
    $("#monto_factura_error").fadeOut();
    $("#porcentaje_iva_factura_error").fadeOut();
    $("#fecha_factura_error").fadeOut();
    $("#folio_factura_error").fadeOut();
}

function BorrarRecibos()
{
    $("#monto_recibo_error").fadeOut();
    $("#porcentaje_iva_recibo_error").fadeOut();
    $("#fecha_recibo_error").fadeOut();
    $("#folio_recibo_error").fadeOut();
}
//Cobranza
$('#cuenta_cobranza_agregar').on('change', function()
{
    cuenta = $("#cuenta_cobranza_agregar").val();
    if (cuenta == '1')
    {
        $("#forma_pago_cobranza_agregar").val("1").change();
    }
    else
    {
        $("#forma_pago_cobranza_agregar").val("").change();
    }
});
//Cobranza
$('#cuenta_cobranza').on('change', function()
{
    cuenta = $("#cuenta_cobranza").val();
    if (cuenta == '1')
    {
        $("#forma_pago_cobranza").val("1").change();
    }
    else
    {
        $("#forma_pago_cobranza").val("").change();
    }
});
//Limpiar error cuando se cierra ventana modal
$("#agregar_cobranza").on("hidden.bs.modal", function()
{
    BorrarCobranza();
});
$("#btn_agregar_cobranza").click(function()
{
    BorrarCobranza();
});
//Cerrar modal de cobranza
$(".cerrar-cobranza").click(function()
{
    $("#agregar_cobranza").modal("toggle");
});
var BorrarCobranza = function()
{
    $('#fecha_cobranza_agregar').datepicker().datepicker('setDate', 'today');
    $("#cuenta_cobranza_agregar").val("").change();
    $("#monto_cobranza_agregar").val("");
    $("#cheque_agregar").val("");
    $("#movimiento_agregar").val("");
    $("#comentarios_cobranza_agregar").val("");
    $("#forma_pago_cobranza_agregar_error").fadeOut();
    $("#cuenta_cobranza_agregar_error").fadeOut();
    $("#fecha_cobranza_agregar_error").fadeOut();
    $("#monto_cobranza_agregar_error").fadeOut();
}
var cargarCobros = function()
{
    id_cliente = $("#id_cliente_cobranza").val();
    var route = "/admin/procesos/cobros-cargar/" + id_cliente;
    $.get(route, function(data)
    {
        $('#folio_cobranza').empty();
        $.each(data, function(index, item)
        {
            $('#folio_cobranza').append('<option value ="' + item.id + '">#' + item.id + ' - $' +
                parseFloat(item.deposito, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() +
                '</option>');
        });
    });

    setTimeout(cargarDatosCobro, 400);
    setTimeout(cargarCobrosDetalles, 500);
}

$("#agregar_cobranza").on("hidden.bs.modal", function()
{
    
});

//Agregar cobranza
$("#btn_agregar_cobranza_nueva").click(function()
{
    //$('#btn_agregar_cobranza_nueva').attr("disabled", "disabled");
        
    var route = "/admin/procesos/agregar-ingreso";
    var token = $("#_token_cobranza_agregar").val();
    var formData = 
    {
        id_cliente: $('input[name=id_cliente_cobranza]').val(),
        concepto: $('textarea[name=comentarios_cobranza_agregar]').val(),
        fecha: $('input[name=fecha_cobranza_agregar]').val(),
        cheque: $('input[name=cheque_agregar]').val(),
        movimiento: $('input[name=movimiento_agregar]').val(),
        porcentaje_iva: $('input[name=porcentaje_iva_cobranza_agregar]').val(),
        total: $('input[name=monto_cobranza_agregar]').val(),
        id_forma_pago: $('select[name=forma_pago_cobranza_agregar]').val(),
        id_cuenta: $('select[name=cuenta_cobranza_agregar]').val(),
        id_admin: $('input[name=id_admin_cobranza_agregar]').val()
    }
    console.log(formData);
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
            toastr.success('Se agregó el cobro exitosamente.');
            $('#btn_agregar_cobranza_nueva').removeAttr("disabled");
            $("#agregar_cobranza").modal('toggle');
            cargarCobros();
            BorrarCobranza();
            setTimeout(cargarDatosCobro, 300);
            setTimeout(cargarCobrosDetalles, 400);
            
        },
        error: function(data)
        {
            $('#btn_agregar_cobranza_nueva').removeAttr("disabled");
            console.log(data);
            if (data.responseJSON.errors.id_forma_pago)
            {
                $("#forma_pago_cobranza_agregar_error").html(data.responseJSON.errors.id_forma_pago);
                $("#forma_pago_cobranza_agregar_error").fadeIn();
            }
            else
            {
                $("#forma_pago_cobranza_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.id_cuenta)
            {
                $("#cuenta_cobranza_agregar_error").html(data.responseJSON.errors.id_cuenta);
                $("#cuenta_cobranza_agregar_error").fadeIn();
            }
            else
            {
                $("#cuenta_cobranza_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_cobranza_agregar_error").html(data.responseJSON.errors.fecha);
                $("#fecha_cobranza_agregar_error").fadeIn();
            }
            else
            {
                $("#fecha_cobranza_agregar_error").fadeOut();
            }
            if (data.responseJSON.errors.total)
            {
                $("#monto_cobranza_agregar_error").html(data.responseJSON.errors.total);
                $("#monto_cobranza_agregar_error").fadeIn();
            }
            else
            {
                $("#monto_cobranza_agregar_error").fadeOut();
            }
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
        }
    });

    
    
});

$("#folio_cobranza").on('change', function()
{
    setTimeout(cargarDatosCobro, 300);
    setTimeout(cargarCobrosDetalles, 400);
});

function cargarDatosCobro()
{
    var id_cobranza = $('#folio_cobranza').val();

    if(id_cobranza == null)
    {
        $('#fecha_cobranza').datepicker().datepicker('setDate', 'today');
        $("#cuenta_cobranza").val('').change();
        $("#forma_pago_cobranza").val('').change();
        $("#monto_cobranza").val('0.00');
        $("#deposito").val('0.00');
        $("#monto_cobranza_restante").val('0.00');
        $("#monto_cobranza_restante_mostrar").val('0');
        $("#cheque").val('');
        $("#movimiento").val('');
        $("#comentarios_cobranza").val('');

        //varos
        $("#subtotal_cobranza").html('0.00');
        $("#subtotal_cobranza_final").val('0');
        $("#iva_cobranza_final").val('0');
        $("#iva_cobranza").html('0.00');
        $("#porcentaje_iva_cobranza").val('0');
        $("#total_cobranza").html('0.00');
        $("#total_cobranza_final").val('0');
        $("#pagado_cobranza").val('0.00');
    }
    else
    {
        var route = "/admin/procesos/cobros-datos/" + id_cobranza;
        //console.log(route);
        $.get(route, function(data)
        {
            $("#cuenta_cobranza").val(data.id_cuenta).change();
            $("#forma_pago_cobranza").val(data.id_forma_pago).change();
            $("#monto_cobranza").val(data.deposito);
            $("#deposito").val(data.deposito);
            $("#monto_cobranza_restante").val(data.restante);
            $("#monto_cobranza_restante_mostrar").val(data.restante);
            $("#cheque").val(data.cheque);
            $("#movimiento").val(data.movimiento);
            $("#comentarios_cobranza").val(data.concepto);

            //varos
            $("#subtotal_cobranza").html('$ ' + parseFloat(data.subtotal, 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#subtotal_cobranza_final").val(data.subtotal);
            $("#iva_cobranza_final").val(data.iva);
            $("#iva_cobranza").html('$ ' + parseFloat(data.iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#porcentaje_iva_cobranza").val(data.porcentaje_iva);
            $("#total_cobranza").html('$ ' + parseFloat(data.total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                "$1,").toString());
            $("#total_cobranza_final").val(data.total);
            $("#pagado_cobranza").val(data.pagado);
            fecha = data.fecha;
            if (data.fecha == null)
            {
                $('#fecha_cobranza').datepicker().datepicker('setDate', 'today');
            }
            else
            {
                $("#fecha_cobranza").val(data.fecha);
            }
        });
    }
}

function cargarCobrosDetalles()
{
    var id_cliente = $('#id_cliente_cobranza').val();
    var id_cobranza = $('#folio_cobranza').val();
    var route_pendiente = '/admin/procesos/facturas-pendientes/';
    var route_disponible = '/admin/procesos/cobros-detalles/';

    if ((id_cliente == '' && id_cobranza == '') || (id_cliente == null && id_cobranza == null))
    {
        $('#facturas-detalles-datos').empty();
        $('#facturas-pendientes-cobro').empty();
    }
    else if(id_cliente > '' && (id_cobranza == '' || id_cobranza == null))
    {
        $.ajax(
        {
            type: 'get',
            url: route_pendiente + id_cliente,
            success: function(data)
            {
                $('#facturas-detalles-datos').empty();
                $('#facturas-pendientes-cobro').empty().html(data);
                $(".tooltip").tooltip("hide");

                $("#subtotal_cobranza").html('0.00');
                $("#subtotal_cobranza_final").val('0');
                $("#iva_cobranza_final").val('0');
                $("#iva_cobranza").html('0.00');
                $("#porcentaje_iva_cobranza").val('0');
                $("#total_cobranza").html('0.00');
                $("#total_cobranza_final").val('0');
                $("#pagado_cobranza").val('0.00');
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
            url: route_disponible + id_cobranza + '/' + id_cliente,
            success: function(data)
            {
                $('#facturas-pendientes-cobro').empty();
                $('#facturas-detalles-datos').empty().html(data);
                $(".tooltip").tooltip("hide");
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    }
}

//Actualizar cobranza
$("#btn-actualizar-cobro").click(function()
{   
    var id_cobranza = $('#folio_cobranza').val();
    //console.log(id_cobranza);
    if(id_cobranza == null)
    {
        $("#folio_cobranza_error").html('No hay cobro seleccionado.');
        $("#folio_cobranza_error").fadeIn();
    }
    else
    {
        var pagado = $('#pagado_cobranza').val();
        var restante = $('#monto_cobranza_restante').val();
        var deposito = $('#monto_cobranza').val();
        var total = $('#total_cobranza_final').val();

        deposito = deposito * 1;
        deposito = deposito.toFixed(2);
        diferencia = deposito - total;

        if(deposito == 0)
        {
            $("#monto_cobranza_error").html('El monto total no puede ser igual o menor a 0.');
            $("#monto_cobranza_error").fadeIn();
            $('#monto_cobranza').focus();
        }
        else if(diferencia < 0)
        {
            $("#monto_cobranza_error").html('El monto total no puede ser menor al monto utilizado en facturas/recibos.');
            $("#monto_cobranza_error").fadeIn();
            $('#monto_cobranza').focus();
        }
        else
        {
            var route = "/admin/procesos/actualizar-cobro/" + id_cobranza;
            var token = $("#_token_cobranza").val();
            //console.log(route);
            var formData = 
            {
                fecha: $('input[name=fecha_cobranza]').val(),
                id_cuenta: $('select[name=cuenta_cobranza]').val(),
                id_forma_pago: $('select[name=forma_pago_cobranza]').val(),
                deposito: $('input[name=monto_cobranza]').val(),
                pagado: $('input[name=pagado_cobranza]').val(),
                cheque: $('input[name=cheque]').val(),
                movimiento: $('input[name=movimiento]').val(),
                concepto: $('input[name=comentairos_cobranza]').val(),
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
                    toastr.success('Se actualizó el registro exitosamente');
                    setTimeout(cargarDatosCobro, 200);
                    setTimeout(cargarCobrosDetalles, 300);
                    QuitarErroresCobranza();
                    $('#folio_cobranza option[value="'+id_cobranza+'"]').text('#' + id_cobranza + ' - $' +
                        parseFloat(deposito, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                        .toString());
                },
                error: function(data)
                {
                    console.log(data);
                    if (data.responseJSON.errors.fecha)
                    {
                        $("#fecha_cobranza_error").html(data.responseJSON.errors.fecha);
                        $("#fecha_cobranza_error").fadeIn();
                    }
                    else
                    {
                        $("#fecha_cobranza_error").fadeOut();
                    }
                    if (data.responseJSON.errors.deposito)
                    {
                        $("#monto_cobranza_error").html(data.responseJSON.errors.deposito);
                        $("#monto_cobranza_error").fadeIn();
                    }
                    else
                    {
                        $("#monto_cobranza_error").fadeOut();
                    }
                    if (data.responseJSON.errors.id_cuenta)
                    {
                        $("#cuenta_cobranza_error").html(data.responseJSON.errors.id_cuenta);
                        $("#cuenta_cobranza_error").fadeIn();
                    }
                    else
                    {
                        $("#cuenta_cobranza_error").fadeOut();
                    }
                    if (data.responseJSON.errors.id_forma_pago)
                    {
                        $("#forma_pago_cobranza_error").html(data.responseJSON.errors.id_forma_pago);
                        $("#forma_pago_cobranza_error").fadeIn();
                    }
                    else
                    {
                        $("#forma_pago_cobranza_error").fadeOut();
                    }

                    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                    if (data.status == 422)
                    {
                        console.clear();
                    }
                    console.clear();
                }
            });
        }
    }
    
});

function QuitarErroresCobranza()
{
    $("#fecha_cobranza_error").fadeOut();
    $("#cuenta_cobranza_error").fadeOut();
    $("#forma_pago_cobranza_error").fadeOut();
    $("#monto_cobranza_error").fadeOut();
    $("#folio_cobranza_error").fadeOut();
}



$('#btn-actualizar-factura').on('click', function()
{
    id_servicio = $('#id_servicio_menu').val();
    id_factura = $('#folio_factura').val();
    fecha = $('#fecha_factura').val();
    subtotal = $('#subtotal_final_factura').val();
    porcentaje_iva = $('#porcentaje_iva_factura').val();
    comentarios = $('#comentarios_factura').val();
    id_razon_social = $('#id_razon_social_factura').val();
    con_iva = $('#con_iva_factura').val();
    token = $('#_token_factura').val();

    var formData = 
    {
        id_factura, fecha, subtotal, porcentaje_iva, comentarios, id_razon_social
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/procesos/factura-actualizar/' + id_factura,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se actualizó la factura.');
            cargarDatosFactura();
            ActualizarServicioListado(id_servicio);
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_factura_error").html(data.responseJSON.errors.fecha);
                $("#fecha_factura_error").fadeIn();
            }
            else
            {
                $("#fecha_factura_error").fadeOut();
            }
        }
    });
});

$('#btn-actualizar-recibo').on('click', function()
{
    id_servicio = $('#id_servicio_menu').val();
    id_factura = $('#folio_recibo').val();
    fecha = $('#fecha_recibo').val();
    subtotal = $('#subtotal_final_recibo').val();
    porcentaje_iva = $('#porcentaje_iva_recibo').val();
    comentarios = $('#comentarios_recibo').val();
    con_iva = $('#aplica_iva_recibo_check').val();
    token = $('#_token_recibo').val();

    var formData = 
    {
        id_factura, fecha, subtotal, porcentaje_iva, comentarios, con_iva
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/procesos/factura-actualizar/' + id_factura,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            toastr.success('Se actualizó el recibo.');
            cargarDatosRecibo();
            ActualizarServicioListado(id_servicio);
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_recibo_error").html(data.responseJSON.errors.fecha);
                $("#fecha_recibo_error").fadeIn();
            }
            else
            {
                $("#fecha_recibo_error").fadeOut();
            }
        }
    });
});

function actualizarDatosCobro()
{
    monto_restante = $('#monto_cobranza_restante').val();
    monto_restante = monto_restante * 1;
    //console.log(monto_restante);

    if(monto_restante == 0)
    {
        cargarCobros();
        setTimeout(cargarCobros, 200);
    }
    else if(monto_restante > 0)
    {
        cargarDatosCobro();
        cargarCobrosDetalles();
    }
}

//Comisiones
function Comisiones()
{
    id_servicio = $('#id_servicio_menu').val();

    route = '/admin/procesos/edit-comisiones/' + id_servicio;
    window.open(route, '_blank');

}

//Comentarios
function Comentarios(id_servicio, id_estatus)
{
    //console.log(id_servicio + ' ' + id_estatus);
    route = '/admin/procesos/comentarios/' + id_servicio;
    $('#title-comentarios').html('Comentarios de servicio: ' + id_servicio);

    $.get(route, function(data)
    {
        $('#comentarios_vista').empty().html(data);
        $(".tooltip").tooltip("hide");
        $('#id_servicio_comentarios').val(id_servicio);
        $('#id_estatus_comentarios').val(id_estatus);
    });
}

//Insertar comentario
$("#btn-agregar-comentario").click(function()
{
    token = $('#_token_comentarios').val();
    comentario = $('textarea[name=comentarios_text]').val();
    id_admin = $('input[name=id_admin_comentarios]').val();
    id_servicio = $('input[name=id_servicio_comentarios]').val();
    id_estatus = $('input[name=id_estatus_comentarios').val();

    if(comentario == '')
    {
        toastr.error('Anote un comentario en el recuadro.')
    }
    else
    {
        var formData = 
        {
            comentario,
            id_admin,
            id_servicio,
            id_estatus
        }
        //console.log(formData);
        $.ajax(
        {
            url: '/admin/procesos/comentarios/agregar',
            headers:
            {
                'X-CSRF-TOKEN': token
            },
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(data)
            {
                route = '/admin/procesos/comentarios/' + id_servicio;

                $.get(route, function(data)
                {
                    $('#comentarios_vista').empty().html(data);
                    $('#comentarios_text').val('');
                    $(".tooltip").tooltip("hide");
                });
            },
            error: function(data)
            {
                console.log(data);
                toastr.error('No se pudo ingresar el comentario.');
            }
        });
    }
});

function EditarComentario(id)
{
    $('#parrafo-comentarios-' + id).attr('hidden', 'true');
    $('#textarea-comentarios-' + id).removeAttr('hidden');
    $('#edicion-comentarios-' + id).attr('hidden', 'true');
    $('#actualizar-comentarios-' + id).removeAttr('hidden');

    parrafo = $('#parrafo-comentarios-'+id+'-parrafo').text();
    $('#textarea-comentario-'+id).val(parrafo);
    $('#textarea-comentario-'+id).focus();
}

function ActualizarComentario(id)
{
    var id_servicio = $("#id_servicio_comentarios").val();
    var id_estatus = $("#id_estatus_comentarios").val();
    var comentario = $("#textarea-comentario-" + id).val();

    if(comentario == '')
    {
        toastr.error('Anote algo en el cuadro de texto para poder guardar.')
    }
    else
    {
        var route = "/admin/procesos/comentarios/actualizar/" + id;
        var token = $("#_token_comentarios").val();
        //console.log(route);
        var formData = 
        {
            id_servicio, id_estatus, comentario    
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
                //toastr.success('Se actualizó el registro exitosamente');
                $('#parrafo-comentarios-' + id).removeAttr('hidden');
                $('#textarea-comentarios-' + id).attr('hidden', 'true');
                $('#edicion-comentarios-' + id).removeAttr('hidden');
                $('#actualizar-comentarios-' + id).attr('hidden', 'true');

                parrafo = $('#textarea-comentario-'+id).val();
                $('#parrafo-comentarios-'+id+'-parrafo').text(parrafo);
            },
            error: function(data)
            {
                console.log(data);
                toastr.error('No se pudo actualizar el registro, refresque el navegador.')
            }
        });
    }
    
    
}

function CancelarAcutalizarComentario(id)
{

    $('#parrafo-comentarios-' + id).removeAttr('hidden');
    $('#textarea-comentarios-' + id).attr('hidden', 'true');
    $('#edicion-comentarios-' + id).removeAttr('hidden');
    $('#actualizar-comentarios-' + id).attr('hidden', 'true');

    parrafo = $('#parrafo-comentarios-'+id+'-parrafo').text();
    $('#textarea-comentario-'+id).val(parrafo);
}

function EliminarComentario(id)
{
    id_servicio = $('#id_servicio_comentarios').val();
    token = $('#_token').val();
    $.confirm(
    {
        title: '¿Desea eliminar el comentario?',
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
                    router = '/admin/procesos/comentarios/eliminar/' + id;

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        dataType: 'json',
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data)
                        {
                            //toastr.info('Se eliminó el comentario');

                            route = '/admin/procesos/comentarios/' + id_servicio;
                            //console.log(route);

                            $.get(route, function(data)
                            {
                                $('#comentarios_vista').empty().html(data);
                                $(".tooltip").tooltip("hide");
                            });
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

//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------

//Comisiones
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
        $('#btn-guardar-comision').removeAttr('disabled');
        $('#usuario_repartir_comision_error').html('Seleccione el usuario al cual se va a repartir el 20%');
        $('#usuario_repartir_comision_error').fadeIn();
    }
    else if(repartir_comision == 1 && usuario_repartir == id_admin)
    {
        $('#btn-guardar-comision').removeAttr('disabled');
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
        console.log(formData);
        
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
        $('#tipo_comision').removeAttr('disabled');
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
            $('#monto_disponible_comision').val(data.comision_venta_restante);
            $('#monto_disponible_comision_val').val(data.comision_venta_restante);
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
            $('#monto_max').val(data.max_venta);
            $('#monto_disponible_comision').val(data.comision_gestion_restante);
            $('#monto_disponible_comision_val').val(data.comision_gestion_restante);
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
            $('#monto_disponible_comision').val(data.comision_operativa_restante);
            $('#monto_disponible_comision_val').val(data.comision_operativa_restante);
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
                BorrarComision();
                QuitarErroresComision();
                $('#tipo_comision_select').removeAttr('hidden');
                $('#tipo_comision_input').attr('hidden', 'hidden');
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


//Cálculo de Servicios
$("#id_cat").change(function()
{
    editar_servicio = $('#editar_servicio').val();

    if(editar_servicio == 1)
    {
        porcentajesServicio();
    }
    else if(editar_servicio == 0)
    {
       mostrarValores(); 
    }
    
});

$('#bt_actualizar').click(function()
{
    costo = $('#costo').val();
    actualizarValores(costo);
});

$('#costo').on('keypress', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        costo = $(this).val();
        actualizarValores(costo);
    }
});

$('#btn_tipo_cambio').click(function()
{
    actualizarTipoCambio();
});

$('#tipo_cambio_val').on('keypress', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        actualizarTipoCambio();
    }
});

$('#tipo_cambio_val').on('keypress', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        actualizarTipoCambio();
    }
});

$('#btn_porcentaje_descuento').click(function()
{
     PorcentajeDescuento();
});

$('#porcentaje_descuento').on('keypress', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        PorcentajeDescuento();
    }
});

$('#btn_descuento').click(function()
{
     aplicarDescuento();
});

$('#descuento').on('keypress', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        aplicarDescuento();
    }
});

function PorcentajeDescuento()
{
    porcentaje_descuento = $('#porcentaje_descuento').val();
    costo = $('#costo').val();
    costo_final = $('#costo_final').val();
    tipo_cambio = $('#tipo_cambio_val').val();
    tipo_cambio_ant = $('#tipo_cambio_anterior').val();

    datosServicio = document.getElementById('id_cat').value.split('_');
    //console.log(datosServicio);
    id_servicio = datosServicio[0];

    if(porcentaje_descuento < 0)
    {
        $('#porcentaje_descuento_error').html('El porcentaje no puede ser menor a 0');
        $('#porcentaje_descuento_error').fadeIn();
        $('#porcentaje_descuento').val('0');
    }
    else if(id_servicio == '')
    {
        $('#id_catalogo_servicio_agregar_error').html('Seleccione un servicio primero.');
        $('#id_catalogo_servicio_agregar_error').fadeIn();
    }
    else if(costo < 0 || costo == '')
    {
        $('#costo_error').html('El costo no puede estar vacío o ser menor a 0');
        $('#costo_error').fadeIn();
        $('#costo').val(costo_final);
    }
    else if(tipo_cambio < 0.1 || tipo_cambio == '')
    {
        $('#tipo_cambio_error').html('El tipo de cambio no puede estar vacío ni ser menor a 0.1');
        $('#tipo_cambio_error').fadeIn();
        $('#tipo_cambio_val').val(tipo_cambio_ant);
    }
    else
    {
        QuitarErroresCrear();
        costo_final = costo_final * tipo_cambio;
        descuento = costo_final * (porcentaje_descuento / 100);
        costo = costo_final - descuento;

        descuento = descuento.toFixed(2);
        costo = costo.toFixed(2);

        $('#costo').val(costo);
        $('#descuento').val(descuento);
    }
}

function actualizarTipoCambio()
{
    conversion_nueva = $('#tipo_cambio_val').val();
    conversion = $('#tipo_cambio_val').val();
    conversion_ant = $('#tipo_cambio_anterior').val();
    porcentaje_descuento = $('#porcentaje_descuento').val();
    costo = $('#costo_final').val();

    if(conversion_nueva <= 0)
    {
        $('#tipo_cambio_error').html('El valor no puede ser igual o menor a 0');
        $('#tipo_cambio_error').fadeIn();
        $('#tipo_cambio_val').val(conversion_ant);
    }
    else
    {
        $('#tipo_cambio_anterior').val(conversion_nueva);
        $('#tipo_cambio_error').fadeOut();
        conversion = conversion_nueva / conversion_ant;
        actualizarTotales(costo, conversion, porcentaje_descuento);

        clave = $('#moneda_val').val();
        token = $('#_token').val();

        route = '/admin/procesos/actualizar-tipo-cambio/' + clave;

        formData = {conversion_nueva}
 
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
                toastr.info('Se actualizó el tipo de cambio');
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    }
}

function aplicarDescuento()
{
    descuento = $('#descuento').val();
    costo = $('#costo').val();
    costo_final = $('#costo_final').val();
    tipo_cambio = $('#tipo_cambio_val').val();
    tipo_cambio_ant = $('#tipo_cambio_anterior').val();

    datosServicio = document.getElementById('id_cat').value.split('_');
    //console.log(datosServicio);
    id_servicio = datosServicio[0];

    if(descuento < 0 || descuento == '')
    {
        $('#descuento_error').html('El descuento no puede ser menor a 0 o vacío');
        $('#descuento_error').fadeIn();
        $('#descuento').val('0');
    }
    else if(descuento == 0)
    {
        //
    }
    else if(id_servicio == '')
    {
        $('#id_catalogo_servicio_agregar_error').html('Seleccione un servicio primero.');
        $('#id_catalogo_servicio_agregar_error').fadeIn();
    }
    else if(costo < 0 || costo == '')
    {
        $('#costo_error').html('El costo no puede estar vacío o ser menor a 0');
        $('#costo_error').fadeIn();
        $('#costo').val(costo_final);
    }
    else if(tipo_cambio < 0.1 || tipo_cambio == '')
    {
        $('#tipo_cambio_error').html('El tipo de cambio no puede estar vacío ni ser menor a 0.1');
        $('#tipo_cambio_error').fadeIn();
        $('#tipo_cambio_val').val(tipo_cambio_ant);
    }
    else
    {
        QuitarErroresCrear();
        costo_final = costo_final * tipo_cambio;
        costo = costo_final - descuento;
        porcentaje_descuento = ((costo_final - costo) / costo_final) * 100;

        costo = costo.toFixed(2);
        porcentaje_descuento = porcentaje_descuento.toFixed(2);

        console.log(descuento);

        $('#costo').val(costo);
        $('#porcentaje_descuento').val(porcentaje_descuento);
    }
}

//Calcular Comisiones

function mostrarValores()
{
    id_cliente = $('#id_cliente_agregar').val();

    datosServicio = document.getElementById('id_cat').value.split('_');
    //console.log(datosServicio);
    id_servicio = datosServicio[0];

    $('#id_catalogo_servicio').val(datosServicio[0]);
    //listadoProceso(id_servicio);
    $('#concepto_costo').val(datosServicio[1]).change();
    $('#moneda').val(datosServicio[2]).change();
    $('#moneda_val').val(datosServicio[2]);
    $('#tipo_cambio_val').val(datosServicio[3]);
    $('#tipo_cambio_anterior').val(datosServicio[3]);
    conversion = datosServicio[3];
    $('#costo_ini').val(datosServicio[4]);
    $('#costo_ini_val').val(datosServicio[4]);
    costo_servicio = datosServicio[12];
    $('#costo_servicio').val(costo_servicio);
    costo = datosServicio[4];
    $('#costo_final').val(datosServicio[4]);
    /*$('#concepto_venta').val(datosServicio[5]);
    $('#concepto_venta_val').val(datosServicio[5]);
    $('#comision_venta_val').val(datosServicio[6]);
    $('#comision_venta').val(datosServicio[6]);
    $('#porcentaje_comision_venta').val(datosServicio[6]);
    $('#concepto_operativo').val(datosServicio[7]);
    $('#concepto_operativo_val').val(datosServicio[7]);
    $('#comision_operativa').val(datosServicio[8]);
    $('#comision_operativa_val').val(datosServicio[8]);
    $('#porcentaje_comision_operativa').val(datosServicio[8]);
    $('#concepto_gestion').val(datosServicio[9]);
    $('#concepto_gestion_val').val(datosServicio[9]);
    $('#comision_gestion_val').val(datosServicio[10]);
    $('#comision_gestion').val(datosServicio[10]);
    $('#porcentaje_comision_gestion').val(datosServicio[10]);*/
    $('#id_bitacoras').val(datosServicio[11]).change();
    $('#avance_total_servicio').val(datosServicio[16]);

    bitacora = datosServicio[11];
    if(bitacora == 1 || bitacora == 2)
    {
        $('#mostrar_bitacora').prop('checked', false);
        $('#mostrar_bitacora_check').val('0');
    }
    else 
    {
        $('#mostrar_bitacora').prop('checked', true);
        $('#mostrar_bitacora_check').val('1');
    }

    aplica_venta = $('#aplica_comision_venta_check').val();
    aplica_operativo = $('#aplica_comision_operativa_check').val();
    aplica_gestion = $('#aplica_comision_gestion_check').val();

    concepto_venta = datosServicio[5];
    comision_venta = datosServicio[6];
    porcentaje_venta = datosServicio[13];
    concepto_operativo = datosServicio[7];
    comision_operativa = datosServicio[8];
    porcentaje_operativa = datosServicio[14];
    concepto_gestion = datosServicio[9];
    comision_gestion = datosServicio[10];
    porcentaje_gestion = datosServicio[15];

    if (costo_servicio > 0)
    {
        $("#asignar_costo_servicio").val("1").change();
        $('#asignar_costo_servicio').prop('checked', true);
        $("#asignar_costo_servicio_check").val("1");
    }
    else if (costo_servicio == 0)
    {
        $("#asignar_costo_servicio").val("0").change();
        $('#asignar_costo_servicio').prop('checked', false);
        $("#asignar_costo_servicio_check").val("0");
    }

    if(id_cliente == '')
    {
        actualizarTotales(costo, conversion, 0);  
    }
    else
    {
        if(id_servicio == '')
        {

        }
        else
        {
            route_descuento = '/admin/procesos/descuentoCliente/' + id_cliente + '/' +  id_servicio;

            $.get(route_descuento, function(data)
            {
                //console.log(data);
                if(data.porcentaje_descuento > '0')
                {
                    $('#porcentaje_descuento').val(data.porcentaje_descuento);
                    actualizarTotales(costo, conversion, data.porcentaje_descuento);  

                    if(conversion > 0)
                    {
                        CalcularMontosComision(costo, conversion, data.porcentaje_descuento, concepto_venta, comision_venta, concepto_operativo, 
                            comision_operativa,
                            concepto_gestion, comision_gestion, aplica_venta, aplica_gestion, aplica_operativo, porcentaje_venta,
                            porcentaje_operativa, porcentaje_gestion, costo_servicio);
                    }
                }
                else
                {
                    $('#porcentaje_descuento').val('0');  
                    actualizarTotales(costo, conversion, 0);  

                    if(conversion > 0)
                    {
                        CalcularMontosComision(costo, conversion, 0, concepto_venta, comision_venta, concepto_operativo, 
                            comision_operativa,
                            concepto_gestion, comision_gestion, aplica_venta, aplica_gestion, aplica_operativo, porcentaje_venta,
                            porcentaje_operativa, porcentaje_gestion, costo_servicio);
                    }
                }
            });
        }
    }

    if(conversion > 0)
    {
        CalcularMontosComision(costo, conversion, porcentaje_descuento, concepto_venta, comision_venta, concepto_operativo, comision_operativa,
            concepto_gestion, comision_gestion, aplica_venta, aplica_gestion, aplica_operativo, porcentaje_venta,
            porcentaje_operativa, porcentaje_gestion, costo_servicio);
    }
}

function CalcularMontosComision(costo, conversion, porcentaje_descuento, concepto_venta, comision_venta, concepto_operativo, comision_operativa,
            concepto_gestion, comision_gestion, aplica_venta, aplica_gestion, aplica_operativo, porcentaje_venta,
            porcentaje_operativa, porcentaje_gestion, costo_servicio)
{
    utilidad_bruta = (costo * 1) - (costo_servicio *1);

    // formData = {costo, conversion, porcentaje_descuento, concepto_venta, comision_venta, concepto_operativo, comision_operativa,
    //         concepto_gestion, comision_gestion, aplica_venta, aplica_gestion, aplica_operativo, porcentaje_venta,
    //         porcentaje_operativa, porcentaje_gestion, costo_servicio, utilidad_bruta}

    // console.log(formData);



    //Comision de venta
    if(concepto_venta == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
        $('#porcentaje_comision_venta').val('0');
        comision_venta = comision_venta * conversion;
        $('#comision_venta_constante').val(comision_venta);
    }
    else if(concepto_venta == 'Porcentaje' || concepto_venta == 'Porcentaje Utilidad')
    {
        $('#porcentaje_comision_venta').val(porcentaje_venta);
        comision_venta = ((porcentaje_venta * 1) / 100) * (conversion * 1) * utilidad_bruta;
        comision_venta = Math.round(comision_venta);
        $('#comision_venta_constante').val(comision_venta);
        console.log(comision_venta);
    }

    //Comision de operativa
    if(concepto_operativo == 'Monto Fijo' || concepto_operativo == 'Dolares')
    {
        $('#porcentaje_comision_operativa').val('0');
        comision_operativa = comision_operativa * conversion;
    }
    else if(concepto_operativo == 'Porcentaje' || concepto_operativo == 'Porcentaje Utilidad')
    {
        $('#porcentaje_comision_operativa').val(porcentaje_operativa);
        comision_operativa = ((porcentaje_operativa * 1) / 100) * conversion * utilidad_bruta;
        comision_operativa = Math.round(comision_operativa);
    }

    //Comision de gestion
    if(concepto_gestion == 'Monto Fijo' || concepto_gestion == 'Dolares')
    {
        $('#porcentaje_comision_gestion').val('0');
        comision_gestion = comision_gestion * conversion;
        $('#comision_gestion_constante').val(comision_gestion);
    }
    else if(concepto_gestion == 'Porcentaje' || concepto_gestion == 'Porcentaje Utilidad')
    {
        $('#porcentaje_comision_gestion').val(porcentaje_gestion);
        comision_gestion = (porcentaje_gestion / 100) * conversion * utilidad_bruta;
        comision_gestion = Math.round(comision_gestion);
        $('#comision_gestion_constante').val(comision_gestion);
    }

    if(aplica_venta == 1 && aplica_gestion == 1)
    {
        comision_venta = comision_venta - comision_gestion;
    }
    else if(aplica_venta == 0 && aplica_gestion == 1)
    {
        //comision_venta = comision_venta - comision_gestion;
    }
    else if(aplica_venta == 1 && aplica_gestion == 0)
    {
        // comision_venta = comision_venta + comision_gestion;
    }
    else if(aplica_venta == 0 && aplica_gestion == 0) 
    {
        //comision_venta = comision_venta + comision_gestion;
    }

    /*comision_venta = comision_venta.toFixed(2);
    comision_operativa = comision_operativa.toFixed(2);
    comision_gestion = comision_gestion.toFixed(2);*/

    $('#comision_venta').val(comision_venta);
    $('#comision_venta_val').val(comision_venta);
    $('#concepto_venta').val(concepto_venta).change();
    $('#concepto_venta_val').val(concepto_venta);

    $('#comision_gestion').val(comision_gestion);
    $('#comision_gestion_val').val(comision_gestion);
    $('#concepto_gestion').val(concepto_gestion).change();
    $('#concepto_gestion_val').val(concepto_gestion);

    $('#comision_operativa').val(comision_operativa);
    $('#comision_operativa_val').val(comision_operativa);
    $('#concepto_operativo').val(concepto_operativo).change();
    $('#concepto_operativo_val').val(concepto_operativo);
}

$('#aplica_comision_gestion').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_comision_gestion_check").val(this.value);
    setTimeout(ComisionGestion, 200);
}).change();

$('#aplica_comision_venta').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_comision_venta_check").val(this.value);
    setTimeout(ComisionGestion, 200);
}).change();

function ComisionGestion()
{
    aplica_gestion = $('#aplica_comision_gestion_check').val();
    aplica_venta = $('#aplica_comision_venta_check').val();
    comision_venta = $('#comision_venta_constante').val();
    comision_gestion = $('#comision_gestion_constante').val();

    if(aplica_venta == 0)
    {
        $('#comision_venta_val').val(comision_venta);
        $('#comision_venta').val(comision_venta);
    }
    else
    {
        if(aplica_gestion == 1)
        {
            comision_venta = (comision_venta * 1) - (comision_gestion * 1);
            $('#comision_venta_val').val(comision_venta);
            $('#comision_venta').val(comision_venta);
        }
        else if(aplica_gestion == 0)
        {
            // comision_venta = (comision_venta * 1) + (comision_gestion * 1);
            //console.log(comision_venta);
            $('#comision_venta_val').val(comision_venta);
            $('#comision_venta').val(comision_venta);
        }
    }   
}

function actualizarTotales(costo, conversion, porcentaje_descuento)
{
    costo_parcial = conversion * costo;
    descuento = costo_parcial * (porcentaje_descuento / 100);
    costo_final = costo_parcial - descuento;

    costo_final = costo_final.toFixed(2);
    descuento = descuento.toFixed(2);

    $('#descuento').val(descuento);
    $('#costo').val(costo_final);
    $('#costo_final').val(costo_final);
}

function porcentajesServicio()
{
    datosServicio = document.getElementById('id_cat').value.split('_');

    $('#porcentaje_comision_venta').val(datosServicio[13]);
    $('#porcentaje_comision_operativa').val(datosServicio[14]);
    $('#porcentaje_comision_gestion').val(datosServicio[15]);
}

function actualizarValores(costo)
{

    concepto_venta = $('#concepto_venta_val').val();
    concepto_gestion = $('#concepto_gestion_val').val();
    concepto_operativo = $('#concepto_operativo_val').val();
    costo_servicio = $('#costo_servicio').val();

    porcentaje_venta = $('#porcentaje_comision_venta').val();
    porcentaje_gestion = $('#porcentaje_comision_gestion').val();
    porcentaje_operativo = $('#porcentaje_comision_operativa').val();

    aplica_gestion = $('#aplica_comision_gestion_check').val();
    aplica_venta = $('#aplica_comision_venta_check').val();

    utilidad_bruta = (costo * 1) - (costo_servicio * 1);

    if(concepto_operativo == 'Monto Fijo' || concepto_operativo == 'Dolares')
    {
        //
    }
    else if(concepto_operativo == 'Porcentaje' || concepto_operativo == 'Porcentaje Utilidad')
    {

        comision_operativa =  utilidad_bruta * ((porcentaje_operativo * 1) / 100);

        //comision_operativa = comision_operativa.toFixed(2);
        comision_operativa = Math.round(comision_operativa);

        $('#comision_operativa').val(comision_operativa);
        $('#comision_operativa_val').val(comision_operativa);
    }

    //Comision de gestion
    if(concepto_gestion == 'Monto Fijo' || concepto_gestion == 'Dolares')
    {
        //
    }
    else if(concepto_gestion == 'Porcentaje' || concepto_gestion == 'Porcentaje Utilidad')
    {
        comision_gestion =  utilidad_bruta * ((porcentaje_gestion * 1) / 100);
        comision_gestion_entregar = comision_gestion * 1;

        //comision_gestion = comision_gestion.toFixed(2);
        comision_gestion = Math.round(comision_gestion);

        $('#comision_gestion').val(comision_gestion);
        $('#comision_gestion_val').val(comision_gestion);
        $('#comision_gestion_constante').val(comision_gestion);
    }  

    //Comision de venta
    if(concepto_venta == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
        //
    }
    else if(concepto_venta == 'Porcentaje' || concepto_venta == 'Porcentaje Utilidad')
    {
        comision_venta = utilidad_bruta * ((porcentaje_venta * 1) / 100);
        comision_venta = Math.round(comision_venta);

        $('#comision_venta_constante').val(comision_venta);

        if(aplica_venta == 1 && aplica_gestion == 1)
        {
            comision_venta = comision_venta - comision_gestion_entregar;
            comision_venta = Math.round(comision_venta);
        }

        //comision_venta = comision_venta.toFixed(2);
        

        $('#comision_venta').val(comision_venta);
        $('#comision_venta_val').val(comision_venta);
        // console.log(comision_venta);
    }  
}

/*function listadoProceso(id_servicio)
{
    route_proc = '/admin/procesos/listadoProceso/';
    //console.log(route_proc);
    $.ajax(
    {
        type: 'get',
        url: route_proc + id_servicio,
        success: function(data)
        {
            $('#listado-proceso').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });  
}*/

//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------
//Bitácoras
function TramitesNuevos()
{
    listar = $('#tramites_nuevos_url_listar').val();
    buscar = $('#tramites_nuevos_url_buscar').val();
    actualizar = $('#tramites_nuevos_url_actualizar').val();
    parametro = $('#tramites_nuevos_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function EstudiosFactibilidad()
{
    listar = $('#estudios_factibilidad_url_listar').val();
    buscar = $('#estudios_factibilidad_url_buscar').val();
    actualizar = $('#estudios_factibilidad_url_actualizar').val();
    parametro = $('#estudios_factibilidad_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function Negativas()
{
    listar = $('#negativas_url_listar').val();
    buscar = $('#negativas_url_buscar').val();
    actualizar = $('#negativas_url_actualizar').val();
    parametro = $('#negativas_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function Requisitos()
{
    listar = $('#requisitos_url_listar').val();
    buscar = $('#requisitos_url_buscar').val();
    actualizar = $('#requisitos_url_actualizar').val();
    parametro = $('#requisitos_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function TitulosyCertificados()
{
    listar = $('#titulos_url_listar').val();
    buscar = $('#titulos_url_buscar').val();
    actualizar = $('#titulos_url_actualizar').val();
    parametro = $('#titulos_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

$(document).on("click", ".pagination-tramite-nuevo .pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado-parametro").val();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-' + listado).empty().html(data);
        }
    });
});

$(document).on("click", ".pagination-estudios-factibilidad .pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado-parametro").val();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-' + listado).empty().html(data);
        }
    });
});

$(document).on("click", ".pagination-negativas .pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado-parametro").val();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-' + listado).empty().html(data);
        }
    });
});

$(document).on("click", ".pagination-requisitos .pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado-parametro").val();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-' + listado).empty().html(data);
        }
    });
});

$(document).on("click", ".pagination-titulos .pagination li a", function(e)
{
    e.preventDefault();
    listado = $("#listado-parametro").val();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-' + listado).empty().html(data);
        }
    });
});

//Mostrar sidebar de Bitácora
$(document).on('click', '[data-click="theme-panel-expand"]', function() {
    var targetContainer = '.theme-panel';
    var targetClass = 'active';
    $(targetContainer).addClass(targetClass);
});

$(document).on('click', '[data-click="theme-panel-close"]', function() {
    var targetContainer = '.theme-panel';
    var targetClass = 'active';
    $(targetContainer).removeClass(targetClass);
    $('.bitacora-class').removeClass('bitacora_selected');
});

function FechaVencimiento(id, created_at, fecha_vencimiento)
{
    route = '/admin/bitacoras/negativas-vencimiento/' + id;
    $('#id_servicio_vencimiento').val(id);

    split_created_at = created_at.split(' ');
    created_at = split_created_at[0];
    $('#created_at_vencimiento').val(created_at);
    $('#fecha_recepcion_vencimiento').val(created_at);

    if(fecha_vencimiento == '')
    {
        $.get(route, function(data)
        {
            vencimiento = data.date;
            split_fecha = vencimiento.split(' ');
            fecha_vencimiento = split_fecha[0];
            $('#fecha_vencimiento_vencimiento').val(fecha_vencimiento);
            //console.log(fecha_vencimiento);
        });
    }
    else
    {
        split_vencimiento = fecha_vencimiento.split(' ');
        vencimiento = split_vencimiento[0];
        $('#fecha_vencimiento_vencimiento').val(vencimiento);
    }
}

$('#btn-guardar-vencimiento').click(function()
{
    $('#btn-guardar-vencimiento').attr('disabled', 'disabled');
    token = $('#_token').val();
    id = $('#id_servicio_vencimiento').val();
    fecha_vencimiento = $('#fecha_vencimiento_vencimiento').val();
    created_at = $('#created_at_vencimiento').val();
    route = '/admin/bitacoras/guardar-vencimiento/' + id;

    if(fecha_vencimiento <= created_at)
    {
        $("#fecha_vencimiento_vencimiento_error").html('La fecha de vencimiento no puede ser igual o menor a la fecha de recepción');
        $("#fecha_vencimiento_vencimiento_error").fadeIn();
    }
    else
    {
        $("#fecha_vencimiento_vencimiento_error").fadeOut();
        formData={fecha_vencimiento}

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
                $('#btn-guardar-vencimiento').removeAttr('disabled');
                toastr.success('Se actualizó la fecha de vencimiento');
                ActualizarServicioListado(id);
                $('#fecha_vencimiento_vencimiento').val('');
                $("#modal-vencimiento").modal('toggle');

            },
            error: function(data)
            {
                $('#btn-guardar-vencimiento').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.fecha_vencimiento)
                {
                    $("#fecha_vencimiento_vencimiento_error").html(data.responseJSON.errors.fecha_vencimiento);
                    $("#fecha_vencimiento_vencimiento_error").fadeIn();
                }
                else
                {
                    $("#fecha_vencimiento_vencimiento_error").fadeOut();
                }
                
                
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                if (data.status == 422)
                {
                    console.clear();
                }
                //console.clear();
            }
        });
    }
});

//Proceso
function CargarProceso(id, id_catalogo_servicio, id_estatus, avance_total, avance, nombre_comercial, /*registro, id_control*/)
{
    $('.bitacora-class').removeClass('bitacora_selected');
    $('#bitacora-id-' + id).addClass('bitacora_selected');

    $('.bitacora-title').html('Proceso de servicio: ' + id + ' | Cliente: ' + nombre_comercial);
    Proceso(id, id_catalogo_servicio);
    Comentarios(id, id_estatus);
    $("#logo_url_error").fadeOut();

    $('#avance_total_bitacora').val(avance_total);
    $('#avance_parcial_bitacora').val(avance);
    $('#id_servicio_proceso').val(id);    
}

function Proceso(id, id_catalogo_servicio)
{
    route = '/admin/bitacoras/procesos-listado/';
    
    //console.log(route);
    $.ajax(
    {
        type: 'get',
        url: route + id + '/' + id_catalogo_servicio,
        success: function(data)
        {
            $('#proceso-listado-options').empty().html(data);
            $(".tooltip").tooltip("hide");
            console.clear();
            //$('.checkbox_proceso').removeAttr(disabled);
        },
        error: function(data)
        {
            console.log(data);
        }
    });
}

function GenerarProceso(id)
{
    var avance_total = $('#process-list tbody tr').length;
    id_catalogo_servicio = $('#id_catalogo_servicio_proceso').val();
    token = $('#_token').val();
    $('.btn-generar-proceso').attr('disabled', 'disabled');
    formData = {avance_total}
    //location.href = '/admin/check-list/edit/' + id;
    console.log(avance_total);

    if(avance_total == 0)
    {
        toastr.error('No se puede generar el proceso debido a que no tiene pasos, cree un proceso para el catálogo del servicio.');
    }
    else
    {
        var TableData;
        TableData = $.toJSON(storeTableValues(id));

        $.ajax(
        {
            type: 'POST',
            headers:
            {
                'X-CSRF-TOKEN': token
            },
            url: '/admin/procesos/insertarProceso',
            data: 'string=' + TableData,
            success: function(data)
            {
                $.ajax(
                {   
                    type: 'PUT',
                    headers:
                    {
                        'X-CSRF-TOKEN': token
                    },
                    url: '/admin/procesos/editar-avance-total/' + id,
                    data: formData,
                    success: function(data)
                    {
                        $('.btn-generar-proceso').removeAttr('disabled');
                        toastr.success('Se generó el proceso exitosamente');
                        Proceso(id, id_catalogo_servicio);
                        CountOperacionesNotificacion();
                        CountGestionNotificacion();
                        CountJuridicoNotificacion();
                    },
                    error: function(data)
                    {
                        console.log(data);
                        $('.btn-generar-proceso').removeAttr('disabled');
                        toastr.error('No se pudo editar el avance total.');
                    }
                });
            },
            error: function(data)
            {
                toastr.error('No se pudo insertar el proceso del servicio.');
                $('.btn-generar-proceso').removeAttr('disabled');
                console.log(data);
            }
        });
    }
}

function GestionarPago(id)
{
    token = $('#_token').val();
    $('#gestionar_pago').attr('disabled', 'disabled');
    value = $('#gestionar_pago_check').val();

    if(value == 1)
    {
        value = 0;
    }
    else if(value == 0)
    {
        value = 1;
    }

    formData = {value}

    route = '/admin/check-gestionar-pago/' + id;

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
            $('#gestionar_pago').removeAttr('disabled');
            $('#gestionar_pago_check').val(value);

            if(value == 0)
            {
                $('#gestionar_pago').prop('checked', false);
            }
            else if(value == 1)
            {
                $('#gestionar_pago').prop('checked', true);
            }

        },
        error: function(data)
        {
            console.log(data);
            $('#gestionar_pago').removeAttr('disabled');
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            if(value == 0)
            {
                $('#gestionar_pago').prop('checked', true);
                $('#gestionar_pago_check').val('1');
            }
            else if(value == 1)
            {
                $('#gestionar_pago').prop('checked', false);
                $('#gestionar_pago_check').val('0');
            }

            if (data.status == 422)
            {
                console.clear();
            }
            //console.clear();
        }
    });
}

function Check(id, id_servicio, libera_venta, libera_operativa, libera_gestion, registro, id_control,
    categoria, area)
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

    formData =
    {
        id, id_servicio, estatus, libera_venta, libera_operativa, libera_gestion, id_admin, avance, registro, id_control
    }

    //console.log(formData);

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
                $('.checkbox_proceso').removeAttr('disabled');
                //toastr.success('Se actualizó el registro exitosamente');
                $('#estatus_val-' + id).val(estatus);
                $('#avance_parcial_bitacora').val(avance);
                ActualizarServicioListado(id_servicio);
                CountOperacionesNotificacion();
                CountGestionNotificacion();
                CountJuridicoNotificacion();
                $('#bitacora-id-' + id).addClass('bitacora_selected');
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
                $('.checkbox_proceso').removeAttr('disabled');
                //toastr.success('Se actualizó el registro exitosamente');
                $('#estatus_val-' + id).val(estatus);
                $('#avance_parcial_bitacora').val(avance);
                ActualizarServicioListado(id_servicio);
                CountOperacionesNotificacion();
                CountGestionNotificacion();
                CountJuridicoNotificacion();
                $('#bitacora-id-' + id).addClass('bitacora_selected');
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
}

function CountJuridicoNotificacion()
{
    route = '/admin/notificacion/servicios-juridico';

    $.get(route, function(data)
    {
        count = Object.keys(data).length;
        //console.log(count);
        if(count == '0')
        {
            $('#notificaciones_juridico_count').html('0');
            $('#notificaciones_juridico_count').css(
            {
                'background' : 'rgba(73, 173, 173, 0.5)'
            });
        }
        else if(count > 0)
        {
            
            $('#notificaciones_juridico_count').html(count);
        }
    });
}

function CountGestionNotificacion()
{
    route = '/admin/notificacion/servicios-gestion';

    $.get(route, function(data)
    {
        count = Object.keys(data).length;
        //console.log(count);
        if(count == '0')
        {
            $('#notificaciones_gestion_count').html('0');
            $('#notificaciones_gestion_count').css(
            {
                'background' : 'rgba(73, 173, 173, 0.5)'
            });
        }
        else if(count > 0)
        {
            
            $('#notificaciones_gestion_count').html(count);
        }
    });
}

function CountOperacionesNotificacion()
{
    route = '/admin/notificacion/servicios-operaciones';

    $.get(route, function(data)
    {
        count = Object.keys(data).length;
        //console.log(count);
        if(count == '0')
        {
            $('#notificaciones_operaciones_count').html('0');
            $('#notificaciones_operaciones_count').css(
            {
                'background' : 'rgba(73, 173, 173, 0.5)'
            });
        }
        else if(count > 0)
        {
            
            $('#notificaciones_operaciones_count').html(count);
        }
    });
}

function GuardarEstatusTramite()
{
    token = $('#_token').val();
    id_servicio = $('#id_servicio_proceso').val();
    estatus_registro = $('#estatus_registro_bitacora').val();
    //console.log(id_servicio);
    formData =
    {
        estatus_registro
    }

    route = '/admin/bitacoras/guardar_estatus/' + id_servicio;

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
            toastr.success('Se guardó el estatus exitosamente.');
            ActualizarServicioListado(id_servicio);
            Proceso(id_servicio);
        },
        error: function(data)
        {
            toastr.error('No se pudo guardar el registro, revise los errores en el formulario.');
            console.log(data);

            if (data.status == 422)
            {
                //console.clear();
            }
            //console.clear();
        }
    });
}

function CargarLogoModal(id)
{
    $('#id_servicio_logo_modal').val(id);
    $('#logo-header').html('Cargar logo para marca');
}

function GuardarLogo()
{
    logo_url = $('#logo_url').val();
    formdata = new FormData($('#logo_url').val());
    var id = $('#id_servicio_proceso').val();
    var route = '/admin/bitacoras/logo-insertar/' + id;
    //var file = logo_url.files[0];
    if (logo_url == '') 
    {
        //formdata.append("logo_url", file);
        
    }
    else
    {
        $.ajax(
        {
            url: route,
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success:function(data)
            {
                $("#logo_url_error").fadeOut();
                //var logo_url = '{{ URL::asset('/images/logos/') }}' + '/' + data.logo_url;
                //$('#logo_url_bitacora').attr('src', logo_url);
                $(".tooltip").tooltip("hide");
                toastr.info('Imagen cargada con éxito');
            },
            error: function(data)
            {
                console.clear();
                if (data.responseJSON.errors.logo_url)
                {
                    $("#logo_url_error").html(data.responseJSON.errors.logo_url);
                    $("#logo_url_error").fadeIn();
                }
                else
                {
                    $("#logo_url_error").fadeOut();
                }
            }
        });
    }
}


//Estatus
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
function Estatus(id, id_estatus, id_marca, marca, id_cliente, id_catalogo_servicio, id_clase)
{
    route_edit = '/admin/procesos/' + id + '/edit'
    $('#estatus_boolean').val('0');

    $.get(route_edit, function(data)
    {
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('.modal-title').html('Actualizar estatus de: ' + data.marca + ' ' + clase);
    });

    
    $('#id_marca_tramites').val(id_marca);
    $('#id_cliente_tramites').val(id_cliente);
    $('#id_clase_tramites').val(id_clase);
    $('#id_servicio_tramites').val(id);
    $('#id_catalogo_servicio_tramites').val(id_catalogo_servicio);
    $('#id_estatus_tramites').val(id_estatus);

    if(id_catalogo_servicio == 74)
    {
        $('#comprueba_uso').removeAttr('disabled');
        $('#comprueba_uso').attr('checked', 'checked');
        $('#comprueba_uso_check').val('1');
    }
    else
    {
        $('#comprueba_uso').attr('disabled', 'disabled');
        $('#comprueba_uso').attr('unchecked', 'unchecked');
        $('#comprueba_uso_check').val('0');
    }

    $.ajax(
    {
        type: 'get',
        url: '/admin/estatus-marcas/' + id_marca,
        success: function(data)
        {
            $('#listado-estatus').empty().html(data);
            $(".tooltip").tooltip("hide");
        } 
    });   

    if(id_estatus == 0)
    {
        LimpiarEstatus();
        route = '/admin/bitacora/editar_servicio/' + id,

        $.get(route, function(data)
        {
            $('#fecha_inicio_tramites').val(data.fecha_registro);
        });

    }
    else
    {
        
        route = '/admin/bitacora/get_editar_estatus/' + id_estatus;
        $.get(route, function(data)
        {   
            //console.log(data);
            $('#id_bitacoras_estatus_tramites').val(data.id_bitacoras_estatus).change();
            $('#id_bitacoras_estatus_tramites_value').val(data.id_bitacoras_estatus);
            $('#id_subcategoria_estatus_tramites').val(data.id_subcategoria);
            $('#comprobacion_uso_tramites').val(data.comprobacion);
            $('#vencimiento_tramites').val(data.vencimiento);
            $('#recordatorio_tramites').val(data.recordatorio);
            $('#id_estatus_tramites').val(data.id);
            $('#fecha_inicio_tramites').val(data.fecha_inicio);
            $('#fecha_comprobacion_uso_tramites').val(data.fecha_comprobacion_uso);
            $('#fecha_vencimiento_tramites').val(data.fecha_vencimiento);
            $('#fecha_recordatorio_tramites').val(data.fecha_recordatorio);
            $('#numero_expediente_tramites').val(data.numero_expediente);
            $('#numero_registro_tramites').val(data.numero_registro);
            $('#id_estatus_val').val(data.id_estatus);
            $('#estatus_tramites').val(data.id_estatus+'_'+data.color+'_'+data.texto).change();

            $('#subcategoria_estatus_tramites').empty();
            if(data.id_subcategoria > 0)
            {
                $('#subcategoria_estatus_tramites').append('<option value ="' + data.id_subcategoria + '_' + data.renovacion + 
                            '_' + data.vencimiento + '_' + data.recordatorio + '_' + data.comprobacion + '_' + 1 +
                            '_' + data.fecha_vencimiento + '_' + data.fecha_recordatorio + '_' + data.fecha_comprobacion_uso +
                            '" selected>' + data.subcategoria + '</option>' +
                            '<option value ="">--------------------</option>');
            }
            else
            {
                $('#subcategoria_estatus_tramites').append('<option value ="">-Sin selección-</option>');
            }

            route = '/admin/estatus-subcategoria/' + data.id_bitacoras_estatus;

            $.get(route, function(data)
            {
                $.each(data, function(index, item)
                {
                    $('#subcategoria_estatus_tramites').append('<option value ="' + item.id + '_' + item.renovacion + 
                            '_' + item.vencimiento + '_' + item.recordatorio + '_' + item.comprobacion_uso + '_' + 
                            2 + '">' + item.subcategoria + '</option>');
                });
            });

            if(data.id_estatus == '')
            {
                $('.modal-header').removeAttr('style');
                $('.modal-title').removeAttr('style');
                $('.close').removeAttr('style');
            }
            else
            {
                $('.modal-header').css(
                {
                    'background-color': data.color
                });
                $('.modal-title').css(
                {
                    'color': data.texto
                });
                $('.close').css(
                {
                    'color': data.texto,
                    'font-size': 35
                });
            }
        });
    }

    setTimeout(EstatusBoolean, 1000);
}

function EnviarDatosEstatus(id)
{
    route = '/admin/bitacora/get_editar_estatus/' + id;
    $.get(route, function(data)
    {   
        //console.log(data);
        $('#id_bitacoras_estatus_tramites').val(data.id_bitacoras_estatus).change();
        $('#id_bitacoras_estatus_tramites_value').val(data.id_bitacoras_estatus);
        $('#id_subcategoria_estatus_tramites').val(data.id_subcategoria);
        $('#comprobacion_uso_tramites').val(data.comprobacion);
        $('#vencimiento_tramites').val(data.vencimiento);
        $('#recordatorio_tramites').val(data.recordatorio);
        $('#id_estatus_tramites').val(data.id);
        $('#fecha_inicio_tramites').val(data.fecha_inicio);
        $('#fecha_comprobacion_uso_tramites').val(data.fecha_comprobacion_uso);
        $('#fecha_vencimiento_tramites').val(data.fecha_vencimiento);
        $('#fecha_recordatorio_tramites').val(data.fecha_recordatorio);
        $('#numero_expediente_tramites').val(data.numero_expediente);
        $('#numero_registro_tramites').val(data.numero_registro);
        $('#id_estatus_val').val(data.id_estatus);
        $('#estatus_tramites').val(data.id_estatus+'_'+data.color+'_'+data.texto).change();

        $('#subcategoria_estatus_tramites').empty();
        if(data.id_subcategoria > 0)
        {
            $('#subcategoria_estatus_tramites').append('<option value ="' + data.id_subcategoria + '_' + data.renovacion + 
                        '_' + data.vencimiento + '_' + data.recordatorio + '_' + data.comprobacion + '_' + 1 +
                        '_' + data.fecha_vencimiento + '_' + data.fecha_recordatorio + '_' + data.fecha_comprobacion_uso +
                        '" selected>' + data.subcategoria + '</option>' +
                        '<option value ="">--------------------</option>');
        }
        else
        {
            $('#subcategoria_estatus_tramites').append('<option value ="">-Sin selección-</option>');
        }

        route = '/admin/estatus-subcategoria/' + data.id_bitacoras_estatus;

        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#subcategoria_estatus_tramites').append('<option value ="' + item.id + '_' + item.renovacion + 
                        '_' + item.vencimiento + '_' + item.recordatorio + '_' + item.comprobacion_uso + '_' + 
                        2 + '">' + item.subcategoria + '</option>');
            });
        });

        if(data.id_estatus == '')
        {
            $('.modal-header').removeAttr('style');
            $('.modal-title').removeAttr('style');
            $('.close').removeAttr('style');
        }
        else
        {
            $('.modal-header').css(
            {
                'background-color': data.color
            });
            $('.modal-title').css(
            {
                'color': data.texto
            });
            $('.close').css(
            {
                'color': data.texto,
                'font-size': 35
            });
        }
    });

    setTimeout(EstatusBoolean, 1000);
}

$('#comprueba_uso').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#comprueba_uso_check").val(this.value);
}).change();

$('#id_bitacoras_estatus_tramites').change(function()
{
    id_categoria = $(this).val();
    estatus_boolean = $('#estatus_boolean').val();

    if(estatus_boolean == 1)
    {
        route = '/admin/estatus-subcategoria/' + id_categoria;
        $('#subcategoria_estatus_tramites').empty();
        $('#subcategoria_estatus_tramites').append('<option value ="">-Sin selección-</option>');

        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#subcategoria_estatus_tramites').append('<option value ="' + item.id + '_' + item.renovacion + 
                        '_' + item.vencimiento + '_' + item.recordatorio + '_' + item.comprobacion_uso + '_' + 
                        2 + '">' + item.subcategoria + '</option>');
            });
        });
        //console.log(estatus_boolean);
    }
    else
    {
        //
    }
});

$('#subcategoria_estatus_tramites').change(function()
{
    subcategoria = $(this).val();
    fecha_inicio = $('#fecha_inicio_tramites').val();
    estatus_boolean = $('#estatus_boolean').val();
    token = $('#_token').val();

    if(estatus_boolean == 1)
    {
        if(subcategoria == '')
        {
            //
        }
        else
        {
            fecha_registro = $('#fecha_inicio_tramites').val();
            Subcategoria = document.getElementById('subcategoria_estatus_tramites').value.split('_');

            //console.log(Subcategoria);
            id = Subcategoria[0];
            renovacion = Subcategoria[1];
            vencimiento = Subcategoria[2];
            vencimiento = vencimiento * 1;
            recordatorio = Subcategoria[3];
            recordatorio = recordatorio * 1;
            comprobacion_uso = Subcategoria[4];
            comprobacion_uso = comprobacion_uso * 1;
            tipo = Subcategoria[5];

            if(comprobacion_uso == 0)
            {
                $('#bool_declaracion_uso').attr('hidden', 'hidden');
                aplica_comprobacion = 0;
                $('#comprueba_uso_check').val(aplica_comprobacion);
            }
            else
            {
                $('#bool_declaracion_uso').removeAttr('hidden');
                aplica_comprobacion = 1;
                $('#comprueba_uso_check').val(aplica_comprobacion);
            }

            if(tipo == 2)
            {
                route = '/admin/bitacora/enviar-fechas/' + id + '/' + fecha_inicio + '/' + comprobacion_uso +
                '/' + recordatorio + '/' + vencimiento + '/' + aplica_comprobacion;

                //console.log(route);

                $.get(route, function(data)
                {
                    //console.log(data);
                    $('#fecha_comprobacion_uso_tramites').val(data.fecha_comprobacion_uso);
                    $('#fecha_vencimiento_tramites').val(data.fecha_vencimiento);
                    $('#fecha_recordatorio_tramites').val(data.fecha_recordatorio);
                });
            }
            else if(tipo == 1)
            {
                fecha_vencimiento = Subcategoria[6];
                fecha_recordatorio = Subcategoria[7];
                fecha_comprobacion_uso = Subcategoria[6];
                $('#fecha_comprobacion_uso_tramites').val(fecha_comprobacion_uso);
                $('#fecha_recordatorio_tramites').val(fecha_recordatorio);
                $('#fecha_vencimiento_tramites').val(fecha_vencimiento);
            }

            $('#comprobacion_uso_tramites').val(comprobacion_uso);
            $('#recordatorio_tramites').val(recordatorio);
            $('#vencimiento_tramites').val(vencimiento);
            $('#id_subcategoria_estatus_tramites').val(id);
        }
    }
    else
    {
        if(subcategoria == '')
        {
            //
        }
        else
        {
            /*Subcategoria = document.getElementById('subcategoria_estatus_tramites').value.split('_');
            //console.log(Subcategoria);
            id = Subcategoria[0];
            renovacion = Subcategoria[1];
            vencimiento_boolean = Subcategoria[2];
            vencimiento = Subcategoria[3];
            vencimiento = vencimiento * 1;
            comprobacion_uso_boolean = Subcategoria[4];
            comprobacion_uso = Subcategoria[5];
            comprobacion_uso = comprobacion_uso * 1;
            plazo = Subcategoria[6];

            $('#renovacion_tramites').val(renovacion);
            $('#vencimiento_tramites').val(vencimiento);
            $('#comprobacion_uso_tramites').val(comprobacion_uso);
            $('#parametro_tramite').val(plazo).change();
            $('#id_subcategoria_estatus_tramites').val(id);*/
        }
    }

});

$('#btn-actualizar-fechas').click(function()
{
    id = $('#id_subcategoria_estatus_tramites').val();
    fecha_inicio = $('#fecha_inicio_tramites').val();
    vencimiento = $('#vencimiento_tramites').val();
    vencimiento = vencimiento * 1;
    comprobacion_uso = $('#comprobacion_uso_tramites').val();
    comprobacion_uso = comprobacion_uso * 1;
    recordatorio = $('#recordatorio_tramites').val();
    recordatorio = recordatorio * 1;
    aplica_comprobacion = $('#comprueba_uso_check').val();

    route = '/admin/bitacora/enviar-fechas/' + id + '/' + fecha_inicio + '/' + comprobacion_uso +
    '/' + recordatorio + '/' + vencimiento + '/' + aplica_comprobacion;

    //console.log(route);

    $.get(route, function(data)
    {
        //console.log(data);
        $('#fecha_comprobacion_uso_tramites').val(data.fecha_comprobacion_uso);
        $('#fecha_vencimiento_tramites').val(data.fecha_vencimiento);
        $('#fecha_recordatorio_tramites').val(data.fecha_recordatorio);
    });
});

$('#estatus_tramites').change(function() 
{
    estatus = $(this).val();

    //console.log(estatus);

    if(estatus == '')
    {
        $('.modal-header').removeAttr('style');
        $('.modal-title').removeAttr('style');
        $('.close').removeAttr('style');
    }
    else
    {
        Colores = document.getElementById('estatus_tramites').value.split('_');
        id_estatus = Colores[0];
        background = Colores[1];
        color = Colores[2];

        $('#id_estatus_val').val(id_estatus);

        $('.modal-header').css(
        {
            'background-color': background
        });
        $('.modal-title').css(
        {
            'color': color
        });
        $('.close').css(
        {
            'color': color,
            'font-size': 35
        });
    }
});

$('#btn-guardar-estatus-tramites').click(function()
{
    QuitarErroresEstatus();
    $('#btn-guardar-estatus-tramites').attr('disabled', 'disabled');

    id = $('#id_estatus_tramites').val();
    id_marca = $('#id_marca_tramites').val();
    id_cliente = $('#id_cliente_tramites').val();
    id_clase = $('#id_clase_tramites').val();
    id_admin = $('#id_admin').val();
    id_servicio = $('#id_servicio_tramites').val();

    id_bitacoras_estatus = $('#id_bitacoras_estatus_tramites').val();
    id_subcategoria = $('#id_subcategoria_estatus_tramites').val();
    renovacion = $('#renovacion_tramites').val();
    comprobacion = $('#comprobacion_uso_tramites').val();
    comprobacion_uso = $('#comprueba_uso_check').val();
    fecha_comprobacion_uso = $('#fecha_comprobacion_uso_tramites').val();
    vencimiento = $('#vencimiento_tramites').val();
    fecha_vencimiento = $('#fecha_vencimiento_tramites').val();
    recordatorio = $('#recordatorio_tramites').val();
    fecha_recordatorio = $('#fecha_recordatorio_tramites').val();
    fecha_inicio = $('#fecha_inicio_tramites').val();

    numero_expediente = $('#numero_expediente_tramites').val();
    numero_registro = $('#numero_registro_tramites').val();
    id_estatus = $('#id_estatus_val').val();
    token = $('#_token').val();

    if(comprobacion == '')
    {
        comprobacion = 0;
    }

    if(vencimiento == '')
    {
        vencimiento = 0;
    }

    if(recordatorio == '')
    {
        recordatorio = 0;
    }

    if(id == 0)
    {
        id = '';
    }

    if(renovacion == '')
    {
        renovacion = 1;
    }

    var formData =
    {
        id_marca, id_cliente, id_clase, id_admin, id_servicio, id_bitacoras_estatus,
        id_subcategoria, comprobacion, comprobacion_uso, fecha_comprobacion_uso, vencimiento, 
        fecha_vencimiento, recordatorio, fecha_recordatorio, fecha_inicio,
        numero_expediente, numero_registro, id_estatus, renovacion 
    } 

    if(id == '' || id == 0)
    {
        
        console.log(formData);
        route = '/admin/bitacora/crear_estatus';
        
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
                $('#btn-guardar-estatus-tramites').removeAttr('disabled');
                toastr.success('Se creó un nuevo registro en el archivo de Estatus.');
                $('#id_estatus_tramites').val(data.id);

                $.ajax(
                {
                    type: 'get',
                    url: '/admin/estatus-marcas/' + id_marca,
                    success: function(data)
                    {
                        $('#listado-estatus').empty().html(data);
                        $(".tooltip").tooltip("hide");
                    } 
                });
            },
            error: function(data)
            {
                $('#btn-guardar-estatus-tramites').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.id_bitacoras_estatus)
                {
                    $("#id_bitacoras_estatus_tramites_error").html(data.responseJSON.errors.id_bitacoras_estatus);
                    $("#id_bitacoras_estatus_tramites_error").fadeIn();
                }
                else
                {
                    $("#id_bitacoras_estatus_tramites_error").fadeOut();
                }

                if (data.responseJSON.errors.id_estatus)
                {
                    $("#estatus_tramites_error").html(data.responseJSON.errors.id_estatus);
                    $("#estatus_tramites_error").fadeIn();
                }
                else
                {
                    $("#estatus_tramites_error").fadeOut();
                }
                
                
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                if (data.status == 422)
                {
                    console.clear();
                }
                //console.clear();
            }
        });
    }
    else
    {
        //console.log(formData);
        route = '/admin/bitacora/editar_estatus/' + id;
        
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
                $('#btn-guardar-estatus-tramites').removeAttr('disabled');
                toastr.success('Se actualizó el registro en el archivo de Estatus.');

                $.ajax(
                {
                    type: 'get',
                    url: '/admin/estatus-marcas/' + id_marca,
                    success: function(data)
                    {
                        $('#listado-estatus').empty().html(data);
                        $(".tooltip").tooltip("hide");
                    } 
                });
            },
            error: function(data)
            {
                $('#btn-guardar-estatus-tramites').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.id_bitacoras_estatus)
                {
                    $("#id_bitacoras_estatus_tramites_error").html(data.responseJSON.errors.id_bitacoras_estatus);
                    $("#id_bitacoras_estatus_tramites_error").fadeIn();
                }
                else
                {
                    $("#id_bitacoras_estatus_tramites_error").fadeOut();
                }

                if (data.responseJSON.errors.id_estatus)
                {
                    $("#estatus_tramites_error").html(data.responseJSON.errors.id_estatus);
                    $("#estatus_tramites_error").fadeIn();
                }
                else
                {
                    $("#estatus_tramites_error").fadeOut();
                }
                
                
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                if (data.status == 422)
                {
                    console.clear();
                }
                //console.clear();
            }
        });
    }
});

function BorrarEstatus()
{
    $('#id_bitacoras_estatus_tramites').val('').change();
    $('#estatus_tramites').val('').change();
    $('#id_bitacoras_estatus_tramites_value').val('');
    $('#fecha_inicio_tramites').val('');
    $('#fecha_comprobacion_uso_tramites').val('');
    $('#fecha_vencimiento_tramites').val('');
    $('#numero_expediente_tramites').val('');
    $('#numero_registro_tramites').val('');
    $('#id_estatus_tramites').val('');
    $('#id_marca_tramites').val('');
    $('#id_cliente_tramites').val('');
    $('#id_clase_tramites').val('');
    $('#id_servicio_tramites').val('');
    //$('#listado-estatus').empty();
}

function QuitarErroresEstatus()
{
    $('#id_bitacoras_estatus_tramites_error').fadeOut();
    $('#fecha_inicio_tramites_error').fadeOut();
    $('#fecha_comprobacion_uso_tramites_error').fadeOut();
    $('#fecha_vencimiento_tramites_error').fadeOut();
    $('#numero_expediente_tramites_error').fadeOut();
    $('#numero_registro_tramites_error').fadeOut();
    $('#estatus_tramites_error').fadeOut();
}

$("#modal-estatus").on("hidden.bs.modal", function()
{
    BorrarEstatus();
    QuitarErroresEstatus();
});

function LimpiarEstatus()
{
    $('#id_bitacoras_estatus_tramites').val('').change();
    $('#subcategoria_estatus_tramites').val('').change();
    $('#id_bitacoras_estatus_tramites_value').val('');
    $('#id_subcategoria_estatus_tramites').val('');
    $('#parametro_tramite').val('').change();
    $('#comprobacion_uso_tramites').val('0');
    $('#vencimiento_tramites').val('0');
    $('#comprueba_uso').attr('unchecked', 'unchecked');
    $('#comprueba_uso_check').val('1');
    //$('#fecha_inicio_tramites').val('');
    $('#fecha_comprobacion_uso_tramites').val('');
    $('#fecha_vencimiento_tramites').val('');
    $('#estatus_tramites').val('').change();
    $('#id_estatus_val').val('');
    $('#numero_expediente_tramites').val('');
    $('#numero_registro_tramites').val('');
    $('#id_estatus_tramites').val('');
    /*$('#id_marca_tramites').val('');
    $('#id_cliente_tramites').val('');
    $('#id_clase_tramites').val('');
    $('#id_servicio_tramites').val('');
    $('#id_catalogo_servicio_tramites').val('');*/
    //$('#estatus_boolean').val('1');
    QuitarErroresEstatus();
    //console.clear();
}

function EstatusBoolean()
{
    $('#estatus_boolean').val('1');
}


//Facturas en Servicio
function ServicioFactura(id_cliente, id_servicio, facturado, costo, tipo_factura, listado)
{
    $('#section-asignacion-factura').removeAttr('hidden');
    $('#section-cobro-factura').attr('hidden', 'hidden');

    //console.log(id_factura, folio_factura, id_cliente, id_servicio);
    $('.modal-header').css(
    {
        'background-color' : '#218CBF'
    });

    monto = costo - facturado;
    monto = monto.toFixed(2);
    costo = costo.toFixed(2);
    facturado = facturado.toFixed(2);
    $('#fecha_servicio_factura').datepicker().datepicker('setDate', 'today');
    $('#id_cliente_servicio_factura').val(id_cliente);
    $('#monto_servicio_factura').val(monto);
    $('#monto_servicio_factura_max').val(monto);
    $('#facturado_servicio_factura').val(facturado);
    $('#costo_servicio_factura').val(costo);
    $('#id_servicio_factura').val(id_servicio);
    $('#tipo_servicio_factura').val(tipo_factura);
    $('#folio_servicio_factura').val('');
    $('#select_servicio_factura').empty();
    $('#listado_pagar_factura').val(listado);
    $('#id_folio_servicio_factura').val('');
    
    $('#select_servicio_factura').append('<option value="">-Sin selección-</option>');
    BorrarErrorServicioFactura();

    if(tipo_factura == 'Factura')
    {
        $('.modal-title').html('Asignar factura al servicio');
        $('#check_iva_servicio_factura').prop('checked', true);
        $('#check_iva_servicio_factura_val').val('1');
        $('#check_iva_servicio_factura').attr('disabled', 'disabled');
        

        route = '/admin/procesos/servicios-factura/' + id_cliente;
        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#select_servicio_factura').append('<option value ="'+ item.id + '_' + item.subtotal +
                '_' + item.porcentaje_iva + '_' + item.pagado + '"># ' + item.folio_factura +
                    '</option>');
            });
        });
    }
    else if(tipo_factura == 'Recibo')
    {
        $('#check_iva_servicio_factura').prop('checked', false);
        $('#check_iva_servicio_factura_val').val('0');
        $('.modal-title').html('Asignar recibo al servicio');
        $('#check_iva_servicio_factura').removeAttr('disabled');

        route = '/admin/procesos/servicios-recibo/' + id_cliente;
        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#select_servicio_factura').append('<option value ="' + item.id + '_' + item.subtotal +
                '_' + item.porcentaje_iva + '_' + item.pagado + '"># '
                    + item.folio_recibo +
                    '</option>');
            });
        });
    }
}

$('#select_servicio_factura').change(function()
{
    val = $(this).val();

    if(val != '')
    {
        id_folio = document.getElementById('select_servicio_factura').value.split('_');
        $('#id_folio_servicio_factura').val(id_folio[0]);
        $('#subtotal_servicio_factura').val(id_folio[1]);
        $('#porcentaje_iva_servicio_factura_val').val(id_folio[2]);
        $('#pagado_servicio_factura').val(id_folio[3]);
        //console.log(id_folio);
    }
    else
    {
        $('#id_folio_servicio_factura').val('');
        $('#subtotal_servicio_factura').val('');
        $('#porcentaje_iva_servicio_factura_val').val('');
        $('#pagado_servicio_factura').val('');
    }
});

$('#check_iva_servicio_factura').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#check_iva_servicio_factura_val").val(this.value);
}).change();

$('#nuevo_servicio_factura').on('change', function()
{
    this.value = this.checked ? 0 : 1;
    //alert(this.value);
    $("#factura_is_existente").val(this.value);
}).change();

$('#existente_servicio_factura').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#factura_is_existente").val(this.value);
}).change();

$('#btn-save-servicio-factura').click(function()
{
    $('#btn-save-servicio-factura').attr('disabled', 'disabled');

    id_folio = $('#id_folio_servicio_factura').val();
    folio = $('#folio_servicio_factura').val();
    id_cliente = $('#id_cliente_servicio_factura').val();
    id_servicio = $('#id_servicio_factura').val();
    tipo = $('#tipo_servicio_factura').val();
    fecha = $('#fecha_servicio_factura').val();
    porcentaje_iva = $('#porcentaje_iva_servicio_factura').val();
    facturado = $('#facturado_servicio_factura').val();
    costo = $('#costo_servicio_factura').val();
    monto = $('#monto_servicio_factura').val();
    monto_max = $('#monto_servicio_factura_max').val();
    monto = monto * 1;
    monto_max = monto_max * 1;
    token = $('#_token').val();
    id_admin = $('#id_admin').val();
    existe_factura = $('#factura_is_existente').val();
    con_iva = $('#check_iva_servicio_factura_val').val();
    listado = $('#listado_pagar_factura').val();

    if(monto > monto_max)
    {
        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');
        $('#monto_servicio_factura_error').html('El monto a facturar no puede ser mayor al saldo del servicio el cual es: $ ' + monto_max);
        $('#monto_servicio_factura_error').fadeIn();
        $('#btn-save-servicio-factura').removeAttr('disabled');
        $('#monto_servicio_factura').val(monto_max)
    }
    else if(existe_factura == 0)
    {
        if(folio == '')
        {
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');
            $('#folio_servicio_factura_error').html('Debe ingresar el folio del recibo/factura');
            $('#folio_servicio_factura_error').fadeIn();
            $('#select_servicio_factura_error').fadeOut();
            $('#btn-save-servicio-factura').removeAttr('disabled');
        }
        else
        {
            BorrarErrorServicioFactura();
            if(tipo == 'Factura')
            {
                folio_factura = folio;

                formData = {folio_factura, id_cliente, id_servicio, 
                    tipo, fecha, monto, id_admin, porcentaje_iva, monto_max, facturado, costo, con_iva}
                route = '/admin/procesos/servicios-insertar-factura';

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
                        $('#btn-save-servicio-factura').removeAttr('disabled');
                        toastr.success('Se agregó el folio de la factura exitosamente.');
                        ActualizarServicioListado(id_servicio);

                        PagarFactura(data.id, data.porcentaje_iva, data.folio_factura, 
                            id_cliente, data.tipo, listado, id_servicio, data.con_iva, data.pagado_terminado);
                    },
                    error: function(data)
                    {
                        $('#btn-save-servicio-factura').removeAttr('disabled');
                        console.log(data);
                        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

                        if (data.responseJSON.errors.monto)
                        {
                            $("#monto_servicio_factura_error").html(data.responseJSON.errors.monto);
                            $("#monto_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#monto_servicio_factura_error").fadeOut();
                        }

                        if (data.responseJSON.errors.fecha)
                        {
                            $("#fecha_servicio_factura_error").html(data.responseJSON.errors.fecha);
                            $("#fecha_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#fecha_servicio_factura_error").fadeOut();
                        }

                        if (data.responseJSON.errors.folio_factura)
                        {
                            $("#folio_servicio_factura_error").html(data.responseJSON.errors.folio_factura);
                            $("#folio_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#folio_servicio_factura_error").fadeOut();
                        }

                        if (data.responseJSON.errors.porcentaje_iva)
                        {
                            $("#porcentaje_iva_servicio_factura_error").html(data.responseJSON.errors.porcentaje_iva);
                            $("#porcentaje_iva_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#porcentaje_iva_servicio_factura_error").fadeOut();
                        }
                    }
                });
            }
            else if(tipo == 'Recibo')
            {
                folio_recibo = folio;

                formData = {folio_recibo, id_cliente, id_servicio, tipo, fecha, 
                    monto, id_admin, porcentaje_iva, monto_max, facturado, costo, con_iva}
                route = '/admin/procesos/servicios-insertar-recibo';

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
                        $('#btn-save-servicio-factura').removeAttr('disabled');
                        toastr.success('Se agregó el folio del recibo exitosamente.');
                        ActualizarServicioListado(id_servicio);

                        PagarFactura(data.id, data.porcentaje_iva, data.folio_recibo, 
                            id_cliente, data.tipo, listado, id_servicio, data.con_iva, data.pagado_terminado);
                    },
                    error: function(data)
                    {
                        $('#btn-save-servicio-factura').removeAttr('disabled');
                        console.log(data);
                        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

                        if (data.responseJSON.errors.monto)
                        {
                            $("#monto_servicio_factura_error").html(data.responseJSON.errors.monto);
                            $("#monto_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#monto_servicio_factura_error").fadeOut();
                        }

                        if (data.responseJSON.errors.fecha)
                        {
                            $("#fecha_servicio_factura_error").html(data.responseJSON.errors.fecha);
                            $("#fecha_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#fecha_servicio_factura_error").fadeOut();
                        }

                        if (data.responseJSON.errors.folio_recibo)
                        {
                            $("#folio_servicio_factura_error").html(data.responseJSON.errors.folio_recibo);
                            $("#folio_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#folio_servicio_factura_error").fadeOut();
                        }

                        if (data.responseJSON.errors.porcentaje_iva)
                        {
                            $("#porcentaje_iva_servicio_factura_error").html(data.responseJSON.errors.porcentaje_iva);
                            $("#porcentaje_iva_servicio_factura_error").fadeIn();
                        }
                        else
                        {
                            $("#porcentaje_iva_servicio_factura_error").fadeOut();
                        }
                    }
                });
            }
        }
    }
    else if(existe_factura == 1)
    {
        if(id_folio == '')
        {
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');
            $('#select_servicio_factura_error').html('Debe estar seleccionado un folio existente o uno nuevo');
            $('#select_servicio_factura_error').fadeIn();
            $('#folio_servicio_factura_error').fadeOut();
            $('#btn-save-servicio-factura').removeAttr('disabled');
        }
        else
        {
            BorrarErrorServicioFactura();

            subtotal = $('#subtotal_servicio_factura').val();
            porcentaje_iva = $('#porcentaje_iva_servicio_factura_val').val();
            pagado = $('#pagado_servicio_factura').val();

            /*subtotal = subtotal.toFixed(2);
            porcentaje_iva = porcentaje_iva.toFixed(2);
            pagado = pagado.toFixed(2);*/

            formData = {id_cliente, id_servicio, monto, id_admin, monto_max, facturado, costo, subtotal,
                porcentaje_iva, pagado, con_iva}



            route = '/admin/procesos/servicios-folio-existente/' + id_folio;

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
                    $('#btn-save-servicio-factura').removeAttr('disabled');
                    toastr.success('Se asignó el servicio a la factura, exitosamente.');
                    ActualizarServicioListado(id_servicio);

                    if(data.tipo == 'Factura')
                    {
                        folio = data.folio_factura;
                    }
                    else if(data.tipo == 'Recibo')
                    {
                        folio = data.folio_recibo;
                    }
                    PagarFactura(data.id, data.porcentaje_iva, folio, 
                        id_cliente, data.tipo, listado, id_servicio, data.con_iva, data.pagado_terminado);
                },
                error: function(data)
                {
                    $('#btn-save-servicio-factura').removeAttr('disabled');
                    console.log(data);
                    toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

                    if (data.responseJSON.errors.monto)
                    {
                        $("#monto_servicio_factura_error").html(data.responseJSON.errors.monto);
                        $("#monto_servicio_factura_error").fadeIn();
                    }
                    else
                    {
                        $("#monto_servicio_factura_error").fadeOut();
                    }
                }
            });
        }
    }
});

function BorrarErrorServicioFactura()
{
    $('#folio_servicio_factura_error').fadeOut();
    $('#fecha_servicio_factura_error').fadeOut();
    $('#select_servicio_factura_error').fadeOut();
    $('#monto_servicio_factura_error').fadeOut();
    $("#porcentaje_iva_servicio_factura_error").fadeOut();
}

function getSaldoCliente(id_cliente)
{
    route_saldo = '/admin/clientes/getSaldo/' + id_cliente;
    $.get(route_saldo, function(data)
    {
        saldo_cliente = data.saldo;
        //saldo_cliente = saldo_cliente.toFixed(2);
        $('#saldo_cliente').val(saldo_cliente);
        $('#saldo_cliente_val').val(saldo_cliente);
    });
}

function cargarListadoFactura(id_factura, estatus, id_cliente)
{
    route = '/admin/procesos/cargarServiciosFactura/' + id_factura + '/' + estatus + '/' + id_cliente;

    $.ajax(
    {
        type: 'get',
        url: route,
        success: function(data)
        {
            $('#listado-factura-pagada').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

function cargarSaldoFactura(id_factura)
{
    route = '/admin/procesos/factura-getSaldo/' + id_factura;
    $.get(route, function(data)
    {
        $('#saldo_factura').val(data.saldo);
        $('#monto_pagar_factura').val(data.saldo);
        $('#monto_pagar_factura_max').val(data.saldo);

        $('#pagado_pagar_factura').val(data.pagado);
        $('#saldo_pagar_factura').val(data.saldo);
        $('#total_pagar_factura').val(data.total);
        $('#iva_pagar_factura').val(data.iva);

        $('#subtotal_factura_pagada').html(parseFloat(data.subtotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#subtotal_final_factura_pagada').val(data.subtotal);
        $('#iva_factura_pagada').html(parseFloat(data.iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#iva_final_factura_pagada').val(data.iva);
        $('#total_factura_pagada').html(parseFloat(data.total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $('#total_final_factura_pagada').val(data.total);
        $('#pagado_factura_pagada').val(data.pagado);
        $('#saldo_factura_pagada').val(data.saldo);
        $('#piva_final_factura_pagada').val(data.porcentaje_iva);
        //console.log(data.saldo);
    });
}

function PagarFactura(id_factura, /*pagado, saldo, total,*/ porcentaje_iva, /*iva,*/ folio, 
    id_cliente, tipo, listado, id_servicio, /*subtotal,*/ con_iva, pagado_terminado)
{
    $('#section-cobro-factura').removeAttr('hidden');
    $('#section-asignacion-factura').attr('hidden', 'hidden');

    QuitarErroresPagarFacturas();
    BorrarDatosPagarFacturasIngreso();
    QuitarErroresPagarFacturasIngresos();

    $('.modal-header').css(
    {
        'background-color' : '#218CBF'
    });
    if(tipo == 'Factura')
    {
        $('.modal-title').html('Pagar factura: #' + folio);
    }
    else if(tipo == 'Recibo')
    {
        $('.modal-title').html('Pagar recibo: #' + folio);
    }

    if(pagado_terminado == 0)
    {
        $('#estatus_pagar_factura_span').css(
        {
            'background-color' : 'orange'
        });
        $('#estatus_pagar_factura').val('Pendiente');
        $('#estatus_pagar_factura_val').val('Pendiente');

        // $('#btn-abrir-factura').attr('hidden', 'hidden');
        // $('#btn-cancelar-factura').attr('hidden', 'hidden');
        $('#btn-pagar-factura').removeAttr('hidden');
        
    }
    else if(pagado_terminado == 1)
    {
        $('#estatus_pagar_factura_span').css(
        {
            'background-color' : 'green'
        });
        $('#estatus_pagar_factura').val('Pagado');
        $('#estatus_pagar_factura_val').val('Pagado');

        $('#btn-pagar-factura').attr('hidden', 'hidden');
        // $('#btn-abrir-factura').removeAttr('hidden');
        // $('#btn-cancelar-factura').removeAttr('hidden');
    }
    
    //$('#saldo_factura').val(saldo);
    $('#fecha_pagar_factura').datepicker().datepicker('setDate', 'today');
    //
    $('#id_factura_pagar_factura').val(id_factura);
    $('#id_cliente_pagar_factura').val(id_cliente);
    $('#porcentaje_iva_pagar_factura').val(porcentaje_iva);
    $('#piva_final_factura_pagada').val(porcentaje_iva);
    $('#con_iva_final_factura_pagada').val(con_iva);
    $('#listado_pagar_factura').val(listado);
    $('#id_servicio_pagar_factura').val(id_servicio);
    $('#tipo_pagar_factura').val(tipo);
    $('#folio_pagar_factura').val(folio);

    route_orden = '/admin/egresos/ultimo-orden';
    $.get(route_orden, function(data)
    {
        orden = data.orden * 1;
        new_orden = orden + 1;
        $('#orden_pagar_factura').val(new_orden);
    });

    getSaldoCliente(id_cliente);
    cargarListadoFactura(id_factura, pagado_terminado, id_cliente);
    cargarSaldoFactura(id_factura);
}

// $('#con_iva_final_factura_pagada_check').on('change', function()
// {
//     this.value = this.checked ? 1 : 0;
//     //alert(this.value);
//     $("#aplica_comision_venta_check").val(this.value);

//     token = $('#_token').val();
//     id_admin = $('#id_admin').val();
//     id_factura = $('#id_factura_pagar_factura').val();
//     subtotal = $('#subtotal_final_factura_pagada').val();
//     porcentaje_iva = $('#piva_final_factura_pagada').val();
//     con_iva = $('#con_iva_final_factura_pagada').val();
//     saldo = $('#saldo_factura_pagada').val();
//     pagado = $('#pagado_factura_pagada').val();

//     formData ={
//         id_admin, subtotal, porcentaje_iva, con_iva, saldo, pagado
//     }

//     route = '/admin/procesos/cambiar-iva-factura/' + id_factura;

//     $.ajax(
//     {
//         url: route,
//         headers:
//         {
//             'X-CSRF-TOKEN': token
//         },
//         type: 'PUT',
//         dataType: 'json',
//         data: formData,
//         success: function(data)
//         {
//             cargarSaldoFactura(id_factura);
//         },
//         error: function(data)
//         {
//             $('#btn-generar-ingreso').removeAttr('disabled');
//             console.log(data);
//             toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

//             if (data.responseJSON.errors.porcentaje_iva)
//             {
//                 $("#con_iva_final_factura_pagada_error").html(data.responseJSON.errors.porcentaje_iva);
//                 $("#con_iva_final_factura_pagada_error").fadeIn();
//             }
//             else
//             {
//                 $("#con_iva_final_factura_pagada_error").fadeOut();
//             }
//         }
//     });

// });

$('#id_cuenta_pagar_factura').change(function()
{
    id_cuenta = $(this).val();

    if(id_cuenta == '1')
    {
        $('#id_forma_pago_pagar_factura').val('1').change();
    }
    else if(id_cuenta == '')
    {
        $('#id_forma_pago_pagar_factura').val('').change();
    }
    else
    {
        $('#id_forma_pago_pagar_factura').val('3').change();
    }
});

$('#btn-generar-ingreso').click(function()
{
    $('#btn-generar-ingreso').attr('disabled', 'disabled');
    id_admin = $('#id_admin').val();
    token = $('#_token').val();

    fecha = $('#fecha_pagar_factura').val();
    orden = $('#orden_pagar_factura').val();
    concepto = $('#concepto_pagar_factura').val();
    movimiento = $('#movimiento_pagar_factura').val();
    cheque = $('#cheque_pagar_factura').val();
    id_cuenta = $('#id_cuenta_pagar_factura').val();
    id_forma_pago = $('#id_forma_pago_pagar_factura').val();
    deposito = $('#monto_cobro_pagar_factura').val();
    id_cliente = $('#id_cliente_pagar_factura').val();
    tipo = 'Ingreso';
    saldo = $('#saldo_cliente_val').val();
    porcentaje_iva = $('#porcentaje_iva_cobro_factura').val();

    formData = {
        fecha, orden, concepto, movimiento, cheque, id_cuenta, id_forma_pago, id_admin, deposito, id_cliente,
        tipo, saldo, porcentaje_iva
    }

    route = '/admin/ingresos/store';

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
            //console.log(data);
            $('#btn-generar-ingreso').removeAttr('disabled');
            toastr.success('Se ingresó el cobro exitosamente.');
            BorrarDatosPagarFacturasIngreso();
            QuitarErroresPagarFacturasIngresos();
            QuitarErroresPagarFacturas();
            $('#row_validar_pago_factura').hide();
            getSaldoCliente(id_cliente);

            route_orden = '/admin/egresos/ultimo-orden';
            $.get(route_orden, function(data)
            {
                orden = data.orden * 1;
                new_orden = orden + 1;
                $('#orden_pagar_factura').val(new_orden);
            });
        },
        error: function(data)
        {
            $('#btn-generar-ingreso').removeAttr('disabled');
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

            if (data.responseJSON.errors.fecha)
            {
                $("#fecha_pagar_factura_error").html(data.responseJSON.errors.fecha);
                $("#fecha_pagar_factura_error").fadeIn();
            }
            else
            {
                $("#fecha_pagar_factura_error").fadeOut();
            }

            if (data.responseJSON.errors.id_cuenta)
            {
                $("#id_cuenta_pagar_factura_error").html(data.responseJSON.errors.id_cuenta);
                $("#id_cuenta_pagar_factura_error").fadeIn();
            }
            else
            {
                $("#id_cuenta_pagar_factura_error").fadeOut();
            }

            if (data.responseJSON.errors.id_forma_pago)
            {
                $("#id_forma_pago_pagar_factura_error").html(data.responseJSON.errors.id_forma_pago);
                $("#id_forma_pago_pagar_factura_error").fadeIn();
            }
            else
            {
                $("#id_forma_pago_pagar_factura_error").fadeOut();
            }

            if (data.responseJSON.errors.deposito)
            {
                $("#monto_cobro_pagar_factura_error").html(data.responseJSON.errors.deposito);
                $("#monto_cobro_pagar_factura_error").fadeIn();
            }
            else
            {
                $("#monto_cobro_pagar_factura_error").fadeOut();
            }
        }
    });
});

function BorrarDatosPagarFacturasIngreso()
{
    $('#fecha_pagar_factura').datepicker().datepicker('setDate', 'today');
    $('#concepto_pagar_factura').val('');
    $('#movimiento_pagar_factura').val('');
    $('#cheque_pagar_factura').val('');
    $('#id_cuenta_pagar_factura').val('').change();
    $('#id_forma_pago_pagar_factura').val('').change();
    $('#monto_cobro_pagar_factura').val('0');
}

function QuitarErroresPagarFacturasIngresos()
{
    $("#fecha_pagar_factura_error").fadeOut();
    $("#id_cuenta_pagar_factura_error").fadeOut();
    $("#id_forma_pago_pagar_factura_error").fadeOut();
    $("#monto_cobro_pagar_factura_error").fadeOut();
}

$('#btn-pagar-factura').click(function()
{
    $('#btn-pagar-factura').attr('disabled', 'disabled');
    id_admin = $('#id_admin').val();
    token = $('#_token').val();
    id_servicio = $('#id_servicio_pagar_factura').val();
    id_factura = $('#id_factura_pagar_factura').val();
    estatus_factura = $('#estatus_pagar_factura_val').val();

    //deposito = $('#monto_pagar_factura').val();
    id_cliente = $('#id_cliente_pagar_factura').val();
    pagado_fact = $('#pagado_pagar_factura').val();
    total_fact = $('#total_pagar_factura').val();

    saldo_cliente = $('#saldo_cliente_val').val();
    saldo_cliente = saldo_cliente * 1;
    deposito = $('#monto_pagar_factura').val();
    monto_max = $('#monto_pagar_factura_max').val();
    deposito = deposito * 1;
    monto_max = monto_max * 1;

    if(saldo_cliente == 0)
    {
        toastr.error('No se pudo pagar la factura/recibo, revise los errores en el formulario');
        $('#saldo_cliente_error').html('El cliente no tiene saldo disponible, capture primero un ingreso');
        $('#saldo_cliente_error').fadeIn();
        $('#btn-pagar-factura').removeAttr('disabled');
    }
    else if(monto_max < deposito)
    {
        toastr.error('No se pudo pagar la factura/recibo, revise los errores en el formulario');
        $('#monto_pagar_factura_error').html('El saldo pendiente de la factura es de: $' + monto_max);
        $('#monto_pagar_factura_error').fadeIn();
        $('#monto_pagar_factura').val(monto_max);
        $('#btn-pagar-factura').removeAttr('disabled');
    }
    else if(saldo_cliente < deposito)
    {
        $('#row_validar_pago_factura').show();
        $('#row_validar_pago_factura').removeAttr('hidden');
        $('#btn-pagar-factura').removeAttr('disabled');
    }
    else if(estatus_factura == 'Pagado')
    {
        toastr.error('La factura ya se encuentra Pagada');
    }
    else
    {
        //toastr.success('todo está bien');
        $('#btn-aplicar-pago-factura').removeAttr('disabled');

        route = '/admin/procesos/pagar-factura/' + id_factura;

        formData = 
        {
            id_admin, deposito, id_cliente, pagado_fact, total_fact, saldo_cliente
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
                //console.log(data);
                $('#btn-aplicar-pago-factura').removeAttr('disabled');
                $('#btn-pagar-factura').removeAttr('disabled');
                //$('#row_validar_pago_factura').hide();
                toastr.success('Se realizó el pago de la factura/servicio.');
                Listar();
                $('#modal-pagar-factura').modal('toggle');
                BorrarDatosPagarFacturas();
                QuitarErroresPagarFacturas();
                BorrarDatosPagarFacturasIngreso()
                QuitarErroresPagarFacturasIngresos();
            },
            error: function(data)
            {
                $('#btn-pagar-factura').removeAttr('disabled');
                console.log(data);
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

                if (data.responseJSON.errors.deposito)
                {
                    $("#monto_pagar_factura").html(data.responseJSON.errors.deposito);
                    $("#monto_pagar_factura").fadeIn();
                }
                else
                {
                    $("#monto_pagar_factura").fadeOut();
                }

                if (data.responseJSON.errors.saldo_cliente)
                {
                    $("#saldo_cliente_error").html(data.responseJSON.errors.saldo_cliente);
                    $("#saldo_cliente_error").fadeIn();
                }
                else
                {
                    $("#saldo_cliente_error").fadeOut();
                }
            }
        });
    }
});

$('#btn-abrir-factura').click(function()
{
    token = $('#_token').val();
    estatus = 'Pendiente';
    id_cliente = $('#id_cliente_pagar_factura').val();
    pagado = $('#pagado_factura_pagada').val();
    saldo_cliente = $('#saldo_cliente_val').val();
    id_factura = $('#id_factura_pagar_factura').val();
    tipo = $('#tipo_pagar_factura').val();
    id_servicio = $('#id_servicio_pagar_factura').val();
    listado = $('#listado_pagar_factura').val();
    folio = $('#folio_pagar_factura').val();

    formData =
    {
        estatus, id_cliente, pagado, saldo_cliente
    }
    $.confirm(
    {
        title: '¿Desea liberar el folio de ' + tipo + ': ' + folio +  '?',
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
                text: 'Liberar',
                btnClass: 'btn-orange any-other-class',
                action: function () 
                {
                    router = '/admin/procesos/liberar-factura/' + id_factura;

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
                            toastr.info('Se liberó la factura y se restableció el saldo del cliente; ahora puede anexar servicios.');
                            Listar();
                            QuitarErroresPagarFacturas();
                            QuitarErroresPagarFacturasIngresos();

                            if(tipo == 'Factura')
                            {
                                folio = data.folio_factura;
                            }
                            else if(tipo == 'Recibo')
                            {
                                folio = data.folio_recibo;
                            }

                            PagarFactura(id_factura, data.porcentaje_iva,
                                folio, id_cliente, tipo, listado, id_servicio, data.con_iva, 
                                data.pagado_terminado);
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo liberar la factura o recibo.')
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
});

$('#btn-cancelar-factura').click(function()
{
    token = $('#_token').val();
    estatus = 'Cancelado';
    id_cliente = $('#id_cliente_pagar_factura').val();
    pagado = $('#pagado_factura_pagada').val();
    saldo_cliente = $('#saldo_cliente_val').val();
    id_factura = $('#id_factura_pagar_factura').val();
    tipo = $('#tipo_pagar_factura').val();
    id_servicio = $('#id_servicio_pagar_factura').val();
    listado = $('#listado_pagar_factura').val();
    folio = $('#folio_pagar_factura').val();

    formData =
    {
        estatus, id_cliente, pagado, saldo_cliente
    }
    $.confirm(
    {
        title: '¿Desea liberar el folio de ' + tipo + ': ' + folio +  '?',
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
                    router = '/admin/procesos/liberar-factura/' + id_factura;

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
                            toastr.info('Se canceló la factura y se restableció el saldo del cliente.');
                            Listar();
                            BorrarDatosPagarFacturas();
                            QuitarErroresPagarFacturas();
                            BorrarDatosPagarFacturasIngreso()
                            QuitarErroresPagarFacturasIngresos();
                            $('#modal-pagar-factura').modal('toggle');
                        },
                        error: function(data)
                        {
                            toastr.error('No se pudo cancelar la factura o recibo');
                            console.log(data);
                        }
                    });
                    
                }
            },
        }
    });
});

function EliminarServicioFactura(id, id_det)
{
    token = $('#_token').val();
    var cells = $('#servicio-factura-pagado-' + id_det).children('td');
    monto = cells.eq(6).text();

    id_factura = $('#id_factura_pagar_factura').val();
    subtotal = $('#subtotal_final_factura_pagada').val();
    con_iva = $('#con_iva_final_factura_pagada').val();
    saldo = $('#saldo_factura_pagada').val();
    porcentaje_iva =$('#piva_final_factura_pagada').val();
    tipo = $('#tipo_pagar_factura').val();
    listado = $('#listado_pagar_factura').val();
    pagado = $('#pagado_factura_pagada').val();

    pagado = pagado * 1;

    formData = {subtotal, monto, con_iva, saldo, porcentaje_iva, id_det}

    if(pagado > 0)
    {
        toastr.error('No se puede quitar el servicio debido a que la factura/recibo ya tiene cobros asociados. Primero' +
            'tiene que liberar la factura/recibo para poder quitar los servicios asignados.');
    }
    else
    {
        $.confirm(
        {
            title: '¿Desea quitar el servicio de la factura?',
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
                    text: 'Quitar',
                    btnClass: 'btn-red any-other-class',
                    action: function () 
                    {
                        router = '/admin/procesos/quitar-servicio-factura/' + id_factura;

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
                                toastr.info('Se quitó el servicio de la factura.');
                                ActualizarServicioListado(id);
                                QuitarErroresPagarFacturas();
                                QuitarErroresPagarFacturasIngresos();

                                if(tipo == 'Factura')
                                {
                                    folio = data.folio_factura;
                                }
                                else if(tipo == 'Recibo')
                                {
                                    folio = data.folio_recibo;
                                }

                                PagarFactura(data.id, data.porcentaje_iva,
                                    folio, data.id_cliente, data.tipo, listado, id, data.con_iva, 
                                    data.pagado_terminado);

                            },
                            error: function(data)
                            {
                                toastr.error('No se pudo facturar el servicio.')
                                console.log(data);
                            }
                        });
                        
                    }
                },
            }
        });
    }
}

function InsertarDetalle(id)
{
    token = $('#_token').val();
    id_admin = $('#id_admin').val();
    id_factura = $('#id_factura_pagar_factura').val();
    id_cliente = $('#id_cliente_pagar_factura').val();
    var cells = $('#servicio-factura-detalle-' + id).children('td');
    id_servicio = cells.eq(0).text();
    monto = cells.eq(6).text();
    costo = cells.eq(7).text();
    monto_max = cells.eq(8).text();
    facturado = cells.eq(9).text();
    subtotal = $('#subtotal_final_factura_pagada').val();
    porcentaje_iva = $('#piva_final_factura_pagada').val();
    con_iva = $('#con_iva_final_factura_pagada').val();
    saldo = $('#saldo_factura_pagada').val();
    tipo = $('#tipo_pagar_factura').val();
    listado = $('#listado_pagar_factura').val();
    folio = $('#folio_pagar_factura').val();
    pagado = $('#pagado_factura_pagada').val();

    monto = monto * 1;
    monto_max = monto_max * 1;

    if(monto > monto_max)
    {
        toastr.error('El monto a facturar del servicio no puede ser mayor al monto pendiente por facturar');
    }
    else
    {
        formData = { con_iva, subtotal, monto, pagado, costo, facturado, id_admin, id_servicio, porcentaje_iva }

        // console.log(formData);
        route = '/admin/procesos/servicios-folio-existente/' + id_factura;

        $.ajax(
        {
            url: route,
            headers: 
            {
                token: 'X-CSRF-TOKEN'
            },
            type: 'PUT',
            dataType: 'json',
            data: formData,
            success: function(data)
            {
                ActualizarServicioListado(id_servicio);
                QuitarErroresPagarFacturas();
                QuitarErroresPagarFacturasIngresos();
                cargarSaldoFactura(id_factura);
                cargarListadoFactura(id_factura, data.pagado_terminado, id_cliente)
            },
            error: function(data)
            {
                console.log(data);
                toastr.error('No se pudo agregar el servicio a la factura');
            }
        });
    }

    
}

function InfoEditarFactura()
{
    toastr.warning('No se puede editar servicio, primero tiene que liberar la factura o recibo');
}

$('#btn-aplicar-pago-factura').click(function()
{
    //$('#btn-pagar-factura').removeAttr('disabled');
    $('#btn-aplicar-pago-factura').attr('disabled', 'disabled');

    token = $('#_token').val();
    id_admin = $('#id_admin').val();
    deposito = $('#monto_pagar_factura').val();
    id_cliente = $('#id_cliente_pagar_factura').val();
    pagado_fact = $('#pagado_pagar_factura').val();
    total_fact = $('#total_pagar_factura').val();
    saldo_cliente = $('#saldo_cliente_val').val();
    id_servicio = $('#id_servicio_pagar_factura').val();

    route = '/admin/procesos/pagar-factura/' + id_factura;

    formData = 
    {
        id_admin, deposito, id_cliente, pagado_fact, total_fact, saldo_cliente
    }

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
            $('#btn-aplicar-pago-factura').removeAttr('disabled');
            $('#row_validar_pago_factura').hide();
            toastr.success('Se realizó el pago de la factura/servicio.');
            ActualizarServicioListado(id_servicio);
            $('#modal-pagar-factura').modal('toggle');
            BorrarDatosPagarFacturas();
            QuitarErroresPagarFacturas();
            BorrarDatosPagarFacturasIngreso()
            QuitarErroresPagarFacturasIngresos();
        },
        error: function(data)
        {
            $('#btn-aplicar-pago-factura').removeAttr('disabled');
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario');

            if (data.responseJSON.errors.deposito)
            {
                $("#monto_pagar_factura").html(data.responseJSON.errors.deposito);
                $("#monto_pagar_factura").fadeIn();
            }
            else
            {
                $("#monto_pagar_factura").fadeOut();
            }

            if (data.responseJSON.errors.saldo_cliente)
            {
                $("#saldo_cliente_error").html(data.responseJSON.errors.saldo_cliente);
                $("#saldo_cliente_error").fadeIn();
            }
            else
            {
                $("#saldo_cliente_error").fadeOut();
            }
        }
    });
});

function QuitarErroresPagarFacturas()
{
    $("#saldo_factura_error").fadeOut();
    $("#saldo_cliente_error").fadeOut();
    $("#monto_pagar_factura_error").fadeOut();
}

function BorrarDatosPagarFacturas()
{
    $('#orden_pagar_factura').val('');
    $('#id_factura_pagar_factura').val('');
    $('#id_cliente_pagar_factura').val('');
    $('#pagado_pagar_factura').val('');
    $('#saldo_pagar_factura').val('');
    $('#total_pagar_factura').val('');
    $('#id_servicio_pagar_factura').val('');
    $('#saldo_cliente').val('');
    $('#saldo_cliente_val').val('');
}

//Factura Pagada
function PagarFacturaListado(id, folio, tipo, id_cliente, pagado, saldo, total, subtotal, iva, con_iva, porcentaje_iva)
{
    //toastr.warning('La factura/recibo ya está saldado/a, para volverla a abrir y editar, dirigirse al módulo de Facturas');
    $('.modal-title').html('Editar ' + tipo + ': ' + folio);
    $('.modal-header').css(
    {
        'background-color' : '#218CBF'
    });

    $('#id_cliente_pagada').val(id_cliente);
    $('#id_factura_pagada').val(id);
    getSaldoCliente(id_cliente);
    cargarListadoFactura(id);

    $('#subtotal_factura_pagada').html(parseFloat(subtotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
    $('#subtotal_final_factura_pagada').val(subtotal);
    $('#iva_factura_pagada').html(parseFloat(iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
    $('#iva_final_factura_pagada').val(iva);
    $('#total_factura_pagada').html(parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
    $('#total_final_factura_pagada').val(total);
    $('#pagado_factura_pagada').val(pagado);
    $('#saldo_factura_pagada').val(saldo);
    $('#piva_final_factura_pagada').val(porcentaje_iva);
    $('#con_iva_final_factura_pagada').val(con_iva);
}

function EditarServicioFactura(id_servicio, id_det)
{
    var cells = $('#servicio-factura-pagado-' + id_det).children('td');
    monto = cells.eq(6).text();
    monto_max = cells.eq(7).text();
    costo = cells.eq(8).text();
    facturado = cells.eq(9).text();
    monto_ant = cells.eq(10).text();
    cobrado = cells.eq(12).text();
    saldo_cliente = $('#saldo_cliente_pagado_val').val();

    monto = monto * 1;
    monto_max = monto_max * 1;
    facturado = facturado * 1;
    monto_ant = monto_ant * 1;
    cobrado = cobrado * 1;
    costo = costo * 1;
    saldo_cliente = saldo_cliente * 1;
    monto_dif = monto - monto_ant;

    if(monto > monto_max)
    {
        toastr.error('El monto no puede ser mayor al saldo pendiente del servicio');
    }
    else if(monto_dif > saldo_cliente)
    {
        toastr.error('El saldo del cliente ');
        $('#saldo_cliente_pagado_error').html('No hay suficiente saldo del cliente para pagar la factura, agregue o edite el ingreso del cliente');
        $('#saldo_cliente_pagado_error').fadeIn();
    }
    else
    {
        $('#saldo_cliente_pagado_error').fadeOut(); 
        GuardarServicioFactura(id_servicio, id_det, facturado, monto, monto_ant, saldo_cliente, monto_dif, costo, cobrado);

    }
}

function GuardarServicioFactura(id_servicio, id_det, facturado, monto, monto_ant, saldo_cliente, monto_dif, costo, cobrado)
{
    token = $('#_token').val();
    id_factura = $('#id_factura_pagada').val();
    id_cliente = $('#id_cliente_pagada').val();
    pagado = $('#pagado_factura_pagada').val();
    saldo = $('#saldo_factura_pagada').val();
    subtotal = $('#subtotal_final_factura_pagada').val();
    con_iva = $('#con_iva_final_factura_pagada').val();
    porcentaje_iva = $('#piva_final_factura_pagada').val();
    accion = 'Update';

    subtotal = subtotal * 1;
    saldo = saldo * 1;
    porcentaje_iva = porcentaje_iva * 1;
    con_iva = con_iva * 1;

    route = '/admin/procesos/update-factura/' + id_factura;

    formData = {subtotal, monto_ant, monto, porcentaje_iva, con_iva, saldo, monto_dif, facturado, cobrado, 
        costo, id_det, id_cliente, id_servicio, saldo_cliente, accion}

    console.log(formData);

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
            console.log(data);
            getSaldoCliente(id_cliente);
            cargarListadoFactura(id_factura);
            Listar();
            $('#subtotal_factura_pagada').html(parseFloat(data.subtotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $('#subtotal_final_factura_pagada').val(data.subtotal);
            $('#iva_factura_pagada').html(parseFloat(data.iva, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $('#iva_final_factura_pagada').val(data.iva);
            $('#total_factura_pagada').html(parseFloat(data.total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $('#total_final_factura_pagada').val(data.total);
            $('#pagado_factura_pagada').val(data.pagado);
            $('#saldo_factura_pagada').val(data.saldo);
            $('#piva_final_factura_pagada').val(data.porcentaje_iva);
            $('#con_iva_final_factura_pagada').val(data.con_iva);
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo actualizar el registro, revise los errores en el formulario');
        }
    });
}

function CalcularTotalFactura()
{
    var sum = 0;
    var rows = $('#listado-total-factura-pagado tbody tr').length;

    if(rows == 0)
    {
        $('#factura_pagada_total').html('0.00');
    }
    else if(rows > 0)
    {
        $(".monto_facturado_pagado").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0) 
            {
                sum += parseFloat(value);

                $('#factura_pagada_total').html(parseFloat(sum, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                    "$1,").toString());
            }
            else
            {
                $('#factura_pagada_total').html('0.00');
            }
        });
    }
}









