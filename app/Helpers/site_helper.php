<?php

if (!function_exists('siteTitle')) {
    function siteTitle($page = '') {
        $base = 'SCAN2FETCH';
        return $page ? $base . ' | ' . $page : $base;
    }
}