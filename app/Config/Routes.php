<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');

$routes->get('/login', 'Main::login');
$routes->post('/login_submit', 'Main::login_submit');
$routes->get('/logout', 'Main::logout');

$routes->get('/admin', 'Main::admin');

$routes->post('/processar_frm', 'Main::processar_frm');

$routes->get('/usuario_details/(:alphanum)', 'Main::usuario_details/$1');

$routes->get('/create_pdf_report', 'Main::create_pdf_report');

$routes->get('/stats', 'Main::stats');