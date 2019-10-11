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
    buscar = $('#buscar').val();

    if(buscar == '')
    {
        $.ajax(
        {
            type: 'get',
            url: '/admin/clientes-listar',
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
            url: '/admin/clientes-buscar/' + buscar,
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

function insertarNuevo(id)
{
    url_nuevo = '/admin/clientes-actualizar/';
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
    url_nuevo = '/admin/clientes-actualizar/';
    //console.log(url_actuailzar);
    $.ajax(
    {
        type: 'get',
        url: url_nuevo + id,
        success: function(data)
        {
            $('#cliente-' + id).replaceWith(data);
            $(".tooltip").tooltip("hide");
            $(function()
            {
                $('#example1').stickyTableHeaders();
            });
        }
    });  
}

function Create()
{
    BorrarDatos();
    QuitarErrores();
    $(".modal-title").html("Agregar cliente");
    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-save-cliente").removeClass();
    $("#btn-save-cliente").toggleClass("btn btn-primary btn-flat");
}

function Edit(id)
{
    QuitarErrores();

    var route = "/admin/clientes/edit/" + id;
    $.get(route, function(data)
    {
        $(".modal-title").html("Editar cliente: #" + id);
        $('.modal-header').css(
        {
            'background-color': '#EE8F14'
        });
        $("#btn-update-cliente").removeClass();
        $("#btn-update-cliente").toggleClass("btn btn-warning btn-flat");

        $('#id_estrategia_edit').val(data.id_estrategia).change();
        $('#nombre_comercial_edit').val(data.nombre_comercial);
        $('#pagina_web_edit').val(data.pagina_web);
        $('#carpeta_edit').val(data.carpeta);
        $('#comentarios_edit').val(data.comentarios);
        $('#estatus_edit').val(data.estatus).change();
        $('#id_cliente_edit').val(data.id);
    });

    getLogo(id);
}

function getLogo(id)
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/clientes/getLogo/' + id,
        success: function(data)
        {
            $('#logo_get').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });
}

$('#form').on('submit', function(e)
{
    e.preventDefault();
    $('#btn-save-cliente').attr('disabled', 'disabled');

    $.ajax(
    {
        url: '/admin/clientes/store',
        type: 'POST',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {   
            QuitarErrores();
            toastr.success('Se agregó el cliente exitosamente');
            insertarNuevo(data.id);
            $('#modal-cliente').modal('toggle');
            $('#btn-save-cliente').removeAttr('disabled');
            //console.log(data);
        },
        error: function(data)
        {
            console.log(data);
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

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
                $("#id_estrategia_cliente_error").html(data.responseJSON.errors.id_estrategia);
                $("#id_estrategia_cliente_error").fadeIn();
            }
            else
            {
                $("#id_estrategia_cliente_error").fadeOut();
            }

            if (data.responseJSON.errors.logo)
            {
                $("#logo_error").html(data.responseJSON.errors.logo);
                $("#logo_error").fadeIn();
            }
            else
            {
                $("#logo_error").fadeOut();
            }

            if (data.responseJSON.errors.carpeta)
            {
                $("#carpeta_error").html(data.responseJSON.errors.carpeta);
                $("#carpeta_error").fadeIn();
            }
            else
            {
                $("#carpeta_error").fadeOut();
            }

            if (data.responseJSON.errors.pagina_web)
            {
                $("#pagina_web_error").html(data.responseJSON.errors.pagina_web);
                $("#pagina_web_error").fadeIn();
            }
            else
            {
                $("#pagina_web_error").fadeOut();
            }

            $('#btn-save-cliente').removeAttr('disabled');
        }
    });
});

