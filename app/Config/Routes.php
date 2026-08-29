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

    // ===== PARENTS =====
    $routes->get('parents', 'Parents::index');
    $routes->get('parents-view/(:num)', 'Parents::view/$1');
    $routes->get('parents-edit/(:num)', 'Parents::edit/$1');
    $routes->post('parents-save', 'Parents::save');
    $routes->post('parents-update', 'Parents::update');
    $routes->get('parents-delete/(:num)', 'Parents::delete/$1');
    $routes->get('parents-send-password/(:num)', 'Parents::sendPassword/$1');
    $routes->post('parents-update-picture', 'Parents::updatePicture');
    $routes->post('parents-update-from-student', 'Parents::updateFromStudent');
    $routes->get('parents-releases', 'Parents::releases');
    $routes->get('parents-notifications', 'Parents::notifications');
    $routes->get('parents-logs', 'Parents::logs');

    // ===== SUB-FETCHERS =====
    $routes->post('subfetchers-save', 'SubFetchers::save');
    $routes->post('subfetchers-update', 'SubFetchers::update');
    $routes->get('subfetchers-delete/(:num)/(:num)', 'SubFetchers::delete/$1/$2');

    // ===== STAFFS =====
    $routes->get('staffs', 'Staffs::index');
    $routes->post('staffs-save', 'Staffs::save');
    $routes->post('staffs-update', 'Staffs::update');
    $routes->get('staffs-delete/(:num)', 'Staffs::delete/$1');

    // ===== TEACHERS =====
    $routes->get('teachers', 'Teachers::index');
    $routes->get('teachers-view/(:num)', 'Teachers::view/$1');
    $routes->get('teachers-notifications', 'Teachers::notifications');
    $routes->post('teachers-save', 'Teachers::save');
    $routes->post('teachers-update', 'Teachers::update');
    $routes->get('teachers-delete/(:num)', 'Teachers::delete/$1');
    $routes->get('teachers-send-password/(:num)', 'Teachers::sendPassword/$1');

    // ===== QR SCAN =====
    $routes->get('scan', 'Scan::index');
    $routes->post('scan/verify', 'Scan::verify');
    $routes->post('scan/release', 'Scan::release');
    $routes->post('scan/decline', 'Scan::decline');

    // ===== SCAN MONITOR =====
    $routes->get('scan-monitor', 'ScanMonitor::index');
    $routes->get('scan-monitor/get-pending-list', 'ScanMonitor::getPendingList');
    $routes->post('scan-monitor/send-notifications', 'ScanMonitor::sendPendingNotifications');
    $routes->post('scan-monitor/save-sms-mode', 'ScanMonitor::saveSmsMode');
    $routes->get('scan-monitor/check-and-fire', 'ScanMonitor::checkAndFireAutoSms');

    // ===== SMS LOGS =====
    $routes->get('sms-logs', 'Sms::index');
    $routes->get('sms-logs/details/(:num)', 'Sms::getSmsDetails/$1');

    // ===== ACTIVITY LOGS =====
    $routes->get('logs', 'Logs::index');

    // ===== ACCOUNT =====
    $routes->post('change-password', 'Auth::changePassword');
    $routes->post('update-profile', 'Auth::updateProfile');

    // ===== MESSAGES (parent <-> admin/staff chat) =====
    $routes->get('messages', 'Messages::index');
    $routes->post('messages/send', 'Messages::send');
    $routes->get('messages/thread/(:num)', 'Messages::getThread/$1');
    $routes->get('messages/unread', 'Messages::unread');

    // For admin profile update
    $routes->post('admin/updateProfile', 'Admin::updateProfile');

// For other roles
    $routes->post('update-profile', 'Auth::updateProfile');

});

$routes->set404Override(function() {
    return view('errors/html/error_404');
});