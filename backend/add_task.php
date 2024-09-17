<?php
try {
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];

    if (!empty($title) && !empty($category)) {
        $stmt = $pdo->prepare('INSERT INTO tasks (title, category, completed) VALUES (?, ?, 0)');
        $stmt->execute([$title, $category]);

        echo json_encode(['message' => 'Tâche ajoutée avec succès']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Veuillez remplir tous les champs']);
    }
}
} catch (PDOException $e) {
http_response_code(500);
echo json_encode(['error' => $e->getMessage()]);
}
?>
