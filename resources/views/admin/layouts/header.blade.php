<div id="header" class="header navbar-inverse">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<a href="{{ route('admin.emporio') }}" class="navbar-brand"><img src="{{ asset('images/ico/logo-full-002.png') }}" alt="Emporio Legal"></a>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- end navbar-header -->
	
	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		<li>
			<a href="{{ url('/admin/check-list/Jurídico') }}" class="f-s-14" title="Servicios pendientes en Jurídico" data-tooltip="tooltip">
				<i class="fas fa-gavel"></i>
				<span class="label" id="notificaciones_juridico_count" style="background-color: rgba(238, 87, 85, 0.5); font-weight: bold"></span>
			</a>
		</li>
		<li>
			<a href="{{ url('/admin/check-list/Gestión') }}" class="f-s-14" title="Servicios pendientes de Gestión" data-tooltip="tooltip">
				<i class="fas fa-clipboard-check"></i>
				<span class="label" id="notificaciones_gestion_count" style="background-color: rgba(238, 87, 85, 0.5); font-weight: bold"></span>
			</a>
		</li>
		<li>
			<a href="{{ url('/admin/check-list/Operaciones') }}" class="f-s-14" title="Servicios pendientes de Operaciones" data-tooltip="tooltip">
				<i class="fas fa-project-diagram"></i>
				<span class="label" id="notificaciones_operaciones_count" style="background-color: rgba(238, 87, 85, 0.5); font-weight: bold"></span>
			</a>
		</li>
		<li class="">
			<a @if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2) href="{{ route('autoriza-servicios') }}" @endif class="f-s-14" title="Servicios sin mostrar en bitácora" data-tooltip="tooltip">
				<i class="fas fa-business-time"></i>
				<span class="label" id="servicios_pendientes_count" style="background-color: rgba(238, 87, 85, 0.5); font-weight: bold"></span>
			</a>
		</li>
		<li class="dropdown">
			<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
				<i class="fa fa-bell"></i>
				<span class="label">0</span>
			</a>
			<ul class="dropdown-menu media-list dropdown-menu-right">
				<li class="dropdown-header">NOTIFICACIONES (0)</li>
				<!--<li class="media">
					<a href="javascript:;">
						<div class="media-left">
							<i class="fa fa-bug media-object bg-silver-darker"></i>
						</div>
						<div class="media-body">
							<h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
							<div class="text-muted f-s-11">3 minutes ago</div>
						</div>
					</a>
				</li>-->
				<li class="dropdown-footer text-center">
					<a href="javascript:;">Ver más</a>
				</li>
			</ul>
		</li>
		<li class="dropdown navbar-user">
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
				<img src="{{ asset('images/users/'.Auth::user()->imagen) }}" alt="" /> 
				<span class="d-none d-md-inline">{{ Auth::user()->iniciales }}</span> <b class="caret"></b>
				<input id="_token" value="{{ csrf_token() }}" type="hidden">
				<input id="id_admin" value="{{ Auth::user()->id }}" type="hidden">
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="{{ route('admin.perfil') }}" class="dropdown-item"><i class="fas fa-user"></i> Editar Perfil</a>
				<a href="javascript:;" class="dropdown-item"><i class="fas fa-envelope"></i> Notificaciones</a>
				<div class="dropdown-divider"></div>
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fas fa-power-off" style="color: red"></i> Cerrar sesión</a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>
			</div>
		</li>
	</ul>
	<!-- end header navigation right -->
</div>