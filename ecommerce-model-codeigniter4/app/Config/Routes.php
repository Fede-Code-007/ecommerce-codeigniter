<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//PAGINAS INICIALES
$routes->get('/', 'Home::index');
$routes->get('quienesSomos', 'Home::quienesSomos');
$routes->get('terminosYusos', 'Home::terminosYusos');
$routes->get('comercializacion', 'Home::comercializacion');

//RELACIONADOS A LOS MENSAJES
$routes->get('contacto', 'Home::contacto');
$routes->post('enviar-form-contacto','mensajes_controller::validarMensajeContacto');
$routes->get('consultas', 'Home::consultas', ['filter' => 'auth']);
$routes->post('enviar-form-consultas','mensajes_controller::validarMensajeConsultas', ['filter' => 'auth']);
$routes->get('mostrarMensajes_(:any)','mensajes_controller::mostrarMensajes_/$1', ['filter' => 'OnlyAdmin']);
$routes->get('marcarComoLeido(:num)','mensajes_controller::marcarComoLeido/$1', ['filter' => 'OnlyAdmin']);
$routes->get('marcarComoRespondido(:num)','mensajes_controller::marcarComoRespondido/$1', ['filter' => 'OnlyAdmin']);

//REGISTRO, LOGIN y LOGOUT
$routes->get('registroUsuarios', 'usuario_controller::registroUsuarios',['filter' => 'OnlyVisitantes']);
$routes->post('enviar-form-registro','usuario_controller::validarRegistroUsuario',['filter' => 'OnlyVisitantes']);
$routes->get('login', 'usuario_controller::login',['filter' => 'OnlyVisitantes']);
$routes->post('enviar-form-login','usuario_controller::validarLogin',['filter' => 'OnlyVisitantes']);
$routes->get('logout', 'usuario_controller::logout', ['filter' => 'auth']);

//DATOS PERSONALES DE UNA CUENTA
$routes->get('miCuenta', 'usuario_controller::miCuenta', ['filter' => 'auth']);
$routes->post('actualizarDatosUsuario', 'usuario_controller::modificarDatosMiCuenta', ['filter' => 'auth']);
$routes->post('enviar-form-actualizarDatosUsuario','usuario_controller::modificarDatosCuenta', ['filter' => 'auth']);
$routes->post('cambiarContraseña','usuario_controller::cambiarContraseña', ['filter' => 'auth']);
$routes->post('bajaCuenta','usuario_controller::bajaCuenta', ['filter' => 'auth']);

//ABM PRODUCTOS
$routes->get('formularioAltaProducto','productos_controller::formularioAltaProducto', ['filter' => 'OnlyAdmin']);
$routes->post('validarAltaProducto','productos_controller::validarAltaProducto', ['filter' => 'OnlyAdmin']);
$routes->get('productosABM_(:any)','productos_controller::mostrarTablaABMProductos/$1', ['filter' => 'OnlyAdmin']);
$routes->get('bajaProducto(:num)','productos_controller::bajaProducto/$1', ['filter' => 'OnlyAdmin']);
$routes->get('altaProducto(:num)','productos_controller::altaProducto/$1', ['filter' => 'OnlyAdmin']);
$routes->post('modificarProducto(:num)','productos_controller::modificarProducto/$1', ['filter' => 'OnlyAdmin']);

//ABM USUARIOS
$routes->get('usuariosABM_(:any)','usuario_controller::mostrarTablaABMusuarios/$1', ['filter' => 'OnlyAdmin']);
$routes->get('bajaUsuario(:num)','usuario_controller::bajaUsuario/$1', ['filter' => 'OnlyAdmin']);
$routes->get('altaUsuario(:num)','usuario_controller::altaUsuario/$1', ['filter' => 'OnlyAdmin']);
$routes->post('modificarUsuario(:num)','usuario_controller::modificarUsuario/$1', ['filter' => 'OnlyAdmin']);

//CATALOGO
$routes->get('catalogo_(:any)', 'productos_controller::catalogo/$1');

//CARRITO
$routes->get('confirmarCompra', 'carrito_controller::mostrarCarrito', ['filter' => 'auth']);
$routes->post('modificar_cant(:any)', 'carrito_controller::modificar_cant/$1', ['filter' => 'auth']);
$routes->post('agregarAlCarrito', 'carrito_controller::agregarAlCarrito', ['filter' => 'auth']);
$routes->get('quitarDelCarrito(:any)', 'carrito_controller::quitarDelCarrito/$1', ['filter' => 'auth']);
$routes->get('borrarCarrito', 'carrito_controller::borrarCarrito', ['filter' => 'auth']);
$routes->get('comprarCarrito', 'carrito_controller::comprarCarrito', ['filter' => 'auth']);
$routes->get('tablaFacturas', 'carrito_controller::mostrarTablaFacturas', ['filter' => 'auth']);
$routes->get('detalleFactura_(:any)', 'carrito_controller::verDetalleFactura/$1', ['filter' => 'auth']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
