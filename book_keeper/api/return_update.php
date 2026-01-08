<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) { http_response_code(401); exit('Not logged in'); }

$user_id = $_SESSION['user_id'];
$book_id = (int)($_POST['book_id'] ?? 0);
$return_date = $_POST['returnDate'] ?? null;
$password = $_POST['password'] ?? '';

if (!$book_id || !$return_date || !$password) { http_response_code(400); exit('Invalid input'); }

$u = $pdo->prepare('SELECT password_hash FROM users WHERE id=?'); $u->execute([$user_id]);
$hash = $u->fetchColumn();
if (!$hash || !password_verify($password, $hash)) { http_response_code(403); exit('Password incorrect'); }

$stmt = $pdo->prepare("SELECT id FROM borrowings WHERE user_id=? AND book_id=? AND status='borrowed' AND return_date IS NULL ORDER BY id DESC LIMIT 1");
$stmt->execute([$user_id, $book_id]);
$borrowing_id = $stmt->fetchColumn();

$pdo->prepare("UPDATE borrowings SET return_date=?, status='returned' WHERE id=?")->execute([$return_date, $borrowing_id]);
$pdo->prepare("UPDATE books SET status='available' WHERE id=?")->execute([$book_id]);

echo 'Returned';
