@extends('admin.app')

@section('title')
<title>Emporio Legal | Catálogo de Servicios</title>
@endsection

@section('styles')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <!-- Styled Checkboxes -->
  <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <style type="text/css">
    .minusculas{
    text-transform:lowercase;
    } 
    .mayusculas{
    text-transform:uppercase;
    }
    .modal { 
      overflow: auto !important; 
    }

</style>
@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Catálogo de Servicios
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Catálogo de Servicios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a class="btn btn-primary btn-flat" id="btn-agregar" data-toggle="modal" data-target="#servicio-modal" title="Agregar registro" data-tooltip="tooltip"><i class="fa fa-plus"></i> Servicio
                </a>
                @include('admin.servicios.servicio')
                <a data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-flat" title="Agregar categoría" data-tooltip="tooltip"><i class="fa fa-plus"></i> Categoría</a>
                @include('admin.servicios.categorias.create')
                <a href="{{ route('catalogo-servicios.exportar') }}" target="_blank" class="btn btn-default btn-flat"><i class="far fa-file-excel"></i> Exportar</a>
                <a href="" class="btn btn-default" title="Ayuda">?</a>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Buscar</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                            <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                            <input type="hidden" name="variable_estatus" id="variable_estatus" value="todos">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
                            <span class="input-group-btn">
                              <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                              <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                            </span>
                        </div>
                    </div>
                </div>
              </div>  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="listado"></div>
            </div>
            @include('admin.servicios.activar')
            @include('admin.servicios.inactivar')
            @include('admin.servicios.detalles')
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('scripts')
  <!-- Bootstrap 3.3.6 -->
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- sticky headers -->
  <script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- CK Editor -->
  <script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
  <script>
    $('#liServicios').addClass("treeview active");
    $('#liCatalogo').addClass("active");
  </script>
  <script>
    $(function () 
    {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
  </script>
  <script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
  </script>

  <script>
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

    $("#btn-buscar").on("click", function(e)
    {
      e.preventDefault();
      Listar();
    
    });

    $("#btn-agregar").on("click", function(e)
    {
      sesion = $("#id_sesion").val();
        if(sesion == '')
        {
          RecargarPagina();
          
        }
        else
        {
          $("#accion").val("Agregar");
          Create();
        }
    
    });

    $('#estatus').on('change', function()
    {
      this.value = this.checked ? 1 : 0;
      //alert(this.value);
      $("#estatus_check").val(this.value);
    
    }).change();

    $("#btn-guardar").on("click", function(e)
    {
      accion = $("#accion").val();
      if(accion == 'Agregar')
      {
        AgregarServicio();
      }
      else if(accion == 'Editar')
      {
        ActualizarServicio();
      }
    
    });

    $('#buscar').on('keypress', function (e) 
    {
       if(e.which === 13)
       {
    
          //Desabilitar para evitar presionar multiples veces
          $(this).attr("disabled", "disabled");
    
          Listar();
    
          //Habilitar textobx
          $(this).removeAttr("disabled");
       }
    });

    $("#btn-borrar").click(function()
    {
      $('#buscar').val('');
      setTimeout(Listar, 300);
    });

    var Listar = function()
    {
      estatus = $("#variable_estatus").val();
      buscar = $("#buscar").val();

      if(buscar == '')
      {
        $.ajax(
        {
          type: 'get',
          url : '/admin/servicios/listado/' + estatus,
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
          url : '/admin/servicios/buscar/' + buscar,
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

    var Create = function()
    {
      $("#encabezado-servicio").html("Agregar Servicio");
      $('#encabezado').css({'background-color': '#218CBF'});
      $("#btn-servicio").removeClass();
      $("#btn-servicio").toggleClass("btn btn-primary btn-flat");
    
      $("#estatus").val("1").change();
      $('#estatus').prop('checked' , true);
      $("#estatus_check").val("1");

      $("#costo_servicio").val("0.00");
      $("#costo").val("0.00");
      $("#comision_venta_monto").val("0.00");
      $("#comision_gestion_monto").val("0.00");
      $("#comision_operativa_monto").val("0.00");
    
    }

    var AgregarServicio = function()
    {
      var route = "/admin/servicios";
      var token = $("#_token").val();
      for (instance in CKEDITOR.instances) 
      {
          CKEDITOR.instances[instance].updateElement();
      }

      var formData = 
      {
        clave: $('input[name=clave]').val(),
        servicio: $('input[name=servicio]').val(),
        comentarios: $('textarea[name=comentarios]').val(),
        id_categoria_servicios: $('select[name=id_categoria_servicios]').val(),
        id_categoria_bitacora: $('select[name=id_categoria_bitacora]').val(),
        id_categoria_estatus: $('select[name=id_categoria_estatus]').val(),
        concepto: $('select[name=concepto]').val(),
        moneda: $('select[name=moneda]').val(),
        costo_servicio: $('input[name=costo_servicio]').val(),
        costo: $('input[name=costo]').val(),
        comision_venta: $('select[name=comision_venta]').val(),
        comision_gestion: $('select[name=comision_gestion]').val(),
        comision_operativa: $('select[name=comision_operativa]').val(),
        comision_venta_monto: $('input[name=comision_venta_monto]').val(),
        comision_gestion_monto: $('input[name=comision_gestion_monto]').val(),
        comision_operativa_monto: $('input[name=comision_operativa_monto]').val(),
        estatus: $('input[name=estatus_check]').val(),
        procedimiento: $('textarea[name=procedimiento]').val()
      }
    
      //console.log(formData);
      
      $.ajax(
      {
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
          toastr.success('Se agregó el servicio exitosamente');
    
          Listar();
    
          BorrarFormualario();
          QuitarErrores();
          $("#servicio-modal").modal('toggle');
          
        },
        error: function(data)
        {
          console.log(data);
    
    
          if(data.responseJSON.errors.clave)
          {
            $("#clave_error").html(data.responseJSON.errors.clave);
            $("#clave_error").fadeIn();
          }
          else
          {
            $("#clave_error").fadeOut();
          }
    
          if(data.responseJSON.errors.servicio)
          {
            $("#servicio_error").html(data.responseJSON.errors.servicio);
            $("#servicio_error").fadeIn();
          }
          else
          {
            $("#servicio_error").fadeOut();
          }
    
          if(data.responseJSON.errors.costo)
          {
            $("#costo_error").html(data.responseJSON.errors.costo);
            $("#costo_error").fadeIn();
          }
          else
          {
            $("#costo_error").fadeOut();
          }

          if(data.responseJSON.errors.costo_servicio)
          {
            $("#costo_servicio_error").html(data.responseJSON.errors.costo_servicio);
            $("#costo_servicio_error").fadeIn();
          }
          else
          {
            $("#costo_servicio_error").fadeOut();
          }

          if(data.responseJSON.errors.comision_venta_monto)
          {
            $("#comision_venta_monto_error").html(data.responseJSON.errors.comision_venta_monto);
            $("#comision_venta_monto_error").fadeIn();
          }
          else
          {
            $("#comision_venta_monto_error").fadeOut();
          }

          if(data.responseJSON.errors.comision_gestion_monto)
          {
            $("#comision_gestion_monto_error").html(data.responseJSON.errors.comision_gestion_monto);
            $("#comision_gestion_monto_error").fadeIn();
          }
          else
          {
            $("#comision_gestion_monto_error").fadeOut();
          }

          if(data.responseJSON.errors.comision_operativa_monto)
          {
            $("#comision_operativa_monto_error").html(data.responseJSON.errors.comision_operativa_monto);
            $("#comision_operativa_monto_error").fadeIn();
          }
          else
          {
            $("#comision_operativa_monto_error").fadeOut();
          }

          if(data.responseJSON.errors.id_categoria_bitacora)
          {
            $("#id_categoria_bitacora_error").html(data.responseJSON.errors.id_categoria_bitacora);
            $("#id_categoria_bitacora_error").fadeIn();
          }
          else
          {
            $("#id_categoria_bitacora_error").fadeOut();
          }

          if(data.responseJSON.errors.id_categoria_servicios)
          {
            $("#id_categoria_servicios_error").html(data.responseJSON.errors.id_categoria_servicios);
            $("#id_categoria_servicios_error").fadeIn();
          }
          else
          {
            $("#id_categoria_servicios_error").fadeOut();
          }
    
          
          
          toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
    
          if(data.status == 422)
          {
            console.clear();
          }
        } 
      });
    }

    var Edit = function(id)
    {  
      BorrarFormualario();
      QuitarErrores();
      $("#accion").val("Editar");
      $("#encabezado-servicio").html("Agregar Servicio");
      $('#encabezado').css({'background-color': '#FE9800'});
      $("#btn-servicio-nuevo").removeClass();
      $("#btn-servicio-nuevo").toggleClass("btn btn-warning btn-flat");
    
      var router = "/admin/servicios/" + id + "/edit";

      $.get(router, function(data)
      {
        //console.log(data);
      
        $('#id_servicio').val(data.id);
        $("#encabezado-servicio").html("Editar Servicio: "+data.clave + ' - ' + data.servicio);
        $('#clave').val(data.clave);
        $('#servicio').val(data.servicio);
        $('#comentarios').val(data.comentarios);
        $('#id_categoria_servicios').val(data.id_categoria_servicios).change();
        $('#id_categoria_bitacora').val(data.id_categoria_bitacora).change();
        $('#id_categoria_estatus').val(data.id_categoria_estatus).change();
        $('#concepto').val(data.concepto).change();
        $('#moneda').val(data.moneda).change();
        $('#costo_servicio').val(data.costo_servicio);
        $('#costo').val(data.costo);
        $('#comision_venta').val(data.comision_venta).change();
        $('#comision_operativa').val(data.comision_operativa).change();
        $('#comision_gestion').val(data.comision_gestion).change();
        $('#comision_gestion_monto').val(data.comision_gestion_monto);
        $('#comision_venta_monto').val(data.comision_venta_monto);
        $('#comision_operativa_monto').val(data.comision_operativa_monto);
        CKEDITOR.instances.editor1.setData(data.procedimiento);

        if(data.comision_venta == 'Dolares' || data.comision_venta == 'Monto Fijo')
        {
          $('#span_venta').addClass('fas fa-dollar-sign');
        }
        else if(data.comision_venta == 'Porcentaje Utilidad' || data.comision_venta == 'Porcentaje')
        {
          $('#span_venta').addClass('fas fa-percent');
        }

        if(data.comision_operativa == 'Dolares' || data.comision_operativa == 'Monto Fijo')
        {
          $('#span_operativo').addClass('fas fa-dollar-sign');
        }
        else if(data.comision_operativa == 'Porcentaje Utilidad' || data.comision_operativa == 'Porcentaje')
        {
          $('#span_operativo').addClass('fas fa-percent');
        }

        if(data.comision_gestion == 'Dolares' || data.comision_gestion == 'Monto Fijo')
        {
          $('#span_gestion').addClass('fas fa-dollar-sign');
        }
        else if(data.comision_gestion == 'Porcentaje Utilidad' || data.comision_gestion == 'Porcentaje')
        {
          $('#span_gestion').addClass('fas fa-percent');
        }
      
        if(data.estatus == 1)
        {
          $("#estatus").val("1").change();
          $('#estatus').prop('checked' , true);
          $("#estatus_check").val("1");
        }
        else if (data.estatus == 0)
        {
          $("#estatus").val("0").change();
          $('#estatus').prop('checked' , false);
          $("#estatus_check").val("0");
        } 
      });
    }

    var ActualizarServicio = function()
    {
      var id = $("#id_servicio").val();
      var route = "/admin/servicios/" + id;
      var token = $("#_token").val();
      for (instance in CKEDITOR.instances) 
      {
          CKEDITOR.instances[instance].updateElement();
      }
      //console.log(route);
      var formData = 
      {
        clave: $('input[name=clave]').val(),
        servicio: $('input[name=servicio]').val(),
        comentarios: $('textarea[name=comentarios]').val(),
        id_categoria_servicios: $('select[name=id_categoria_servicios]').val(),
        id_categoria_bitacora: $('select[name=id_categoria_bitacora]').val(),
        id_categoria_estatus: $('select[name=id_categoria_estatus]').val(),
        concepto: $('select[name=concepto]').val(),
        moneda: $('select[name=moneda]').val(),
        costo_servicio: $('input[name=costo_servicio]').val(),
        costo: $('input[name=costo]').val(),
        comision_venta: $('select[name=comision_venta]').val(),
        comision_gestion: $('select[name=comision_gestion]').val(),
        comision_operativa: $('select[name=comision_operativa]').val(),
        comision_venta_monto: $('input[name=comision_venta_monto]').val(),
        comision_gestion_monto: $('input[name=comision_gestion_monto]').val(),
        comision_operativa_monto: $('input[name=comision_operativa_monto]').val(),
        estatus: $('input[name=estatus_check]').val(),
        procedimiento: $('textarea[name=procedimiento]').val()
      }
      
      console.log(formData);
      
      $.ajax(
      {
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
          toastr.success('Se actualizó el registro exitosamente');
          Listar();
      
          BorrarFormualario();
          QuitarErrores();
          $("#servicio-modal").modal('toggle');
        },
        error: function(data)
        {
          console.log(data);
    
    
          if(data.responseJSON.errors.clave)
          {
            $("#clave_error").html(data.responseJSON.errors.clave);
            $("#clave_error").fadeIn();
          }
          else
          {
            $("#clave_error").fadeOut();
          }
    
          if(data.responseJSON.errors.servicio)
          {
            $("#servicio_error").html(data.responseJSON.errors.servicio);
            $("#servicio_error").fadeIn();
          }
          else
          {
            $("#servicio_error").fadeOut();
          }
    
          if(data.responseJSON.errors.costo)
          {
            $("#costo_error").html(data.responseJSON.errors.costo);
            $("#costo_error").fadeIn();
          }
          else
          {
            $("#costo_error").fadeOut();
          }

          if(data.responseJSON.errors.costo_servicio)
          {
            $("#costo_servicio_error").html(data.responseJSON.errors.costo_servicio);
            $("#costo_servicio_error").fadeIn();
          }
          else
          {
            $("#costo_servicio_error").fadeOut();
          }

          if(data.responseJSON.errors.comision_venta_monto)
          {
            $("#comision_venta_monto_error").html(data.responseJSON.errors.comision_venta_monto);
            $("#comision_venta_monto_error").fadeIn();
          }
          else
          {
            $("#comision_venta_monto_error").fadeOut();
          }

          if(data.responseJSON.errors.comision_gestion_monto)
          {
            $("#comision_gestion_monto_error").html(data.responseJSON.errors.comision_gestion_monto);
            $("#comision_gestion_monto_error").fadeIn();
          }
          else
          {
            $("#comision_gestion_monto_error").fadeOut();
          }

          if(data.responseJSON.errors.comision_operativa_monto)
          {
            $("#comision_operativa_monto_error").html(data.responseJSON.errors.comision_operativa_monto);
            $("#comision_operativa_monto_error").fadeIn();
          }
          else
          {
            $("#comision_operativa_monto_error").fadeOut();
          }

          if(data.responseJSON.errors.id_categoria_bitacora)
          {
            $("#id_categoria_bitacora_error").html(data.responseJSON.errors.id_categoria_bitacora);
            $("#id_categoria_bitacora_error").fadeIn();
          }
          else
          {
            $("#id_categoria_bitacora_error").fadeOut();
          }

          if(data.responseJSON.errors.id_categoria_servicios)
          {
            $("#id_categoria_servicios_error").html(data.responseJSON.errors.id_categoria_servicios);
            $("#id_categoria_servicios_error").fadeIn();
          }
          else
          {
            $("#id_categoria_servicios_error").fadeOut();
          }
    
          
          
          toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');
    
          if(data.status == 422)
          {
            console.clear();
          }
        } 
      });
    }

    var BorrarFormualario = function()
    {
      $("#clave").val("");
      $("#servicio").val("");
      $("#comentarios").val("");
      $("#comentarios").val("");
      $("#id_categoria_servicios").val("").change();
      $("#id_categoria_bitacora").val("").change();
      $("#id_categoria_estatus").val("").change();
      $("#concepto_costo").val("Neto").change();
      $("#moneda").val("MXN").change();
      $("#costo").val("0.00");
      $("#costo_servicio").val("0.00");
      $("#comision_venta").val("").change();
      $("#comision_gestion").val("").change();
      $("#comision_operativa").val("").change();
      $("#comision_venta_monto").val("0.00");
      $("#comision_gestion_monto").val("0.00");
      $("#comision_operativa_monto").val("0.00");
      $("#estatus").val("1");
      $('#estatus').prop('checked' , true);
      $("#estatus_check").val("1");
      $("#editor1").val("");
      $("#created_at").val("");
      $("#updated_at").val("");
      $("#span_venta").removeClass();
      $("#span_operativo").removeClass();
      $("#span_gestion").removeClass();
      CKEDITOR.instances.editor1.setData('');

    }
    
    var QuitarErrores = function()
    {
      $("#clave_error").fadeOut();
      $("#servicio_error").fadeOut();
      $("#id_categoria_servicios_error").fadeOut();
      $("#id_categoria_bitacora_error").fadeOut();
      $("#id_categoria_estatus_error").fadeOut();
      $("#costo_servicio_error").fadeOut();
      $("#costo_error").fadeOut();
      $("#comision_venta_monto_error").fadeOut();
      $("#comision_operativa_monto_error").fadeOut();
      $("#comision_gestion_monto_error").fadeOut();
    }

    $("#servicio-modal").on("hidden.bs.modal", function()
    {
      BorrarFormualario();
      QuitarErrores();
    });

    var Activar = function(id)
    {
      var route = "/admin/servicios/" + id + '/edit/';
    
      $.get(route, function(data)
      {
        servicio = data.clave + ' - ' + data.servicio;
        //console.log(data);
        $("#span_activar").html(servicio);
        $("#id_activar").val(data.id);
      });
    }

    var Cancelar = function(id)
    {
      var route = "/admin/servicios/" + id + '/edit/';
    
      $.get(route, function(data)
      {
        servicio = data.clave + ' - ' + data.servicio;
        //console.log(data);
        $("#span_cancelar").html(servicio);
        $("#id_cancelar").val(data.id);
      });
    }

    $("#btn-cancelar").click(function()
    {
      CancelarServicio();
    });
    
    $("#btn-activar").click(function()
    {
      ActivarServicio();
    });

    function ActivarServicio()
    {
      var id = $("#id_activar").val();
      var route = "/admin/servicios/" + id;
      var token = $("#_token").val();
      var formData = 
      {
        id: $('input[name=id_activar]').val(),
        estatus: $('input[name=estatus_activar]').val(),
      }
    
      //console.log(formData);
    
      $.ajax(
      {
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
          toastr.success('Se activó el registro exitosamente');
          Listar();
    
          $("#activar-modal").modal('toggle');
        },
        error: function(data)
        {
          console.log(data);
          
          toastr.error('No se pudo activar el registro.');
    
          if(data.status == 422)
          {
            console.clear();
          }
        } 
      });
    }

    function CancelarServicio()
    {
      var id = $("#id_cancelar").val();
      var route = "/admin/servicios/" + id;
      var token = $("#_token").val();
      var formData = 
      {
        id: $('input[name=id_cancelar]').val(),
        estatus: $('input[name=estatus_cancelar]').val(),
      }
    
      //console.log(formData);
    
      $.ajax(
      {
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        data: formData,
        success: function(data)
        {
          toastr.success('Se canceló el registro exitosamente');
          Listar();
    
          $("#cancelar-modal").modal('toggle');
        },
        error: function(data)
        {
          console.log(data);
          
          toastr.error('No se pudo cancelar el registro.');
    
          if(data.status == 422)
          {
            console.clear();
          }
        } 
      }); 
    }

    var Detalles = function(id)
    {  
      //BorrarFormualario();
      //QuitarErrores();
    
      var router = "/admin/servicios/" + id + "/edit";

      $.get(router, function(data)
      {
        //console.log(data);
      
        $('#id_servicio').val(data.id);
        $("#detalles-titulo").html(data.clave + ' - ' + data.servicio);
        $('#comentarios').val(data.comentarios);
        $('#det_categoria').val(data.id_categoria_servicios).change();
        $('#det_bitacora').val(data.id_categoria_bitacora).change();
        $('#det_bit_estatus').val(data.id_categoria_estatus).change();
        $('#det_concepto').val(data.concepto).change();
        $('#det_moneda').val(data.moneda).change();
        $('#det_costo_servicio').val(data.costo_servicio);
        $('#det_costo').val(data.costo);
        $('#det_comision_venta').val(data.comision_venta).change();
        $('#det_comision_operativa').val(data.comision_operativa).change();
        $('#det_comision_gestion').val(data.comision_gestion).change();
        $('#det_comision_gestion_monto').val(data.comision_gestion_monto);
        $('#det_comision_venta_monto').val(data.comision_venta_monto);
        $('#det_comision_operativa_monto').val(data.comision_operativa_monto);
        $('#det_procedimiento').html(data.procedimiento);

        if(data.comision_venta == 'Dolares' || data.comision_venta == 'Monto Fijo')
        {
          $('#det_span_venta').addClass('fas fa-dollar-sign');
        }
        else if(data.comision_venta == 'Porcentaje Utilidad' || data.comision_venta == 'Porcentaje')
        {
          $('#det_span_venta').addClass('fas fa-percent');
        }

        if(data.comision_operativa == 'Dolares' || data.comision_operativa == 'Monto Fijo')
        {
          $('#det_span_operativo').addClass('fas fa-dollar-sign');
        }
        else if(data.comision_operativa == 'Porcentaje Utilidad' || data.comision_operativa == 'Porcentaje')
        {
          $('#det_span_operativo').addClass('fas fa-percent');
        }

        if(data.comision_gestion == 'Dolares' || data.comision_gestion == 'Monto Fijo')
        {
          $('#det_span_gestion').addClass('fas fa-dollar-sign');
        }
        else if(data.comision_gestion == 'Porcentaje Utilidad' || data.comision_gestion == 'Porcentaje')
        {
          $('#det_span_gestion').addClass('fas fa-percent');
        }
      
        if(data.estatus == 1)
        {
          $("#det_estatus").val("1").change();
          $('#det_estatus').prop('checked' , true);
        }
        else if (data.estatus == 0)
        {
          $("#det_estatus").val("0").change();
          $('#det_estatus').prop('checked' , false);
        } 
      });
    }
  </script>
<script>
  @if(Session::has('message'))
    var type="{{ Session::get('alert-type', 'info') }}";
    switch(type)
    {
      case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;

      case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;

      case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;

      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;

    }
  @endif
</script>
@endsection