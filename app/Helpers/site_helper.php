<?php

if (!function_exists('siteTitle')) {
    function siteTitle($page = '') {
        $base = 'SCAN2FETCH';
        return $page ? $base . ' | ' . $page : $base;
    }
}

if (!function_exists('routeTitle')) {
    /**
     * Derive a friendly page title from the current URI so the browser tab
     * always shows the active module (no need to pass $pageName per view).
     */
    function routeTitle() {
        $uri  = service('uri');
        $seg1 = $uri->getSegment(1);
        $seg2 = $uri->getSegment(2);

        $map = [
            ''                     => 'Home',
            'welcome'              => 'Home',
            'login'                => 'Sign In',
            'register'             => 'Register Student',
            'dashboard'            => 'Dashboard',
            'students'             => 'Students',
            'parents'              => 'Parents',
            'teachers'             => 'Teachers',
            'staffs'               => 'Staffs',
            'scan'                 => 'QR Scan',
            'scan-monitor'         => 'Students Status',
            'logs'                 => 'Activity Logs',
            'sms-logs'             => 'SMS Logs',
            'messages'             => 'Messages',
            'welcome'              => 'Home',
        ];

        // Detail / edit pages get a more specific label.
        if ($seg1 === 'students-view')    return 'Student Details';
        if ($seg1 === 'students-edit')    return 'Edit Student';
        if ($seg1 === 'parents-view')     return 'Parent Details';
        if ($seg1 === 'teachers-view')    return 'Teacher Roster';
        if ($seg1 === 'teachers-student-view') return 'Student Details';

        return $map[$seg1] ?? ucfirst($seg1 ?? 'Home');
    }
}