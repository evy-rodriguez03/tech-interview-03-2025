<template>
  <div>
    <h1>Gestión de Tareas</h1>

    <form @submit.prevent="addTask">
      <input v-model="newTask.title" placeholder="Título" required />
      <textarea v-model="newTask.description" placeholder="Descripción"></textarea>
      <select v-model="newTask.priority">
        <option value="baja">Baja</option>
        <option value="media">Media</option>
        <option value="alta">Alta</option>
      </select>
      <input type="date" v-model="newTask.due_date" required />
      <select v-model="newTask.project_id">
        <option v-for="project in projects" :key="project.id" :value="project.id">
          {{ project.name }}
        </option>
      </select>
      <button type="submit">Agregar Tarea</button>
    </form>

    <h2>Lista de Tareas</h2>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        {{ task.title }} - {{ task.status }} - {{ task.priority }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      newTask: {
        title: "",
        description: "",
        priority: "media",
        due_date: "",
        project_id: null,
      },
      tasks: [],
      projects: [],
    };
  },
  methods: {
    async loadTasks() {
      const response = await axios.get("/api/tasks");
      this.tasks = response.data;
    },
    async loadProjects() {
      const response = await axios.get("/api/projects");
      this.projects = response.data;
    },
    async addTask() {
      try {
        await axios.post("/api/tasks", this.newTask);
        this.newTask = { title: "", description: "", priority: "media", due_date: "", project_id: null };
        this.loadTasks();
      } catch (error) {
        console.error("Error al agregar la tarea", error);
      }
    },
  },
  mounted() {
    this.loadTasks();
    this.loadProjects();
  },
};
</script>
