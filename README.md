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
- **Student Management** — list (live auto-refresh), view, edit, delete (cascade: parents, sub-fetchers, logs), delete-all
- **Parent Management** — list, view, edit, send password (single / all), delete, delete-all
- **Teacher Management** — list (with student counts), view class, add/edit, delete, send password
- **Staff Management** — add/edit, send password, delete
- **Sub-Fetcher management** (add/update/delete authorized fetchers per student)
- **Date / Schedule Management** — open/close days, sessions (morning/afternoon), gate clock
- **Students Status monitor** (`/scan-monitor`) — pending pickups, send SMS reminders, auto-fire by time, SMS mode
- **Activity Logs** — every create/update/delete/login action tracked
- **SMS Logs** — full message history, details, delete/clear
- **Messages** — parent ↔ admin chat (unread badge)
- Profile update + change password (verifies current password)

### Staff
- **QR Scanner** (`/scan`) — camera scan + manual input, verify parent/fetcher, release students (per-tick or auto release all), decline
- **Students Status** (`/scan-monitor`) — pending list, send notifications
- Dashboard with own release stats
- Change password

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
- **Staff-only:** scan (QR scanner)
- **Teacher:** dashboard, students read + own class views, teachers self-service
- **Parent:** dashboard, messages, parents self-service (own record only)

---

## 🛠️ Tech Stack

- **Backend:** CodeIgniter 4 (PHP 8.2)
- **Frontend:** AdminLTE 3, Bootstrap 4, jQuery
- **Database:** MySQL (XAMPP)
- **QR Code:** PHPQRCode
- **Camera:** HTML5 getUserMedia API
- **SMS:** TextBee gateway (simulated locally when `SMS_SIMULATION=true`)

---

## 🚀 Installation

1. Clone the repository into `htdocs`
```bash
git clone https://github.com/Gheanzkie/scan2fetch.git
```
2. Import `scan2fetch.sql` into MySQL
3. Configure `.env` (database + SMS settings)
4. Open `/scan2fetch/login`

---

## 🔒 Security notes

- Session-based auth, `session()->regenerate()` on login, deny-by-default ACL filter
- Global CSRF protection (cookie mode) on all POST/requests
- Passwords: `password_hash()` bcrypt
- Role checks in controllers as second layer (parent/teacher cannot reach admin/staff modules — verified by URL matrix tests for every role)
