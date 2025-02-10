<template>
    <div class="plats-container">
      <h1 class="page-title">Gestion des Plats</h1>
  
      <form @submit.prevent="createPlat" class="form">
        <input v-model="plat.nom" placeholder="Nom du plat" required class="input-field">
        <p>Temps cuisson en secondes:</p>
        <input v-model="plat.tempsCuisson" type="number" placeholder="Temps de cuisson (Sec)" required class="input-field">
        <p>prix en Ariary:</p>
        <input v-model="plat.prix" type="number" placeholder="Prix (Ar)" required class="input-field">
        <button type="submit" class="submit-btn">Créer</button>
      </form>
  
      <ul class="plats-list">
        <li v-for="plat in plats" :key="plat.id" class="plat-item">
          {{ plat.nom }} - {{ plat.tempsCuisson }} sec - {{ plat.prix }} Ar
          <button @click="deletePlat(plat.id)" class="delete-btn">Supprimer</button>
        </li>
      </ul>
    </div>

  </template>
  

  <style scoped>
  /* Container */
  .plats-container {
    max-width: 1200px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  /* Title */
  .page-title {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 32px;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }
  
  /* Form */
  .form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
  }
  
  .input-field {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 300px;
    margin: 0 auto;
  }
  
  .submit-btn {
    padding: 10px 20px;
    background-color: antiquewhite;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 150px;
    margin: 0 auto;
  }
  
  .submit-btn:hover {
    background-color: #e5d5a5;
  }
  
  /* Plats List */
  .plats-list {
    list-style-type: none;
    padding: 0;
  }
  
  .plat-item {
    display: flex;
    justify-content: space-between;
    padding: 12px;
    border-bottom: 1px solid #ddd;
  }
  .form p {
    font-size: 14px;
    color: #555;
    text-align: center;
    font-weight: bold;
  }

  
  .delete-btn {
    padding: 5px 10px;
    background-color: #ff6347;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .delete-btn:hover {
    background-color: #e55347;
  }
  </style>
  
  <script>
  export default {
    data() {
      return {
        plats: [],
        plat: {
          nom: '',
          tempsCuisson: 0,
          prix: 0
        }
      };
    },
    created() {
      this.fetchPlats();
    },
    methods: {
      fetchPlats() {
        fetch('/api/plats')
          .then(response => response.json())
          .then(data => {
            this.plats = data;
          });
      },
      createPlat() {
        fetch('/api/plats', {
          method: 'POST',
          body: JSON.stringify(this.plat),
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then(response => response.json())
        .then(() => {
          this.fetchPlats();
          this.plat.nom = '';
          this.plat.tempsCuisson = 0;
          this.plat.prix = 0;
        });
      },
      deletePlat(id) {
        fetch(`/api/plats/${id}`, {
          method: 'DELETE',
        })
        .then(() => {
          this.fetchPlats();
        });
      }
    }
  };
  </script>
  