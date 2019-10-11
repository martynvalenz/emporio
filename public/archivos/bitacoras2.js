$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function ActualizarBitacoraServicio(id_servicio)
{
    url_actuailzar = $('#url_actualizar').val();
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_actuailzar + id_servicio,
        success: function(data)
        {
            $('#servicio-' + id_servicio).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        } 
    });   
}


var openStatus = function(id)
{
    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-estatus-activar').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#modal-title-estatus-cancelar').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#estatus_tramite_activar').val(data.estatus_tramite);
        $('#estatus_tramite_cancelar').val(data.estatus_tramite);
        $('#id_servicio_activar').val(data.id);
        $('#id_servicio_cancelar').val(data.id);
        $('#registro_activar').val(data.registro);
        
    });
}

$('#btn-activar-bitacora').on('click', function()
{
    var id = $("#id_servicio_activar").val();
    //var estatus_tramite = $('#estatus_tramite_activar').val();
    var registro = $('#registro_activar').val();
    var route = "/admin/bitacoras/cambiar_status/" + id;
    var token = $("#_token").val();

    if(registro == 'Realizado')
    {
        estatus_tramite = 'Terminado';
    }
    else if(registro == 'Cancelado')
    {
        estatus_tramite = 'No Registro';
    }
    else
    {
        estatus_tramite = 'Pendiente';
    }
    
    //console.log(fecha_servicio);
    var formData = 
    {
        estatus_tramite
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
            toastr.info('Se activó el registro.');
            ActualizarServicioListado(id);
            $("#modal-activar-bitacora").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);
        }
    });
});

//Cancelar servicio, osea, Enviar servicio a chingar su puta madre
$('#btn-cancelar-bitacora').on('click', function()
{
    var id = $("#id_servicio_cancelar").val();
    var estatus_tramite = 'Cancelado';
    var route = "/admin/bitacoras/cambiar_status/" + id;
    var token = $("#_token").val();

    
    //console.log(fecha_servicio);
    var formData = 
    {
        estatus_tramite
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
            toastr.info('Se canceló el registro.');
            ActualizarServicioListado(id);
            $("#modal-cancelar-bitacora").modal('toggle');
        },
        error: function(data)
        {
            console.log(data);
        }
    });
});

//Enviar el servicio a su bitácora
var EnviarStatus = function(id)
{
    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#title-enviar-estatus').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
    });
}

$('#btn-enviar-estatus').on('click', function()
{
    id_servicio = $('#id_servicio_registro_estudio').val();
    id_cliente = $('#id_cliente_registro_estudio').val();
    id_control = $('#id_control_registro_estudio').val();
    id_admin = $('#id_admin_registro_estudio').val();
    fecha_hoy = $('#fecha_registro_estudio').val();

    split_fecha = document.getElementById('registro_fecha_estudio').value.split('-');
    fecha_anio = split_fecha[0];
    mes_anio = split_fecha[1];
    dia_anio = split_fecha[2];

    fecha_vencimiento = (fecha_anio * 1) + 10;
    fecha_vencimiento = fecha_vencimiento + '-' + mes_anio + '-' + dia_anio;

    //Fechas
    registro_fecha = $('#registro_fecha_estudio').val();
    registro_fecha_val = $('#registro_fecha_estudio_val').val();

    //Estatus
    registro = $('#registro_estudio').val();
    registro_val = $('#registro_estudio_val').val();
    estatus_tramite = $('#estatus_tramite_estudio').val();
    id_bitacoras_estatus = $('#id_bitacoras_estatus_estudio').val();
    id_bitacoras_estatus_val = $('#id_bitacoras_estatus_estudio_val').val();
    explicacion_comentarios_comentarios = $('#explicacion_comentarios_estudio').val();

    if(registro_fecha > fecha_hoy && registro != '')
    {
        $('#recepcion_alta_recepcion_alta_error').html('La fecha no puede ser mayor al día actual.');
        $('#recepcion_alta_recepcion_alta_error').fadeIn();
    }

    else
    {
        BorrarErroresRecepcion();
        route = '/admin/bitacora/estudios-factibilidad/registro/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_cliente, id_control, id_admin, fecha_vencimiento, registro_fecha, registro_fecha_val,
            registro, registro_val, estatus_tramite, id_bitacoras_estatus, id_bitacoras_estatus_val,
            explicacion_comentarios_comentarios
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRegistroEstudio();
                $("#modal-registro-estudio").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.registro_fecha)
                {
                    $("#registro_estudio_error").html(data.responseJSON.errors.registro_fecha);
                    $("#registro_estudio_error").fadeIn();
                }
                else
                {
                    $("#registro_estudio_error").fadeOut();
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
});

//Bitácoras de Trámites Nuevos
//Formato
var Formato = function(id)
{
    $('#fecha_formato').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;

    $.ajax(
    {
        type: 'get',
        url: '/admin/bitacoras/tramites-nuevos/logo/' + id,
        success: function(data)
        {
            $('#logo_formato_get').empty().html(data);
            //console.log(data);
            $(".tooltip").tooltip("hide");
        }
    });
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-formato').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_formato').val(data.id);
        $('#id_control_formato').val(data.id_control);
        

        

        //Fechas
        if(data.formato_fecha == null)
        {
            $('#formato_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#formato_fecha_formato').val(data.formato_fecha);
        }

        if(data.envio_resultados_fecha == null)
        {
            $('#envio_resultados_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#envio_resultados_fecha_formato').val(data.envio_resultados_fecha);
        }

        if(data.contrato_fecha == null)
        {
            $('#contrato_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#contrato_fecha_formato').val(data.contrato_fecha);
        }

        if(data.carta_poder_fecha == null)
        {
            $('#carta_poder_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#carta_poder_fecha_formato').val(data.carta_poder_fecha);
        }

        if(data.logo_fecha == null)
        {
            $('#logo_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#logo_fecha_formato').val(data.logo_fecha);
        }

        if(data.reglas_uso_fecha == null)
        {
            $('#reglas_uso_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#reglas_uso_fecha_formato').val(data.reglas_uso_fecha);
        }

        if(data.escaneo_fecha == null)
        {
            $('#escaneo_fecha_formato').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#escaneo_fecha_formato').val(data.escaneo_fecha);
        }

        //Estatus
        if(data.formato == null)
        {
            $('#formato_formato').val('').change();
        } 
        else
        {
            $('#formato_formato').val(data.formato).change();
        }

        if(data.envio_resultados == null)
        {
            $('#envio_resultados_formato').val('').change();
        } 
        else
        {
            $('#envio_resultados_formato').val(data.envio_resultados).change();
        }

        if(data.contrato == null)
        {
            $('#contrato_formato').val('').change();
        } 
        else
        {
            $('#contrato_formato').val(data.contrato).change();
        }

        if(data.carta_poder == null)
        {
            $('#carta_poder_formato').val('').change();
        } 
        else
        {
            $('#carta_poder_formato').val(data.carta_poder).change();
        }

        if(data.logo == null)
        {
            $('#logo_formato').val('').change();
        } 
        else
        {
            $('#logo_formato').val(data.logo).change();
        }

        if(data.reglas_uso == null)
        {
            $('#reglas_uso_formato').val('').change();
        } 
        else
        {
            $('#reglas_uso_formato').val(data.reglas_uso).change();
        }

        if(data.escaneo == null)
        {
            $('#escaneo_formato').val('').change();
        } 
        else
        {
            $('#escaneo_formato').val(data.escaneo).change();
        }
        
    });

    
}

