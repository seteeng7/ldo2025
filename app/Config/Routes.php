<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');

$routes->get('/login', 'Main::login');
$routes->post('/login_submit', 'Main::login_submit');
$routes->get('/logout', 'Main::logout');

$routes->post('/processar_frm', 'Main::processar_frm');