$('#btn-update-cliente').click(function()
{
    $('#btn-update-cliente').attr('disabled', 'disabled');
    id = $('#id_cliente_edit').val();

    var token = $("#_token").val();

    var formData = {
        nombre_comercial: $('#nombre_comercial_edit').val(),
        id_estrategia: $('#id_estrategia_edit').val(),
        pagina_web: $('#pagina_web_edit').val(),
        carpeta: $('#carpeta_edit').val(),
        estatus: $('#estatus_edit').val(),
        comentarios: $('#comentarios_edit').val()
    }
    console.log(formData);
    $.ajax(
    {
        url: '/admin/clientes/update/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            Actualizar(data.id);
            BorrarDatos();
            QuitarErrores();
            $('#btn-update-cliente').removeAttr('disabled');
            toastr.success('Se editó el registro satisfactoriamente');
            $('#modal-cliente-edit').modal('toggle');
        },
        error: function(data)
        {
            $('#btn-update-cliente').removeAttr('disabled');
            console.log(data);

            if (data.responseJSON.errors.nombre_comercial)
            {
                $("#nombre_comercial_edit_error").html(data.responseJSON.errors.nombre_comercial);
                $("#nombre_comercial_edit_error").fadeIn();
            }
            else
            {
                $("#nombre_comercial_edit_error").fadeOut();
            }

            if (data.responseJSON.errors.id_estrategia)
            {
                $("#id_estrategia_edit_cliente_error").html(data.responseJSON.errors.id_estrategia);
                $("#id_estrategia_edit_cliente_error").fadeIn();
            }
            else
            {
                $("#id_estrategia_edit_cliente_error").fadeOut();
            }

            if (data.responseJSON.errors.carpeta)
            {
                $("#carpeta_edit_error").html(data.responseJSON.errors.carpeta);
                $("#carpeta_edit_error").fadeIn();
            }
            else
            {
                $("#carpeta_edit_error").fadeOut();
            }

            if (data.responseJSON.errors.pagina_web)
            {
                $("#pagina_web_edit_error").html(data.responseJSON.errors.pagina_web);
                $("#pagina_web_edit_error").fadeIn();
            }
            else
            {
                $("#pagina_web_edit_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            console.clear();
        }
    });
});

jQuery("#logo").on("change", function() 
{
    formdata = new FormData();
    var id = $('#id_cliente_edit').val();
    var route = '/admin/clientes/cargarLogo/' + id;
    var file = this.files[0];
    if (formdata) 
    {
        formdata.append("logo", file);
        //console.log(formdata);
        jQuery.ajax(
        {
            url: route,
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success:function(data)
            {
                toastr.success('Se actualizó el logo.');
                $('#logo').val('');
                //console.log(data);
                getLogo(id);
                QuitarErrores();
            },
            error:function(data)
            {
                toastr.error('Hay errores en el formulario');
                console.log(data);

                if (data.responseJSON.errors.logo)
                {
                    $("#logo_edit_error").html(data.responseJSON.errors.logo);
                    $("#logo_edit_error").fadeIn();
                }
                else
                {
                    $("#logo_edit_error").fadeOut();
                }
            }
        });
    }                       
});

function Carpeta(id, nombre_comercial)
{
    $('#id_cliente_carpeta').val(id);
    $('#carpeta_agregar').val('');
    $('.modal-title').html('Agregar carpeta a: ' + nombre_comercial);

    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });
}

$('#btn-carpeta-save').click(function()
{
    id = $('#id_cliente_carpeta').val();
    $('#btn-carpeta-save').attr('disabled', 'disabled');
    var token = $("#_token").val();

    var formData = {
        carpeta: $('#carpeta_agregar').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/clientes/carpeta/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            Actualizar(data.id);
            BorrarDatos();
            QuitarErrores();
            $('#btn-carpeta-save').removeAttr('disabled');
            $('#modal-carpeta').modal('toggle');
            toastr.success('Se agregó la carpeta');
        },
        error: function(data)
        {
            $('#btn-carpeta-save').removeAttr('disabled');
            console.log(data);

            if (data.responseJSON.errors.carpeta)
            {
                $("#carpeta_agregar_error").html(data.responseJSON.errors.carpeta);
                $("#carpeta_agregar_error").fadeIn();
            }
            else
            {
                $("#carpeta_agregar_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            console.clear();
        }
    });
});

