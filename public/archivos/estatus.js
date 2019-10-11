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

$('#filtro_estatus').on('change', function()
{
	Listar();
});

$('#vigencia').on('change', function()
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

function Listar()
{
    var estatus = $("#filtro_estatus").val();
    var vigencia = $("#vigencia").val();
    var buscar = $("#buscar").val();
    var url_listar = $('#url_listar').val();
    var url_buscar = $('#url_buscar').val();
    listado = $("#listado-parametro").val();

    if (buscar == '')
    {
        route_listar = url_listar + estatus + '/' + vigencia;
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
            url: url_buscar + estatus + '/' + vigencia + '/' + buscar,
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

function NuevoRegistro(id)
{
    url_nuevo = $('#url_actualizar').val();
    listado = $("#listado-parametro").val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_nuevo + id,
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


function ActualizarListado(id)
{
    url_actualizar = $('#url_actualizar').val();
    listado = $("#listado-parametro").val();
    //console.log(url_actualizar);
    $.ajax(
    {
        type: 'get',
        url: url_actualizar + id,
        success: function(data)
        {
            //console.log(data);
            $('#listado-' + listado + '-' + id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('.headerfix').stickyTableHeaders();
            });
        }
    });   
}

function SignosDistintivos()
{
    listar = $('#signos_distintivos_url_listar').val();
    buscar = $('#signos_distintivos_url_buscar').val();
    actualizar = $('#signos_distintivos_url_actualizar').val();
    parametro = $('#signos_distintivos_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function DeclaracionUso()
{
    listar = $('#declaracion_uso_url_listar').val();
    buscar = $('#declaracion_uso_url_buscar').val();
    actualizar = $('#declaracion_uso_url_actualizar').val();
    parametro = $('#declaracion_uso_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function BusquedaTecnica()
{
    listar = $('#busqueda_tecnica_url_listar').val();
    buscar = $('#busqueda_tecnica_url_buscar').val();
    actualizar = $('#busqueda_tecnica_url_actualizar').val();
    parametro = $('#busqueda_tecnica_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function Invenciones()
{
    listar = $('#invenciones_url_listar').val();
    buscar = $('#invenciones_url_buscar').val();
    actualizar = $('#invenciones_url_actualizar').val();
    parametro = $('#invenciones_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function DictamenPrevio()
{
    listar = $('#dictamen_previo_url_listar').val();
    buscar = $('#dictamen_previo_url_buscar').val();
    actualizar = $('#dictamen_previo_url_actualizar').val();
    parametro = $('#dictamen_previo_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function CodigosBarra()
{
    listar = $('#codigos_barra_url_listar').val();
    buscar = $('#codigos_barra_url_buscar').val();
    actualizar = $('#codigos_barra_url_actualizar').val();
    parametro = $('#codigos_barra_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function RegistroObras()
{
    listar = $('#registro_obras_url_listar').val();
    buscar = $('#registro_obras_url_buscar').val();
    actualizar = $('#registro_obras_url_actualizar').val();
    parametro = $('#registro_obras_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function ReservaDerechos()
{
    listar = $('#reserva_derechos_url_listar').val();
    buscar = $('#reserva_derechos_url_buscar').val();
    actualizar = $('#reserva_derechos_url_actualizar').val();
    parametro = $('#reserva_derechos_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function Juicios()
{
    listar = $('#juicios_url_listar').val();
    buscar = $('#juicios_url_buscar').val();
    actualizar = $('#juicios_url_actualizar').val();
    parametro = $('#juicios_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}

function Franquicias()
{
    listar = $('#franquicias_url_listar').val();
    buscar = $('#franquicias_url_buscar').val();
    actualizar = $('#franquicias_url_actualizar').val();
    parametro = $('#franquicias_listado').val();

    $('#url_listar').val(listar);
    $('#url_buscar').val(buscar);
    $('#url_actualizar').val(actualizar);
    $('#listado-parametro').val(parametro);

    setTimeout(Listar, 500);
}


$(document).on("click", ".paginacion-signos-distintivos .pagination li a", function(e)
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

$(document).on("click", ".paginacion-busqueda-tecnica .pagination li a", function(e)
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

$(document).on("click", ".paginacion-invenciones .pagination li a", function(e)
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

$(document).on("click", ".paginacion-dictamen-previo .pagination li a", function(e)
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

$(document).on("click", ".paginacion-codigos-barra .pagination li a", function(e)
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

$(document).on("click", ".paginacion-registro-obras .pagination li a", function(e)
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

$(document).on("click", ".paginacion-reserva-derechos .pagination li a", function(e)
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

$(document).on("click", ".paginacion-juicios .pagination li a", function(e)
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

$(document).on("click", ".paginacion-franquicias .pagination li a", function(e)
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

function CargarClientes()
{
    var route = "/admin/estatus/cargar-clientes-nuevos";
    $.get(route, function(data)
    {
        $('#cliente_select').empty();
        $('#cliente_select').append('<option value ="">-Seleccionar cliente-</option>');
        $.each(data, function(index, item)
        {
            $('#cliente_select').append('<option value ="' + item.id + '">' + item.nombre_comercial +
                '</option>');
        });
        $('#cliente_select').selectpicker('refresh');
    });
}

$('#cliente_select').change(function()
{
    id_cliente = $(this).val();

    var route = '/admin/estatus/cargar-servicios/' + id_cliente;

    $.get(route, function(data)
    {
        $('#servicio_select').empty();
        $('#servicio_select').append('<option value ="">-Seleccionar servicio-</option>');
        $.each(data, function(index, item)
        {
            if(item.clase == null)
            {
                clase = '';
                id_clase = '';
            }
            else
            {
                clase = item.clase;
                id_clase = item.id_clase;
            }

            $('#servicio_select').append('<option value ="' + item.id + '_' + item.id_control + '_' + id_clase + '_' + 
                item.fecha_registro + '">#' +
              item.id + ' | ' + item.clave + ' - ' + item.marca + ' ' + clase + '</option>');
        });
        $('#servicio_select').selectpicker('refresh');
    });
});

$('#servicio_select').change(function()
{
    Servicio =  document.getElementById('servicio_select').value.split('_');
    
    if(Servicio[2] == '')
    {
        clase = '';
    }
    else
    {
        clase = Servicio[2];
    }

    $('#id_servicio_tramites').val(Servicio[0]);
    $('#id_marca_tramites').val(Servicio[1]);
    $('#fecha_inicio_tramites').val(Servicio[3]);
    $('#id_clase_tramites').val(clase);
});

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
    servicio = $('#servicio_select').val();

    if(fecha_inicio == '')
    {
        toastr.error('Seleccione una fecha inicial o si es un registro nuevo, seleccione el cliente y servicio.');
        $('#id_bitacoras_estatus_tramites').val('').change();
    }
    else if(estatus_boolean == 1)
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
            }
            else
            {
                $('#bool_declaracion_uso').removeAttr('hidden');
                aplica_comprobacion = 1;
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

            $('#renovacion_tramites').val(renovacion);
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

    route = '/admin/bitacora/enviar-fechas/' + id + '/' + fecha_inicio + '/' + comprobacion_uso +
    '/' + recordatorio + '/' + vencimiento;

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

//Crear Estatus
function CreateEstatus()
{
    CargarClientes();
    $('.modal-title').html('Agregar registro');
    BorrarDatos();
    QuitarErrores();
    $('#bool_servicio').removeAttr('hidden');
    $('#bool_marca').attr('hidden', 'hidden');
}

//Editar Estatus
function EditarEstatus(id)
{
    $('#estatus_boolean').val('0');
    $('#bool_servicio').attr('hidden', 'hidden');
    $('#bool_marca').removeAttr('hidden');
    $('.modal-title').html('Editar estatus ' + id);
    QuitarErrores();

    route = '/admin/estatus/edit/' + id;

    $.get(route, function(data)
    {
        //console.log(data);

        $('#id_estatus_val').val(data.id_estatus);

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
            'color': data.texto
        });

        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        if(data.marca == null)
        {
            marca = '';
        }
        else
        {
            marca = data.marca;
        }

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

        $('#cliente_select').empty();
        $('#cliente_select').append('<option value ="' + data.id_cliente + '">' + data.nombre_comercial + '</option>');
        $('#marca_tramites').val(marca + ' ' + clase);
        $('#id_bitacoras_estatus_tramites').val(data.id_bitacoras_estatus).change();

        route = '/admin/estatus-subcategoria/' + id_categoria;
        
        if(data.id_subcategoria > 0)
        {
            $('#subcategoria_estatus_tramites').empty().append('<option value ="' + data.id_subcategoria + '_' + data.renovacion + 
                        '_' + data.vencimiento + '_' + data.recordatorio + '_' + data.comprobacion + '_' + 1 +
                        '_' + data.fecha_vencimiento + '_' + data.fecha_recordatorio + '_' + data.fecha_comprobacion_uso +
                        '" selected>' + data.subcategoria + '</option>' +
                        '<option value ="">--------------------</option>');
        }
        else
        {
            $('#subcategoria_estatus_tramites').empty().append('<option value ="">-Sin selección-</option>');
        }

        $.get(route, function(data)
        {
            $.each(data, function(index, item)
            {
                $('#subcategoria_estatus_tramites').append('<option value ="' + item.id + '_' + item.renovacion + 
                        '_' + item.vencimiento + '_' + item.recordatorio + '_' + item.comprobacion_uso + '_' + 
                        2 + '">' + item.subcategoria + '</option>');
            });
        });
    });

    setTimeout(EstatusBoolean, 1000);
}

$('#btn-guardar-estatus-tramites').click(function()
{
    QuitarErrores();
    $('#btn-guardar-estatus-tramites').attr('disabled', 'disabled');

    id = $('#id_estatus_tramites').val();
    id_marca = $('#id_marca_tramites').val();
    id_cliente = $('#cliente_select').val();
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
        
        //console.log(formData);
        route = '/admin/estatus/store';
        
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
                NuevoRegistro(data.id);
                $('#modal-estatus').modal('toggle');
                console.clear();

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

                if (data.responseJSON.errors.id_subcategoria)
                {
                    $("#subcategoria_estatus_tramites_error").html(data.responseJSON.errors.id_subcategoria);
                    $("#subcategoria_estatus_tramites_error").fadeIn();
                }
                else
                {
                    $("#subcategoria_estatus_tramites_error").fadeOut();
                }

                if (data.responseJSON.errors.id_cliente)
                {
                    $("#cliente_select_error").html(data.responseJSON.errors.id_cliente);
                    $("#cliente_select_error").fadeIn();
                }
                else
                {
                    $("#cliente_select_error").fadeOut();
                }

                if (data.responseJSON.errors.id_servicio)
                {
                    $("#servicio_select_error").html(data.responseJSON.errors.id_servicio);
                    $("#servicio_select_error").fadeIn();
                }
                else
                {
                    $("#servicio_select_error").fadeOut();
                }

                if (data.responseJSON.errors.numero_expediente)
                {
                    $("#numero_expediente_tramites_error").html(data.responseJSON.errors.numero_expediente);
                    $("#numero_expediente_tramites_error").fadeIn();
                }
                else
                {
                    $("#numero_expediente_tramites_error").fadeOut();
                }

                if (data.responseJSON.errors.numero_registro)
                {
                    $("#numero_registro_tramites_error").html(data.responseJSON.errors.numero_registro);
                    $("#numero_registro_tramites_error").fadeIn();
                }
                else
                {
                    $("#numero_registro_tramites_error").fadeOut();
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
        route = '/admin/estatus/update/' + id;
        
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
                ActualizarListado(id);
                $('#modal-estatus').modal('toggle');
                console.clear();
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

                if (data.responseJSON.errors.id_subcategoria)
                {
                    $("#subcategoria_estatus_tramites_error").html(data.responseJSON.errors.id_subcategoria);
                    $("#subcategoria_estatus_tramites_error").fadeIn();
                }
                else
                {
                    $("#subcategoria_estatus_tramites_error").fadeOut();
                }

                if (data.responseJSON.errors.numero_expediente)
                {
                    $("#numero_expediente_tramites_error").html(data.responseJSON.errors.numero_expediente);
                    $("#numero_expediente_tramites_error").fadeIn();
                }
                else
                {
                    $("#numero_expediente_tramites_error").fadeOut();
                }

                if (data.responseJSON.errors.numero_registro)
                {
                    $("#numero_registro_tramites_error").html(data.responseJSON.errors.numero_registro);
                    $("#numero_registro_tramites_error").fadeIn();
                }
                else
                {
                    $("#numero_registro_tramites_error").fadeOut();
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

function BorrarDatos()
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
    $('#estatus_boolean').val('1');
}

function QuitarErrores()
{
    $('#id_bitacoras_estatus_tramites_error').fadeOut();
    $('#fecha_inicio_tramites_error').fadeOut();
    $('#fecha_comprobacion_uso_tramites_error').fadeOut();
    $('#fecha_vencimiento_tramites_error').fadeOut();
    $('#numero_expediente_tramites_error').fadeOut();
    $('#numero_registro_tramites_error').fadeOut();
    $('#estatus_tramites_error').fadeOut();
    $('#cliente_select_error').fadeOut();
    $('#servicio_select_error').fadeOut();
}

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
    QuitarErrores();
    //console.clear();
}

$("#modal-estatus").on("hidden.bs.modal", function()
{
    BorrarDatos();
    QuitarErrores();
});

function EstatusBoolean()
{
    $('#estatus_boolean').val('1');
}


//Comentarios
function Comentarios(id_estatus)
{
    //console.log(id_servicio + ' ' + id_estatus);
    route = '/admin/estatus/comentarios/' + id_estatus;
    $('#title-comentarios').html('Comentarios de registro: ' + id_estatus);

    $.get(route, function(data)
    {
        $('#comentarios_vista').empty().html(data);
        $(".tooltip").tooltip("hide");
        //$('#id_servicio_comentarios').val(id_servicio);
        $('#id_estatus_comentarios').val(id_estatus);
    });
}

//Insertar comentario
$("#btn-agregar-comentario").click(function()
{
    token = $('#_token').val();
    comentario = $('#comentarios_text').val();
    id_admin = $('#id_admin').val();
    //id_servicio = $('#id_servicio_comentarios').val();
    id_estatus = $('#id_estatus_comentarios').val();

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
            //id_servicio,
            id_estatus
        }
        console.log(formData);
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
                route = '/admin/estatus/comentarios/' + id_estatus;

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
    //var id_servicio = $("#id_servicio_comentarios").val();
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
            id_estatus, comentario    
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
    id_estatus = $('#id_estatus_comentarios').val();
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

                            route = '/admin/estatus/comentarios/' + id_estatus;
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



//Contactos
function Contactos(id_cliente)
{
    $('.modal-header').css({
        'background-color' : '#348fe2'
    });

    $('modal-title').html('Contactos');

    $('#id_cliente_contacto').val(id_cliente);

    ListadoContactos(id_cliente);
    BorrarDatosContacto();
    QuitarErroresContacto();
}

function ListadoContactos(id_cliente)
{
    route = '/admin/clientes/contactos-listado/' + id_cliente;

    $.ajax(
    {
        type: 'get',
        url: route,
        success: function(data)
        {
            //console.log(data);
            $('#listado-contactos').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

function EditarContacto(id, nombre, puesto, titulo, area, telefono, telefono2, telefono3, email, email2, comentarios)
{
    $('#id_contacto').val(id);
    $('#nombre_contacto').val(nombre);
    $('#puesto_contacto').val(puesto);
    $('#titulo_contacto').val(titulo);
    $('#area_contacto').val(area);
    $('#telefono_contacto').val(telefono);
    $('#telefono2_contacto').val(telefono2);
    $('#telefono3_contacto').val(telefono3);
    $('#email_contacto').val(email);
    $('#email2_contacto').val(email2);
    $('#comentarios_contacto').val(comentarios);
}

function BorrarDatosContacto()
{
    $('#id_contacto').val('');
    $('#nombre_contacto').val('');
    $('#puesto_contacto').val('');
    $('#titulo_contacto').val('');
    $('#area_contacto').val('');
    $('#telefono_contacto').val('');
    $('#telefono2_contacto').val('');
    $('#telefono3_contacto').val('');
    $('#email_contacto').val('');
    $('#email2_contacto').val('');
    $('#comentarios_contacto').val('');
}

function QuitarErroresContacto()
{
    $('#nombre_contacto_error').fadeOut();
    $('#email_contacto_error').fadeOut();
    $('#email2_contacto_error').fadeOut();
}

$('#btn-guardar-contacto').click(function()
{
    $('#btn-guardar-contacto').attr('disabled', 'disabled');
    id = $('#id_contacto').val();
    id_cliente = $('#id_cliente_contacto').val();
    nombre = $('#nombre_contacto').val();
    puesto = $('#puesto_contacto').val();
    titulo = $('#titulo_contacto').val();
    area = $('#area_contacto').val();
    telefono = $('#telefono_contacto').val();
    telefono2 = $('#telefono2_contacto').val();
    telefono3 = $('#telefono3_contacto').val();
    email = $('#email_contacto').val();
    email2 = $('#email2_contacto').val();
    comentarios = $('#comentarios_contacto').val();
    token = $('#_token').val();

    formData ={
        nombre, puesto, titulo, area, telefono, telefono2, telefono3, 
        email, email2, comentarios, id_cliente
    }

    if(id == '')
    {
        route = '/admin/clientes/contactos/insertar';

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
                $('#btn-guardar-contacto').removeAttr('disabled');
                toastr.success('Se guardó el contacto exitosamente.');
                ListadoContactos(id_cliente);
                BorrarDatosContacto();
                QuitarErroresContacto();

            },
            error: function(data)
            {
                $('#btn-guardar-contacto').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.nombre)
                {
                    $("#nombre_contacto_error").html(data.responseJSON.errors.nombre);
                    $("#nombre_contacto_error").fadeIn();
                }
                else
                {
                    $("#nombre_contacto_error").fadeOut();
                }

                if (data.responseJSON.errors.email)
                {
                    $("#email_contacto_error").html(data.responseJSON.errors.email);
                    $("#email_contacto_error").fadeIn();
                }
                else
                {
                    $("#email_contacto_error").fadeOut();
                }

                if (data.responseJSON.errors.email2)
                {
                    $("#email2_contacto_error").html(data.responseJSON.errors.email2);
                    $("#email2_contacto_error").fadeIn();
                }
                else
                {
                    $("#email2_contacto_error").fadeOut();
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
        route = '/admin/clientes/contactos/editar/' + id;

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
                $('#btn-guardar-contacto').removeAttr('disabled');
                toastr.success('Se editó el contacto exitosamente.');
                ListadoContactos(id_cliente);
                BorrarDatosContacto();
                QuitarErroresContacto();

            },
            error: function(data)
            {
                $('#btn-guardar-contacto').removeAttr('disabled');
                console.log(data);
                if (data.responseJSON.errors.nombre)
                {
                    $("#nombre_contacto_error").html(data.responseJSON.errors.nombre);
                    $("#nombre_contacto_error").fadeIn();
                }
                else
                {
                    $("#nombre_contacto_error").fadeOut();
                }

                if (data.responseJSON.errors.email)
                {
                    $("#email_contacto_error").html(data.responseJSON.errors.email);
                    $("#email_contacto_error").fadeIn();
                }
                else
                {
                    $("#email_contacto_error").fadeOut();
                }

                if (data.responseJSON.errors.email2)
                {
                    $("#email2_contacto_error").html(data.responseJSON.errors.email2);
                    $("#email2_contacto_error").fadeIn();
                }
                else
                {
                    $("#email2_contacto_error").fadeOut();
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

$('#btn-cancelar-contacto').click(function()
{
    id_cliente = $('#id_cliente_contacto').val();
    ListadoContactos(id_cliente);
    BorrarDatosContacto();
    QuitarErroresContacto();
});











