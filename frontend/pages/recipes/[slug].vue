<template>
    <div>
      <p v-if="getLoading">Loading...</p>
      <div class="flex gap-11">
        <!-- Left column (image) -->
        <div class="w-3/10">
          <div v-if="recipe.images.length">
            <img :src="recipe.images[0]" class="mx-auto my-2.5" />
          </div>
        </div>

        <!-- Right column (text content) -->
        <div class="w-7/10 p-4">
          <h2 class="text-6xl leading-normal capitalize">{{ recipe.name }}</h2>
          
          <p class="text-sm">By {{ recipe.author_email }}</p>

          <ul v-for="(image, index) in recipe.images" :key="index">
            <li><img :src="image" class="max-w-14 my-2.5" /></li>
          </ul>

          <div class="mb-8">
            <p class="font-semibold text-lg">Steps:</p>
            <ol v-for="(step, index) in recipe.steps" :key="index" class="">
              <li>{{ step }}</li>
            </ol>
          </div>

          <div class="mb-8">
            <p class="font-semibold text-lg">Ingredients:</p>
            <ul v-for="(item, index) in recipe.ingredients" :key="index" class="item">
              <li>{{ item.name }}</li>
            </ul>
          </div>

          <p class="">
            {{ recipe.description}}
          </p>
        </div>
      </div>
    </div>
</template>
  
<script setup>
  import { useRecipeStore } from '~/store/recipe';
  const route = useRoute();

  const recipeStore = useRecipeStore();
  const { getLoading } = storeToRefs(recipeStore);

  console.log('$route.params.slug', route.params.slug);

  const recipeData = await recipeStore.findBySlug(route.params.slug);
  const recipe = recipeData.data; 
</script>
  