<template>
    <div>
      <h1>Liste des Clients</h1>
      <ul>
        <li v-for="client in clients" :key="client.id">
          {{ client.nom || 'Nom inconnu' }} - {{ client.telephone || 'Téléphone inconnu' }}
        </li>
      </ul>
      
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        clients: []
      };
    },
    mounted() {
      fetch('/api/clients/')
        .then(response => response.json())
        .then(data => {
          console.log("Données récupérées :", data); // Debug pour voir le format
          // Si API Platform renvoie un format avec hydra:member
          this.clients = data['hydra:member'] || data;
        })
        .catch(error => console.error("Erreur lors de la récupération des clients :", error));
    }
  };
  </script>
  