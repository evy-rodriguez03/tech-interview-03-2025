<template>
  <div class="task-list-container">
    <h2>Lista de Tareas</h2>

    <!-- Formulario de nueva tarea -->
    <form @submit.prevent="addTask" class="task-form">
      <div class="form-group">
        <label for="task-name">Nombre de la tarea</label>
        <input id="task-name" v-model="task.name" placeholder="Nombre de la tarea" required />
      </div>

      <div class="form-group">
        <label for="task-description">Descripción</label>
        <textarea id="task-description" v-model="task.description" placeholder="Descripción"></textarea>
      </div>

      <div class="form-group">
        <label for="task-priority">Prioridad</label>
        <select id="task-priority" v-model="task.priority">
          <option value="baja">Baja</option>
          <option value="media">Media</option>
          <option value="alta">Alta</option>
        </select>
      </div>

      <div class="form-group">
        <label for="task-due-date">Fecha de vencimiento</label>
        <input id="task-due-date" type="date" v-model="task.due_date" />
      </div>

      <div class="form-group">
        <label for="task-user">Usuario asignado</label>
        <select id="task-user" v-model="task.user_id">
          <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
        </select>
      </div>

      <div class="form-group">
        <label for="task-project">Proyecto asignado</label>
        <select id="task-project" v-model="task.project_id">
          <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
        </select>
      </div>

      <button type="submit" class="submit-button">Agregar Tarea</button>
    </form>

    <!-- Lista de tareas -->
    <div class="task-list">
      <ul>
        <li v-for="t in tasks" :key="t.id" class="task-item">
          <span class="task-name">{{ t.name }}</span> - 
          <span class="task-status" :class="t.status">{{ t.status }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      task: {
        name: '',
        description: '',
        priority: 'media',
        due_date: '',
        user_id: '',
        project_id: '',
        status: 'pendiente'
      },
      tasks: [],
      users: [],
      projects: []
    };
  },
  methods: {
    async fetchTasks() {
      const response = await axios.get('http://localhost:8000/api/tasks');
      this.tasks = response.data;
    },
    async fetchUsersAndProjects() {
      this.users = [{ id: 1, name: 'Usuario 1' }, { id: 2, name: 'Usuario 2' }];
      this.projects = [{ id: 1, name: 'Proyecto A' }, { id: 2, name: 'Proyecto B' }];
    },
    async addTask() {
      await axios.post('http://localhost:8000/api/tasks', this.task);
      this.fetchTasks();
    }
  },
  mounted() {
    this.fetchTasks();
    this.fetchUsersAndProjects();
  }
};
</script>

<style scoped>
/* Estilos generales */
.task-list-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

/* Estilos del formulario */
.task-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #555;
}

input, select, textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

button.submit-button {
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
}

button.submit-button:hover {
  background-color: #45a049;
}

/* Estilos de la lista de tareas */
.task-list {
  margin-top: 30px;
}

ul {
  list-style-type: none;
  padding: 0;
}

.task-item {
  padding: 12px;
  border: 1px solid #ddd;
  margin-bottom: 10px;
  border-radius: 5px;
  background: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.task-name {
  font-weight: bold;
}

.task-status {
  padding: 6px 10px;
  border-radius: 5px;
  font-weight: bold;
}

.task-status.pendiente {
  background-color: #393836;
  color: white;
}

.task-status.completada {
  background-color: #93bda4;
  color: white;
}

.task-status.en-progreso {
  background-color: #695f56;
  color: white;
}
</style>
