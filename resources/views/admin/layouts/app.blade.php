<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	@section('title')
	@show
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Emporio Legal" name="description" />
	<meta content="GoProfit" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="{{ asset('admin/css/open-sanz.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/bootstrap/4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/font-awesome/5.3/css/all.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/css/default/style.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/css/default/style-responsive.min.css') }}" rel="stylesheet" />
	
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/bootstrap-calendar/css/bootstrap_calendar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/nvd3/build/nv.d3.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/powerange/powerange.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/toastr.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/popup-modal/jquery-confirm.min.css') }}" rel="stylesheet" />
    <!-- Date Range Picker -->
    <link href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset('fancybox/source/jquery.fancybox.css') }}" type="text/css" media="screen">
	<link rel="stylesheet" href="{{ asset('fancybox/source/helpers/jquery.fancybox-buttons.css') }}">
	<link rel="stylesheet" href="{{ asset('fancybox/source/helpers/jquery.fancybox-thumbs.css') }}">
	<link href="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('admin/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->

	@section('styles')
	@show

	<style type="text/css">
	    .minusculas{
	    text-transform:lowercase;
	    } 
	    .mayusculas{
	    text-transform:uppercase;
	    }
	    .modal 
	    { 
	    overflow: auto !important; 
	    }

	    table.floatThead-table {
	        border-top: none;
	        border-bottom: none;
	        background-color: #fff;
	    }

	    .centered
	    {
	    	text-align: center;
	    }
	</style>
</head>
<body>
	<!-- begin #page-loader 
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>-->
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		@include('admin.layouts.header')
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		@include('admin.layouts.sidebar')
		<!-- end #sidebar -->

		@yield('main-content')
		
		
		<!-- begin #content -->
		
		<!-- end #content -->
		
		<!-- begin theme-panel -->
		
		<!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('admin/plugins/jquery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/js-cookie/js.cookie.js') }}"></script>
	<script src="{{ asset('admin/js/theme/default.min.js') }}"></script>
	<script src="{{ asset('admin/js/apps.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{ asset('admin/plugins/d3/d3.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/nvd3/build/nv.d3.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/gritter/js/jquery.gritter.js') }}"></script>
	<script src="{{ asset('admin/js/demo/dashboard-v2.js') }}"></script>
	<script src="{{ asset('admin/js/toastr.js') }}"></script>
	<script src="{{ asset('admin/popup-modal/jquery-confirm.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/switchery/switchery.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/powerange/powerange.min.js') }}"></script>
	<script src="{{ asset('admin/js/demo/form-slider-switcher.demo.min.js') }}"></script>
	<!-- sticky headers -->
	<script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/highlight/highlight.common.js') }}"></script>
	<script src="{{ asset('admin/js/demo/render.highlight.js') }}"></script>
	<!-- bootstrap datepicker -->
	<script src="{{ asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('admin/plugins/daterangepicker/moment.js') }}"></script>
	<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
	<script src="{{ asset('admin/js/demo/form-plugins.demo.js') }}"></script>
	<!-- Fancybox -->
	<script src="{{ asset('fancybox/source/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ asset('fancybox/lib/jquery.mousewheel.pack.js') }}"></script>
	<script src="{{ asset('fancybox/source/helpers/jquery.fancybox-buttons.js') }}"></script>
	<script src="{{ asset('fancybox/source/helpers/jquery.fancybox-media.js') }}"></script>
	<script src="{{ asset('fancybox/source/helpers/jquery.fancybox-thumbs.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
	<!-- InputMask -->
	<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
	    $(document).ready(function() {
	        $('body').tooltip({
	            selector: "[data-tooltip=tooltip]",
	            container: "body"
	        });
	    });
	</script>
	<script type="text/javascript">
	    $(document).ready(function() 
	    {
	      $(".fancybox").fancybox();
	    });
	</script>
	<script>
	    $(document).ready(function() {
	      $(".various").fancybox({
	        maxWidth  : 1280,
	        maxHeight : 1000,
	        fitToView : true,
	        width   : '100%',
	        height    : '100%',
	        autoSize  : false,
	        closeClick  : false,
	        openEffect  : 'none',
	        closeEffect : 'none'
	      });
	    });
	</script>
	<script>
		//Data Mask
    	$("[data-mask]").inputmask();
	</script>
	<script>
		$(document).ready(function() {
			App.init();
			//DashboardV2.init();
			FormPlugins.init();

			route = '/admin/mostrarImagen';

			$.ajax(
            {
                type: 'get',
                url: route,
                success: function (data)
                {
                    //$('#imagen_mostrar').empty();
                    var imagen = '{{ URL::asset('images/login/') }}' + '/' + data.imagen;
                    $('#cover-image').css('background', 'url('+imagen+')');
                },
                error: function(data)
                {
                    console.log(data);
                }
            });
		});
	</script>
	<script>
		$(document).ready(function()
		{
			route = '/admin/notificacion/servicios-pendientes'
			$.get(route, function(data)
			{
				if(data == '' || data == 0)
				{
					$('#servicios_pendientes_count').html('0');
					$('#servicios_pendientes_count').css(
						{
							'background-color' : 'rgb(73, 173, 173, 0.5)'
						});
				}
				else
				{
					$('#servicios_pendientes_count').html(data);
					$('#servicios_pendientes_count').css(
						{
							'background-color' : 'rgba(238, 87, 85, 0.5)'
						});
				}
			});

			CountJuridico();
			CountGestion();
			CountOperaciones();
		});

		function CountJuridico()
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

		function CountGestion()
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

		function CountOperaciones()
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
	</script>
	
	@section('scripts')   
	@show
</body>
</html>
