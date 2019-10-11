<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MENU PRINCIPAL</li>
        <li id="home">
            <a href="{{ route('admin.emporio') }}">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
        <li id="liDireccion">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">insert_chart</i>
                <span>Dirección</span>
            </a>
            <ul class="ml-menu">
                <li id="subDirBitacoras">
                    <a href="javascript:void(0);">
                        <i class="material-icons">library_books</i>
                        <span>Bitácoras</span>
                    </a>
                </li>
                <li id="subDirEstatus">
                    <a href="javascript:void(0);">
                        <i class="material-icons">beenhere</i>
                        <span>Estatus</span>
                    </a>
                </li>
                <li id="subDirFacturacion">
                    <a href="javascript:void(0);">
                        <i class="material-icons">payment</i>
                        <span>Facturación</span>
                    </a>
                </li>
                <li id="SubDirEgresos">
                    <a href="javascript:void(0);">
                        <i class="material-icons">assignment_returned</i>
                        <span>Egresos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liClientes">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">perm_contact_calendar</i>
                <span>Clientes</span>
            </a>
            <ul class="ml-menu">
                <li id="subClienteEstrategias">
                    <a href="{{ route('estrategias.index') }}">
                        <i class="material-icons">bookmark</i>
                        <span>Estrategias</span>
                    </a>
                </li>
                <li id="subClienteClientes">
                    <a href="{{ route('clientes.index') }}">
                        <i class="material-icons">perm_contact_calendar</i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li id="subClienteRazones">
                    <a href="{{ route('clientes-razones.index') }}">
                        <i class="material-icons">chrome_reader_mode</i>
                        <span>Razones Sociales</span>
                    </a>
                </li>
                <li id="SubClienteContactos">
                    <a href="{{ route('clientes-users.index') }}">
                        <i class="material-icons">perm_identity</i>
                        <span>Contactos</span>
                    </a>
                </li>
                <li id="SubClienteMarcas">
                    <a href="{{ route('control.index') }}">
                        <i class="material-icons">wb_incandescent</i>
                        <span>Marcas</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liServicios">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Servicios</span>
            </a>
            <ul class="ml-menu">
                <li id="subServiciosCategoria">
                    <a href="{{ route('categoria-servicios.index') }}">
                        <i class="material-icons">bookmark</i>
                        <span>Categorías</span>
                    </a>
                </li>
                <li id="subServiciosCatalogo">
                    <a href="{{ route('servicios.index') }}">
                        <i class="material-icons">work</i>
                        <span>Catálogo de Servicios</span>
                    </a>
                </li>
                <li id="subServiciosControl">
                    <a href="{{ route('procesos.index') }}">
                        <i class="material-icons">assignment</i>
                        <span>Control de Servicios</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liBitacoras">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">assignment</i>
                <span>Bitácoras</span>
            </a>
            <ul class="ml-menu">
                <li id="subBitacoraCategorias">
                    <a href="">
                        <i class="material-icons">bookmark</i>
                        <span>Categorías</span>
                    </a>
                </li>
                <li id="subBitacoraTramites">
                    <a href="">
                        <i class="material-icons">playlist_add</i>
                        <span>Trámites Nuevos</span>
                    </a>
                </li>
                <li id="subBitacoraFactibilidad">
                    <a href="">
                        <i class="material-icons">playlist_add_check</i>
                        <span>Estudios de Factubilidad</span>
                    </a>
                </li>
                <li id="subBitacoraNegativas">
                    <a href="">
                        <i class="material-icons">close</i>
                        <span>Negativas</span>
                    </a>
                </li>
                <li id="subBitacoraRequisitos">
                    <a href="">
                        <i class="material-icons">sim_card_alert</i>
                        <span>Requisitos y Objeciones</span>
                    </a>
                </li>
                <li id="subBitacoraTitulos">
                    <a href="">
                        <i class="material-icons">copyright</i>
                        <span>Títulos y Certificados</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liEstatus">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">beenhere</i>
                <span>Estatus de Trámites</span>
            </a>
            <ul class="ml-menu">
                <li id="subEstatusCategorias">
                    <a href="">
                        <i class="material-icons">bookmark</i>
                        <span>Categorías</span>
                    </a>
                </li>
                <li id="subEstatusRegistros">
                    <a href="">
                        <i class="material-icons">copyright</i>
                        <span>Registros de marca</span>
                    </a>
                </li>
                <li id="subEstatusBT">
                    <a href="">
                        <span>BT</span>
                    </a>
                </li>
                <li id="subEstatusPT">
                    <a href="">
                        <i class="material-icons">photo_filter</i>
                        <span>Patentes</span>
                    </a>
                </li>
                <li id="subEstatusDP">
                    <a href="">
                        <span>DP</span>
                    </a>
                </li>
                <li id="subEstatusRMEU">
                    <a href="">
                        <span>RMEU</span>
                    </a>
                </li>
                <li id="subEstatusCodigos">
                    <a href="">
                        <i class="material-icons">line_weight</i>
                        <span>Códigos de Barra</span>
                    </a>
                </li>
                <li id="subEstatusRO">
                    <a href="">
                        <span>RO</span>
                    </a>
                </li>
                <li id="subEstatusRD">
                    <a href="">
                        <span>RD</span>
                    </a>
                </li>
                <li id="subEstatusAC">
                    <a href="">
                        <span>AC</span>
                    </a>
                </li>
                <li id="subEstatusJuicios">
                    <a href="">
                        <i class="material-icons">gavel</i>
                        <span>Juicios</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liFacturacion">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-green">credit_card</i>
                <span>Facturación y Cobranza</span>
            </a>
            <ul class="ml-menu">
                <li id="subFactFacturas">
                    <a href="">
                        <i class="material-icons">note</i>
                        <span>Facturas</span>
                    </a>
                </li>
                <li id="subFactRecibos">
                    <a href="">
                        <i class="material-icons">description</i>
                        <span>Recibos</span>
                    </a>
                </li>
                <li id="subFactCobranza">
                    <a href="">
                        <i class="material-icons">payment</i>
                        <span>Cobranza</span>
                    </a>
                </li>
                <li id="subFactCuentas">
                    <a href="">
                        <i class="material-icons">account_balance_wallet</i>
                        <span>Cuentas por cobrar</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liEgresos">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-red">credit_card</i>
                <span>Egresos</span>
            </a>
            <ul class="ml-menu">
                <li id="subEgresosCatalogo">
                    <a href="">
                        <i class="material-icons">bookmark</i>
                        <span>Catálogo</span>
                    </a>
                </li>
                <li id="subEgresosEgresos">
                    <a href="">
                        <i class="material-icons">credit_card</i>
                        <span>Egresos</span>
                    </a>
                </li>
                <li id="subEgresosDespacho">
                    <a href="">
                        <i class="material-icons">work</i>
                        <span>Despacho</span>
                    </a>
                </li>
                <li id="subEgresosPersonales">
                    <a href="">
                        <i class="material-icons">person_pin</i>
                        <span>Personales</span>
                    </a>
                </li>
                <li id="subEgresosHogar">
                    <a href="">
                        <i class="material-icons">home</i>
                        <span>Hogar</span>
                    </a>
                </li>
                <li id="subEgresosCuentas">
                    <a href="">
                        <i class="material-icons">account_balance_wallet</i>
                        <span>Cuentas por pagar</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liExtras">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">group_work</i>
                <span>Extras</span>
            </a>
            <ul class="ml-menu">
                <li id="subExtrasGuias">
                    <a href="">
                        <i class="material-icons">flight_takeoff</i>
                        <span>Guías</span>
                    </a>
                </li>
                <li id="subExtrasCuadros">
                    <a href="">
                        <i class="material-icons">photo_library</i>
                        <span>Cuadros</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liUsuarios">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">person</i>
                <span>Usuarios</span>
            </a>
            <ul class="ml-menu">
                <li id="subUserPuestos">
                    <a href="{{ route('puestos.index') }}">
                        <i class="material-icons">device_hub</i>
                        <span>Puestos</span>
                    </a>
                </li>
                <li id="subUserUsuarios">
                    <a href="{{ route('usuarios.index') }}">
                        <i class="material-icons">person</i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li id="subUserComisiones">
                    <a href="">
                        <i class="material-icons">attach_money</i>
                        <span>Comisiones</span>
                    </a>
                </li>
                <li id="subUserPerfiles">
                    <a href="">
                        <i class="material-icons">group</i>
                        <span>Perfiles</span>
                    </a>
                </li>
                <li id="subUserAccesos">
                    <a href="">
                        <i class="material-icons">assignment_ind</i>
                        <span>Accesos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="liUsuarios">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">menu</i>
                <span>Ajustes</span>
            </a>
            <ul class="ml-menu">
                <li id="subUserPuestos">
                    <a href="{{ url('admin/datos-fiscales') }}">
                        <i class="material-icons">account_balance</i>
                        <span>Datos Fiscales</span>
                    </a>
                </li>
                <li id="subUserUsuarios">
                    <a href="{{ route('cuentas.index') }}">
                        <i class="material-icons">chrome_reader_mode</i>
                        <span>Cuentas</span>
                    </a>
                </li>
                <li id="subUserComisiones">
                    <a href="{{ route('formaspago.index') }}">
                        <i class="material-icons">card_membership</i>
                        <span>Formas de pago</span>
                    </a>
                </li>
                <li id="subUserPerfiles">
                    <a href="{{ route('monedas.index') }}">
                        <i class="material-icons">attach_money</i>
                        <span>Tipos de cambio</span>
                    </a>
                </li>
                <li id="subUserAccesos">
                    <a href="{{ route('porcentaje-iva.index') }}">
                        <i>%</i>
                        <span>Porcentaje de IVA</span>
                    </a>
                </li>
                <li id="subUserAccesos">
                    <a href="{{ route('clases.index') }}">
                        <i class="material-icons">class</i>
                        <span>Clases</span>
                    </a>
                </li>
            </ul>
        </li>
        <br>
        <li>
            <a href="javascript:void(0);">

                <span style="color: #FDFDFD">Emporio Legal</span>
            </a>
        </li>
    </ul>
</div>
<!-- #Menu -->
<!-- Footer -->
<div class="legal">
    <div class="copyright">
        &copy; 2017 - 2018 <a href="http://goprofit.com.mx" target="_blank">Go Profit</a>.
    </div>
    <div class="version">
        <b>Versión: </b> 2.0
    </div>
</div>
<!-- #Footer -->