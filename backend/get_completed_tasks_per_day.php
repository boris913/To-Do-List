<?php
include 'db.php';

// Requête pour compter le nombre de tâches terminées chaque jour, limité à 5 résultats
$query = $pdo->query("
    SELECT DATE_FORMAT(created_at, '%d %b %Y') as date, COUNT(*) as count 
    FROM tasks 
    WHERE completed = 1 
    GROUP BY DATE(created_at) 
    ORDER BY DATE(created_at) ASC 
    LIMIT 5
");
$tasksByDate = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($tasksByDate);
?>
