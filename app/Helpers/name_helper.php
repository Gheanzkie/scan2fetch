<?php

/**
 * Name helpers — one place to build a person's complete name.
 *
 * full_name($row)              -> "Juan Santos Dela Cruz"   (fname mname lname)
 * full_name($row, 'student_')  -> uses student_fname / student_mname / student_lname
 * full_name_initial($row)      -> "JD"
 */
if (! function_exists('full_name')) {
    function full_name($row, string $prefix = ''): string
    {
        if (! is_array($row)) {
            return '';
        }

        $parts = [];
        foreach (['fname', 'mname', 'lname'] as $key) {
            $value = trim((string) ($row[$prefix . $key] ?? ''));
            if ($value !== '') {
                $parts[] = $value;
            }
        }

        return implode(' ', $parts);
    }
}

if (! function_exists('full_name_initial')) {
    function full_name_initial($row, string $prefix = ''): string
    {
        if (! is_array($row)) {
            return '';
        }

        $f = mb_substr(trim((string) ($row[$prefix . 'fname'] ?? '')), 0, 1);
        $l = mb_substr(trim((string) ($row[$prefix . 'lname'] ?? '')), 0, 1);

        return strtoupper($f . $l);
    }
}