$("#btn-formato").click(function()
{
    BorrarErroresFormato();

    id_servicio = $('#id_servicio_formato').val();
    id_control = $('#id_control_formato').val();
    fecha_hoy = $('#fecha_formato').val();
    //Fechas
    formato_fecha = $('#formato_fecha_formato').val();
    envio_resultados_fecha = $('#envio_resultados_fecha_formato').val();
    contrato_fecha = $('#contrato_fecha_formato').val();
    carta_poder_fecha = $('#carta_poder_fecha_formato').val();
    logo_fecha = $('#logo_fecha_formato').val();
    reglas_uso_fecha = $('#reglas_uso_fecha_formato').val();
    escaneo_fecha = $('#escaneo_fecha_formato').val();

    //Estatus
    formato = $('#formato_formato').val();
    envio_resultados = $('#envio_resultados_formato').val();
    contrato = $('#contrato_formato').val();
    carta_poder = $('#carta_poder_formato').val();
    logo = $('#logo_formato').val();
    logo_url = $('#logo_url_formato_control').val();
    logo_url_logo = $('#logo_url_formato').val();
    reglas_uso = $('#reglas_uso_formato').val();
    escaneo = $('#escaneo_formato').val();

    if(formato_fecha > fecha_hoy && formato != '')
    {
        $('#formato_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#formato_fecha_formato_error').fadeIn();
    }
    else if(envio_resultados_fecha > fecha_hoy && envio_resultados != '')
    {
        $('#envio_resultados_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#envio_resultados_fecha_formato_error').fadeIn();
    }
    else if(contrato_fecha > fecha_hoy && contrato  != '')
    {
        $('#contrato_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#contrato_fecha_formato_error').fadeIn();
    }
    else if(carta_poder_fecha > fecha_hoy && carta_poder  != '')
    {
        $('#carta_poder_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#carta_poder_fecha_formato_error').fadeIn();
    }
    else if(logo_fecha > fecha_hoy && logo != '')
    {
        $('#logo_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#logo_fecha_formato_error').fadeIn();
    }
    else if(reglas_uso_fecha > fecha_hoy && reglas_uso != '')
    {
        $('#reglas_uso_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#reglas_uso_fecha_formato_error').fadeIn();
    }
    else if(escaneo_fecha > fecha_hoy && escaneo != '')
    {
        $('#escaneo_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#escaneo_fecha_formato_error').fadeIn();
    }

    else
    {
        
        route = '/admin/bitacoras/tramites-nuevos/formato/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            formato_fecha, formato,
            envio_resultados_fecha, envio_resultados,
            contrato_fecha, contrato,
            carta_poder_fecha, carta_poder,
            logo_fecha, logo, logo_url, logo_url_logo,
            reglas_uso_fecha, reglas_uso,
            escaneo_fecha, escaneo, id_control, 
        }

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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresFormato();
                $("#modal-formato").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.formato_fecha)
                {
                    $("#formato_fecha_formato_error").html(data.responseJSON.errors.formato_fecha);
                    $("#formato_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#formato_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.envio_resultados_fecha)
                {
                    $("#envio_resultados_fecha_formato_error").html(data.responseJSON.errors.envio_resultados_fecha);
                    $("#envio_resultados_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#envio_resultados_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.contrato_fecha)
                {
                    $("#contrato_fecha_formato_error").html(data.responseJSON.errors.contrato_fecha);
                    $("#contrato_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#contrato_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.carta_poder_fecha)
                {
                    $("#carta_poder_fecha_formato_error").html(data.responseJSON.errors.carta_poder_fecha);
                    $("#carta_poder_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#carta_poder_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.logo_fecha)
                {
                    $("#logo_fecha_formato_error").html(data.responseJSON.errors.logo_fecha);
                    $("#logo_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#logo_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.reglas_uso_fecha)
                {
                    $("#reglas_uso_fecha_formato_error").html(data.responseJSON.errors.reglas_uso_fecha);
                    $("#reglas_uso_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#reglas_uso_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.escaneo_fecha)
                {
                    $("#escaneo_fecha_formato_error").html(data.responseJSON.errors.escaneo_fecha);
                    $("#escaneo_fecha_formato_error").fadeIn();
                }
                else
                {
                    $("#escaneo_fecha_formato_error").fadeOut();
                }

                if (data.responseJSON.errors.logo_url_logo)
                {
                    $("#logo_url_formato_error").html(data.responseJSON.errors.logo_url_logo);
                    $("#logo_url_formato_error").fadeIn();
                    $('#logo_url_formato').val('');
                }
                else
                {
                    $("#logo_url_formato_error").fadeOut();
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


});
   


jQuery("#logo_url_formato").on("change", function() 
{
    formdata = new FormData();
    var id = $('#id_servicio_formato').val();
    var route = '/admin/bitacoras/tramites-nuevos/logo-insertar/' + id;
    var file = this.files[0];
    if (formdata) 
    {
        formdata.append("logo_url", file);
        jQuery.ajax(
        {
            url: route,
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success:function()
            {
                $.ajax(
                {
                    type: 'get',
                    url: '/admin/bitacoras/tramites-nuevos/logo/' + id,
                    success: function(data)
                    {
                        $('#logo_formato_get').empty().html(data);
                        //console.log(data);
                        $(".tooltip").tooltip("hide");
                        toastr.info('Imagen cargada con éxito');
                    },
                    error: function(data)
                    {
                        console.clear();
                        toastr.error('El tipo de archivo seleccionado no es un formato válido (jpg, jpeg, png, gif o svg).');
                    }
                });
            }
        });
    }                       
});

function BorrarErroresFormato()
{
    $('#formato_fecha_formato_error').fadeOut();
    $('#envio_resultados_fecha_formato_error').fadeOut();
    $('#contrato_fecha_formato_error').fadeOut();
    $('#carta_poder_fecha_formato_error').fadeOut();
    $('#logo_fecha_formato_error').fadeOut();
    $('#reglas_uso_fecha_formato_error').fadeOut();
    $('#escaneo_fecha_formato_error').fadeOut();
    $('#logo_url_formato_error').fadeOut();
}

  
//Recepcion
var Recepcion = function(id)
{
    BorrarErroresRecepcion();

    $('#fecha_recepcion').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-recepcion').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_recepcion').val(data.id);
        $('#id_control_recepcion').val(data.id_control);
        $('#id_cliente_recepcion').val(data.id_cliente);
        $('#id_bitacoras_estatus_recepcion').val(data.id_bitacoras_estatus).change();
        $('#id_bitacoras_estatus_recepcion_value').val(data.id_bitacoras_estatus);

        //Fechas
        if(data.recepcion_alta_fecha == null)
        {
            $('#recepcion_alta_fecha_recepcion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#recepcion_alta_fecha_recepcion').val(data.recepcion_alta_fecha);
        }

        if(data.marca_lista_ingreso_fecha == null)
        {
            $('#marca_lista_ingreso_fecha_recepcion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#marca_lista_ingreso_fecha_recepcion').val(data.marca_lista_ingreso_fecha);
        }

        if(data.validacion_marca_fecha == null)
        {
            $('#validacion_marca_fecha_recepcion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#validacion_marca_fecha_recepcion').val(data.validacion_marca_fecha);
        }

        if(data.revision_fecha == null)
        {
            $('#revision_fecha_recepcion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#revision_fecha_recepcion').val(data.revision_fecha);
        }

        if(data.firma_fiel_fecha == null)
        {
            $('#firma_fiel_fecha_recepcion').datepicker().datepicker('setDate', 'today');
            $('#firma_fiel_fecha_recepcion_value').val('');
        } 
        else
        {
            $('#firma_fiel_fecha_recepcion').val(data.firma_fiel_fecha);
            $('#firma_fiel_fecha_recepcion_value').val(data.firma_fiel_fecha);
        }

        if(data.impresion_fecha == null)
        {
            $('#impresion_fecha_recepcion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#impresion_fecha_recepcion').val(data.impresion_fecha);
        }

        //Estatus
        if(data.recepcion_alta == null)
        {
            $('#recepcion_alta_recepcion').val('').change();
        } 
        else
        {
            $('#recepcion_alta_recepcion').val(data.recepcion_alta).change();
        }

        if(data.marca_lista_ingreso == null)
        {
            $('#marca_lista_ingreso_recepcion').val('').change();
        } 
        else
        {
            $('#marca_lista_ingreso_recepcion').val(data.marca_lista_ingreso).change();
        }

        if(data.validacion_marca == null)
        {
            $('#validacion_marca_recepcion').val('').change();
        } 
        else
        {
            $('#validacion_marca_recepcion').val(data.validacion_marca).change();
        }

        if(data.revision == null)
        {
            $('#revision_recepcion').val('').change();
        } 
        else
        {
            $('#revision_recepcion').val(data.revision).change();
        }

        if(data.firma_fiel == null)
        {
            $('#firma_fiel_recepcion').val('').change();
            $('#firma_fiel_recepcion_value').val('');
        } 
        else
        {
            $('#firma_fiel_recepcion').val(data.firma_fiel).change();
            $('#firma_fiel_recepcion_value').val(data.firma_fiel);
        }

        if(data.impresion == null)
        {
            $('#impresion_recepcion').val('').change();
        } 
        else
        {
            $('#impresion_recepcion').val(data.impresion).change();
        }

        if(data.id_bitacoras_estatus == null)
        {
            $('#id_bitacoras_estatus_recepcion').val('').change();
        } 
        else
        {
            $('#id_bitacoras_estatus_recepcion').val(data.id_bitacoras_estatus).change();
        }
        
    });

    
}

$("#btn-recepcion").click(function()
{
    BorrarErroresRecepcion();

    id_servicio = $('#id_servicio_recepcion').val();
    id_cliente = $('#id_cliente_recepcion').val();
    id_control = $('#id_control_recepcion').val();
    id_admin = $('#id_admin_recepcion').val();
    fecha_hoy = $('#fecha_recepcion').val();
    //Fechas
    recepcion_alta_fecha = $('#recepcion_alta_fecha_recepcion').val();
    marca_lista_ingreso_fecha = $('#marca_lista_ingreso_fecha_recepcion').val();
    validacion_marca_fecha = $('#validacion_marca_fecha_recepcion').val();
    revision_fecha = $('#revision_fecha_recepcion').val();
    firma_fiel_fecha = $('#firma_fiel_fecha_recepcion').val();
    firma_fiel_fecha_value = $('#firma_fiel_fecha_recepcion_value').val();
    impresion_fecha = $('#impresion_fecha_recepcion').val();

    split_fecha = document.getElementById('firma_fiel_fecha_recepcion').value.split('-');
    fecha_anio = split_fecha[0];
    mes_anio = split_fecha[1];
    dia_anio = split_fecha[2];

    fecha_vencimiento = (fecha_anio * 1) + 10;
    fecha_vencimiento = fecha_vencimiento + '-' + mes_anio + '-' + dia_anio;
    //console.log(fecha_vencimiento);

    //Estatus
    recepcion_alta = $('#recepcion_alta_recepcion').val();
    marca_lista_ingreso = $('#marca_lista_ingreso_recepcion').val();
    validacion_marca = $('#validacion_marca_recepcion').val();
    revision = $('#revision_recepcion').val();
    firma_fiel = $('#firma_fiel_recepcion').val();
    firma_fiel_value = $('#firma_fiel_recepcion_value').val();
    impresion = $('#impresion_recepcion').val();
    id_bitacoras_estatus = $('#id_bitacoras_estatus_recepcion').val();
    id_bitacoras_estatus_value = $('#id_bitacoras_estatus_recepcion_value').val();

    if(recepcion_alta_fecha > fecha_hoy && recepcion_alta != '')
    {
        $('#recepcion_alta_recepcion_error').html('La fecha no puede ser mayor al día actual.');
        $('#recepcion_alta_recepcion_error').fadeIn();
    }
    else if(marca_lista_ingreso_fecha > fecha_hoy && marca_lista_ingreso != '')
    {
        $('#marca_lista_ingreso_recepcion_error').html('La fecha no puede ser mayor al día actual.');
        $('#marca_lista_ingreso_recepcion_error').fadeIn();
    }
    else if(validacion_marca_fecha > fecha_hoy && validacion_marca  != '')
    {
        $('#validacion_marca_recepcion_error').html('La fecha no puede ser mayor al día actual.');
        $('#validacion_marca_recepcion_error').fadeIn();
    }
    else if(revision_fecha > fecha_hoy && revision  != '')
    {
        $('#revision_recepcion_error').html('La fecha no puede ser mayor al día actual.');
        $('#revision_recepcion_error').fadeIn();
    }
    else if(firma_fiel_fecha > fecha_hoy && firma_fiel != '')
    {
        $('#firma_fiel_recepcion_error').html('La fecha no puede ser mayor al día actual.');
        $('#firma_fiel_recepcion_error').fadeIn();
    }
    else if(impresion_fecha > fecha_hoy && impresion != '')
    {
        $('#reglas_uso_fecha_formato_error').html('La fecha no puede ser mayor al día actual.');
        $('#reglas_uso_fecha_formato_error').fadeIn();
    }
    else if((firma_fiel_fecha == '' || firma_fiel == '') && id_bitacoras_estatus != '')
    {
        $('#id_bitacoras_estatus_recepcion_error').html('No se puede enviar a una bitácora de estatus sin tener la firma fiel.');
        $('#id_bitacoras_estatus_recepcion_error').fadeIn();
    }

    else
    {
        BorrarErroresRecepcion();
        route = '/admin/bitacora/tramites-nuevos/recepcion/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, recepcion_alta_fecha, marca_lista_ingreso_fecha, validacion_marca_fecha,
            revision_fecha, firma_fiel_fecha, impresion_fecha, recepcion_alta, marca_lista_ingreso, 
            validacion_marca, revision, firma_fiel, firma_fiel_value, firma_fiel_fecha_value, impresion, id_bitacoras_estatus, 
            id_bitacoras_estatus_value, fecha_vencimiento
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRecepcion();
                $("#modal-recepcion").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.recepcion_alta_fecha)
                {
                    $("#recepcion_alta_recepcion_error").html(data.responseJSON.errors.recepcion_alta_fecha);
                    $("#recepcion_alta_recepcion_error").fadeIn();
                }
                else
                {
                    $("#recepcion_alta_recepcion_error").fadeOut();
                }

                if (data.responseJSON.errors.marca_lista_ingreso_fecha)
                {
                    $("#marca_lista_ingreso_recepcion_error").html(data.responseJSON.errors.marca_lista_ingreso_fecha);
                    $("#marca_lista_ingreso_recepcion_error").fadeIn();
                }
                else
                {
                    $("#marca_lista_ingreso_recepcion_error").fadeOut();
                }

                if (data.responseJSON.errors.validacion_marca_fecha)
                {
                    $("#validacion_marca_recepcion_error").html(data.responseJSON.errors.validacion_marca_fecha);
                    $("#validacion_marca_recepcion_error").fadeIn();
                }
                else
                {
                    $("#validacion_marca_recepcion_error").fadeOut();
                }

                if (data.responseJSON.errors.revision_fecha)
                {
                    $("#revision_recepcion_error").html(data.responseJSON.errors.revision_fecha);
                    $("#revision_recepcion_error").fadeIn();
                }
                else
                {
                    $("#revision_recepcion_error").fadeOut();
                }

                if (data.responseJSON.errors.firma_fiel_fecha)
                {
                    $("#firma_fiel_recepcion_error").html(data.responseJSON.errors.firma_fiel_fecha);
                    $("#firma_fiel_recepcion_error").fadeIn();
                }
                else
                {
                    $("#firma_fiel_recepcion_error").fadeOut();
                }

                if (data.responseJSON.errors.impresion_fecha)
                {
                    $("#impresion_recepcion_error").html(data.responseJSON.errors.impresion_fecha);
                    $("#impresion_recepcion_error").fadeIn();
                }
                else
                {
                    $("#impresion_recepcion_error").fadeOut();
                }

                if (data.responseJSON.errors.id_bitacoras_estatus)
                {
                    $("#id_bitacoras_estatus_recepcion_error").html(data.responseJSON.errors.id_bitacoras_estatus);
                    $("#id_bitacoras_estatus_recepcion_error").fadeIn();
                }
                else
                {
                    $("#id_bitacoras_estatus_recepcion_error").fadeOut();
                }
                
                
                toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
                
            }
        });
    }


});


function BorrarErroresRecepcion()
{
    $('#recepcion_alta_recepcion_error').fadeOut();
    $('#marca_lista_ingreso_recepcion_error').fadeOut();
    $('#validacion_marca_recepcion_error').fadeOut();
    $('#revision_recepcion_error').fadeOut();
    $('#firma_fiel_recepcion_error').fadeOut();
    $('#impresion_recepcion_error').fadeOut();
    $('#id_bitacoras_estatus_recepcion_error').fadeOut();
}


//ElaboracionExpediente
var ElaboracionExpediente = function(id)
{
    BorrarErroresElaboracionExpediente();

    $('#fecha_elaboracion').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-envio-expediente-tramite').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_elaboracion').val(data.id);
        $('#id_control_elaboracion').val(data.id_control);
        $('#id_cliente_elaboracion').val(data.id_cliente);
        $('#presentacion_fecha').val(data.firma_fiel_fecha);

        //Fechas
        if(data.elaboracion_expediente_fecha == null)
        {
            $('#elaboracion_expediente_fecha_elaboracion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#elaboracion_expediente_fecha_elaboracion').val(data.elaboracion_expediente_fecha);
        }

        if(data.envio_expediente_fecha == null)
        {
            $('#envio_expediente_fecha_elaboracion').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#envio_expediente_fecha_elaboracion').val(data.envio_expediente_fecha);
        }

        //Estatus
        if(data.elaboracion_expediente == null)
        {
            $('#elaboracion_expediente_elaboracion').val('').change();
        } 
        else
        {
            $('#elaboracion_expediente_elaboracion').val(data.elaboracion_expediente).change();
        }

        if(data.envio_expediente == null)
        {
            $('#envio_expediente_elaboracion').val('').change();
        } 
        else
        {
            $('#envio_expediente_elaboracion').val(data.envio_expediente).change();
        }

        $('#estatus_tramite_tramites_nuevos').val(data.estatus_tramite).change();
    });
}

$("#btn-elaboracion-expediente").click(function()
{
    BorrarErroresElaboracionExpediente();

    id_servicio = $('#id_servicio_elaboracion').val();
    id_control = $('#id_control_elaboracion').val();
    id_admin = $('#id_admin_elaboracion').val();
    fecha_hoy = $('#fecha_elaboracion').val();
    presentacion_fecha = $('#presentacion_fecha').val();
    //Fechas
    elaboracion_expediente_fecha = $('#elaboracion_expediente_fecha_elaboracion').val();
    envio_expediente_fecha = $('#envio_expediente_fecha_elaboracion').val();

    //Estatus
    elaboracion_expediente = $('#elaboracion_expediente_elaboracion').val();
    envio_expediente = $('#envio_expediente_elaboracion').val();
    estatus_tramite = $('#estatus_tramite_tramites_nuevos').val();

    if(elaboracion_expediente_fecha > fecha_hoy && elaboracion_expediente != '')
    {
        $('#elaboracion_expediente_fecha_elaboracion_error').html('La fecha no puede ser mayor al día actual.');
        $('#elaboracion_expediente_fecha_elaboracion_error').fadeIn();
    }
    else if(envio_expediente_fecha > fecha_hoy && envio_expediente != '')
    {
        $('#envio_expediente_fecha_elaboracion_error').html('La fecha no puede ser mayor al día actual.');
        $('#envio_expediente_fecha_elaboracion_error').fadeIn();
    }

    else if(elaboracion_expediente == '' || envio_expediente == '')
    {
        $('#estatus_tramite_tramites_nuevos_error').html('Para terminar el proceso, se debe seleccionar una opción en el envío y en la elaboración del expediente.');
        $('#estatus_tramite_tramites_nuevos_error').fadeIn();
    }
    
    else
    {
        BorrarErroresElaboracionExpediente();
        route = '/admin/bitacora/tramites-nuevos/elaboracion-expediente/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, elaboracion_expediente_fecha, envio_expediente_fecha,
            elaboracion_expediente, envio_expediente, estatus_tramite, fecha_hoy, presentacion_fecha
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresElaboracionExpediente();
                $("#modal-elaboracion-expediente").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.elaboracion_expediente_fecha)
                {
                    $("#elaboracion_expediente_fecha_elaboracion_error").html(data.responseJSON.errors.elaboracion_expediente_fecha);
                    $("#elaboracion_expediente_fecha_elaboracion_error").fadeIn();
                }
                else
                {
                    $("#elaboracion_expediente_fecha_elaboracion_error").fadeOut();
                }

                if (data.responseJSON.errors.envio_expediente_fecha)
                {
                    $("#envio_expediente_fecha_elaboracion_error").html(data.responseJSON.errors.envio_expediente_fecha);
                    $("#envio_expediente_fecha_elaboracion_error").fadeIn();
                }
                else
                {
                    $("#envio_expediente_fecha_elaboracion_error").fadeOut();
                }

                

                if (data.responseJSON.errors.estatus_tramite)
                {
                    $("#estatus_tramite_tramites_nuevos_error").html(data.responseJSON.errors.estatus_tramite);
                    $("#estatus_tramite_tramites_nuevos_error").fadeIn();
                }
                else
                {
                    $("#estatus_tramite_tramites_nuevos_error").fadeOut();
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


});


function BorrarErroresElaboracionExpediente()
{
    $('#elaboracion_expediente_fecha_elaboracion_error').fadeOut();
    $('#envio_expediente_fecha_elaboracion_error').fadeOut();
    $('#estatus_tramite_tramites_nuevos_error').fadeOut();
}



//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------



//Estudios de Factibilidad
//Recepcion Alta
var RecepcionAlta = function(id)
{
    BorrarErroresRecepcionAlta();

    $('#fecha_recepcion_alta').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-recepcion-alta').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_recepcion_alta').val(data.id);
        $('#id_control_recepcion_alta').val(data.id_control);
        $('#id_cliente_recepcion_alta').val(data.id_cliente);

        //Fechas
        if(data.recepcion_alta_fecha == null)
        {
            $('#recepcion_alta_fecha_recepcion_alta').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#recepcion_alta_fecha_recepcion_alta').val(data.recepcion_alta_fecha);
        }

        if(data.elaboracion_expediente_fecha == null)
        {
            $('#elaboracion_expediente_fecha_recepcion_alta').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#elaboracion_expediente_fecha_recepcion_alta').val(data.elaboracion_expediente_fecha);
        }

        if(data.revision_fecha == null)
        {
            $('#revision_fecha_recepcion_alta').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#revision_fecha_recepcion_alta').val(data.revision_fecha);
        }

        if(data.envio_expediente_fecha == null)
        {
            $('#envio_expediente_fecha_recepcion_alta').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#envio_expediente_fecha_recepcion_alta').val(data.envio_expediente_fecha);
        }

        //Estatus
        if(data.recepcion_alta == null)
        {
            $('#recepcion_alta_recepcion_alta').val('').change();
        } 
        else
        {
            $('#recepcion_alta_recepcion_alta').val(data.recepcion_alta).change();
        }

        if(data.elaboracion_expediente == null)
        {
            $('#elaboracion_expediente_recepcion_alta').val('').change();
        } 
        else
        {
            $('#elaboracion_expediente_recepcion_alta').val(data.elaboracion_expediente).change();
        }

        if(data.revision == null)
        {
            $('#revision_recepcion_alta').val('').change();
        } 
        else
        {
            $('#revision_recepcion_alta').val(data.revision).change();
        }

        if(data.envio_expediente == null)
        {
            $('#envio_expediente_recepcion_alta').val('').change();
        } 
        else
        {
            $('#envio_expediente_recepcion_alta').val(data.envio_expediente).change();
        }
        
    });

    
}

