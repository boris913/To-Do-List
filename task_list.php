<?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "todo_list";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Requête pour récupérer les tâches
$sql = "SELECT id, title, completed, created_at FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);

// Fonction pour formater la date en jj-mm-aaaa
function formatDate($date) {
    return date('d M Y', strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icons8-to-do-list-64.png" type="image/x-icon">
    <title>Liste des Tâches</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/dashboard.css">
    <Style>
 /* Réinitialisation de tous les éléments */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', sans-serif;
    background-color: #1e1e1e; /* Arrière-plan sombre pour un effet moderne */
    color: #e0e0e0; /* Texte clair pour un bon contraste */
    height: 100%;

}

.dashboard-container {
    display: flex;
    height: 100%;
}

.sidebar {
    background-color: #171717;
    color: white;
    width: 250px;
    min-width: 20%;
    padding: 20px;
    transition: width 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre pour un effet de profondeur */
}

.sidebar h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #ffffff;
}

.sidebar ul {
    list-style-type: none;
}

.sidebar ul li {
    margin-bottom: 20px;
    cursor: pointer;
    padding: 10px 15px;
    border-radius: 8px; /* Coins arrondis pour une apparence moderne */
    transition: background-color 0.3s ease, color 0.3s ease;
}

.sidebar ul li:hover {
    background-color: #1abc9c;
    color: #ffffff;
}


.content {
    flex-grow: 1;
    padding: 20px;
    background-color: #1e1e1e;
    transition: margin-left 0.3s ease-in-out;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.toggle-sidebar {
    background-color: #1abc9c;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.toggle-sidebar:hover {
    background-color: #16a085;
    transform: scale(1.05);
}

.task-table {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.task-column {
    width: 48%;
}

.task-column h2 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #818ba1;
}

.task-list {
    list-style-type: none;
    padding: 0;
}

.task-item {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 10px;
    min-height: 60px;
    background-color: #818ba1;
    border-radius: 8px;
    color: rgba(255, 255, 255, 0.7);
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre pour un effet de profondeur */
    font-weight: bold;
}

.task-item.completed {
    background-color: #1abc9c;
    color: rgba(255, 255, 255, 0.7);
}

.task-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    background-color: #595f77;
}
.task-item.completed:hover {
    background-color: #16a085;
    color: rgba(255, 255, 255, 0.8);
}
.task-date {
    font-size: 0.875rem;
    color: rgba(224, 224, 224, 0.8);
    font-weight: bold;
    margin-left: auto;
}

@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }

    .content {
        margin-left: 200px;
    }
}

@media (max-width: 480px) {
    .sidebar {
        width: 150px;
    }

    .content {
        margin-left: 150px;
    }

    .task-table {
        flex-direction: column;
    }

    .task-column {
        width: 100%;
        margin-bottom: 20px;
    }
}

.task-item i {
    margin-right: 10px;
    color: #1abc9c; /* Couleur d'accent pour les icônes */
    font-size: 18px; /* Taille de l'icône */
}

.completed i {
    color: #27ae60; /* Couleur différente pour les tâches complètes */
}
ul li a.active {
    background-color: #595f77; /* Couleur de fond pour l'élément actif */
    color: #fff; /* Couleur du texte pour l'élément actif */
    border-radius: 4px; /* Bordure arrondie pour l'élément actif */
}

ul li a.active i {
    color: #fff; /* Couleur de l'icône pour l'élément actif */
}
.sidebar.active {
            min-width: 100px !important;
            max-width: 2px !important;
            
          }
          .sidebar.active span {
            display: none;
            
          }
          .sidebar.active h2 {
            display: none;
            
          }
          .sidebar i {
            margin-right: 5px;
          }
    </Style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2 style="color: #5C3BDE;">Menu</h2>
            <ul>
            <a href="/dashboard.html" style="text-decoration: none; color: rgba(225, 225, 225, 0.7);"><li><i class="fas fa-tachometer-alt" style="color: #5C3BDE;"></i><span>Dashboard</span> </li></a>
            <a class="active" href="/task_list.php" style="text-decoration: none; color: #fff; font-weight: bold;"><li style=" background-color: #595f77;"><i class="fas fa-list" style="color: #5C3BDE;"></i><span>Liste des tâches</span> </li></a>
            <a href="/index.html" style="text-decoration: none; color: rgba(225, 225, 225, 0.7);"><li><i class="fas fa-plus" style="color: #5C3BDE;"></i><span>Ajouter une tâche</span> </li></a>

            </ul>
        </div>
        <div class="content">
            <div class="header" style=" margin-bottom: 60px;">
                <h1>Liste des Tâches</h1>
                <button id="toggleSidebar" class="toggle-sidebar">☰</button>
            </div>
            <div class="task-table">
                <div class="task-column">
                    <h2><i class="fa-solid fa-clock" style="color: #5C3BDE;"></i> Tâches en attente</h2>
                    <ol class="task-list">
                        <?php
                        // Vérifier si des tâches sont retournées
                        if ($result->num_rows > 0) {
                            // Afficher chaque tâche
                            while ($row = $result->fetch_assoc()) {
                                if (!$row['completed']) {
                                    echo "<li class='task-item'></i> " . "<span style='max-width: 70%;'>" . htmlspecialchars($row['title']) ."</span>" . "<small class='task-date'>(" . formatDate($row['created_at']) . ")</small></li>";
                                }
                            }
                        } else {
                            echo "<li class='task-item'>Aucune tâche trouvée.</li>";
                        }
                        ?>
                    </ol>
                </div>
                <div class="task-column">
                    <h2><i class="fa-solid fa-check" style="color: #5C3BDE;"></i> Tâches complètes</h2>
                    <ul class="task-list">
                        <?php
                        // Réinitialiser le résultat pour une nouvelle boucle
                        $result->data_seek(0); 
                        while ($row = $result->fetch_assoc()) {
                            if ($row['completed']) {
                                echo "<li class='task-item completed'>" . "<span style='max-width: 70%;'>" . htmlspecialchars($row['title']) ."</span>" . "<small class='task-date'>(" . formatDate($row['created_at']) . ")</small></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.sidebar');
        
            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('active');
            });
        });
    </script>
</body>
</html>