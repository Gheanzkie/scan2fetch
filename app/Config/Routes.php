<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Home
$routes->get('/', 'Welcome::index');

// Login
$routes->get('login', 'Login::index');
$routes->post('login', 'Auth::auth');
$routes->get('logout', 'Auth::logout');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');

// ========== STUDENTS ==========
$routes->get('students', 'Students::index');
$routes->get('students-add', 'Students::add');
$routes->get('students-view/(:num)', 'Students::view/$1');
$routes->get('students-edit/(:num)', 'Students::edit/$1');
$routes->post('students-save', 'Students::save');
$routes->post('students-update', 'Students::update');
$routes->get('students-delete/(:num)', 'Students::delete/$1');
$routes->get('students-remove-parent/(:num)/(:num)', 'Students::removeParent/$1/$2');
$routes->post('students-add-parent', 'Students::addParent');

// ========== PARENTS ==========
$routes->get('parents', 'Parents::index');
$routes->get('parents-add', 'Parents::add');
$routes->get('parents-view/(:num)', 'Parents::view/$1');
$routes->get('parents-edit/(:num)', 'Parents::edit/$1');
$routes->post('parents-save', 'Parents::save');
$routes->post('parents-update', 'Parents::update');
$routes->get('parents-delete/(:num)', 'Parents::delete/$1');
$routes->post('parents-update-picture', 'Parents::updatePicture');
$routes->post('parents-update-from-student', 'Parents::updateFromStudent');
$routes->get('parents-logs', 'Parents::logs');

// ========== SUB-FETCHERS ==========
$routes->post('subfetchers-save', 'SubFetchers::save');
$routes->post('subfetchers-update', 'SubFetchers::update');
$routes->get('subfetchers-delete/(:num)/(:num)', 'SubFetchers::delete/$1/$2');

// ========== STAFFS ==========
$routes->get('staffs', 'Staffs::index');
$routes->post('staffs-save', 'Staffs::save');
$routes->post('staffs-update', 'Staffs::update');
$routes->get('staffs-delete/(:num)', 'Staffs::delete/$1');

// Scan
$routes->get('scan', 'Scan::index');
$routes->post('scan/verify', 'Scan::verify');
$routes->post('scan/release', 'Scan::release');
$routes->post('scan/decline', 'Scan::decline');

// Sub-Fetchers
$routes->post('subfetchers-save', 'SubFetchers::save');
$routes->post('subfetchers-update', 'SubFetchers::update');
$routes->get('subfetchers-delete/(:num)/(:num)', 'SubFetchers::delete/$1/$2');

// ========== AUTHORIZATION ==========
$routes->get('authorization', 'Authorization::index');
$routes->post('authorization-send', 'Authorization::send');
$routes->get('authorizations', 'Authorization::all');
$routes->get('authorization-approve/(:num)', 'Authorization::approve/$1');
$routes->get('authorization-release/(:num)', 'Authorization::release/$1');
$routes->get('authorization-decline/(:num)', 'Authorization::decline/$1');

// ========== LOGS ==========
$routes->get('logs', 'Logs::index');

// ========== SMS LOGS ==========
$routes->get('sms-logs', 'Sms::index');

// 404 Override
$routes->set404Override(function() {
    return view('errors/html/error_404');
});