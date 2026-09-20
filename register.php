<?php
require_once __DIR__ . '/config.php';
if (!empty($_SESSION['student_id'])) redirect('student/dashboard.php');

$departments = $pdo->query('SELECT id, name FROM departments ORDER BY name')->fetchAll();
$old = ['name' => '', 'email' => '', 'roll_no' => '', 'department_id' => '', 'year' => '', 'phone' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    foreach ($old as $k => $_) $old[$k] = trim($_POST[$k] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';
    $error = '';

    if ($old['name'] === '' || $old['email'] === '' || $old['roll_no'] === '' || $old['department_id'] === '' || $old['year'] === '') {
        $error = 'Fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif ((int)$old['year'] < 1 || (int)$old['year'] > 4) {
        $error = 'Choose a valid year.';
    } else {
        $chk = $pdo->prepare('SELECT COUNT(*) FROM students WHERE email = ? OR roll_no = ?');
        $chk->execute([$old['email'], $old['roll_no']]);
        if ($chk->fetchColumn() > 0) {
            $error = 'An account with this email or roll number already exists.';
        } else {
            $ins = $pdo->prepare('INSERT INTO students (department_id, name, email, roll_no, year, phone, password) VALUES (?,?,?,?,?,?,?)');
            $ins->execute([(int)$old['department_id'], $old['name'], $old['email'], $old['roll_no'], (int)$old['year'], $old['phone'], password_hash($password, PASSWORD_DEFAULT)]);
            flash('success', 'Account created. Log in with your email and password.');
            redirect('login.php');
        }
    }
    if ($error) flash('error', $error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student registration · <?= APP_NAME ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="auth">
  <aside class="auth-side">
    <a class="brand-line" href="index.php"><span class="brand-mark"><i class="fa-solid fa-graduation-cap"></i></span><?= APP_NAME ?></a>
    <div>
      <h2>Join your department's portal.</h2>
      <p>One account gives you notices, exam dates and results for your department and year.</p>
      <ul>
        <li><i class="fa-solid fa-circle-check"></i> Notices from your department</li>
        <li><i class="fa-solid fa-circle-check"></i> Exam schedule for your year</li>
        <li><i class="fa-solid fa-circle-check"></i> Results as soon as they are declared</li>
      </ul>
    </div>
    <span></span>
  </aside>
  <div class="auth-main">
    <div class="auth-box">
      <h1>Create your account</h1>
      <p class="sub">Students register here. Admin accounts are created by the college.</p>
      <?php show_flash(); ?>
      <form method="post" autocomplete="off">
        <?= csrf_field() ?>
        <div class="form-grid">
          <div class="field full"><label for="name">Full name *</label>
            <input id="name" name="name" value="<?= e($old['name']) ?>" required></div>
          <div class="field full"><label for="email">Email *</label>
            <input id="email" type="email" name="email" value="<?= e($old['email']) ?>" required></div>
          <div class="field"><label for="roll_no">Roll number *</label>
            <input id="roll_no" name="roll_no" value="<?= e($old['roll_no']) ?>" required></div>
          <div class="field"><label for="phone">Phone</label>
            <input id="phone" name="phone" value="<?= e($old['phone']) ?>"></div>
          <div class="field"><label for="department_id">Department *</label>
            <select id="department_id" name="department_id" required>
              <option value="">Select department</option>
              <?php foreach ($departments as $d): ?>
                <option value="<?= $d['id'] ?>" <?= $old['department_id'] == $d['id'] ? 'selected' : '' ?>><?= e($d['name']) ?></option>
              <?php endforeach; ?>
            </select></div>
          <div class="field"><label for="year">Year *</label>
            <select id="year" name="year" required>
              <option value="">Select year</option>
              <?php for ($y = 1; $y <= 4; $y++): ?>
                <option value="<?= $y ?>" <?= $old['year'] == $y ? 'selected' : '' ?>><?= year_label($y) ?></option>
              <?php endfor; ?>
            </select></div>
          <div class="field"><label for="password">Password *</label>
            <input id="password" type="password" name="password" minlength="6" required></div>
          <div class="field"><label for="confirm">Confirm password *</label>
            <input id="confirm" type="password" name="confirm" minlength="6" required></div>
        </div>
        <div class="form-actions"><button class="btn btn-primary btn-block" type="submit">Create account</button></div>
      </form>
      <p class="alt">Already registered? <a href="login.php">Log in</a></p>
    </div>
  </div>
</div>
</body>
</html>
