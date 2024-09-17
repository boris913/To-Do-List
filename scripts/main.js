document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('task-form');
    const taskInput = document.getElementById('task-title');
    const taskCategory = document.getElementById('task-category');
    const taskList = document.getElementById('task-list');
    const categoryFilter = document.getElementById('category-filter');
    const notification = document.getElementById('notification');
    const loader = document.getElementById('loader');


    async function fetchTasks(filter = 'Toutes') {
        showLoader();
        try {
            const response = await fetch('backend/get_tasks.php');
            if (!response.ok) throw new Error('Erreur de réseau');
            const tasks = await response.json();
            taskList.innerHTML = '';

            const filteredTasks = filter === 'Toutes' ? tasks : tasks.filter(task => task.category === filter);
            filteredTasks.forEach(task => addTaskToList(task));
        } catch (error) {
            showNotification(`Erreur lors de la récupération des tâches: ${error.message}`, 'error');
        } finally {
            hideLoader();
        }
    }

    function addTaskToList(task) {
        const li = document.createElement('li');
        li.id = `task-${task.id}`; // Assigne un ID unique
        li.classList.add('task-item');
        li.innerHTML = `
            <span class="task-title ${task.completed ? 'completed' : ''}">${task.title}</span>
            <button onclick="toggleTask(${task.id}, ${task.completed})">${task.completed ? 'Réactiver' : 'Terminer'}</button>
            <button onclick="window.location.href='/task_list.php'"><img src="images/icons8-eye-30.png" style="width: 22px;"></button>
            <button onclick="deleteTask(${task.id})"><img src="images/icons8-supprimer-pour-toujours-30.png" style="width: 22px;"></button>
        `;
        li.classList.add('show');
        taskList.appendChild(li);
    }

    

    function showNotification(message, type = 'success') {
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.style.display = 'block';
        setTimeout(() => notification.style.display = 'none', 5000);
    }

    function showLoader() {
        loader.style.display = 'block';
    }
    
    function hideLoader() {
        loader.style.display = 'none';
    }

    async function addTask(title, category) {
        try {
            const response = await fetch('backend/add_task.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ title, category })
            });
            if (!response.ok) throw new Error('Erreur de réseau');
            await response.json();
            taskInput.value = '';
            fetchTasks();
            showNotification('Tâche ajoutée avec succès');
        } catch (error) {
            showNotification(`Erreur lors de l'ajout de la tâche: ${error.message}`, 'error');
        }
    }

    function updateTaskDisplay(task) {
        const li = document.getElementById(`task-${task.id}`);
        if (!li) return; // Vérifie si l'élément existe
    
        const title = li.querySelector('.task-title');
        const toggleButton = li.querySelector('button:first-of-type'); // Sélectionne le premier bouton (compléter/réactiver)
    
        // Mise à jour de l'affichage en fonction de l'état de la tâche
        if (task.completed) {
            title.classList.add('completed');
            toggleButton.textContent = 'Réactiver'; // Affiche "Réactiver" si la tâche est complétée
            toggleButton.setAttribute('onclick', `toggleTask(${task.id}, true)`); // Définit l'action pour réactiver
        } else {
            title.classList.remove('completed');
            toggleButton.textContent = 'Terminer'; // Affiche "Compléter" si la tâche est non complétée
            toggleButton.setAttribute('onclick', `toggleTask(${task.id}, false)`); // Définit l'action pour compléter
        }
    }
    
    
    

    window.toggleTask = async (id, completed) => {
        console.log(`Toggle Task: ${id}, Completed (avant inversion): ${completed}`);
        try {
            const newCompletedStatus = completed ? 0 : 1; // Inverser l'état (0 pour non complété, 1 pour complété)
            const response = await fetch('backend/update_task.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ id, completed: newCompletedStatus }) // Envoie le nouvel état de la tâche
            });
    
            if (!response.ok) throw new Error('Erreur de réseau');
    
            // Récupérer la réponse du serveur avec les informations mises à jour
            const updatedTask = await response.json();
            console.log('Tâche mise à jour (backend):', updatedTask);
    
            // Mise à jour de l'affichage après la réponse
            updateTaskDisplay(updatedTask);
    
            showNotification('Tâche mise à jour avec succès');
        } catch (error) {
            showNotification(`Erreur lors de la mise à jour de la tâche: ${error.message}`, 'error');
        }
    };
    
    

    window.deleteTask = async (id) => {
        console.log(`Delete Task: ${id}`);
        try {
            const response = await fetch('backend/delete_task.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ id })
            });
            if (!response.ok) throw new Error('Erreur de réseau');
            await response.json();
            const taskElement = document.getElementById(`task-${id}`);
            if (taskElement) {
                taskElement.remove(); // Supprime l'élément de la liste
            }
            showNotification('Tâche supprimée avec succès');
        } catch (error) {
            showNotification(`Erreur lors de la suppression de la tâche: ${error.message}`, 'error');
        }
    };

     form.addEventListener('submit', event => {
                event.preventDefault();
                const title = taskInput.value.trim();
                const category = taskCategory.value;
                if (title) addTask(title, category);
            });

            categoryFilter.addEventListener('change', () => {
                const selectedCategory = categoryFilter.value;
                fetchTasks(selectedCategory);
            });

            fetchTasks(); // Chargement initial des tâches
});
