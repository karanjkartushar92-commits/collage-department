<?php
require_once __DIR__ . '/config.php';
if (!empty($_SESSION['student_id'])) redirect('student/dashboard.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    $st = $pdo->prepare('SELECT * FROM students WHERE email = ?');
    $st->execute([$email]);
    $s = $st->fetch();
    if ($s && password_verify($pass, $s['password'])) {
        session_regenerate_id(true);
        $_SESSION['student_id'] = $s['id'];
        $_SESSION['student_name'] = $s['name'];
        redirect('student/dashboard.php');
    }
    flash('error', 'Email or password is incorrect.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student login · <?= APP_NAME ?></title>
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
      <h2>Welcome back.</h2>
      <p>Log in to see new notices, upcoming exams and your latest results.</p>
    </div>
    <span></span>
  </aside>
  <div class="auth-main">
    <div class="auth-box">
      <h1>Student login</h1>
      <p class="sub">Use the email you registered with.</p>
      <?php show_flash(); ?>
      <form method="post">
        <?= csrf_field() ?>
        <div class="form-grid">
          <div class="field full"><label for="email">Email</label>
            <div class="input-icon"><i class="fa-solid fa-envelope"></i><input id="email" type="email" name="email" required autofocus></div></div>
          <div class="field full"><label for="password">Password</label>
            <div class="input-icon"><i class="fa-solid fa-lock"></i><input id="password" type="password" name="password" required></div></div>
        </div>
        <div class="form-actions"><button class="btn btn-primary btn-block" type="submit">Log in</button></div>
      </form>
      <p class="alt">New student? <a href="register.php">Create an account</a></p>
      <p class="alt"><a href="admin/login.php">Admin login</a></p>
    </div>
  </div>
</div>
</body>
</html>
