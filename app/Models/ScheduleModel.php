<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Day schedule (open/close) management.
 * One row per calendar date. Created on the fly like SettingsModel.
 */
class ScheduleModel extends Model
{
    protected $table = 'day_schedules';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'schedule_date', 'status', 'open_time', 'close_time',
        'morning_status', 'afternoon_status',
        'opened_at', 'opened_by', 'closed_at', 'closed_by',
        'notes', 'created_at', 'updated_at',
    ];
    protected $useTimestamps = false;

    public function __construct()
    {
        parent::__construct();
        $this->ensureTable();
        $this->ensureSessionColumns();
    }

    /**
     * Per-session release switches (Date Management morning/afternoon).
     * Applies the ALTER only when the columns are missing.
     * NULL = session enabled (default), 'closed' = releases blocked.
     */
    protected function ensureSessionColumns(): void
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('day_schedules');
        $add = [];
        if (! in_array('morning_status', $fields)) {
            $add['morning_status'] = [
                'type'       => 'ENUM',
                'constraint' => ['open', 'closed'],
                'null'       => true,
                'default'    => null,
            ];
        }
        if (! in_array('afternoon_status', $fields)) {
            $add['afternoon_status'] = [
                'type'       => 'ENUM',
                'constraint' => ['open', 'closed'],
                'null'       => true,
                'default'    => null,
            ];
        }
        if ($add !== []) {
            foreach ($add as $name => $def) {
                $db->query("ALTER TABLE `day_schedules` ADD COLUMN `{$name}` ENUM('open','closed') NULL DEFAULT NULL");
            }
        }
    }

    protected function ensureTable(): void
    {
        $db = \Config\Database::connect();
        $db->query("CREATE TABLE IF NOT EXISTS `day_schedules` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `schedule_date` DATE NOT NULL,
            `status` ENUM('normal','open','closed','holiday') NOT NULL DEFAULT 'normal',
            `open_time` TIME NULL DEFAULT NULL,
            `close_time` TIME NULL DEFAULT NULL,
            `morning_status` ENUM('open','closed') NULL DEFAULT NULL,
            `afternoon_status` ENUM('open','closed') NULL DEFAULT NULL,
            `opened_at` DATETIME NULL DEFAULT NULL,
            `opened_by` VARCHAR(100) NULL DEFAULT NULL,
            `closed_at` DATETIME NULL DEFAULT NULL,
            `closed_by` VARCHAR(100) NULL DEFAULT NULL,
            `notes` VARCHAR(255) NULL DEFAULT NULL,
            `created_at` DATETIME NULL DEFAULT NULL,
            `updated_at` DATETIME NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `schedule_date` (`schedule_date`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
    }

    /** Row for a date or null. */
    public function forDate(string $date): ?array
    {
        return $this->where('schedule_date', $date)->first();
    }

    /** Create-or-update a schedule row for a date. */
    public function upsert(string $date, array $data): array
    {
        $existing = $this->forDate($date);
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($existing) {
            $this->update($existing['id'], $data);
            return $this->forDate($date);
        }

        $data['schedule_date'] = $date;
        $data['created_at']    = date('Y-m-d H:i:s');
        $this->insert($data);
        return $this->forDate($date);
    }

    /** Manual start of day. */
    public function openDay(string $date, array $by, ?string $openTime = null): array
    {
        $data = [
            'status'   => 'open',
            'opened_at' => date('Y-m-d H:i:s'),
            'opened_by' => trim(($by['fname'] ?? '') . ' ' . ($by['lname'] ?? '')),
            'closed_at' => null,
            'closed_by' => null,
        ];
        if ($openTime) {
            $data['open_time'] = $openTime;
        }
        return $this->upsert($date, $data);
    }

    /** Manual out / end of day. */
    public function closeDay(string $date, array $by, ?string $closeTime = null): array
    {
        $data = [
            'status'    => 'closed',
            'closed_at' => date('Y-m-d H:i:s'),
            'closed_by' => trim(($by['fname'] ?? '') . ' ' . ($by['lname'] ?? '')),
        ];
        if ($closeTime) {
            $data['close_time'] = $closeTime;
        }
        return $this->upsert($date, $data);
    }

    /**
     * Effective operating hours for a date:
     * row override -> settings default -> 07:00 / 17:00.
     */
    public function effectiveHours(string $date): array
{
        $settings = new SettingsModel();
        $row = $this->forDate($date);

        $open  = $row['open_time']  ?? null;
        $close = $row['close_time'] ?? null;

        if ($open === null || $open === '') {
            $open = $settings->getSetting('default_open_time', '07:00');
        }
        if ($close === null || $close === '') {
            $close = $settings->getSetting('default_close_time', '17:00');
        }

        // MySQL TIME may come back as 07:00:00 — trim to HH:MM.
        return [
            'open'  => substr($open, 0, 5),
            'close' => substr($close, 0, 5),
            'row'   => $row,
        ];
    }

    /**
     * Auto-transition today's status based on the clock.
     * - status 'normal' + time >= open_time  => mark 'open'  (auto start)
     * - status 'normal'|'open' + time >= close_time => mark 'closed' (auto close)
     * Holiday rows and already-closed rows are left untouched.
     * Rows are only created/mutated for today's date.
     *
     * @return array|null The (possibly updated) row for the date, or null when no row exists yet.
     */
    public function autoSync(?string $now = null): ?array
    {
        $now  = $now ?: date('Y-m-d H:i:s');
        $date = substr($now, 0, 10);
        $time = substr($now, 11, 5);

        $row = $this->forDate($date);
        if (! $row) {
            // No row yet: create one once the window opens so the calendar
            // reflects an auto-started day. Before open time, stay absent.
            $hours = $this->effectiveHours($date);
            if ($time >= $hours['open'] && $time < $hours['close']) {
                return $this->upsert($date, [
                    'status'    => 'open',
                    'open_time' => $hours['open'],
                    'close_time'=> $hours['close'],
                    'opened_at' => $now,
                    'opened_by' => 'Auto (schedule)',
                ]);
            }
            if ($time >= $hours['close']) {
                return $this->upsert($date, [
                    'status'    => 'closed',
                    'open_time' => $hours['open'],
                    'close_time'=> $hours['close'],
                    'opened_at' => $date . ' ' . $hours['open'] . ':00',
                    'opened_by' => 'Auto (schedule)',
                    'closed_at' => $now,
                    'closed_by' => 'Auto (schedule)',
                ]);
            }
            return null;
        }

        if ($row['status'] === 'holiday' || $row['status'] === 'closed') {
            return $row;
        }

        // ===== ADMIN OVERRIDE: explicit "open" =====
        // opened_by holds the admin's name when a human picked "open" in Date
        // Management, and 'Auto (schedule)' when the clock opened the day.
        // A human choice wins over the clock, so it is never dragged back to
        // 'closed' after close_time. Rows the scheduler opened itself still
        // fall through below, preserving normal auto-open/auto-close behaviour.
        if ($row['status'] === 'open'
            && ($row['opened_by'] ?? '') !== 'Auto (schedule)'
            && ($row['opened_by'] ?? '') !== '') {
            return $row;
        }

        $hours = $this->effectiveHours($date);
        $open  = $hours['open'];
        $close = $hours['close'];

        // Past closing time -> auto close (covers both 'normal' and manually 'open').
        if ($time >= $close) {
            if ($row['status'] !== 'closed') {
                $this->update($row['id'], [
                    'status'    => 'closed',
                    'closed_at' => $now,
                    'closed_by' => $row['closed_by'] ?: 'Auto (schedule)',
                    'updated_at'=> $now,
                ]);
                return $this->forDate($date);
            }
            return $row;
        }

        // Within window but still 'normal' -> auto start.
        if ($row['status'] === 'normal' && $time >= $open) {
            $this->update($row['id'], [
                'status'    => 'open',
                'opened_at' => $row['opened_at'] ?: $now,
                'opened_by' => $row['opened_by'] ?: 'Auto (schedule)',
                'updated_at'=> $now,
            ]);
            return $this->forDate($date);
        }

        return $row;
    }

    /**
     * Current release session from SERVER time (never client/browser time).
     *
     * MORNING   = 00:00 up to (but not including) 12:00
     * AFTERNOON = 12:00 onwards
     *
     * Combined with the daily gate (releaseAllowed) the effective windows are:
     *   morning   -> operating hours up to 11:59
     *   afternoon -> 12:00 up to operating close
     * Counts reset at midnight automatically (fetch_logs are filtered per date),
     * so every day starts fresh: 1 morning scan + 1 afternoon scan per student.
     *
     * @return string 'morning' | 'afternoon'
     */
    public function getCurrentSession(?string $now = null): string
    {
        $now  = $now ?: date('Y-m-d H:i:s');
        $time = substr($now, 11, 5); // HH:MM from server clock

        return ($time < '12:00') ? 'morning' : 'afternoon';
    }

    /**
     * Resolve the session actually in effect for a scanner operator.
     *
     * An admin may MANUALLY switch the session on the scan page (stored in
     * their PHP session as 'scan_session' = 'morning'|'afternoon'). When no
     * valid override is present the server clock decides, exactly as before.
     *
     * @param string|null $override 'morning' | 'afternoon' | null/'auto'
     * @return string 'morning' | 'afternoon'
     */
    public function resolveSession(?string $override = null, ?string $now = null): string
    {
        if ($override === 'morning' || $override === 'afternoon') {
            return $override;
        }
        return $this->getCurrentSession($now);
    }

    /**
     * The override currently stored in the caller's PHP session, if any.
     * 'auto' (or anything unexpected) = no override.
     */
    public function sessionOverride(): ?string
    {
        $v = session('scan_session');
        return ($v === 'morning' || $v === 'afternoon') ? $v : null;
    }

    /**
     * Is releasing allowed right now?
     * Returns [bool allowed, string message].
     *
     * @param string|null $sessionOverride Manual session picked on the scan
     *                                     page ('morning'|'afternoon'|null).
     *                                     Only affects WHICH per-session
     *                                     switch is checked — the day's
     *                                     open/close window still comes from
     *                                     the server clock.
     */
    public function releaseAllowed(?string $now = null, ?string $sessionOverride = null): array
    {
        $now  = $now ?: date('Y-m-d H:i:s');
        $date = substr($now, 0, 10);
        $time = substr($now, 11, 5);

        // Auto start / auto close the day based on the configured hours.
        $this->autoSync($now);

        $hours = $this->effectiveHours($date);
        $row   = $hours['row'];

        if ($row && $row['status'] === 'holiday') {
            return [false, 'No classes today (holiday). Releases are disabled.'];
        }
        if ($row && $row['status'] === 'closed') {
            return [false, 'Scanner is not available this time. Day already closed' . ($row['closed_by'] ? ' by ' . $row['closed_by'] : '') . '.'];
        }

        // ===== PER-SESSION SWITCHES (Date Management morning/afternoon) =====
        // The session is the admin's manual pick when one is set on the scan
        // page; otherwise it comes from the SERVER clock. The switch can only
        // restrict (or re-enable) releases for that session, never extend past
        // the day's operating window or closed/holiday overrides above.
        $session = $this->resolveSession($sessionOverride, $now);
        $sessionOverride = null;
        if ($row) {
            $sessionOverride = $session === 'morning'
                ? ($row['morning_status'] ?? null)
                : ($row['afternoon_status'] ?? null);
        }
        if ($sessionOverride === 'closed') {
            return [false, strtoupper($session) . ' session is manually closed in Date Management. Releases for this session are disabled.'];
        }
        // 'open' or NULL (default) -> continue with normal window checks below.
        if ($row && $row['status'] === 'open') {
            // Manually opened (opened_by is a person): allowed regardless of the
            // clock — the admin explicitly chose to keep the day open past
            // close_time. Rows the clock opened itself are still capped by
            // close_time, exactly as before.
            $openedBy = (string) ($row['opened_by'] ?? '');
            $manual   = $openedBy !== '' && $openedBy !== 'Auto (schedule)';

            if ($manual) {
                return [true, 'Day manually opened.'];
            }
            if ($time >= $hours['close']) {
                return [false, "Scanner is not available this time. System closed at {$hours['close']}. Current time {$time}."];
            }
            return [true, 'Day opened.'];
        }

        // status normal (or no row): enforce default window.
        if ($time < $hours['open']) {
            return [false, "Scanner is not available this time. System opens at {$hours['open']}. Current time {$time}."];
        }
        if ($time >= $hours['close']) {
            return [false, "Scanner is not available this time. System closed at {$hours['close']}. Current time {$time}."];
        }
        return [true, "Within operating hours ({$hours['open']}–{$hours['close']})."];
    }

    /**
     * All schedule rows in a month (for calendar coloring).
     * @return array<string,array> keyed by 'Y-m-d'
     */
    public function monthMap(string $yearMonth): array
    {
        $rows = $this->where('schedule_date >=', $yearMonth . '-01')
            ->where('schedule_date <=', date('Y-m-t', strtotime($yearMonth . '-01')))
            ->findAll();

        $map = [];
        foreach ($rows as $r) {
            $map[$r['schedule_date']] = $r;
        }
        return $map;
    }
}
