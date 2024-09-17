<?php
include 'db.php';

$id = $_POST['id'];
$completed = $_POST['completed'] ? 1 : 0; // S'assure que 'completed' est 1 ou 0

$stmt = $pdo->prepare("UPDATE tasks SET completed = :completed WHERE id = :id");
$stmt->execute(['completed' => $completed, 'id' => $id]);

// Retourner les informations mises à jour sur la tâche
echo json_encode(['status' => 'success', 'id' => $id, 'completed' => $completed]);

?>