function Store()
{
    $('#btn-save-cliente').attr('disabled', 'disabled');
    var token = $("#_token").val();

    var formData = {
        estrategia: $('#estrategia').val(),
        estatus: $('#estatus').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/estrategias/store',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            Listar();
            BorrarDatos();
            $('#modal-estrategia').modal('toggle');
            $('#btn-save').removeAttr('disabled');
            toastr.success('Se creó el registro satisfactoriamente');
        },
        error: function(data)
        {
            $('#btn-save').removeAttr('disabled');
            console.log(data);

            if (data.responseJSON.errors.estrategia)
            {
                $("#estrategia_error").html(data.responseJSON.errors.estrategia);
                $("#estrategia_error").fadeIn();
            }
            else
            {
                $("#estrategia_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            console.clear();
        }
    });
}

function Update(id)
{
    $('#btn-save').attr('disabled', 'disabled');
    var token = $("#_token").val();

    var formData = {
        estrategia: $('#estrategia').val(),
        estatus: $('#estatus').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/estrategias/update/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            Listar();
            BorrarDatos();
            $('#modal-estrategia').modal('toggle');
            $('#btn-save').removeAttr('disabled');
            toastr.success('Se editó el registro satisfactoriamente');
        },
        error: function(data)
        {
            $('#btn-save').removeAttr('disabled');
            console.log(data);

            if (data.responseJSON.errors.estrategia)
            {
                $("#estrategia_error").html(data.responseJSON.errors.estrategia);
                $("#estrategia_error").fadeIn();
            }
            else
            {
                $("#estrategia_error").fadeOut();
            }
            
            toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
            
            console.clear();
        }
    });
}

function Inactivar(id)
{
    $.confirm(
    {
        title: '¿Desea inactivar al cliente?',
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
                text: 'Inactivar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/clientes/status/' + id;
                    token = $('#_token');

                    formData =
                    {
                        estatus:0
                    }

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        data: formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            Actualizar(id);
                            toastr.info('Se inactivó al cliente satisfactoriamente');
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
        title: '¿Desea activar al cliente?',
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
                    router = '/admin/clientes/status/' + id;
                    token = $('#_token');

                    formData =
                    {
                        estatus:1
                    }

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        data: formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            Actualizar(id);
                            toastr.info('Se activó al cliente satisfactoriamente');
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

function BorrarDatos()
{
    $('select[name=id_estrategia]').val('').change();
    $('input[name=nombre_comercial]').val('');
    $('input[name=pagina_web]').val('');
    $('input[name=logo]').val('');
    $('input[name=carpeta]').val('');
    $('textarea[name=comentarios]').val('');
    $('select[name=estatus]').val('1').change();

    $('#id_cliente_edit').val('');
    $('#nombre_comercial_edit').val('');
    $('#id_estrategia_edit').val('').change();
    $('#pagina_web_edit').val('');
    $('#carpeta_edit').val('');
    $('#estatus_edit').val('1').change();
    $('#comentarios_edit').val('');
    $('#logo_edit').val('');


}

function QuitarErrores()
{
    $('#nombre_comercial_error').fadeOut();
    $('#nombre_comercial_edit_error').fadeOut();
    $('#id_estrategia_cliente_error').fadeOut();
    $('#id_estrategia_edit_cliente_error').fadeOut();
    $('#logo_error').fadeOut();
    $('#logo_edit_error').fadeOut();
    $('#carpeta_error').fadeOut();
    $('#carpeta_edit_error').fadeOut();
    $('#pagina_web_error').fadeOut();
    $('#pagina_web_edit_error').fadeOut();
}

//Razones sociales
function Razones(id, nombre_comercial)
{
    $('#id_cliente_razon').val(id);
    $('.modal-title').html('Agregar razon social a cliente: ' + nombre_comercial);

    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });

    cargarRazones(id);
}

function cargarRazones(id)
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/clientes/razones-listado/' + id,
        success: function(data)
        {
            $('#listado-razones').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });

    QuitarErroresRazon();
    BorrarDatosRazon();
}

