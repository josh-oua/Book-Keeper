<?php 
require 'db.php';

$rows = $pdo->query('SELECT id, title, author, category, status FROM books ORDER BY title')->fetchAll();


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
  $row['cover'] = $coverMap[$title] ?? 'img/red-logo.png'; // fallback if title not matched
}

header('Content-Type: application/json');
echo json_encode($rows);
