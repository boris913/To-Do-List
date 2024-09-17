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

// Requête pour récupérer le nombre de tâches terminées par catégorie
$stmt = $pdo->query('SELECT category, COUNT(*) as count FROM tasks WHERE completed = 1 GROUP BY category');
$tasks = $stmt->fetchAll();

// Préparer les données pour le JavaScript
$categories = [];
$taskCounts = [];

foreach ($tasks as $task) {
    $categories[] = $task['category'] ?? 'Non défini';
    $taskCounts[] = $task['count'];
}

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode([
    'categories' => $categories,
    'taskCounts' => $taskCounts
]);
?>
