<?php
/* ------------------------------------------------------------------
   Core configuration + helper functions
   ------------------------------------------------------------------ */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Database settings (edit these) ---
define('DB_HOST', 'localhost');
define('DB_NAME', 'college_dms');
define('DB_USER', 'root');
define('DB_PASS', '');

// --- Folder name inside htdocs (XAMPP) / www (WAMP). No trailing slash. ---
define('BASE_URL', '/college_dms');
define('APP_NAME', 'CampusDesk');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed. Check config.php and make sure you imported database.sql.');
}

/* Escape output */
function e($value): string {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

/* CSRF protection */
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}
function csrf_check(): void {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419);
        die('Your session expired. Go back, refresh the page and try again.');
    }
}

/* Flash messages */
function flash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}
function show_flash(): void {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        $icon = $f['type'] === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
        echo '<div class="alert alert-' . e($f['type']) . '"><i class="fa-solid ' . $icon . '"></i><span>'
            . e($f['message']) . '</span></div>';
    }
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

/* Access guards */
function require_admin(): void {
    if (empty($_SESSION['admin_id'])) {
        redirect(BASE_URL . '/admin/login.php');
    }
}
function require_student(): void {
    if (empty($_SESSION['student_id'])) {
        redirect(BASE_URL . '/login.php');
    }
}

/* Grades */
function calc_grade(float $marks, float $max): string {
    $p = $max > 0 ? ($marks / $max) * 100 : 0;
    if ($p >= 90) return 'A+';
    if ($p >= 80) return 'A';
    if ($p >= 70) return 'B+';
    if ($p >= 60) return 'B';
    if ($p >= 50) return 'C';
    if ($p >= 40) return 'D';
    return 'F';
}

function year_label(int $y): string {
    return match ($y) {
        0 => 'All years',
        1 => 'First year',
        2 => 'Second year',
        3 => 'Third year',
        4 => 'Fourth year',
        default => 'Year ' . $y,
    };
}
