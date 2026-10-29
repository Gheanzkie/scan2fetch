<?php

/**
 * Lightweight user-agent fingerprinting (no external library).
 *
 * parse_user_agent($ua) returns:
 *   device   - Phone | Tablet | Desktop | Bot
 *   brand    - phone/laptop brand when it can be recognised (Apple, Samsung, ...)
 *   browser  - Chrome | Firefox | Edge | Safari | Opera | ... (+ major version)
 *   platform - Android | iOS | Windows | macOS | Linux | ChromeOS | Unknown
 */
if (! function_exists('parse_user_agent')) {
    function parse_user_agent(?string $ua): array
    {
        $ua = trim((string) $ua);

        $out = ['device' => 'Unknown', 'brand' => null, 'browser' => null, 'platform' => null];
        if ($ua === '') {
            return $out;
        }

        $low = strtolower($ua);

        /* ---------------- platform ---------------- */
        $platform = 'Unknown';
        if (str_contains($low, 'windows')) {
            $platform = 'Windows';
        } elseif (str_contains($low, 'android')) {
            $platform = 'Android';
        } elseif (preg_match('/iphone|ipad|ipod/', $low)) {
            $platform = 'iOS';
        } elseif (str_contains($low, 'mac os x') || str_contains($low, 'macintosh')) {
            $platform = 'macOS';
        } elseif (str_contains($low, 'cros')) {
            $platform = 'ChromeOS';
        } elseif (str_contains($low, 'linux')) {
            $platform = 'Linux';
        }
        $out['platform'] = $platform;

        /* ---------------- device type ---------------- */
        if (preg_match('/bot|crawler|spider|curl|wget|python-requests|postman/i', $ua)) {
            $out['device'] = 'Bot';
        } elseif (preg_match('/ipad|tablet|playbook|silk|(android(?!.*mobile))/i', $ua)) {
            $out['device'] = 'Tablet';
        } elseif (preg_match('/mobile|iphone|ipod|android|blackberry|opera mini|iemobile|windows phone/i', $ua)) {
            $out['device'] = 'Phone';
        } else {
            $out['device'] = 'Desktop';
        }

        /* ---------------- brand ---------------- */
        $brands = [
            'Apple'        => '/iphone|ipad|ipod|macintosh|mac os x/i',
            'Samsung'      => '/samsung|sm-[a-z]\d|galaxy/i',
            'Google'       => '/pixel/i',
            'Xiaomi'       => '/xiaomi|redmi|poco|mi \d|mi note/i',
            'OPPO'         => '/oppo|cph\d/i',
            'Vivo'         => '/vivo|v\d{4}/i',
            'Realme'       => '/realme|rmx\d/i',
            'OnePlus'      => '/oneplus|(?:^|\W)ne\d|kb\d/i',
            'Huawei'       => '/huawei|honor|(?:^|\W)ane?-|(?:^|\W)lya?-|(?:^|\W)ele-/i',
            'Infinix'      => '/infinix|x\d{3}[a-z]?/i',
            'Tecno'        => '/tecno|(?:^|\W)ck\d/i',
            'itel'         => '/itel/i',
            'Nokia'        => '/nokia/i',
            'Motorola'     => '/motorola|moto [a-z]/i',
            'Sony'         => '/sony|xperia/i',
            'LG'           => '/lg-|lge/i',
            'Dell'         => '/dell/i',
            'HP'           => '/hp-|hewlett|pavilion|elitebook|probook/i',
            'Lenovo'       => '/lenovo|thinkpad|ideapad/i',
            'ASUS'         => '/asus|vivobook|zenbook|rog /i',
            'Acer'         => '/acer|aspire|swift /i',
            'MSI'          => '/msi/i',
            'Toshiba'      => '/toshiba|dynabook/i',
            'Razer'        => '/razer/i',
            'Microsoft'    => '/surface/i',
            'Chrome OS'    => '/cros/i',
        ];
        foreach ($brands as $name => $pattern) {
            if (preg_match($pattern, $ua)) {
                $out['brand'] = $name;
                break;
            }
        }
        // Windows/Linux desktops rarely expose the maker; keep the OS as the brand hint.
        if ($out['brand'] === null && in_array($platform, ['Windows', 'Linux', 'ChromeOS'], true)) {
            $out['brand'] = $platform . ' PC';
        }

        /* ---------------- browser (+ version) ---------------- */
        $browser = 'Unknown';
        $rules = [
            'Edge'            => '/edg(?:e|a|ios)?\/([\d.]+)/i',
            'Opera'           => '/opr\/([\d.]+)|opera[ \/]([\d.]+)/i',
            'Samsung Internet'=> '/samsungbrowser\/([\d.]+)/i',
            'UC Browser'      => '/ucbrowser\/([\d.]+)/i',
            'Vivo Browser'    => '/vivobrowser\/([\d.]+)/i',
            'Miui Browser'    => '/miuibrowser\/([\d.]+)/i',
            'Brave'           => '/brave\/([\d.]+)/i',
            'Firefox'         => '/firefox\/([\d.]+)|fxios\/([\d.]+)/i',
            'Chrome'          => '/chrome\/([\d.]+)|crios\/([\d.]+)/i',
            'Safari'          => '/version\/([\d.]+).*safari|safari\/([\d.]+)/i',
            'Internet Explorer' => '/msie ([\d.]+)|trident\/.*rv:([\d.]+)/i',
        ];
        foreach ($rules as $name => $pattern) {
            if (preg_match($pattern, $ua, $m)) {
                $version = '';
                for ($i = 1; $i < count($m); $i++) {
                    if (! empty($m[$i])) {
                        $version = ' ' . explode('.', $m[$i])[0];
                        break;
                    }
                }
                $browser = $name . $version;
                break;
            }
        }
        $out['browser'] = $browser;

        return $out;
    }
}

if (! function_exists('client_ip')) {
    /**
     * Best-effort real client IP (works behind the usual proxies/tunnels).
     */
    function client_ip(): ?string
    {
        $candidates = [
            $_SERVER['HTTP_CF_CONNECTING_IP'] ?? null,
            $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null,
            $_SERVER['HTTP_X_REAL_IP'] ?? null,
            $_SERVER['REMOTE_ADDR'] ?? null,
        ];

        foreach ($candidates as $value) {
            if (empty($value)) {
                continue;
            }
            foreach (explode(',', (string) $value) as $ip) {
                $ip = trim($ip);
                if ($ip !== '' && filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return null;
    }
}
