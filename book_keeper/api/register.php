<?php 
require 'db.php';
$student_no = trim($_POST['student_no'] ?? '');
$name = trim($_POST['name'] ?? '');
$pw = $_POST['password'] ?? '';
$cpw = $_POST['confirm_password'] ?? '';

if (!$student_no || !$name || !$pw || !$cpw) { http_response_code(400); exit('Missing fields'); }
if ($pw !== $cpw) { http_response_code(400); exit('Passwords do not match'); }

$stmt = $pdo->prepare('SELECT id FROM users WHERE student_no=?');
$stmt->execute([$student_no]);
if ($stmt->fetch()) { http_response_code(409); exit('Student number already exists'); }

$hash = password_hash($pw, PASSWORD_BCRYPT);
$pdo->prepare('INSERT INTO users (student_no, name, password_hash) VALUES (?,?,?)')
    ->execute([$student_no, $name, $hash]);

header('Location: ../frontend/login.html');
