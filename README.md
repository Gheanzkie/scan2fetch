# BCC Scan2Fetch

**Student Release & Pickup Management System** for schools — QR-based release, role-based access, and SMS notifications.

---

## 🔑 Login Info

Login uses the **phone / username field** shown below + the password.

| Role   | Login field | Password     | Status                 |
|--------|-------------|--------------|------------------------|
| Admin  | `admin`     | `ghean123`   | ✅ verified working    |
| Staff  | `staff`     | `ghean123`   | ✅ verified working    |
| Teacher| `teacher1`  | `ghean123`   | ✅ verified working    |
| Teacher| `teacher2`  | set via SMS  | ⚠️ password not default — admin uses **Send Password** (shown in SMS Logs) |
| Teacher| `teacher3`  | set via SMS  | ⚠️ same as above        |
| Parent | phone no. (e.g. `09910000001`) | set via SMS | ⚠️ parent passwords are sent manually by admin |

> Passwords are bcrypt-hashed. Admin can reset any account password from the
> management pages — the new password is recorded in **SMS Logs**.

---

## 📋 About the System

**BCC Scan2Fetch** manages student pickup: only authorized guardians can fetch a
student, verified by QR scan (or manual QR input) at the gate. Every release is
logged and triggers an optional SMS notification to the parent.

---

## ✨ Functions by Role

### Admin
- Full **Dashboard** with real-time statistics (students, parents, staff, releases today, SMS sent, QR releases)
- **Register students** (multi-student form + parent/guardian + authorized fetchers, auto QR code generation)
- **Excel import** of students + parents (`.xlsx`)
- **ZIP import of profile photos** — extracts straight into `public/uploads/<folder>/` with no extra nesting (`parents/`, `students/`, `teachers/`, `staffs/`, `subfetchers/`, `qr/`)
- **Student Management** — list (live auto-refresh), view, edit (floating modal incl. **editable Student ID** + profile picture), delete (cascade: parents, sub-fetchers, logs), delete-all
- **Parent Management** — list, view, edit (floating modal incl. **editable Parent ID** + profile picture), send password (single / all), delete, delete-all
- **Teacher Management** — list (with student counts), view class, add/edit, delete, send password
- **Staff Management** — add/edit, send password, delete
- **Sub-Fetcher management** (add/update/delete authorized fetchers per student)
- **Date / Schedule Management** — open/close days, sessions (morning/afternoon), gate clock
- **Students Status monitor** (`/scan-monitor`) — pending pickups, send SMS reminders, auto-fire by time, SMS mode
- **Activity Logs** — every create/update/delete/login action tracked
- **SMS Logs** — full message history, details, delete/clear
- **Messages** — parent ↔ admin chat (unread badge)
- **Release history filters** — date range + text search + reset + row counter on the
  parent release/log tables
- Profile update + change password (verifies current password)

### Staff
- **QR Scanner** (`/scan`) — camera scan + manual input, verify parent/fetcher, release students (per-tick or auto release all), decline
- **Pickup / kiosk panel** (`/scan-kiosk`) — after a release shows the fetcher photo + name + relationship on the left and the student photo + name + grade on the right, with a **15-second countdown** freeze before the camera re-arms
- **Students Status** (`/scan-monitor`) — pending list, released log, send notifications
- Change password
- No dashboard: staff is gate-only (`/scan` + `/scan-monitor`), login lands directly on the scanner

### Teacher
- **My Students** (`/teachers-view/{own id}`) — class roster with release status for a chosen date, per-student pickup history (30 days), parent contacts (read-only)
- **Student detail view** (`/teachers-student-view/{id}`) — own class only (adviser/section enforced)
- **SMS Notifications** — own phone's message history, delete/clear own
- Teacher Dashboard (class list, released/pending today)
- Change password

### Parent
- **My Children** (`/parents-children`) — linked students, teacher per section, release status
- **Release History** (`/parents-releases`) — date filter + search, own children only
- **Sub-Fetchers** (`/parents-subfetchers`) — view own authorized fetchers (creation is admin-only)
- **SMS Notifications** (`/parents-notifications`) — delete/clear own
- **Messages** — contact admin (chat with unread badge)
- Profile view/edit (self only — no password change here; use change-password)
- Parent Dashboard (children, release history, today status)

### Access control (deny-by-default)
`app/Filters/AuthFilter.php` enforces a role → module ACL on every route;
unknown paths 404, and unauthorized modules redirect to the role home:

- **Admin-only:** register, students writes (save/update/delete/import/add-parent/remove-parent), parents directory, teachers/staffs management, subfetchers, logs, sms-logs, schedule, admin
- **Admin + Staff:** scan-monitor, schedule-status, students (read)
- **Staff-only:** scan (QR scanner) and scan-kiosk (pickup panel)
- **Teacher:** dashboard, students read + own class views, teachers self-service
- **Parent:** dashboard, messages, parents self-service (own record only)

