<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<a href="javascript:;" data-toggle="nav-profile">
					<div class="cover with-shadow" id="cover-image"></div>
					<div class="image">
						<img src="{{ asset('images/users/'.Auth::user()->imagen) }}" alt="" />
					</div>
					<div class="info">
						<b class="caret pull-right"></b>
						{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
						<small>{{ Auth::user()->Role->Role->name }}</small>
					</div>
				</a>
			</li>
			<li>
				<ul class="nav nav-profile">
					<li><a href="{{ route('admin.perfil') }}"><i class="fas fa-user"></i> Editar Perfil</a></li>
					<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();"><i class="fas fa-power-off" style="color: red"></i> Cerrar sesión</a></li>
				</ul>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<li class="has-sub" id="Dashboard">
				<a href="{{ route('admin.emporio') }}">
					<i class="fas fa-chart-line"></i>
					<span>Dashboard</span>
				</a>
			</li>

			@if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2 || Auth::user()->Role->Role->id == 3)
			<li class="has-sub" id="liDireccion">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-hdd"></i> 
					<span>Dirección</span>
				</a>
				<ul class="sub-menu">
					<li id="subAutorizarServicios"><a href="{{ route('autoriza-servicios') }}"><i class="fas fa-check"></i> Autorizar servicios</a></li>
					<!--<li><a>Estatus</a></li>
					<li><a>Facturación y cobranza</a></li>
					<li><a>Egresos</a></li>-->
					<li id="subDireccionComisiones"><a href="{{ route('direccion.comisiones') }}"><i class="fas fa-hand-holding-usd text-green"></i> Comisiones</a></li>
					<li id="subSueldos"><a href="{{ route('direccion.sueldos') }}"><i class="fas fa-hand-holding-usd text-orange"></i> Sueldos</a></li>
					<li id="liBancos"><a href="{{ route('cuentas.index') }}"><i class="fas fa-university"></i> Bancos</a></li>
					<li id="liMetas"><a href="{{ route('metas.index') }}"><i class="fas fa-tachometer-alt"></i> Metas</a></li>
				</ul>
			</li>
			@endif

			<li class="has-sub" id="liIndicadores">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-tachometer-alt"></i> 
					<span>Indicadores</span>
				</a>
				<ul class="sub-menu">
					@if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2)
					<li id="subIndicadores"><a href="{{ route('indicadores.index') }}"><i class="fas fa-chart-line"></i> Dirección</a></li>
					@endif
					<li id="subPendientes"><a href="{{ route('indicadores.tramites') }}"><i class="fas fa-list"></i> Trámites Pendientes</a></li>
				</ul>
			</li>
			

			<!--<li class="has-sub" id="liDireccion">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-tachometer-alt"></i>
					<span>Indicadores</span>
				</a>
				<ul class="sub-menu">
					<li id=""><a href=""><i class="fas fa-gavel"></i> Servicios de Jurídico</a></li>
					<li id=""><a href=""><i class="fas fa-clipboard-check"></i> Servicios de Gestión</a></li>
					<li id=""><a href=""><i class="fas fa-project-diagram"></i> Servicios de Operaciones</a></li>
				</ul>
			</li>-->

			<li class="has-sub" id="liClientes">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-trophy"></i> 
					<span>Clientes</span>
				</a>
				<ul class="sub-menu">
					<li id="liEstrategias"><a href="{{ route('estrategias.index') }}"><i class="fas fa-chart-line"></i> Estrategias</a></li>
					<li id="subClientes"><a href="{{ route('clientes.index') }}"><i class="fa fa-users"></i> Clientes</a></li>
					<!--<li id="subRazones"><a href="{{ route('clientes-razones.index') }}"><i class="fas fa-qrcode"></i> Razones Sociales</a></li>
					<li id="liClientesUsers"><a href="{{ route('clientes-users.index') }}"><i class="fa fa-user"></i> Contactos</a></li>
					<li id="liMarcas"><a href="{{ route('control.index') }}"><i class="fa fa-registered"></i> Registro de Marcas y Obras</a></li>-->
				</ul>
			</li>

			<li class="has-sub" id="liServicios">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-folder-open"></i> 
					<span>Servicios</span>
				</a>
				<ul class="sub-menu">
					<li id="liCategoriaServicios"><a href="{{ route('categoria-servicios.index') }}"><i class="fa fa-bookmark text-orange"></i> Categorías</a></li>
					<li id="liSubcategoria"><a href="{{ route('subcategorias.index') }}"><i class="fas fa-book"></i> Subcategorías</a></li>
                    <li id="liCatalogo"><a href="{{ route('servicios.index') }}"><i class="fa fa-suitcase"></i> Catálogo de Servicios</a></li>
                    <li id="subComisionesServicios"><a href="{{ route('servicios-comisiones.index') }}"><i class="fas fa-hand-holding-usd text-green"></i> Montos y Comisiones</a></li>
                    <li id="subDescuentos"><a ><i class="fas fa-percent"></i> Descuentos</a></li>
                    <li id="subProcesos"><a href="{{ url('/admin/check-list/todos') }}" ><i class="fas fa-list"></i> Check List Bitácoras</a></li>
                    <li id="subReporteHonorarios"><a href="{{ route('honorarios.index') }}" ><i class="fas fa-receipt"></i> Pago de Derechos</a></li>
				</ul>
			</li>

			<li class="has-sub" id="Administracion">
				<a href="{{ route('procesos.index') }}">
					<i class="fa fa-magic"></i>
					<span>Administración</span>
				</a>
			</li>

			<li class="has-sub" id="Bitacoras">
				<a href="{{ route('bitacoras.index') }}">
					<i class="fas fa-book"></i>
					<span>Bitácoras</span>
				</a>
			</li>

			<li class="has-sub" id="Estatus">
				<a href="{{ route('estatus.index') }}">
					<i class="fa fa-hourglass-half"></i>
					<span>Estatus de Trámites</span>
				</a>
			</li>

			<li class="has-sub" id="li-Comisiones">
				<a href="{{ route('comisiones.usuario.index') }}">
					<i class="fas fa-hand-holding-usd"></i>
					<span>Comisiones</span>
				</a>
			</li>

			<li class="has-sub" id="liExtras">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-paper-plane"></i> 
					<span>Extras</span>
				</a>
				<ul class="sub-menu">
					<li><a href=""><i class="fa fa-plane"></i> Guías</a></li>
                    <li><a href=""><i class="fa fa-clone"></i> Cuadros</a></li>
				</ul>
			</li>
			
			@if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2 || Auth::user()->Role->Role->id == 3)
			<!--<li class="has-sub" id="li-control-servicios">
				<a href="{{ route('control.servicios') }}">
					<i class="fas fa-book"></i>
					<span>Control de Servicios</span>
				</a>
			</li>-->

			<li class="has-sub" id="liUsuarios">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-users text-blue"></i> 
					<span>Usuarios</span>
				</a>
				<ul class="sub-menu">
					<!--<li id="liPuestos"><a href="{{ route('puestos.index') }}"><i class="fa fa-sitemap"></i> Puestos</a></li>-->
                    <li id="liAdmin"><a href="{{ route('usuarios.index') }}"><i class="fa fa-user-secret text-blue"></i> Usuarios del sistema</a></li>
                    <!--<li><a href=""><i class="fa fa-id-badge"></i> Perfiles</a></li>
                    <li><a href=""><i class="fa fa-unlock-alt"></i> Accesos</a></li>-->
				</ul>
			</li>

			<li class="has-sub" id="liHistorico">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-book"></i>
					<span>Histórico</span>
				</a>
				<ul class="sub-menu">
					<li id="subHServicios"><a><i class="fas fa-briefcase"></i> Servicios</a></li>
					<li id="subHFacturas"><a><i class="fas fa-file-pdf"></i> Facturas</a></li>
					<li id="subHRecibos"><a><i class="fas fa-receipt"></i> Recibos</a></li>
					<li id="subHIngresos"><a><i class="fas fa-money-bill-alt" style="color:green"></i> Ingresos</a></li>
					<li id="subHEgresos"><a><i class="fas fa-money-bill-alt" style="color:red"></i> Egresos</a></li>
				</ul>
			</li>

			<li class="has-sub" id="liAjustes">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-cog fa-spin"></i> 
					<span>Ajustes</span>
				</a>
				<ul class="sub-menu">
					<li id="liFiscal"><a href="{{ url('admin/datos-fiscales') }}"><i class="fas fa-qrcode"></i> Datos Fiscales</a></li>
                    <li id="liFormasPago"><a href="{{ route('formaspago.index') }}"><i class="fas fa-credit-card"></i> Formas de Pago</a></li>
                    <li id="liMonedas"><a href="{{ route('monedas.index') }}"><i class="fas fa-hand-holding-usd text-green"></i> Monedas y tipos de cambio</a></li>
                    <li id="liPorcentajeIVA"><a href="{{ route('porcentaje-iva.index') }}"><i class="fa fa-percent"></i> Porcentaje de IVA</a></li>
                    <li id="liClases"><a href="{{ route('clases.index') }}"><i class="fa fa-address-book"></i> Clases</a></li>
                    <li id="subColores"><a href="{{ route('colores.index') }}"><i class="fas fa-pencil-alt"></i> Colores de Estatus</a></li>
				</ul>
			</li>
			@endif
			
			<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>









