<?php

/**
 * Student photo helper — convention based.
 *
 * No database column is required: a student's photo is simply
 * FCPATH/uploads/students/{student_no}.jpg (or .jpeg/.png/.webp).
 *
 * That means a file copied straight into that folder with the right name is
 * picked up automatically — no import, no upload, no SQL.
 */

if (! function_exists('student_photo_exts')) {
    /** Accepted extensions, checked in this order. */
    function student_photo_exts(): array
    {
        return ['jpg', 'jpeg', 'png', 'webp'];
    }
}

if (! function_exists('student_photo_id')) {
    /** Normalise a posted student id to plain digits ('' when invalid). */
    function student_photo_id($value): string
    {
        return preg_replace('/[^0-9]/', '', (string) $value);
    }
}

if (! function_exists('student_photo_path')) {
    /** Absolute path of an existing photo, or null. */
    function student_photo_path(string $studentNo): ?string
    {
        $no = student_photo_id($studentNo);
        if ($no === '') {
            return null;
        }

        $dir = uploads_path('students');
        foreach (student_photo_exts() as $ext) {
            $path = $dir . $no . '.' . $ext;
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }
}

if (! function_exists('student_photo_exists')) {
    function student_photo_exists(string $studentNo): bool
    {
        return student_photo_path($studentNo) !== null;
    }
}

if (! function_exists('student_photo_url')) {
    /**
     * Web URL for a student's photo ('' when there is none).
     * The ?v=filemtime() suffix means a retake shows immediately instead of
     * the browser serving the old cached image.
     */
    function student_photo_url(string $studentNo): string
    {
        $path = student_photo_path($studentNo);
        if ($path === null) {
            return '';
        }

        $url = base_url('uploads/students/' . basename($path));

        return $url . '?v=' . filemtime($path);
    }
}

if (! function_exists('student_photo_delete')) {
    /** Remove every extension variant for a student id. */
    function student_photo_delete(string $studentNo): int
    {
        $no = student_photo_id($studentNo);
        if ($no === '') {
            return 0;
        }

        $removed = 0;
        $dir     = uploads_path('students');
        foreach (student_photo_exts() as $ext) {
            $path = $dir . $no . '.' . $ext;
            if (is_file($path) && @unlink($path)) {
                $removed++;
            }
        }

        return $removed;
    }
}

if (! function_exists('photo_save_dataurl')) {
    /**
     * Store a data:image/...;base64 payload as uploads/students/{id}.jpg.
     *
     * The image is centre-cropped to a square and resized to $max px so a
     * 4MB phone photo becomes a small, consistent portrait.
     */
    function photo_save_dataurl(string $dataUrl, string $studentNo, int $max = 512): bool
    {
        $no = student_photo_id($studentNo);
        if ($no === '' || $dataUrl === '') {
            return false;
        }

        if (! preg_match('#^data:image/(?:jpeg|jpg|png|webp);base64,#i', $dataUrl, $m)) {
            return false;
        }

        $binary = base64_decode(substr($dataUrl, strlen($m[0])), true);
        if ($binary === false || $binary === '') {
            return false;
        }

        $info = @getimagesizefromstring($binary);
        if ($info === false || $info[0] < 1 || $info[1] < 1) {
            return false;
        }

        $src = @imagecreatefromstring($binary);
        if ($src === false) {
            return false;
        }

        [$width, $height] = $info;
        $side = min($width, $height);
        $sx   = (int) (($width - $side) / 2);
        $sy   = (int) (($height - $side) / 2);

        $dst = imagecreatetruecolor($max, $max);
        imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
        imagecopyresampled($dst, $src, 0, 0, $sx, $sy, $max, $max, $side, $side);

        $dir = uploads_path('students');
        if (! is_dir($dir) && ! @mkdir($dir, 0775, true) && ! is_dir($dir)) {
            imagedestroy($src);
            imagedestroy($dst);

            return false;
        }

        // Drop stale variants so a png never shadows the new jpg.
        student_photo_delete($no);

        $ok = imagejpeg($dst, $dir . $no . '.jpg', 90);

        imagedestroy($src);
        imagedestroy($dst);

        return (bool) $ok;
    }
}

if (! function_exists('parent_photo_delete')) {
    /** Remove every extension variant for a parent id (P-#### or digits). */
    function parent_photo_delete(string $parentNo): int
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($parentNo)));
        if ($no === '') {
            return 0;
        }
        if (! str_starts_with($no, 'P-')) {
            $no = 'P-' . $no;
        }

        $removed = 0;
        $dir     = uploads_path('parents');
        foreach (student_photo_exts() as $ext) {
            $path = $dir . $no . '.' . $ext;
            if (is_file($path) && @unlink($path)) {
                $removed++;
            }
        }

        return $removed;
    }
}

