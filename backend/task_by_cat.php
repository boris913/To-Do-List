<?php
include 'db.php';

// Requête pour compter le nombre de tâches par catégorie, en excluant la catégorie "toutes"
$query = $pdo->query("SELECT category, COUNT(*) as count FROM tasks WHERE category != 'toutes' GROUP BY category");
$tasksByCategory = $query->fetchAll(PDO::FETCH_ASSOC);


// Encoder les données en JSON pour les utiliser en JavaScript
echo json_encode($tasksByCategory);
