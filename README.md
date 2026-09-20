# CampusDesk – College Department Management System
HTML · CSS · PHP (8.0+) · MySQL

## Setup (XAMPP / WAMP / Laragon)
1. Copy the `college_dms` folder into `htdocs` (XAMPP) or `www` (WAMP).
2. Start Apache and MySQL.
3. Open phpMyAdmin → Import → choose `database.sql` (creates the `college_dms` database, tables and 3 sample departments).
4. Open `config.php` and check DB_USER / DB_PASS (XAMPP default: root, empty password) and BASE_URL (`/college_dms`).
5. Visit http://localhost/college_dms/

## Logins
- Admin: http://localhost/college_dms/admin/login.php  
  Default account, created automatically on first visit: **admin / admin123** (change it in the `admins` table, or generate a new hash with `password_hash()`).
- Students: register at /register.php, then log in at /login.php.

## Folder structure
```
college_dms/
├── index.php            landing page
├── register.php         student registration
├── login.php / logout.php
├── config.php           database + helper functions
├── database.sql
├── includes/            shared layout, student loader
├── admin/               dashboard, departments, faculty, students, notices, exams, results
├── student/             dashboard, department, notices, exams, results, profile
└── assets/css, assets/js
```

## Security built in
Prepared statements (PDO), password_hash / password_verify, CSRF tokens on every form,
output escaping, session ID regeneration on login, and page guards for admin and student areas.
