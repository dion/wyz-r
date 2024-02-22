// store/recipe.js

import { defineStore } from 'pinia';

export const useRecipeStore = defineStore({
  id: 'recipe',
  state: () => ({
    page: 1,
    limit: 10,
    authorEmail: '',
    ingredient: ''
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
    }
  },
  actions: {
    setPage(page) {
      // TODO: add logic if page number < 2 then setLimit(10)
      this.page = page++;
    },
    setLimit(limit) {
      this.limit = limit;
    },
    setAuthorEmail(email) {
      this.authorEmail = email;
    },
    setIngredient(ingredient) {
      this.ingredient = ingredient;
    }
  }
});
