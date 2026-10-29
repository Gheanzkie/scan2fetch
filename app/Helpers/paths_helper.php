<?php

/**
 * Filesystem paths that must not depend on where index.php sits.
 *
 * The app is served with the project root as DocumentRoot (deployed layout),
 * so FCPATH is the project root while the real web assets — including the
 * uploads tree — live in public/. Everything that reads or writes a photo, QR
 * image or import must go through uploads_path() so both layouts agree.
 */
if (! function_exists('public_path')) {
    function public_path(string $append = ''): string
    {
        $base = is_dir(ROOTPATH . 'public') ? ROOTPATH . 'public' : rtrim(FCPATH, '/\\');

        return rtrim($base, '/\\') . DIRECTORY_SEPARATOR . ltrim($append, '/\\');
    }
}

if (! function_exists('uploads_path')) {
    /**
     * Absolute path inside the uploads tree, with a trailing separator.
     * uploads_path('students') => .../public/uploads/students/
     */
    function uploads_path(string $sub = ''): string
    {
        $base = public_path('uploads');
        $sub  = trim(str_replace('\\', '/', $sub), '/');

        return rtrim($base, '/\\') . DIRECTORY_SEPARATOR . ($sub !== '' ? $sub . DIRECTORY_SEPARATOR : '');
    }
}

if (! function_exists('uploads_url')) {
    function uploads_url(string $append = ''): string
    {
        return base_url('uploads/' . ltrim(str_replace('\\', '/', $append), '/'));
    }
}
