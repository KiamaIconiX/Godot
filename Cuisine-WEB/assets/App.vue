<template>
    <div id="app" class="app-container">
      <h1 class="app-title">Gestion de Cuisine</h1>
      <nav class="navbar">
        <router-link to="/plats" class="nav-link">Gestion des Plats</router-link>
        <router-link to="/ingredients" class="nav-link">Gestion des Ingrédients</router-link>
        <router-link to="/recettes" class="nav-link">Gestion des Recettes</router-link>
        <router-link to="/statistics" class="nav-link">Statistique des ventes</router-link>
        <router-link to="/clients" class="nav-link">Liste des clients</router-link>
        <router-link to="/commandes" class="nav-link">Liste des commandes</router-link>
      </nav>
  
      <router-view></router-view> <!-- Point d'entrée pour les pages Vue -->
    </div>

  
  </template>
  
  
  <style scoped>
  /* Global Styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
  }
  
  /* Container */
  .app-container {
    max-width: 1200px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  /* Title */
  .app-title {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 32px;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }
  
  /* Navbar */
  .navbar {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 30px;
  }
  
  .nav-link {
    color: #333;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 20px;
    border-radius: 25px;
    background-color: antiquewhite;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  
  .nav-link:hover {
    background-color: #e5d5a5;
    color: #333;
  }
  
  /* Router View Container */
  router-view {
    margin-top: 30px;
  }
  </style>
  
  <script>
  import { defineComponent } from 'vue';
  
  export default defineComponent({
    name: 'App'
  });
  </script>
  
  <style>
  /* Votre style ici */
  </style>
  