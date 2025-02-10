<template>
    <div>
      <h1>Commandes en Cours</h1>
      <ul>
        <li v-for="commande in commandes" :key="commande.id">
          {{ commande.client.nom }} - {{ commande.status }} - {{ commande.montantTotal }}€
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        commandes: []
      };
    },
    mounted() {
      fetch('/api/commandes/en-cours')
        .then(response => response.json())
        .then(data => {
          this.commandes = data;
        });
    }
  };
  </script>
  