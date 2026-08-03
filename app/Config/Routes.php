<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Welcome::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Auth::auth');


$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Logout
    $routes->get('logout', 'Auth::logout');

    // Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // ===== STUDENTS =====
    $routes->get('students', 'Students::index');
    $routes->get('register', 'Students::add');
    $routes->get('students-view/(:num)', 'Students::view/$1');
    $routes->get('students-edit/(:num)', 'Students::edit/$1');
    $routes->post('students-save', 'Students::save');
    $routes->post('students-update', 'Students::update');
    $routes->get('students-delete/(:num)', 'Students::delete/$1');
    $routes->get('students-remove-parent/(:num)/(:num)', 'Students::removeParent/$1/$2');
    $routes->post('students-add-parent', 'Students::addParent');

    // ===== PARENTS (Updated Routes) =====
    $routes->get('parents', 'Parents::index');
    $routes->get('parents-view/(:num)', 'Parents::view/$1');
    $routes->get('parents-edit/(:num)', 'Parents::edit/$1');
    $routes->post('parents-save', 'Parents::save');
    $routes->post('parents-update', 'Parents::update');
    $routes->get('parents-delete/(:num)', 'Parents::delete/$1');
    $routes->post('parents-update-picture', 'Parents::updatePicture');
    $routes->post('parents-update-from-student', 'Parents::updateFromStudent');

    // ===== PARENT LOGS (Separate Pages) =====
    $routes->get('parents-releases', 'Parents::releases');         // Release History only
    $routes->get('parents-notifications', 'Parents::notifications'); // SMS Notifications only
    $routes->get('parents-logs', 'Parents::logs');                 // Combined (legacy)

    // ===== SUB-FETCHERS =====
    $routes->post('subfetchers-save', 'SubFetchers::save');
    $routes->post('subfetchers-update', 'SubFetchers::update');
    $routes->get('subfetchers-delete/(:num)/(:num)', 'SubFetchers::delete/$1/$2');

    // ===== STAFFS =====
    $routes->get('staffs', 'Staffs::index');
    $routes->post('staffs-save', 'Staffs::save');
    $routes->post('staffs-update', 'Staffs::update');
    $routes->get('staffs-delete/(:num)', 'Staffs::delete/$1');

    // ===== QR SCAN =====
    $routes->get('scan', 'Scan::index');
    $routes->post('scan/verify', 'Scan::verify');
    $routes->post('scan/release', 'Scan::release');
    $routes->post('scan/decline', 'Scan::decline');

    // ===== SCAN MONITOR =====
    $routes->get('scan-monitor', 'ScanMonitor::index');
    $routes->get('scan-monitor/get-pending-list', 'ScanMonitor::getPendingList');
    $routes->post('scan-monitor/send-notifications', 'ScanMonitor::sendPendingNotifications');

    // ===== SMS LOGS =====
    $routes->get('sms-logs', 'Sms::index');
    $routes->get('sms-logs/details/(:num)', 'Sms::getSmsDetails/$1');

    // ===== ACTIVITY LOGS =====
    $routes->get('logs', 'Logs::index');

});

$routes->set404Override(function() {
    return view('errors/html/error_404');
});