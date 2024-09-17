<?php
include 'db.php';

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
$stmt->execute(['id' => $id]);

echo json_encode(['status' => 'success']);
?>
