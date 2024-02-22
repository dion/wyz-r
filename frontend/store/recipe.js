// store/recipe.js

import { defineStore } from 'pinia';

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
    }
  }
});
