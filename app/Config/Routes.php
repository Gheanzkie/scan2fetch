<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Welcome::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Auth::auth');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');

// Parents
$routes->get('parents', 'Parents::index');
$routes->get('parents-add', 'Parents::add');
$routes->get('parents-view/(:num)', 'Parents::view/$1');
$routes->get('parents-edit/(:num)', 'Parents::edit/$1');
$routes->post('parents-save', 'Parents::save');
$routes->post('parents-update', 'Parents::update');
$routes->get('parents-delete/(:num)', 'Parents::delete/$1');
$routes->get('parents-logs', 'Parents::logs');
$routes->post('parents-update-picture', 'Parents::updatePicture');

// Staffs
$routes->get('staffs', 'Staffs::index');
$routes->post('staffs-save', 'Staffs::save');
$routes->post('staffs-update', 'Staffs::update');
$routes->get('staffs-delete/(:num)', 'Staffs::delete/$1');

// Students
$routes->get('students', 'Students::index');

// Authorization
$routes->get('authorization', 'Authorization::index');
$routes->post('authorization-send', 'Authorization::send');
$routes->get('authorizations', 'Authorization::all');
$routes->get('authorization-approve/(:num)', 'Authorization::approve/$1');
$routes->get('authorization-release/(:num)', 'Authorization::release/$1');

// QR Scan
$routes->get('scan', 'Scan::index');
$routes->post('scan/verify', 'Scan::verify');
$routes->post('scan/release', 'Scan::release');

// Logs
$routes->get('logs', 'Logs::index');