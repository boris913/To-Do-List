<?php
include 'db.php';
// Requête pour compter le nombre total de tâches et celles qui sont complétées
$queryTotal = $pdo->query("SELECT COUNT(*) as total FROM tasks");
$totalTasks = $queryTotal->fetch(PDO::FETCH_ASSOC)['total'];

$queryCompleted = $pdo->query("SELECT COUNT(*) as completed FROM tasks WHERE status = 'completed'");
$completedTasks = $queryCompleted->fetch(PDO::FETCH_ASSOC)['completed'];

$progressPercentage = ($completedTasks / $totalTasks) * 100;
echo json_encode($progressPercentage);
?>