$("#btn-recepcion-alta").click(function()
{
    BorrarErroresRecepcionAlta();

    id_servicio = $('#id_servicio_recepcion_alta').val();
    id_control = $('#id_control_recepcion_alta').val();
    id_admin = $('#id_admin_recepcion_alta').val();
    fecha_hoy = $('#fecha_recepcion_alta').val();
    //Fechas
    recepcion_alta_fecha = $('#recepcion_alta_fecha_recepcion_alta').val();
    elaboracion_expediente_fecha = $('#elaboracion_expediente_fecha_recepcion_alta').val();
    revision_fecha = $('#revision_fecha_recepcion_alta').val();
    envio_expediente_fecha = $('#envio_expediente_fecha_recepcion_alta').val();

    //Estatus
    recepcion_alta = $('#recepcion_alta_recepcion_alta').val();
    elaboracion_expediente = $('#elaboracion_expediente_recepcion_alta').val();
    revision = $('#revision_recepcion_alta').val();
    envio_expediente = $('#envio_expediente_recepcion_alta').val();

    if(recepcion_alta_fecha > fecha_hoy && recepcion_alta != '')
    {
        $('#recepcion_alta_recepcion_alta_error').html('La fecha no puede ser mayor al día actual.');
        $('#recepcion_alta_recepcion_alta_error').fadeIn();
    }
    else if(elaboracion_expediente_fecha > fecha_hoy && elaboracion_expediente != '')
    {
        $('#elaboracion_expediente_recepcion_alta_error').html('La fecha no puede ser mayor al día actual.');
        $('#elaboracion_expediente_recepcion_alta_error').fadeIn();
    }
    else if(revision_fecha > fecha_hoy && revision  != '')
    {
        $('#revision_recepcion_alta_error').html('La fecha no puede ser mayor al día actual.');
        $('#revision_recepcion_alta_error').fadeIn();
    }
    else if(envio_expediente_fecha > fecha_hoy && envio_expediente  != '')
    {
        $('#envio_expediente_recepcion_alta_error').html('La fecha no puede ser mayor al día actual.');
        $('#envio_expediente_recepcion_alta_error').fadeIn();
    }

    else
    {
        BorrarErroresRecepcionAlta();
        route = '/admin/bitacora/estudios-factibilidad/recepcion-alta/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, recepcion_alta_fecha, elaboracion_expediente_fecha, revision_fecha,
            envio_expediente_fecha, recepcion_alta, elaboracion_expediente, revision, envio_expediente
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRecepcionAlta();
                $("#recepcion-alta-modal").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.recepcion_alta_fecha)
                {
                    $("#recepcion_alta_recepcion_alta_error").html(data.responseJSON.errors.recepcion_alta_fecha);
                    $("#recepcion_alta_recepcion_alta_error").fadeIn();
                }
                else
                {
                    $("#recepcion_alta_recepcion_alta_error").fadeOut();
                }

                if (data.responseJSON.errors.elaboracion_expediente_fecha)
                {
                    $("#elaboracion_expediente_recepcion_alta_error").html(data.responseJSON.errors.elaboracion_expediente_fecha);
                    $("#elaboracion_expediente_recepcion_alta_error").fadeIn();
                }
                else
                {
                    $("#elaboracion_expediente_recepcion_alta_error").fadeOut();
                }

                if (data.responseJSON.errors.revision_fecha)
                {
                    $("#revision_recepcion_alta_error").html(data.responseJSON.errors.revision_fecha);
                    $("#revision_recepcion_alta_error").fadeIn();
                }
                else
                {
                    $("#revision_recepcion_alta_error").fadeOut();
                }

                if (data.responseJSON.errors.envio_expediente_fecha)
                {
                    $("#envio_expediente_recepcion_alta_error").html(data.responseJSON.errors.envio_expediente_fecha);
                    $("#envio_expediente_recepcion_alta_error").fadeIn();
                }
                else
                {
                    $("#envio_expediente_recepcion_alta_error").fadeOut();
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


});


function BorrarErroresRecepcionAlta()
{
    $('#recepcion_alta_recepcion_alta_error').fadeOut();
    $('#elaboracion_expediente_recepcion_alta_error').fadeOut();
    $('#revision_recepcion_alta_error').fadeOut();
    $('#envio_expediente_recepcion_alta_error').fadeOut();
}


//Registro
var EstudiosFactibilidadRegistro = function(id)
{
    BorrarErroresRegistroEstudio();

    $('#fecha_registro_estudio').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-registro-estudio').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_registro_estudio').val(data.id);
        $('#id_control_registro_estudio').val(data.id_control);
        $('#id_cliente_registro_estudio').val(data.id_cliente);

        //Fechas
        if(data.registro_fecha == null)
        {
            $('#registro_fecha_estudio').datepicker().datepicker('setDate', 'today');
            $('#regsitro_fecha_estudio_val').val(data.registro_fecha);
        } 
        else
        {
            $('#registro_fecha_estudio').val(data.registro_fecha);
            $('#regsitro_fecha_estudio_val').val(data.registro_fecha);
        }

        //Estatus
        if(data.registro == null)
        {
            $('#registro_estudio').val('').change();
            $('#registro_estudio_val').val(data.registro);
        } 
        else
        {
            $('#registro_estudio').val(data.registro).change();
            $('#registro_estudio_val').val(data.registro);
        }

        $('#id_bitacoras_estatus_estudio').val(data.id_bitacoras_estatus).change();
        $('#id_bitacoras_estatus_estudio_val').val(data.id_bitacoras_estatus).change();
        $('#explicacion_comentarios_estudio').val(data.explicacion_comentarios_comentarios).change();
        $('#explicacion_comentarios_estudio_value').val(data.explicacion_comentarios_comentarios);
        $('#estatus_tramite_estudio').val(data.estatus_tramite).change();
        
    });

    
}