function EditarRazon(id, razon_social, rfc)
{
    QuitarErroresRazon();
    $('#id_razon_social').val(id);
    $('#razon_social_razon').val(razon_social);
    $('#rfc_razon').val(rfc);
}

$('#btn-guardar-razon').click(function()
{
    id = $('#id_razon_social').val();

    if(id == '')
    {
        insertarRazon();
    }
    else
    {
        actualizarRazon(id);
    }
});

$('#btn-cancelar-razon').click(function()
{
    BorrarDatosRazon();
    QuitarErroresRazon();
});

function insertarRazon()
{
    $('#btn-guardar-razon').attr('disabled', 'disabled');
    var token = $("#_token").val();
    id_cliente = $('#id_cliente_razon').val();

    var formData = {
        id_cliente,
        razon_social: $('#razon_social_razon').val(),
        rfc: $('#rfc_razon').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/clientes/razones-insertar',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            cargarRazones(id_cliente);
            BorrarDatosRazon();
            QuitarErroresRazon();
            Actualizar(id_cliente);
            $('#btn-guardar-razon').removeAttr('disabled');
            toastr.success('Se creó el registro satisfactoriamente');
        },
        error: function(data)
        {
            QuitarErroresRazon();

            $('#btn-guardar-razon').removeAttr('disabled');
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
            
            console.clear();
        }
    });
}

function actualizarRazon(id)
{
    $('#btn-guardar-razon').attr('disabled', 'disabled');
    var token = $("#_token").val();
    id_cliente = $('#id_cliente_razon').val();

    var formData = {
        id_cliente,
        razon_social: $('#razon_social_razon').val(),
        rfc: $('#rfc_razon').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/clientes/razones-actualizar/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            cargarRazones(id_cliente);
            BorrarDatosRazon();
            QuitarErroresRazon();
            Actualizar(id_cliente);
            $('#btn-guardar-razon').removeAttr('disabled');
            toastr.success('Se actualizó el registro satisfactoriamente.');
        },
        error: function(data)
        {
            QuitarErroresRazon();

            $('#btn-guardar-razon').removeAttr('disabled');
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
            
            console.clear();
        }
    });
}

function QuitarErroresRazon()
{
    $("#rfc_razon_error").fadeOut();
    $("#razon_social_razon_error").fadeOut();
}

function BorrarDatosRazon()
{
    $('#id_razon_social').val('');
    $('#rfc_razon').val('');
    $('#razon_social_razon').val('');
}

