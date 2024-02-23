<template>
    <div>
      <p @click="goBack" class="cursor-pointer underline font-medium m-3">Go back to Recipes</p>
      <div class="flex flex-col gap-4 md:flex-row md:gap-11" v-if="recipe && recipe.name">
        <!-- Left column (image) -->
        <div class="w-full md:w-1/2 p-4">
          <div v-if="recipe.images.length">
            <img :src="recipe.images[0]" class="mx-auto my-2.5" :alt="recipe.name" />
          </div>
        </div>

        <!-- Right column (text content) -->
        <div class="w-full md:w-1/2 p-4">
          <h2 class="text-6xl leading-normal capitalize">{{ recipe.name }}</h2>
          
          <p class="text-sm">By {{ recipe.author_email }}</p>
          <p class="my-3">
            {{ recipe.description}}
          </p>

          <div class="mb-8">
            <p class="font-semibold text-lg">Ingredients:</p>
            <ul class="list-disc list-inside">
              <li v-for="(item, index) in recipe.ingredients" :key="index" class="capitalize">{{ item.name }} ({{ item.qty }} {{ item.unit }}) <span v-if="item.type == 'protein'">- <span class="font-medium">${{ item.price }}</span></span> 
                <button v-if="item.type == 'protein'" class="w-full	md:w-auto mb-2 md:mb-auto bg-blue-500 hover:bg-blue-600 text-white font-bold py-1.5 px-1.5 ml-1.5 rounded text-xs">Add to Basket</button></li>
            </ul>
          </div>

          <div class="mb-8">
            <p class="font-semibold text-lg">Steps:</p>
            <ol class="list-decimal list-inside">
              <li v-for="(step, index) in recipe.steps" :key="index">{{ step }}</li>
            </ol>
          </div>

          <ul v-for="(image, index) in recipe.images" :key="index" class="inline-block">
            <li class="mr-2"><img :src="image" class="max-h-28" :alt="recipe.name" /></li>
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
  
  const goBack = () => {
    router.push('/');
  }

  onMounted(async () => {
    recipe.value = await recipeStore.findBySlug(route.params.slug);

    useSeoMeta({
      title: recipe.value.name || 'Recipe Browser 3000',
      ogTitle: recipe.value.name || 'Recipe Browser 3000',
      description: recipe.value.description || 'Find all the amazing recipes to your hearts desire.',
      ogDescription: recipe.value.description || 'Find all the amazing recipes to your hearts desire.',
      ogImage: recipe.value.images[0] || 'https://placekitten.com/500/500',
    });
  });
</script>
  