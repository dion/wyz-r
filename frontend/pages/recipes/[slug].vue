<template>
    <div>
      <p @click="goBack" class="cursor-pointer underline font-medium">Go back to Recipes</p>
      <p v-if="getLoading">Loading...</p>
      <div class="flex gap-11" v-if="recipe && recipe.name">
        <!-- Left column (image) -->
        <div class="w-1/2 p-4">
          <div v-if="recipe.images.length">
            <img :src="recipe.images[0]" class="mx-auto my-2.5" />
          </div>
        </div>

        <!-- Right column (text content) -->
        <div class="w-1/2 p-4">
          <h2 class="text-6xl leading-normal capitalize">{{ recipe.name }}</h2>
          
          <p class="text-sm">By {{ recipe.author_email }}</p>
          <p class="my-3">
            {{ recipe.description}}
          </p>

          <div class="mb-8">
            <p class="font-semibold text-lg">Steps:</p>
            <ol v-for="(step, index) in recipe.steps" :key="index" class="">
              <li>{{ step }}</li>
            </ol>
          </div>

          <div class="mb-8">
            <p class="font-semibold text-lg">Ingredients:</p>
            <ul v-for="(item, index) in recipe.ingredients" :key="index" class="item">
              <li>{{ item.name }} - {{ item.qty }} {{ item.unit }} <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1.5 px-1.5 rounded text-xs">Add to Basket</button></li>
            </ul>
          </div>

          <ul v-for="(image, index) in recipe.images" :key="index" class="inline-block">
            <li class="mr-2"><img :src="image" class="max-h-28" /></li>
          </ul>

        </div>
      </div>
    </div>
</template>
  
<script setup>
  import { useRecipeStore } from '~/store/recipe';
  const route = useRoute();
  const router = useRouter();
  const recipe = ref(null);

  const recipeStore = useRecipeStore();
  const { getLoading } = storeToRefs(recipeStore);
  
  const goBack = () => {
    router.push('/');
  }

  onMounted(async () => {
    recipe.value = await recipeStore.findBySlug(route.params.slug);
  });
</script>
  