if (! function_exists('parent_photo_path')) {
    /** Absolute path of an existing parent photo, or null. */
    function parent_photo_path(string $parentNo): ?string
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($parentNo)));
        if ($no === '') {
            return null;
        }
        if (! str_starts_with($no, 'P-')) {
            $no = 'P-' . $no;
        }

        $dir = uploads_path('parents');
        foreach (student_photo_exts() as $ext) {
            $path = $dir . $no . '.' . $ext;
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }
}

if (! function_exists('parent_photo_url')) {
    /** Web URL for a parent photo ('' when none). */
    function parent_photo_url(string $parentNo): string
    {
        $path = parent_photo_path($parentNo);
        if ($path === null) {
            return '';
        }

        return base_url('uploads/parents/' . basename($path)) . '?v=' . filemtime($path);
    }
}

if (! function_exists('photo_save_parent_dataurl')) {
    /** Store a data:image payload as uploads/parents/P-####.jpg (512px square). */
    function photo_save_parent_dataurl(string $dataUrl, string $parentNo, int $max = 512): bool
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($parentNo)));
        if ($no === '' || $dataUrl === '') {
            return false;
        }
        if (! str_starts_with($no, 'P-')) {
            $no = 'P-' . $no;
        }

        if (! preg_match('#^data:image/(?:jpeg|jpg|png|webp);base64,#i', $dataUrl, $m)) {
            return false;
        }

        $binary = base64_decode(substr($dataUrl, strlen($m[0])), true);
        if ($binary === false || $binary === '') {
            return false;
        }

        $info = @getimagesizefromstring($binary);
        if ($info === false || $info[0] < 1 || $info[1] < 1) {
            return false;
        }

        $src = @imagecreatefromstring($binary);
        if ($src === false) {
            return false;
        }

        [$width, $height] = $info;
        $side = min($width, $height);
        $sx   = (int) (($width - $side) / 2);
        $sy   = (int) (($height - $side) / 2);

        $dst = imagecreatetruecolor($max, $max);
        imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
        imagecopyresampled($dst, $src, 0, 0, $sx, $sy, $max, $max, $side, $side);

        $dir = uploads_path('parents');
        if (! is_dir($dir) && ! @mkdir($dir, 0775, true) && ! is_dir($dir)) {
            imagedestroy($src);
            imagedestroy($dst);

            return false;
        }

        parent_photo_delete($no);

        $ok = imagejpeg($dst, $dir . $no . '.jpg', 90);

        imagedestroy($src);
        imagedestroy($dst);

        return (bool) $ok;
    }
}
if (! function_exists('teacher_photo_delete')) {
    function teacher_photo_delete(string $teacherNo): int
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($teacherNo)));
        if ($no === '') return 0;
        if (! str_starts_with($no, 'T-')) $no = 'T-' . $no;
        $removed = 0;
        foreach (student_photo_exts() as $ext) {
            $p = uploads_path('teachers') . $no . '.' . $ext;
            if (is_file($p) && @unlink($p)) $removed++;
        }
        return $removed;
    }
}

if (! function_exists('teacher_photo_url')) {
    function teacher_photo_url(string $teacherNo): string
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($teacherNo)));
        if ($no === '') return '';
        if (! str_starts_with($no, 'T-')) $no = 'T-' . $no;
        foreach (student_photo_exts() as $ext) {
            $p = uploads_path('teachers') . $no . '.' . $ext;
            if (is_file($p)) return base_url('uploads/teachers/' . basename($p)) . '?v=' . filemtime($p);
        }
        return '';
    }
}

if (! function_exists('photo_save_teacher_dataurl')) {
    function photo_save_teacher_dataurl(string $dataUrl, string $teacherNo, int $max = 400): bool
    {
        return photo_save_person_dataurl($dataUrl, 'uploads/teachers/', $teacherNo, $max, 'T-', 'teacher_photo_delete');
    }
}

if (! function_exists('staff_photo_delete')) {
    function staff_photo_delete(string $staffNo): int
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($staffNo)));
        if ($no === '') return 0;
        if (! str_starts_with($no, 'S-')) $no = 'S-' . $no;
        $removed = 0;
        foreach (student_photo_exts() as $ext) {
            $p = uploads_path('staffs') . $no . '.' . $ext;
            if (is_file($p) && @unlink($p)) $removed++;
        }
        return $removed;
    }
}

