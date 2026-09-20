<?php
require_once __DIR__ . '/config.php';
unset($_SESSION['student_id'], $_SESSION['student_name']);
session_regenerate_id(true);
flash('success', 'You have been logged out.');
redirect('login.php');
