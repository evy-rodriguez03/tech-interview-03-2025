<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Gestión de Tareas</h1>
    
    <!-- Formulario de Nueva Tarea -->
    <div class="mb-4">
      <h2 class="text-lg font-semibold">Crear Nueva Tarea</h2>
      <form @submit.prevent="createTask" class="flex gap-2">
        <input v-model="newTask.title" type="text" placeholder="Título" class="border p-2 rounded w-full" required>
        <select v-model="newTask.priority" class="border p-2 rounded">
          <option value="baja">Baja</option>
          <option value="media">Media</option>
          <option value="alta">Alta</option>
        </select>
        <input v-model="newTask.due_date" type="date" class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Agregar</button>
      </form>
    </div>
    
    <!-- Lista de Tareas -->
    <div>
      <h2 class="text-lg font-semibold">Tareas</h2>
      <ul class="border p-4 rounded">
        <li v-for="task in tasks" :key="task.id" class="flex justify-between p-2 border-b">
          <span>{{ task.title }} - {{ task.priority }}</span>
          <span>
            <button @click="markAsCompleted(task.id)" class="bg-green-500 text-white p-1 rounded">✔</button>
            <button @click="deleteTask(task.id)" class="bg-red-500 text-white p-1 rounded ml-2">✖</button>
          </span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tasks: [],
      newTask: { title: '', priority: 'media', due_date: '' },
    };
  },
  methods: {
    async fetchTasks() {
      const response = await fetch('/api/tasks');
      this.tasks = await response.json();
    },
    async createTask() {
      await fetch('/api/tasks', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(this.newTask),
      });
      this.newTask = { title: '', priority: 'media', due_date: '' };
      this.fetchTasks();
    },
    async markAsCompleted(taskId) {
      await fetch(`/api/tasks/${taskId}/complete`, { method: 'PATCH' });
      this.fetchTasks();
    },
    async deleteTask(taskId) {
      await fetch(`/api/tasks/${taskId}`, { method: 'DELETE' });
      this.fetchTasks();
    }
  },
  mounted() {
    this.fetchTasks();
  }
};
</script>

<style>
.container {
  max-width: 600px;
  margin: auto;
}
</style>
