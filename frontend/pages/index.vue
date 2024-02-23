<template>
    <div class="container mx-auto mb-8">
      <NuxtPage />

      <div class="m-5">
        <h1 class="text-3xl font-bold underline my-8">
          Recipe Browser 3000
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 my-8">
          <div class="col-span-1 md:col-span-2 lg:col-span-3">
            <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
            <select v-model="selectedIngredient" id="ingredients" class="block w-full mt-1 px-2 py-1 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option value="Wild Alaskan Sockeye">Wild Alaskan Sockeye</option>
              <option value="Wild Alaskan Coho">Wild Alaskan Coho</option>
              <option value="Wild Alaskan Cod">Wild Alaskan Cod</option>
              <option value="Wild Alaskan Rockfish">Wild Alaskan Rockfish</option>
              <option value="Wild Alaska Pollock">Wild Alaska Pollock</option>
              <option value="Wild Alaskan Lingcod">Wild Alaskan Lingcod</option>
              <option value="Wild Alaskan Halibut">Wild Alaskan Halibut</option>
              <option value="Wild Alaskan Sablefish">Wild Alaskan Sablefish</option>
            </select>
          </div>

          <div class="col-span-1 md:col-span-2 lg:col-span-3">
            <label for="author-email" class="block text-sm font-medium text-gray-700">Author email</label>
            <input v-model="authorEmail" type="text" id="author-email" class="block w-full mt-1 px-2 py-1 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
          </div>

          <div class="col-span-1 flex items-end justify-end">
            <button @click="updateSearchFilters" type="button" class="block w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100 mx-1.5">
              Filter
            </button>
            <button @click="resetSearchFilters" type="button" class="block w-full mt-4 px-4 py-2 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100 mx-1.5">
              Reset
            </button>
          </div>
        </div>
      </div>
      
      <Item />
    </div>
</template>
<script setup>
  import Item from '~/components/Item.vue';
  import { fetchRecipes } from '~/services/recipeService';
  import { useRecipeStore } from '~/store/recipe';

  const authorEmail = ref('');
  const selectedIngredient = ref('');
  const recipeStore = useRecipeStore();
  
  const updateSearchFilters = async () => {
    recipeStore.resetRecipes();

    if (authorEmail.value) {
      recipeStore.setAuthorEmail(authorEmail.value);
    }

    if (selectedIngredient.value) {
      recipeStore.setIngredient(selectedIngredient.value);
    }

    try {
      const response = await fetchRecipes();
    } catch (error) {}
  }

  const resetSearchFilters = async () => {
    recipeStore.resetRecipes();

    authorEmail.value = '';
    selectedIngredient.value = '';

    try {
      const response = await fetchRecipes();
    } catch (error) {}
  }
</script>