$("#btn-registro-estudio").click(function()
{
    BorrarErroresRegistroEstudio();

    id_servicio = $('#id_servicio_registro_estudio').val();
    id_cliente = $('#id_cliente_registro_estudio').val();
    id_control = $('#id_control_registro_estudio').val();
    id_admin = $('#id_admin_registro_estudio').val();
    fecha_hoy = $('#fecha_registro_estudio').val();

    split_fecha = document.getElementById('registro_fecha_estudio').value.split('-');
    fecha_anio = split_fecha[0];
    mes_anio = split_fecha[1];
    dia_anio = split_fecha[2];

    fecha_vencimiento = (fecha_anio * 1) + 10;
    fecha_vencimiento = fecha_vencimiento + '-' + mes_anio + '-' + dia_anio;

    //Fechas
    registro_fecha = $('#registro_fecha_estudio').val();
    registro_fecha_val = $('#registro_fecha_estudio_val').val();

    //Estatus
    registro = $('#registro_estudio').val();
    registro_val = $('#registro_estudio_val').val();
    estatus_tramite = $('#estatus_tramite_estudio').val();
    id_bitacoras_estatus = $('#id_bitacoras_estatus_estudio').val();
    id_bitacoras_estatus_val = $('#id_bitacoras_estatus_estudio_val').val();
    explicacion_comentarios_comentarios = $('#explicacion_comentarios_estudio').val();
    explicacion_comentarios_comentarios_value = $('#explicacion_comentarios_estudio_value').val();

    if(registro_fecha > fecha_hoy && registro != '')
    {
        $('#recepcion_alta_recepcion_alta_error').html('La fecha no puede ser mayor al día actual.');
        $('#recepcion_alta_recepcion_alta_error').fadeIn();
    }

    else
    {
        BorrarErroresRegistroEstudio();
        route = '/admin/bitacora/estudios-factibilidad/registro/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_cliente, id_control, id_admin, fecha_vencimiento, registro_fecha, registro_fecha_val,
            registro, registro_val, estatus_tramite, id_bitacoras_estatus, id_bitacoras_estatus_val,
            explicacion_comentarios_comentarios, explicacion_comentarios_comentarios_value
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRegistroEstudio();
                $("#modal-registro-estudio").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.registro_fecha)
                {
                    $("#registro_estudio_error").html(data.responseJSON.errors.registro_fecha);
                    $("#registro_estudio_error").fadeIn();
                }
                else
                {
                    $("#registro_estudio_error").fadeOut();
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


});


function BorrarErroresRegistroEstudio()
{
    $('#registro_estudio_error').fadeOut();
}


//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------



//Negativas
//Recepcion Alta en Estatus
var RecepcionAltaNegativas = function(id)
{
    BorrarErroresAltaEstatusNegativas();

    $('#fecha_recepcion_negativa').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-recepcion-alta-negativa').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_recepcion_negativa').val(data.id);
        $('#id_control_recepcion_negativa').val(data.id_control);
        $('#id_cliente_recepcion_negativa').val(data.id_cliente);

        //Fechas
        if(data.alta_estatus_fecha == null)
        {
            $('#alta_estatus_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#alta_estatus_fecha_negativa').val(data.alta_estatus_fecha);
        }

        if(data.escaneo_fecha == null)
        {
            $('#escaneo_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#escaneo_fecha_negativa').val(data.escaneo_fecha);
        }

        if(data.vencimiento_tramite_fecha == null)
        {
            $('#vencimiento_tramite_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#vencimiento_tramite_fecha_negativa').val(data.vencimiento_tramite_fecha);
        }

        //Estatus
        if(data.alta_estatus == null)
        {
            $('#alta_estatus_negativa').val('').change();
        } 
        else
        {
            $('#alta_estatus_negativa').val(data.alta_estatus).change();
        }

        if(data.escaneo == null)
        {
            $('#escaneo_negativa').val('').change();
        } 
        else
        {
            $('#escaneo_negativa').val(data.escaneo).change();
        }
        
    });

    
}

$("#btn-alta-estatus-negativa").click(function()
{
    BorrarErroresAltaEstatusNegativas();

    id_servicio = $('#id_servicio_recepcion_negativa').val();
    id_control = $('#id_control_recepcion_negativa').val();
    id_admin = $('#id_admin_recepcion_negativa').val();
    fecha_hoy = $('#fecha_recepcion_negativa').val();
    //Fechas
    alta_estatus_fecha = $('#alta_estatus_fecha_negativa').val();
    escaneo_fecha = $('#escaneo_fecha_negativa').val();
    vencimiento_tramite_fecha = $('#vencimiento_tramite_fecha_negativa').val();

    //Estatus
    alta_estatus = $('#alta_estatus_negativa').val();
    escaneo = $('#escaneo_negativa').val();

    if(alta_estatus_fecha > fecha_hoy && alta_estatus != '')
    {
        $('#alta_estatus_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#alta_estatus_negativa_error').fadeIn();
    }
    else if(escaneo_fecha > fecha_hoy && escaneo != '')
    {
        $('#escaneo_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#escaneo_negativa_error').fadeIn();
    }

    else
    {
        BorrarErroresAltaEstatusNegativas();
        route = '/admin/bitacora/negativas/alta-estatus/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, alta_estatus_fecha, escaneo_fecha, alta_estatus, escaneo, 
            vencimiento_tramite_fecha
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresAltaEstatusNegativas();
                $("#modal-recepcion-alta").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.alta_estatus_fecha)
                {
                    $("#alta_estatus_negativa_error").html(data.responseJSON.errors.alta_estatus_fecha);
                    $("#alta_estatus_negativa_error").fadeIn();
                }
                else
                {
                    $("#alta_estatus_negativa_error").fadeOut();
                }

                if (data.responseJSON.errors.escaneo_fecha)
                {
                    $("#escaneo_negativa_error").html(data.responseJSON.errors.escaneo_fecha);
                    $("#escaneo_negativa_error").fadeIn();
                }
                else
                {
                    $("#escaneo_negativa_error").fadeOut();
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


});


function BorrarErroresAltaEstatusNegativas()
{
    $('#alta_estatus_negativa_error').fadeOut();
    $('#escaneo_negativa_error').fadeOut();
}



//Elaboración de notificación
var ElaboracionNotificacionNegativa = function(id)
{
    BorrarErroresElaboracionNotificacionNegativa();

    $('#fecha_elaboracion_notificacion_negativa').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-notificacion-negativa').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_elaboracion_notificacion_negativa').val(data.id);
        $('#id_control_elaboracion_notificacion_negativa').val(data.id_control);
        $('#id_cliente_elaboracion_notificacion_negativa').val(data.id_cliente);

        //Fechas
        if(data.elaboracion_notificacion_agradecimiento_fecha == null)
        {
            $('#elaboracion_notificacion_agradecimiento_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#elaboracion_notificacion_agradecimiento_fecha_negativa').val(data.elaboracion_notificacion_agradecimiento_fecha);
        }

        //Estatus
        if(data.elaboracion_notificacion_agradecimiento == null)
        {
            $('#elaboracion_notificacion_agradecimiento_negativa').val('').change();
        } 
        else
        {
            $('#elaboracion_notificacion_agradecimiento_negativa').val(data.elaboracion_notificacion_agradecimiento).change();
        }
        
    });

    
}

