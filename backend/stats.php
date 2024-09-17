<?php
include 'db.php';

// Calcul du total des tâches
$sql_total = "SELECT COUNT(*) AS total FROM tasks";
$stmt = $pdo->query($sql_total);
$total_tasks = $stmt->fetchColumn();

// Calcul des tâches complétées
$sql_completed = "SELECT COUNT(*) AS completed FROM tasks WHERE completed = 1";
$stmt = $pdo->query($sql_completed);
$completed_tasks = $stmt->fetchColumn();

// Calcul des tâches en attente
$sql_pending = "SELECT COUNT(*) AS pending FROM tasks WHERE completed = 0";
$stmt = $pdo->query($sql_pending);
$pending_tasks = $stmt->fetchColumn();

// Retourner les statistiques sous forme de tableau associatif
$statistics = [
    'total_tasks' => $total_tasks,
    'completed_tasks' => $completed_tasks,
    'pending_tasks' => $pending_tasks
];

echo json_encode($statistics);
?>
