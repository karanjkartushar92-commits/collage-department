<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= APP_NAME ?> · Excellence in Higher Education & Campus Administration</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
<style>
  :root {
    --primary-accent: #2563eb;
    --primary-dark: #0f172a;
    --accent-glow: #38bdf8;
    --glass-bg: rgba(255, 255, 255, 0.08);
    --glass-border: rgba(255, 255, 255, 0.18);
  }

  body {
    background-color: #f8fafc;
    color: #334155;
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow-x: hidden;
  }

  /* Navigation Enhancements */
  .site-nav {
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.9);
    position: sticky;
    top: 0;
    z-index: 1000;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    padding: 0.85rem 2rem;
  }

  .brand-line {
    font-family: 'Fraunces', serif;
    font-weight: 700;
    font-size: 1.35rem;
    color: #0f172a;
  }

  .brand-mark {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
  }

  /* Enhanced Hero Banner with Modern Gradient Mask */
  .hero-wrapper {
    position: relative;
    background: 
      radial-gradient(circle at 80% 20%, rgba(56, 189, 248, 0.15) 0%, transparent 40%),
      radial-gradient(circle at 20% 80%, rgba(37, 99, 235, 0.2) 0%, transparent 50%),
      linear-gradient(135deg, rgba(15, 23, 42, 0.92) 0%, rgba(30, 41, 59, 0.88) 100%),
      url('https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=1920&auto=format&fit=crop') center/cover no-repeat fixed;
    color: #ffffff;
    padding: 6rem 2rem 7rem;
    border-radius: 0 0 36px 36px;
    box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.3);
  }

  .hero-wrapper h1 {
    font-family: 'Fraunces', serif;
    font-size: 3.25rem;
    line-height: 1.15;
    letter-spacing: -0.02em;
    color: #ffffff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
  }

  .hero-wrapper h1 span {
    background: linear-gradient(120deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hero-wrapper p.lead {
    font-size: 1.15rem;
    line-height: 1.7;
    color: #cbd5e1;
    margin-top: 1.25rem;
    max-width: 600px;
  }

  .badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(56, 189, 248, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.3);
    color: #38bdf8;
    padding: 0.35rem 0.9rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    backdrop-filter: blur(8px);
  }

  .cta-group {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    align-items: center;
  }

  .btn-hero-primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    padding: 0.85rem 1.75rem;
    border-radius: 12px;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
    transition: all 0.3s ease;
  }

  .btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.45);
    color: #fff;
  }

  .btn-hero-glass {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.25);
    padding: 0.85rem 1.75rem;
    border-radius: 12px;
    font-weight: 600;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
  }

  .btn-hero-glass:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    color: #fff;
    transform: translateY(-2px);
  }

  /* Glassmorphic Animated Notice Board */
  .hero-wrapper .board {
    background: var(--glass-bg);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 1.75rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
  }

  .hero-wrapper .pin {
    background: rgba(255, 255, 255, 0.95);
    color: #0f172a;
    border-radius: 16px;
    padding: 1rem 1.25rem;
    margin-bottom: 1rem;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  }

  .hero-wrapper .pin:hover {
    transform: scale(1.03) translateX(4px);
  }

  .hero-wrapper .pin:last-child {
    margin-bottom: 0;
  }

  /* Stat Counters Banner */
  .stats-banner {
    max-width: 1100px;
    margin: -3rem auto 4rem;
    background: #ffffff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.08);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    position: relative;
    z-index: 10;
    border: 1px solid #f1f5f9;
  }

  .stat-item {
    text-align: center;
    padding: 0.5rem 1rem;
    border-right: 1px solid #f1f5f9;
  }

  .stat-item:last-child {
    border-right: none;
  }

  .stat-number {
    font-family: 'Fraunces', serif;
    font-size: 2.25rem;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
  }

  .stat-label {
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.25rem;
  }

  /* Interactive Feature Cards */
  .features-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1.5rem 5rem;
  }

  .section-header {
    text-align: center;
    max-width: 650px;
    margin: 0 auto 3.5rem;
  }

  .section-header h2 {
    font-family: 'Fraunces', serif;
    font-size: 2.4rem;
    color: #0f172a;
    margin-bottom: 0.75rem;
  }

  .section-header p {
    font-size: 1.1rem;
    color: #64748b;
  }

  .feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
  }

  .feature-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 2.25rem;
    transition: all 0.35s ease;
    position: relative;
    overflow: hidden;
  }

  .feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #2563eb, #38bdf8);
    opacity: 0;
    transition: opacity 0.35s ease;
  }

  .feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
  }

  .feature-card:hover::before {
    opacity: 1;
  }

  .feature-icon-wrapper {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: #eff6ff;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
  }

  .feature-card:hover .feature-icon-wrapper {
    background: #2563eb;
    color: #ffffff;
    transform: scale(1.05);
  }

  .feature-card h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
  }

  .feature-card p {
    color: #64748b;
    line-height: 1.6;
    font-size: 0.95rem;
  }

  /* FAQ Accordion Section */
  .faq-section {
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    padding: 5rem 1.5rem;
  }

  .faq-container {
    max-width: 800px;
    margin: 0 auto;
  }

  .faq-item {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    margin-bottom: 1rem;
    overflow: hidden;
    background: #f8fafc;
  }

  .faq-item summary {
    padding: 1.25rem 1.5rem;
    font-weight: 700;
    color: #0f172a;
    cursor: pointer;
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .faq-item summary::-webkit-details-marker {
    display: none;
  }

  .faq-item summary::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-size: 0.85rem;
    color: #64748b;
    transition: transform 0.3s ease;
  }

  .faq-item[open] summary::after {
    transform: rotate(180deg);
  }

  .faq-item p {
    padding: 0 1.5rem 1.25rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }

  /* Call To Action Banner */
  .cta-banner {
    max-width: 1100px;
    margin: 5rem auto;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: 28px;
    padding: 4rem 2rem;
    text-align: center;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
  }

  .cta-banner h2 {
    font-family: 'Fraunces', serif;
    font-size: 2.25rem;
    margin-bottom: 1rem;
  }

  .cta-banner p {
    color: #94a3b8;
    max-width: 550px;
    margin: 0 auto 2rem;
    font-size: 1.05rem;
  }

  .site-footer {
    background: #0f172a;
    color: #94a3b8;
    padding: 2.5rem 2rem;
    text-align: center;
    font-size: 0.9rem;
    border-top: 1px solid #1e293b;
  }

  @media (max-width: 992px) {
    .hero-wrapper h1 { font-size: 2.4rem; }
    .stats-banner { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .stat-item { border-right: none; }
  }

  @media (max-width: 576px) {
    .cta-group { flex-direction: column; width: 100%; }
    .btn-hero-primary, .btn-hero-glass { width: 100%; text-align: center; }
    .stats-banner { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<nav class="site-nav">
  <a class="brand-line" href="index.php">
    <span class="brand-mark"><i class="fa-solid fa-graduation-cap"></i></span>
    <?= e(APP_NAME) ?>
  </a>
  <div class="links">
    <a class="btn btn-ghost btn-sm" href="admin/login.php"><i class="fa-solid fa-user-shield"></i> Faculty / Admin</a>
    <a class="btn btn-ghost btn-sm" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Student Login</a>
    
  </div>
</nav>

<div class="hero-wrapper">
  <section class="hero" style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:3rem;align-items:center;">
    <div>
      <div class="badge-pill">
        <i class="fa-solid fa-sparkles"></i> Next-Gen Campus Operating System
      </div>
      <h1>Empowering Campus <span>Academic Excellence</span></h1>
      <p class="lead">Welcome to your modern digital college hub. Seamlessly connecting academic scheduling, departmental notices, faculty engagement, and official exam results under one unified roof.</p>
      
      <div class="cta-group">
        <a class="btn-hero-primary" href="register.php"><i class="fa-solid fa-id-card"></i> Apply for Enrollment</a>
        <a class="btn-hero-glass" href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Access Student Portal</a>
      </div>
    </div>

    <div class="board" aria-hidden="true">
      <div style="font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: #38bdf8; margin-bottom: 1rem; display:flex; align-items:center; gap:0.5rem;">
        <i class="fa-solid fa-circle-dot" style="animation: pulse 2s infinite;"></i> Live Campus Bulletin
      </div>
      <div class="pin">
        <span class="ico t"><i class="fa-solid fa-bullhorn"></i></span>
        <div><strong>Campus Library Extended Hours</strong><span>Open until 9 PM during midterm assessment weeks</span></div>
      </div>
      <div class="pin">
        <span class="ico a"><i class="fa-solid fa-file-pen"></i></span>
        <div><strong>Mid-Semester Assessments</strong><span>Mon 12 Oct · Main Academic Block · 10:00 AM</span></div>
      </div>
      <div class="pin">
        <span class="ico g"><i class="fa-solid fa-award"></i></span>
        <div><strong>Semester Examination Result</strong><span>Computer Science & Engineering · Grade A</span></div>
        <span class="grade">A</span>
      </div>
    </div>
  </section>
</div>

<!-- Campus Metrics -->
<div class="stats-banner">
  <div class="stat-item">
    <div class="stat-number">100%</div>
    <div class="stat-label">Digital Automation</div>
  </div>
  <div class="stat-item">
    <div class="stat-number">24/7</div>
    <div class="stat-label">Portal Availability</div>
  </div>
  <div class="stat-item">
    <div class="stat-number">Real-Time</div>
    <div class="stat-label">Result Declarations</div>
  </div>
  <div class="stat-item">
    <div class="stat-number">Direct</div>
    <div class="stat-label">Faculty Connectivity</div>
  </div>
</div>

<!-- Feature Section -->
<section class="features">
  <div class="features-inner">
    <div class="section-header">
      <h2>Integrated Campus Management</h2>
      <p>Everything students and administrators need to ensure smooth day-to-day academic workflow.</p>
    </div>

    <div class="feature-grid">
      <div class="feature-card">
        <div class="feature-icon-wrapper"><i class="fa-solid fa-building-columns"></i></div>
        <h3>Academic Departments</h3>
        <p>Centralized department administration, Head of Department (HOD) monitoring, and academic resource distribution.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon-wrapper"><i class="fa-solid fa-chalkboard-user"></i></div>
        <h3>Faculty Directory</h3>
        <p>Access profile details of professors, designations, research qualifications, and direct communication lines.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon-wrapper"><i class="fa-solid fa-user-graduate"></i></div>
        <h3>Student Enrollment</h3>
        <p>Simplified online enrollment, automated roll number allocation, and comprehensive student profile records.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon-wrapper"><i class="fa-solid fa-bullhorn"></i></div>
        <h3>Official Notice Board</h3>
        <p>Instant circular updates broadcasted campus-wide or filtered directly for specific departmental batches.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon-wrapper"><i class="fa-solid fa-file-pen"></i></div>
        <h3>Examination Schedules</h3>
        <p>Clear timetables for midterm exams, lab practicals, and final semester university examinations.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon-wrapper"><i class="fa-solid fa-award"></i></div>
        <h3>Results & Transcripts</h3>
        <p>Instant mark statements, automated letter grade calculations, and secure online transcript viewing.</p>
      </div>
    </div>
  </div>
</section>

<!-- Frequently Asked Questions -->
<section class="faq-section">
  <div class="faq-container">
    <div class="section-header">
      <h2>Frequently Asked Questions</h2>
      <p>Quick answers to common questions about using the campus portal.</p>
    </div>

    <div class="faq-item">
      <details>
        <summary>How do new students create an account?</summary>
        <p>Click on the "Student Enrollment" button at the top right corner, fill in your details along with your assigned Roll Number and Department, and submit. An administrator will verify your profile.</p>
      </details>
    </div>

    <div class="faq-item">
      <details>
        <summary>How do I check my semester examination results?</summary>
        <p>Log in to your student account, navigate to the "Results" section on your dashboard. Declared exam marks and grade cards will be displayed automatically.</p>
      </details>
    </div>

    <div class="faq-item">
      <details>
        <summary>Can faculty post notices for specific departments only?</summary>
        <p>Yes! Admins and departmental faculty can choose whether a published notice is intended for the entire college or targeted exclusively at a selected department.</p>
      </details>
    </div>
  </div>
</section>

<!-- Call to Action Footer Box -->
<div style="padding: 0 1.5rem;">
  <div class="cta-banner">
    <h2>Ready to Get Started?</h2>
    <p>Sign up now to access your departmental updates, upcoming examination timetables, and academic records.</p>
    <a class="btn-hero-primary" style="display:inline-block; text-decoration:none;" href="register.php">
      <i class="fa-solid fa-user-plus"></i> Create Student Account
    </a>
  </div>
</div>

<footer class="site-footer">
  &copy; <?= date('Y') ?> <?= e(APP_NAME) ?> · College Campus & Academic Management System
</footer>

</body>
</html>