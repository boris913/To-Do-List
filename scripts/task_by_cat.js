// Récupérer les données depuis PHP via Ajax
fetch('backend/task_by_cat.php')
    .then(response => response.json())
    .then(data => {
        const categories = data.map(item => item.category);
        const counts = data.map(item => item.count);

        // Afficher le graphique avec Chart.js
        const tasksByCategoryCtx = document.getElementById('tasksByCategoryChart').getContext('2d');
        const tasksByCategoryChart = new Chart(tasksByCategoryCtx, {
            type: 'pie', // ou 'bar' pour un graphique à barres
            data: {
                labels: categories,
                datasets: [{
                    label: 'Nombre de tâches',
                    data: counts,
                    backgroundColor: [
                        '#1abc9c', '#f39c12', '#3498db', '#e74c3c'
                    ],
                    borderWidth: 1
                }]
            }
        });
    });
