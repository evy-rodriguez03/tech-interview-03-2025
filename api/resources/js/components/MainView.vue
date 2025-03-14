<template>
  <div class="main-view">
    <h1>Bienvenido a la aplicación de gestión de tareas</h1>
    <TaskList />
  </div>
</template>

<script>
import TaskList from './TaskList.vue';

export default {
  name: 'MainView',
  components: {
    TaskList,
  },
};
</script>

<style scoped>
.main-view {
  text-align: center;
  margin-top: 50px;
}
</style>
