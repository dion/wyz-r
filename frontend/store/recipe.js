// store/recipe.js

import { defineStore } from 'pinia';
import { fetchRecipe } from '~/services/recipeService';

export const useRecipeStore = defineStore({
  id: 'recipe',
  state: () => ({
    page: 1,
    limit: 10,
    authorEmail: '',
    ingredient: '',
    items: [],
    loading: false,
    error: false
  }),
  getters: {
    getPage() {
      return this.page;
    },
    getLimit() {
      return this.limit;
    },
    getAuthorEmail() {
      return this.authorEmail;
    },
    getIngredient() {
      return this.ingredient;
    },
    getRecipes() {
        return this.items;
    },
    getLoading() {
        return this.loading;
    }
  },
  actions: {
    resetRecipes() {
      this.items = [];
      this.page = 1;
      this.authorEmail = '';
      this.ingredient = '';
    },
    setRecipes(recipes) {
      this.items.push(...recipes);
    },
    setPage(page) {
      this.page = page;
    },
    setLimit(limit) {
      this.limit = limit;
    },
    setAuthorEmail(email) {
      this.authorEmail = email;
    },
    setIngredient(ingredient) {
      this.ingredient = ingredient;
    },
    setLoading(status) {
      this.loading = status;
    },
    async findBySlug(slug) {
      this.setLoading(true);
      const existingItem = this.items.find(item => item.slug === slug);
      
      if (existingItem) {
        this.setLoading(false);

        console.log('existingItem', existingItem);
        return existingItem;
      } else {
        try {
          const newItem = await fetchRecipe(slug);
          this.setLoading(false);

          return newItem.data;
        } catch (error) {
          this.setLoading(false);

          console.error('Error fetching recipe by slug:', error);
          throw new Error('Recipe not found');
        }
      }
    }
  }
});