$("#btn-elaboracion-notificacion-negativa").click(function()
{
    BorrarErroresElaboracionNotificacionNegativa();

    id_servicio = $('#id_servicio_elaboracion_notificacion_negativa').val();
    id_control = $('#id_control_elaboracion_notificacion_negativa').val();
    id_admin = $('#id_admin_elaboracion_notificacion_negativa').val();
    fecha_hoy = $('#fecha_elaboracion_notificacion_negativa').val();
    //Fechas
    elaboracion_notificacion_agradecimiento_fecha = $('#elaboracion_notificacion_agradecimiento_fecha_negativa').val();

    //Estatus
    elaboracion_notificacion_agradecimiento = $('#elaboracion_notificacion_agradecimiento_negativa').val();

    if(elaboracion_notificacion_agradecimiento_fecha > fecha_hoy && elaboracion_notificacion_agradecimiento != '')
    {
        $('#elaboracion_notificacion_agradecimiento_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#elaboracion_notificacion_agradecimiento_negativa_error').fadeIn();
    }
    else if(vencimiento_tramite_fecha < elaboracion_notificacion_agradecimiento_fecha)
    {
        $('#vencimiento_tramite_negativa_error').html('La fecha no puede ser menor a la elaboración de la notificación.');
        $('#vencimiento_tramite_negativa_error').fadeIn();
    }

    else
    {
        BorrarErroresElaboracionNotificacionNegativa();
        route = '/admin/bitacora/negativas/elaboracion-notificacion/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, elaboracion_notificacion_agradecimiento_fecha,
            elaboracion_notificacion_agradecimiento
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresElaboracionNotificacionNegativa();
                $("#modal-elaboracion-notificacion-negativa").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.alta_estatus_fecha)
                {
                    $("#alta_estatus_negativa_error").html(data.responseJSON.errors.alta_estatus_fecha);
                    $("#alta_estatus_negativa_error").fadeIn();
                }
                else
                {
                    $("#alta_estatus_negativa_error").fadeOut();
                }

                if (data.responseJSON.errors.escaneo_fecha)
                {
                    $("#escaneo_negativa_error").html(data.responseJSON.errors.escaneo_fecha);
                    $("#escaneo_negativa_error").fadeIn();
                }
                else
                {
                    $("#escaneo_negativa_error").fadeOut();
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


});


function BorrarErroresElaboracionNotificacionNegativa()
{
    $('#elaboracion_notificacion_agradecimiento_negativa_error').fadeOut();
    $('#vencimiento_tramite_negativa_error').fadeOut();
}

//Revision
var RevisionNegativa = function(id)
{
    BorrarErroresRevisionNegativa();

    $('#fecha_revision_negativa').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-revision-negativa').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_revision_negativa').val(data.id);
        $('#id_control_revision_negativa').val(data.id_control);
        $('#id_cliente_revision_negativa').val(data.id_cliente);

        //Fechas
        if(data.revision_fecha == null)
        {
            $('#revision_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#revision_fecha_negativa').val(data.revision_fecha);
        }

        //Estatus
        if(data.revision == null)
        {
            $('#revision_negativa').val('').change();
        } 
        else
        {
            $('#revision_negativa').val(data.revision).change();
        }
        
    });

    
}

$("#btn-revision-negativa").click(function()
{
    BorrarErroresRevisionNegativa();

    id_servicio = $('#id_servicio_revision_negativa').val();
    id_control = $('#id_control_revision_negativa').val();
    id_admin = $('#id_admin_revision_negativa').val();
    fecha_hoy = $('#fecha_revision_negativa').val();
    //Fechas
    revision_fecha = $('#revision_fecha_negativa').val();

    //Estatus
    revision = $('#revision_negativa').val();

    if(revision_fecha > fecha_hoy && revision != '')
    {
        $('#revision_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#revision_negativa_error').fadeIn();
    }

    else
    {
        BorrarErroresRevisionNegativa();
        route = '/admin/bitacora/negativas/revision/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, revision_fecha, revision
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRevisionNegativa();
                $("#modal-revision-negativa").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.revision_fecha)
                {
                    $("#revision_negativa_error").html(data.responseJSON.errors.revision_fecha);
                    $("#revision_negativa_error").fadeIn();
                }
                else
                {
                    $("#revision_negativa_error").fadeOut();
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


});


function BorrarErroresRevisionNegativa()
{
    $('#revision_negativa_error').fadeOut();
}


//Envio de Notificación al cliente
var EnvioNotificacionNegativa = function(id)
{
    BorrarErroresEnvioNotificacionNegativa();

    $('#fecha_envio_notificacion_negativa').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-envio-notificacion-negativa').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_envio_notificacion_negativa').val(data.id);
        $('#id_control_envio_notificacion_negativa').val(data.id_control);
        $('#id_cliente_envio_notificacion_negativa').val(data.id_cliente);

        //Fechas
        if(data.envio_notificacion_fecha == null)
        {
            $('#envio_notificacion_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#envio_notificacion_fecha_negativa').val(data.envio_notificacion_fecha);
        }

        if(data.respuesta_cliente_fecha == null)
        {
            $('#respuesta_cliente_fecha_negativa').datepicker().datepicker('setDate', 'today');
            $('#respuesta_cliente_fecha_negativa_val').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#respuesta_cliente_fecha_negativa').val(data.respuesta_cliente_fecha);
            $('#respuesta_cliente_fecha_negativa_val').val(data.respuesta_cliente_fecha);
        }

        //Estatus
        if(data.envio_notificacion == null)
        {
            $('#envio_notificacion_negativa').val('').change();
        } 
        else
        {
            $('#envio_notificacion_negativa').val(data.envio_notificacion).change();
        }

        if(data.respuesta_cliente == null)
        {
            $('#respuesta_cliente_negativa').val('').change();
        } 
        else
        {
            $('#respuesta_cliente_negativa').val(data.respuesta_cliente).change();
            $('#respuesta_cliente_negativa_val').val(data.respuesta_cliente);
        }

        $('#respuesta_cliente_comentarios_negativa').html(data.respuesta_cliente_comentarios);
        $('#respuesta_cliente_comentarios_negativa_value').val(data.respuesta_cliente_comentarios);
        
    });

    
}

$("#btn-envio-notificacion-negativa").click(function()
{
    BorrarErroresEnvioNotificacionNegativa();

    id_servicio = $('#id_servicio_envio_notificacion_negativa').val();
    id_control = $('#id_control_envio_notificacion_negativa').val();
    id_admin = $('#id_admin_envio_notificacion_negativa').val();
    fecha_hoy = $('#fecha_envio_notificacion_negativa').val();
    //Fechas
    envio_notificacion_fecha = $('#envio_notificacion_fecha_negativa').val();
    respuesta_cliente_fecha = $('#respuesta_cliente_fecha_negativa').val();
    respuesta_cliente_fecha_value = $('#respuesta_cliente_fecha_negativa_val').val();

    //Estatus
    envio_notificacion = $('#envio_notificacion_negativa').val();
    respuesta_cliente = $('#respuesta_cliente_negativa').val();
    respuesta_cliente_value = $('#respuesta_cliente_negativa_val').val();
    respuesta_cliente_comentarios = $('#respuesta_cliente_comentarios_negativa').val();
    respuesta_cliente_comentarios_value = $('#respuesta_cliente_comentarios_negativa_value').val();

    if(envio_notificacion_fecha > fecha_hoy && envio_notificacion != '')
    {
        $('#envio_notificacion_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#envio_notificacion_negativa_error').fadeIn();
    }

    else if(respuesta_cliente_fecha > fecha_hoy && respuesta_cliente != '')
    {
        $('#respuesta_cliente_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#respuesta_cliente_negativa_error').fadeIn();
    }

    else
    {
        BorrarErroresEnvioNotificacionNegativa();
        route = '/admin/bitacora/negativas/envio-notificacion/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, envio_notificacion_fecha, respuesta_cliente_fecha, envio_notificacion,
            respuesta_cliente, respuesta_cliente_comentarios, respuesta_cliente_fecha_value, respuesta_cliente_value,
            respuesta_cliente_comentarios_value
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresEnvioNotificacionNegativa();
                $("#modal-envio-notificacion-negativa").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.envio_notificacion_fecha)
                {
                    $("#envio_notificacion_negativa_error").html(data.responseJSON.errors.envio_notificacion_fecha);
                    $("#envio_notificacion_negativa_error").fadeIn();
                }
                else
                {
                    $("#envio_notificacion_negativa_error").fadeOut();
                }

                if (data.responseJSON.errors.respuesta_cliente_fecha)
                {
                    $("#respuesta_cliente_negativa_error").html(data.responseJSON.errors.respuesta_cliente_fecha);
                    $("#respuesta_cliente_negativa_error").fadeIn();
                }
                else
                {
                    $("#respuesta_cliente_negativa_error").fadeOut();
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


});


function BorrarErroresEnvioNotificacionNegativa()
{
    $('#envio_notificacion_negativa_error').fadeOut();
    $('#respuesta_cliente_negativa_error').fadeOut();
}



//Terminar Negativa
var TerminarNegativa = function(id)
{
    BorrarErroresRegistroNegativa();

    $('#fecha_terminar_negativa').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-terminar-negativa').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_terminar_negativa').val(data.id);
        $('#id_control_terminar_negativa').val(data.id_control);
        $('#id_cliente_terminar_negativa').val(data.id_cliente);

        //Fechas
        if(data.registro_fecha == null)
        {
            $('#registro_fecha_negativa').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#registro_fecha_negativa').val(data.registro_fecha);
            $('#registro_fecha_negativa_value').val(data.registro_fecha);
        }

        //Estatus
        if(data.registro == null)
        {
            $('#registro_negativa').val('').change();;
            $('#registro_negativa_value').val('');
        } 
        else
        {
            $('#registro_negativa').val(data.registro).change();
            $('#registro_negativa_value').val(data.registro);
        }

        if(data.estatus_tramite == null)
        {
            $('#estatus_tramite_negativa').val('').change();
        }
        else
        {
            $('#estatus_tramite_negativa').val(data.estatus_tramite).change();
        }
        
        if(data.id_bitacoras_estatus == null)
        {
            $('#id_bitacoras_estatus_negativa').val('').change();
            $('#id_bitacoras_estatus_negativa_value').val('');
        } 
        else
        {
            $('#id_bitacoras_estatus_negativa').val(data.id_bitacoras_estatus).change();
            $('#id_bitacoras_estatus_negativa_value').val(data.id_bitacoras_estatus);
        }
        
    });

    
}

