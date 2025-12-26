<?php 
require 'db.php';
if (!isset($_SESSION['user_id'])) { http_response_code(401); exit('Not logged in'); }

$user_id = $_SESSION['user_id'];
$book_id = (int)($_POST['book_id'] ?? 0);
$start_date = $_POST['borrowDate'] ?? null;
$duration = (int)($_POST['duration'] ?? 0);
$password = $_POST['password'] ?? '';

if (!$book_id || !$start_date || $duration < 1 || !$password) { http_response_code(400); exit('Invalid input'); }

$u = $pdo->prepare('SELECT password_hash FROM users WHERE id=?'); $u->execute([$user_id]);
$hash = $u->fetchColumn();
if (!$hash || !password_verify($password, $hash)) { http_response_code(403); exit('Password incorrect'); }

$due_date = date('Y-m-d', strtotime("$start_date +$duration day"));
$ins = $pdo->prepare("INSERT INTO borrowings (user_id, book_id, request_date, start_date, due_date, status)
                      VALUES (?,?,CURDATE(),?,?, 'borrowed')");
$ins->execute([$user_id, $book_id, $start_date, $due_date]);

$pdo->prepare("UPDATE books SET status='unavailable' WHERE id=?")->execute([$book_id]);

echo 'Borrowed';
