<template>
    <div class="recette-container">
      <h1 class="recette-title">Gestion des Recettes</h1>
      <form @submit.prevent="createRecette" class="recette-form">
        <p>Nom du Plat:</p>
        <select v-model="recette.plat" class="recette-select">
          <option v-for="plat in plats" :key="plat.id" :value="plat.id">{{ plat.nom }}</option>
        </select>
        <p>L'ingredient:</p>
        <select v-model="recette.ingredient" class="recette-select">
          <option v-for="ingredient in ingredients" :key="ingredient.id" :value="ingredient.id">{{ ingredient.nom }}</option>
        </select>
        <button type="submit" class="recette-submit">Créer</button>
      </form>
  
      <ul class="recette-list">
        <li v-for="recette in recettes" :key="recette.id" class="recette-item">
          {{ recette.plat ? recette.plat.nom : 'Plat inconnu' }} - 
          {{ recette.ingredient ? recette.ingredient.nom : 'Ingrédient inconnu' }}
          <button @click="deleteRecette(recette.id)" class="recette-delete">Supprimer</button>
        </li>
      </ul>
    </div>


  </template>
  
  <style scoped>
  /* Container */
  .recette-container {
    max-width: 900px;
    margin: 50px auto;
    background-color: #f9f9f9;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  /* Title */
  .recette-title {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }
  
  /* Form */
  .recette-form {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
  }
  
  .recette-select {
    width: 200px;
    padding: 8px;
    margin-right: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  
  .recette-submit {
    padding: 8px 16px;
    background-color: #FF8C00;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .recette-submit:hover {
    background-color: #e77d00;
  }
  
  /* List */
  .recette-list {
    list-style-type: none;
    padding: 0;
  }
  
  .recette-item {
    background-color: #ffffff;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .recette-delete {
    padding: 5px 10px;
    background-color: #FF4500;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .recette-delete:hover {
    background-color: #e63946;
  }
  </style>
  

<script>
export default {
  data() {
    return {
      recettes: [],
      plats: [],
      ingredients: [],
      recette: {
        plat: null,
        ingredient: null
      }
    };
  },
  created() {
    this.fetchRecettes();
    this.fetchPlats();
    this.fetchIngredients();
  },
  methods: {
    fetchRecettes() {
      fetch('http://localhost:8000/api/recettes')
        .then(response => response.json())
        .then(data => {
          console.log('Recettes récupérées:', data);
          this.recettes = data['hydra:member'] || data; // API Platform
        })
        .catch(error => console.error("Erreur lors de la récupération des recettes :", error));
    },
    fetchPlats() {
      fetch('http://localhost:8000/api/plats')
        .then(response => response.json())
        .then(data => {
          console.log('Plats récupérés:', data);
          this.plats = data['hydra:member'] || data;
        })
        .catch(error => console.error("Erreur lors de la récupération des plats :", error));
    },
    fetchIngredients() {
      fetch('http://localhost:8000/api/ingredients')
        .then(response => response.json())
        .then(data => {
          console.log('Ingrédients récupérés:', data);
          this.ingredients = data['hydra:member'] || data;
        })
        .catch(error => console.error("Erreur lors de la récupération des ingrédients :", error));
    },
    createRecette() {
      fetch('http://localhost:8000/api/recettes', {
        method: 'POST',
        body: JSON.stringify(this.recette),
        headers: {
          'Content-Type': 'application/json',
        },
      })
      .then(response => response.json())
      .then(() => {
        this.fetchRecettes();
        this.recette.plat = null;
        this.recette.ingredient = null;
      })
      .catch(error => console.error("Erreur lors de la création de la recette :", error));
    },
    deleteRecette(id) {
        fetch(`http://localhost:8000/api/recettes/${id}`, { method: 'DELETE' })
            .then(response => {
            if (response.ok) {
                // Mise à jour de la liste des recettes après suppression
                this.fetchRecettes();
            } else {
                console.error('Erreur lors de la suppression de la recette');
            }
            })
            .catch(error => console.error('Erreur de réseau:', error));
        }

  }
};
</script>
