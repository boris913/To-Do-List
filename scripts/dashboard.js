// <!-- JavaScript pour charger les statistiques et configurer le graphique -->

document.addEventListener('DOMContentLoaded', function() {
    // Récupération des données depuis le serveur
    fetch('backend/stats.php')
        .then(response => response.json())
        .then(data => {
            const totalTasks = data.total_tasks;
            const completedTasks = data.completed_tasks;
            const pendingTasks = data.pending_tasks;

            // Mise à jour des statistiques
            document.getElementById('total-tasks').textContent = totalTasks;
            document.getElementById('completed-tasks').textContent = completedTasks;
            document.getElementById('pending-tasks').textContent = pendingTasks;

            // Configuration du graphique Doughnut avec Chart.js
            const ctx = document.getElementById('taskChart').getContext('2d');
            const taskChart = new Chart(ctx, {
                type: 'doughnut', // Type de graphique : Doughnut
                data: {
                    labels: ['Complétées', 'En attente'], // Légendes du graphe
                    datasets: [{
                        label: 'Tâches',
                        data: [completedTasks, pendingTasks], // Données des tâches
                        backgroundColor: [
                            'rgba(26, 188, 156, 0.6)', // Couleur pour "Complétées"
                            'rgba(129, 139, 161, 0.6)'  // Couleur pour "En attente"
                        ],
                        borderColor: [
                            'rgba(26, 188, 156, 1)',    // Bordure pour "Complétées"
                            'rgba(129, 139, 161, 1)'     // Bordure pour "En attente"
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Le graphe s'adapte à la taille du container
                    plugins: {
                        legend: {
                            position: 'bottom', // Position de la légende en bas
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Erreur:', error));
});