function InactivarRazon(id)
{
    $.confirm(
    {
        title: '¿Desea inactivar la razón social del cliente?',
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
                text: 'Inactivar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/clientes/razon-status/' + id;
                    token = $('#_token');

                    formData =
                    {
                        estatus:0
                    }

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        data: formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            cargarRazones(data.id_cliente);
                            toastr.info('Se inactivó la razón social');
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

function ActivarRazon(id)
{
    $.confirm(
    {
        title: '¿Desea activar la razón social del cliente?',
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
                    router = '/admin/clientes/razon-status/' + id;
                    token = $('#_token');

                    formData =
                    {
                        estatus:1
                    }

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        data: formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            cargarRazones(data.id_cliente);
                            toastr.info('Se activó la razón social');
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


//Marcas
function Marcas(id, nombre_comercial)
{
    $('#id_cliente_marca').val(id);
    $('.modal-title').html('Agregar marca a cliente: ' + nombre_comercial);

    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });

    cargarMarcas(id);
}

function cargarMarcas(id)
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/clientes/razones-listado/' + id,
        success: function(data)
        {
            $('#listado-razones').empty().html(data);
            $(".tooltip").tooltip("hide");
        }
    });

    QuitarErroresRazon();
    BorrarDatosRazon();
}

function EditarRazon(id, razon_social, rfc)
{
    QuitarErroresRazon();
    $('#id_razon_social').val(id);
    $('#razon_social_razon').val(razon_social);
    $('#rfc_razon').val(rfc);
}

$('#btn-guardar-razon').click(function()
{
    id = $('#id_razon_social').val();

    if(id == '')
    {
        insertarRazon();
    }
    else
    {
        actualizarRazon(id);
    }
});

$('#btn-cancelar-razon').click(function()
{
    BorrarDatosRazon();
    QuitarErroresRazon();
});

function insertarRazon()
{
    $('#btn-guardar-razon').attr('disabled', 'disabled');
    var token = $("#_token").val();
    id_cliente = $('#id_cliente_razon').val();

    var formData = {
        id_cliente,
        razon_social: $('#razon_social_razon').val(),
        rfc: $('#rfc_razon').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/clientes/razones-insertar',
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            cargarRazones(id_cliente);
            BorrarDatosRazon();
            QuitarErroresRazon();
            Actualizar(id_cliente);
            $('#btn-guardar-razon').removeAttr('disabled');
            toastr.success('Se creó el registro satisfactoriamente');
        },
        error: function(data)
        {
            QuitarErroresRazon();

            $('#btn-guardar-razon').removeAttr('disabled');
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
            
            console.clear();
        }
    });
}

function actualizarRazon(id)
{
    $('#btn-guardar-razon').attr('disabled', 'disabled');
    var token = $("#_token").val();
    id_cliente = $('#id_cliente_razon').val();

    var formData = {
        id_cliente,
        razon_social: $('#razon_social_razon').val(),
        rfc: $('#rfc_razon').val()
    }
    //console.log(formData);
    $.ajax(
    {
        url: '/admin/clientes/razones-actualizar/' + id,
        headers:
        {
            'X-CSRF-TOKEN': token
        },
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
            cargarRazones(id_cliente);
            BorrarDatosRazon();
            QuitarErroresRazon();
            Actualizar(id_cliente);
            $('#btn-guardar-razon').removeAttr('disabled');
            toastr.success('Se actualizó el registro satisfactoriamente.');
        },
        error: function(data)
        {
            QuitarErroresRazon();

            $('#btn-guardar-razon').removeAttr('disabled');
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
            
            console.clear();
        }
    });
}

function QuitarErroresRazon()
{
    $("#rfc_razon_error").fadeOut();
    $("#razon_social_razon_error").fadeOut();
}

function BorrarDatosRazon()
{
    $('#id_razon_social').val('');
    $('#rfc_razon').val('');
    $('#razon_social_razon').val('');
}

function InactivarRazon(id)
{
    $.confirm(
    {
        title: '¿Desea inactivar la razón social del cliente?',
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
                text: 'Inactivar',
                btnClass: 'btn-red any-other-class',
                action: function () 
                {
                    router = '/admin/clientes/razon-status/' + id;
                    token = $('#_token');

                    formData =
                    {
                        estatus:0
                    }

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        data: formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            cargarRazones(data.id_cliente);
                            toastr.info('Se inactivó la razón social');
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

function ActivarRazon(id)
{
    $.confirm(
    {
        title: '¿Desea activar la razón social del cliente?',
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
                    router = '/admin/clientes/razon-status/' + id;
                    token = $('#_token');

                    formData =
                    {
                        estatus:1
                    }

                    $.ajax(
                    {
                        url: router,
                        type: 'DELETE',
                        data: formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            cargarRazones(data.id_cliente);
                            toastr.info('Se activó la razón social');
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

















