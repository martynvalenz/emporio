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

function Listar()
{
    $.ajax(
    {
        type: 'get',
        url: '/admin/estrategias-listado',
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

function Create()
{
    BorrarDatos();
    QuitarErrores();
    $(".modal-title").html("Agregar estrategia de captación");
    $('.modal-header').css(
    {
        'background-color': '#218CBF'
    });
    $("#btn-save").removeClass();
    $("#btn-save").toggleClass("btn btn-primary btn-flat");
}

function Edit(id)
{
    QuitarErrores();

    var route = "/admin/estrategias/edit/" + id;
    $.get(route, function(data)
    {
        $(".modal-title").html("Editar estrategia: #" + id);
        $('.modal-header').css(
        {
            'background-color': '#EE8F14'
        });
        $("#btn-save").removeClass();
        $("#btn-save").toggleClass("btn btn-warning btn-flat");

        $('#id_estrategia').val(data.id);
        $('#estrategia').val(data.estrategia);
        $('#estatus').val(data.estatus).change();
    });
}

$('#btn-save').click(function()
{
    id = $('#id_estrategia').val();

    if(id == '')
    {
        Store();
    }
    else
    {
        Update(id);
    }
});

function Store()
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
        title: '¿Desea inactivar la estrategia?',
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
                    router = '/admin/estrategias/status/' + id;
                    token = $('#_token_egresos');

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
                            Listar();
                            toastr.info('Se inactivó la estrategia satisfactoriamente');
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
        title: '¿Desea activar la estrategia?',
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
                    router = '/admin/estrategias/status/' + id;
                    token = $('#_token_egresos');

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
                            Listar();
                            toastr.info('Se activó la estrategia satisfactoriamente');
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
    $('#id_estrategia').val('');
    $('#estrategia').val('');
    $('#estatus').val('1').change();
}

function QuitarErrores()
{
    $('#estrategia_error').fadeOut();
}











