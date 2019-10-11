<?php

use Maatwebsite\Excel\Facades\Excel;
use Emporio\Exports\UsersExport;
use Emporio\Exports\EstadosCuentaExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|



Route::get('/', function () {
    return view('emporio.emporio');
});*/

//Route::get('/', 'InicioController@index')->name('index');
Route::get('/categoria-servicios', 'InicioController@categoria_servicios');
Route::get('/categoria/show/{slug}', 'InicioController@categoria_servicios_show');
Route::get('/franquicias', 'InicioController@franquicias')->name('franquicias');
Route::get('/franquicia/{id}', 'InicioController@franquicia')->name('franquicia');

// Route::view('/{any}', 'emporio.index');
// Route::view('/{any}/{any1}', 'emporio.index');
//Route::any('{all}', 'InicioController@index')->where('all', '^(?!/admin).*$');

Auth::routes();
Route::put('/login/cambiarImagen/{id}', 'AdminController@cambiarImagen');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/{slug?}', 'AdminController@index');

Route::prefix('admin')->group(function()
{
	Route::middleware(['auth'])->group(function()
	{
		//Notificaciones
		Route::get('/notificacion/servicios-pendientes', 'AutorizaServiciosController@notificacion');
		Route::get('/notificacion/servicios-juridico', 'AdminController@notificaciones_juridico');
		Route::get('/notificacion/servicios-gestion', 'AdminController@notificaciones_gestion');
		Route::get('/notificacion/servicios-operaciones', 'AdminController@notificaciones_operaciones');

		//Route::get('/{slug?}', 'AdminController@index');
		Route::get('/mostrarImagen', 'AdminController@mostrarImagen');

		//Admin Auth Routes
		Route::get('/emporio', 'AdminController@index')->name('admin.emporio');
		/*Route::post('/logout', 'Auth\AdminLoginController@loggetout')->name('admin.logout');*/

		//Dirección
		Route::get('/direccion', 'DireccionController@direccion')->name('direccion');
		Route::get('/direccion/mensual/{anio}', 'DireccionController@mensual');
		Route::get('/direccion/anio', 'DireccionController@anio_actual');
		//Comisiones
		Route::get('/direccion/comisiones', 'DireccionController@comisiones')->name('direccion.comisiones');
		Route::get('/direccion/comisiones-listado/{estatus}/{id_admin}', 'DireccionController@listar_usuario');
		Route::get('/direccion/comisiones-listado/total/{estatus}/{id_admin}', 'DireccionController@listar_usuario_total');
		Route::get('/direccion/comisiones-buscar/{estatus}/{id_admin}/{buscar}', 'DireccionController@buscar_usuario');
		Route::get('/direccion/comisiones-buscar/total/{estatus}/{id_admin}/{buscar}', 'DireccionController@buscar_usuario_total');
		Route::get('/direccion/comisiones-actualizar/{id}', 'DireccionController@actualizar_comision');
		Route::put('/direccion/comision-liberar/{id}', 'DireccionController@liberar_comision');
		Route::put('/direccion/comision-pendiente/{id}', 'DireccionController@pendiente_comision');
		Route::put('/direccion/comision-monto/{id}', 'DireccionController@editar_monto_comision');
		//Sueldos
		Route::get('/direccion/sueldos', 'DireccionController@sueldos')->name('direccion.sueldos');
		Route::get('/direccion/sueldos-listado/{estatus}', 'DireccionController@listar');
		Route::get('/direccion/sueldos-actualizar/{id}', 'DireccionController@actualizar');
		Route::put('/direccion/sueldos-update/{id}', 'DireccionController@sueldos_update');
		Route::delete('/direccion/sueldos-estatus/{id}', 'DireccionController@empleado_estatus');
		//Metas
		Route::get('/metas', 'MetasController@index')->name('metas.index');
		//Indicadores
		Route::get('/indicadores/direccion', 'IndicadoresController@index')->name('indicadores.index');
		Route::get('/indicadores/estados-cuenta/{anio}', 'IndicadoresController@direccion_estados');
		Route::get('/indicadores/servicios-metas/{anio}', 'IndicadoresController@servicios_metas');
		Route::get('/indicadores/ventas-metas/{anio}', 'IndicadoresController@ventas_metas');
		Route::get('/indicadores/get-egresos/{anio}', 'IndicadoresController@get_egresos');
		Route::get('/indicadores/tramites', 'IndicadoresController@tramites')->name('indicadores.tramites');
		Route::post('/indicadores/tramites-list', 'IndicadoresController@tramites_usuario');

		//Users
		Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
		Route::get('/usuarios-listado/{estatus}', 'UserController@listado');
		Route::get('/usuarios-buscar/{buscar}', 'UserController@buscar');
		Route::get('/usuarios-actualizar/{id}', 'UserController@actualizar');
		Route::post('/usuarios/store', 'UserController@store');
		Route::get('/usuarios/edit/{id}', 'UserController@edit');
		Route::put('/usuarios/update/{id}', 'UserController@update');
		Route::put('/usuarios/estatus/{id}', 'UserController@estatus');
		Route::post('/usuarios/puestos', 'UserController@puestos')->name('usuarios.puesto');
		Route::put('/usuarios/contra/{id?}', 'UserController@contra')->name('usuarios.contra');
		Route::get('/perfil', 'UserController@perfil')->name('admin.perfil');
		Route::put('/usuarios/upload/{id}', 'UserController@upload')->name('usuarios.upload');
		Route::put('/perfil/{id}', 'UserController@perfil_update')->name('admin.perfil_update');

		Route::get('/usuarios/export', function(){
			return Excel::download(new UsersExport, 'users.xlsx');
		});

		//Catálogos
		Route::resource('/formaspago', 'FormasPagoController');
		Route::resource('/datos-fiscales', 'EmporioController');
		Route::resource('/monedas', 'MonedasController');
		Route::resource('/porcentaje-iva', 'PorcentajeIVAController');
		Route::resource('/puestos', 'PuestosController');
		Route::resource('/bancos', 'BancosController');

		//Subcategorías
		Route::get('/subcategorias', 'SubcategoriaController@index')->name('subcategorias.index');
		Route::get('/subcategorias-listar', 'SubcategoriaController@listar');
		Route::get('/subcategorias-actualizar/{id}', 'SubcategoriaController@actualizar');
		Route::get('/subcategorias/edit/{id}', 'SubcategoriaController@edit');
		Route::post('/subcategorias/store', 'SubcategoriaController@store');
		Route::put('/subcategorias/update/{id}', 'SubcategoriaController@update');
		Route::delete('/subcategorias/estatus/{id}', 'SubcategoriaController@estatus');

		//Cuentas
		//Route::resource('/cuentas', 'CuentasController');
		Route::get('/cuentas', 'CuentasController@index')->name('cuentas.index');
		Route::get('/cuentas-listar', 'CuentasController@listar');
		Route::post('/cuentas/store', 'CuentasController@store');
		Route::get('/cuentas/{id}/edit', 'CuentasController@edit');
		Route::put('/cuentas/update/{id}', 'CuentasController@update');
		Route::delete('/cuentas/destroy/{id}', 'CuentasController@destroy');

		//Servicios y comisiones
		Route::get('/servicios', 'CatalogoServiciosController@index')->name('servicios.index');
		Route::get('/servicios/listado/{estatus}', 'CatalogoServiciosController@listado');
		Route::get('/servicios/buscar/{estatus}/{buscar}', 'CatalogoServiciosController@buscar');
		Route::get('/servicios/exportar/{estatus}/{buscar}', 'CatalogoServiciosController@exportar');
		Route::get('/servicios/actualizar/{id}', 'CatalogoServiciosController@actualizar');
		Route::get('/servicios/subcategoria/{id_cat}', 'CatalogoServiciosController@subcategoria');
		Route::get('/servicios-comisiones', 'ServiciosComisionesController@index')->name('servicios-comisiones.index');
		Route::get('/servicios/create', 'CatalogoServiciosController@create')->name('servicios.create');
		Route::post('/servicios/store', 'CatalogoServiciosController@store')->name('servicios.store');
		Route::get('/servicios/edit/{id}', 'CatalogoServiciosController@edit')->name('servicios.edit');
		Route::get('/servicios/show/{id}', 'CatalogoServiciosController@show')->name('servicios.show');
		Route::put('/servicios/update/{id}', 'CatalogoServiciosController@update')->name('servicios.update');
		Route::delete('/servicios/destroy/{id}', 'CatalogoServiciosController@destroy');
		//Comisiones
		Route::get('/servicios-comisiones/listado/{estatus}', 'ServiciosComisionesController@listado');
		Route::get('/servicios-comisiones/buscar/{estatus}/{buscar}', 'ServiciosComisionesController@buscar');
		Route::get('/servicios-comisiones/actualizar/{id}', 'ServiciosComisionesController@actualizar');

		//Requisitos de Servicios
		Route::get('/servicios/edit-requisito/{id}', 'CatalogoServiciosController@edit_requisito')->name('servicios.requisitos');
		Route::get('/servicios/requisitos-options/{id}', 'CatalogoServiciosController@requisitos_options');
		Route::get('/servicios/cargar-requisitos/{id}', 'CatalogoServiciosController@cargar_requisitos');
		Route::get('/servicios/requisitos', 'CatalogoServiciosController@requisitos_listado');
		Route::post('/servicios/requisitos/store', 'CatalogoServiciosController@store_requisito');
		Route::put('/servicios/requisitos/update/{id}', 'CatalogoServiciosController@update_requisito');
		Route::post('/servicios/requisitos/insertar', 'CatalogoServiciosController@insertar_requisito');
		Route::put('/servicios/requisitos/eliminar/{id}', 'CatalogoServiciosController@eliminar_requisito');
		Route::put('/servicios/requisitos/subir-orden/{id}/{orden}', 'CatalogoServiciosController@requisito_subir');
		Route::put('/servicios/requisitos/bajar-orden/{id}/{orden}', 'CatalogoServiciosController@requisito_bajar');
		//Requisitos liberar comisiones
		Route::put('/servicios/requisitos/liberar-comisiones/{num}/{id}/{id_catalogo_servicio}', 'CatalogoServiciosController@liberar_comisiones');

		//Comisiones
		Route::get('/comisiones/monto-restante/{id}', 'ProcesosController@valorComisionRestante');
		Route::get('/comisiones/listadoComisiones/{id}', 'ProcesosController@listadoComisiones');
		
		//Estrategias
		Route::get('/estrategias', 'EstrategiasController@index')->name('estrategias.index');
		Route::get('/estrategias-listado', 'EstrategiasController@listado');
		Route::post('/estrategias/store', 'EstrategiasController@store');
		Route::get('/estrategias/edit/{id}', 'EstrategiasController@edit');
		Route::put('/estrategias/update/{id}', 'EstrategiasController@update');
		Route::delete('/estrategias/status/{id}', 'EstrategiasController@status');

		//Clientes
		Route::get('/clientes', 'ClientesController@index')->name('clientes.index');
		Route::get('/clientes-listar', 'ClientesController@listar');
		Route::get('/clientes-buscar/{buscar}', 'ClientesController@buscar');
		Route::get('/clientes-actualizar/{id}', 'ClientesController@actualizar');
		Route::get('/clientes/getLogo/{id}', 'ClientesController@getLogo');
		Route::get('/clientes/getSaldo/{id}', 'ClientesController@getSaldo');
		Route::post('/clientes/cargarLogo/{id}', 'ClientesController@cargarLogo');
		Route::post('/clientes/store', 'ClientesController@store')->name('clientes.store');
		Route::get('/clientes/edit/{id}', 'ClientesController@edit');
		Route::put('/clientes/update/{id}', 'ClientesController@update')->name('clientes.update');
		Route::delete('/clientes/status/{id}', 'ClientesController@status');
		Route::put('/clientes/carpeta/{id}', 'ClientesController@carpeta');
		Route::get('/clientes/saldo/{id}', 'ClientesController@saldos');

		//Razones sociales
		Route::get('/clientes/razones-listado/{id}', 'ClientesController@razones_index');
		Route::post('/clientes/razones-insertar', 'ClientesController@razon_insertar');
		Route::put('/clientes/razones-actualizar/{id}', 'ClientesController@razon_actualizar');
		Route::delete('/clientes/razon-status/{id}', 'ClientesController@razon_status');

		//Marcas
		Route::get('/clientes/marcas-listado/{id}', 'ClientesController@marcas_index');
		Route::post('/clientes/marcas-insertar', 'ClientesController@marcas_insertar');
		Route::put('/clientes/marcas-actualizar/{id}', 'ClientesController@marcas_actualizar');
		Route::delete('/clientes/marca-status/{id}', 'ClientesController@marca_status');

		//Contactos
		Route::get('/clientes/contactos-listado/{id_cliente}', 'ClientesController@listado_contactos');
		Route::post('/clientes/contactos/insertar', 'ClientesController@contactos_insertar');
		Route::put('/clientes/contactos/editar/{id}', 'ClientesController@contactos_editar');

		Route::resource('/clientes-users', 'ClienteUsersController');
		Route::resource('/clientes-razones', 'ClienteRazonesController');
		Route::put('/clientes-users/user/{clientes_user}', 'ClienteUsersController@activar_inactivar')->name('clientes-users.activar_inactivar');
		
		Route::put('/clientes/subcarpeta/{id?}', 'ClienteRazonesController@subcarpeta')->name('subcarpeta');
		Route::put('/clientes/razones/correo/{id?}', 'ClienteRazonesController@correo')->name('razon.correo');
		Route::put('/clientes/correo/{id?}', 'ClientesController@correo')->name('clientes.correos');
		Route::post('/clientes/crear-estrategia/', 'ClientesController@estrategia_crear')->name('crear-estrategia');
		Route::get('/clientes/editar-creado/{id?}/cliente', 'ClientesController@edit_creado')->name('clientes.edit-creado');
		Route::get('/clientes/cliente/usuarios/{id?}', 'ClientesController@clientes_usuarios')->name('clientes.usuarios');
		Route::post('/clientes/cliente/usuarios/crear', 'ClientesController@usuarios_crear');
		Route::post('/clientes/cliente/usuarios/{id?}', 'ClientesController@usuarios_crear');
		Route::get('/clientes/cliente/usuarios/{id?}/edit', 'ClientesController@user_index')->name('clientes-users');
		Route::get('/clientes/cliente/razones/{id?}/edit', 'ClientesController@razones_index')->name('clientes-razones');
		Route::get('/clientes/cliente/marcas/{id?}/edit', 'ClientesController@marcas_index')->name('clientes-marcas');
		
		Route::get('clientes/marca/servicio/{id?}', 'ControlController@create_servicio')->name('create_servicio');
		Route::post('clientes/marca/servicio/store', 'ControlController@store_servicio')->name('store_servicio');
		Route::post('/clientes/insertar-razon', 'ClienteRazonesController@insertar_razon')->name('clientes.insertar-razon');

		Route::resource('/clases', 'ClasesController');
		Route::resource('/categoria-servicios', 'CategoriaServiciosController');
		Route::resource('/control', 'ControlController');
		Route::post('/clientes/crear-control', 'ControlController@clientes')->name('clientes.control');
		//Control de servicios manual
		Route::get('/control-servicios', 'ControlServiciosController@index')->name('control.servicios');




		//Procesos
		Route::resource('/procesos', 'ProcesosController');
		Route::post('/procesos/store-post', 'ProcesosController@post')->name('procesos.post');
		Route::get('/procesos/getstatus/{id}', 'ProcesosController@getStatus');
		Route::get('/procesos-listar/{estatus}/{tramite}/{fecha_inicio}/{fecha_fin}/{folio}', 'ProcesosController@listar')->name('procesos-listar');
		Route::get('/procesos-buscar/{estatus}/{tramite}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'ProcesosController@buscar')->name('procesos-buscar');
		Route::get('/procesos/actualizar/{id_servicio}', 'ProcesosController@servicioActualizar');


		Route::get('/procesos/descuentoCliente/{id_cliente}/{id_catalogo_servicio}', 'ProcesosController@descuentoCliente');
		Route::post('/procesos/crear-cliente', 'ProcesosController@cliente')->name('procesos.cliente');
		Route::post('/procesos/crear-marca', 'ProcesosController@marca')->name('procesos.marca');
		Route::get('/procesos/marcas/{id}', 'ProcesosController@getMarcas');
		Route::get('/procesos/facturas-cliente/{id}', 'ProcesosController@getFacturas');
		Route::get('/procesos/listadoProceso/{id}', 'ProcesosController@listadoProceso');
		Route::post('/procesos/insertarProceso', 'ProcesosController@insertarProceso');
		Route::put('/procesos/editar-avance-total/{id}', 'ProcesosController@avance_total');
		Route::get('/procesos/edit-comisiones/{proceso}', 'ProcesosController@edit_creado')->name('procesos.edit-creado');
		Route::post('/procesos/crear-comisiones', 'ProcesosController@insertar_comision');
		Route::delete('/procesos/cancelar-comision/{id}', 'ProcesosController@cancelar_comision');
		Route::get('/procesos/editar-comision/{id_comision}', 'ProcesosController@editar_comision');
		Route::put('/procesos/actualizar-comision/{id_comision}', 'ProcesosController@actualizar_comision');
		Route::post('/procesos/ver-detalles', 'ProcesosController@getDetalles')->name('procesos.detalles');
		Route::post('/procesos/insertar-cliente', 'ProcesosController@insertar_cliente')->name('procesos.insertar-cliente');
		Route::post('/procesos/insertar-marca', 'ProcesosController@insertar_marca');
		Route::get('/procesos/get-clientes', 'ProcesosController@getClientes');
		Route::get('/procesos/servicios/clientes/{cliente}', 'ProcesosController@getServicios');
		Route::get('/procesos/servicios/cargar_clientes', 'ProcesosController@cargar_clientes');
		Route::get('/procesos/servicios/cargar_servicios', 'ProcesosController@cargar_servicios');

		Route::get('/procesos/cargarDatosFactura/{id_fact}', 'ProcesosController@cargarDatosFactura');
		Route::get('/procesos/cargarRazonSocial/{id_cliente}', 'ProcesosController@cargarRazonSocial');
		Route::get('/procesos/cargarFacturas/{id_cliente}', 'ProcesosController@cargarFacturas');
		Route::get('/procesos/cargarServiciosFactura/{id_factura}/{estatus}/{id_cliente}', 'ProcesosController@cargarServiciosFactura');
		Route::get('/procesos/cargarRecibos/{id_cliente}', 'ProcesosController@cargarRecibos');
		Route::get('/procesos/cargarDetalles/{id_factura}', 'ProcesosController@cargarDetalles');
		Route::get('/procesos/serviciosPendientes/{id_cliente}', 'ProcesosController@serviciosPendientes');
		Route::post('/procesos/crear-factura', 'ProcesosController@crearFactura');
		Route::post('/procesos/crear-recibo', 'ProcesosController@crearRecibo');
		Route::post('/procesos/razon-social', 'ProcesosController@crearRazon');
		Route::put('/procesos/actualizar-tipo-cambio/{clave}', 'ProcesosController@actualizarTipoCambio');
		Route::post('/procesos/facturar-servicio', 'ProcesosController@insertarFactura');
		Route::put('/procesos/factura-actualizar/{id_factura}', 'ProcesosController@actualizarFactura');
		Route::post('/procesos/recibir-servicio', 'ProcesosController@insertarRecibo');
		Route::post('/procesos/agregar-ingreso', 'ProcesosController@agregarIngreso');
		Route::get('/procesos/cobros-cargar/{id_cliente}', 'ProcesosController@cargarCobros');
		Route::get('/procesos/cobros-datos/{id}', 'ProcesosController@datosCobranza');
		Route::get('/procesos/cobros-detalles/{id_cobranza}/{id_cliente}', 'ProcesosController@cargarDetallesCobro');
		Route::get('/procesos/facturas-pendientes/{id_cliente}', 'ProcesosController@cargarFacturasPendientesCobro');
		Route::put('/procesos/actualizar-cobro/{id}', 'ProcesosController@actualizarCobro');
		Route::post('/procesos/insertar-factura-cobro', 'ProcesosController@insertar_factura_cobro');
		//Facturas en servicios
		Route::get('/procesos/servicios-factura/{id_cliente}', 'ProcesosController@servicio_facturas');
		Route::get('/procesos/servicios-recibo/{id_cliente}', 'ProcesosController@servicio_recibos');
		Route::get('/procesos/factura-getSaldo/{id}', 'ProcesosController@getSaldoFactura');
		Route::post('/procesos/servicios-insertar-factura', 'ProcesosController@servicio_folio_factura_nuevo');
		Route::post('/procesos/servicios-insertar-recibo', 'ProcesosController@servicio_folio_recibo_nuevo');
		Route::put('/procesos/cambiar-iva-factura/{id}', 'ProcesosController@cambiar_iva_factura');
		Route::put('/procesos/servicios-folio-existente/{id}', 'ProcesosController@servicio_folio_existente');
		Route::put('/procesos/servicios-editar-detalle/{id}', 'ProcesosController@editar_detalle');
		Route::put('/procesos/update-factura/{id}', 'ProcesosController@update_factura_pagada');
		//Cobro de facturas o recibos
		Route::put('/procesos/pagar-factura/{id}', 'ProcesosController@pagar_factura');
		Route::put('/procesos/liberar-factura/{id}', 'ProcesosController@liberar_factura');
		Route::put('/procesos/quitar-servicio-factura/{id}', 'ProcesosController@quitar_servicio');

		//Autoriza Servicios
		Route::get('/autoriza-servicios', 'AutorizaServiciosController@index')->name('autoriza-servicios');
		Route::get('/autoriza-servicios-listar', 'AutorizaServiciosController@listar');
		Route::get('/autoriza-servicios-buscar/{buscar}', 'AutorizaServiciosController@buscar');
		Route::get('/autoriza-servicios-exportar', 'AutorizaServiciosController@exportar');
		Route::put('/autorizar-servicio/{id}', 'AutorizaServiciosController@AutorizarServicio');

		//Comentarios
		Route::get('/procesos/comentarios/{id_servicio}', 'ProcesosController@comentarios');
		Route::get('/estatus/comentarios/{id_servicio}', 'EstatusController@comentarios');
		Route::post('/procesos/comentarios/agregar', 'ProcesosController@insertarComentario');
		Route::delete('/procesos/comentarios/eliminar/{id}', 'ProcesosController@eliminarComentario');
		Route::put('/procesos/comentarios/actualizar/{id}', 'ProcesosController@actualizarComentario');

		//Bitacoras
		Route::get('/bitacoras', 'BitacorasController@index')->name('bitacoras.index');
		Route::get('/bitacoras/procesos-listado/{id}/{id_catalogo_servicio}', 'BitacorasController@procesos_listado');
		Route::put('/bitacoras/check_process/{id}', 'BitacorasController@check_process');
		Route::put('/bitacoras/uncheck_process/{id}', 'BitacorasController@uncheck_process');
		Route::put('/bitacoras/guardar_estatus/{id}', 'BitacorasController@guardar_estatus');
		Route::post('/bitacoras/logo-insertar/{id}', 'BitacorasController@postLogo')->name('post.logo');
		Route::post('/bitacora/crear_estatus', 'BitacorasController@crear_estatus');
		Route::put('/bitacora/editar_estatus/{id}', 'BitacorasController@editar_estatus');
		Route::get('/bitacoras/negativas-vencimiento/{id}', 'BitacorasController@negativasVencimiento');
		Route::put('/bitacoras/guardar-vencimiento/{id}', 'BitacorasController@GuardarVencimiento');
		//Check list bitácoras
		Route::get('/check-list/{variable}', 'BitacorasController@check_list')->name('check-list');
		Route::get('/check-list/listado/{estatus}/{tramite}/{pendiente}', 'BitacorasController@check_list_listado');
		Route::get('/check-list/buscar/{estatus}/{tramite}/{pendiente}/{buscar}', 'BitacorasController@check_list_buscar');
		Route::get('/check-list/detalles/{id}', 'BitacorasController@check_list_detalles');
		Route::get('/check-list/edit/{id}', 'BitacorasController@edit_requisito')->name('check-list.edit');
		Route::get('/check-list/vacio/{id}', 'BitacorasController@edit_requisito_vacio')->name('check-list.vacio');
		Route::get('/check-list/catalogo/{id}', 'BitacorasController@getCatalogoServicio');
		//Check list proceso
		Route::get('/check-list/requisitos-options/{id}', 'BitacorasController@requisitos_options');
		Route::get('/check-list/cargar-requisitos/{id}', 'BitacorasController@cargar_requisitos');
		Route::get('/check-list/requisitos', 'BitacorasController@requisitos_listado');
		Route::post('/check-list/requisitos/insertar', 'BitacorasController@insertar_requisito');
		Route::put('/check-list/requisitos/eliminar/{id}', 'BitacorasController@eliminar_requisito');
		Route::put('/check-list/requisitos/subir-orden/{id}/{orden}', 'BitacorasController@requisito_subir');
		Route::put('/check-list/requisitos/bajar-orden/{id}/{orden}', 'BitacorasController@requisito_bajar');
		Route::put('/check-gestionar-pago/{id}', 'BitacorasController@gestionar_pago');

		//Requisitos liberar comisiones
		Route::put('/check-list/requisitos/liberar-comisiones/{num}/{id}/{id_catalogo_servicio}', 'BitacorasController@liberar_comisiones');

		//Bitacora Tramites nuevos
		Route::get('/bitacora/tramites-nuevos-listar/{estatus}/{tramite}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@tramites_nuevos_listar');
		Route::get('/bitacora/tramites-nuevos-buscar/{estatus}/{tramite}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@tramites_nuevos_buscar');
		Route::get('/bitacora/tramites-nuevos-actualizar/{id}', 'BitacorasController@tramites_nuevos_actualizar');

		//Bitacora Estudios de Factibilidad
		Route::get('/bitacora/estudios-factibilidad-listar/{estatus}/{tramite}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@estudios_factibilidad_listar');
		Route::get('/bitacora/estudios-factibilidad-buscar/{estatus}/{tramite}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@estudios_factibilidad_buscar');
		Route::get('/bitacora/estudios-factibilidad-actualizar/{id}', 'BitacorasController@estudios_factibilidad_actualizar');

		//Bitacora de Negativas
		Route::get('/bitacora/negativas-listar/{estatus}/{tramite}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@negativas_listar');
		Route::get('/bitacora/negativas-buscar/{estatus}/{tramite}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@negativas_buscar');
		Route::get('/bitacora/negativas-actualizar/{id}', 'BitacorasController@negativas_actualizar');

		//Bitacora de Requisitos y Objeciones
		Route::get('/bitacora/requisitos-listar/{estatus}/{tramite}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@requisitos_listar');
		Route::get('/bitacora/requisitos-buscar/{estatus}/{tramite}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@requisitos_buscar');
		Route::get('/bitacora/requisitos-actualizar/{id}', 'BitacorasController@requisitos_actualizar');

		//Bitacora de Títulos y Certificados
		Route::get('/bitacora/titulos-listar/{estatus}/{tramite}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@titulos_listar');
		Route::get('/bitacora/titulos-buscar/{estatus}/{tramite}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'BitacorasController@titulos_buscar');
		Route::get('/bitacora/titulos-actualizar/{id}', 'BitacorasController@titulos_actualizar');


		Route::resource('/bitacora/tramites-nuevos', 'Bitacoras\TramitesNuevosController');
		
		Route::get('/bitacora/tramites-nuevos-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'Bitacoras\TramitesNuevosController@buscar');
		Route::get('/bitacora/tramites-nuevos/servicio-actualizar/{id_servicio}', 'Bitacoras\TramitesNuevosController@actualizarServicio');
			//Modales
		Route::get('/bitacoras/getServicio/{id}', 'Bitacoras\TramitesNuevosController@getServicio');
		Route::post('/bitacoras/tramites-nuevos/formato/{id}', 'Bitacoras\TramitesNuevosController@formato');
		Route::get('/bitacoras/tramites-nuevos/logo/{id}', 'Bitacoras\TramitesNuevosController@getLogo');
		
		Route::post('/bitacora/tramites-nuevos/recepcion/{servicio}', 'Bitacoras\TramitesNuevosController@recepcion')->name('bitacora.recepcion');
		Route::post('/bitacora/tramites-nuevos/elaboracion-expediente/{servicio}', 'Bitacoras\TramitesNuevosController@elaboracion_expediente')->name('bitacora.elaboracion-expediente');
		Route::post('/bitacora/tramites-nuevos/enviar-estatus', 'Bitacoras\TramitesNuevosController@enviar_estatus')->name('bitacora.enviar-estatus');
		Route::put('/bitacoras/cambiar_status/{id}', 'Bitacoras\TramitesNuevosController@activar_cancelar');


		//Bitacora Estudios de Factibilidad
		Route::get('/bitacora/estudios-factibilidad', 'Bitacoras\EstudiosFactibilidadController@index')->name('estudios-factibilidad.index');
		Route::get('/bitacora/estudios-factibilidad-listar/{estatus}/{fecha_inicio}/{fecha_fin}/{folio}', 'Bitacoras\EstudiosFactibilidadController@listar');
		Route::get('/bitacora/estudios-factibilidad-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}/{folio}', 'Bitacoras\EstudiosFactibilidadController@buscar');
		Route::get('/bitacora/estudios-factibilidad/servicio-actualizar/{id_servicio}', 'Bitacoras\EstudiosFactibilidadController@actualizarServicio');

			//Modales
		Route::post('/bitacora/estudios-factibilidad/recepcion-alta/{servicio}', 'Bitacoras\EstudiosFactibilidadController@recepcion');
		Route::post('/bitacora/estudios-factibilidad/registro/{servicio}', 'Bitacoras\EstudiosFactibilidadController@registro');

		//Bitacora de Negativas
		Route::get('/bitacora/negativas', 'Bitacoras\NegativasController@index')->name('negativas.index');
		Route::get('/bitacora/negativas-listar/{estatus}/{fecha_inicio}/{fecha_fin}', 'Bitacoras\NegativasController@listar');
		Route::get('/bitacora/negativas-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}', 'Bitacoras\NegativasController@buscar');
		Route::get('/bitacora/negativas/actualizar-servicio/{id_servicio}', 'Bitacoras\NegativasController@actualizarServicio');
		Route::post('/bitacora/negativas/alta-estatus/{id_servicio}', 'Bitacoras\NegativasController@alta_estatus');
		Route::post('/bitacora/negativas/elaboracion-notificacion/{id_servicio}', 'Bitacoras\NegativasController@elaboracion_notificacion');
		Route::post('/bitacora/negativas/revision/{id_servicio}', 'Bitacoras\NegativasController@revision');
		Route::post('/bitacora/negativas/envio-notificacion/{id_servicio}', 'Bitacoras\NegativasController@envio_notificacion');
		Route::post('/bitacora/negativas/registro/{id_servicio}', 'Bitacoras\NegativasController@registro');


		//Bitacora Requisitos y Objeciones
		Route::get('/bitacora/requisitos-objeciones', 'Bitacoras\RequisitosController@index')->name('requisitos.index');
		Route::get('/bitacora/requisitos-listar/{estatus}/{fecha_inicio}/{fecha_fin}', 'Bitacoras\RequisitosController@listar');
		Route::get('/bitacora/requisitos-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}', 'Bitacoras\RequisitosController@buscar');
		Route::get('/bitacora/requisitos/actualizar-servicio/{id_servicio}', 'Bitacoras\RequisitosController@actualizarServicio');

		//Modales
		Route::post('/bitacora/requisitos/modal/{id_servicio}', 'Bitacoras\RequisitosController@Requisitos');
		Route::post('/bitacora/requisitos/notificacion/{id_servicio}', 'Bitacoras\RequisitosController@Notificacion');
		Route::post('/bitacora/requisitos/revision/{id_servicio}', 'Bitacoras\RequisitosController@Revision');
		Route::post('/bitacora/requisitos/terminar/{id_servicio}', 'Bitacoras\RequisitosController@Terminar');


		//Bitacora de Titulos y Certificados
		Route::get('/bitacora/titulos-y-certificados', 'Bitacoras\TitulosyCertificadosController@index')->name('titulos.index');
		Route::get('/bitacora/titulos-listar/{estatus}/{fecha_inicio}/{fecha_fin}', 'Bitacoras\TitulosyCertificadosController@listar');
		Route::get('/bitacora/titulos-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}', 'Bitacoras\TitulosyCertificadosController@buscar');
		Route::get('/bitacora/titulos/actualizar-servicio/{id_servicio}', 'Bitacoras\TitulosyCertificadosController@actualizarServicio');

		//modales
		Route::post('/bitacora/titulos/alta-estatus/{id_servicio}', 'Bitacoras\TitulosyCertificadosController@Alta_Estatus');
		Route::post('/bitacora/titulos/entrega/{id_servicio}', 'Bitacoras\TitulosyCertificadosController@EntregaTitulo');





		//Proveedores
		Route::resource('/proveedores', 'ProveedoresController');


		//Egresos e Ingresos

		//Egresos Generales
		Route::get('/egresos-listado/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EgresosController@listado');
		Route::get('/egresos-listado/total/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EgresosController@listado_total');
		Route::get('/egresos-buscar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EgresosController@buscar');
		Route::get('/egresos-buscar/total/{estatus}/{tipo}/{cuenta}/{forma_pago}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EgresosController@buscar_total');
		Route::get('/egresos-actualizar/{id}', 'EgresosController@actualizar');
		Route::post('/egresos/store', 'EgresosController@store');
		Route::get('/egresos/edit/{id}', 'EgresosController@edit');
		Route::put('/egresos/update/{id}', 'EgresosController@update');
		Route::put('/egresos/estatus/{id}', 'EgresosController@estatus');
		Route::get('/egresos/ultimo-orden', 'EgresosController@ultimoOrden');
		Route::get('/egresos/proveedores/{variable}', 'EgresosController@cargarProveedores');
		Route::get('/egresos/servicios-pendientes/{id_egreso}', 'EgresosController@cargarPagosPendientes');
		Route::post('/egresos/agregarProveedor', 'EgresosController@agregarProveedor');
		//Pago de Servicios
		Route::post('/egresos/insertar-pago', 'EgresosController@insertar_pago_servicios');
		Route::put('/egresos/pago-servicio/{id}', 'EgresosController@pago_servicio');
		Route::put('/egresos/quitar-pago-servicio/{id_pago}/{id}', 'EgresosController@quitar_pago_servicio');
		//Comisiones
		Route::get('/egresos/comisiones/cargarServiciosPendientes/{id_admin}/{id_egreso}', 'EgresosController@cargarServiciosPendientes');
		Route::post('/egresos/comision-insertar', 'EgresosController@insertarComision');
		Route::post('/egresos/comision-insertar2', 'EgresosController@insertarComision2')->name('insertar.comision');
		Route::put('/egresos/comision-editar/{id}/{id_comision}', 'EgresosController@actualizarComision');
		Route::put('/egresos/quitar-comision/{id}', 'EgresosController@QuitarComision');
		Route::get('/egresos/usuarios-comision', 'EgresosController@cargarUsuariosComision');
		Route::put('/egresos/ConceptoComision/{id}', 'EgresosController@ConceptoComision');
		//Nomina
		Route::get('/egresos/mostrar-empleados', 'EgresosController@mostrar_empleados');
		Route::get('/egresos/mostrar-empleados-nomina/{id}', 'EgresosController@mostrar_empleados_nomina');
		Route::get('/egresos/mostrar-empleados-aguinaldo', 'EgresosController@mostrar_empleados_aguinaldo');
		Route::post('/egresos/insertarNomina', 'EgresosController@insertarNomina');
		Route::post('/egresos/insertarNominas', 'EgresosController@insertarNominas');
		Route::put('/egresos/updateNomina/{id}', 'EgresosController@updateNomina');
		//Traspasos
		Route::post('/egresos/traspasos-insertar', 'EgresosController@insertarTraspaso');
		Route::put('/egresos/traspasos-editar/{id}', 'EgresosController@editarTraspaso');
		//Estados de cuenta
		Route::get('/estados-cuenta-listar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@listar');
		Route::get('/estados-cuenta-listar/total/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@listar_total');
		Route::get('/estados-cuenta-buscar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@buscar');
		Route::get('/estados-cuenta-buscar/total/{estatus}/{tipo}/{cuenta}/{forma_pago}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@buscar_total');
		Route::get('/estados-cuenta-exportar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@exportar');
		// Route::get('/estados-cuenta-exportar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', function()
		// 	{
		// 		$estados_cuenta = new EstadosCuentaExport($estatus, $tipo, $cuenta, $forma_pago, $fecha_inicio, $fecha_fin);
		// 		return $estados_cuenta->download('estados-cuenta.xlsx');
		// 	});

		//Ingresos
		Route::get('/ingresos-listado/{estatus}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@ingresos_listar');
		Route::get('/ingresos-listado/total/{estatus}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@ingresos_listar_total');
		Route::get('/ingresos-buscar/{estatus}/{cuenta}/{forma_pago}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@ingresos_buscar');
		Route::get('/ingresos-buscar/total/{estatus}/{cuenta}/{forma_pago}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@ingresos_buscar_total');
		Route::get('/ingresos-actualizar/{id}', 'EstadosCuentaController@ingresos_actualizar');
		Route::get('/ingresos-facturas-pendientes/{id_cliente}/{id_ingreso}', 'EstadosCuentaController@facturas_recibos');
		Route::post('/ingresos/store', 'EstadosCuentaController@store');
		Route::get('/ingresos/edit/{id}', 'EstadosCuentaController@edit');
		Route::put('/ingresos/update/{id}', 'EstadosCuentaController@update');
		Route::put('/ingresos/cancelar/{id}', 'EstadosCuentaController@cancelar');


		/*Route::resource('/egresos-categorias', 'CategoriaEgresosController');
		//Route::get('/egresos', 'EgresosGeneralesController@index')->name('egresos.generales');
		Route::get('/egreso/{id}/edit', 'EgresosGeneralesController@edit');
		Route::get('/egresos-listar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EgresosGeneralesController@listar');
		
		Route::get('/egresos-exportar/{estatus}/{tipo}/{cuenta}/{forma_pago}/{fecha_inicio}/{fecha_fin}', 'EgresosGeneralesController@exportar');
		Route::get('/egresos/actualizar-egreso/{id_egreso}', 'EgresosGeneralesController@actualizarEgreso');
		Route::get('/egresos-mostrar-servicios/{aplicar_servicios}', 'EgresosGeneralesController@mostrarServiciosPendientes');
		Route::get('/egresos-mostrar-pagados/{id_egreso}', 'EgresosGeneralesController@mostrarServiciosPagados');
		Route::get('/egreso-creado/{get}', 'EgresosGeneralesController@egreso_creado');
		
		Route::post('/egresos/insertar-servicio', 'EgresosGeneralesController@InsertarServicio');

		//Route::post('/egresos-crear-categoria', 'EgresosController@categoria')->name('egresos.categoria.crear');
		//Route::get('/egresos/servicios/{id}', 'EgresosController@getServicios');
		Route::get('/egresos/categorias/{estatus}', 'EgresosGeneralesController@cargarCategorias');
		Route::get('/egresos/categorias-egresos/{tipo}', 'EgresosGeneralesController@getTipoEgreso');
		//Route::get('/egresos/servicios-edit/{id}', 'EgresosController@getServicios_edit');
			//Tarjeta
		Route::get('/egresos/tarjeta-credito/pendientes/{id_cuenta}/{restante}', 'EgresosGeneralesController@tarjeta_pendientes');
		Route::get('/egresos/tarjeta-credito/pagados/{id_egreso}', 'EgresosGeneralesController@tarjeta_pagados');
		Route::put('/egresos/tarjeta-credito/pagarEgresoTarjeta/{id}/{id_tarjeta}', 'EgresosGeneralesController@pagarEgresoTarjeta');

			//Agregar cosas a egresos
		Route::post('/egreso/agregarCategoria', 'EgresosGeneralesController@agregarCategoria');*/
		

		
		//Cuentas por Pagar
		Route::get('/cuentas-por-pagar', 'CuentasPorPagarController@index')->name('cuentas-por-pagar.index');
		Route::get('/cuentas-por-pagar/listar/{tipo}', 'CuentasPorPagarController@listado');
		Route::get('/cuentas-por-pagar/buscar/{tipo}/{buscar}', 'CuentasPorPagarController@buscar');
		Route::put('/cuentas-por-pagar/pagar/{id}', 'CuentasPorPagarController@pagar');
		Route::post('/cuentas-por-pagar/store', 'CuentasPorPagarController@store');
		Route::get('/cuentas-por-pagar/actualizar/{id}', 'CuentasPorPagarController@actualizar');
		Route::put('/cuentas-por-pagar/update/{id}', 'CuentasPorPagarController@update');
		Route::put('/cuentas-por-pagar/pagar/{id}', 'CuentasPorPagarController@pagar');
		Route::delete('/cuentas-por-pagar/cancelar/{id}', 'CuentasPorPagarController@cancelar');
		Route::put('/cuentas-por-pagar/activar/{id}', 'CuentasPorPagarController@activar');
		Route::delete('/cuentas-por-pagar/pendiente/{id}', 'CuentasPorPagarController@pendiente');

		//Tarjetas de crédito
		Route::get('/tarjetas-credito', 'TarjetasCreditoController@index')->name('tarjetas-credito.index');
		Route::get('/tarjetas-credito/listar/{estatus}/{tipo}/{cuenta}/{fecha_inicio}/{fecha_fin}', 'TarjetasCreditoController@listado');
		Route::get('/tarjetas-credito/buscar/{estatus}/{tipo}/{cuenta}/{fecha_inicio}/{fecha_fin}/{buscar}', 'TarjetasCreditoController@buscar');
		Route::get('/tarjetas-credito/actualizar/{id}', 'TarjetasCreditoController@actualizar');
		Route::post('/tarjetas-credito/store', 'TarjetasCreditoController@store');
		Route::get('/tarjetas-credito/edit/{id}', 'TarjetasCreditoController@edit');
		Route::put('/tarjetas-credito/update/{id}', 'TarjetasCreditoController@update');
		Route::put('/tarjetas-credito/activar/{id}', 'TarjetasCreditoController@activar');
		Route::put('/tarjetas-credito/cancelar/{id}', 'TarjetasCreditoController@cancelar');
		Route::get('/tarjetas-credito/egreso/{id}', 'TarjetasCreditoController@egreso');

		//Nómina
		/*Route::get('/nomina', 'NominaController@index')->name('nomina.index');
		Route::get('/nomina-listar/{estatus}/{tipo}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@listar');
		Route::get('/nomina-buscar/{estatus}/{tipo}/{buscar}/{fecha_inicio}/{fecha_fin}', 'EstadosCuentaController@buscar');
		Route::get('/nomina-actualizar/{id_egreso}', 'EstadosCuentaController@actualizarEgreso');*/



		//Facturas
		Route::get('/facturas', 'FacturasController@index')->name('facturas.index');
		Route::get('/facturas-listado/{estatus}/{fecha_inicio}/{fecha_fin}', 'FacturasController@listado');
		Route::get('/facturas-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}', 'FacturasController@buscar');
		Route::get('/facturas-actualizar/{id}', 'FacturasController@actualizar');
		Route::get('/facturas-actualizar-totales/{id_factura}', 'FacturasController@actualizar_totales');
		Route::get('/facturas/mostrar-servicios-pendientes/{id_cliente}', 'FacturasController@servicios_pendientes');
		Route::get('/facturas/mostrar-servicios-facturados/{id_factura}', 'FacturasController@servicios_facturados');
		Route::get('/facturas/mostrar-detalles/{id_factura}', 'FacturasController@servicios_facturados_detalle');
		Route::get('/facturas/get-razones/{id}', 'FacturasController@getRazones');
		Route::post('/facturas/insertar-razon', 'FacturasController@insertarRazonSocial');
		Route::post('/facturas/store', 'FacturasController@store');
		Route::put('/facturas/update/{id_factura}', 'FacturasController@update');
		Route::get('/factura-edit/{id_factura}', 'FacturasController@edit');
		Route::put('/factura/destroy/{id_factura}', 'FacturasController@destroy');

		Route::put('/facturas/insertar-detalle/{id}', 'FacturasController@insertar_detalle');
		Route::put('/facturas/eliminar-detalle/{id}/{id_det}', 'FacturasController@eliminar_detalle');

		Route::get('/facturas/servicios-cliente/{id_cliente}/{id_factura}/{estatus}', 'FacturasController@servicios');
		Route::get('/facturas/serviciosPendientes/{id_cliente}', 'FacturasController@serviciosPendientes');
		Route::get('/facturas/serviciosFacturados/{id_factura}', 'FacturasController@serviciosFacturados');
		Route::put('/facturas/insertar-detalle/{id_factura}', 'FacturasController@agregarFacturaRecibo');
		Route::get('/facturas/servicios/{id}', 'FacturasController@getServicios');
		Route::put('/facturas/actualizar-iva/{id}', 'FacturasController@actualizar_iva');

		//Recibos
		Route::get('/recibos-listado/{estatus}/{fecha_inicio}/{fecha_fin}', 'FacturasController@recibos_listado');
		Route::get('/recibos-buscar/{estatus}/{buscar}/{fecha_inicio}/{fecha_fin}', 'FacturasController@recibos_buscar');
		Route::get('/recibos-actualizar/{id}', 'FacturasController@recibos_actualizar');
		Route::get('/recibos/servicios-cliente/{id_cliente}/{id_factura}/{estatus}', 'FacturasController@servicios_recibo');
		
		Route::put('/facturas/editar-detalle/{detalle}', 'FacturasController@editar_detalles')->name('facturas.editar-detalle');
		Route::put('/facturas/show/{id_factura}', 'FacturasController@show')->name('facturas.show');
		Route::post('/facturas/ver-detalles', 'FacturasController@getDetalles')->name('facturas.detalles');
		Route::resource('/detalle-facturas', 'FacturasDetallesController');
		//Route::get('/facturas/listado/{id}', 'FacturasController@facturas_listado')->name('facturas.listado');

		

		//Cobranza
		Route::resource('/cobranza', 'CobranzaController'/*, ['except'=>'update']*/);
		//Route::post('/cobranza/ver-detalles-facturas', 'FacturasController@getDetalles')->name('cobranza.factura.detalles');
		Route::post('/cobranza/insertar-factura', 'CobranzaController@insertar_factura')->name('cobranza.insertar-factura');
		Route::put('/cobranza/actualizar/{cobranza}', 'CobranzaController@actualizar');


		//Cobranza de Servicios
		Route::resource('/cobranza-servicios', 'CobranzaServiciosController');

		//Comisiones
		Route::get('/comisiones', 'ComisionesController@index')->name('comisiones.index');
		Route::get('/comisiones-listar/{id_admin}/{fecha_inicio}/{fecha_fin}', 'ComisionesController@listar');
		Route::get('/comisiones-buscar/{estatus}/{id_admin}/{buscar}', 'ComisionesController@buscar');

		//Comision para usuarios
		Route::get('/comisiones-usuario', 'ComisionesController@index_usuario')->name('comisiones.usuario.index');
		Route::get('/comisiones-listar-usuario/{estatus}/{id_admin}', 'ComisionesController@listar_usuario');
		Route::get('/comisiones-buscar-usuario/{estatus}/{id_admin}/{buscar}', 'ComisionesController@buscar_usuario');
		Route::get('/comisiones-actualizar/{id}', 'ComisionesController@actualizarComision');
		Route::get('/comisiones-asignacion', 'ComisionesController@listadoAsignacion');
		Route::get('/comisiones-asignacion-buscar/{buscar}', 'ComisionesController@listadoAsignacionBuscar');
		Route::get('/comisiones-asignacion-actualizar/{id}', 'ComisionesController@listadoAsignacionActualizar');
		Route::get('/comisiones-preseleccionar-listado/{id_admin}', 'ComisionesController@cargarComisionesPreseleccionar');
		Route::put('/comisiones-preseleccionar/{id}', 'ComisionesController@preseleccionarComision');
		Route::put('/comisiones-seleccionar/{id}', 'ComisionesController@SeleccionarComisiones');
		Route::get('/comisiones-total-seleccionar/{id}', 'ComisionesController@TotalSeleccionado');


		Route::get('/comision-reciente/{tipo}', 'ComisionesController@comisionReciente');
		Route::get('/comision-cargar-servicios-pendientes/{id_admin}', 'ComisionesController@cargarServiciosPendientes');
		Route::get('/comision-cargar-servicios-pagados/{id_admin}/{id_egreso}', 'ComisionesController@cargarServiciosPagados');
		Route::post('/comisiones/store', 'ComisionesController@store');
		Route::get('/comisiones/edit/{id}', 'ComisionesController@edit');
		Route::put('/comisiones/update/{id}', 'ComisionesController@update');
		Route::post('/comisiones/guardar', 'ComisionesController@guardar');
		Route::put('/comisiones/actualizar/{id}', 'ComisionesController@actualizar');
		Route::put('/comisiones/quitar-comision/{id_egreso}/{id_comision}', 'ComisionesController@quitar_comision');
		Route::delete('/comisiones/eliminar-comision/{id}', 'ComisionesController@eliminar_comision');


		//Estatus
		Route::get('/estatus', 'EstatusController@index')->name('estatus.index');
		Route::get('/estatus-menu', 'EstatusController@index')->name('estatus-menu.index');
		Route::get('/estatus-marcas/{id_control}', 'EstatusController@estatus_marca');
		Route::get('/estatus-subcategoria/{id}', 'EstatusController@subcategoria');
		Route::get('/estatus-listado/{id}', 'EstatusController@estatus_listado');
		Route::get('/bitacora/get_editar_estatus/{id_estatus}', 'EstatusController@editar_estatus');
		Route::get('/bitacora/editar_servicio/{id}', 'EstatusController@editar_servicio');
		Route::get('/bitacora/enviar-fechas/{id}/{fecha_inicio}/{declaracion}/{recordatorio}/{vencimiento}/{aplica_comprobacion}', 'EstatusController@enviar_fechas');
		Route::get('/estatus/cargar-clientes-nuevos', 'EstatusController@clientes_estatus_nuevo');
		Route::get('/estatus/cargar-servicios/{id_cliente}', 'EstatusController@servicios_clientes');
		Route::post('/estatus/store', 'EstatusController@store');
		Route::get('/estatus/edit/{id}', 'EstatusController@edit');
		Route::put('/estatus/update/{id}', 'EstatusController@update');
		//Signos Distintivos
		Route::get('/estatus/signos-distintivos-listar/{estatus}/{vigencia}', 'EstatusController@signos_distintivos_listar');
		Route::get('/estatus/signos-distintivos-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@signos_distintivos_buscar');
		Route::get('/estatus/signos-distintivos-actualizar/{id}', 'EstatusController@signos_distintivos_actualizar');
		//Declaración de uso
		Route::get('/estatus/declaracion-uso-listar/{estatus}/{vigencia}', 'EstatusController@declaracion_uso_listar');
		Route::get('/estatus/declaracion-uso-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@declaracion_uso_buscar');
		Route::get('/estatus/declaracion-uso-actualizar/{id}', 'EstatusController@declaracion_uso_actualizar');
		//Búsqueda Técnica
		Route::get('/estatus/busqueda-tecnica-listar/{estatus}/{vigencia}', 'EstatusController@busqueda_tecnica_listar');
		Route::get('/estatus/busqueda-tecnica-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@busqueda_tecnica_buscar');
		Route::get('/estatus/busqueda-tecnica-actualizar/{id}', 'EstatusController@busqueda_tecnica_actualizar');
		//Invenciones
		Route::get('/estatus/invenciones-listar/{estatus}/{vigencia}', 'EstatusController@invenciones_listar');
		Route::get('/estatus/invenciones-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@invenciones_buscar');
		Route::get('/estatus/invenciones-actualizar/{id}', 'EstatusController@invenciones_actualizar');
		//Dictamen Previo
		Route::get('/estatus/dictamen-previo-listar/{estatus}/{vigencia}', 'EstatusController@dictamen_previo_listar');
		Route::get('/estatus/dictamen-previo-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@dictamen_previo_buscar');
		Route::get('/estatus/dictamen-previo-actualizar/{id}', 'EstatusController@dictamen_previo_actualizar');
		//Códigos de Barra
		Route::get('/estatus/codigos-barra-listar/{estatus}/{vigencia}', 'EstatusController@codigos_barra_listar');
		Route::get('/estatus/codigos-barra-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@codigos_barra_buscar');
		Route::get('/estatus/codigos-barra-actualizar/{id}', 'EstatusController@codigos_barra_actualizar');
		//Registro de Obras
		Route::get('/estatus/registro-obras-listar/{estatus}/{vigencia}', 'EstatusController@registro_obras_listar');
		Route::get('/estatus/registro-obras-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@registro_obras_buscar');
		Route::get('/estatus/registro-obras-actualizar/{id}', 'EstatusController@registro_obras_actualizar');
		//Reserva de derechos
		Route::get('/estatus/reserva-derechos-listar/{estatus}/{vigencia}', 'EstatusController@reserva_derechos_listar');
		Route::get('/estatus/reserva-derechos-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@reserva_derechos_buscar');
		Route::get('/estatus/reserva-derechos-actualizar/{id}', 'EstatusController@reserva_derechos_actualizar');
		//Juicios
		Route::get('/estatus/juicios-listar/{estatus}/{vigencia}', 'EstatusController@juicios_listar');
		Route::get('/estatus/juicios-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@juicios_buscar');
		Route::get('/estatus/juicios-actualizar/{id}', 'EstatusController@juicios_actualizar');
		//Franquicias
		Route::get('/estatus/franquicias-listar/{estatus}/{vigencia}', 'EstatusController@franquicias_listar');
		Route::get('/estatus/franquicias-buscar/{estatus}/{vigencia}/{buscar}', 'EstatusController@franquicias_buscar');
		Route::get('/estatus/franquicias-actualizar/{id}', 'EstatusController@franquicias_actualizar');


		//Registro de Marcas
		Route::get('/estatus/registro-marcas', 'Estatus\RegistroMarcasController@index')->name('registro-marcas.index');
		Route::get('/estatus/registro-marcas-listar/{estatus}/', 'Estatus\RegistroMarcasController@listar');
		Route::get('/estatus/registro-marcas-buscar/{estatus}/{buscar}', 'Estatus\RegistroMarcasController@buscar');
		Route::get('/estatus/registro-marcas-actualizar/{id}', 'Estatus\RegistroMarcasController@actualizar');

		Route::put('/estatus/registro-marcas/expediente/{id}', 'Estatus\RegistroMarcasController@expediente')->name('registro-marcas-expediente');
		Route::put('/estatus/registro-marcas/registro/{id}', 'Estatus\RegistroMarcasController@registro')->name('registro-marcas-registro');
		Route::put('/estatus/registro-marcas/estatus/{id}', 'Estatus\RegistroMarcasController@estatus')->name('registro-marcas.estatus');
		Route::put('/estatus/registro-marcas/cancelar/{id}', 'Estatus\RegistroMarcasController@cancelar')->name('registro-marcas.cancelar');

		//Colores
		Route::resource('/colores', 'ColoresController');

		//Honorarios
		Route::get('/honorarios', 'HonorariosController@index')->name('honorarios.index');
		Route::get('/honorarios-listar', 'HonorariosController@listar');
		Route::get('/honorarios-pendientes', 'HonorariosController@listar_pendientes');
		Route::get('/honorarios-buscar/{buscar}', 'HonorariosController@buscar');
		Route::get('/honorarios-proveedores', 'HonorariosController@proveedores');
		Route::post('/honorarios-pagar', 'HonorariosController@pagar_honorarios');
		Route::put('/honorarios-seleccionar/{id}', 'HonorariosController@honorarios_select');

		Route::get('/{slug?}', 'AdminController@index');
	});
});

Route::get('/', function () {
    return view('emporio.index');
})->where('/', '[\/\w\.-]*');
// Route::view('/{any}', 'emporio.index');
// Route::view('/{any}/{any1}', 'emporio.index');










