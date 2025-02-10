<template>
    <div class="ingredient-management">
      <h1 class="title">Gestion des Ingrédients</h1>
      <form @submit.prevent="createIngredient" class="form">
        <input v-model="ingredient.nom" placeholder="Nom de l'ingrédient" required class="input-field">
        <p>Quantiter:</p>
        <input v-model="ingredient.stock" type="number" placeholder="Stock" required class="input-field">
        <p>Seuil d'alerte:</p>
        <input v-model="ingredient.seuilAlerte" type="number" placeholder="Seuil d'alerte" required class="input-field">
        <button type="submit" class="submit-btn">Créer</button>
      </form>
  
      <ul class="ingredient-list">
        <li v-for="ingredient in ingredients" :key="ingredient.id" class="ingredient-item">
          <span>Nom: {{ ingredient.nom }} - Qt: {{ ingredient.stock }} - Seuil d'alerte: {{ ingredient.seuilAlerte }}</span>
          <button @click="deleteIngredient(ingredient.id)" class="delete-btn">Supprimer</button>
        </li>
      </ul>
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
  .form p {
    font-size: 14px;
    color: #555;
    text-align: center;
    font-weight: bold;
  }
  
  .ingredient-management {
    max-width: 600px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  /* Title Styling */
  .title {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }
  
  /* Form Styling */
  .form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  .input-field {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 5px;
    outline: none;
  }
  
  .input-field:focus {
    border-color: #007bff;
  }
  
  .submit-btn {
    background-color: antiquewhite;
    color: #333;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .submit-btn:hover {
    background-color: #e5d5a5;
  }
  
  /* List Styling */
  .ingredient-list {
    margin-top: 30px;
    list-style-type: none;
    padding-left: 0;
  }
  
  .ingredient-item {
    display: flex;
    justify-content: space-between;
    padding: 12px;
    background-color: #f9f9f9;
    border-radius: 5px;
    margin-bottom: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .delete-btn {
    background-color: #f44336;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .delete-btn:hover {
    background-color: #d32f2f;
  }
  </style>
  
  <script>
  export default {
    data() {
      return {
        ingredients: [],
        ingredient: {
          nom: '',
          stock: 0,
          seuilAlerte: 0
        }
      };
    },
    created() {
      this.fetchIngredients();
    },
    methods: {
      fetchIngredients() {
        fetch('/api/ingredients')
          .then(response => response.json())
          .then(data => {
            this.ingredients = data;
          });
      },
      createIngredient() {
        fetch('/api/ingredients', {
          method: 'POST',
          body: JSON.stringify(this.ingredient),
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then(response => response.json())
        .then(() => {
          this.fetchIngredients();
          this.ingredient.nom = '';
          this.ingredient.stock = 0;
          this.ingredient.seuilAlerte = 0;
        });
      },
      deleteIngredient(id) {
        fetch(`/api/ingredients/${id}`, {
          method: 'DELETE',
        })
        .then(() => {
          this.fetchIngredients();
        });
      }
    }
  };
  </script>
  