// src/components/Statistics.vue

<template>
    <div class="statistics-container">
      <h2 class="statistics-title">Tableau des statistiques</h2>
      <p class="statistics-item"><strong>Montant total des ventes :</strong> {{ totalSales }}€</p>
      <p class="statistics-item"><strong>Nombre de plats servis :</strong> {{ totalPlats }}</p>
    </div>


  </template>
  
  <style scoped>
  /* Container */
  .statistics-container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  /* Title */
  .statistics-title {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }
  
  /* Statistics Items */
  .statistics-item {
    font-size: 18px;
    color: #555;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .statistics-item strong {
    color: #333;
    font-weight: bold;
  }
  </style>
  

<script>
export default {
  data() {
    return {
      totalSales: 0,
      totalPlats: 0,
    };
  },
  mounted() {
    this.fetchStatistics();
  },
  methods: {
    async fetchStatistics() {
      try {
        const response = await fetch('http://localhost:8000/api/statistics');
        const data = await response.json();
        if (data.totalSales !== undefined && data.totalPlats !== undefined) {
          this.totalSales = data.totalSales;
          this.totalPlats = data.totalPlats;
        }
      } catch (error) {
        console.error("Erreur lors de la récupération des statistiques", error);
      }
    },
  },
};
</script>

<style scoped>
h2 {
  color: #333;
}
p {
  font-size: 18px;
}
</style>