---

## 👤 Profile pictures

Every person record has one optional profile photo, stored as a plain file — no
`photo` column in the database. The URL is resolved from the record's ID:

| Person | File |
|---|---|
| Student | `public/uploads/students/{student_no}.jpg` |
| Parent | `public/uploads/parents/{parent_no}.jpg` |
| Teacher | `public/uploads/teachers/T-####.jpg` |
| Staff | `public/uploads/staffs/S-####.jpg` |
| Sub-fetcher | `public/uploads/subfetchers/{id}.jpg` |

- Photos are cropped in the browser to a **400×400 JPEG** (`toDataURL('image/jpeg', 0.9)`) before POST.
- `app/Helpers/photo_helper.php` provides `*_photo_url()`, `photo_save_*_dataurl()` and `*_photo_delete()`; every controller that renders a view using a photo helper must `helper('photo')`.
- Because lookup is filename-based, a photo dropped into `uploads/students/1001.jpg` shows up for any student whose `student_no` is `1001` (IDs are normalised to digits for matching).
- Any avatar in the app can be clicked to open the global lightbox (`#globalPhotoModal`).

> On this XAMPP install the project root also needs an `uploads` entry, so
> `scan2fetch\uploads` is a **junction** to `public\uploads` (`mklink /J`). Without
> it every image URL 404s.

## 📝 Name display

All person names are rendered through one helper, `app/Helpers/name_helper.php`
(autoloaded from `BaseController`):

- `full_name($row)` → `fname mname lname`, empty parts skipped
- `full_name($row, 'student_')` → uses `student_fname` / `student_mname` / `student_lname` aliases
- `full_name_initial($row)` → `JD`

Lists, modals, the scanner, the kiosk panel and the log/report tables all show the
complete three-part name; edit forms still bind to `fname` only via `data-fname`.

---

## 🛠️ Tech Stack

- **Backend:** CodeIgniter 4 (PHP 8.2)
- **Frontend:** AdminLTE 3, Bootstrap 4, jQuery
- **Database:** MySQL (XAMPP)
- **QR Code:** PHPQRCode
- **Camera:** HTML5 getUserMedia API
- **SMS:** TextBee gateway (simulated locally when `SMS_SIMULATION=true`)

---

## 📁 Project structure

- `app/` — controllers, models, views, filters, config, **helpers** (`photo_helper.php`, `name_helper.php`)
- `public/` — **web root**: static assets, uploads, QR images, front controller
- `system/`, `vendor/` — framework + dependencies (do not edit)
- `writable/` — logs, sessions, debugbar cache (git-ignored)

> The duplicate `public/public/` AdminLTE tree was removed (≈202 MB). All views
> reference assets via `base_url('assets/...')`, resolving against the single
> `public/` root.

## 🧹 Maintenance notes

- Legacy `Admin` controller and its dead `admin/*` routes were removed; profile
  updates go through `Auth::updateProfile` (`POST update-profile`).
- Unused `menu_helper` and dead `StudentModel` query methods were removed.
- `app/Config/WorkerMode.php` and `app/Config/Boot/*.php` are stock CI 4.5 files.
- Student / parent editing moved into floating modals (`#editStudentModal`,
  `#editParentModal`); the old `students_edit.php` / `parents_edit.php` views and
  their routes were deleted.
- Editing a Student ID or Parent ID checks for duplicates and copies the existing
  photo file to the new filename so the picture does not disappear.
- Kiosk timings are centralised in `scan_kiosk.php`: `PICKUP_MS` (15 s freeze),
  `FLASH_MS`, `FLASH_ALREADY_MS`.
- `fetch_logs.fetcher_mname` is written on every new release; older rows stay blank.

---

## 🚀 Installation

1. Clone the repository:
```bash
git clone https://github.com/Gheanzkie/scan2fetch.git
```
2. Import `scan2fetch.sql` into MySQL
3. Configure `.env` (database + SMS settings)
4. Serve with the web root set to `public/`
   - Local: `php spark serve --host 0.0.0.0 --port 8080`
   - Apache/XAMPP: point `DocumentRoot` at the project's `public/` folder
5. Open http://localhost:8080/login

> Static assets (`assets/`, `image/`, `uploads/`, `html5qrcode/`, `phpqrcode/`)
> are referenced root-relative (`base_url('assets/...')`) and served from `public/`.

---

## 🔒 Security notes

- Session-based auth, `session()->regenerate()` on login, deny-by-default ACL filter
- Global CSRF protection (cookie mode) on all POST/requests
- Passwords: `password_hash()` bcrypt
- Role checks in controllers as second layer (parent/teacher cannot reach admin/staff modules — verified by URL matrix tests for every role)
