<?php
// Connexion à la base de données (ajuste les paramètres selon ton environnement)
$host = 'localhost';
$db = 'todo_list';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Requête pour le nombre total de tâches par catégorie
$stmtTotal = $pdo->query('SELECT IFNULL(category, "Non défini") as category, COUNT(*) as total_count FROM tasks GROUP BY category');
$totalTasks = $stmtTotal->fetchAll();

// Requête pour le nombre de tâches terminées par catégorie
$stmtCompleted = $pdo->query('SELECT IFNULL(category, "Non défini") as category, COUNT(*) as completed_count FROM tasks WHERE completed = 1 GROUP BY category');
$completedTasks = $stmtCompleted->fetchAll();

// Requête pour le nombre de tâches en attente par catégorie
$stmtPending = $pdo->query('SELECT IFNULL(category, "Non défini") as category, COUNT(*) as pending_count FROM tasks WHERE completed = 0 GROUP BY category');
$pendingTasks = $stmtPending->fetchAll();

// Préparer les données pour le JavaScript
$categories = [];
$totalTaskCounts = [];
$completedTaskCounts = [];
$pendingTaskCounts = [];

foreach ($totalTasks as $task) {
    $categories[] = $task['category'];
    $totalTaskCounts[$task['category']] = $task['total_count'];
}

foreach ($completedTasks as $task) {
    $completedTaskCounts[$task['category']] = $task['completed_count'];
}

foreach ($pendingTasks as $task) {
    $pendingTaskCounts[$task['category']] = $task['pending_count'];
}

// On s'assure que les catégories correspondent
$taskData = [];
foreach ($categories as $category) {
    $taskData[] = [
        'category' => $category,
        'total' => $totalTaskCounts[$category] ?? 0,
        'completed' => $completedTaskCounts[$category] ?? 0,
        'pending' => $pendingTaskCounts[$category] ?? 0
    ];
}

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode([
    'categories' => $categories,
    'taskData' => $taskData
]);
?>
