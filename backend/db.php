<?php
$host = 'localhost';
$db = 'todo_list';
$user = 'root'; // ou ton utilisateur MySQL
$pass = ''; // ou ton mot de passe MySQL

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