$("#btn-terminar-negativa").click(function()
{
    BorrarErroresRegistroNegativa();

    id_servicio = $('#id_servicio_terminar_negativa').val();
    id_control = $('#id_control_terminar_negativa').val();
    id_admin = $('#id_admin_terminar_negativa').val();
    fecha_hoy = $('#fecha_terminar_negativa').val();
    //Fechas
    registro_fecha = $('#registro_fecha_negativa').val();
    registro_fecha_val = $('#registro_fecha_negativa_value').val();

    //Estatus
    registro = $('#registro_negativa').val();
    registro_val = $('#registro_negativa_value').val();
    estatus_tramite = $('#estatus_tramite_negativa').val();
    id_bitacoras_estatus = $('#id_bitacoras_estatus_negativa').val();
    id_bitacoras_estatus_val = $('#id_bitacoras_estatus_negativa_value').val();

    if(registro_fecha > fecha_hoy && registro != '')
    {
        $('#registro_fecha_negativa_error').html('La fecha no puede ser mayor al día actual.');
        $('#registro_fecha_negativa_error').fadeIn();
    }

    else
    {
        BorrarErroresRegistroNegativa();
        route = '/admin/bitacora/negativas/registro/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, registro_fecha, registro_fecha_val, registro, registro_val, 
            estatus_tramite, id_bitacoras_estatus, id_bitacoras_estatus_val
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRegistroNegativa();
                $("#modal-terminar-negativa").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.registro_fecha)
                {
                    $("#registro_fecha_negativa_error").html(data.responseJSON.errors.registro_fecha);
                    $("#registro_fecha_negativa_error").fadeIn();
                }
                else
                {
                    $("#registro_fecha_negativa_error").fadeOut();
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


});


function BorrarErroresRegistroNegativa()
{
    $('#registro_fecha_negativa_error').fadeOut();
    $('#registro_fecha_negativa_error').fadeOut();
}



//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------



//Requisitos y Objeciones
var Requisitos = function(id)
{
    BorrarErroresRequisitos();

    $('#fecha_recepcion_requisitos').datepicker().datepicker('setDate', 'today');
    $('#fecha_elaboracion_notificacion_requisitos').datepicker().datepicker('setDate', 'today');
    $('#fecha_revision_requisitos').datepicker().datepicker('setDate', 'today');
    $('#fecha_terminar_requisitos').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-recepcion-alta-requisitos').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#modal-title-notificacion-requisitos').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#modal-title-revision-requisitos').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#modal-title-terminar-requisitos').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_recepcion_requisitos').val(data.id);
        $('#id_servicio_elaboracion_notificacion_requisitos').val(data.id);
        $('#id_servicio_revision_requisitos').val(data.id);
        $('#id_servicio_terminar_requisitos').val(data.id);

        $('#id_control_recepcion_requisitos').val(data.id_control);
        $('#id_control_elaboracion_notificacion_requisitos').val(data.id_control);
        $('#id_control_revision_requisitos').val(data.id_control);
        $('#id_control_terminar_requisitos').val(data.id_control);

        $('#id_cliente_recepcion_requisitos').val(data.id_cliente);
        $('#id_cliente_elaboracion_notificacion_requisitos').val(data.id_cliente);
        $('#id_cliente_revision_requisitos').val(data.id_cliente);
        $('#id_cliente_terminar_requisitos').val(data.id_cliente);

        //Fechas
        if(data.recepcion_alta_fecha == null)
        {
            $('#recepcion_alta_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#recepcion_alta_fecha_requisitos').val(data.recepcion_alta_fecha);
        }

        if(data.escaneo_fecha == null)
        {
            $('#escaneo_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#escaneo_fecha_requisitos').val(data.escaneo_fecha);
        }

        if(data.vencimiento_tramite_fecha == null)
        {
            $('#vencimiento_tramite_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#vencimiento_tramite_fecha_requisitos').val(data.vencimiento_tramite_fecha);
        }

        if(data.elaboracion_notificacion_agradecimiento_fecha == null)
        {
            $('#elaboracion_notificacion_agradecimiento_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#elaboracion_notificacion_agradecimiento_fecha_requisitos').val(data.elaboracion_notificacion_agradecimiento_fecha);
        }

        if(data.envio_notificacion_fecha == null)
        {
            $('#envio_notificacion_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#envio_notificacion_fecha_requisitos').val(data.envio_notificacion_fecha);
        }

        if(data.pago_fecha == null)
        {
            //$('#pago_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#pago_fecha_requisitos').val(data.pago_fecha);
        }

        if(data.revision_fecha == null)
        {
            $('#revision_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#revision_fecha_requisitos').val(data.revision_fecha);
        }

        if(data.presentacion_fecha == null)
        {
            $('#presentacion_fecha_requisitos').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#presentacion_fecha_requisitos').val(data.presentacion_fecha);
        }

        if(data.alta_estatus_fecha == null)
        {
            $('#alta_estatus_fecha_requisitos').datepicker().datepicker('setDate', 'today');
            $('#alta_estatus_fecha_requisitos_val').val();
        } 
        else
        {
            $('#alta_estatus_fecha_requisitos').val(data.alta_estatus_fecha);
            $('#alta_estatus_fecha_requisitos_val').val(data.alta_estatus_fecha);
        }

        if(data.alta_control_archivar_fecha == null)
        {
            $('#alta_control_archivar_fecha_requisitos').datepicker().datepicker('setDate', 'today');
            $('#alta_control_archivar_fecha_requisitos_val').val();
        } 
        else
        {
            $('#alta_control_archivar_fecha_requisitos').val(data.alta_control_archivar_fecha);
            $('#alta_control_archivar_fecha_requisitos_val').val(data.alta_control_archivar_fecha);
        }

        //Estatus
        if(data.recepcion_alta == null)
        {
            $('#recepcion_alta_requisitos').val('').change();
        } 
        else
        {
            $('#recepcion_alta_requisitos').val(data.recepcion_alta).change();
        }

        if(data.escaneo == null)
        {
            $('#escaneo_requisitos').val('').change();
        } 
        else
        {
            $('#escaneo_requisitos').val(data.escaneo).change();
        }


        if(data.elaboracion_notificacion_agradecimiento == null)
        {
            $('#elaboracion_notificacion_agradecimiento_requisitos').val('').change();
        } 
        else
        {
            $('#elaboracion_notificacion_agradecimiento_requisitos').val(data.elaboracion_notificacion_agradecimiento).change();
        }

        if(data.envio_notificacion == null)
        {
            $('#envio_notificacion_requisitos').val('').change();
        } 
        else
        {
            $('#envio_notificacion_requisitos').val(data.envio_notificacion).change();
        }

        if(data.pago == null)
        {
            $('#pago_requisitos').val('').change();
        } 
        else
        {
            $('#pago_requisitos').val(data.pago).change();
        }

        if(data.revision == null)
        {
            $('#revision_requisitos').val('').change();
        } 
        else
        {
            $('#revision_requisitos').val(data.revision).change();
        }

        if(data.presentacion == null)
        {
            $('#presentacion_requisitos').val('').change();
        } 
        else
        {
            $('#presentacion_requisitos').val(data.presentacion).change();
        }

        if(data.alta_estatus == null)
        {
            $('#alta_estatus_requisitos').val('').change();
            $('#alta_estatus_requisitos_val').val('');
        } 
        else
        {
            $('#alta_estatus_requisitos').val(data.alta_estatus).change();
            $('#alta_estatus_requisitos_val').val();
        }

        if(data.id_bitacoras_estatus == null)
        {
            $('#id_bitacoras_estatus_requisitos').val('').change();
            $('#id_bitacoras_estatus_requisitos_value').val('');
        } 
        else
        {
            $('#id_bitacoras_estatus_requisitos').val(data.id_bitacoras_estatus).change();
            $('#id_bitacoras_estatus_requisitos_value').val(data.id_bitacoras_estatus);
        }

        if(data.alta_control_archivar == null)
        {
            $('#alta_control_archivar_requisitos').val('').change();
        } 
        else
        {
            $('#alta_control_archivar_requisitos').val(data.alta_control_archivar).change();
        }

        if(data.estatus_tramite == null)
        {
            $('#estatus_tramite_requisitos').val('').change();
            $('#estatus_tramite_requisitos_val').val('');
        } 
        else
        {
            $('#estatus_tramite_requisitos').val(data.estatus_tramite).change();
            $('#estatus_tramite_requisitos_val').val(data.estatus_tramite);
        }
        
    });

    
}

