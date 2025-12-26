<?php
session_start();
require 'db.php';

$student_no = trim($_POST['student_no'] ?? '');
$pw = $_POST['password'] ?? '';

$stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE student_no=?');
$stmt->execute([$student_no]);
$user = $stmt->fetch();

if (!$user || !password_verify($pw, $user['password_hash'])) {
    header("Location: ../frontend/login.html?error=norecord");
    exit();
}

$_SESSION['user_id'] = $user['id'];
header('Location: ../frontend/home.html');
exit();