if (! function_exists('staff_photo_url')) {
    function staff_photo_url(string $staffNo): string
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($staffNo)));
        if ($no === '') return '';
        if (! str_starts_with($no, 'S-')) $no = 'S-' . $no;
        foreach (student_photo_exts() as $ext) {
            $p = uploads_path('staffs') . $no . '.' . $ext;
            if (is_file($p)) return base_url('uploads/staffs/' . basename($p)) . '?v=' . filemtime($p);
        }
        return '';
    }
}

if (! function_exists('photo_save_person_dataurl')) {
    /** Shared writer for teacher/staff photos. */
    function photo_save_person_dataurl(string $dataUrl, string $folder, string $no, int $max, string $prefix, string $deleter): bool
    {
        $no = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', trim($no)));
        if ($no === '' || $dataUrl === '') return false;
        if ($prefix !== '' && ! str_starts_with($no, $prefix)) $no = $prefix . $no;

        if (! preg_match('#^data:image/(?:jpeg|jpg|png|webp);base64,#i', $dataUrl, $m)) return false;
        $bin = base64_decode(substr($dataUrl, strlen($m[0])), true);
        if ($bin === false || $bin === '') return false;
        $info = @getimagesizefromstring($bin);
        if ($info === false) return false;
        $src = @imagecreatefromstring($bin);
        if ($src === false) return false;

        [$w, $h] = $info;
        $side = min($w, $h);
        $dst = imagecreatetruecolor($max, $max);
        imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
        imagecopyresampled($dst, $src, 0, 0, (int) (($w - $side) / 2), (int) (($h - $side) / 2), $max, $max, $side, $side);

        $dir = FCPATH . $folder;
        if (! is_dir($dir) && ! @mkdir($dir, 0775, true) && ! is_dir($dir)) {
            imagedestroy($src); imagedestroy($dst); return false;
        }
        if (function_exists($deleter)) { $deleter($no); }
        $ok = imagejpeg($dst, $dir . $no . '.jpg', 90);
        imagedestroy($src); imagedestroy($dst);
        return (bool) $ok;
    }
}

if (! function_exists('photo_save_staff_dataurl')) {
    function photo_save_staff_dataurl(string $dataUrl, string $staffNo, int $max = 400): bool
    {
        return photo_save_person_dataurl($dataUrl, 'uploads/staffs/', $staffNo, $max, 'S-', 'staff_photo_delete');
    }
}
if (! function_exists('subfetcher_photo_delete')) {
    /** Remove every extension variant of a sub-fetcher picture (uploads/subfetchers/{id}.jpg). */
    function subfetcher_photo_delete($id): int
    {
        $id = (int) $id;
        if ($id <= 0) return 0;
        $removed = 0;
        foreach (student_photo_exts() as $ext) {
            $p = uploads_path('subfetchers') . $id . '.' . $ext;
            if (is_file($p) && @unlink($p)) $removed++;
        }
        return $removed;
    }
}

if (! function_exists('subfetcher_photo_url')) {
    /** Web URL of a sub-fetcher picture ('' when none). */
    function subfetcher_photo_url($id): string
    {
        $id = (int) $id;
        if ($id <= 0) return '';
        foreach (student_photo_exts() as $ext) {
            $p = uploads_path('subfetchers') . $id . '.' . $ext;
            if (is_file($p)) return base_url('uploads/subfetchers/' . basename($p)) . '?v=' . filemtime($p);
        }
        return '';
    }
}

if (! function_exists('photo_save_subfetcher_dataurl')) {
    /** Store a data:image payload as uploads/subfetchers/{id}.jpg (400px square). */
    function photo_save_subfetcher_dataurl(string $dataUrl, $id, int $max = 400): bool
    {
        $id = (int) $id;
        if ($id <= 0 || $dataUrl === '') return false;
        if (! preg_match('#^data:image/(?:jpeg|jpg|png|webp);base64,#i', $dataUrl, $m)) return false;
        $bin = base64_decode(substr($dataUrl, strlen($m[0])), true);
        if ($bin === false || $bin === '') return false;
        $info = @getimagesizefromstring($bin);
        if ($info === false) return false;
        $src = @imagecreatefromstring($bin);
        if ($src === false) return false;
        [$w, $h] = $info; $side = min($w, $h);
        $dst = imagecreatetruecolor($max, $max);
        imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
        imagecopyresampled($dst, $src, 0, 0, (int) (($w - $side) / 2), (int) (($h - $side) / 2), $max, $max, $side, $side);
        $dir = uploads_path('subfetchers');
        if (! is_dir($dir) && ! @mkdir($dir, 0775, true) && ! is_dir($dir)) { imagedestroy($src); imagedestroy($dst); return false; }
        subfetcher_photo_delete($id);
        $ok = imagejpeg($dst, $dir . $id . '.jpg', 90);
        imagedestroy($src); imagedestroy($dst);
        return (bool) $ok;
    }
}