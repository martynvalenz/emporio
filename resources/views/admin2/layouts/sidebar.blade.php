<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="border-radius: 50%; border-width: 5px; border-color: white;">
                <img src="{{ asset('images/users/'.Auth::user()->imagen) }}" class="img-circle" alt="User Image" >
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</p>
                <p>{{ Auth::user()->Role->Role->name }}</p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- search form 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{ route('admin.emporio') }}">
                <i class="fa fa-home"></i> <span> Home</span>
                </a>
            </li>
            <li class="treeview" id="liDireccion">
                <a>
                    <i class="fas fa-chart-line"></i> <span> Dirección</span>
                    <span class="pull-right-container">
                        <i class="fas fa-angle-down pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="subDireccion"><a href="{{ route('direccion') }}"><i class="fas fa-chart-line"></i></i> Dirección</a></li>
                    <li><a href="#"><i class="fas fa-book"></i> Bitácoras</a></li>
                    <li><a href="#"><i class="fa fa-hourglass-half"></i> Estatus</a></li>
                    <li><a href="#"><i class="far fa-money-bill-alt text-green"></i> Facturación y Cobranza</a></li>
                    <li><a href="#"><i class="fa fa-cart-arrow-down"></i> Egresos</a></li>
                </ul>
            </li>
            <li id="liClientes" class="treeview">
                <a>
                <i class="fa fa-trophy"></i><span> Clientes</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="liEstrategias"><a href="{{ route('estrategias.index') }}"><i class="fas fa-chart-line"></i> Estrategias</a></li>
                    <li id="subClientes"><a href="{{ route('clientes.index') }}"><i class="fa fa-users"></i> Clientes</a></li>
                    <li id="subRazones"><a href="{{ route('clientes-razones.index') }}"><i class="glyphicon glyphicon-qrcode"></i> Razones Sociales</a></li>
                    <li id="liClientesUsers"><a href="{{ route('clientes-users.index') }}"><i class="fa fa-user"></i> Contactos</a></li>
                    <li id="liMarcas"><a href="{{ route('control.index') }}"><i class="fa fa-registered"></i> Registro de Marcas y Obras</a></li>
                </ul>
            </li>
            <li id="liServicios" class="treeview">
                <a>
                <i class="fa fa-folder-open"></i> <span> Servicios</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="liCategoriaServicios"><a href="{{ route('categoria-servicios.index') }}"><i class="fa fa-bookmark text-orange"></i> Categorías</a></li>
                    <li id="liCatalogo"><a href="{{ route('servicios.index') }}"><i class="fa fa-suitcase"></i> Catálogo de Servicios</a></li>
                    <li id="subComisionesServicios"><a href="{{ route('servicios-comisiones.index') }}"><i class="fas fa-hand-holding-usd text-green"></i> Comisiones</a></li>
                    <li id="subDescuentos"><a ><i class="fas fa-percent"></i> Descuentos</a></li>
                    <li id="subControl_Servicios"><a href="{{ route('procesos.index') }}"><i class="fa fa-magic"></i>  Control de Servicios</a></li>
                </ul>
            </li>
            <li id="liBitacoras" class="treeview">
                <a href="#">
                <i class="glyphicon glyphicon-book"></i>
                <span>Bitácoras de Servicios</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=><i class="fa fa-bookmark text-green"></i> Categorías</a></li>
                    <li id="subTramitesNuevos"><a href="{{ route('tramites-nuevos.index') }}"><i class="far fa-file-alt"></i> Trámites Nuevos</a></li>
                    <li id="subEstudiosFactibilidad"><a href="{{ route('estudios-factibilidad.index') }}"><i class="glyphicon glyphicon-search"></i> Estudios de Factibilidad</a></li>
                    <li id="subNegativas"><a href="{{ route('negativas.index') }}"><i class="glyphicon glyphicon-remove-circle text-red"></i> Negativas</a></li>
                    <li id="subRequisitos"><a href="{{ route('requisitos.index') }}"><i class="fas fa-comments"></i> Requisitos y Objeciones</a></li>
                    <li id="subTitulos"><a href="{{ route('titulos.index') }}"><i class="far fa-folder-open"></i> Títulos y Certificados</a></li>
                </ul>
            </li>
            <li id="liEstatus" class="treeview">
                <a href="#">
                <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                <span> Estatus de Trámites</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href=><i class="fa fa-bookmark text-green"></i> Categorías</a></li>-->
                    <li id="subEstatus"><a href="{{ route('estatus-menu.index') }}"><i class="fas fa-bars text-green"></i> Bitácoras de Estatus</a></li>
                    <li id="subRegistroMarca"><a href="{{ route('registro-marcas.index') }}"><i>RM -</i> Registro de Marca</a></li>
                    <!--<li><a href=><i>BT -</i> Búsqueda Técnica</a></li>
                    <li><a href=><i>PAT -</i> Patentes</a></li>
                    <li><a href=><i>DP -</i> Dictamen Previo</a></li>
                    <li><a href=><i>RMEU -</i> Registro de Marca EU</a></li>
                    <li><a href=><i>CBAR -</i> Códigos de Barra</a></li>
                    <li><a href=><i>RO -</i> Registro de Obras</a></li>
                    <li><a href=><i>RD -</i> Reserva de Derechos</a></li>
                    <li><a href=><i>AC -</i> Aviso Comercial</a></li>
                    <li><a href=><i class="fa fa-gavel" aria-hidden="true"></i> Juicios</a></li>
                    <li><a href=><i>DI -</i> Diseño Industrial</a></li>
                    <li><a href=><i>FRAN -</i> Franquicias</a></li>-->
                </ul>
            </li>
            <li id="liFacturas" class="treeview">
                <a href="#">
                <i class="far fa-money-bill-alt"></i>
                <span> Facturación y Cobranza</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="subFacturas"><a href="{{ route('facturas.index') }}"><i class="fas fa-file-pdf"></i> Facturas</a></li>
                    <li id="subRecibos"><a href="{{ route('recibos.index') }}"><i class="fas fa-ticket-alt"></i> Recibos</a></li>
                    <li id="subDetallesFact"><a href="{{ route('detalle-facturas.index') }}"><i class="glyphicon glyphicon-th-list"></i> Detalles</a></li>
                    <li id="subCobranza"><a href="{{ route('cobranza.index') }}"><i class="far fa-money-bill-alt text-green"></i> Cobranza</a></li>
                    <li><a href=><i class="glyphicon glyphicon-pushpin text-yellow"></i> Seguimiento</a></li>
                    <li><a href=><i class="fa fa-exclamation-triangle text-yellow"></i> Cuentas por cobrar</a></li>
                </ul>
            </li>
            <li id="liEgresos" class="treeview">
                <a href="#">
                <i class="fa fa-cart-arrow-down"></i>
                <span>Egresos</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="subEgresosCategorias"><a href="{{ route('egresos-categorias.index') }}"><i class="fa fa-bookmark text-green"></i> Catálogo de egresos</a></li>
                    <li id="subProveedores"><a href="{{ route('proveedores.index') }}"><i class="fa fa-user"></i> Proveedores</a></li>
                    <li id="subEgresos"><a href="{{ route('egresos.generales') }}"><i class="fa fa-cart-arrow-down text-red"></i> Egresos</a></li>
                    <!--<li id="subDecuccion"><a href=""><i class="fas fa-minus"></i> Deducciones</a></li>-->
                    <li id="subTarjetasCredito"><a href="{{ route('tarjetas-credito.index') }}"><i class="fas fa-credit-card"></i> Tarjetas de Crédito</a></li>
                    <li id="subNomina"><a href="{{ route('comisiones.index') }}"><i class="fas fa-users"></i> Nómina y Comisiones</a></li>
                    <li id="subCxP"><a href="{{ route('cuentas-por-pagar.index') }}"><i class="fa fa-exclamation-triangle text-yellow"></i> Cuentas por pagar</a></li>
                </ul>
            </li>
            <li id="liEstadosCuenta" class="treeview">
                <a href="#">
                <i class="fas fa-adjust text-green"></i>
                <span>Estados de Cuenta</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="liCuentas"><a href="{{ route('cuentas.index') }}"><i class="glyphicon glyphicon-piggy-bank"></i> Cuentas</a></li>
                    <li id="subEstadosCuenta"><a href="{{ route('estados-cuenta.index') }}"><i class="fa fa-bookmark text-green"></i> Estado de cuenta</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                <i class="fa fa-cog"></i>
                <span>Extras</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-plane"></i> Guías</a></li>
                    <li><a href=""><i class="fa fa-clone"></i> Cuadros</a></li>
                </ul>
            </li>
            <li id="liUsuarios" class="treeview">
                <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <span class="pull-right-container">
                <span class="label label-primary pull-right">Usuarios</span>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="liPuestos"><a href="{{ route('puestos.index') }}"><i class="fa fa-sitemap"></i> Puestos</a></li>
                    <li id="liAdmin"><a href="{{ route('usuarios.index') }}"><i class="fa fa-user-secret text-blue"></i> Usuarios del sistema</a></li>
                    <li id="subComisiones"><a href="{{ route('comisiones.usuario.index') }}"><i class="far fa-money-bill-alt text-orange"></i> Comisiones</a></li>
                    <li><a href=""><i class="fa fa-id-badge"></i> Perfiles</a></li>
                    <li><a href=""><i class="fa fa-unlock-alt"></i> Accesos</a></li>
                </ul>
            </li>
            <li id="liAjustes" class="treeview">
                <a href="#">
                <i class="fa fa-cog"></i>
                <span>Ajustes</span>
                <span class="pull-right-container">
                <i class="fas fa-angle-down pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li id="liFiscal"><a href="{{ url('admin/datos-fiscales') }}"><i class="glyphicon glyphicon-qrcode"></i> Datos Fiscales</a></li>
                    <li id="liBancos"><a href="{{ route('bancos.index') }}"><i class="fas fa-university"></i> Bancos</a></li>
                    <li id="liFormasPago"><a href="{{ route('formaspago.index') }}"><i class="fas fa-credit-card"></i> Formas de Pago</a></li>
                    <li id="liMonedas"><a href="{{ route('monedas.index') }}"><i class="fas fa-hand-holding-usd text-green"></i> Monedas y tipos de cambio</a></li>
                    <li id="liPorcentajeIVA"><a href="{{ route('porcentaje-iva.index') }}"><i class="fa fa-percent"></i> Porcentaje de IVA</a></li>
                    <li id="liClases"><a href="{{ route('clases.index') }}"><i class="fa fa-address-book"></i> Clases</a></li>
                    <li id="subColores"><a href="{{ route('colores.index') }}"><i class="fas fa-pencil-alt"></i> Colores de Estatus</a></li>
                    <!--<li><a href=""><i class="fa fa-map"></i> Estados</a></li>
                        <li><a href=""><i class="fa fa-flag"></i> Países</a></li>-->
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>