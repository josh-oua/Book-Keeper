<?php 
require 'db.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit('Not logged in');
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT b.id, b.title, b.author, br.due_date
        FROM borrowings br
        JOIN books b ON b.id = br.book_id
        WHERE br.user_id = ? AND br.status = 'borrowed' AND br.return_date IS NULL
        ORDER BY br.due_date ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


$coverMap = [
    'Clean Code' => 'img/1.png',
    'Database System Concepts' => 'img/2.png',
    'Design Patterns' => 'img/3.png',
    'Introduction to Algorithms' => 'img/4.png',
    'Operating System Concepts' => 'img/5.png',
    'You Don’t Know JS' => 'img/6.png'
];


foreach ($rows as &$row) {
    $title = $row['title'];
    $row['cover'] = $coverMap[$title] ?? 'img/red-logo.png'; 
}

header('Content-Type: application/json');
echo json_encode($rows);
