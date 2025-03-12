
<template>
    <div>
      <router-view></router-view> <!-- Renderiza el componente basado en la ruta actual -->
    </div>
  </template>
  
  <script>
  export default {
    name: 'App',
  };
  </script>
  
  <style>
  /* Estilos globales de la aplicación */
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
  }
  </style>
  