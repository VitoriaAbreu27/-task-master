// TaskViewModel.js - O cérebro do Front-end
class TaskViewModel {
    constructor() {
        this.tasks = []; 
        this.init();
    }

    async init() {
        // Mapeia elementos da View
        this.listElement = document.getElementById('taskList');
        this.inputElement = document.getElementById('taskTitle');
        this.addBtn = document.getElementById('addBtn');

        // Eventos da View que disparam ações na ViewModel
        this.addBtn.onclick = () => this.addTask();

        // Busca os dados iniciais
        await this.fetchTasks();
    }

    // Busca dados da API PHP
    async fetchTasks() {
        const response = await fetch('api.php?action=list');
        this.tasks = await response.json();
        this.render(); // Atualiza a View (Data Binding)
    }

    async addTask() {
        const title = this.inputElement.value;
        if (!title) return alert("Digite algo!");

        // Enviamos todos os 4 campos exigidos pelo Model/API
        await fetch('api.php?action=create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                title: title, 
                description: '', 
                due_date: '2026-12-31', 
                responsible: 'Vitoria' 
            })
        });

        this.inputElement.value = '';
        await this.fetchTasks();
    }

    async deleteTask(id) {
        await fetch(`api.php?action=delete&id=${id}`);
        await this.fetchTasks();
    }

    // O "Binder": Sincroniza o array de tarefas com o HTML
    render() {
        this.listElement.innerHTML = '';
        this.tasks.forEach(task => {
            const li = document.createElement('li');
            li.className = task.done ? 'done' : '';
            li.innerHTML = `
                <span>${task.title} (Resp: ${task.responsible})</span>
                <button onclick="vm.deleteTask(${task.id})">❌</button>
            `;
            this.listElement.appendChild(li);
        });
    }
}

// Instancia a ViewModel
const vm = new TaskViewModel();