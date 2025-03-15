<template>
  <div>
      <h2>Lista de Tareas</h2>
      <form @submit.prevent="addTask">
          <input v-model="task.name" placeholder="Nombre de la tarea" required />
          <textarea v-model="task.description" placeholder="Descripción"></textarea>
          <select v-model="task.priority">
              <option value="baja">Baja</option>
              <option value="media">Media</option>
              <option value="alta">Alta</option>
          </select>
          <input type="date" v-model="task.due_date" />
          <select v-model="task.user_id">
              <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>
          <select v-model="task.project_id">
              <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
          </select>
          <button type="submit">Agregar Tarea</button>
      </form>

      <ul>
          <li v-for="t in tasks" :key="t.id">{{ t.name }} - {{ t.status }}</li>
      </ul>
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