$("#btn-recepcion-requisitos").click(function()
{
    BorrarErroresRequisitos();

    id_servicio = $('#id_servicio_recepcion_requisitos').val();
    id_control = $('#id_control_recepcion_requisitos').val();
    id_admin = $('#id_admin_recepcion_requisitos').val();
    fecha_hoy = $('#fecha_recepcion_requisitos').val();
    //Fechas
    recepcion_alta_fecha = $('#recepcion_alta_fecha_requisitos').val();
    escaneo_fecha = $('#escaneo_fecha_requisitos').val();
    vencimiento_tramite_fecha = $('#vencimiento_tramite_fecha_requisitos').val();

    //Estatus
    recepcion_alta = $('#recepcion_alta_requisitos').val();
    escaneo = $('#escaneo_requisitos').val();

    if(recepcion_alta_fecha > fecha_hoy && recepcion_alta != '')
    {
        $('#recepcion_alta_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#recepcion_alta_requisitos_error').fadeIn();
    }
    else if(escaneo_fecha > fecha_hoy && escaneo != '')
    {
        $('#escaneo_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#escaneo_requisitos_error').fadeIn();
    }

    else
    {
        BorrarErroresRequisitos();
        route = '/admin/bitacora/requisitos/modal/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, recepcion_alta_fecha, escaneo_fecha, recepcion_alta, escaneo,
            vencimiento_tramite_fecha
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRequisitos();
                $("#modal-recepcion-alta-requisitos").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.recepcion_alta)
                {
                    $("#recepcion_alta_requisitos_error").html(data.responseJSON.errors.recepcion_alta);
                    $("#recepcion_alta_requisitos_error").fadeIn();
                }
                else
                {
                    $("#recepcion_alta_requisitos_error").fadeOut();
                }

                if (data.responseJSON.errors.escaneo_fecha)
                {
                    $("#escaneo_requisitos_error").html(data.responseJSON.errors.escaneo_fecha);
                    $("#escaneo_requisitos_error").fadeIn();
                }
                else
                {
                    $("#escaneo_requisitos_error").fadeOut();
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


});

$("#btn-elaboracion-notificacion-requisitos").click(function()
{
    BorrarErroresRequisitos();

    id_servicio = $('#id_servicio_elaboracion_notificacion_requisitos').val();
    id_control = $('#id_control_elaboracion_notificacion_requisitos').val();
    id_admin = $('#id_admin_elaboracion_notificacion_requisitos').val();
    id_cliente = $('#id_cliente_elaboracion_notificacion_requisitos').val();
    fecha_hoy = $('#fecha_elaboracion_notificacion_requisitos').val();
    //Fechas
    elaboracion_notificacion_agradecimiento_fecha = $('#elaboracion_notificacion_agradecimiento_fecha_requisitos').val();
    envio_notificacion_fecha = $('#envio_notificacion_fecha_requisitos').val();

    //Estatus
    elaboracion_notificacion_agradecimiento = $('#elaboracion_notificacion_agradecimiento_requisitos').val();
    envio_notificacion = $('#envio_notificacion_requisitos').val();

    if(elaboracion_notificacion_agradecimiento_fecha > fecha_hoy && elaboracion_notificacion_agradecimiento != '')
    {
        $('#elaboracion_notificacion_agradecimiento_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#elaboracion_notificacion_agradecimiento_requisitos_error').fadeIn();
    }
    else if(envio_notificacion_fecha > fecha_hoy && envio_notificacion != '')
    {
        $('#envio_notificacion_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#envio_notificacion_requisitos_error').fadeIn();
    }

    else
    {
        BorrarErroresRequisitos();
        route = '/admin/bitacora/requisitos/notificacion/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, id_cliente, elaboracion_notificacion_agradecimiento_fecha,
            envio_notificacion_fecha, elaboracion_notificacion_agradecimiento, envio_notificacion
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRequisitos();
                $("#modal-elaboracion-notificacion-requisitos").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.elaboracion_notificacion_agradecimiento_fecha)
                {
                    $("#elaboracion_notificacion_agradecimiento_requisitos_error").html(data.responseJSON.errors.recepcion_alta);
                    $("#elaboracion_notificacion_agradecimiento_requisitos_error").fadeIn();
                }
                else
                {
                    $("#elaboracion_notificacion_agradecimiento_requisitos_error").fadeOut();
                }

                if (data.responseJSON.errors.envio_notificacion_fecha)
                {
                    $("#envio_notificacion_requisitos_error").html(data.responseJSON.errors.escaneo_fecha);
                    $("#envio_notificacion_requisitos_error").fadeIn();
                }
                else
                {
                    $("#envio_notificacion_requisitos_error").fadeOut();
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


});

$("#btn-revision-requisitos").click(function()
{
    BorrarErroresRequisitos();

    id_servicio = $('#id_servicio_revision_requisitos').val();
    id_control = $('#id_control_revision_requisitos').val();
    id_admin = $('#id_admin_revision_requisitos').val();
    id_cliente = $('#id_cliente_revision_requisitos').val();
    fecha_hoy = $('#fecha_revision_requisitos').val();

    //Fechas
    revision_fecha = $('#revision_fecha_requisitos').val();
    presentacion_fecha = $('#presentacion_fecha_requisitos').val();
    alta_estatus_fecha = $('#alta_estatus_fecha_requisitos').val();
    alta_estatus_fecha_val = $('#alta_estatus_fecha_requisitos_val').val();

    //Estatus
    revision = $('#revision_requisitos').val();
    presentacion = $('#presentacion_requisitos').val();
    alta_estatus = $('#alta_estatus_requisitos').val();
    alta_estatus_val = $('#alta_estatus_requisitos_val').val();
    id_bitacoras_estatus = $('#id_bitacoras_estatus_requisitos').val();
    id_bitacoras_estatus_value = $('#id_bitacoras_estatus_value_requisitos').val();

    if(revision_fecha > fecha_hoy && revision != '')
    {
        $('#revision_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#revision_requisitos_error').fadeIn();
    }
    else if(presentacion_fecha > fecha_hoy && presentacion != '')
    {
        $('#presentacion_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#presentacion_requisitos_error').fadeIn();
    }

    else if(alta_estatus_fecha > fecha_hoy && alta_estatus != '')
    {
        $('#alta_estatus_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#alta_estatus_requisitos_error').fadeIn();
    }

    else if((id_bitacoras_estatus == '' && alta_estatus != '') || (id_bitacoras_estatus != '' && alta_estatus == ''))
    {
        $('#id_bitacoras_estatus_requisitos_error').html('Para darlo de alta, debe seleccionar una bitácora de estatus y seleccionar una opción en la Alta de estatus.');
        $('#id_bitacoras_estatus_requisitos_error').fadeIn();
    }

    else
    {
        BorrarErroresRequisitos();
        route = '/admin/bitacora/requisitos/revision/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, id_cliente, revision_fecha, presentacion_fecha, alta_estatus_fecha,
            revision, presentacion, alta_estatus, id_bitacoras_estatus, id_bitacoras_estatus_value, alta_estatus_fecha_val,
            alta_estatus_val
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRequisitos();
                $("#modal-revision-requisitos").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.revision_fecha)
                {
                    $("#revision_requisitos_error").html(data.responseJSON.errors.revision_fecha);
                    $("#revision_requisitos_error").fadeIn();
                }
                else
                {
                    $("#revision_requisitos_error").fadeOut();
                }

                if (data.responseJSON.errors.presentacion_fecha)
                {
                    $("#presentacion_requisitos_error").html(data.responseJSON.errors.presentacion_fecha);
                    $("#presentacion_requisitos_error").fadeIn();
                }
                else
                {
                    $("#presentacion_requisitos_error").fadeOut();
                }

                if (data.responseJSON.errors.alta_estatus_fecha)
                {
                    $("#alta_estatus_requisitos_error").html(data.responseJSON.errors.alta_estatus_fecha);
                    $("#alta_estatus_requisitos_error").fadeIn();
                }
                else
                {
                    $("#alta_estatus_requisitos_error").fadeOut();
                }

                if (data.responseJSON.errors.id_bitacoras_estatus)
                {
                    $("#id_bitacoras_estatus_requisitos_error").html(data.responseJSON.errors.id_bitacoras_estatus);
                    $("#id_bitacoras_estatus_requisitos_error").fadeIn();
                }
                else
                {
                    $("#id_bitacoras_estatus_requisitos_error").fadeOut();
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


});

$("#btn-terminar-requisitos").click(function()
{
    BorrarErroresRequisitos();

    id_servicio = $('#id_servicio_terminar_requisitos').val();
    id_control = $('#id_control_terminar_requisitos').val();
    id_admin = $('#id_admin_terminar_requisitos').val();
    id_cliente = $('#id_cliente_terminar_requisitos').val();
    fecha_hoy = $('#fecha_terminar_requisitos').val();

    //Fechas
    alta_control_archivar_fecha = $('#alta_control_archivar_fecha_requisitos').val();
    alta_control_archivar_fecha_val = $('#alta_control_archivar_fecha_requisitos_val').val();

    //Estatus
    alta_control_archivar = $('#alta_control_archivar_requisitos').val();
    alta_control_archivar_val = $('#alta_control_archivar_requisitos_val').val();
    estatus_tramite = $('#estatus_tramite_requisitos').val();

    if(alta_control_archivar_fecha > fecha_hoy && alta_control_archivar != '')
    {
        $('#alta_control_archivar_error').html('La fecha no puede ser mayor al día actual.');
        $('#alta_control_archivar_error').fadeIn();
    }

    else if(estatus_tramite != '' && alta_control_archivar == '')
    {
        $('#estatus_tramite_requisitos_error').html('La fecha no puede ser mayor al día actual.');
        $('#estatus_tramite_requisitos_error').fadeIn();
    }

    else
    {
        BorrarErroresRequisitos();
        route = '/admin/bitacora/requisitos/terminar/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, id_cliente, alta_control_archivar_fecha, alta_control_archivar,
            estatus_tramite
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresRequisitos();
                $("#modal-terminar-requisitos").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.alta_control_archivar_fecha)
                {
                    $("#alta_control_archivar_fecha").html(data.responseJSON.errors.alta_control_archivar_fecha);
                    $("#alta_control_archivar_fecha").fadeIn();
                }
                else
                {
                    $("#alta_control_archivar_fecha").fadeOut();
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


});

function BorrarErroresRequisitos()
{
    $('#recepcion_alta_requisitos_error').fadeOut();
    $('#escaneo_requisitos_error').fadeOut();
    $('#elaboracion_notificacion_agradecimiento_requisitos_error').fadeOut();
    $('#envio_notificacion_requisitos_error').fadeOut();
    $('#revision_requisitos_error').fadeOut();
    $('#presentacion_requisitos_error').fadeOut();
    $('#alta_estatus_requisitos_error').fadeOut();
    $('#id_bitacoras_estatus_requisitos_error').fadeOut();
    $('#alta_control_archivar_error').fadeOut();
    $('#estatus_tramite_requisitos_error').fadeOut();
}



//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------



//Títulos y Certificados
var TitulosyCertificados = function(id)
{
    BorrarErroresTitulos();

    $('#fecha_alta_estatus_titulo').datepicker().datepicker('setDate', 'today');
    $('#fecha_entrega_titulo').datepicker().datepicker('setDate', 'today');

    var route = "/admin/bitacoras/getServicio/" + id;
    
    $.get(route, function(data)
    {
        //console.log(data);

        if(data.nombre == null)
        {
            nombre = '';
        }
        else
        {
            nombre = data.nombre;
        }
        if(data.clase == null)
        {
            clase = '';
        }
        else
        {
            clase = data.clase;
        }

        $('#modal-title-alta-estatus-titulo').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#modal-title-entrega-titulo').html(data.clave + ' - ' + nombre + ' ' + clase + ' cliente: ' + data.nombre_comercial);
        $('#id_servicio_alta_estatus_titulo').val(data.id);
        $('#id_servicio_entrega_titulo').val(data.id);

        $('#id_control_alta_estatus_titulo').val(data.id_control);
        $('#id_control_entrega_titulo').val(data.id_control);

        $('#id_cliente_alta_estatus_titulo').val(data.id_cliente);
        $('#id_cliente_entrega_titulo').val(data.id_cliente);

        //Fechas
        if(data.alta_estatus_fecha == null)
        {
            $('#alta_estatus_fecha_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#alta_estatus_fecha_titulo').val(data.alta_estatus_fecha);
        }

        if(data.escaneo_fecha == null)
        {
            $('#escaneo_fecha_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#escaneo_fecha_titulo').val(data.escaneo_fecha);
        }

        if(data.elaboracion_notificacion_agradecimiento_fecha == null)
        {
            $('#elaboracion_notificacion_agradecimiento_fecha_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#elaboracion_notificacion_agradecimiento_fecha_titulo').val(data.elaboracion_notificacion_agradecimiento_fecha);
        }

        if(data.envio_notificacion_fecha == null)
        {
            $('#envio_notificacion_fecha_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#envio_notificacion_fecha_titulo').val(data.envio_notificacion_fecha);
        }

        if(data.pago_fecha == null)
        {
            $('#pago_fecha_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#pago_fecha_titulo').val(data.pago_fecha);
        }

        if(data.entrega_titulo_agradecimiento_fecha == null)
        {
            $('#entrega_titulo_agradecimiento_fecha_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#entrega_titulo_agradecimiento_fecha_titulo').val(data.entrega_titulo_agradecimiento_fecha);
        }

        

        //Estatus
        if(data.alta_estatus == null)
        {
            $('#alta_estatus_titulo').val('').change();
        } 
        else
        {
            $('#alta_estatus_titulo').val(data.alta_estatus).change();
        }

        if(data.escaneo == null)
        {
            $('#escaneo_titulo').val('').change();
        } 
        else
        {
            $('#escaneo_titulo').val(data.escaneo).change();
        }

        if(data.elaboracion_notificacion_agradecimiento == null)
        {
            $('#elaboracion_notificacion_agradecimiento_titulo').val('').change();
        } 
        else
        {
            $('#elaboracion_notificacion_agradecimiento_titulo').val(data.elaboracion_notificacion_agradecimiento).change();
        }

        if(data.envio_notificacion == null)
        {
            $('#envio_notificacion_titulo').val('').change();
        } 
        else
        {
            $('#envio_notificacion_titulo').val(data.envio_notificacion).change();
        }

        if(data.pago == null)
        {
            $('#pago_titulo').datepicker().datepicker('setDate', 'today');
        } 
        else
        {
            $('#pago_titulo').val(data.pago).change();
        }

        if(data.entrega_titulo_agradecimiento == null)
        {
            $('#entrega_titulo_agradecimiento_titulo').val('').change();
        } 
        else
        {
            $('#entrega_titulo_agradecimiento_titulo').val(data.entrega_titulo_agradecimiento).change();
        }

        if(data.estatus_tramite == null)
        {
            $('#estatus_tramite_titulo').val('').change();
        } 
        else
        {
            $('#estatus_tramite_titulo').val(data.estatus_tramite).change();
        }
        
    });
}

$("#btn-alta-estatus-titulo").click(function()
{
    BorrarErroresTitulos();

    id_servicio = $('#id_servicio_alta_estatus_titulo').val();
    id_control = $('#id_control_alta_estatus_titulo').val();
    id_admin = $('#id_admin_alta_estatus_titulo').val();
    id_cliente = $('#id_cliente_alta_estatus_titulo').val();
    fecha_hoy = $('#fecha_alta_estatus_titulo').val();

    //Fechas
    alta_estatus_fecha = $('#alta_estatus_fecha_titulo').val();
    escaneo_fecha = $('#escaneo_fecha_titulo').val();

    //Estatus
    alta_estatus = $('#alta_estatus_titulo').val();
    escaneo = $('#escaneo_titulo').val();

    if(alta_estatus_fecha > fecha_hoy && alta_estatus != '')
    {
        $('#alta_control_archivar_error').html('La fecha no puede ser mayor al día actual.');
        $('#alta_control_archivar_error').fadeIn();
    }

    else if(escaneo_fecha > fecha_hoy && escaneo != '')
    {
        $('#alta_control_archivar_error').html('La fecha no puede ser mayor al día actual.');
        $('#alta_control_archivar_error').fadeIn();
    }

    else
    {
        BorrarErroresTitulos();
        route = '/admin/bitacora/titulos/alta-estatus/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, id_cliente, alta_estatus_fecha, escaneo_fecha,
            alta_estatus, escaneo
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresTitulos();
                $("#modal-alta-estatus-titulo").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.alta_estatus_fecha)
                {
                    $("#alta_estatus_titulo_error").html(data.responseJSON.errors.alta_estatus_fecha);
                    $("#alta_estatus_titulo_error").fadeIn();
                }
                else
                {
                    $("#alta_estatus_titulo_error").fadeOut();
                }

                if (data.responseJSON.errors.escaneo_fecha)
                {
                    $("#escaneo_titulo_error").html(data.responseJSON.errors.escaneo_fecha);
                    $("#escaneo_titulo_error").fadeIn();
                }
                else
                {
                    $("#escaneo_titulo_error").fadeOut();
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


});

$("#btn-entrega-titulo").click(function()
{
    BorrarErroresTitulos();

    id_servicio = $('#id_servicio_entrega_titulo').val();
    id_control = $('#id_control_entrega_titulo').val();
    id_admin = $('#id_admin_entrega_titulo').val();
    id_cliente = $('#id_cliente_entrega_titulo').val();
    fecha_hoy = $('#fecha_entrega_titulo').val();

    //Fechas
    elaboracion_notificacion_agradecimiento_fecha = $('#elaboracion_notificacion_agradecimiento_fecha_titulo').val();
    envio_notificacion_fecha = $('#envio_notificacion_fecha_titulo').val();
    pago_fecha = $('#pago_fecha_titulo').val();
    entrega_titulo_agradecimiento_fecha = $('#entrega_titulo_agradecimiento_fecha_titulo').val();

    //Estatus
    elaboracion_notificacion_agradecimiento = $('#elaboracion_notificacion_agradecimiento_titulo').val();
    envio_notificacion = $('#envio_notificacion_titulo').val();
    pago = $('#pago_titulo').val();
    entrega_titulo_agradecimiento = $('#entrega_titulo_agradecimiento_titulo').val();
    estatus_tramite = $('#estatus_tramite_titulo').val();

    if(elaboracion_notificacion_agradecimiento_fecha > fecha_hoy && elaboracion_notificacion_agradecimiento != '')
    {
        $('#elaboracion_notificacion_agradecimiento_titulo_error').html('La fecha no puede ser mayor al día actual.');
        $('#elaboracion_notificacion_agradecimiento_titulo_error').fadeIn();
    }

    else if(envio_notificacion_fecha > fecha_hoy && envio_notificacion != '')
    {
        $('#envio_notificacion_titulo_error').html('La fecha no puede ser mayor al día actual.');
        $('#envio_notificacion_titulo_error').fadeIn();
    }

    else if(entrega_titulo_agradecimiento_fecha > fecha_hoy && entrega_titulo_agradecimiento != '')
    {
        $('#entrega_titulo_agradecimiento_titulo_error').html('La fecha no puede ser mayor al día actual.');
        $('#entrega_titulo_agradecimiento_titulo_error').fadeIn();
    }

    else if(estatus_tramite != '' && (elaboracion_notificacion_agradecimiento == '' || envio_notificacion == '' ||
        entrega_titulo_agradecimiento == ''))
    {
        $('#estatus_tramite_titulo_error').html('Se debe agregar un estatus a todos los pasos de la bitácora.');
        $('#estatus_tramite_titulo_error').fadeIn();
    }

    else
    {
        BorrarErroresTitulos();
        route = '/admin/bitacora/titulos/entrega/' + id_servicio;
        token = $('#_token').val();

        var formData =
        {
            id_servicio, id_control, id_admin, id_cliente, elaboracion_notificacion_agradecimiento_fecha,
            envio_notificacion_fecha, entrega_titulo_agradecimiento_fecha, elaboracion_notificacion_agradecimiento,
            envio_notificacion, pago, entrega_titulo_agradecimiento, estatus_tramite
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
                toastr.success('Se actualizó el servicio exitosamente.');
                ActualizarBitacoraServicio(id_servicio);
                BorrarErroresTitulos();
                $("#modal-entrega-titulo").modal('toggle');
            },
            error: function(data)
            {
                console.log(data);
                if (data.responseJSON.errors.elaboracion_notificacion_agradecimiento_fecha)
                {
                    $("#elaboracion_notificacion_agradecimiento_titulo_error").html(data.responseJSON.errors.elaboracion_notificacion_agradecimiento_fecha);
                    $("#elaboracion_notificacion_agradecimiento_titulo_error").fadeIn();
                }
                else
                {
                    $("#elaboracion_notificacion_agradecimiento_titulo_error").fadeOut();
                }

                if (data.responseJSON.errors.envio_notificacion_fecha)
                {
                    $("#envio_notificacion_titulo_error").html(data.responseJSON.errors.envio_notificacion_fecha);
                    $("#envio_notificacion_titulo_error").fadeIn();
                }
                else
                {
                    $("#envio_notificacion_titulo_error").fadeOut();
                }

                if (data.responseJSON.errors.entrega_titulo_agradecimiento_fecha)
                {
                    $("#entrega_titulo_agradecimiento_titulo_error").html(data.responseJSON.errors.entrega_titulo_agradecimiento_fecha);
                    $("#entrega_titulo_agradecimiento_titulo_error").fadeIn();
                }
                else
                {
                    $("#entrega_titulo_agradecimiento_titulo_error").fadeOut();
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


});

function BorrarErroresTitulos()
{
    $('#alta_estatus_titulo_error').fadeOut();
    $('#escaneo_titulo_error').fadeOut();
    $('#elaboracion_notificacion_agradecimiento_titulo_error').fadeOut();
    $('#envio_notificacion_titulo_error').fadeOut();
    $('#entrega_titulo_agradecimiento_titulo_error').fadeOut();
}


//Estatus
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
function Estatus(id, id_estatus, id_marca, marca, id_cliente, id_clase)
{
    $('.modal-title').html('Actualizar estatus de: ' + marca);
    $('#id_marca_tramites').val(id_marca);
    $('#id_cliente_tramites').val(id_cliente);
    $('#id_clase_tramites').val(id_clase);
    $('#id_servicio_tramites').val(id);

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
        route = '/admin/bitacora/editar_servicio/' + id,

        $.get(route, function(data)
        {
            $('#fecha_inicio_tramites').val(data.firma_fiel_fecha);

            split_fecha = data.firma_fiel_fecha.split('-');
            fecha_anio = split_fecha[0];
            mes_anio = split_fecha[1];
            dia_anio = split_fecha[2];

            fecha_comprobacion_uso = (fecha_anio * 1) + 3;
            fecha_comprobacion_uso = fecha_comprobacion_uso + '-' + mes_anio + '-' + dia_anio;
            $('#fecha_comprobacion_uso_tramites').val(fecha_comprobacion_uso);

            fecha_vencimiento = (fecha_anio * 1) + 10;
            fecha_vencimiento = fecha_vencimiento + '-' + mes_anio + '-' + dia_anio;
            $('#fecha_vencimiento_tramites').val(fecha_vencimiento);
        });

    }
    else
    {
        route = '/admin/bitacora/editar_estatus/' + id_estatus;
        $.get(route, function(data)
        {
            $('#id_bitacoras_estatus_tramites').val(data.id_bitacoras_estatus).change();
            $('#estatus_tramites').val(data.id_estatus).change();
            $('#id_bitacoras_estatus_tramites_value').val(data.id_bitacoras_estatus);
            $('#id_estatus_tramites').val(data.id);
            $('#fecha_inicio_tramites').val(data.fecha_inicio);
            $('#comprobacion_uso_tramites').val(data.fecha_comprobacion);
            $('#fecha_vencimiento_tramites').val(data.fecha_vencimiento);
            $('#numero_expediente_tramites').val(data.numero_expediente);
            $('#numero_registro_tramites').val(data.numero_registro);
        });
    }
}

$('#btn-actualizar-fechas').click(function()
{
    firma_fiel_fecha = $('#fecha_inicio_tramites').val();

    split_fecha = firma_fiel_fecha.split('-');
    fecha_anio = split_fecha[0];
    mes_anio = split_fecha[1];
    dia_anio = split_fecha[2];

    fecha_comprobacion_uso = (fecha_anio * 1) + 3;
    fecha_comprobacion_uso = fecha_comprobacion_uso + '-' + mes_anio + '-' + dia_anio;
    $('#fecha_comprobacion_uso_tramites').val(fecha_comprobacion_uso);

    fecha_vencimiento = (fecha_anio * 1) + 10;
    fecha_vencimiento = fecha_vencimiento + '-' + mes_anio + '-' + dia_anio;
    $('#fecha_vencimiento_tramites').val(fecha_vencimiento);
});

function EnviarDatosEstatus(id, id_bitacoras_estatus, numero_expediente, numero_registro, 
    id_estatus, fecha_inicio, fecha_comprobacion_uso, fecha_vencimiento)
{
    $('#id_bitacoras_estatus_tramites').val(id_bitacoras_estatus).change();
    $('#estatus_tramites').val(id_estatus).change();
    $('#id_bitacoras_estatus_tramites_value').val(id_bitacoras_estatus);
    $('#id_estatus_tramites').val(id);
    $('#fecha_inicio_tramites').val(fecha_inicio);
    $('#comprobacion_uso_tramites').val(fecha_comprobacion_uso);
    $('#fecha_vencimiento_tramites').val(fecha_vencimiento);
    $('#numero_expediente_tramites').val(numero_expediente);
    $('#numero_registro_tramites').val(numero_registro);

    /*formData=
    {
        id, id_bitacoras_estatus, numero_expediente, numero_registro, 
            id_estatus, fecha_inicio, fecha_comprobacion_uso, fecha_vencimiento
    }

    //console.log(formData);*/
}

$('#btn-guardar-estatus-tramites').click(function()
{
    QuitarErroresEstatus();
    $('#btn-guardar-estatus-tramites').attr('disabled', 'disabled');

    id = $('#id_estatus_tramites').val();
    id_marca = $('#id_marca_tramites').val();
    id_cliente = $('#id_cliente_tramites').val();
    id_clase = $('#id_clase_tramites').val();
    id_admin = $('#id_admin_tramites').val();
    id_servicio = $('#id_servicio_tramites').val();

    id_bitacoras_estatus = $('#id_bitacoras_estatus_tramites').val();
    fecha_inicio = $('#fecha_inicio_tramites').val();
    fecha_comprobacion_uso = $('#fecha_comprobacion_uso_tramites').val();
    fecha_vencimiento = $('#fecha_vencimiento_tramites').val();
    numero_expediente = $('#numero_expediente_tramites').val();
    numero_registro = $('#numero_registro_tramites').val();
    id_estatus = $('#estatus_tramites').val();
    token = $('#_token').val();

    var formData =
    {
        id_marca, id_cliente, id_clase, id_admin, id_servicio, id_bitacoras_estatus, fecha_inicio,
        fecha_comprobacion_uso, fecha_vencimiento, numero_expediente, numero_registro, id_estatus 
    } 

    if(id == '')
    {
        
        console.log(formData);
        route = '/admin/bitacora/tramites-nuevos/crear_estatus';
        
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
        console.log(formData);
        route = '/admin/bitacora/tramites-nuevos/editar_estatus/' + id;
        
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
    $('#estatus_tramites').val('').change();
    $('#id_bitacoras_estatus_tramites_value').val('');
    $('#fecha_inicio_tramites').val('');
    $('#fecha_comprobacion_uso_tramites').val('');
    $('#fecha_vencimiento_tramites').val('');
    $('#numero_expediente_tramites').val('');
    $('#numero_registro_tramites').val('');
    $('#id_estatus_tramites').val('');
    QuitarErroresEstatus();
}































